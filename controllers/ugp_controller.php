<?php
class UgpController extends AppController
{
	public $uses = array('Users');

	/**
	 * Helper array
	 * @var array
	 */
 	public $helpers = array('Threaded');	
	
	public $actionMap = array(
		'admin_index' => 'read',
		'admin_loadAroTree' => 'read',
		'admin_loadAcoTree' => 'read',
		'admin_loadPermissions' => 'read',
		'admin_updatePermissions' => 'update',
		'admin_updateUserGroups' => array('User groups', 'update')		
 	);
 	
 	public $adminNode = 'UGP Manager';
 	
	/*
 	 * Administrative actions and functions
 	 */
 	public function admin_index()
 	{
		$this->set('UGPPermissions', $this->AclExtend->userPermissions("Administration Panel/UGP Manager", '*', null, true));
		$this->set('userPermissions', $this->AclExtend->userPermissions("Administration Panel/Users", '*', null, true));
		$this->set('groupPermissions', $this->AclExtend->userPermissions("Administration Panel/Groups", '*', null, true));
		$this->set('ACOTree', $this->AclExtend->AcoTree());
		$this->set('AROTree', $this->AclExtend->AroTree());
 	}

  	public function admin_loadAroTree()
  	{
  		$this->set('AROTree', $this->AclExtend->AroTree());
  	}

  	public function admin_loadAcoTree()
  	{
  		$this->set('ACOTree', $this->AclExtend->AcoTree());
  	}

 	public function admin_updatePermissions()
 	{
		$this->AclExtend->updatePermissions($this->params['form']);
 		exit;
 	}

 	public function admin_loadPermissions($id)
 	{
    	$this->set('permissions', $this->AclExtend->getPermissions($id));
    	$this->set('json', 'permissions');
    	$this->view = 'json';
  	}

 	public function admin_updateUserGroups()
 	{
 		$items = $this->params['form']['item'];
 		$groupUsers = ClassRegistry::init("GroupsUser");

 		$userGroups = array();
 		foreach ($items as $item)
 		{
 			$id = explode('_', $item);
 			if (isset($id[3]))
 			{
	 			$userGroups[] = array('group_id' => $id[1], 'user_id' => $id[3]);
 			}
 		}

 		$groupUsers->query('truncate table groups_users;');
		$groupUsers->saveAll($userGroups);
 		exit;
 	}
}