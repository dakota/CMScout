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

 	/**
 	 * Loads list of possible menu items
 	 * 
 	 * @return void
 	 */
 	public function admin_index()
 	{
 		if ($this->AclExtend->userPermissions("Menu manager", null, 'read'))
		{
			$this->set('menuadminMode', true);
			$this->menuAdminMode = true;

 			$this->set('links', ClassRegistry::init('MenuLink')->find('all', array('contain' => array('Plugin'), 'order' => 'MenuLink.title ASC, Plugin.title ASC')));
 			$this->set('sideboxes', ClassRegistry::init('Sidebox')->find('all'));

 			$this->set('permissions', $this->AclExtend->userPermissions("Menu manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/');
		}
 	}
 	
 	/**
 	 * Moves, or adds a menu item (Depending on if the item exists or not.
 	 * 
 	 * @return void
 	 */
 	public function admin_move()
 	{
 		$currentId = explode('_', $this->params['named']['currentId']);
 		
 		if (isset($currentId[0]) && $this->Menu->doesIdExist($currentId[0]))
 		{
 			$this->Menu->moveItem($currentId, $this->params['named']['previousId'], Sanitize::escape($this->params['named']['menuId'], 'default'));
 		}
 		else
 		{
 			echo $this->Menu->insertItem($this->params['named']['previousId'], Sanitize::escape($this->params['named']['menuId'], 'default'), $this->params['form']);
 		}
 		
 		exit;
 	}
 	
 	/**
 	 * Removes an menu item.
 	 * 
 	 * @return void
 	 */
 	public function admin_remove()
 	{
 		$this->Menu->removeItem($this->params['named']['id']);
 		exit;
 	}
 	
 	/**
 	 * Updates a menu items options
 	 * 
 	 * @return void
 	 */
 	public function admin_update()
 	{
 		$id = Sanitize::paranoid($this->params['named']['id']);
 		$this->Menu->id = $id;
 		
 		$this->Menu->saveField('name', $this->params['form']['name']);
 		$this->Menu->saveField('option', $this->params['form']['option']);
 		
 		$menuItem = $this->Menu->find('first', array('contain' => 'MenuLink', 'conditions' => array('Menu.id' => $id)));
 		
 		if (isset($menuItem['MenuLink']['id']))
 		{
 			 $menuLink = array();

			$menuLink['plugin'] = (isset($menuItem['MenuLink']['Plugin']['directory'])) ? $menuItem['MenuLink']['Plugin']['directory'] : '';
			$menuLink['controller'] = $menuItem['MenuLink']['controller'];
			$menuLink['action'] = (isset($menuItem['MenuLink']['action']) && $menuItem['MenuLink']['action'] != '') ? $menuItem['MenuLink']['action'] : 'index';
			$menuLink[] = (isset($menuItem['Menu']['option']) && $menuItem['Menu']['option'] != '') ? $menuItem['Menu']['option'] : '';
			$menuLink['admin'] = false;

			$menuLink = Router::url($menuLink);
			
			echo $menuLink;
 		}
 		exit;
 	}
 }
?>