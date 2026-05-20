<?php die("Access Denied"); ?>#x#a:2:{s:4:"body";s:67862:"                                <!DOCTYPE html>
<html lang="ru-RU" dir="ltr">
        

<head>
<script type="text/javascript">  (function(){    function blockCookies(disableCookies, disableLocal, disableSession){    if(disableCookies == 1){    if(!document.__defineGetter__){    Object.defineProperty(document, 'cookie',{    get: function(){ return ''; },    set: function(){ return true;}    });    }else{    var oldSetter = document.__lookupSetter__('cookie');    if(oldSetter) {    Object.defineProperty(document, 'cookie', {    get: function(){ return ''; },    set: function(v){    if(v.match(/reDimCookieHint\=/) || v.match(/814e60ba5159f4f902fe9bb074943f08\=/)) {    oldSetter.call(document, v);    }    return true;    }    });    }    }    var cookies = document.cookie.split(';');    for (var i = 0; i < cookies.length; i++) {    var cookie = cookies[i];    var pos = cookie.indexOf('=');    var name = '';    if(pos > -1){    name = cookie.substr(0, pos);    }else{    name = cookie;    }    if(name.match(/reDimCookieHint/)) {    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT';    }    }    }    if(disableLocal == 1){    window.localStorage.clear();    window.localStorage.__proto__ = Object.create(window.Storage.prototype);    window.localStorage.__proto__.setItem = function(){ return undefined; };    }    if(disableSession == 1){    window.sessionStorage.clear();    window.sessionStorage.__proto__ = Object.create(window.Storage.prototype);    window.sessionStorage.__proto__.setItem = function(){ return undefined; };    }    }    blockCookies(1,1,1);    }());    </script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        

        
            
         <meta charset="utf-8">
	<meta name="author" content="Бардаков Дмитрий Николаевич">
	<meta name="generator" content="Joomla! - Open Source Content Management">
	<title>38.01.02 Продавец, контролер-кассир</title>
	<link href="https://www.xn--80aabgi1b2am.xn--p1ai/search?format=opensearch" rel="search" title="OpenSearch Преподаватель Бардаков" type="application/opensearchdescription+xml">
	<link href="/favicon.ico" rel="icon" type="image/vnd.microsoft.icon">

    <link href="/media/vendor/awesomplete/css/awesomplete.css?1.1.7" rel="stylesheet">
	<link href="/plugins/system/cookiehint/css/redimstyle.css?528d0a" rel="stylesheet">
	<link href="/media/gantry5/assets/css/lightcase.css" rel="stylesheet">
	<link href="/media/gantry5/engines/nucleus/css-compiled/nucleus.css" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/elixir_20.css?6a078a7c" rel="stylesheet">
	<link href="/media/gantry5/engines/nucleus/css-compiled/bootstrap5.css" rel="stylesheet">
	<link href="/media/system/css/joomla-fontawesome.min.css" rel="stylesheet">
	<link href="/media/plg_system_debug/css/debug.css" rel="stylesheet">
	<link href="/media/gantry5/assets/css/font-awesome6-pseudo.min.css" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/elixir-joomla_20.css?6a078a7d" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/custom_20.css" rel="stylesheet">
	<link href="/templates/rt_elixir/css/aos.css" rel="stylesheet">
	<style>
			.pdf-print-icon {
				float: right;
			}
		</style>
	<style>#redim-cookiehint-bottom {position: fixed; z-index: 99999; left: 0px; right: 0px; bottom: 0px; top: auto !important;}</style>

    <script type="application/json" class="joomla-script-options new">{"joomla.jtext":{"MOD_FINDER_SEARCH_VALUE":"Введите текст...","COM_FINDER_SEARCH_FORM_LIST_LABEL":"Результаты поиска","JLIB_JS_AJAX_ERROR_OTHER":"При получении данных JSON произошла ошибка. Код состояния HTTP %s.","JLIB_JS_AJAX_ERROR_PARSE":"При обработке данных JSON произошла ошибка парсинга:<br><code style=\"color:inherit;white-space:pre-wrap;padding:0;margin:0;border:0;background:inherit;\">%s<\/code>"},"finder-search":{"url":"\/component\/finder\/?task=suggestions.suggest&format=json&tmpl=component&Itemid=132"},"system.paths":{"root":"","rootFull":"https:\/\/www.xn--80aabgi1b2am.xn--p1ai\/","base":"","baseFull":"https:\/\/www.xn--80aabgi1b2am.xn--p1ai\/"},"csrf.token":"6dc718fc07ee08c222ffa94eda42dd10","accessibility-options":{"labels":{"menuTitle":"Панель доступности","increaseText":"Увеличить размер шрифта","decreaseText":"Уменьшить размер шрифта","increaseTextSpacing":"Увеличить интервал шрифта","decreaseTextSpacing":"Уменьшить интервал шрифта","invertColors":"Инвертировать цвета","grayHues":"Серые оттенки","underlineLinks":"Подчеркнуть ссылки","bigCursor":"Увеличить курсор","readingGuide":"Линейка для чтения","textToSpeech":"Преобразовать текст в речь","speechToText":"Преобразовать речь в текст","resetTitle":"Сбросить","closeTitle":"Закрыть"},"icon":{"position":{"left":{"size":"0","units":"px"}},"useEmojis":false},"hotkeys":{"enabled":true,"helpTitles":true},"textToSpeechLang":["ru-RU"],"speechToTextLang":["ru-RU"]},"plg_system_schedulerunner":{"interval":300}}</script>
	<script src="/media/system/js/core.min.js?a3d8f8"></script>
	<script src="/media/vendor/awesomplete/js/awesomplete.min.js?1.1.7" defer></script>
	<script src="/media/com_finder/js/finder.min.js?755761" type="module"></script>
	<script src="/media/vendor/jquery/js/jquery.min.js?3.7.1"></script>
	<script src="/media/vendor/jquery/js/jquery-noconflict.min.js?3.7.1"></script>
	<script src="/media/vendor/accessibility/js/accessibility.min.js?3.0.17" defer></script>
	<script src="/media/plg_system_schedulerunner/js/run-schedule.min.js?229d3b" type="module"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script src="/templates/rt_elixir/js/aos.js"></script>
	<script type="application/ld+json">{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/Organization/base","name":"Преподаватель Бардаков","url":"https://www.xn--80aabgi1b2am.xn--p1ai/"},{"@type":"WebSite","@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/WebSite/base","url":"https://www.xn--80aabgi1b2am.xn--p1ai/","name":"Преподаватель Бардаков","publisher":{"@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/Organization/base"},"potentialAction":{"@type":"SearchAction","target":"https://www.xn--80aabgi1b2am.xn--p1ai/search?q={search_term_string}","query-input":"required name=search_term_string"}},{"@type":"WebPage","@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/WebPage/base","url":"https://www.xn--80aabgi1b2am.xn--p1ai/abiturientu/professii/prodavets-kontroler-kassir","name":"38.01.02 Продавец, контролер-кассир","isPartOf":{"@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/WebSite/base"},"about":{"@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/Organization/base"},"inLanguage":"ru-RU"},{"@type":"Article","@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/com_content/article/13","name":"38.01.02 Продавец, контролер-кассир","headline":"38.01.02 Продавец, контролер-кассир","inLanguage":"ru-RU","isPartOf":{"@id":"https://www.xn--80aabgi1b2am.xn--p1ai/#/schema/WebPage/base"}}]}</script>
	<script type="module">window.addEventListener("load", function() {new Accessibility(Joomla.getOptions("accessibility-options") || {});});</script>
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(98275481, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/98275481" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<link rel="canonical" href="https://бардаков.рф/abiturientu/professii/prodavets-kontroler-kassir" />
</head>


    <body class="gantry site com_content view-article no-layout no-task dir-ltr itemid-140 outline-20 g-offcanvas-left g-default g-style-preset3">
        
                    

        <div id="g-offcanvas"  data-g-offcanvas-swipe="0" data-g-offcanvas-css3="1">
                        <div class="g-grid">                        

        <div class="g-block size-100">
             <div id="mobile-menu-2576-particle" class="g-content g-particle">            <div id="g-mobilemenu-container" data-g-menu-breakpoint="51rem"></div>
            </div>
        </div>
            </div>
    </div>
        <div id="g-page-surround">
            <div class="g-offcanvas-hide g-offcanvas-toggle" role="navigation" data-offcanvas-toggle aria-controls="g-offcanvas" aria-expanded="false"><i class="fa fa-fw fa-bars"></i></div>                        

                                            
                <section id="g-top">
                                        <div class="g-grid">                        

        <div class="g-block size-100">
             <div class="g-system-messages">
                                            
<div id="system-message-container">
    </div>

            
    </div>
        </div>
            </div>
            
    </section>
                                        
                <section id="g-navigation">
                                        <div class="g-grid">                        

        <div class="g-block size-20">
             <div class="g-content">
                                    <div class="platform-content"><search>
    <form class="mod-finder js-finder-searchform form-search" action="/search" method="get" aria-label="search">
        <label for="mod-finder-searchword204" class="visually-hidden finder">Поиск</label><input type="text" name="q" id="mod-finder-searchword204" class="js-finder-search-query form-control" value="" placeholder="Введите текст...">
                            </form>
</search></div>
            
        </div>
        </div>
                    

        <div class="g-block size-80">
             <div id="menu-4282-particle" class="g-content g-particle">            <nav class="g-main-nav" data-g-hover-expand="true">
        <ul class="g-toplevel">
                                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-132 g-parent g-standard g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Обо мне</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-right">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-1 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-153  ">
                            <a class="g-menu-item-container" href="/obo-mne/metodicheskaya-rabota">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Методическая работа</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-133  ">
                            <a class="g-menu-item-container" href="/obo-mne/dostizheniya">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Достижения</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-341  ">
                            <a class="g-menu-item-container" href="/obo-mne/khobbi">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Хобби</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-155  ">
                            <a class="g-menu-item-container" href="/obo-mne/kontakty">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Контакты</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-134 g-parent g-standard g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/vospitanie">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Воспитание</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-right">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-1 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-154  ">
                            <a class="g-menu-item-container" href="/vospitanie/dlya-roditelej">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Для родителей</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-200  ">
                            <a class="g-menu-item-container" href="/vospitanie/razgovory-o-vazhnom">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Разговоры о важном</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-135 g-parent g-standard g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/obuchenie">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Обучение</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-right">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-1 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-188 g-parent g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/obuchenie/kip">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">КИП</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-2 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-202  ">
                            <a class="g-menu-item-container" href="/obuchenie/kip/prakticheskie-kip">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">ПР КИП МДК01.05</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-335  ">
                            <a class="g-menu-item-container" href="/obuchenie/ksk">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">КСК</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-separator g-menu-item-166 g-parent  ">
                            <div class="g-menu-item-container" data-g-menuparent="">                                                                            <span class="g-separator g-menu-item-content">            <span class="g-menu-item-title">пм02</span>
            </span>
                                        <span class="g-menu-parent-indicator"></span>                            </div>                                                                <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-2 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-167 g-parent g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Лекции</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-3 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-168 g-parent g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii/razdel-1">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Раздел 1</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-4 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-170 g-parent g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Тема 1.1 Организация работ по монтажу систем автоматизации</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-right">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-5 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-171  ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/podgotovka-k-proizvodstvu-montazhnykh-rabot">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Подготовка к производству монтажных работ</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-172  ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/priemka-obekta-pod-montazh">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Приемка объекта под монтаж</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-390  ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/naladka-mikroprotsessornogo-modulya-vvoda-analogovykh-signalov-na-primere-izmeritelnoj-sistemy-temperatury">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Наладка микропроцессорного модуля ввода аналоговых сигналов на примере измерительной системы температуры</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-310  ">
                            <a class="g-menu-item-container" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/rabota-v-dejstvuyushchikh-ustanovkakh-nakhodyashchikhsya-pod-davleniem-i-v-zone-vysokikh-temperatur">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Работа в действующих установках, находящихся под давлением и в зоне высоких температур</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
                                                                                                                                
                
        
                
        
        <li class="g-menu-item g-menu-item-type-url g-menu-item-296  ">
                            <a class="g-menu-item-container" href="https://бардаков.рф/plugins/content/pdfviewer/assets/pdfjs/web/viewer.html?file=https://бардаков.рф/images/pdf/obychen/materialovedenie_kurs_lektsiy_.pdf" target="_blank" rel="noopener&#x20;noreferrer">
                                                <i class="far fa-file-pdf" aria-hidden="true"></i>
                                                    <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Материаловедение</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-url g-menu-item-311  ">
                            <a class="g-menu-item-container" href="/../dok24/практосы комп модель1.doc">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">ПР КОМПЬЮТЕРНОЕ МОДЕЛИРОВАНИЕ</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-189  ">
                            <a class="g-menu-item-container" href="/obuchenie/elektromonter">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Электромонтер</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-136 g-parent active g-standard g-menu-item-link-parent ">
                            <a class="g-menu-item-container" href="/abiturientu">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Абитуриенту</span>
            
                    </span>
                    <span class="g-menu-parent-indicator" data-g-menuparent=""></span>                            </a>
                                                                            <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-1 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-heading g-menu-item-137 g-parent  ">
                            <div class="g-menu-item-container" data-g-menuparent="">                                                                            <span class="g-nav-header g-menu-item-content">            <span class="g-menu-item-title">Специальности</span>
            </span>
                                        <span class="g-menu-parent-indicator"></span>                            </div>                                                                <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-2 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-146  ">
                            <a class="g-menu-item-container" href="/abiturientu/spetsialnosti/kompyuternye-sistemy-i-kompleksy">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Компьютерные системы и комплексы</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-147  ">
                            <a class="g-menu-item-container" href="/abiturientu/spetsialnosti/ekonomika-i-bukhgalterskij-uchet-po-otraslyam">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Экономика и бухгалтерский учет (по отраслям)</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-heading g-menu-item-138 g-parent active  ">
                            <div class="g-menu-item-container" data-g-menuparent="">                                                                            <span class="g-nav-header g-menu-item-content">            <span class="g-menu-item-title">Профессии</span>
            </span>
                                        <span class="g-menu-parent-indicator"></span>                            </div>                                                                <ul class="g-dropdown g-inactive g-fade g-dropdown-left">
            <li class="g-dropdown-column">
                        <div class="g-grid">
                        <div class="g-block size-100">
            <ul class="g-sublevel">
                <li class="g-level-2 g-go-back">
                    <a class="g-menu-item-container" href="#" data-g-menuparent=""><span>Back</span></a>
                </li>
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-140 active  ">
                            <a class="g-menu-item-container" href="/abiturientu/professii/prodavets-kontroler-kassir">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Продавец, контролер-кассир</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-141  ">
                            <a class="g-menu-item-container" href="/abiturientu/professii/08-01-07-master-obshchestroitelnykh-rabot">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Мастер общестроительных работ</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-142  ">
                            <a class="g-menu-item-container" href="/abiturientu/professii/43-01-09-povar-konditer">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Повар, кондитер</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-143  ">
                            <a class="g-menu-item-container" href="/abiturientu/professii/15-01-05-svarshchik-ruchnoj-i-chastichno-mekhanizirovannoj-svarki-naplavki">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Сварщик ручной и частично механизированной сварки (наплавки)</span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-144  ">
                            <a class="g-menu-item-container" href="/abiturientu/professii/13-01-10-elektromonter-po-remontu-i-obsluzhivaniyu-elektrooborudovaniya-po-otraslyam">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Электромонтер по ремонту и обслуживанию электрооборудования </span>
            
                    </span>
                                                </a>
                                </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-145  ">
                            <a class="g-menu-item-container" href="/abiturientu/professii/15-01-31-master-kontrolno-izmeritelnykh-priborov-i-avtomatiki">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Мастер контрольно-измерительных приборов и автоматики</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-139  ">
                            <a class="g-menu-item-container" href="/abiturientu/dokumentatsiya">
                                                                <span class="g-menu-item-content">
                                    <span class="g-menu-item-title">Документация</span>
            
                    </span>
                                                </a>
                                </li>
    
    
            </ul>
        </div>
            </div>

            </li>
        </ul>
            </li>
    
    
        </ul>
    </nav>
            </div>
        </div>
            </div>
            
    </section>
                                    
                                
    
    
                <section id="g-container-main" class="g-wrapper">
                            <div class="g-grid">                        

        <div class="g-block size-100">
             <main id="g-mainbar" class="section-horizontal-paddings">
                                        <div class="g-grid">                        

        <div class="g-block size-100">
             <div class="g-content">
                                                            <div class="platform-content container"><div class="row"><div class="col"><div class="com-content-article""><div class="pdf-print-icon"><a class="btn btn-danger" href="/abiturientu/professii/prodavets-kontroler-kassir?tmpl=component&amp;format=pdf" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); return false;" target=""><span class="glyphicon glyphicon-file icon-file"></span> PDF</a></div>
    <meta itemprop="inLanguage" content="ru-RU">
    
    
        <div class="page-header">
        <h1>
            38.01.02 Продавец, контролер-кассир        </h1>
                            </div>
        
        
    
    
        
                                                <div class="com-content-article__body">
        <ul>
<li><strong>Срок обучения:</strong>   На базе 9 класса - 2 года 10 месяцев</li>
<li><strong>Форма обучения:</strong>    Очная</li>
<li><strong>Будущая квалификация:</strong>    Контролер-кассир | Продавец непродовольственных товаров | Продавец продовольственных товаров</li>
<li><strong>Будущие профессии:  </strong>Кассир торгового зала | Контролер-кассир | Продавец непродовольственных товаров | Продавец продовольственных товаров</li>
</ul>
<p> </p>
<h4 style="text-align: center;"><br />Чему научат?</h4>
<ul>
<li style="text-align: left;">Вести продажу непродовольственных товаров</li>
<li style="text-align: left;">Проверять качество, комплектность, количественные характеристики непродовольственных товаров</li>
<li style="text-align: left;">Размещать товар в торговом зале и делать выкладку на торгово-технологическом оборудовании</li>
<li style="text-align: left;">Обслуживать покупателей и предоставлять достоверную информацию о качестве, потребительских свойствах товаров, требованиях безопасности их эксплуатации</li>
<li style="text-align: left;">Контролировать сохранность товарно-материальных ценностей</li>
<li style="text-align: left;">Принимать товар и контролировать наличие сопроводительных документов на поступившие товары</li>
<li style="text-align: left;">Готовить продовольственные товары к продаже, размещать их и выкладывать</li>
<li style="text-align: left;">Обслуживать покупателей, консультировать их о пищевой ценности, свойствах и вкусовых особенностях продовольственных товаров</li>
<li style="text-align: left;">Соблюдать условия хранения, сроки годности, сроки хранения и сроки реализации продуктов</li>
<li style="text-align: left;">Пользоваться торгово-технологическим оборудованием</li>
<li style="text-align: left;">Изучать спрос покупателей</li>
<li style="text-align: left;">Правильно пользоваться контрольно-кассовой техникой и выполнять расчетные операции с покупателями</li>
<li style="text-align: left;">Проверять платежеспособность государственных денежных знаков</li>
<li style="text-align: left;">Проверять качество и количество продаваемых товаров, качество упаковки, наличие маркировки, правильность цен на товары и услуги</li>
<li style="text-align: left;">Оформлять документы по кассовым операциям</li>
<li style="text-align: left;">Контролировать сохранность товарно-материальных ценностей</li>
</ul>     </div>

        
                                        </div></div></div></div>
    
            
    </div>
        </div>
            </div>
            
    </main>
        </div>
            </div>
    
    </section>
    
                                        
                <section id="g-expanded">
                                        <div class="g-grid">                        

        <div class="g-block size-100 smallmargintop smallmarginbottom smallpaddingbottom smallpaddingtop">
             <div class="g-content">
                                    <div id="module-flipster-127-particle" class="g-particle"><div class="">
        
        <div id="module-flipster-127" data-flipster-id="module-flipster-127" data-flipster-start="center" data-flipster-fadein="400" data-flipster-loop="false" data-flipster-autoplay="false" data-flipster-pauseonhover="true" data-flipster-style="coverflow" data-flipster-spacing="-0.2" data-flipster-click="true" data-flipster-keyboard="true" data-flipster-scrollwheel="false"  data-flipster-touch="true" class="g-flipster">
            <div class="g-flipster-cards">
                                                            <div class="g-flipster-card g-flipster-card-accent-white" style="width: 500px;">
                            <div class="g-flipster-card-container g-flipster-card-image">
                                                                    <img src="/images/abiturientu/professii/prodavec/65JHddlJPa4.jpg" alt="gantry-media://abiturientu/professii/prodavec/65JHddlJPa4.jpg" />
                                                            </div>
                        </div>
                                            <div class="g-flipster-card g-flipster-card-accent-white" style="width: 500px;">
                            <div class="g-flipster-card-container g-flipster-card-image">
                                                                    <img src="/images/abiturientu/professii/prodavec/odY8UY4D2Fc.jpg" alt="gantry-media://abiturientu/professii/prodavec/odY8UY4D2Fc.jpg" />
                                                            </div>
                        </div>
                                            <div class="g-flipster-card g-flipster-card-accent-white" style="width: 500px;">
                            <div class="g-flipster-card-container g-flipster-card-image">
                                                                    <img src="/images/abiturientu/professii/prodavec/raDugOucybY.jpg" alt="gantry-media://abiturientu/professii/prodavec/raDugOucybY.jpg" />
                                                            </div>
                        </div>
                                            <div class="g-flipster-card g-flipster-card-accent-white" style="width: 500px;">
                            <div class="g-flipster-card-container g-flipster-card-image">
                                                                    <img src="/images/abiturientu/professii/prodavec/6u97jwvSfwY.jpg" alt="gantry-media://abiturientu/professii/prodavec/6u97jwvSfwY.jpg" />
                                                            </div>
                        </div>
                                            <div class="g-flipster-card g-flipster-card-accent-white" style="width: 500px;">
                            <div class="g-flipster-card-container g-flipster-card-image">
                                                                    <img src="/images/abiturientu/professii/prodavec/pr.png" alt="gantry-media://abiturientu/professii/prodavec/pr.png" />
                                                            </div>
                        </div>
                                            <div class="g-flipster-card g-flipster-card-accent-white" style="width: 500px;">
                            <div class="g-flipster-card-container g-flipster-card-image">
                                                                    <img src="/images/abiturientu/professii/prodavec/wPLZr6l-U0A.jpg" alt="gantry-media://abiturientu/professii/prodavec/wPLZr6l-U0A.jpg" />
                                                            </div>
                        </div>
                                                </div>
        </div>
    </div></div>
            
        </div>
        </div>
            </div>
            
    </section>
                                        
                <section id="g-extension">
                                        <div class="g-grid">                        

        <div class="g-block size-100">
             <div class="g-content">
                                    <div class="platform-content"><div id="mod-custom124" class="mod-custom custom">
    <h4>Важные учебные предметы</h4>
<p>Безопасность жизнедеятельности | Организация и технология розничной торговли | Основы бухгалтерского учета | Основы деловой культуры | Розничная торговля непродовольственными товарами | Розничная торговля продовольственными товарами | Санитария и гигиена | Эксплуатация контрольно-кассовой техники</p></div></div><div id="module-imagegrid-122-particle" class="g-particle"><h2 class="g-title">Материально-техническое обеспечение и оснащенность образовательного процесса</h2>
    <div class="g-imagegrid 0">

        
        <div class="g-imagegrid-wrapper g-imagegrid-2cols g-imagegrid-standard">
                            <div class="g-imagegrid-item">
                    <a class="g-imagegrid-link" href="/images/abiturientu/professii/prodavec/Kabinet-ekonomiki-menedzmenta-finansov-deneznogo-obrasenia-i-kredita.jpg" data-rel="lightcase">
                                                <img src="/images/abiturientu/professii/prodavec/Kabinet-ekonomiki-menedzmenta-finansov-deneznogo-obrasenia-i-kredita.jpg" alt="Кабинет экономики менеджмента финансов денежного-обращения и кредита" />
                        <div class="indicator">
                            <div>
                                                                    Кабинет экономики менеджмента финансов денежного-обращения и кредита
                                                            </div>
                        </div>
                    </a>
                </div>
                            <div class="g-imagegrid-item">
                    <a class="g-imagegrid-link" href="/images/abiturientu/professii/prodavec/Ucebnyj-magazin-2-1024x768.jpg" data-rel="lightcase">
                                                <img src="/images/abiturientu/professii/prodavec/Ucebnyj-magazin-2-1024x768.jpg" alt="Учебный магазин" />
                        <div class="indicator">
                            <div>
                                                                    Учебный магазин
                                                            </div>
                        </div>
                    </a>
                </div>
            
        </div>
    </div></div>
            
        </div>
        </div>
            </div>
            
    </section>
                                        
                <section id="g-bottom">
                                        <div class="g-grid">                        

        <div class="g-block size-100">
             <div class="g-content">
                                    <div class="platform-content"><div id="mod-custom125" class="mod-custom custom">
    <div class="g-simplecontent-item g-simplecontent-layout-standard">
<h4 class="g-simplecontent-item-content-title">Практика студентов</h4>
<div class="g-simplecontent-item-main-content">Учебная (производственное обучение) и производственная практики являются обязательной частью образовательной программы</div>
</div>
<div class="g-simplecontent-item g-simplecontent-layout-standard">
<h4 class="g-simplecontent-item-content-title">Итоговая аттестация студентов</h4>
<div class="g-simplecontent-item-main-content">Защита выпускной квалификационной работы (выпускная практическая квалификационная работа и письменная экзаменационная работа)</div>
</div></div></div>
            
        </div>
        </div>
            </div>
            
    </section>
                                    
                                
    
    
                <section id="g-container-footer" class="g-wrapper">
                            <div class="g-grid">                        

        <div class="g-block size-100 center">
             <footer id="g-footer">
                                        <div class="g-grid">                        

        <div class="g-block size-100">
             <div class="g-content">
                                    <div id="module-video-126-particle" class="g-particle"><div class="g-video-container g-video-container-columns-1 " >
        
    <div class="g-video-inner">
        <div id="g-module-video-126-1" data-g-video-id="g-module-video-126-1"  class="g-video">
            
                        <iframe width="100%" height="auto" src="https://www.youtube.com/embed/qHoyU29-KDM?showinfo=0&amp;autoplay=0&amp;controls=1&amp;loop=1&amp;playlist=qHoyU29-KDM&amp;rel=0&amp;mute=1&amp;start=0" frameborder="0" allowfullscreen></iframe>
            
            
                
                                            </div>
                                            </div>
                                    </div></div>
            
        </div>
        </div>
            </div>
            
    </footer>
                                                        
                <section id="g-copyright" class="section-horizontal-paddings">
                                        <div class="g-grid">                        

        <div class="g-block size-100 center">
             <div id="social-5145-particle" class="g-content g-particle">            <div class="g-social ">
                <div class="g-social-items">
                            <a target="_blank" href="https://vk.com/id514588431" title="ВКонтакте Бардаков Дмитрий Николаевич" aria-label="ВКонтакте Бардаков Дмитрий Николаевич">
                    <span class="fa fa-vk"></span>                                    </a>
                            <a target="_blank" href="https://sit-salsk.ru/" title="ГБПОУ РО &quot;СИТ&quot;" aria-label="ГБПОУ РО &quot;СИТ&quot;">
                    <span class="fa fa-mail-forward"></span>                                    </a>
                            <a target="_blank" href="https://эос.сит-сальск.рф/" title="Электронная образовательная система ГБПОУ РО &quot;СИТ&quot;" aria-label="Электронная образовательная система ГБПОУ РО &quot;СИТ&quot;">
                    <span class="fas fa-graduation-cap"></span>                                    </a>
                            <a target="_blank" href="https://sit-salsk.ru/?p=15146" title="нормативно-правовая база ГБПОУ РО &quot;СИТ&quot;" aria-label="нормативно-правовая база ГБПОУ РО &quot;СИТ&quot;">
                    <span class="fa fa-legal"></span>                                    </a>
                            <a target="_blank" href="https://донмолодой.рф/" title="Дон молодой" aria-label="Дон молодой">
                    <span class="fa fa-child"></span>                                    </a>
                            <a target="_blank" href="https://minobr.donland.ru/" title="Министерство общего и профессионального образования Ростовской области" aria-label="Министерство общего и профессионального образования Ростовской области">
                    <span class="fa fa-handshake-o"></span>                                    </a>
                            <a target="_blank" href="https://dobro.ru/" title="Я доброволец" aria-label="Я доброволец">
                    <span class="fa fa-users"></span>                                    </a>
                            <a target="_blank" href="https://живунадону.рф/" title="Живу на Дону" aria-label="Живу на Дону">
                    <span class="fa fa-map-o"></span>                                    </a>
                            <a target="_blank" href="https://vk.com/sitsalsksit" title="ВКонтакте ГБПОУ РО &quot;СИТ&quot;" aria-label="ВКонтакте ГБПОУ РО &quot;СИТ&quot;">
                    <span class="fa fa-vk"></span>                                    </a>
                            <a target="_blank" href="https://t.me/Neuro_Animation_Studio" title="хобби - Нейро Мульт Студия" aria-label="хобби - Нейро Мульт Студия">
                    <span class="fab fa-telegram"></span>                                    </a>
                    </div>
    </div>
            </div>
        </div>
            </div>
                            <div class="g-grid">                        

        <div class="g-block size-100 center">
             <div id="custom-8921-particle" class="g-content g-particle">            Все фотографии и файлы размещены с письменного согласия детей и родителей (законных представителей) согласно ст. 151 ГК РФ
            </div>
        </div>
            </div>
                            <div class="g-grid">                        

        <div class="g-block size-100 center">
             <div id="copyright-7556-particle" class="g-content g-particle">            &copy;
    2022 -     2026
    Преподаватель высшей категории Сальского индустриального техникума Бардаков Дмитрий Николаевич
            </div>
        </div>
            </div>
            
    </section>
        </div>
            </div>
    
    </section>
    
                                
                        

        </div>
                    

                        <script type="text/javascript" src="/media/gantry5/assets/js/main.js"></script>
    <script type="text/javascript" src="/media/gantry5/assets/js/lightcase.js"></script>
    <script type="text/javascript">jQuery(document).ready(function($) { jQuery('[data-rel^=lightcase]').lightcase({maxWidth: '100%', maxHeight: '100%', video: {width: '1280', height: '720'}}); });</script>
    <script type="text/javascript" src="/templates/rt_elixir/js/jquery.flipster.js"></script>
    <script type="text/javascript" src="/templates/rt_elixir/js/jquery.flipster.init.js"></script>
    <script type="text/javascript" src="/templates/rt_elixir/js/video.init.js"></script>
    <script type="text/javascript">	AOS.init({

	duration: 1000,
	once: 1,
	delay: 0,
	easing: 'ease',
	offset: 120,

	});
</script>
    

    

        
    
<script type="text/javascript">   function cookiehintsubmitnoc(obj) {     if (confirm("A refusal will affect the functions of the website. Do you really want to decline?")) {       document.cookie = 'reDimCookieHint=-1; expires=0; path=/';       cookiehintfadeOut(document.getElementById('redim-cookiehint-bottom'));       return true;     } else {       return false;     }   } </script> <div id="redim-cookiehint-bottom">   <div id="redim-cookiehint">     <div class="cookiehead">       <span class="headline">Мы используем файлы cookie</span>     </div>     <div class="cookiecontent">   Мы используем файлы cookie для улучшения вашего взаимодействия на нашем веб-сайте. Просматривая этот веб-сайт, вы соглашаетесь на использование нами файлов cookie.    </div>     <div class="cookiebuttons">       <a id="cookiehintsubmit" onclick="return cookiehintsubmit(this);" href="https://www.xn--80aabgi1b2am.xn--p1ai/abiturientu/professii/prodavets-kontroler-kassir?rCH=2"         class="btn">Принять</a>           <a id="cookiehintsubmitno" onclick="return cookiehintsubmitnoc(this);" href="https://www.xn--80aabgi1b2am.xn--p1ai/abiturientu/professii/prodavets-kontroler-kassir?rCH=-2"           class="btn">Отклонить</a>          <div class="text-center" id="cookiehintinfo">              <a target="_self" href="https://бардаков.рф/private">Политика в отношении обработки персональных данных</a>                     </div>      </div>     <div class="clr"></div>   </div> </div>     <script type="text/javascript">        if (!navigator.cookieEnabled) {         document.addEventListener("DOMContentLoaded", function (event) {           document.getElementById('redim-cookiehint-bottom').remove();         });       }        function cookiehintfadeOut(el) {         el.style.opacity = 1;         (function fade() {           if ((el.style.opacity -= .1) < 0) {             el.style.display = "none";           } else {             requestAnimationFrame(fade);           }         })();       }             function cookiehintsubmit(obj) {         document.cookie = 'reDimCookieHint=1; expires=Sun, 16 May 2027 23:59:59 GMT;; path=/';         cookiehintfadeOut(document.getElementById('redim-cookiehint-bottom'));         return true;       }        function cookiehintsubmitno(obj) {         document.cookie = 'reDimCookieHint=-1; expires=0; path=/';         cookiehintfadeOut(document.getElementById('redim-cookiehint-bottom'));         return true;       }     </script>     
</body>
</html>
";s:7:"headers";a:9:{i:0;a:2:{s:4:"name";s:15:"x-frame-options";s:5:"value";s:10:"SAMEORIGIN";}i:1;a:2:{s:4:"name";s:15:"referrer-policy";s:5:"value";s:31:"strict-origin-when-cross-origin";}i:2;a:2:{s:4:"name";s:26:"cross-origin-opener-policy";s:5:"value";s:11:"same-origin";}i:3;a:2:{s:4:"name";s:12:"Content-Type";s:5:"value";s:24:"text/html; charset=utf-8";}i:4;a:2:{s:4:"name";s:7:"Expires";s:5:"value";s:29:"Wed, 17 Aug 2005 00:00:00 GMT";}i:5;a:2:{s:4:"name";s:13:"Last-Modified";s:5:"value";s:29:"Fri, 15 May 2026 21:05:01 GMT";}i:6;a:2:{s:4:"name";s:13:"Cache-Control";s:5:"value";s:62:"no-store, no-cache, must-revalidate, post-check=0, pre-check=0";}i:7;a:2:{s:4:"name";s:6:"Pragma";s:5:"value";s:8:"no-cache";}i:8;a:2:{s:4:"name";s:6:"Status";s:5:"value";s:3:"200";}}}