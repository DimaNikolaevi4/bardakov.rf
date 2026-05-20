<?php

/**
 * @package CookieHint
 * @license GNU GPL 2.0 or later
 * @author  Norbert Bayer @ reDim GmbH
 * @version 2.0.0
 * @link    https://www.redim.de/
 */

namespace Joomla\Plugin\System\cookiehint\Extension;

use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Plugin\CMSPlugin;

// No direct access
defined('_JEXEC') or die;

class cookiehint extends CMSPlugin
{
    private CMSApplicationInterface $app;

    private bool $jsblocker = false;

    private array $infolink = [];

    private bool $_loadcode = true;

    private bool $issite;

    public function __construct(&$subject, $config)
    {
        $this->app = Factory::getApplication();

        parent::__construct($subject, $config);
        $this->issite = $this->app->isClient('site');
    }

    private function setNoIndex(): void
    {
        $this->app->getDocument()->setMetadata('robots', 'noindex, follow');
    }

    private static function renderLayout(string $name, array $params = []): void
    {
        if (str_ends_with($name, ".php"))
        {
            $name = substr($name, 0, -4);
        }

        $layout = new FileLayout($name, JPATH_PLUGINS . "/system/cookiehint/layouts");
        echo $layout->render($params);
    }

    private function cleanCookies(): void
    {
        if (isset($_COOKIE))
        {
            $sessionname = $this->app->getSession()->getName();
            $host        = URI::getInstance()->getHost();
            $e           = explode('.', $host);
            $host2       = array_pop($e);
            $host2       = '.' . array_pop($e) . '.' . $host2;

            foreach ($_COOKIE as $name => $value)
            {
                if ($name != $sessionname)
                {
                    setcookie($name, '', -1, '', $host);
                    setcookie($name, '', -1, '/', $host);
                    if (!empty($host2))
                    {
                        setcookie($name, '', -1, '', $host2);
                        setcookie($name, '', -1, '/', $host2);
                    }
                    unset($_COOKIE[$name]);
                }
            }
        }
    }

    private function rCHredirect(): void
    {

        $url = $this->getURL(['rCH' => null], false, false);
        $this->app->redirect($url, 301);
    }

    public function onAfterInitialise(): void
    {
        if ($this->issite)
        {
            if (!$this->checkCookie())
            {
                $this->app->getConfig()->set('caching', 0);
            }
        }
    }

    public function onBeforeCompileHead(): void
    {
        if (!$this->issite or $this->app->input->getCMD('tmpl') == 'component')
        {
            $this->_loadcode = false;
        }

        $ch = $this->checkCookie();

        $tmp = $this->_gtm_consent_JS($ch);
        if (!empty($tmp))
        {
            $wa = $this->app->getDocument()->getWebAssetManager();
            $wa->addInlineScript($tmp);
        }

        if ($ch == 1)
        {
            return;
        }

        if ($ch == 0 or $ch == -1)
        {
            $tmp = (int) $this->params->get('cookieblocker', '0');
            if ($tmp > 0)
            {
                $this->cleanCookies();
                if ($tmp == 2)
                {
                    $tmp = trim($this->params->get('csp', "default-src 'self' 'unsafe-inline'"));
                    @header('Content-Security-Policy: ' . $tmp);
                    @header('X-Content-Security-Policy: ' . $tmp);
                    @header('X-WebKit-CSP: ' . $tmp);
                }
                $this->jsblocker = true;
            }
        }

        $rCH = $this->app->input->getINT('rCH');
        if ($rCH <> 0)
        {
            $this->setNoIndex();
        }

        $cookie_name    = 'reDimCookieHint';
        $cookie_options = [
                'expires'  => 0,
                'path'     => '/',
                'secure'   => (bool) $this->params->get('cookiesecure', 0),
                'samesite' => $this->params->get('cookiesamesite', 'none'),
        ];

        switch ($rCH)
        {
            case -3:
            case 3:
                $cookie_options['expires'] = time() - 3600;
                setcookie($cookie_name, null, $cookie_options);

                $this->rCHredirect();
                break;

            case 2:
                $cookie_options['expires'] = $this->getCookieTime();
                setcookie($cookie_name, 1, $cookie_options);
                $this->rCHredirect();
                break;
            case -2:
                setcookie($cookie_name, -1, $cookie_options);
                $this->rCHredirect();
                break;

            case 1:
                $cookie_options['expires'] = $this->getCookieTime();
                setcookie($cookie_name, 1, $cookie_options);

                echo 'ok';
                $this->app->close();
                break;
            case -1:
                setcookie($cookie_name, -1, $cookie_options);

                echo 'ok';
                $this->app->close();
                break;
        }

        if ($ch == 0)
        {
            $tmp = $this->params->get('css', 'redimstyle.css');
            $wa  = $this->app->getDocument()->getWebAssetManager();
            if ($tmp != '-1')
            {
                $wa->registerAndUseStyle('plg.system.cookiehint', 'plugins/system/cookiehint/css/' . $tmp, ['version' => 'auto', 'relative' => false]);
            }

            if ($this->_get_infolink('infourl') === false or $this->_get_infolink('imprinturl') === false)
            {
                $this->params->set('position', 'bottom');
            }

            $tmp = match ($this->params->get('position', 'bottom'))
            {
                'modal' => '#redim-cookiehint-modal {position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: 99998; display: flex; justify-content : center; align-items : center;}',
                'top' => '#redim-cookiehint-top {position: fixed; z-index: 99990; left: 0px; right: 0px; top: 0px; bottom: auto !important;}',
                default => '#redim-cookiehint-bottom {position: fixed; z-index: 99999; left: 0px; right: 0px; bottom: 0px; top: auto !important;}',
            };

            $wa->addInlineStyle($tmp);
        }
    }

