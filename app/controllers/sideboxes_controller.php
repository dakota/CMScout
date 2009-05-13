<?php
class SideboxesController extends AppController
{
	var $name = "Sideboxes";
	
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
		
		$this->Auth->allow('view');
	}
	
	function admin_menu($sidebox)
	{
		exit;
	}
	
	function view($sideBoxId)
	{
		$this->Sidebox->bindModel(
	        array('belongsTo' => array(
	                'Plugin' => array(
	                    'className' => 'Plugin'
	                )
	            )
	        )
	    );			
		
		$sideboxItem = $this->Sidebox->find('first', array('conditions' => array ('Sidebox.id' => $sideBoxId), 'contain' => array('Plugin')));
		
		return $sideboxItem;
	}
	
}

?>