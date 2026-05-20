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

use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\Database\DatabaseInterface;

class plgsystemIwsby_YametrikaInstallerScript
{
	public function __construct()
    {
        $this->minimumJoomla = '5.0';
        $this->minimumPhp = JOOMLA_MINIMUM_PHP;
    }

    function preflight($type, $parent)
    {
        if(!empty($this->minimumPhp) && version_compare(PHP_VERSION, $this->minimumPhp, '<'))
        {
            Log::add(Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPhp), Log::WARNING, 'jerror');
            return false;
        }

        if(!empty($this->minimumJoomla) && version_compare(JVERSION, $this->minimumJoomla, '<'))
        {
            Log::add(Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomla), Log::WARNING, 'jerror');
            return false;
        }

        return true;
    }
	
	function postflight($type, $parent) 
	{
		if($type == "install" || $type == "update")
		{
            echo Text::_('PLG_IWSBY_YAMETRIKA_INSTALL_INFO_NOTIFY');
		}
	}

	public function update($parent): void
    {
        try {
            $db = \Joomla\CMS\Factory::getContainer()->get(DatabaseInterface::class);

            $oldName = 'System - IWS.BY Yandex Metrika';
			$newName = 'System - IWS.BY Yandex Metrica';

            $query = $db->getQuery(true)
                ->update($db->quoteName('#__update_sites'))
                ->set($db->quoteName('name') . ' = ' . $db->quote($newName))
                ->where($db->quoteName('name') . ' = ' . $db->quote($oldName));

            $db->setQuery($query);
            $db->execute();
        } catch (\Exception $e) {

        }
    }
}