<?php
 class CmscoutCoreComponent extends Object
 {
 	var $controller;
 	
 	function initialize(&$controller, $settings = array())
	{
		// saving the controller reference for later use
		$this->controller =& $controller;

		$this->controller->enabledPlugins = $this->loadEnabledPlugins();
	}
	
 	function mainMenu($menuAdminMode = false)
 	{
 		$guestUser = $this->controller->_userDetails === null;
 		$cacheName = 'menu.'.($guestUser===false?'user':'guest').'.'.($menuAdminMode===false?'normal':'admin');

 		//if(($menus = Cache::read($cacheName, 'core')) === false)
 		{
 			$menus = ClassRegistry::init('Menu')->find('all', array('contain' => array('Plugin')));
 			/*if (!$menuAdminMode)
	 		{
		 		foreach ($menus as $key => $item)
		 		{
		 			if (isset($item['Sidebox']['model']) && $item['Sidebox']['model'] != '')
		 			{
		 				$modelName = ((isset($item['Sidebox']['Plugin']['directory'])) ? Inflector::camelize($item['Sidebox']['Plugin']['directory']) . '.' : '') . Inflector::classify($item['Sidebox']['model']);
						$sideboxData = ClassRegistry::init($modelName)->getMenu();
						$menus[$key]['Sidebox']['Data'] = $sideboxData;
		 			}
		 		}
	 		}*/
	 		
	 		//Cache::write($cacheName, $menus, 'core');
 		}
 		
 		return $menus;
 	}
 	
 	function flushMenuCache()
 	{
 		Cache::delete('menu', 'core');
 	}
 	
 	function loadAdminMenu()
 	{
  		//if (($adminMenu = Cache::read('plugin.adminMenu', 'core')) === false)
 		{
			$adminMenu = array(
				'Website Configuration' => array(
					array(
						'title' => 'Core Configuration',
						'controller' => 'configurations',
						'action' => 'index'
					),
					array(
						'title' => 'Plugin Manager',
						'controller' => 'plugins',
						'action' => 'index'
					),
					array(
						'title' => 'Theme Manager',
						'controller' => 'themes',
						'action' => 'index'
					)
				),
				'Content' => array(
					array(
						'title' => 'Menu Manager',
						'controller' => 'menus',
						'action' => 'index'
					)
				),
				'Users' => array(
					array(
						'title' => 'UGP Manager',
						'controller' => 'ugp',
						'action' => 'index'
					)
				)
			);

 			$availableAdminFunctions = $this->controller->Event->trigger('adminLinks');

			foreach($availableAdminFunctions['adminLinks'] as $plugin => $links)
			{
				$category = $this->controller->enabledPlugins[$plugin]['category'];
				$title = $this->controller->enabledPlugins[$plugin]['title'];
	
				if(!isset($adminMenu[$category]))
				{
					$adminMenu[$category] = array();
				}

				$adminMenu[$category][$this->controller->enabledPlugins[$plugin]['title']] = $links;
			}

 			//Cache::write('plugin.adminMenu', $adminMenu, 'core');
 		}
 		
 		return $adminMenu;
 	}
 	
 	function loadEnabledPlugins($forceFlush = false)
 	{
		//if (($pluginList = Cache::read('plugin.enabled', 'core')) === false || $forceFlush === true)
 		{
 			$pluginList = ClassRegistry::init('Plugin')->find('all', array('contain' => false, 'conditions' => array('Plugin.enabled')));
			$pluginList = Set::combine($pluginList, '{n}.Plugin.name', '{n}.Plugin');
 			//Cache::write('plugin.enabled', $pluginList, 'core');
 		}
 	
 		return $pluginList;
 	}

	function addConfigurationOptions($options)
	{

	}

	function getAvailableMenus()
	{
		$menuLinks = array(
			'MenuLinks' => array(
				'CMScout Default Links' => array(
					array(
						'title' => 'Homepage',
						'controller' => 'homepages',
						'action' => 'index'
					),
					array(
						'title' => 'Login',
						'controller' => 'users',
						'action' => 'login'
					),
					array(
						'title' => 'Logout',
						'controller' => 'users',
						'action' => 'logout'
					),
					array(
						'title' => 'User Control Panel',
						'controller' => 'users',
						'action' => 'index'
					)
				)
			),
			'Sideboxes' => array(
				'CMScout Default Boxes' => array(
					array(
						'title' => 'Login',
						'action' => 'login'
					),
					array(
						'title' => 'Online Users',
						'action' => 'online'
					)
				)
			)
		);

		$pluginItems = $this->controller->Event->trigger(array('getMenuLinks', 'getSideboxes'));

		foreach($pluginItems as $event => $items)
		{
			$type = substr($event, 3);
			foreach($items as $plugin => $links)
			{
				$title = $this->controller->enabledPlugins[$plugin]['title'];
				if(!isset($menuLinks[$type][$title]))
				{
					$menuLinks[$type][$title] = array();
				}

				$menuLinks[$type][$title] += $links;
			}
		}

		return $menuLinks;
	}

	function getSideboxes()
	{


		$pluginBoxes = $this->controller->Event->trigger('getSideboxes');

		foreach($pluginBoxes['getSideboxes'] as $plugin => $links)
		{
			$title = $this->controller->enabledPlugins[$plugin]['title'];
			if(!isset($menuLinks[$title]))
			{
				$menuLinks[$title] = array();
			}

			$menuLinks[$title] += $links;
		}

		return $menuLinks;
	}
 }
?>