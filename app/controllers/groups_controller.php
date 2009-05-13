<?php
 class GroupsController extends AppController 
 {
 	var $name = 'Groups';
 	
 	 /**
 	 * @var Group
 	 */
 	var $Group;
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

  	
 	function admin_newGroup()
 	{	
 		if ($this->AclExtend->userPermissions("Groups", null, 'create'))
 		{
	 		$this->data['Group']['title'] = $this->params['form']['name'];
	 		$this->Group->create();
	 		$this->Group->save($this->data);
	 		echo $this->Group->id;
 		}
 		exit;
 	}

 	function admin_renameGroup()
 	{	
 		if ($this->AclExtend->userPermissions("Groups", null, 'update'))
 		{ 		
	 		$this->Group->id = $this->params['form']['id'];
	 		$this->data['Group']['title'] = $this->params['form']['name'];
	 		$this->Group->save($this->data);
 		}
 		exit;
 	}
 	
 	
  	function admin_deleteGroup()
 	{	
 		if ($this->AclExtend->userPermissions("Groups", null, 'delete'))
 		{ 	
	 		$this->Group->id = $this->params['form']['id'];
	 		$this->Group->delete();
 		}
 		exit;
 	}
 	
   	function admin_loadInformation($groupId)
  	{
  		$this->data = $this->Group->find('first', array('conditions' => array('id'=>$groupId), 'contains'=> false));	
  	}
 }
 ?>