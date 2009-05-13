<?php
class Menu extends AppModel 
{
 var $name = 'Menu';
 var $belongsTo = array('MenuLink', 'Sidebox');
 
 function saveMenu($data)
 {
  	$menu = array();
 	$id = 0;
 	foreach ($data['mainMenu'] as $menuId => $items)
 	{
 		$i = 1;
 		foreach ($items as $item)
 		{
            $tempMenu = array();
 			$tempMenu['id'] = ++$id;
 			$tempMenu['name'] = $item['name'];
 			
 			$tempMenu['option'] = trim($item['option']);

 			$tempMenu['menu_id'] = $menuId;
 			$tempMenu['order'] = $i++;
            
            if (isset($item['sidebox_id']) && $item['sidebox_id'] != "undefined")
 			{
 				$tempMenu['sidebox_id'] = $item['sidebox_id'] ;
 			}
 			elseif (isset($item['menu_link_id']) && $item['menu_link_id'] != "undefined")
 			{
 				$tempMenu['menu_link_id'] = $item['menu_link_id'] ;
 			}

 			if (isset($tempMenu['sidebox_id']) || isset($tempMenu['menu_link_id']))
 			{
 				$menu[] = $tempMenu;
 			}
 		}
 	}

 	$this->query('truncate table menus;');
 	
 	return $this->saveAll($menu);
 }
}
?>