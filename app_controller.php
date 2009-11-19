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
		$this->Auth->authorize = 'controller';
	
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
					$this->Cookie->del('Auth.User');
				}
			}
		}
		
		$this->_userDetails = $this->Auth->user();
		if ($this->_userDetails != null)
		{		
			$this->AclExtend->setUser($this->_userDetails['User']['id']);

		 	$this->set('userInfo', $this->_userDetails);
		}

        ClassRegistry::init('Configuration')->load();
	
	 	if ($this->RequestHandler->isAjax() === true)
		{
			Configure::write('debug', 1);
			$this->layout = 'ajax';
		}

		$theme = ClassRegistry::init('Theme')->find('first', array('conditions' => array('site_theme' => '1')));
		if($theme == false)
		{
			$this->view = 'Theme';
			$this->theme = 'test';
		}
		
		$this->Event->trigger('beforeFilter');
	}

	function beforeRender()
	{
	 	if ($this->RequestHandler->isAjax() !== true)
		{
			$adminMode = $this->AclExtend->userPermissions("Administration panel", 'read');
			
	        $this->set("menuArray", $this->CmscoutCore->mainMenu($this->menuAdminMode));
	 		$this->set('adminMode', $adminMode);

	 		if ($adminMode)
	 		{
	 			$this->set('adminMenu', $this->CmscoutCore->loadAdminMenu());
	 		}
		}

		/*foreach ($this->modelNames as $modelsName)
		{
			if (isset($this->$modelsName->Behaviors) && $this->$modelsName->Behaviors->attached('Publishable'))
			{
				$this->$modelsName->setUser($this->Auth->user('id'));
			}

			if (isset($this->$modelsName->Behaviors) && $this->$modelsName->Behaviors->attached('Commentable'))
			{
				$modelName = (isset($this->$modelsName->plugin)) ? $this->$modelsName->plugin . '.' : '';
				$modelName .= $modelsName;

				$this->set('model', $modelName);
				$this->set('commentAuth', $this->AclExtend->userPermissions("Comments", null, '*', null, true));
			}
		}*/
	}
	
 	public function isAuthorized()
 	{
 		if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')
 		{
 			if(isset($this->actionMap[$this->action]))
 			{
 				if(is_array($this->actionMap[$this->action]))
 				{
 					return $this->AclExtend->userPermissions('Administration Panel/' . $this->actionMap[$this->action][0], $this->actionMap[$this->action][1]);
 				}
 				else
 				{
 					return $this->AclExtend->userPermissions('Administration Panel/' . $this->adminNode, $this->actionMap[$this->action]);
 				}
 			}
 			else
 			{
 				return $this->AclExtend->userPermissions('Administration Panel/' . $this->adminNode, '*');
 			}
 		}
 		else
 		{
 			return true;
 		}
 	}
}
?>