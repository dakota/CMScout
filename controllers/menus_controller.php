<?php
/**
 * This file is part of CMScout.
 *  
 * CMScout is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *  
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with CMScout.  If not, see <http://www.gnu.org/licenses/>.
 *    
 * @filesource
 * @copyright		Copyright 2009, CMScout.
 * @link			http://www.cmscout.co.za/
 * @package			cmscout3
 * @subpackage		cmscout3.core
 * @since			CMScout3 v 1.0.0
 * @license			GPLv3 
 *  
 */
 class MenusController extends AppController
 {
 	/**
 	 * Name property
 	 * 
 	 * @var String
 	 */
 	public $name = 'Menus';

 	public	$actionMap = array(
 		'admin_index' => 'read',
 		'admin_move' => 'update',
 		'admin_delete' => 'update',
 		'admin_update' => 'update'
 	);
 	
 	public $adminNode = 'Menu Manager'; 	
 	
 	/**
 	 * Loads list of possible menu items
 	 * 
 	 * @return void
 	 */
 	public function admin_index()
 	{
		if ($this->AclExtend->userPermissions("Administration Panel/Menu Manager", 'update'))
 		{
			$this->set('menuadminMode', true);
			$this->menuAdminMode = true;
 		}

 		$this->set('availableMenus', $this->CmscoutCore->getAvailableMenus());
 	}
 	
 	/**
 	 * Moves, or adds a menu item (Depending on if the item exists or not.
 	 * 
 	 * @return void
 	 */
 	public function admin_move()
 	{
 		if(isset($this->params['form']['current']) && isset($this->params['form']['previous']))
 		{
	 		$currentItem = Set::reverse(json_decode($this->params['form']['current']));
	 		$previousItem = Set::reverse(json_decode($this->params['form']['previous']));
	
	 		if (isset($currentItem['itemInfo']['id']) && $this->Menu->doesIdExist($currentItem['itemInfo']['id']))
	 		{
	 			$moved = $this->Menu->moveItem($currentItem, $previousItem, Sanitize::escape($this->params['named']['menuId'], 'default'));
	 			$output = array('error' => !$moved, 'message' => ($moved == 1 ? 'Saved' : 'Error saving'));
	 		}
	 		else
	 		{
	 			$id = $this->Menu->insertItem($currentItem, $previousItem, Sanitize::escape($this->params['named']['menuId'], 'default'));
	 			$output = array(
	 				'id' => $id,
	 				'error' => !$id,
	 				'message' => ($id !== false ? 'Saved' : 'Error saving')
	 			);
	 		}
 		}
 		else
 		{
 			$output = array('error' => 1, 'message' => 'Incorrect parameters');
 		}
 		
 		$this->view = 'Json';
 		$this->set('output', $output);
 		$this->set('json', 'output');
  	}
 	
 	/**
 	 * Removes an menu item.
 	 * 
 	 * @return void
 	 */
 	public function admin_delete()
 	{
 		if (isset($this->params['named']['id']) && $this->Menu->doesIdExist($this->params['named']['id']))
	 	{ 		
		 	$deleted = $this->Menu->removeItem($this->params['named']['id']);
		 	$output = array('error' => !$deleted, 'message' => ($deleted == 1 ? 'Deleted' : 'Error deleting'));
	 	}
	 	else
	 	{
	 		$output = array('error' => 1, 'message' => 'Incorrect parameters');
	 	}
	 	
 		$this->view = 'Json';
 		$this->set('output', $output);
 		$this->set('json', 'output');	 	
 	}
 	
 	/**
 	 * Updates a menu items options
 	 * 
 	 * @return void
 	 */
 	public function admin_update()
 	{

 		if(isset($this->params['form']['itemData']) && isset($this->params['form']['itemData']))
 		{
	 		$item = Set::reverse(json_decode($this->params['form']['itemData']));
	 		
	 		$data = array();
	 		$data['Menu']['id'] = $item['itemInfo']['id'];
	 		$data['Menu']['title'] = $item['itemInfo']['title'];
	 		$data['Menu']['options'] = serialize($item['itemInfo']['options']);
	 		
	 		if($this->Menu->save($data))
	 		{
	 			$output = array('error' => 0, 'message' => 'Saved');
	 		}
	 		else
	 		{
	 			$output = array('error' => 1, 'message' => 'Error saving');
	 		}
 		}
 	 	else
 		{
 			$output = array('error' => 1, 'message' => 'Incorrect parameters');
 		}

 		$this->view = 'Json';
 		$this->set('output', $output);
 		$this->set('json', 'output');
 	}
 }
?>