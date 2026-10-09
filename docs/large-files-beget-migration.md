# Инструкция: Перенос больших файлов на хостинг Beget

> 📋 **Это ваша задача.** Я не могу выполнить её без доступа к хостингу.
>
> Создано: 2026-10-09 (Шаги 4–6 раздела 1.1.1 чек-листа)
> Связанные файлы:
> - `migration-source/large-files-inventory.csv` — полный список больших файлов
> - `migration-source/large-files-cleanup-plan.md` — общий план очистки
> - `ROADMAP_CHECKLIST.md` → раздел 1.1.1

---

## 🎯 Что нужно сделать

Перенести **6 больших контентных файлов + 10 больших изображений** (общий размер ~100 MB) из `public_html/` на хостинге в отдельную папку **вне** `public_html/`, доступ через symlink.

**Зачем:** Эти файлы не должны быть в Git-репозитории (раздувают его), но должны быть доступны по web-адресам.

---

## 📋 Список файлов для переноса

Полный список в `migration-source/large-files-inventory.csv` — фильтруйте по столбцу `action` = `host-on-beget`.

### 🎥 Видео (2 файла)

| Файл | Источник на хостинге | Куда переместить |
|---|---|---|
| `Бардаков_самопризентация.mp4` | `~/bardakov.rf/public_html/images/Animation/` | `~/bardakov-large-files/video/` |
| `2-1-2400.mp4` | `~/bardakov.rf/public_html/images/Animation/` | `~/bardakov-large-files/video/` |

### 📄 Большие PDF (5 файлов, 27.59 MB)

| Файл | Источник на хостинге | Куда переместить |
|---|---|---|
| `Атомный урок.pdf` | `~/bardakov.rf/public_html/images/pdf/razgovor/` | `~/bardakov-large-files/documents/razgovor/` |
| `ДЕНЬ ЗНАНИЙ.pdf` | `~/bardakov.rf/public_html/images/pdf/razgovor/` | `~/bardakov-large-files/documents/razgovor/` |
| `ДЕНЬ КОСМОНАВТИКИ.pdf` | `~/bardakov.rf/public_html/images/pdf/razgovor/` | `~/bardakov-large-files/documents/razgovor/` |
| `ДЕНЬ УЧИТЕЛЯ.pdf` | `~/bardakov.rf/public_html/images/pdf/razgovor/` | `~/bardakov-large-files/documents/razgovor/` |
| `ДЕНЬ МАТЕРИ.pdf` | `~/bardakov.rf/public_html/images/pdf/razgovor/` | `~/bardakov-large-files/documents/razgovor/` |
| `Устав-ГБПОУ-РО-СИТ-14.12.2018[1].pdf` | `~/bardakov.rf/public_html/images/pdf/vospitanie/` | `~/bardakov-large-files/documents/vospitanie/` |

### 📝 Большие DOCX (2 файла, 22.38 MB)

| Файл | Источник на хостинге | Куда переместить |
|---|---|---|
| `ПР МДК 03.02 КИП 3 КУРС.docx` | `~/bardakov.rf/public_html/` (в корне) | `~/bardakov-large-files/documents/obuchenie/` |
| `ПР МДК 03.02 КИП 4 КУРС.docx` | `~/bardakov.rf/public_html/` (в корне) | `~/bardakov-large-files/documents/obuchenie/` |

### 🖼 Большие изображения (10 файлов, 51 MB)

| Файл | Источник на хостинге | Куда переместить |
|---|---|---|
| `ц1.jpg` (10 MB) | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `ц.jpg` (8.6 MB) | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `кск (2).jpg` (7.6 MB) | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `ц2.jpg` (5.2 MB) | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `я.jpg` (3.8 MB) | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `кск (4).jpg` | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `ы2.jpg` | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `ы3.jpg` | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `ы4.jpg` | `~/bardakov.rf/public_html/images/dost/` | `~/bardakov-large-files/large-images/` |
| `я111.jpg` | `~/bardakov.rf/public_html/assets/images/dost/` | `~/bardakov-large-files/large-images/` |

