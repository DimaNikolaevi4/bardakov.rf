<?php die("Access Denied"); ?>#x#a:5:{s:4:"body";s:10209:"<div class="com-finder finder">
        <div id="search-form" class="com-finder__form">
        
<form action="/search" method="get" class="js-finder-searchform">
        <fieldset class="com-finder__search word mb-3">
        <legend class="com-finder__search-legend visually-hidden">
            Форма поиска        </legend>
        <div class="form-inline">
            <label for="q" class="me-2">
                Поиск:            </label>
            <div class="input-group">
                <input type="text" name="q" id="q" class="js-finder-search-query form-control" value="">
                <button type="submit" class="btn btn-primary">
                    <span class="icon-search icon-white" aria-hidden="true"></span>
                    Поиск                </button>
                                                        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSearch" aria-expanded="true">
                        <span class="icon-search-plus" aria-hidden="true"></span>
                        Расширенные параметры</button>
                            </div>
        </div>
    </fieldset>

            <fieldset id="advancedSearch" class="com-finder__advanced js-finder-advanced collapse show">
            <legend class="com-finder__search-advanced visually-hidden">
                Расширенные параметры поиска            </legend>
                            <div class="com-finder__tips card card-outline-secondary mb-3">
                    <div class="card-body">
                        <p>Примеры использования функции поиска:</p>                        <p>Если ввести в поле поиска фразу <strong>Война и Мир</strong>, будут показаны элементы, содержащие и слово "Война", и слово "Мир".                        <p>Если ввести <strong>Война не Мир</strong> - элементы, содержащие слово "Война", но не содержащие слово "Мир".</p>                        <p>Если ввести <strong>Война или Мир</strong> - элементы, содержащие или слово "Война", или слово "Мир".</p>                                                <p>Результаты поиска можно ограничить с помощью фильтров по различным критериям.</p>                    </div>
                </div>
                        <div id="finder-filter-window" class="com-finder__filter">
                <ul id="finder-filter-select-dates"><li class="filter-date float-start"><label for="filter_date1" class="hasTooltip" title ="Введите или выберите в календаре дату начала.">Дата начала</label><br><label for="finder-filter-w1" class="visually-hidden">Оператор даты начала</label><select id="finder-filter-w1" name="w1" class="inputbox filter-date-operator advancedSelect form-select w-auto mb-2">
	<option value="before">До</option>
	<option value="exact">Точно</option>
	<option value="after">После</option>
</select>
<div class="field-calendar">
        <div class="input-group">
            <input
            type="text"
            id="filter_date1"
            name="d1"
            value=""
                        class="form-control input-medium"                                    data-alt-value="" autocomplete="off">
        <button type="button" class="btn btn-primary"
            id="filter_date1_btn"
            title="Открыть календарь"
            data-inputfield="filter_date1" data-button="filter_date1_btn" data-date-format="%Y-%m-%d" data-firstday="1" data-weekend="0,6" data-today-btn="1" data-week-numbers="1" data-show-time="0" data-show-others="1" data-time24="24" data-only-months-nav="0" data-min-year="" data-max-year="" data-date-type="gregorian"        ><span class="icon-calendar" aria-hidden="true"></span>
        <span class="visually-hidden">Открыть календарь</span>
        </button>
            </div>
        </div>
</li><li class="filter-date float-end"><label for="filter_date2" class="hasTooltip" title ="Введите или выберите в календаре дату завершения.">Дата завершения</label><br><label for="finder-filter-w2" class="visually-hidden">Оператор даты завершения</label><select id="finder-filter-w2" name="w2" class="inputbox filter-date-operator advancedSelect form-select w-auto mb-2">
	<option value="before">До</option>
	<option value="exact">Точно</option>
	<option value="after">После</option>