    private function checkCookie(): bool|int
    {
        static $reDimCookieHint = null;

        if (!$this->issite)
        {
            return true;
        }

        if (!is_null($reDimCookieHint))
        {
            return $reDimCookieHint;
        }

        if ($this->app->input->getVAR('rCH', null) != null)
        {
            return false;
        }

        $return = false;

        if ($this->app->input->get('cookiehint') == 'set')
        {
            @setcookie('reDimCookieHint', null, -1, 0, '/');
            unset($_COOKIE['reDimCookieHint']);
        }

        if (isset($_COOKIE['reDimCookieHint']))
        {
            $return = (int) $_COOKIE['reDimCookieHint'];
        }

        $reDimCookieHint = $return;

        return $reDimCookieHint;
    }

    private function getCookieTime(): int|float
    {
        $cm = (int) $this->params->get('cookiemode');
        $d  = (int) $this->params->get('cookieexpires', 365);
        if ($cm == 1)
        {
            $d = 0;
        }
        else
        {
            $d = time() + ($d * 86400);
        }

        return $d;
    }

    public function onPageCacheGetKey(): string
    {
        $x = 0;
        if (isset($_COOKIE['reDimCookieHint']))
        {
            $x = (int) $_COOKIE['reDimCookieHint'];
        }

        return 'reDimCookieHint' . $x;
    }

    public function onAfterRender(): void
    {

        $set    = false;
        $buffer = $this->app->getBody();
        if ($this->jsblocker)
        {
            $html = "\n" . '<script type="text/javascript">' . $this->getHeadJava(true, true, true) . '</script>' . "\n";
            if ($buffer = preg_replace("/\<head(.*)>/", "\n$0" . $html . "\n", $buffer, 1))
            {
                $set = true;
            }
        }

        if (!$this->checkCookie() and $this->_loadcode === true)
        {
            $html = $this->_get_code();
            if ($buffer = preg_replace("/\<\/body(.*)>/", "\n" . $html . "\n$0", $buffer))
            {
                $set = true;
            }
        }

        if ($set)
        {
            $this->app->setBody($buffer);
        }
    }

