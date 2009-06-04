<?php
 class ConfigurationsController extends AppController 
 {
 	var $name = "Configurations";
 	
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
 	
 	function admin_index()
 	{
		if ($this->AclExtend->userPermissions("Configuration manager", null, 'read'))
		{
			$configs = $this->Configuration->readConfigs();
				
			$this->set(compact('configs'));
			
			if (!empty($this->data))
			{
				$this->Configuration->saveConfiguration($this->params['form']);
				
				$this->Session->setFlash('Configuration saved', null);
			}
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/');
		}
 	}
 }

?>