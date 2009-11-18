<?php
 class menuHelper extends AppHelper
 {
 	var $helpers = array('Html');

 	function renderMenu($menuData, $menuId, $hasBoxes, $adminMode)
 	{
		$View =& ClassRegistry::getObject('view');
		$output = '';
		
		if(isset($menuData[$menuId]))
		{
			foreach($menuData[$menuId] as $menuItem)
			{
				$output .= '<li>';
				if($menuItem['sidebox'] == 1)
				{
					$output .= $View->element('menu_box', compact('menuItem'));
				}
				else
				{
					$output .= $View->element('menu_link', compact('menuItem'));
				}
				$output .= '</li>';
			}
		}
		
		return $output;
 	}
 }
?>