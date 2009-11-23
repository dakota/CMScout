<?php
class Menu extends AppModel 
{
 var $name = 'Menu';
 var $order = "Menu.order ASC";
 
 function moveItem($currentItem, $previousItem, $menuId)
 {
 	 if ($previousItem != NULL && isset($previousItem['itemInfo']['id']))
 	{
 		$previousItem = $this->findById($previousItem['itemInfo']['id']);

 		if(isset($previousItem['Menu']['order']))
			$newOrder = $previousItem['Menu']['order'] + 1;
		else
			$newOrder = 1;
 	}
 	else
 	{
 		$newOrder = 1;
 	}

 	//$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => $menuId));
 	
 	$this->data = array();
 	$this->data['Menu']['id'] = $currentItem['itemInfo']['id'];
 	$this->data['Menu']['order'] = $newOrder;
 	$this->data['Menu']['menu_id'] = $menuId;

 	if($this->save($this->data))
 	{
 		$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => Sanitize::clean($menuId) , 'Menu.id <>' => $this->data['Menu']['id']));

 		return true;
 	}
 	
 	return false; 	
 }
 
 function insertItem($insertItem, $previousItem, $menuId)
 {
 	if ($previousItem != NULL && isset($previousItem['itemInfo']['id']))
 	{
 		$previousItem = $this->findById($previousItem['itemInfo']['id']);

 		if(isset($previousItem['Menu']['order']))
			$newOrder = $previousItem['Menu']['order'] + 1;
		else
			$newOrder = 1;
 	}
 	else
 	{
 		$newOrder = 1;
 	}

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
 	
 	if(isset($this->data['Menu']['plugin']) && is_array($this->data['Menu']['plugin']))
 	{
 		$this->data['Menu']['plugin'] = strtolower($this->data['Menu']['plugin']['name']);
 	}
 	
  	
 	if($this->save($this->data))
 	{
 		$newId = $this->id;
 		$this->updateAll(array('Menu.order' => 'Menu.order + 1'), array('Menu.order >=' => $newOrder, 'Menu.menu_id' => Sanitize::clean($menuId) , 'Menu.id <>' => $newId));
 		
 		return $newId;
 	}
 	
 	return false;
 }
 
 function removeItem($id)
 {
 	$item = $this->findById($id);
 	
 	if($this->delete($id))
 	{
 		$this->updateAll(array('Menu.order' => 'Menu.order - 1'), array('Menu.order >=' => $item['Menu']['order'], 'Menu.menu_id' => $item['Menu']['menu_id']));
 		
 		return true;
 	}
 	
 	return false;
 }
 
 function afterSave($created)
 {
 	$this->flushMenuCache();
 }
}
?>