</select>
<div class="field-calendar">
        <div class="input-group">
            <input
            type="text"
            id="filter_date2"
            name="d2"
            value=""
                        class="form-control input-medium"                                    data-alt-value="" autocomplete="off">
        <button type="button" class="btn btn-primary"
            id="filter_date2_btn"
            title="Открыть календарь"
            data-inputfield="filter_date2" data-button="filter_date2_btn" data-date-format="%Y-%m-%d" data-firstday="1" data-weekend="0,6" data-today-btn="1" data-week-numbers="1" data-show-time="0" data-show-others="1" data-time24="24" data-only-months-nav="0" data-min-year="" data-max-year="" data-date-type="gregorian"        ><span class="icon-calendar" aria-hidden="true"></span>
        <span class="visually-hidden">Открыть календарь</span>
        </button>
            </div>
        </div>
</li></ul><div class="filter-branch"><div class="control-group"><div class="control-label"><label for="tax-type">Поиск по Тип</label></div><div class="controls"><select id="tax-type" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="9">Материалы</option>
	<option value="8">Категории</option>
	<option value="17">Контакты</option>
	<option value="3">Теги</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-author">Поиск по Автор</label></div><div class="controls"><select id="tax-author" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="10">Joomla</option>
	<option value="22">Бардаков Дмитрий Николаевич</option>
	<option value="5">преподаватель</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-language">Поиск по Язык</label></div><div class="controls"><select id="tax-language" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="7">Все</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-category">Поиск по Категория</label></div><div class="controls"><select id="tax-category" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="13">Blog</option>
	<option value="12">Help</option>
	<option value="14">Joomla</option>
	<option value="15">Typography</option>
	<option value="16">Uncategorised</option>
	<option value="23">Воспитание</option>
	<option value="24">Для родителей</option>
	<option value="25">Лекции</option>
	<option value="26">-Раздел 1</option>
	<option value="27">--Тема 1.1 Организация работ по монтажу систем автоматизации </option>
	<option value="29">Практические КИП</option>
	<option value="28">Разговоры о важном</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-region">Поиск по Регион</label></div><div class="controls"><select id="tax-region" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="19">Ростовская область</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-type">Поиск по Тип</label></div><div class="controls"><select id="tax-type" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="31">Материалы</option>
	<option value="41">Категории</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-author">Поиск по Автор</label></div><div class="controls"><select id="tax-author" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="33">Бардаков Дмитрий Николаевич</option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-category">Поиск по Категория</label></div><div class="controls"><select id="tax-category" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="42">Книга Roni Terram &laquo;Полудница&raquo;</option>
	<option value="43">Лекции</option>
	<option value="44">-Раздел 1</option>
	<option value="45">--Тема 1.1 Организация работ по монтажу систем автоматизации </option>
</select>
</div></div><div class="control-group"><div class="control-label"><label for="tax-language">Поиск по Язык</label></div><div class="controls"><select id="tax-language" name="t[]" class="form-select advancedSelect">
	<option value="" selected="selected">- Все -</option>
	<option value="39">Все</option>
</select>
</div></div></div>            </div>
        </fieldset>
    </form>
    </div>
        </div>
