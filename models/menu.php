<?php
class Menu extends AppModel 
{
 var $name = 'Menu';
 var $belongsTo = array('Plugin');
 var $order = "Menu.order ASC";
 
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
 
 function moveItem($currentId, $beforeId, $menuId)
 {
 	if ($beforeId != 'undefined')
 	{
 		$beforeItem = $this->findById($beforeId);

 		if(isset($beforeItem['Menu']['order']))
			$newOrder = $beforeItem['Menu']['order'] + 1;
		else
			$newOrder = 1;
 	}
 	else
 	{
 		$newOrder = 1;
 	}

 	$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => $menuId));
 	
 	$this->id = $currentId;
 	$this->saveField('order', $newOrder);
 	$this->saveField('menu_id', $menuId);
 }
 
 function insertItem($beforeId, $menuId, $parameters)
 {
 	if ($beforeId != 'undefined')
 	{
 		$beforeItem = $this->findById($beforeId);

 		if(isset($beforeItem['Menu']['order']))
			$newOrder = $beforeItem['Menu']['order'] + 1;
		else
			$newOrder = 1;
 	}
 	else
 	{
 		$newOrder = 1;
 	}
 	
 	$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => $menuId));
 	
 	$this->data = array();
 	$this->data['Menu']['name'] = trim($parameters['name']);
 	$this->data['Menu']['option'] = trim($parameters['option']);
 	$this->data['Menu']['menu_id'] = $menuId;
 	$this->data['Menu']['order'] = $newOrder;
 	
 	if ($parameters['isBox'] == 'false')
 	{
 		$this->data['Menu']['menu_link_id'] = $parameters['linkId'];
 	}
 	else
 	{
 		$this->data['Menu']['sidebox_id'] = $parameters['boxId'];
 	}
 	
 	$this->save();
 	
 	return $this->id;
 }
 
 function removeItem($id)
 {
 	$item = $this->findById($id);
 	
 	$this->updateAll(array('Menu.order' => 'Menu.order - 1'), array('Menu.order >=' => $item['Menu']['order'], 'Menu.menu_id' => $item['Menu']['menu_id']));
 	
 	$this->del($id);
 }
}
?>