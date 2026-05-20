# Чек-лист: Создание сайта бардаков.рф на простом HTML-стеке

> **Стек:** HTML5 + Bootstrap 5 (CDN) + Pagefind + JS-include  
> **Подробности:** см. INFO.md в этой же папке

---

## Этап 1. Подготовка ✅

- [x] Определён стек: HTML + Bootstrap CDN + Pagefind + JS-include
- [x] Создана структура папок проекта
- [x] Созданы базовые файлы: style.css, main.js, header.html, footer.html
- [x] Создан шаблон страницы (page-template.html)
- [x] Создана главная страница (index.html)
- [x] Создана страница поиска (search/index.html)
- [x] Создана страница 404
- [x] Созданы .htaccess, robots.txt, sitemap.xml

## Этап 2. Аудит текущего сайта (Joomla)

- [ ] Составить полный список всех страниц бардаков.рф с URL
- [ ] Сохранить текстовый контент каждой страницы
- [ ] Сохранить все изображения и вложения (PDF, DOC)
- [ ] Зафиксировать текущую структуру меню
- [ ] Записать мета-теги (description) для каждой страницы

## Этап 3. Создание страниц — Обо мне

- [ ] `/obo-mne/index.html` — Обо мне (обзорная)
- [ ] `/obo-mne/dostizheniya.html` — Достижения
- [ ] `/obo-mne/khobbi.html` — Хобби
- [ ] `/obo-mne/kontakty.html` — Контакты
- [ ] `/obo-mne/metodicheskaya-rabota.html` — Методическая работа

## Этап 4. Создание страниц — Обучение

- [ ] `/obuchenie/index.html` — Обучение (обзорная)
- [ ] `/obuchenie/elektromonter.html` — Электромонтер
- [ ] `/obuchenie/kip/index.html` — КИП
- [ ] `/obuchenie/kip/prakticheskie-kip.html` — Практические КИП
- [ ] `/obuchenie/ksk.html` — КСК
- [ ] `/obuchenie/pm02/lektsii/index.html` — ПМ.02 Лекции (список)
- [ ] `/obuchenie/pm02/lektsii/razdel-1.html` — Раздел 1
- [ ] `/obuchenie/pm02/lektsii/tema-1-1.html` — Тема 1.1
- [ ] `/obuchenie/pm02/lektsii/...` — Остальные темы лекций

## Этап 5. Создание страниц — Абитуриенту

- [ ] `/abiturientu/index.html` — Абитуриенту (обзорная)
- [ ] `/abiturientu/dokumentatsiya.html` — Документация
- [ ] `/abiturientu/professii/index.html` — Профессии (список)
- [ ] `/abiturientu/professii/08-01-07-master-obshchestroitelnykh-rabot.html`
- [ ] `/abiturientu/professii/13-01-10-elektromonter.html`
- [ ] `/abiturientu/professii/15-01-05-svarshchik.html`
- [ ] `/abiturientu/professii/15-01-31-master-kip.html`
- [ ] `/abiturientu/professii/43-01-09-povar-konditer.html`
- [ ] `/abiturientu/professii/prodavets-kontroler-kassir.html`
- [ ] `/abiturientu/spetsialnosti/index.html` — Специальности (список)
- [ ] `/abiturientu/spetsialnosti/ekonomika-i-bukhgalterskij-uchet.html`
- [ ] `/abiturientu/spetsialnosti/kompyuternye-sistemy-i-kompleksy.html`

## Этап 6. Создание страниц — Воспитание

- [ ] `/vospitanie/index.html` — Воспитание (обзорная)
- [ ] `/vospitanie/dlya-roditelej.html` — Для родителей
- [ ] `/vospitanie/razgovory-o-vazhnom.html` — Разговоры о важном

## Этап 7. Перенос медиафайлов

- [ ] Перенести изображения в `/assets/images/`
- [ ] Перенести PDF/DOC вложения в `/assets/docs/`
- [ ] Обновить ссылки на файлы в HTML-страницах
- [ ] Проверить, что все файлы открываются

## Этап 8. Поиск (Pagefind)

- [ ] Убедиться, что на всех страницах есть `data-pagefind-body` на `<main>`
- [ ] Установить Pagefind: `npx pagefind --site .` (из корня сайта)
- [ ] Проверить поиск: ввести запрос на `/search/`
- [ ] Проверить русский язык: поиск по кириллице работает
- [ ] Добавить `pagefind/` в `.gitignore` (уже добавлено)

## Этап 9. Настройка хостинга и деплой

- [ ] Загрузить файлы на хостинг (FTP / файловый менеджер)
- [ ] Настроить `.htaccess` (редиректы, кэширование)
- [ ] Настроить 301-редиректы со старых URL Joomla:
  - `/index.php/...` → `/...` (убрать index.php)
  - Старые URL → новые URL
- [ ] Запустить Pagefind на хостинге (или локально + загрузить индекс)
- [ ] Проверить сайт: все страницы открываются, поиск работает
- [ ] Проверить на мобильном: адаптивность, меню-бургер

## Этап 10. Финальная проверка

- [ ] Все внутренние ссылки работают (0 битых)
- [ ] Все файлы (PDF, DOC) скачиваются
- [ ] Поиск находит релевантные результаты
- [ ] Версия для слабовидящих работает (A+)
- [ ] 404-страница показывается для несуществующих URL
- [ ] Мобильная адаптивность — нет горизонтального скролла
- [ ] Favicon отображается в браузере

---

## Как добавить новую страницу (памятка)

1. Скопировать `assets/components/page-template.html` в нужную папку
2. Заменить: `ЗАМЕНИТЬ_ЗАГОЛОВОК`, `ЗАМЕНИТЬ_ОПИСАНИЕ`, `ЗАМЕНИТЬ_РАЗДЕЛ`
3. Заполнить контент внутри `<main data-pagefind-body>`
4. Обновить хлебные крошки
5. Добавить ссылку в `header.html` (если нужно)
6. Запустить `npx pagefind --site .`
7. Закоммитить и запушить

## Как обновить Pagefind-индекс

```bash
cd new-stack/site/
npx pagefind --site .
```

Папка `pagefind/` создастся автоматически. Она в `.gitignore`, не коммитится.
