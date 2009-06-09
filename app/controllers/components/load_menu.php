<?php
 class loadMenuComponent extends Object
 {
 	function mainMenu($guestUser = false, $menuAdminMode = false)
 	{
 		if(($menus = Cache::read('menu_'.(string)$guestUser.'_'.(string)$menuAdminMode, 'core')) === false)
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
	 		
	 		Cache::write('menu_'.(string)$guestUser.'_'.(string)$menuAdminMode, $menus, 'core');
 		}
 		
 		return $menus;
 	}
 }
?>