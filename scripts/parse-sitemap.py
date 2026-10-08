#!/usr/bin/env python3
"""
Парсит sitemap.xml из old/joomla/ и old/new-stack/site/,
а также сканирует HTML-файлы в old/new-stack/site/,
составляет список URL для редиректов.

Источник: Этап 1.2 чек-листа миграции.
Выход: migration-source/redirects.csv
"""

import csv
import re
import urllib.parse
from pathlib import Path
from xml.etree import ElementTree as ET

REPO_ROOT = Path(__file__).resolve().parent.parent
JOOMLA_SITEMAP = REPO_ROOT / "old" / "joomla" / "sitemap.xml"
NEWSTACK_SITEMAP = REPO_ROOT / "old" / "new-stack" / "site" / "sitemap.xml"
NEWSTACK_SITE_DIR = REPO_ROOT / "old" / "new-stack" / "site"
OUTPUT_CSV = REPO_ROOT / "migration-source" / "redirects.csv"

NS = {"sm": "http://www.sitemaps.org/schemas/sitemap/0.9"}

# Домен сайта (punycode и кириллица)
DOMAINS = [
    "https://xn--80aabgi1b2am.xn--p1ai",
    "https://бардаков.рф",
    "http://xn--80aabgi1b2am.xn--p1ai",
    "http://бардаков.рф",
]


def normalize_url(url: str) -> str:
    """Нормализует URL: убирает домен, декодирует punycode/percent-encoding."""
    for domain in DOMAINS:
        if url.startswith(domain):
            path = url[len(domain):]
            break
    else:
        path = url
    path = urllib.parse.unquote(path)
    if not path:
        path = "/"
    return path


def split_path_query(path: str) -> tuple[str, str]:
    """Разделяет path и query string."""
    if "?" in path:
        p, q = path.split("?", 1)
        return p, q
    return path, ""


def is_content_url(path: str) -> bool:
    """Фильтрует технические URL (изображения, плагины, шаблоны, файлы)."""
    skip_prefixes = (
        "/templates/",
        "/plugins/",
        "/media/",
        "/modules/",
        "/components/",
        "/images/",
        "/administrator/",
        "/index.php/",
        "/cache/",
        "/tmp/",
        "/logs/",
    )
    if "/viewer.html" in path:
        return False
    if path.startswith(skip_prefixes):
        return False
    # Пропускаем прямые файлы (zip, pdf, doc, docx, mp4, png, jpg, jpeg, gif, bmp)
    if re.search(r"\.(zip|pdf|doc|docx|mp4|png|jpg|jpeg|gif|bmp|webp|svg|ico|css|js|txt)$", path, re.IGNORECASE):
        return False
    return True


def parse_sitemap(sitemap_path: Path) -> list[dict]:
    """Парсит sitemap.xml, возвращает список записей."""
    if not sitemap_path.exists():
        print(f"⚠️  Sitemap не найден: {sitemap_path}")
        return []

    tree = ET.parse(sitemap_path)
    root = tree.getroot()

    entries = []
    for url_elem in root.findall("sm:url", NS):
        loc = url_elem.find("sm:loc", NS)
        if loc is None or not loc.text:
            continue
        lastmod = url_elem.find("sm:lastmod", NS)
        priority = url_elem.find("sm:priority", NS)
        changefreq = url_elem.find("sm:changefreq", NS)
        entries.append({
            "url": loc.text.strip(),
            "lastmod": lastmod.text if lastmod is not None else "",
            "priority": priority.text if priority is not None else "",
            "changefreq": changefreq.text if changefreq is not None else "",
        })
    return entries


def scan_newstack_html_files() -> set[str]:
    """Сканирует HTML-файлы в old/new-stack/site/, возвращает множество путей URL."""
    urls = set()
    if not NEWSTACK_SITE_DIR.exists():
        return urls

    for html_file in NEWSTACK_SITE_DIR.rglob("*.html"):
        rel = html_file.relative_to(NEWSTACK_SITE_DIR)
        # Преобразуем путь в URL
        # index.html -> /
        # obo-mne/index.html -> /obo-mne/
        # obo-mne/kontakty.html -> /obo-mne/kontakty/
        parts = rel.parts
        if len(parts) == 1:
            # Файл в корне
            if parts[0] == "index.html":
                urls.add("/")
            else:
                stem = parts[0].replace(".html", "")
                urls.add(f"/{stem}/")
        else:
            # Файл в поддиректории
            if parts[-1] == "index.html":
                url = "/" + "/".join(parts[:-1]) + "/"
            else:
                stem = parts[-1].replace(".html", "")
                url = "/" + "/".join(parts[:-1]) + "/" + stem + "/"
            urls.add(url)

    return urls


