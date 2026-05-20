<?php
/**
 * 
 * @package    System - IWS.BY Yandex Metrica
 * @subpackage Modules
 * @license    GNU GPL v3 or later, see LICENSE.txt
 * @link       https://iws.by/en/product/yandex-metrica-for-joomla/
 * 
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class plgSystemIwsby_Yametrika extends CMSPlugin{
    
    protected $app;
    protected $autoloadLanguage = true;

    function onBeforeCompileHead() {
        if (!$this->app->isClient('site'))
		{
			return;
		}
        
        $yamatrikacode = $this->params->get("yacode");
		$document = Factory::getApplication()->getDocument();
		if(!empty($yamatrikacode)){
			$document->addCustomTag($yamatrikacode);
		}
    }
}