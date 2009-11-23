<?php
App::import('Core', 'l10n');
class AppController extends Controller
{
	var $helpers = array('Form', 'Html', 'Javascript', 'Menu', 'Time', 'Text', 'Css');
	var $components = array('RequestHandler', 'Session', 'CmscoutCore', 'AclExtend', 'Auth', 'DebugKit.Toolbar', 'Cookie', 'Event');
	var $menuAdminMode = false;
	var $_userDetails = null;
	var $enabledPlugins = array();

  	 /**
 	 * @var SessionComponent
 	 */
 	var $Session;
 	 /**
 	 * @var AclExtendComponent
 	 */
 	var $AclExtend;
 	 /**
 	 * @var AuthComponent
 	 */
 	var $Auth;
 	 /**
 	 * @var NotificationComponent
 	 */
 	var $Notification;

 	function beforeFilter()
	{
		App::import('Sanitize');

	 	$this->Auth->userScope = array('User.active' => 1);
	 	$this->Auth->authError = 'You do not have the required authorisation to access that page.';
		$this->Auth->autoRedirect = false;
		$this->Auth->loginAction = '/users/login';
		
		//Check if user is 'remembered'
		if($this->Auth->user() === null)
		{
			$cookie = $this->Cookie->read('Auth.User');
			if (!is_null($cookie))
			{
				if ($this->Auth->login($cookie))
				{
					//  Clear auth message, just in case we use it.
					$this->Session->delete('Message.auth');
				}
				else
				{
					// Delete invalid Cookie
					$this->Cookie->delete('Auth.User');
				}
			}
		}
		
		//Now handle setting user information
		$this->_userDetails = $this->Auth->user();
		if ($this->_userDetails != null)
		{		
			$this->AclExtend->setUser($this->_userDetails['User']['id']);

		 	$this->set('userInfo', $this->_userDetails);
		}
		else
		{
			//Guest user - check permissions
			
			if($this->isAuthorized())
			{
				$this->Auth->allow($this->action);
			}
		}
		
		if ($this->RequestHandler->isAjax() !== true)
		{
			$this->Auth->authorize = 'controller';
		}
		else
		{
			if(!$this->isAuthorized())
			{
				 $output = array('error' => 1, 'message' => 'You do not have the required authorisation to perform that action.');

 				$this->view = 'Json';
 				$this->set('output', $output);
 				$this->set('json', 'output');
 				
 				$this->render();
 				exit;
			}

			Configure::write('debug', 1);
			$this->layout = 'ajax';
		}		

        ClassRegistry::init('Configuration')->load();

		$theme = ClassRegistry::init('Theme')->find('first', array('conditions' => array('site_theme' => '1')));
		if($theme != false)
		{
			$this->view = 'Theme';
			$this->theme = $theme['Theme']['theme'];
		}
		
		$this->Event->trigger('beforeFilter');
	}

	function beforeRender()
	{
	 	if ($this->RequestHandler->isAjax() !== true)
		{
			$adminMode = $this->AclExtend->userPermissions('Administration panel', 'admin');
			
	        $this->set("menuArray", $this->CmscoutCore->mainMenu($this->menuAdminMode));
	 		$this->set('adminMode', $adminMode);

	 		if ($adminMode)
	 		{
	 			$this->set('adminMenu', $this->CmscoutCore->loadAdminMenu());
	 		}
		}
	}
	
 	public function isAuthorized()
 	{
 		$allowed = false;
 		
 		if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')
 		{
 			if(isset($this->actionMap[$this->action]))
 			{
 				if(is_array($this->actionMap[$this->action]))
 				{
 					$allowed = $this->AclExtend->userPermissions('Administration Panel/' . $this->actionMap[$this->action][0], $this->actionMap[$this->action][1]);
 				}
 				else
 				{
 					$allowed = $this->AclExtend->userPermissions('Administration Panel/' . $this->adminNode, $this->actionMap[$this->action]);
 				}
 			}
 			else
 			{
 				$allowed = $this->AclExtend->userPermissions('Administration Panel/' . $this->adminNode, '*');
 			}
 		}
 		else
 		{
 			$allowed = true;
 		}
 		
		return $allowed;
 	}
}
?>