#!/usr/bin/env python3
"""
Анализ больших файлов в истории Git и в рабочей директории.

Цель: выявить все файлы >1 MB, классифицировать их:
- Стандартные файлы Joomla (должны быть удалены из репозитория)
- Контентные файлы (PDF, DOCX, JPG, MP4) — хранить на хостинге, не в git
- Маленькие ассеты — оставить в репозитории

Выход:
- migration-source/large-files-inventory.csv
- migration-source/large-files-cleanup-plan.md
"""

import csv
import re
import subprocess
from pathlib import Path

REPO_ROOT = Path(__file__).resolve().parent.parent
OUTPUT_CSV = REPO_ROOT / "migration-source" / "large-files-inventory.csv"
OUTPUT_PLAN = REPO_ROOT / "migration-source" / "large-files-cleanup-plan.md"

# Порог размера
SIZE_THRESHOLD = 1024 * 1024  # 1 MB

# Шаблоны путей стандартных файлов Joomla (которые не должны быть в репозитории)
JOOMLA_CORE_PATTERNS = [
    r"^(joomla|old/joomla)/(plugins|modules|components|libraries|media|tmp|cache|logs|cli|api|administrator|includes|language|layouts)/",
    r"^(joomla|old/joomla)/(plugins|modules|components|libraries|media|tmp)/.*\.(zip|tar\.gz|tgz)$",
    r"^(joomla|old/joomla)/configuration\.php$",
]

# Паттерны контентных файлов (нужно хранить на хостинге, не в git)
CONTENT_PATTERNS = [
    (r"\.mp4$", "video", "Видео-файлы — хранить на хостинге, в репозитории только ссылка"),
    (r"\.avi$", "video", "Видео-файлы"),
    (r"\.mov$", "video", "Видео-файлы"),
    (r"\.mkv$", "video", "Видео-файлы"),
    (r"\.zip$", "archive", "Архивы — хранить на хостинге"),
    (r"\.tar\.gz$", "archive", "Архивы"),
    (r"\.tgz$", "archive", "Архивы"),
    (r"\.rar$", "archive", "Архивы"),
]


def get_large_blobs_in_history():
    """Получает все блобы >1 MB из всей истории Git."""
    cmd = "git rev-list --objects --all | git cat-file --batch-check='%(objecttype) %(objectname) %(objectsize) %(rest)'"
    result = subprocess.run(cmd, shell=True, capture_output=True, text=True, cwd=REPO_ROOT)
    blobs = []
    for line in result.stdout.splitlines():
        parts = line.split(" ", 3)
        if len(parts) < 4:
            continue
        otype, oname, osize, rest = parts[0], parts[1], parts[2], parts[3]
        if otype != "blob":
            continue
        try:
            size = int(osize)
        except ValueError:
            continue
        if size >= SIZE_THRESHOLD:
            blobs.append({
                "object": oname,
                "size": size,
                "path": rest,
            })
    return blobs


def classify_file(path: str, size: int) -> tuple[str, str, str]:
    """
    Классифицирует файл.
    Возвращает (category, action, reason).
    """
    # 1. Стандартные файлы Joomla
    for pattern in JOOMLA_CORE_PATTERNS:
        if re.search(pattern, path):
            return ("joomla-core", "remove-from-history",
                    "Стандартный файл Joomla — не должен быть в репозитории")

    # 2. Контентные файлы
    for pattern, category, reason in CONTENT_PATTERNS:
        if re.search(pattern, path, re.IGNORECASE):
            return (category, "host-on-beget", reason)

    # 3. Большие изображения
    if re.search(r"\.(jpg|jpeg|png|bmp|gif|tiff?|webp)$", path, re.IGNORECASE):
        if size > 3 * 1024 * 1024:  # >3 MB
            return ("large-image", "host-on-beget-or-optimize",
                    "Большое изображение — оптимизировать (WebP, resize) или хранить на хостинге")
        return ("image", "keep-but-optimize",
                "Изображение — оптимизировать в WebP")

    # 4. PDF документы
    if re.search(r"\.pdf$", path, re.IGNORECASE):
        if size > 3 * 1024 * 1024:  # >3 MB
            return ("large-pdf", "host-on-beget",
                    "Большой PDF — хранить на хостинге, в репозитории только путь")
        return ("pdf", "keep",
                "PDF документ — оставить в репозитории")

    # 5. DOCX/DOC
    if re.search(r"\.docx?$", path, re.IGNORECASE):
        if size > 3 * 1024 * 1024:  # >3 MB
            return ("large-doc", "host-on-beget",
                    "Большой документ — хранить на хостинге")
        return ("doc", "keep",
                "Документ — оставить в репозитории")

    # 6. Остальное
    return ("other", "review-manually",
            "Требует ручной проверки")


