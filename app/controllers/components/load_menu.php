<?php
 class loadMenuComponent extends Object
 {
 	function mainMenu($guestUser = false, $menuAdminMode = false)
 	{
 		$menus = ClassRegistry::init('Menu')->find('all', array('contain' => array('MenuLink' => array('Plugin'), 'Sidebox' => array('Plugin'))));

 		if (!$menuAdminMode)
 		{
	 		foreach ($menus as $key => $item)
	 		{
	 			if (isset($item['Sidebox']['model']) && $item['Sidebox']['model'] != '')
	 			{
	 				$modelName = ((isset($item['Sidebox']['Plugin']['directory'])) ? Inflector::camelize($item['Sidebox']['Plugin']['directory']) . '.' : '') . Inflector::classify($item['Sidebox']['model']);
	 				if(($sideboxData = Cache::read($modelName . '_sidebox','core')) === false)
	 				{
						$sideboxData = ClassRegistry::init($modelName)->getMenu();
						Cache::write($modelName . '_sidebox', $sideboxData, 'core');
	 				}
					
					$menus[$key]['Sidebox']['Data'] = $sideboxData;
	 			}
	 		}
 		}

 		return $menus;
 	}
 }
?>