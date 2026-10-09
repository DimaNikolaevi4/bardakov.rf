# План очистки репозитория от больших файлов

> Создано: 2026-10-09 (в дополнение к Этапу 1.1)
> Источник: `scripts/analyze-large-files.py`
> Порог: >1 MB

---

## 📊 Сводка

- Всего больших файлов в истории Git: **49**
- Общий размер: **175.79 MB**
- Размер `.git` папки: **257 MB** (до очистки)

## 🎯 Стратегия очистки

### Категория 1: Стандартные файлы Joomla → УДАЛИТЬ из истории

Эти файлы — стандартное ядро Joomla, они не должны быть в репозитории.
Они попали сюда при первоначальном импорте. Удаляются через `git filter-repo`.

**Количество:** 16 файлов
**Размер:** 47.88 MB

| Путь | Размер (MB) |
|---|---:|
| `joomla/plugins/system/webauthn/fido.jwt` | 6.90 |
| `joomla/tmp/pdfviewer_content_1.4.1.zip` | 5.27 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/build/pdf.worker.mjs.map` | 4.79 |
| `joomla/tmp/pdfviewer_content_1.4.0.zip` | 4.77 |
| `joomla/tmp/pdfviewer_content_1.3.2.zip` | 4.77 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/build/pdf.worker.js.map` | 4.74 |
| `joomla/tmp/install_67eb8097c5ff9/com_akeebabackup-core.zip` | 2.89 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/build/pdf.worker.js` | 1.89 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/build/pdf.mjs.map` | 1.89 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/build/pdf.worker.mjs` | 1.80 |
| `joomla/media/vendor/tinymce/tinymce.js` | 1.74 |
| `joomla/media/vendor/tinymce/themes/silver/theme.js` | 1.45 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/web/viewer.mjs.map` | 1.43 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/build/pdf.js.map` | 1.37 |
| `joomla/media/gantry5/assets/js/font-awesome5-all.min.js` | 1.13 |
| `joomla/plugins/content/pdfviewer/assets/pdfjs/web/viewer.js.map` | 1.06 |

### Категория 2: Контентные файлы → хранить на хостинге Beget

Видео, большие PDF, большие DOCX, архивы — хранить в отдельных папках на хостинге.
В репозитории — только ссылки/пути в CSV-инвентаре.

**Количество:** 6 файлов
**Размер:** 49.96 MB

**Структура хранения на хостинге Beget:**
```
~/bardakov-large-files/      # Вне public_html, доступ через symlink
├── video/                   # .mp4, .avi, .mov
├── archives/                # .zip, .tar.gz
├── documents/               # .pdf, .docx (>3 MB)
│   ├── razgovor/            # «Разговоры о важном»
│   ├── vospitanie/           # Нормативные документы
│   └── obuchenie/           # Учебные материалы
└── large-images/            # .jpg, .png (>3 MB)
```

**Доступ через symlink в public_html:**
```bash
# На хостинге Beget
ln -s ~/bardakov-large-files/video ~/bardakov.rf/public_html/assets/video
ln -s ~/bardakov-large-files/documents ~/bardakov.rf/public_html/assets/docs-large
```

### Категория 3: Большие изображения → оптимизировать или на хостинг

**Количество:** 10 файлов
**Размер:** 51.06 MB

Опции:
1. Оптимизировать в WebP с уменьшением разрешения (на Этапе 5.2)
2. Если оптимизация не помогает — переместить на хостинг

---

## 🔧 План выполнения

### Шаг 1: Резервное копирование репозитория

```bash
cd /home/z/my-project/bardakov.rf
tar -czf /tmp/bardakov-backup-$(date +%Y%m%d).tar.gz .
```

⚠️ **ОБЯЗАТЕЛЬНО:** сохраните резервную копию перед очисткой истории.

### Шаг 2: Очистка истории от стандартных файлов Joomla

Используем `git filter-repo` (замена устаревшему `git filter-branch`):

```bash
# Установить git-filter-repo (если не установлен)
pip3 install git-filter-repo

# Создать файл с путями для удаления
cat > /tmp/joomla-core-paths.txt << 'EOF'
joomla/plugins/
joomla/modules/
joomla/components/
joomla/libraries/
joomla/media/
joomla/tmp/
joomla/cache/
joomla/logs/
joomla/cli/
joomla/api/
joomla/administrator/
joomla/includes/
joomla/language/
joomla/layouts/
old/joomla/plugins/
old/joomla/modules/
old/joomla/components/
old/joomla/libraries/
old/joomla/media/
old/joomla/tmp/
old/joomla/cache/
old/joomla/logs/
old/joomla/cli/
old/joomla/api/
old/joomla/administrator/
old/joomla/includes/
old/joomla/language/
old/joomla/layouts/
EOF

# Запустить очистку (ПЕРЕД ПОЛНЫМ БЭКАПОМ)
git filter-repo --paths-from-file /tmp/joomla-core-paths.txt --force
```

### Шаг 3: Принудительный push

⚠️ **Внимание:** хеши коммитов изменятся. Все, кто работал с репозиторием, должны переклонировать его.

```bash
git push origin main --force
```

### Шаг 4: Перенос больших контентных файлов на хостинг Beget

Выполняется **на самом хостинге** (через SSH/FTP), не локально.
Требует доступа к Beget — выполняется пользователем.

```bash
# На хостинге Beget
mkdir -p ~/bardakov-large-files/{video,archives,documents/{razgovor,vospitanie,obuchenie},large-images}

# Переместить большие файлы из public_html/joomla/images/Animation/
mv ~/bardakov.rf/public_html/joomla/images/Animation/*.mp4 ~/bardakov-large-files/video/

# Переместить большие PDF
# (полный список — в migration-source/large-files-inventory.csv)
```

### Шаг 5: Обновить .gitignore

Добавить исключения для всех больших файлов, которые будут храниться на хостинге.

### Шаг 6: Сжатие и очистка Git

```bash
git reflog expire --expire=now --all
git gc --prune=now --aggressive
```

---

## 📈 Ожидаемый результат

| Метрика | До | После (ожидаемо) |
|---|---:|---:|
| Размер `.git` | 257 MB | ~80-100 MB |
| Размер рабочей директории | 348 MB | ~170 MB |
| Время клонирования | ~30 сек | ~10 сек |

---

## ⚠️ Предупреждения

1. **Сделайте резервную копию** перед любыми операциями с историей Git
2. **Предупредите всех контрибьюторов** — им придётся переклонировать репозиторий
3. **Не выполняйте очистку истории во время активной работы** других людей
4. **Проверьте**, что в ветке `archive-joomla` (если будет создана) сохранены все файлы перед очисткой main