    private function getHeadJava(int $disableCookies = 1, int $disableLocal = 1, int $disableSession = 1): string
    {
        ob_start();
        ?>
        (function(){
        function blockCookies(disableCookies, disableLocal, disableSession){
        if(disableCookies == 1){
        if(!document.__defineGetter__){
        Object.defineProperty(document, 'cookie',{
        get: function(){ return ''; },
        set: function(){ return true;}
        });
        }else{
        var oldSetter = document.__lookupSetter__('cookie');
        if(oldSetter) {
        Object.defineProperty(document, 'cookie', {
        get: function(){ return ''; },
        set: function(v){
        if(v.match(/reDimCookieHint\=/) || v.match(/<?= $this->app->getSession()->getName(); ?>\=/)) {
        oldSetter.call(document, v);
        }
        return true;
        }
        });
        }
        }
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var pos = cookie.indexOf('=');
        var name = '';
        if(pos > -1){
        name = cookie.substr(0, pos);
        }else{
        name = cookie;
        }
        if(name.match(/reDimCookieHint/)) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT';
        }
        }
        }
        if(disableLocal == 1){
        window.localStorage.clear();
        window.localStorage.__proto__ = Object.create(window.Storage.prototype);
        window.localStorage.__proto__.setItem = function(){ return undefined; };
        }
        if(disableSession == 1){
        window.sessionStorage.clear();
        window.sessionStorage.__proto__ = Object.create(window.Storage.prototype);
        window.sessionStorage.__proto__.setItem = function(){ return undefined; };
        }
        }
        blockCookies(<?= $disableCookies; ?>,<?= $disableLocal; ?>,<?= $disableSession; ?>);
        }());
        <?PHP
        return str_replace(["\n", "\r", "\t", "    "], ' ', ob_get_clean());
    }

    private function getURL(array $ar = [], bool $url = false, bool $chars = true): string
    {
        if ($url)
        {
            $uri = URI::getInstance($url);
        }
        else
        {
            $uri = URI::getInstance();
        }

        $q = $uri->getQuery(true);

        if (count($ar) > 0)
        {
            if (isset($q['cookiehint']))
            {
                unset($q['cookiehint']);
            }
            $q = array_merge($q, $ar);
        }

        $uri->setQuery($q);

        if (!$chars)
        {
            return $uri->toString();
        }

        return htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8');
    }

    private function _get_code(): string
    {
        $link        = $this->_get_infolink('infourl');
        $linkimprint = $this->_get_infolink('imprinturl');

        $linkok    = $this->getURL(['rCH' => 2]);
        $linknotok = $this->getURL(['rCH' => -2]);
        $position  = $this->params->get('position', 'bottom');

        $refusal = (int) $this->params->get('refusal');

        if ($refusal == 2)
        {
            $refusalurl = trim((string) $this->params->get('refusalurl', 'https://www.cookieinfo.org/'));
        }
        else
        {
            $refusalurl = '';
        }

        ob_start();
        $file = str_replace('/', '', $this->params->get('file', 'redimstyle.php'));

        $l    = $this->app->getLanguage()->getTag();
        $temp = $l . '_' . $file;

        if (file_Exists(JPATH_SITE . '/plugins/system/cookiehint/include/' . $temp))
        {
            $file = $temp;
        }
        else
        {
            if (!file_exists(JPATH_SITE . '/plugins/system/cookiehint/include/' . $file))
            {
                $file = 'default.php';
            }
        }

        include_once(JPATH_SITE . '/plugins/system/cookiehint/include/' . $file);

        ?>
        <script type="text/javascript">

            if (!navigator.cookieEnabled) {
                document.addEventListener("DOMContentLoaded", function (event) {
                    document.getElementById('redim-cookiehint-<?= $position; ?>').remove();
                });
            }

            function cookiehintfadeOut(el) {
                el.style.opacity = 1;
                (function fade() {
                    if ((el.style.opacity -= .1) < 0) {
                        el.style.display = "none";
                    } else {
                        requestAnimationFrame(fade);
                    }
                })();
            }
            <?PHP
            if ($this->params->get('cookiemode') == 0)
            {
                $d = (int) $this->params->get('cookieexpires', 365);
                $c = date('D, d M Y', time() + (86400 * $d)) . ' 23:59:59 GMT;';
                $c = 'reDimCookieHint=%s; expires=' . $c;
            }
            else
            {
                $c = 'reDimCookieHint=%s; expires=0;';
            }
            ?>
            function cookiehintsubmit(obj) {
                document.cookie = '<?= sprintf($c, 1); ?>; path=/';
                cookiehintfadeOut(document.getElementById('redim-cookiehint-<?= $position;?>'));
                return true;
            }

            function cookiehintsubmitno(obj) {
                document.cookie = 'reDimCookieHint=-1; expires=0; path=/';
                cookiehintfadeOut(document.getElementById('redim-cookiehint-<?= $position;?>'));
                return true;
            }
        </script>
        <?PHP
        return str_replace(["\n", "\r", "\t", "  "], ' ', ob_get_clean());
    }

    private function _get_infolink(string $name = 'infourl'): false|string
    {

        if (isset($this->infolink[$name]))
        {
            return $this->infolink[$name];
        }

        $lang = $this->app->getLanguage();
        $lang->load("plg_system_cookiehint", JPATH_ADMINISTRATOR);

        $l = $lang->getTag();

        $link  = false;
        $links = $this->params->get($name, []);
        if (is_object($links))
        {
            $links = (array) $links;
        }
        if (is_array($links))
        {
            if (!empty($links[$l]))
            {
                $link = $links[$l];
            }

            if (empty($link))
            {
                if (count($links) > 0)
                {
                    foreach ($links as $link)
                    {
                        if (!empty($link))
                        {
                            break;
                        }
                    }
                }
            }
        }
        unset($links);

        $url = URI::getInstance()->toString(['path', 'query', 'fragment']);
        if ($link)
        {
            if ($url == $link or $url == '/' . $link)
            {
                if (!empty($link))
                {
                    $link = false;
                }
            }
        }

        $this->infolink[$name] = $link;

        return $link;
    }


    private function _gtm_consent_JS(bool|int $ch): string
    {

        $session = $this->app->getSession();
        $ch2     = $session->get('gtag', null);

        if ($ch2 == $ch)
        {
            return '';
        }

        $gtag = match ($ch)
        {
            true, 1 => 'granted',
            default => 'denied',
        };

        $session->set('gtag', $ch);

        $tmp = "(function() {
		if (typeof gtag !== 'undefined') {
            gtag('consent', '" . $gtag . "', {
                'ad_storage': '" . $gtag . "',
                'ad_user_data': '" . $gtag . "',
                'ad_personalization': '" . $gtag . "',
                'functionality_storage': '" . $gtag . "',
                'personalization_storage': '" . $gtag . "',
                'security_storage': '" . $gtag . "',
                'analytics_storage': '" . $gtag . "'
            });
        }
})();";

        return str_replace(["\r", "\n", "\t", "  "], ' ', $tmp);
    }
}