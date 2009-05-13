<?php
 class loadMenuComponent extends Object
 {
 	function mainMenu($menuAdminMode = false)
 	{
 		$menuInstance = ClassRegistry::init('Menu');
 		$menus = $menuInstance->find('all', array('contain' => array('MenuLink' => array('Plugin'), 'Sidebox' => array('Plugin'))));

 		if (!$menuAdminMode)
 		{
	 		foreach ($menus as $key => $item)
	 		{
	 			if (isset($item['Sidebox']['model']) && $item['Sidebox']['model'] != '')
	 			{
	 				$modelName = ((isset($item['Sidebox']['Plugin']['directory'])) ? Inflector::camelize($item['Sidebox']['Plugin']['directory']) . '.' : '') . Inflector::classify($item['Sidebox']['model']);

					App::Import('Model', $modelName);
					$className = Inflector::classify($item['Sidebox']['model']);

					$model = new $className();

					$menus[$key]['Sidebox']['Data'] = $model->getMenu();
	 			}
	 		}
 		}

 		return $menus;
 	}
 }
?>