def main():
    print("=" * 70)
    print("Анализ больших файлов в истории Git (>1 MB)")
    print("=" * 70)

    blobs = get_large_blobs_in_history()
    print(f"\n📊 Найдено {len(blobs)} уникальных больших файлов в истории")

    # Классификация
    records = []
    for blob in blobs:
        category, action, reason = classify_file(blob["path"], blob["size"])
        records.append({
            **blob,
            "category": category,
            "action": action,
            "reason": reason,
            "size_mb": round(blob["size"] / (1024 * 1024), 2),
        })

    # Сортируем по размеру (убывание)
    records.sort(key=lambda r: r["size"], reverse=True)

    # Записываем CSV
    OUTPUT_CSV.parent.mkdir(parents=True, exist_ok=True)
    with open(OUTPUT_CSV, "w", newline="", encoding="utf-8") as f:
        writer = csv.writer(f)
        writer.writerow(["path", "object", "size_bytes", "size_mb", "category", "action", "reason"])
        for r in records:
            writer.writerow([
                r["path"], r["object"], r["size"],
                f"{r['size_mb']:.2f}",
                r["category"], r["action"], r["reason"],
            ])

    # Группировка по категориям
    by_category = {}
    by_action = {}
    total_size = 0
    for r in records:
        by_category.setdefault(r["category"], []).append(r)
        by_action.setdefault(r["action"], []).append(r)
        total_size += r["size"]

    print(f"\n📁 По категориям:")
    for cat in sorted(by_category.keys()):
        items = by_category[cat]
        size = sum(i["size"] for i in items)
        print(f"   {cat:20s}: {len(items):4d} файлов, {size/(1024*1024):8.2f} MB")

    print(f"\n🎯 По действию:")
    for act in sorted(by_action.keys()):
        items = by_action[act]
        size = sum(i["size"] for i in items)
        print(f"   {act:30s}: {len(items):4d} файлов, {size/(1024*1024):8.2f} MB")

    print(f"\n💰 Общий размер больших файлов: {total_size/(1024*1024):.2f} MB")

    # Генерируем план очистки
    print(f"\n📝 План очистки: {OUTPUT_PLAN}")
    generate_cleanup_plan(records, by_category, by_action, total_size)


