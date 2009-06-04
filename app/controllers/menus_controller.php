<?php
 class MenusController extends AppController
 {
 	var $name = 'Menus';
 	 /**
 	 * @var Menu
 	 */
 	var $Menu;
 	 /**
 	 * @var Page
 	 */
 	var $Page;
 	/**
 	 * @var SessionComponent
 	 */
 	var $Session;

 	function admin_index()
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

 	function admin_saveMenu()
 	{
 		if ($this->AclExtend->userPermissions("Menu manager", null, 'update'))
		{
			$this->Menu->saveMenu($this->params['form']);
		}
 		exit;
 	}
 	
 	function admin_move()
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
 	
 	function admin_remove()
 	{
 		$this->Menu->removeItem($this->params['named']['id']);
 		exit;
 	}
 	
 	function admin_update()
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