**Итого:** 19 файлов, ~100 MB

---

## 🛠 Пошаговая инструкция

### Вариант A: Через SSH (рекомендуется)

Подключитесь к хостингу Beget по SSH:
```bash
ssh ваш_логин@ваш_сервер.beget.com
```

#### Шаг 1. Создать структуру папок

```bash
mkdir -p ~/bardakov-large-files/{video,archives,documents/{razgovor,vospitanie,obuchenie},large-images}
```

Проверьте:
```bash
ls -la ~/bardakov-large-files/
```

Должно быть:
```
archives/  documents/  large-images/  video/
```

#### Шаг 2. Перенести видео

```bash
cd ~/bardakov.rf/public_html/images/Animation/
mv Бардаков_самопризентация.mp4 ~/bardakov-large-files/video/
mv 2-1-2400.mp4 ~/bardakov-large-files/video/

# Проверка
ls -la ~/bardakov-large-files/video/
```

#### Шаг 3. Перенести большие PDF «Разговоры о важном»

```bash
cd ~/bardakov.rf/public_html/images/pdf/razgovor/

mv "Атомный урок.pdf" ~/bardakov-large-files/documents/razgovor/
mv "ДЕНЬ ЗНАНИЙ.pdf" ~/bardakov-large-files/documents/razgovor/
mv "ДЕНЬ КОСМОНАВТИКИ.pdf" ~/bardakov-large-files/documents/razgovor/
mv "ДЕНЬ УЧИТЕЛЯ.pdf" ~/bardakov-large-files/documents/razgovor/
mv "ДЕНЬ МАТЕРИ.pdf" ~/bardakov-large-files/documents/razgovor/
```

И устав:
```bash
cd ~/bardakov.rf/public_html/images/pdf/vospitanie/
mv "Устав-ГБПОУ-РО-СИТ-14.12.2018[1].pdf" ~/bardakov-large-files/documents/vospitanie/
```

#### Шаг 4. Перенести большие DOCX

```bash
cd ~/bardakov.rf/public_html/
mv "ПР МДК 03.02 КИП 3 КУРС.docx" ~/bardakov-large-files/documents/obuchenie/
mv "ПР МДК 03.02 КИП 4 КУРС.docx" ~/bardakov-large-files/documents/obuchenie/
```

#### Шаг 5. Перенести большие изображения

```bash
cd ~/bardakov.rf/public_html/images/dost/
mv ц1.jpg ~/bardakov-large-files/large-images/
mv ц.jpg ~/bardakov-large-files/large-images/
mv "кск (2).jpg" ~/bardakov-large-files/large-images/
mv ц2.jpg ~/bardakov-large-files/large-images/
mv я.jpg ~/bardakov-large-files/large-images/
mv "кск (4).jpg" ~/bardakov-large-files/large-images/
mv ы2.jpg ~/bardakov-large-files/large-images/
mv ы3.jpg ~/bardakov-large-files/large-images/
mv ы4.jpg ~/bardakov-large-files/large-images/

# Этот файл в другой папке
cd ~/bardakov.rf/public_html/assets/images/dost/ 2>/dev/null && \
mv я111.jpg ~/bardakov-large-files/large-images/ 2>/dev/null
```

#### Шаг 6. Создать symlink'ы в public_html/

```bash
# Видео
ln -s ~/bardakov-large-files/video ~/bardakov.rf/public_html/assets/video

# Документы (большие)
ln -s ~/bardakov-large-files/documents ~/bardakov.rf/public_html/assets/docs-large

# Большие изображения
ln -s ~/bardakov-large-files/large-images ~/bardakov.rf/public_html/assets/images-large
```

Проверьте:
```bash
ls -la ~/bardakov.rf/public_html/assets/ | grep -E "video|docs-large|images-large"
```