def generate_cleanup_plan(records, by_category, by_action, total_size):
    """Генерирует Markdown-план очистки репозитория."""
    joomla_core = by_action.get("remove-from-history", [])
    host_on_beget = by_action.get("host-on-beget", [])
    host_or_optimize = by_action.get("host-on-beget-or-optimize", [])

    with open(OUTPUT_PLAN, "w", encoding="utf-8") as f:
        f.write("# План очистки репозитория от больших файлов\n\n")
        f.write(f"> Создано: 2026-10-09 (в дополнение к Этапу 1.1)\n")
        f.write(f"> Источник: `scripts/analyze-large-files.py`\n")
        f.write(f"> Порог: >1 MB\n\n")
        f.write("---\n\n")

        f.write("## 📊 Сводка\n\n")
        f.write(f"- Всего больших файлов в истории Git: **{len(records)}**\n")
        f.write(f"- Общий размер: **{total_size/(1024*1024):.2f} MB**\n")
        f.write(f"- Размер `.git` папки: **257 MB** (до очистки)\n\n")

        f.write("## 🎯 Стратегия очистки\n\n")
        f.write("### Категория 1: Стандартные файлы Joomla → УДАЛИТЬ из истории\n\n")
        f.write("Эти файлы — стандартное ядро Joomla, они не должны быть в репозитории.\n")
        f.write("Они попали сюда при первоначальном импорте. Удаляются через `git filter-repo`.\n\n")
        f.write(f"**Количество:** {len(joomla_core)} файлов\n")
        f.write(f"**Размер:** {sum(r['size'] for r in joomla_core)/(1024*1024):.2f} MB\n\n")
        f.write("| Путь | Размер (MB) |\n|---|---:|\n")
        for r in joomla_core[:30]:
            f.write(f"| `{r['path']}` | {r['size_mb']:.2f} |\n")
        if len(joomla_core) > 30:
            f.write(f"| ... и ещё {len(joomla_core)-30} файлов | — |\n")
        f.write("\n")

        f.write("### Категория 2: Контентные файлы → хранить на хостинге Beget\n\n")
        f.write("Видео, большие PDF, большие DOCX, архивы — хранить в отдельных папках на хостинге.\n")
        f.write("В репозитории — только ссылки/пути в CSV-инвентаре.\n\n")
        f.write(f"**Количество:** {len(host_on_beget)} файлов\n")
        f.write(f"**Размер:** {sum(r['size'] for r in host_on_beget)/(1024*1024):.2f} MB\n\n")
        f.write("**Структура хранения на хостинге Beget:**\n")
        f.write("```\n")
        f.write("~/bardakov-large-files/      # Вне public_html, доступ через symlink\n")
        f.write("├── video/                   # .mp4, .avi, .mov\n")
        f.write("├── archives/                # .zip, .tar.gz\n")
        f.write("├── documents/               # .pdf, .docx (>3 MB)\n")
        f.write("│   ├── razgovor/            # «Разговоры о важном»\n")
        f.write("│   ├── vospitanie/           # Нормативные документы\n")
        f.write("│   └── obuchenie/           # Учебные материалы\n")
        f.write("└── large-images/            # .jpg, .png (>3 MB)\n")
        f.write("```\n\n")
        f.write("**Доступ через symlink в public_html:**\n")
        f.write("```bash\n")
        f.write("# На хостинге Beget\n")
        f.write("ln -s ~/bardakov-large-files/video ~/bardakov.rf/public_html/assets/video\n")
        f.write("ln -s ~/bardakov-large-files/documents ~/bardakov.rf/public_html/assets/docs-large\n")
        f.write("```\n\n")

        f.write("### Категория 3: Большие изображения → оптимизировать или на хостинг\n\n")
        f.write(f"**Количество:** {len(host_or_optimize)} файлов\n")
        f.write(f"**Размер:** {sum(r['size'] for r in host_or_optimize)/(1024*1024):.2f} MB\n\n")
        f.write("Опции:\n")
        f.write("1. Оптимизировать в WebP с уменьшением разрешения (на Этапе 5.2)\n")
        f.write("2. Если оптимизация не помогает — переместить на хостинг\n\n")

        f.write("---\n\n")
        f.write("## 🔧 План выполнения\n\n")
        f.write("### Шаг 1: Резервное копирование репозитория\n\n")
        f.write("```bash\n")
        f.write("cd /home/z/my-project/bardakov.rf\n")
        f.write("tar -czf /tmp/bardakov-backup-$(date +%Y%m%d).tar.gz .\n")
        f.write("```\n\n")
        f.write("⚠️ **ОБЯЗАТЕЛЬНО:** сохраните резервную копию перед очисткой истории.\n\n")

        f.write("### Шаг 2: Очистка истории от стандартных файлов Joomla\n\n")
        f.write("Используем `git filter-repo` (замена устаревшему `git filter-branch`):\n\n")
        f.write("```bash\n")
        f.write("# Установить git-filter-repo (если не установлен)\n")
        f.write("pip3 install git-filter-repo\n\n")
        f.write("# Создать файл с путями для удаления\n")
        f.write("cat > /tmp/joomla-core-paths.txt << 'EOF'\n")
        f.write("joomla/plugins/\n")
        f.write("joomla/modules/\n")
        f.write("joomla/components/\n")
        f.write("joomla/libraries/\n")
        f.write("joomla/media/\n")
        f.write("joomla/tmp/\n")
        f.write("joomla/cache/\n")
        f.write("joomla/logs/\n")
        f.write("joomla/cli/\n")
        f.write("joomla/api/\n")
        f.write("joomla/administrator/\n")
        f.write("joomla/includes/\n")
        f.write("joomla/language/\n")
        f.write("joomla/layouts/\n")
        f.write("old/joomla/plugins/\n")
        f.write("old/joomla/modules/\n")
        f.write("old/joomla/components/\n")
        f.write("old/joomla/libraries/\n")
        f.write("old/joomla/media/\n")
        f.write("old/joomla/tmp/\n")
        f.write("old/joomla/cache/\n")
        f.write("old/joomla/logs/\n")
        f.write("old/joomla/cli/\n")
        f.write("old/joomla/api/\n")
        f.write("old/joomla/administrator/\n")
        f.write("old/joomla/includes/\n")
        f.write("old/joomla/language/\n")
        f.write("old/joomla/layouts/\n")
        f.write("EOF\n\n")
        f.write("# Запустить очистку (ПЕРЕД ПОЛНЫМ БЭКАПОМ)\n")
        f.write("git filter-repo --paths-from-file /tmp/joomla-core-paths.txt --force\n")
        f.write("```\n\n")

        f.write("### Шаг 3: Принудительный push\n\n")
        f.write("⚠️ **Внимание:** хеши коммитов изменятся. Все, кто работал с репозиторием, должны переклонировать его.\n\n")
        f.write("```bash\n")
        f.write("git push origin main --force\n")
        f.write("```\n\n")

        f.write("### Шаг 4: Перенос больших контентных файлов на хостинг Beget\n\n")
        f.write("Выполняется **на самом хостинге** (через SSH/FTP), не локально.\n")
        f.write("Требует доступа к Beget — выполняется пользователем.\n\n")
        f.write("```bash\n")
        f.write("# На хостинге Beget\n")
        f.write("mkdir -p ~/bardakov-large-files/{video,archives,documents/{razgovor,vospitanie,obuchenie},large-images}\n\n")
        f.write("# Переместить большие файлы из public_html/joomla/images/Animation/\n")
        f.write("mv ~/bardakov.rf/public_html/joomla/images/Animation/*.mp4 ~/bardakov-large-files/video/\n\n")
        f.write("# Переместить большие PDF\n")
        f.write("# (полный список — в migration-source/large-files-inventory.csv)\n")
        f.write("```\n\n")

        f.write("### Шаг 5: Обновить .gitignore\n\n")
        f.write("Добавить исключения для всех больших файлов, которые будут храниться на хостинге.\n\n")
        f.write("### Шаг 6: Сжатие и очистка Git\n\n")
        f.write("```bash\n")
        f.write("git reflog expire --expire=now --all\n")
        f.write("git gc --prune=now --aggressive\n")
        f.write("```\n\n")

        f.write("---\n\n")
        f.write("## 📈 Ожидаемый результат\n\n")
        f.write("| Метрика | До | После (ожидаемо) |\n")
        f.write("|---|---:|---:|\n")
        f.write("| Размер `.git` | 257 MB | ~80-100 MB |\n")
        f.write("| Размер рабочей директории | 348 MB | ~170 MB |\n")
        f.write("| Время клонирования | ~30 сек | ~10 сек |\n\n")

        f.write("---\n\n")
        f.write("## ⚠️ Предупреждения\n\n")
        f.write("1. **Сделайте резервную копию** перед любыми операциями с историей Git\n")
        f.write("2. **Предупредите всех контрибьюторов** — им придётся переклонировать репозиторий\n")
        f.write("3. **Не выполняйте очистку истории во время активной работы** других людей\n")
        f.write("4. **Проверьте**, что в ветке `archive-joomla` (если будет создана) сохранены все файлы перед очисткой main\n")


if __name__ == "__main__":
    main()
