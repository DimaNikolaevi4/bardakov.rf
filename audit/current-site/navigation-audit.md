# Карта сайта и навигация: результат проверки

**Дата проверки:** 14 сентября 2026 года  
**Источник:** production HTML главной страницы — https://xn--80aabgi1b2am.xn--p1ai/  
**Дополнительный источник:** `audit/current-site/CHECKLIST.md` в репозитории

## Итог

Подтверждено **4 главных раздела**:

1. **Обо мне** — `/`
2. **Воспитание** — `/vospitanie`
3. **Обучение** — `/obuchenie`
4. **Абитуриенту** — `/abiturientu`

В production-меню зафиксировано 35 узлов: 4 главных раздела и 31 пункт/группа подменю. Пункты `Back`, которые Gantry добавляет для возврата в предыдущий уровень, не являются содержанием меню и исключены.

## Дерево подменю

### Обо мне

- Методическая работа — `/obo-mne/metodicheskaya-rabota`
- Достижения — `/obo-mne/dostizheniya`
- Хобби — `/obo-mne/khobbi`
- Контакты — `/obo-mne/kontakty`

### Воспитание

- Для родителей — `/vospitanie/dlya-roditelej`
- Разговоры о важном — `/vospitanie/razgovory-o-vazhnom`

### Обучение

- КИП — `/obuchenie/kip`
  - ПР КИП МДК01.05 — `/obuchenie/kip/prakticheskie-kip`
- КСК — `/obuchenie/ksk`
- пм02 — группа меню без собственного URL
  - Лекции — `/obuchenie/pm02/lektsii`
    - Раздел 1 — `/obuchenie/pm02/lektsii/razdel-1`
      - Тема 1.1 Организация работ по монтажу систем автоматизации — `/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii`
        - Подготовка к производству монтажных работ — `/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/podgotovka-k-proizvodstvu-montazhnykh-rabot`
        - Приемка объекта под монтаж — `/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/priemka-obekta-pod-montazh`
        - Наладка микропроцессорного модуля ввода аналоговых сигналов на примере измерительной системы температуры — `/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/naladka-mikroprotsessornogo-modulya-vvoda-analogovykh-signalov-na-primere-izmeritelnoj-sistemy-temperatury`
        - Работа в действующих установках, находящихся под давлением и в зоне высоких температур — `/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/rabota-v-dejstvuyushchikh-ustanovkakh-nakhodyashchikhsya-pod-davleniem-i-v-zone-vysokikh-temperatur`
- Материаловедение — PDF Viewer с внешней ссылкой на PDF
- ПР КОМПЬЮТЕРНОЕ МОДЕЛИРОВАНИЕ — `/../dok24/практосы комп модель1.doc`
- Электромонтер — `/obuchenie/elektromonter`

Все четыре темы внутри «Тема 1.1» имеют отдельные URL в production HTML и зафиксированы в CSV.

### Абитуриенту

- Специальности — группа меню без собственного URL
  - Компьютерные системы и комплексы — `/abiturientu/spetsialnosti/kompyuternye-sistemy-i-kompleksy`
  - Экономика и бухгалтерский учет (по отраслям) — `/abiturientu/spetsialnosti/ekonomika-i-bukhgalterskij-uchet-po-otraslyam`
- Профессии — группа меню без собственного URL
  - Продавец, контролер-кассир — `/abiturientu/professii/prodavets-kontroler-kassir`
  - Мастер общестроительных работ — `/abiturientu/professii/08-01-07-master-obshchestroitelnykh-rabot`
  - Повар, кондитер — `/abiturientu/professii/43-01-09-povar-konditer`
  - Сварщик ручной и частично механизированной сварки (наплавки) — `/abiturientu/professii/15-01-05-svarshchik-ruchnoj-i-chastichno-mekhanizirovannoj-svarki-naplavki`
  - Электромонтер по ремонту и обслуживанию электрооборудования — `/abiturientu/professii/13-01-10-elektromonter-po-remontu-i-obsluzhivaniyu-elektrooborudovaniya-po-otraslyam`
  - Мастер контрольно-измерительных приборов и автоматики — `/abiturientu/professii/15-01-31-master-kontrolno-izmeritelnykh-priborov-i-avtomatiki`
- Документация — `/abiturientu/dokumentatsiya`

## Статус пункта чек-листа

- [x] Подтвердить количество главных разделов.
- [x] Для каждого главного раздела записать все пункты подменю.

Подробная табличная фиксация находится в `audit/current-site/site-map.csv`.