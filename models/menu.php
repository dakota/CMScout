<?php
class Menu extends AppModel 
{
 var $name = 'Menu';
 var $order = "Menu.order ASC";
 
 function moveItem($currentItem, $previousItem, $menuId)
 {
 	 if ($previousItem != NULL && isset($previousItem['id']))
 	{
 		$previousItem = $this->findById($previousItem);

 		if(isset($previousItem['Menu']['order']))
			$newOrder = $previousItem['Menu']['order'] + 1;
		else
			$newOrder = 1;
 	}
 	else
 	{
 		$newOrder = 1;
 	}

 	$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => $menuId));
 	
 	$this->id = $currentItem['id'];
 	$this->saveField('order', $newOrder);
 	$this->saveField('menu_id', $menuId);
 	
 	return true;
 }
 
 function insertItem($insertItem, $previousItem, $menuId)
 {
 	if ($previousItem != NULL && isset($previousItem['id']))
 	{
 		$previousItem = $this->findById($previousItem['id']);

 		if(isset($previousItem['Menu']['order']))
			$newOrder = $previousItem['Menu']['order'] + 1;
		else
			$newOrder = 1;
 	}
 	else
 	{
 		$newOrder = 1;
 	}
 	
 	$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => $menuId));
 	
 	$this->data = array();
 	$this->data['Menu'] = $insertItem['itemInfo'];
 	$this->data['Menu']['options'] = serialize($this->data['Menu']['options']);
 	$this->data['Menu']['menu_id'] = $menuId;
 	$this->data['Menu']['order'] = $newOrder;

 	if ($insertItem['isbox'] === false)
 	{
 		$this->data['Menu']['sidebox'] = 0;
 	}
 	else
 	{
 		$this->data['Menu']['sidebox'] = 1;
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