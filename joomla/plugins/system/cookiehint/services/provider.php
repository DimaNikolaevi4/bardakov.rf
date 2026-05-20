<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\DI\Container;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Event\DispatcherInterface;
use Joomla\DI\ServiceProviderInterface;
use Joomla\CMS\Extension\PluginInterface;
use Joomla\Plugin\System\cookiehint\Extension\cookiehint;

return new class () implements ServiceProviderInterface {
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   2.0
	 */
	public function register(Container $container): void
	{
		$container->set(PluginInterface::class, function (Container $container) {
			require_once JPATH_PLUGINS . '/system/cookiehint/src/cookiehint.php';
			$param = $container->get(DispatcherInterface::class);
			$plugin = new cookiehint(
				$param,
				(array) PluginHelper::getPlugin('system', 'cookiehint')
			);

			$plugin->setApplication(Factory::getApplication());

			return $plugin;
		});
	}
};