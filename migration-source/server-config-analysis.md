# Анализ конфигурации сервера: .htaccess и robots.txt

> Создано: 2026-10-08 (Этап 1.3 — Наследие старого сайта)
> Источники: `old/joomla/.htaccess`, `old/joomla/robots.txt`, `old/new-stack/site/robots.txt`

---

## ⚠️ Важно

Текущий живой сайт `бардаков.рф` запущен на Joomla 5. После миграции на статический сайт большая часть правил .htaccess из Joomla **неактуальна** (нет PHP, нет БД, нет /administrator/, нет SEF-роутинга).

Но некоторые правила полезны и для статического сайта — они повышают безопасность и производительность.

---

## `.htaccess` из Joomla — разбор по секциям

| Секция | Назначение | Переносить? | Причина |
|---|---|---|---|
| `Options +FollowSymlinks` | Включает симлинки для mod_rewrite | ✅ Да | Базовая настройка Apache |
| `Options -Indexes` | Запрещает просмотр директорий без index-файла | ✅ Да | Безопасность |
| `IndexIgnore *` (mod_autoindex) | Скрывает все файлы в листинге | ✅ Да | Дополнение к `-Indexes` |
| `X-Content-Type-Options "nosniff"` | Запрещает MIME-sniffing | ✅ Да | Безопасность (важно!) |
| `Content-Security-Policy` для .svg | Запрещает inline JS в SVG-файлах | ✅ Да | Защита от XSS через SVG |
| Блокировка exploits (base64, script, GLOBALS, _REQUEST) | Анти-эксплойты Joomla | ❌ Нет | Статический сайт не имеет PHP — эти атаки нерелевантны |
| `HTTP_AUTHORIZATION` через RewriteRule | Проброс заголовка авторизации для Joomla API | ❌ Нет | Нет API |
| SEF URLs (`/api/`, `index.php`) | Роутинг Joomla | ❌ Нет | Заменяется на прямые пути к HTML-файлам |
| Fallback `RedirectMatch 302 ^/$ /index.php/` | Если mod_rewrite недоступен | ❌ Нет | Статический сайт не требует |
| GZIP-сжатие CSS/JS | Серверное сжатие | ✅ Да (упрощённо) | Производительность |
| `AddDefaultCharset utf-8` | Кодировка по умолчанию | ✅ Да | Корректное отображение кириллицы |

---

## Рекомендации для нового `.htaccess`

Перенести в новый `public/.htaccess` следующие правила:

### 1. Базовая безопасность
```apache
# Запрет просмотра директорий
Options -Indexes

# Запрет MIME-sniffing
<IfModule mod_headers.c>
  Header always set X-Content-Type-Options "nosniff"
</IfModule>

# Защита SVG от inline JS
<FilesMatch "\.svg$">
  <IfModule mod_headers.c>
    Header always set Content-Security-Policy "script-src 'none'"
  </IfModule>
</FilesMatch>

# Запрет доступа к служебным файлам
<FilesMatch "(\.md|\.json|\.ya?ml|package\.json|package-lock\.json|\.eleventy\.js|\.env)">
  Require all denied
</FilesMatch>
```

### 2. GZIP-сжатие
```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/css text/javascript application/javascript application/json image/svg+xml
</IfModule>
```

### 3. Кэширование статики
```apache
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType text/css "access plus 1 year"
  ExpiresByType text/javascript "access plus 1 year"
  ExpiresByType application/javascript "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/png "access plus 1 month"
  ExpiresByType image/jpeg "access plus 1 month"
  ExpiresByType image/svg+xml "access plus 1 month"
  ExpiresByType application/pdf "access plus 1 month"
  ExpiresByType text/html "access plus 0 seconds"
</IfModule>
```

### 4. Кодировка
```apache
AddDefaultCharset utf-8
```

### 5. HTTPS-редирект
```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTPS} off
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

### 6. www → без www (или наоборот)
```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTP_HOST} ^www\.(.+)$ [NC]
  RewriteRule ^(.*)$ https://%1/$1 [R=301,L]
