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

## Этап 2. Аудит текущего сайта (Joomla) ✅

- [x] Составить полный список всех страниц бардаков.рф с URL (32+ страницы)
- [x] Сохранить текстовый контент каждой страницы
- [x] Сохранить все изображения и вложения (PDF, DOC) — выявлены пути, перенос в Этап 7
- [x] Зафиксировать текущую структуру меню (4 раздела: Обо мне, Обучение, Абитуриенту, Воспитание)
- [x] Записать мета-теги (description) для каждой страницы

### Аудит: структура сайта

| Раздел | Страниц | Примечание |
|---|---|---|
| Обо мне | 5 | обзорная + 4 подстраницы |
| Обучение | 16 | КИП (9 ПР), КСК, Электромонтер, ПМ.02 лекции |
| Абитуриенту | 12 | 6 профессий + 2 специальности + документация |
| Воспитание | 10 | Для родителей (6 статей), Разговоры о важном, Советы студентам |
| Служебные | 4 | Главная, 404, Поиск, Политика конфиденциальности |
| **Итого** | **47+** | |

## Этап 3. Создание страниц — Обо мне ✅

- [x] `/obo-mne/index.html` — Обо мне (обзорная с таймлайном карьеры, образования, жизненных событий)
- [x] `/obo-mne/metodicheskaya-rabota.html` — Методическая работа (28 документов за 2023-2024)
- [x] `/obo-mne/dostizheniya.html` — Достижения (галерея-заглушка 12 фото)
- [x] `/obo-mne/khobbi.html` — Хобби (Нейро Мульт Студия, книга «Полудница»)
- [x] `/obo-mne/kontakty.html` — Контакты (карточка + форма обратной связи)

## Этап 4. Создание страниц — Обучение ✅

- [x] `/obuchenie/index.html` — Обучение (обзорная с методическими указаниями)
- [x] `/obuchenie/elektromonter.html` — Электромонтер (13.01.10)
- [x] `/obuchenie/kip/index.html` — КИП (15.01.31, преимущества профессии)
- [x] `/obuchenie/kip/prakticheskie-kip.html` — ПР КИП МДК01.05 (список 9 работ)
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no1.html` — Расчет защитного заземления
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no2.html` — Расчёт аппаратуры защиты воздуха
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no3.html` — Идентификация вредных факторов
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no4.html` — Расчёт КЕО
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no5.html` — Оценка риска прямым методом
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no6.html` — Классификация несчастных случаев
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no7.html` — Антропогенные изменения
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no8.html` — Система контроля экол. безопасности
- [x] `/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no9.html` — Прогноз обстановки при взрывах
- [x] `/obuchenie/ksk.html` — КСК (09.02.01, карьерные пути)
- [x] `/obuchenie/pm02/lektsii/index.html` — ПМ.02 Лекции (обзор 5 разделов)
- [x] `/obuchenie/pm02/lektsii/razdel-1.html` — Раздел 1 (5 тем)

## Этап 5. Создание страниц — Абитуриенту ✅

- [x] `/abiturientu/index.html` — Абитуриенту (обзорная, 8 карточек)
- [x] `/abiturientu/dokumentatsiya.html` — Документация (приём, аккредитация, лицензия)
- [x] `/abiturientu/professii/index.html` — Профессии (список 6)
- [x] `/abiturientu/professii/08-01-07-master-obshchestroitelnykh-rabot.html` — Мастер общестроительных работ
- [x] `/abiturientu/professii/13-01-10-elektromonter.html` — Электромонтер
- [x] `/abiturientu/professii/15-01-05-svarshchik.html` — Сварщик
- [x] `/abiturientu/professii/15-01-31-master-kip.html` — Мастер КИПиА
- [x] `/abiturientu/professii/43-01-09-povar-konditer.html` — Повар, кондитер
- [x] `/abiturientu/professii/prodavets-kontroler-kassir.html` — Продавец, контролер-кассир
- [x] `/abiturientu/spetsialnosti/index.html` — Специальности (список 2)
- [x] `/abiturientu/spetsialnosti/kompyuternye-sistemy-i-kompleksy.html` — Компьютерные системы и комплексы
- [x] `/abiturientu/spetsialnosti/ekonomika-i-bukhgalterskij-uchet.html` — Экономика и бухгалтерский учет

## Этап 6. Создание страниц — Воспитание ✅

- [x] `/vospitanie/index.html` — Воспитание (обзорная, памятки, ресурсы)
- [x] `/vospitanie/dlya-roditelej.html` — Для родителей (6 карточек-ссылок)
- [x] `/vospitanie/dlya-roditelej/16-vazhnykh-pravil-pro-eto.html` — 16 ВАЖНЫХ Правил
- [x] `/vospitanie/dlya-roditelej/kak-ne-dopustit-suitsid-u-podrostka.html` — Как не допустить суицид
- [x] `/vospitanie/dlya-roditelej/prakticheskie-sovety-roditelyam-vo-vremya-ekzamena.html` — Советы во время экзамена
- [x] `/vospitanie/dlya-roditelej/nuzhno-li-obsuzhdat-s-rebenkom-temu-alkogolya-i-narkotikov.html` — Алкоголь и наркотики
- [x] `/vospitanie/dlya-roditelej/kak-pomoch-podrostku-spravlyatsya-so-stressom.html` — Подросток и стресс
- [x] `/vospitanie/dlya-roditelej/yuridicheskaya-otvetstvennost.html` — Юридическая ответственность
- [x] `/vospitanie/razgovory-o-vazhnom.html` — Разговоры о важном (9 месяцев, аккордеон)
- [x] `/vospitanie/prakticheskie-sovety-studentam.html` — Практические советы студентам

## Этап 7. Перенос медиафайлов

- [ ] Перенести изображения в `/assets/images/`
- [ ] Перенести PDF/DOC вложения в `/assets/docs/`
- [ ] Обновить ссылки на файлы в HTML-страницах
- [ ] Проверить, что все файлы открываются
- [ ] Добавить фотографии для галерей (Достижения, Воспитание, Лаборатории)

## Этап 8. Поиск (Pagefind)

- [ ] Убедиться, что на всех страницах есть `data-pagefind-body` на `<main>` ✅ (уже добавлено)
- [ ] Установить Pagefind: `npx pagefind --site .` (из корня сайта)
- [ ] Проверить поиск: ввести запрос на `/search/`
- [ ] Проверить русский язык: поиск по кириллице работает
- [ ] Добавить `pagefind/` в `.gitignore` ✅ (уже добавлено)

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

## Что ещё не сделано (требует участия владельца)

1. **Медиафайлы** — нужно скачать изображения и документы с хостинга и добавить в `/assets/images/` и `/assets/docs/`
2. **Фотографии для галерей** — заменить плейсхолдеры на реальные изображения
3. **Яндекс.Диск ссылки** — обновить ссылки на методические документы реальными URL
4. **Форма обратной связи** — подключить backend (Formspree / свой сервер)
5. **Дамп БД** — экспортировать из phpMyAdmin (этап 5 основного чеклиста)
6. **Pagefind индексация** — запустить после деплоя
7. **301-редиректы** — настроить на хостинге для SEO
8. **Политика конфиденциальности** — создать страницу `/private.html`
9. **Favicon** — добавить favicon.ico в корень сайта

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
