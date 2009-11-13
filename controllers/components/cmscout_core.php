<?php
 class CmscoutCoreComponent extends Object
 {
 	var $controller;
 	
 	function initialize(&$controller, $settings = array())
	{
		// saving the controller reference for later use
		$this->controller =& $controller;

		$this->controller->enabledPlugins = $this->enabledPlugins();
	}
	
 	function mainMenu($menuAdminMode = false)
 	{
 		$guestUser = $this->controller->_userDetails === null;
 		$cacheName = 'menu.'.($guestUser===false?'user':'guest').'.'.($menuAdminMode===false?'normal':'admin');

 		if(($menus = Cache::read($cacheName, 'core')) === false)
 		{
 			$menus = ClassRegistry::init('Menu')->find('all', array('contain' => array('MenuLink' => array('Plugin'), 'Sidebox' => array('Plugin'))));
 			if (!$menuAdminMode)
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
	 		}
	 		
	 		Cache::write($cacheName, $menus, 'core');
 		}
 		
 		return $menus;
 	}
 	
 	function flushMenuCache()
 	{
 		Cache::delete('menu', 'core');
 	}
 	
 	function loadAdminPlugins()
 	{
  		//if (($adminMenu = Cache::read('plugin.adminMenu', 'core')) === false)
 		{
			$adminMenu = array();

			$pluginCategories = Set::Combine($this->controller->enabledPlugins, '{n}.Plugin.name', '{n}.Plugin');
 			$availableAdminFunctions = $this->controller->Event->trigger('adminLinks');

			foreach($availableAdminFunctions['adminLinks'] as $plugin => $links)
			{
				$category = $pluginCategories[$plugin]['category'];
				$title = $pluginCategories[$plugin]['title'];

				if(!isset($adminMenu[$category]))
				{
					$adminMenu[$category] = array();
				}

				$adminMenu[$category][$pluginCategories[$plugin]['title']] = $links;
			}

 			Cache::write('plugin.adminMenu', $adminMenu, 'core');
 		}
 		
 		return $adminMenu;
 	}
 	
 	function enabledPlugins()
 	{
		//if (($pluginList = Cache::read('plugin.enabled', 'core')) === false)
 		{
 			$pluginList = ClassRegistry::init('Plugin')->find('all', array('contain' => false, 'conditions' => array('Plugin.enabled')));
 			Cache::write('plugin.enabled', $pluginList, 'core');
 		}
 	
 		return $pluginList;
 	}
 }
?>