</IfModule>
```

### 7. 301-редиректы со старых URL Joomla
```apache
# Полный список — из migration-source/redirects.csv
# Будет сгенерирован на Этапе 5.3
Redirect 301 /index.php/obo-mne https://бардаков.рф/obo-mne/
Redirect 301 /abiturientu/professii/15-01-31-master-kontrolno-izmeritelnykh-priborov-i-avtomatiki https://бардаков.рф/abiturientu/professii/15-01-31-master-kip/
# ... и так далее
```

### 8. Канонизация index.html
```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{THE_REQUEST} ^.*/index\.html [NC]
  RewriteRule ^(.*)index\.html$ /$1 [R=301,L]
</IfModule>
```

---

## `robots.txt` — разбор

### Текущий robots.txt из Joomla

```text
User-agent: *
Disallow: /administrator/
Disallow: /api/
Disallow: /bin/
Disallow: /cache/
Disallow: /cli/
Disallow: /components/
Disallow: /includes/
Disallow: /installation/
Disallow: /language/
Disallow: /layouts/
Disallow: /libraries/
Disallow: /logs/
Disallow: /modules/
Disallow: /plugins/
Disallow: /tmp/
Disallow: /private
```

**Анализ:** все Disallow — это директории Joomla, которых не будет в статическом сайте. Эти правила **не нужны** в новом `robots.txt`.

### Текущий robots.txt из new-stack/site

```text
User-agent: *
Allow: /
Sitemap: /sitemap.xml
```

**Анализ:** минимальный, разрешает индексацию всего. Не указывает `Host` (устаревший, Yandex игнорирует с 2018) и не указывает полный URL sitemap (только относительный путь).

### Рекомендации для нового `robots.txt`

```text
User-agent: *
Allow: /

# Запрет индексации служебных файлов
Disallow: /*.json$
Disallow: /*.md$
Disallow: /assets/css/
Disallow: /assets/js/
Disallow: /assets/fonts/

# Карта сайта (полный URL!)
Sitemap: https://бардаков.рф/sitemap.xml
```

**Дополнительно:**
- Файл верификации Yandex.Webmaster (`yandex_0ff2f2d3e1d3590d.html`) должен лежать в корне нового сайта
- Проверить, нет ли в Google Search Console мета-тега `google-site-verification` (на живом сайте — проверить на Этапе 7.1)

---

## Файлы для переноса на новый сайт

| Файл | Источник | Куда |
|---|---|---|
| `.htaccess` | (создать новый) | `public/.htaccess` |
| `robots.txt` | (создать новый) | `public/robots.txt` (или `src/robots.txt.njk` через Eleventy) |
| `yandex_0ff2f2d3e1d3590d.html` | `migration-source/yandex_0ff2f2d3e1d3590d.html` | `public/yandex_0ff2f2d3e1d3590d.html` |
| `favicon.ico` | `migration-source/favicon.ico` (+ создать полный набор) | `public/favicon.ico` и др. |
| `sitemap.xml` | (генерируется Eleventy) | `public/sitemap.xml` |

---

## TODO на Этапе 5.3 (Подготовка правил редиректов)

- [ ] Сгенерировать `public/.htaccess` из шаблона + 301-редиректы из `redirects.csv`
- [ ] Создать `src/content/robots.txt.njk` (или passthrough copy)
- [ ] Скопировать `yandex_0ff2f2d3e1d3590d.html` в `public/`
- [ ] Проверить актуальность правил на живом сайте (если есть доступ к Beget — скачать текущие `.htaccess` и `robots.txt`)

## TODO на Этапе 7.4 (Финальный релиз)

- [ ] После деплоя — проверить через Yandex.Webmaster, что новый `robots.txt` подхвачен
- [ ] Загрузить новый `sitemap.xml` в Yandex.Webmaster
- [ ] Проверить, что верификация Yandex (файл `yandex_*.html`) прошла успешно
- [ ] Проверить 5-10 ключевых редиректов через `curl -I`