Должны увидеть стрелочки `->`:
```
video -> /home/логин/bardakov-large-files/video
docs-large -> /home/логин/bardakov-large-files/documents
images-large -> /home/логин/bardakov-large-files/large-images
```

#### Шаг 7. Проверить через web

Откройте в браузере:
- `https://бардаков.рф/assets/video/Бардаков_самопризентация.mp4` — должно скачиваться видео
- `https://бардаков.рф/assets/docs-large/vospitanie/Устав-ГБПОУ-РО-СИТ-14.12.2018[1].pdf` — должен открыться PDF

Если работает — отлично! Переходите к Шагу 8.

#### Шаг 8. Сообщить ассистенту о завершении

Скажите ассистенту: **«Шаг 4 выполнен, файлы перенесены, symlink'и работают»**

Ассистент:
- Обновит `.gitignore` (Шаг 5)
- Создаст документацию `docs/large-files-strategy.md` (Шаг 6)

---

### Вариант B: Через файловый менеджер Beget (если нет SSH)

1. Войдите в панель управления Beget
2. Откройте **Файловый менеджер**
3. В домашней директории (рядом с `bardakov.rf/`) создайте папку `bardakov-large-files`
4. Внутри создайте подпапки: `video`, `documents/razgovor`, `documents/vospitanie`, `documents/obuchenie`, `large-images`, `archives`
5. Из папки `bardakov.rf/public_html/images/Animation/` перенесите `.mp4` файлы в `bardakov-large-files/video/`
6. Из `images/pdf/razgovor/` перенесите 5 больших PDF в `bardakov-large-files/documents/razgovor/`
7. И так далее по списку выше

⚠️ **Через файловый менеджер нельзя создать symlink** — для этого нужен SSH. Если используете файловый менеджер, попросите ассистента альтернативный подход (например, через `.htaccess` с `Alias`).

---

## 🚨 Возможные проблемы

### Проблема 1: Файлы не открываются через web после symlink

**Причина:** Apache не следует симлинкам по умолчанию.

**Решение:** В `.htaccess` добавить (или раскомментировать):
```apache
Options +FollowSymLinks
```

Это уже есть в стандартном `.htaccess` Joomla (см. `migration-source/server-config-analysis.md`).

### Проблема 2: 403 Forbidden при доступе к symlink

**Причина:** Неверные права на папку `~/bardakov-large-files/`.

**Решение:**
```bash
chmod 755 ~/bardakov-large-files
chmod -R 755 ~/bardakov-large-files/*
```

### Проблема 3: Файлы с пробелами и кириллицей в названии

При работе через SSH **обязательно** берите имена в кавычки:
```bash
mv "ДЕНЬ ЗНАНИЙ.pdf" ~/bardakov-large-files/documents/razgovor/
```

---

## ✅ Чек-лист выполнения

После выполнения отметьте в чек-листе:

- [ ] Создана структура папок `~/bardakov-large-files/{video,archives,documents/{razgovor,vospitanie,obuchenie},large-images}`
- [ ] Видео (2 файла) перенесены в `video/`
- [ ] Большие PDF (6 файлов) перенесены в `documents/{razgovor,vospitanie}/`
- [ ] Большие DOCX (2 файла) перенесены в `documents/obuchenie/`
- [ ] Большие изображения (10 файлов) перенесены в `large-images/`
- [ ] Symlink'и созданы в `public_html/assets/{video,docs-large,images-large}`
- [ ] Проверено: файлы открываются через web-браузер
- [ ] `.htaccess` содержит `Options +FollowSymLinks`
- [ ] Права на папки: 755

---

## 📞 Что делать после

Сообщите ассистенту, что задача выполнена. Он:
1. Обновит `.gitignore` (Шаг 5)
2. Создаст `docs/large-files-strategy.md` с описанием стратегии для ИИ-агента (Шаг 6)
3. Отметит в `ROADMAP_CHECKLIST.md` раздел 1.1.1 как завершённый
4. Перейдёт к Этапу 2 «Подготовка стека»
