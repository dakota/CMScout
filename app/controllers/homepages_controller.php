<?php
class HomepagesController extends AppController
{
	var $name = "Homepages";
	
	/**
	 * @var SessionComponent
	 */
	var $Session;
	/**
	 * @var AclComponent
	 */
	var $Acl;
	/**
	 * @var AuthComponent
	 */
	var $Auth;
	/**
	 * @var Homepage
	 */
	var $Homepage;
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow('index');
	}

	function index()
	{
		$homepage = $this->Homepage->getHomepage();
		
		$this->set(compact('homepage'));
	}
	
	function admin_index()
	{
		if ($this->AclExtend->userPermissions("Homepage manager", null, 'read'))
		{
			$this->set('firstColumn', $this->Homepage->find('all', array('conditions' => array('column' => 0), 'contains' => array('MenuLink' => array('Plugin')))));
			$this->set('secondColumn', $this->Homepage->find('all', array('conditions' => array('column' => 1), 'contains' => array('MenuLink' => array('Plugin')))));
			
			$this->set('links', $this->Homepage->MenuLink->find('all', array('conditions' => array('frontpage' => 1), 'contains' => 'Plugin')));
			
			$this->set('permissions', $this->AclExtend->userPermissions("Homepage manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/');
		}
	}
	
	function admin_homepage()
	{
	}
	
	function admin_save()
	{	
		if ($this->AclExtend->userPermissions("Homepage manager", null, 'update'))
		{
			$this->Homepage->saveHomepage($this->params['form']);
		}
		
		exit;
	}
}

?>