def suggest_new_url(old_path: str) -> str:
    """Предлагает новый URL на основе старого пути (для URL из Joomla)."""
    # Убираем index.php из пути
    path = re.sub(r"^/index\.php", "", old_path)
    # Убираем trailing .html
    path = re.sub(r"\.html$", "", path)
    # Убираем trailing slash для согласованности, потом добавим обратно
    path = path.rstrip("/")
    if not path:
        return "/"
    return path + "/"


def main():
    print("=" * 70)
    print("Парсинг sitemap.xml и составление redirects.csv")
    print("=" * 70)

    # Парсим Joomla sitemap
    joomla_entries = parse_sitemap(JOOMLA_SITEMAP)
    print(f"\n📂 Joomla sitemap: {len(joomla_entries)} URL всего")

    # Фильтруем только контентные URL (без query string для редиректа)
    joomla_content = []
    joomla_pdf_variants = []
    seen_paths = set()

    for entry in joomla_entries:
        path = normalize_url(entry["url"])
        if not is_content_url(path):
            continue
        clean_path, query = split_path_query(path)
        if query:
            # Это вариант страницы с query string (например, PDF-версия)
            joomla_pdf_variants.append({
                **entry,
                "normalized_path": clean_path,
                "query": query,
            })
        else:
            if clean_path not in seen_paths:
                seen_paths.add(clean_path)
                joomla_content.append({
                    **entry,
                    "normalized_path": clean_path,
                })

    print(f"   Контентных URL (без query): {len(joomla_content)}")
    print(f"   URL с query string (PDF-версии и т.п.): {len(joomla_pdf_variants)}")

    # Парсим new-stack sitemap
    newstack_entries = parse_sitemap(NEWSTACK_SITEMAP)
    print(f"\n📂 New-stack sitemap: {len(newstack_entries)} URL (только разделы)")

    # Сканируем HTML-файлы в new-stack/site/
    newstack_html_urls = scan_newstack_html_files()
    print(f"📂 New-stack HTML-файлы: {len(newstack_html_urls)} страниц")

    # Объединяем все new-stack URL
    newstack_urls = set()
    for entry in newstack_entries:
        newstack_urls.add(normalize_url(entry["url"]))
    newstack_urls.update(newstack_html_urls)

    # Составляем CSV
    OUTPUT_CSV.parent.mkdir(parents=True, exist_ok=True)

    with open(OUTPUT_CSV, "w", newline="", encoding="utf-8") as f:
        writer = csv.writer(f)
        writer.writerow(["old_url", "new_url", "status", "lastmod", "priority", "notes"])

        # Контентные URL из Joomla (без query string)
        seen = set()
        for entry in joomla_content:
            old_path = entry["normalized_path"]
            if old_path in seen:
                continue
            seen.add(old_path)
            new_path = suggest_new_url(old_path)
            if new_path in newstack_urls:
                notes = "✅ совпадает с new-stack"
            else:
                notes = "⚠️ проверить (нет в new-stack)"
            writer.writerow([
                old_path,
                new_path,
                "301",
                entry["lastmod"],
                entry["priority"],
                notes,
            ])

        # URL с query string (PDF-версии) — редирект на основную страницу
        for entry in joomla_pdf_variants:
            old_path = entry["normalized_path"]
            new_path = suggest_new_url(old_path)
            writer.writerow([
                f"{old_path}?{entry['query']}",
                new_path,
                "301",
                entry["lastmod"],
                entry["priority"],
                "PDF-версия страницы → редирект на основной URL",
            ])

        # URL только из new-stack (которых нет в Joomla)
        for url in sorted(newstack_urls):
            if url not in seen:
                seen.add(url)
                writer.writerow([
                    "",
                    url,
                    "200",
                    "",
                    "",
                    "новый URL (без редиректа)",
                ])

    print(f"\n✅ Записано: {OUTPUT_CSV}")

    # Статистика
    with open(OUTPUT_CSV, encoding="utf-8") as f:
        reader = csv.DictReader(f)
        rows = list(reader)
        total = len(rows)
        redirects = sum(1 for r in rows if r["status"] == "301")
        direct = sum(1 for r in rows if r["status"] == "200")
        matched = sum(1 for r in rows if "✅" in r["notes"])
        unverified = sum(1 for r in rows if "⚠️" in r["notes"])
        pdf_variants = sum(1 for r in rows if "PDF-версия" in r["notes"])

    print("\n" + "=" * 70)
    print("Статистика:")
    print("=" * 70)
    print(f"  Всего URL: {total}")
    print(f"  Редиректов (301): {redirects}")
    print(f"    из них PDF-версий: {pdf_variants}")
    print(f"  Прямых URL (200): {direct}")
    print(f"  Совпадает с new-stack: {matched}")
    print(f"  Требует проверки: {unverified}")


if __name__ == "__main__":
    main()
