<?php die("Access Denied"); ?>#x#a:2:{s:4:"body";s:69090:"                    <!DOCTYPE html>
<html lang="ru-RU" dir="ltr">
        

<head>
<script type="text/javascript">  (function(){    function blockCookies(disableCookies, disableLocal, disableSession){    if(disableCookies == 1){    if(!document.__defineGetter__){    Object.defineProperty(document, 'cookie',{    get: function(){ return ''; },    set: function(){ return true;}    });    }else{    var oldSetter = document.__lookupSetter__('cookie');    if(oldSetter) {    Object.defineProperty(document, 'cookie', {    get: function(){ return ''; },    set: function(v){    if(v.match(/reDimCookieHint\=/) || v.match(/814e60ba5159f4f902fe9bb074943f08\=/)) {    oldSetter.call(document, v);    }    return true;    }    });    }    }    var cookies = document.cookie.split(';');    for (var i = 0; i < cookies.length; i++) {    var cookie = cookies[i];    var pos = cookie.indexOf('=');    var name = '';    if(pos > -1){    name = cookie.substr(0, pos);    }else{    name = cookie;    }    if(name.match(/reDimCookieHint/)) {    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT';    }    }    }    if(disableLocal == 1){    window.localStorage.clear();    window.localStorage.__proto__ = Object.create(window.Storage.prototype);    window.localStorage.__proto__.setItem = function(){ return undefined; };    }    if(disableSession == 1){    window.sessionStorage.clear();    window.sessionStorage.__proto__ = Object.create(window.Storage.prototype);    window.sessionStorage.__proto__.setItem = function(){ return undefined; };    }    }    blockCookies(1,1,1);    }());    </script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        

        
            
         <meta charset="utf-8">
	<meta name="author" content="Бардаков Дмитрий Николаевич">
	<meta name="generator" content="Joomla! - Open Source Content Management">
	<title>Наладка и калибровка микропроцессорного модуля ввода аналоговых сигналов в измерительной системе температуры</title>
	<link href="https://xn--80aabgi1b2am.xn--p1ai/search?format=opensearch" rel="search" title="OpenSearch Преподаватель Бардаков" type="application/opensearchdescription+xml">
	<link href="/favicon.ico" rel="icon" type="image/vnd.microsoft.icon">

    <link href="/media/vendor/awesomplete/css/awesomplete.css?1.1.7" rel="stylesheet">
	<link href="/media/gantry5/engines/nucleus/css-compiled/nucleus.css" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/elixir_20.css?6a0377b6" rel="stylesheet">
	<link href="/media/gantry5/engines/nucleus/css-compiled/bootstrap5.css" rel="stylesheet">
	<link href="/media/system/css/joomla-fontawesome.min.css" rel="stylesheet">
	<link href="/media/plg_system_debug/css/debug.css" rel="stylesheet">
	<link href="/media/gantry5/assets/css/font-awesome6-pseudo.min.css" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/elixir-joomla_20.css?6a0377b7" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/custom_20.css" rel="stylesheet">
	<link href="/templates/rt_elixir/css/aos.css" rel="stylesheet">
	<style>
			.pdf-print-icon {
				float: right;
			}
		</style>

    <script type="application/json" class="joomla-script-options new">{"joomla.jtext":{"MOD_FINDER_SEARCH_VALUE":"Введите текст...","COM_FINDER_SEARCH_FORM_LIST_LABEL":"Результаты поиска","JLIB_JS_AJAX_ERROR_OTHER":"При получении данных JSON произошла ошибка. Код состояния HTTP %s.","JLIB_JS_AJAX_ERROR_PARSE":"При обработке данных JSON произошла ошибка парсинга:<br><code style=\"color:inherit;white-space:pre-wrap;padding:0;margin:0;border:0;background:inherit;\">%s<\/code>"},"finder-search":{"url":"\/component\/finder\/?task=suggestions.suggest&format=json&tmpl=component&Itemid=132"},"system.paths":{"root":"","rootFull":"https:\/\/xn--80aabgi1b2am.xn--p1ai\/","base":"","baseFull":"https:\/\/xn--80aabgi1b2am.xn--p1ai\/"},"csrf.token":"623ef6618bbd8bc3efdd677d313359a3","accessibility-options":{"labels":{"menuTitle":"Панель доступности","increaseText":"Увеличить размер шрифта","decreaseText":"Уменьшить размер шрифта","increaseTextSpacing":"Увеличить интервал шрифта","decreaseTextSpacing":"Уменьшить интервал шрифта","invertColors":"Инвертировать цвета","grayHues":"Серые оттенки","underlineLinks":"Подчеркнуть ссылки","bigCursor":"Увеличить курсор","readingGuide":"Линейка для чтения","textToSpeech":"Преобразовать текст в речь","speechToText":"Преобразовать речь в текст","resetTitle":"Сбросить","closeTitle":"Закрыть"},"icon":{"position":{"left":{"size":"0","units":"px"}},"useEmojis":false},"hotkeys":{"enabled":true,"helpTitles":true},"textToSpeechLang":["ru-RU"],"speechToTextLang":["ru-RU"]}}</script>
	<script src="/media/system/js/core.min.js?a3d8f8"></script>
	<script src="/media/vendor/awesomplete/js/awesomplete.min.js?1.1.7" defer></script>
	<script src="/media/com_finder/js/finder.min.js?755761" type="module"></script>
	<script src="/media/vendor/jquery/js/jquery.min.js?3.7.1"></script>
	<script src="/media/vendor/jquery/js/jquery-noconflict.min.js?3.7.1"></script>
	<script src="/media/vendor/accessibility/js/accessibility.min.js?3.0.17" defer></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script src="/templates/rt_elixir/js/aos.js"></script>
	<script type="application/ld+json">{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://xn--80aabgi1b2am.xn--p1ai/#/schema/Organization/base","name":"Преподаватель Бардаков","url":"https://xn--80aabgi1b2am.xn--p1ai/"},{"@type":"WebSite","@id":"https://xn--80aabgi1b2am.xn--p1ai/#/schema/WebSite/base","url":"https://xn--80aabgi1b2am.xn--p1ai/","name":"Преподаватель Бардаков","publisher":{"@id":"https://xn--80aabgi1b2am.xn--p1ai/#/schema/Organization/base"},"potentialAction":{"@type":"SearchAction","target":"https://xn--80aabgi1b2am.xn--p1ai/search?q={search_term_string}","query-input":"required name=search_term_string"}},{"@type":"WebPage","@id":"https://xn--80aabgi1b2am.xn--p1ai/#/schema/WebPage/base","url":"https://xn--80aabgi1b2am.xn--p1ai/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/naladka-mikroprotsessornogo-modulya-vvoda-analogovykh-signalov-na-primere-izmeritelnoj-sistemy-temperatury","name":"Наладка и калибровка микропроцессорного модуля ввода аналоговых сигналов в измерительной системе температуры","isPartOf":{"@id":"https://xn--80aabgi1b2am.xn--p1ai/#/schema/WebSite/base"},"about":{"@id":"https://xn--80aabgi1b2am.xn--p1ai/#/schema/Organization/base"},"inLanguage":"ru-RU"}]}</script>
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
<link rel="canonical" href="https://бардаков.рф/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/naladka-mikroprotsessornogo-modulya-vvoda-analogovykh-signalov-na-primere-izmeritelnoj-sistemy-temperatury" />
</head>


    <body class="gantry site com_content view-article no-layout no-task dir-ltr itemid-390 outline-20 g-offcanvas-left g-default g-style-preset3">
        
                    

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
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-135 g-parent active g-standard g-menu-item-link-parent ">
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
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-separator g-menu-item-166 g-parent active  ">
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
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-167 g-parent active g-menu-item-link-parent ">
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
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-168 g-parent active g-menu-item-link-parent ">
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
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-170 g-parent active g-menu-item-link-parent ">
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
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-390 active  ">
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
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-136 g-parent g-standard g-menu-item-link-parent ">
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
    
                                                                                                
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-heading g-menu-item-138 g-parent  ">
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
                                                                                                                    
        
                
        
                
        
        <li class="g-menu-item g-menu-item-type-component g-menu-item-140  ">
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
                                                            <div class="platform-content container"><div class="row"><div class="col"><div class="com-content-article""><div class="pdf-print-icon"><a class="btn btn-danger" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/naladka-mikroprotsessornogo-modulya-vvoda-analogovykh-signalov-na-primere-izmeritelnoj-sistemy-temperatury?tmpl=component&amp;format=pdf" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); return false;" target=""><span class="glyphicon glyphicon-file icon-file"></span> PDF</a></div>
    <meta itemprop="inLanguage" content="ru-RU">
    
    
        <div class="page-header">
        <h1>
            Наладка и калибровка микропроцессорного модуля ввода аналоговых сигналов в измерительной системе температуры        </h1>
                            </div>
        
        
            <dl class="article-info text-muted">

            <dt class="article-info-term">
                        Информация о материале                    </dt>

                    <dd class="createdby">
    <span class="icon-user icon-fw" aria-hidden="true"></span>
                    Автор: <span>Бардаков Дмитрий Николаевич</span>    </dd>
        
        
                    <dd class="category-name">
    <span class="icon-folder-open icon-fw" aria-hidden="true"></span>                        Категория: <a href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii">Тема 1.1 Организация работ по монтажу систем автоматизации </a>    </dd>
        
        
        
    
            
        
            </dl>
    
    
        
                                                <div class="com-content-article__body">
        <h4>1. Введение</h4>
<p>В современном промышленном производстве точность измерений является ключевым фактором, обеспечивающим качество выпускаемой продукции и безопасность технологических процессов. Температура представляет собой один из критически важных контролируемых параметров. Её отклонение от заданных значений даже на незначительную величину может привести к производству бракованной продукции, выходу из строя технологического оборудования или возникновению аварийных ситуаций.</p>
<p>В рамках данного занятия рассматриваются устройство и принципы функционирования измерительной системы температуры, а также последовательность операций по настройке и калибровке микропроцессорного модуля ввода аналоговых сигналов.</p>
<hr>
<h4>2. Понятие измерительной системы и роль калибровки</h4>
<p>Измерительная система представляет собой комплекс технических средств, программного обеспечения и методик, объединенных с целью получения, обработки, передачи и отображения информации о физических величинах.</p>
<p>Функциональная цепочка преобразования сигнала в системе контроля температуры включает следующие основные элементы:</p>
<table>
<thead>
<tr>
<th>Элемент системы</th>
<th>Функциональное назначение</th>
</tr>
</thead>
<tbody>
<tr>
<td>1. Датчик температуры</td>
<td>Преобразует значение температуры в аналоговый электрический сигнал (например, токовый сигнал 4–20 мА или напряжение 0–10 В).</td>
</tr>
<tr>
<td>2. Аналоговый сигнал</td>
<td>Непрерывный электрический сигнал, изменяющийся пропорционально контролируемой физической величине.</td>
</tr>
<tr>
<td>3. Модуль ввода сигналов</td>
<td>Микропроцессорное устройство, выполняющее преобразование аналогового сигнала в цифровую форму посредством аналого-цифрового преобразователя (АЦП).</td>
</tr>
<tr>
<td>4. Преобразователь интерфейса</td>
<td>Обеспечивает согласование и передачу данных между модулем ввода и верхним уровнем системы (компьютер, ПЛК) по промышленному протоколу связи.</td>
</tr>
<tr>
<td>5. Персональный компьютер / ПЛК</td>
<td>Осуществляет обработку, визуализацию и регистрацию полученных данных, например, отображение текущей температуры в градусах Цельсия.</td>
</tr>
</tbody>
</table>
<p>Калибровка датчиков является обязательной процедурой в составе пусконаладочных работ.</p>
<p>Калибровка — это совокупность операций, выполняемых с целью установления соответствия между значениями величины, измеренными датчиком, и действительными значениями этой величины, воспроизводимыми эталонным средством измерения.</p>
<p>Необходимость проведения калибровки обусловлена следующими факторами:</p>
<ul>
<li>
<p>Наличие погрешности изготовления первичного преобразователя.</p>
</li>
<li>
<p>Изменение метрологических характеристик датчика в процессе эксплуатации (дрейф).</p>
</li>
<li>
<p>Влияние внешних дестабилизирующих факторов: вибрации, температуры, агрессивных сред.</p>
</li>
</ul>
<p>Процедура калибровки включает следующие этапы:</p>
<ol start="1">
<li>
<p>Помещение датчика в среду со стабильной, точно известной температурой, создаваемую эталонным источником.</p>
</li>
<li>
<p>Фиксация выходного сигнала датчика и его сравнение с эталонным значением.</p>
</li>
<li>
<p>Корректировка показаний: осуществляется либо механическая регулировка датчика, либо ввод поправочных коэффициентов в конфигурацию модуля ввода или программируемого логического контроллера (ПЛК).</p>
</li>
</ol>
<p>Отсутствие своевременной и корректной калибровки приводит к получению недостоверных данных и, как следствие, к нарушению технологического режима.</p>
<hr>
<h4>3. Цели и задачи пусконаладочных работ</h4>
<p>Пусконаладочные работы — это комплекс мероприятий по проверке, регулировке, калибровке и настройке технологического оборудования для обеспечения его корректной, надежной и безопасной эксплуатации в составе системы автоматики.</p>
<p>Последствия пренебрежения пусконаладочными работами:</p>
<ul>
<li>
<p>Получение некорректных данных от системы измерения.</p>
</li>
<li>
<p>Нестабильная работа системы автоматического управления.</p>
</li>
<li>
<p>Повышение риска выпуска бракованной продукции и возникновения аварийных ситуаций.</p>
</li>
</ul>
<hr>
<h4>4. Требования профессионального стандарта</h4>
<p>В соответствии с профессиональным стандартом «Слесарь по контрольно-измерительным приборам и автоматике», специалист по наладке должен обладать следующими компетенциями:</p>
<ul>
<li>
<p>Определение последовательности выполнения пусконаладочных работ.</p>
</li>
<li>
<p>Проведение калибровки и поверки средств измерений.</p>
</li>
<li>
<p>Ввод в эксплуатацию тестовых и технологических программ.</p>
</li>
<li>
<p>Проведение испытаний систем автоматики.</p>
</li>
<li>
<p>Сдача отлаженного оборудования в эксплуатацию.</p>
</li>
</ul>
<p>Ключевой трудовой функцией является ремонт, регулировка, испытания и сдача в эксплуатацию элементов систем автоматики.</p>
<hr>
<h4>5. Алгоритм настройки модуля ввода аналоговых сигналов</h4>
<p>Последовательность действий по настройке модуля ввода аналоговых сигналов регламентирована и включает следующие этапы:</p>
<p>Этап 1: Подготовительные работы</p>
<ul>
<li>
<p>Изучение проектной и технической документации на применяемое оборудование.</p>
</li>
<li>
<p>Проверка комплектности и правильности монтажных соединений.</p>
</li>
<li>
<p>Проверка наличия действующей документации о поверке и калибровке средств измерения.</p>
</li>
</ul>
<p>Этап 2: Планирование работ</p>
<ul>
<li>
<p>Формирование последовательности операций: планирование → монтаж → калибровка → настройка → испытания → сдача.</p>
</li>
</ul>
<p>Этап 3: Калибровка и конфигурирование</p>
<ul>
<li>
<p>При необходимости калибровки: с использованием эталонного калибратора сигналов на вход модуля подаются значения, соответствующие нижнему и верхнему пределам измерения. В программном обеспечении модуля фиксируются данные значения.</p>
</li>
<li>
<p>При использовании предварительно откалиброванного датчика: в конфигурацию модуля вводятся его паспортные данные (диапазон измерений, тип выходного сигнала).</p>
</li>
</ul>
<p>Этап 4: Проведение испытаний</p>
<ul>
<li>
<p>Проверка целостности и правильности прохождения измерительного тракта от датчика до рабочего места оператора.</p>
</li>
<li>
<p>Контроль корректности отображения данных в интерфейсе операторской станции.</p>
</li>
<li>
<p>Проверка реакции системы на изменение контролируемого параметра.</p>
</li>
</ul>
<p>Этап 5: Сдача системы в эксплуатацию</p>
<ul>
<li>
<p>Оформление протоколов испытаний и исполнительной документации.</p>
</li>
<li>
<p>Документирование результатов проведенных настроек и калибровок.</p>
</li>
<li>
<p>Приведение рабочего места в порядок.</p>
</li>
</ul>
<hr>
<h4>6. Контрольные вопросы для самопроверки</h4>
<ol start="1">
<li>
<p>Датчик температуры выдает сигнал 12 мА. Что это значит для системы, если не была проведена калибровка?</p>
</li>
<li>
<p>Опишите различие между аналоговым и цифровым сигналом.</p>
</li>
<li>
<p>Почему компьютер не может напрямую обрабатывать сигнал с датчика температуры?</p>
</li>
<li>
<p>Объясните взаимосвязь между калибровкой датчика и настройкой модуля ввода.</p>
</li>
<li>
<p>Какую функцию в системе выполняет протокол RS-485?</p>
</li>
</ol>
<p>Рекомендуемые ответы для самопроверки:</p>
<ol start="1">
<li>
<p>Без данных калибровки невозможно установить точное соответствие между значением выходного тока 12 мА и фактической температурой, что приводит к неопределенности измерений.</p>
</li>
<li>
<p>Аналоговый сигнал является непрерывным по времени и уровню. Цифровой сигнал — дискретный, представлен в виде кодовой последовательности.</p>
</li>
<li>
<p>Компьютер оперирует цифровыми данными. Выходной сигнал большинства датчиков является аналоговым, поэтому требуется его предварительное преобразование.</p>
</li>
<li>
<p>Калибровка устанавливает точное соответствие "физическая величина -&gt; выходной сигнал". Настройка модуля ввода заключается в конфигурировании его на корректную интерпретацию этого сигнала.</p>
</li>
<li>
<p>Протокол RS-485 является стандартом промышленной сети, предназначенным для надежного обмена данными между несколькими устройствами на значительные расстояния.</p>
</li>
</ol>
<hr>
<h4>7. Дополнительные материалы для углублённого изучения</h4>
<ul>
<li>
<p>Профессиональный стандарт 15.01.31 (утвержден приказом Министерства труда и социальной защиты Российской Федерации).</p>
</li>
<li>
<p>Бычков А. В., Савватеев А. С., Бычкова О. М. Организация и выполнение работ по монтажу, наладке и эксплуатации электрических сетей. — М.: Издательский центр «Академия», 2021.</p>
</li>
<li>
<p>Полуянович Н. К. Монтаж, наладка, эксплуатация и ремонт систем электроснабжения промышленных предприятий. — СПб.: Издательство «Лань», 2022.</p>
</li>
</ul>
<hr>
<h4>8. Заключение</h4>
<p>Освоение теоретических основ и регламентированных процедур наладки и калибровки измерительных систем составляет фундамент профессиональной подготовки будущих специалистов в области контрольно-измерительных приборов и автоматики.</p>
<p>Как отмечал М. В. Ломоносов: «Теория — это командир, а практика — солдаты».</p>
<p>Глубокое понимание принципов работы оборудования, знание требований нормативно-технической документации и умение применять их на практике являются необходимыми условиями для успешного выполнения пусконаладочных работ на объектах промышленного производства.</p>     </div>

        
        
<nav class="pagenavigation" aria-label="Навигация по страницам">
    <span class="pagination ms-0">
                    <a class="btn btn-sm btn-secondary next" href="/obuchenie/pm02/lektsii/razdel-1/tema-1-1-organizatsiya-rabot-po-montazhu-sistem-avtomatizatsii/rabota-v-dejstvuyushchikh-ustanovkakh-nakhodyashchikhsya-pod-davleniem-i-v-zone-vysokikh-temperatur-2" rel="next">
            <span class="visually-hidden">
                Следующий: Работа в действующих установках, находящихся под давлением и в зоне высоких температур            </span>
            <span aria-hidden="true">Вперед</span> <span class="icon-chevron-right" aria-hidden="true"></span>            </a>
        </span>
</nav>
                                        </div></div></div></div>
    
            
    </div>
        </div>
            </div>
            
    </main>
        </div>
            </div>
    
    </section>
    
                                    
                                
    
    
                <section id="g-container-footer" class="g-wrapper">
                            <div class="g-grid">                        

        <div class="g-block size-100 center">
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
    <script type="text/javascript">	AOS.init({

	duration: 1000,
	once: 1,
	delay: 0,
	easing: 'ease',
	offset: 120,

	});
</script>
    

    

        
    </body>
</html>
";s:7:"headers";a:9:{i:0;a:2:{s:4:"name";s:15:"x-frame-options";s:5:"value";s:10:"SAMEORIGIN";}i:1;a:2:{s:4:"name";s:15:"referrer-policy";s:5:"value";s:31:"strict-origin-when-cross-origin";}i:2;a:2:{s:4:"name";s:26:"cross-origin-opener-policy";s:5:"value";s:11:"same-origin";}i:3;a:2:{s:4:"name";s:12:"Content-Type";s:5:"value";s:24:"text/html; charset=utf-8";}i:4;a:2:{s:4:"name";s:7:"Expires";s:5:"value";s:29:"Wed, 17 Aug 2005 00:00:00 GMT";}i:5;a:2:{s:4:"name";s:13:"Last-Modified";s:5:"value";s:29:"Tue, 12 May 2026 18:55:51 GMT";}i:6;a:2:{s:4:"name";s:13:"Cache-Control";s:5:"value";s:62:"no-store, no-cache, must-revalidate, post-check=0, pre-check=0";}i:7;a:2:{s:4:"name";s:6:"Pragma";s:5:"value";s:8:"no-cache";}i:8;a:2:{s:4:"name";s:6:"Status";s:5:"value";s:3:"200";}}}