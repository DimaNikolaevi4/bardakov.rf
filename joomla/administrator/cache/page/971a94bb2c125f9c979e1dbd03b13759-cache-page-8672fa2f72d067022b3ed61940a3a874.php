<?php die("Access Denied"); ?>#x#a:2:{s:4:"body";s:57188:"                    <!DOCTYPE html>
<html lang="ru-RU" dir="ltr">
        

<head>
<script type="text/javascript">  (function(){    function blockCookies(disableCookies, disableLocal, disableSession){    if(disableCookies == 1){    if(!document.__defineGetter__){    Object.defineProperty(document, 'cookie',{    get: function(){ return ''; },    set: function(){ return true;}    });    }else{    var oldSetter = document.__lookupSetter__('cookie');    if(oldSetter) {    Object.defineProperty(document, 'cookie', {    get: function(){ return ''; },    set: function(v){    if(v.match(/reDimCookieHint\=/) || v.match(/814e60ba5159f4f902fe9bb074943f08\=/)) {    oldSetter.call(document, v);    }    return true;    }    });    }    }    var cookies = document.cookie.split(';');    for (var i = 0; i < cookies.length; i++) {    var cookie = cookies[i];    var pos = cookie.indexOf('=');    var name = '';    if(pos > -1){    name = cookie.substr(0, pos);    }else{    name = cookie;    }    if(name.match(/reDimCookieHint/)) {    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT';    }    }    }    if(disableLocal == 1){    window.localStorage.clear();    window.localStorage.__proto__ = Object.create(window.Storage.prototype);    window.localStorage.__proto__.setItem = function(){ return undefined; };    }    if(disableSession == 1){    window.sessionStorage.clear();    window.sessionStorage.__proto__ = Object.create(window.Storage.prototype);    window.sessionStorage.__proto__.setItem = function(){ return undefined; };    }    }    blockCookies(1,1,1);    }());    </script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        

        
            
         <meta charset="utf-8">
	<meta name="generator" content="Joomla! - Open Source Content Management">
	<title>Login</title>
	<link href="https://xn--80aabgi1b2am.xn--p1ai/search?format=opensearch" rel="search" title="OpenSearch Преподаватель Бардаков" type="application/opensearchdescription+xml">
	<link href="/favicon.ico" rel="icon" type="image/vnd.microsoft.icon">

    <link href="/media/plg_system_webauthn/css/button.min.css?528d0a" rel="stylesheet">
	<link href="/media/vendor/awesomplete/css/awesomplete.css?1.1.7" rel="stylesheet">
	<link href="/plugins/system/cookiehint/css/redimstyle.css?528d0a" rel="stylesheet">
	<link href="/media/gantry5/engines/nucleus/css-compiled/nucleus.css" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/elixir_20.css?6a0c8942" rel="stylesheet">
	<link href="/media/gantry5/engines/nucleus/css-compiled/bootstrap5.css" rel="stylesheet">
	<link href="/media/system/css/joomla-fontawesome.min.css" rel="stylesheet">
	<link href="/media/plg_system_debug/css/debug.css" rel="stylesheet">
	<link href="/media/gantry5/assets/css/font-awesome6-pseudo.min.css" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/elixir-joomla_20.css?6a0c8942" rel="stylesheet">
	<link href="/templates/rt_elixir/custom/css-compiled/custom_20.css" rel="stylesheet">
	<link href="/templates/rt_elixir/css/aos.css" rel="stylesheet">
	<style>
			.pdf-print-icon {
				float: right;
			}
		</style>
	<style>#redim-cookiehint-bottom {position: fixed; z-index: 99999; left: 0px; right: 0px; bottom: 0px; top: auto !important;}</style>

    <script type="application/json" class="joomla-script-options new">{"joomla.jtext":{"PLG_SYSTEM_WEBAUTHN_ERR_CANNOT_FIND_USERNAME":"Не удалось найти поле логина в модуле входа на сайт. Если на сайте не используется альтернативный модуль входа, аутентификация с помощью технологии Passkeys будет невозможна.","PLG_SYSTEM_WEBAUTHN_ERR_EMPTY_USERNAME":"Введите логин без пароля перед нажатием кнопки входа в систему с помощью технологии Passkeys.","PLG_SYSTEM_WEBAUTHN_ERR_INVALID_USERNAME":"Логин не соответствует учетной записи, которой разрешен вход в систему с помощью технологии Passkeys.","JFIELD_PASSWORD_INDICATE_INCOMPLETE":"Пароль не соответствует необходимым требованиям","JFIELD_PASSWORD_INDICATE_COMPLETE":"Пароль соответствует необходимым требованиям","JSHOWPASSWORD":"Показать пароль","JHIDEPASSWORD":"Скрыть пароль","MOD_FINDER_SEARCH_VALUE":"Введите текст...","COM_FINDER_SEARCH_FORM_LIST_LABEL":"Результаты поиска","JLIB_JS_AJAX_ERROR_OTHER":"При получении данных JSON произошла ошибка. Код состояния HTTP %s.","JLIB_JS_AJAX_ERROR_PARSE":"При обработке данных JSON произошла ошибка парсинга:<br><code style=\"color:inherit;white-space:pre-wrap;padding:0;margin:0;border:0;background:inherit;\">%s<\/code>","JLIB_FORM_CONTAINS_INVALID_FIELDS":"Не удалось отправить форму, так как одно или несколько полей заполнено некорректно.","JLIB_FORM_FIELD_REQUIRED_VALUE":"Пожалуйста, заполните поле","JLIB_FORM_FIELD_REQUIRED_CHECK":"Пожалуйста, выберите значение","JLIB_FORM_FIELD_INVALID_VALUE":"Пожалуйста, введите корректное значение"},"finder-search":{"url":"\/component\/finder\/?task=suggestions.suggest&format=json&tmpl=component&Itemid=132"},"system.paths":{"root":"","rootFull":"https:\/\/xn--80aabgi1b2am.xn--p1ai\/","base":"","baseFull":"https:\/\/xn--80aabgi1b2am.xn--p1ai\/"},"csrf.token":"b9bd9b96b2b3197b6b6aee619b574350","system.keepalive":{"interval":840000,"uri":"\/component\/ajax\/?format=json"},"accessibility-options":{"labels":{"menuTitle":"Панель доступности","increaseText":"Увеличить размер шрифта","decreaseText":"Уменьшить размер шрифта","increaseTextSpacing":"Увеличить интервал шрифта","decreaseTextSpacing":"Уменьшить интервал шрифта","invertColors":"Инвертировать цвета","grayHues":"Серые оттенки","underlineLinks":"Подчеркнуть ссылки","bigCursor":"Увеличить курсор","readingGuide":"Линейка для чтения","textToSpeech":"Преобразовать текст в речь","speechToText":"Преобразовать речь в текст","resetTitle":"Сбросить","closeTitle":"Закрыть"},"icon":{"position":{"left":{"size":"0","units":"px"}},"useEmojis":false},"hotkeys":{"enabled":true,"helpTitles":true},"textToSpeechLang":["ru-RU"],"speechToTextLang":["ru-RU"]}}</script>
	<script src="/media/system/js/core.min.js?a3d8f8"></script>
	<script src="/media/system/js/messages.min.js?9a4811" type="module"></script>
	<script src="/media/plg_system_webauthn/js/login.min.js?528d0a" defer></script>
	<script src="/media/system/js/keepalive.min.js?08e025" type="module"></script>
	<script src="/media/system/js/fields/validate.min.js?75ac5d" type="module"></script>
	<script src="/media/system/js/fields/passwordview.min.js?61f142" defer></script>
	<script src="/media/vendor/awesomplete/js/awesomplete.min.js?1.1.7" defer></script>
	<script src="/media/com_finder/js/finder.min.js?755761" type="module"></script>
	<script src="/media/vendor/jquery/js/jquery.min.js?3.7.1"></script>
	<script src="/media/vendor/jquery/js/jquery-noconflict.min.js?3.7.1"></script>
	<script src="/media/vendor/accessibility/js/accessibility.min.js?3.0.17" defer></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script src="/templates/rt_elixir/js/aos.js"></script>
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
<link rel="canonical" href="https://бардаков.рф/login" />
</head>


    <body class="gantry site com_users view-login no-layout no-task dir-ltr itemid-104 outline-20 g-offcanvas-left g-default g-style-preset3">
        
                    

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
                                                            <div class="platform-content container"><div class="row"><div class="col"><div class="com-users-login login">
    
    
        
        
    
    <form action="/login?task=user.login" method="post" id="com-users-login__form" class="com-users-login__form form-validate form-horizontal well">

        <fieldset>
            <div class="control-group com-users-login__input">
            <div class="control-label"><label id="username-lbl" for="username" class="required">
    Логин<span class="star" aria-hidden="true">&#160;*</span></label>
</div>
        <div class="controls">
        

    
    <input
        type="text"
        name="username"
        id="username"
        value=""
                class="form-control validate-username required" size="25"         required autocomplete="username" autofocus     >

    

            </div>
</div>
<div class="control-group com-users-login__input">
            <div class="control-label"><label id="password-lbl" for="password" class="required">
    Пароль<span class="star" aria-hidden="true">&#160;*</span></label>
</div>
        <div class="controls">
        
<div class="password-group">
    <div class="input-group">
        <input
            type="password"
            name="password"
            id="password"
            value=""
             autocomplete="current-password" class="form-control required"    size="25" maxlength="99" required  data-min-length="12"      >
                <button type="button" class="btn btn-secondary input-password-toggle">
            <span class="icon-eye icon-fw" aria-hidden="true"></span>
            <span class="visually-hidden">Показать пароль</span>
        </button>
            </div>
</div>            </div>
</div>

                            <div class="com-users-login__remember">
                    <div class="form-check">
                        <input class="form-check-input" id="remember" type="checkbox" name="remember" value="yes">
                        <label class="form-check-label" for="remember">
                            Запомнить меня                        </label>
                    </div>
                </div>
            
                            <div class="com-users-login__submit control-group">
                    <div class="controls">
                        <button type="button"
                                class="btn btn-secondary w-100 plg_system_webauthn_login_button"
                                                                    data-webauthn-form="com-users-login__form"
                                                                                                title="Войти без пароля"
                                id="plg_system_webauthn-dB872bpviL2p-medvzfMJ"
                        >
                                                            <svg aria-hidden="true" id="Passkey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g id="icon-passkey"><circle id="icon-passkey-head" cx="10.5" cy="6" r="4.5"/><path id="icon-passkey-key" d="M22.5,10.5a3.5,3.5,0,1,0-5,3.15V19L19,20.5,21.5,18,20,16.5,21.5,15l-1.24-1.24A3.5,3.5,0,0,0,22.5,10.5Zm-3.5,0a1,1,0,1,1,1-1A1,1,0,0,1,19,10.5Z"/><path id="icon-passkey-body" d="M14.44,12.52A6,6,0,0,0,12,12H9a6,6,0,0,0-6,6v2H16V14.49A5.16,5.16,0,0,1,14.44,12.52Z"/></g></svg>
                                                        Войти без пароля                        </button>
                    </div>
                </div>
            
            <div class="com-users-login__submit control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">
                        Войти                    </button>
                </div>
            </div>

            <input type="hidden" name="return" value="MTAx" >
<input type="hidden" name="b9bd9b96b2b3197b6b6aee619b574350" value="1">        </fieldset>
    </form>
    <div class="com-users-login__options list-group">
        <a class="com-users-login__reset list-group-item" href="/login?view=reset">
            Забыли пароль?        </a>
        <a class="com-users-login__remind list-group-item" href="/login?view=remind">
            Забыли логин?        </a>
            </div>
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
    

    

        
    
<script type="text/javascript">   function cookiehintsubmitnoc(obj) {     if (confirm("A refusal will affect the functions of the website. Do you really want to decline?")) {       document.cookie = 'reDimCookieHint=-1; expires=0; path=/';       cookiehintfadeOut(document.getElementById('redim-cookiehint-bottom'));       return true;     } else {       return false;     }   } </script> <div id="redim-cookiehint-bottom">   <div id="redim-cookiehint">     <div class="cookiehead">       <span class="headline">Мы используем файлы cookie</span>     </div>     <div class="cookiecontent">   Мы используем файлы cookie для улучшения вашего взаимодействия на нашем веб-сайте. Просматривая этот веб-сайт, вы соглашаетесь на использование нами файлов cookie.    </div>     <div class="cookiebuttons">       <a id="cookiehintsubmit" onclick="return cookiehintsubmit(this);" href="https://xn--80aabgi1b2am.xn--p1ai/login?rCH=2"         class="btn">Принять</a>           <a id="cookiehintsubmitno" onclick="return cookiehintsubmitnoc(this);" href="https://xn--80aabgi1b2am.xn--p1ai/login?rCH=-2"           class="btn">Отклонить</a>          <div class="text-center" id="cookiehintinfo">              <a target="_self" href="https://бардаков.рф/private">Политика в отношении обработки персональных данных</a>                     </div>      </div>     <div class="clr"></div>   </div> </div>     <script type="text/javascript">        if (!navigator.cookieEnabled) {         document.addEventListener("DOMContentLoaded", function (event) {           document.getElementById('redim-cookiehint-bottom').remove();         });       }        function cookiehintfadeOut(el) {         el.style.opacity = 1;         (function fade() {           if ((el.style.opacity -= .1) < 0) {             el.style.display = "none";           } else {             requestAnimationFrame(fade);           }         })();       }             function cookiehintsubmit(obj) {         document.cookie = 'reDimCookieHint=1; expires=Wed, 19 May 2027 23:59:59 GMT;; path=/';         cookiehintfadeOut(document.getElementById('redim-cookiehint-bottom'));         return true;       }        function cookiehintsubmitno(obj) {         document.cookie = 'reDimCookieHint=-1; expires=0; path=/';         cookiehintfadeOut(document.getElementById('redim-cookiehint-bottom'));         return true;       }     </script>     
</body>
</html>
";s:7:"headers";a:9:{i:0;a:2:{s:4:"name";s:15:"x-frame-options";s:5:"value";s:10:"SAMEORIGIN";}i:1;a:2:{s:4:"name";s:15:"referrer-policy";s:5:"value";s:31:"strict-origin-when-cross-origin";}i:2;a:2:{s:4:"name";s:26:"cross-origin-opener-policy";s:5:"value";s:11:"same-origin";}i:3;a:2:{s:4:"name";s:12:"Content-Type";s:5:"value";s:24:"text/html; charset=utf-8";}i:4;a:2:{s:4:"name";s:7:"Expires";s:5:"value";s:29:"Wed, 17 Aug 2005 00:00:00 GMT";}i:5;a:2:{s:4:"name";s:13:"Last-Modified";s:5:"value";s:29:"Tue, 19 May 2026 16:01:06 GMT";}i:6;a:2:{s:4:"name";s:13:"Cache-Control";s:5:"value";s:62:"no-store, no-cache, must-revalidate, post-check=0, pre-check=0";}i:7;a:2:{s:4:"name";s:6:"Pragma";s:5:"value";s:8:"no-cache";}i:8;a:2:{s:4:"name";s:6:"Status";s:5:"value";s:3:"200";}}}