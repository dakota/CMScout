<?php
 class MenusController extends AppController
 {
 	var $name = 'Menus';
 	var $uses = array("Menu", "MenuLink", "Sidebox");
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

 			$this->set('links', $this->MenuLink->find('all', array('contain' => array('Plugin'), 'order' => 'MenuLink.title ASC, Plugin.title ASC')));
 			$this->set('sideboxes', $this->Sidebox->find('all'));

 			$this->set('permissions', $this->AclExtend->userPermissions("Menu manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
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
 }
?>