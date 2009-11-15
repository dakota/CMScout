<?php
App::import('Core', 'l10n');
class AppController extends Controller
{
	var $helpers = array('Form', 'Html', 'Javascript', 'showMenu', 'Time', 'Text', 'Css');
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
		$this->Auth->autoRedirect = false;
		$this->Auth->loginAction = '/users/login';
		
		$this->_userDetails = $this->Auth->user();
		if ($this->_userDetails != null)
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
			$this->AclExtend->setUser($this->_userDetails['User']['id']);

		 	$this->set('userInfo', $this->_userDetails);
		}

        ClassRegistry::init('Configuration')->load();
	
	 	if ($this->RequestHandler->isAjax() === true)
		{
			Configure::write('debug', 0);
		}

		$this->Event->trigger('beforeFilter');
	}

	function beforeRender()
	{
	    $theme = ClassRegistry::init('Theme')->find('first', array('conditions' => array('site_theme' => '1')));
		if($theme !== false)
		{
			$this->view = 'Theme';
			$this->theme = $theme['Theme']['directory'];
		}
		
	 	if ($this->RequestHandler->isAjax() === true)
		{
			$this->layout = 'ajax';
		}
		else
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
}
?>