";s:4:"head";a:13:{s:5:"title";s:6:"Search";s:11:"description";N;s:4:"link";s:0:"";s:8:"metaTags";a:2:{s:10:"http-equiv";a:1:{s:12:"content-type";s:24:"text/html; charset=utf-8";}s:4:"name";a:1:{s:6:"rights";N;}}s:5:"links";a:3:{s:62:"https://www.xn--80aabgi1b2am.xn--p1ai/search?format=opensearch";a:3:{s:8:"relation";s:6:"search";s:7:"relType";s:3:"rel";s:7:"attribs";a:2:{s:5:"title";s:54:"Поиск Преподаватель Бардаков";s:4:"type";s:37:"application/opensearchdescription+xml";}}s:32:"/search?format=feed&amp;type=rss";a:3:{s:8:"relation";s:9:"alternate";s:7:"relType";s:3:"rel";s:7:"attribs";a:2:{s:4:"type";s:19:"application/rss+xml";s:5:"title";s:6:"Search";}}s:33:"/search?format=feed&amp;type=atom";a:3:{s:8:"relation";s:9:"alternate";s:7:"relType";s:3:"rel";s:7:"attribs";a:2:{s:4:"type";s:20:"application/atom+xml";s:5:"title";s:6:"Search";}}}s:11:"styleSheets";a:0:{}s:5:"style";a:0:{}s:7:"scripts";a:0:{}s:6:"script";a:0:{}s:6:"custom";a:0:{}s:10:"scriptText";a:47:{s:33:"COM_FINDER_SEARCH_FORM_LIST_LABEL";s:33:"Результаты поиска";s:24:"JLIB_JS_AJAX_ERROR_OTHER";s:111:"При получении данных JSON произошла ошибка. Код состояния HTTP %s.";s:24:"JLIB_JS_AJAX_ERROR_PARSE";s:203:"При обработке данных JSON произошла ошибка парсинга:<br><code style="color:inherit;white-space:pre-wrap;padding:0;margin:0;border:0;background:inherit;">%s</code>";s:6:"SUNDAY";s:22:"Воскресенье";s:6:"MONDAY";s:22:"Понедельник";s:7:"TUESDAY";s:14:"Вторник";s:9:"WEDNESDAY";s:10:"Среда";s:8:"THURSDAY";s:14:"Четверг";s:6:"FRIDAY";s:14:"Пятница";s:8:"SATURDAY";s:14:"Суббота";s:3:"SUN";s:4:"Вс";s:3:"MON";s:4:"Пн";s:3:"TUE";s:4:"Вт";s:3:"WED";s:4:"Ср";s:3:"THU";s:4:"Чт";s:3:"FRI";s:4:"Пт";s:3:"SAT";s:4:"Сб";s:7:"JANUARY";s:12:"января";s:8:"FEBRUARY";s:14:"февраля";s:5:"MARCH";s:10:"марта";s:5:"APRIL";s:12:"апреля";s:3:"MAY";s:6:"мая";s:4:"JUNE";s:8:"июня";s:4:"JULY";s:8:"июля";s:6:"AUGUST";s:14:"августа";s:9:"SEPTEMBER";s:16:"сентября";s:7:"OCTOBER";s:14:"октября";s:8:"NOVEMBER";s:12:"ноября";s:8:"DECEMBER";s:14:"декабря";s:13:"JANUARY_SHORT";s:6:"янв";s:14:"FEBRUARY_SHORT";s:6:"фев";s:11:"MARCH_SHORT";s:8:"март";s:11:"APRIL_SHORT";s:6:"апр";s:9:"MAY_SHORT";s:6:"мая";s:10:"JUNE_SHORT";s:8:"июнь";s:10:"JULY_SHORT";s:8:"июль";s:12:"AUGUST_SHORT";s:6:"авг";s:15:"SEPTEMBER_SHORT";s:6:"сен";s:13:"OCTOBER_SHORT";s:6:"окт";s:14:"NOVEMBER_SHORT";s:8:"нояб";s:14:"DECEMBER_SHORT";s:6:"дек";s:6:"JCLOSE";s:14:"Закрыть";s:6:"JCLEAR";s:16:"Очистить";s:24:"JLIB_HTML_BEHAVIOR_TODAY";s:14:"Сегодня";s:21:"JLIB_HTML_BEHAVIOR_WK";s:6:"Нед";s:21:"JLIB_HTML_BEHAVIOR_AM";s:2:"am";s:21:"JLIB_HTML_BEHAVIOR_PM";s:2:"pm";}s:13:"scriptOptions";a:2:{s:13:"finder-search";a:1:{s:3:"url";s:59:"/search?task=suggestions.suggest&format=json&tmpl=component";}s:12:"joomla.jtext";a:47:{s:33:"COM_FINDER_SEARCH_FORM_LIST_LABEL";s:33:"Результаты поиска";s:24:"JLIB_JS_AJAX_ERROR_OTHER";s:111:"При получении данных JSON произошла ошибка. Код состояния HTTP %s.";s:24:"JLIB_JS_AJAX_ERROR_PARSE";s:203:"При обработке данных JSON произошла ошибка парсинга:<br><code style="color:inherit;white-space:pre-wrap;padding:0;margin:0;border:0;background:inherit;">%s</code>";s:6:"SUNDAY";s:22:"Воскресенье";s:6:"MONDAY";s:22:"Понедельник";s:7:"TUESDAY";s:14:"Вторник";s:9:"WEDNESDAY";s:10:"Среда";s:8:"THURSDAY";s:14:"Четверг";s:6:"FRIDAY";s:14:"Пятница";s:8:"SATURDAY";s:14:"Суббота";s:3:"SUN";s:4:"Вс";s:3:"MON";s:4:"Пн";s:3:"TUE";s:4:"Вт";s:3:"WED";s:4:"Ср";s:3:"THU";s:4:"Чт";s:3:"FRI";s:4:"Пт";s:3:"SAT";s:4:"Сб";s:7:"JANUARY";s:12:"января";s:8:"FEBRUARY";s:14:"февраля";s:5:"MARCH";s:10:"марта";s:5:"APRIL";s:12:"апреля";s:3:"MAY";s:6:"мая";s:4:"JUNE";s:8:"июня";s:4:"JULY";s:8:"июля";s:6:"AUGUST";s:14:"августа";s:9:"SEPTEMBER";s:16:"сентября";s:7:"OCTOBER";s:14:"октября";s:8:"NOVEMBER";s:12:"ноября";s:8:"DECEMBER";s:14:"декабря";s:13:"JANUARY_SHORT";s:6:"янв";s:14:"FEBRUARY_SHORT";s:6:"фев";s:11:"MARCH_SHORT";s:8:"март";s:11:"APRIL_SHORT";s:6:"апр";s:9:"MAY_SHORT";s:6:"мая";s:10:"JUNE_SHORT";s:8:"июнь";s:10:"JULY_SHORT";s:8:"июль";s:12:"AUGUST_SHORT";s:6:"авг";s:15:"SEPTEMBER_SHORT";s:6:"сен";s:13:"OCTOBER_SHORT";s:6:"окт";s:14:"NOVEMBER_SHORT";s:8:"нояб";s:14:"DECEMBER_SHORT";s:6:"дек";s:6:"JCLOSE";s:14:"Закрыть";s:6:"JCLEAR";s:16:"Очистить";s:24:"JLIB_HTML_BEHAVIOR_TODAY";s:14:"Сегодня";s:21:"JLIB_HTML_BEHAVIOR_WK";s:6:"Нед";s:21:"JLIB_HTML_BEHAVIOR_AM";s:2:"am";s:21:"JLIB_HTML_BEHAVIOR_PM";s:2:"pm";}}s:12:"assetManager";a:2:{s:13:"registryFiles";a:5:{i:0;s:30:"media/vendor/joomla.asset.json";i:1;s:30:"media/system/joomla.asset.json";i:2;s:46:"media/plg_system_guidedtours/joomla.asset.json";i:3;s:34:"media/com_finder/joomla.asset.json";i:4;s:46:"media/plg_behaviour_compat6/removed.asset.json";}s:6:"assets";a:3:{s:5:"style";a:4:{i:0;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:17:"com_finder.finder";s:6:" * uri";s:25:"com_finder/finder.min.css";s:10:" * options";a:2:{s:4:"type";s:5:"style";s:11:"assetSource";a:1:{s:12:"registryFile";s:34:"media/com_finder/joomla.asset.json";}}s:13:" * attributes";a:0:{}s:15:" * dependencies";a:0:{}s:10:" * version";s:6:"ab077f";}i:1;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:11:"awesomplete";s:6:" * uri";s:34:"vendor/awesomplete/awesomplete.css";s:10:" * options";a:3:{s:4:"type";s:5:"style";s:7:"package";s:11:"awesomplete";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/vendor/joomla.asset.json";}}s:13:" * attributes";a:0:{}s:15:" * dependencies";a:0:{}s:10:" * version";s:5:"1.1.7";}i:2;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:16:"com_finder.dates";s:6:" * uri";s:24:"com_finder/dates.min.css";s:10:" * options";a:2:{s:4:"type";s:5:"style";s:11:"assetSource";a:1:{s:12:"registryFile";s:34:"media/com_finder/joomla.asset.json";}}s:13:" * attributes";a:0:{}s:15:" * dependencies";a:0:{}s:10:" * version";s:6:"e479b6";}i:3;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:14:"field.calendar";s:6:" * uri";s:26:"system/fields/calendar.css";s:10:" * options";a:2:{s:4:"type";s:5:"style";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/system/joomla.asset.json";}}s:13:" * attributes";a:0:{}s:15:" * dependencies";a:0:{}s:10:" * version";s:6:"5da368";}}s:6:"script";a:6:{i:0;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:17:"com_finder.finder";s:6:" * uri";s:24:"com_finder/finder.min.js";s:10:" * options";a:2:{s:4:"type";s:6:"script";s:11:"assetSource";a:1:{s:12:"registryFile";s:34:"media/com_finder/joomla.asset.json";}}s:13:" * attributes";a:1:{s:4:"type";s:6:"module";}s:15:" * dependencies";a:1:{i:0;s:4:"core";}s:10:" * version";s:6:"755761";}i:1;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:11:"awesomplete";s:6:" * uri";s:37:"vendor/awesomplete/awesomplete.min.js";s:10:" * options";a:3:{s:4:"type";s:6:"script";s:7:"package";s:11:"awesomplete";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/vendor/joomla.asset.json";}}s:13:" * attributes";a:1:{s:5:"defer";b:1;}s:15:" * dependencies";a:0:{}s:10:" * version";s:5:"1.1.7";}i:2;O:43:"Joomla\CMS\WebAsset\AssetItem\CoreAssetItem":6:{s:7:" * name";s:4:"core";s:6:" * uri";s:18:"system/core.min.js";s:10:" * options";a:3:{s:4:"type";s:6:"script";s:5:"class";s:13:"CoreAssetItem";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/system/joomla.asset.json";}}s:13:" * attributes";a:0:{}s:15:" * dependencies";a:0:{}s:10:" * version";s:6:"a3d8f8";}i:3;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:18:"bootstrap.collapse";s:6:" * uri";s:32:"vendor/bootstrap/collapse.min.js";s:10:" * options";a:3:{s:4:"type";s:6:"script";s:7:"package";s:9:"bootstrap";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/vendor/joomla.asset.json";}}s:13:" * attributes";a:1:{s:4:"type";s:6:"module";}s:15:" * dependencies";a:1:{i:0;s:4:"core";}s:10:" * version";s:5:"5.3.8";}i:4;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:21:"field.calendar.helper";s:6:" * uri";s:64:"system/fields/calendar-locales/date/gregorian/date-helper.min.js";s:10:" * options";a:1:{s:4:"type";s:6:"script";}s:13:" * attributes";a:1:{s:5:"defer";b:1;}s:15:" * dependencies";a:0:{}s:10:" * version";s:4:"auto";}i:5;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:14:"field.calendar";s:6:" * uri";s:29:"system/fields/calendar.min.js";s:10:" * options";a:2:{s:4:"type";s:6:"script";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/system/joomla.asset.json";}}s:13:" * attributes";a:1:{s:5:"defer";b:1;}s:15:" * dependencies";a:1:{i:0;s:21:"field.calendar.helper";}s:10:" * version";s:6:"b3233a";}}s:6:"preset";a:1:{i:0;O:32:"Joomla\CMS\WebAsset\WebAssetItem":6:{s:7:" * name";s:11:"awesomplete";s:6:" * uri";s:0:"";s:10:" * options";a:3:{s:4:"type";s:6:"preset";s:7:"package";s:11:"awesomplete";s:11:"assetSource";a:1:{s:12:"registryFile";s:30:"media/vendor/joomla.asset.json";}}s:13:" * attributes";a:0:{}s:15:" * dependencies";a:2:{i:0;s:17:"awesomplete#style";i:1;s:18:"awesomplete#script";}s:10:" * version";s:5:"1.1.7";}}}}}s:13:"mime_encoding";s:9:"text/html";s:7:"pathway";a:1:{i:0;O:8:"stdClass":2:{s:4:"name";s:6:"Search";s:4:"link";s:50:"index.php?option=com_finder&view=search&Itemid=115";}}s:6:"module";a:0:{}}