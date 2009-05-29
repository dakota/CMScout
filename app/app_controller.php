<?php
App::import('Core', 'l10n');
class AppController extends Controller
{
	var $helpers = array('Form', 'Html', 'Javascript', 'showMenu', 'Time', 'Text', 'Tagcloud');
	var $components = array('Session', 'loadMenu', 'AclExtend', 'Auth', 'RequestHandler', 'DebugKit.Toolbar', 'Notification', 'Cookie');
	var $uses = array('Configuration', 'Theme');
	var $view = 'Theme';
	var $theme = 'default';
	var $menuAdminMode = false;
	var $_isAjax = false;

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

		if (!$this->Auth->user())
		{
			$cookie = $this->Cookie->read('Auth.User');
			if (!is_null($cookie))
			{
				if ($this->Auth->login($cookie))
				{
					//  Clear auth message, just in case we use it.
					$this->Session->del('Message.auth');
				}
				else
				{
					// Delete invalid Cookie
					$this->Cookie->del('Auth.User');
				}
			}
		}

		$this->AclExtend->setUser($this->Auth->user('id'));

	 	$this->set('userInfo', $this->Auth->user());

		if (isset($this->Configuration) && !empty($this->Configuration->table))
        {
        	$this->Configuration->load();
        }

		$this->L10n = new L10n();
		$this->L10n->get("eng");

		Configure::write('Config.language', "en");

	 	if (!$this->RequestHandler->isAjax())
		{
			$this->Auth->loginAction = '/users/login';
			$this->set('menuadminMode', false);
		}
		else
		{
			$this->_isAjax = true;
			Configure::write('debug', 1);
		}
	}

	function beforeRender()
	{
	    $theme = $this->Theme->find('first', array('conditions' => array('site_theme' => '1')));
        $this->theme = $theme['Theme']['directory'];

	 	if ($this->RequestHandler->isAjax())
		{
			$this->layout = 'ajax';
			$this->set('ajaxLoad', true);
		}
		else
		{
			$adminMode = $this->AclExtend->userPermissions("Administration panel", null, 'read');
			
	        $this->set("menuArray", $this->loadMenu->mainMenu($this->menuAdminMode));
	 		$this->set('adminMode', $adminMode);

	 		if ($adminMode)
	 		{
	 			$plugins = ClassRegistry::init('Plugin');
	 			$this->set('pluginList', $plugins->find('all', array('contain' => false)));
	 		}
		}

		foreach ($this->modelNames as $modelsName)
		{
			if ($this->$modelsName->Behaviors->attached('Publishable'))
			{
				$this->$modelsName->setUser($this->Auth->user('id'));
			}

			if ($this->$modelsName->Behaviors->attached('Commentable'))
			{
				$modelName = (isset($this->$modelsName->plugin)) ? $this->$modelsName->plugin . '.' : '';
				$modelName .= $modelsName;

				$this->set('model', $modelName);
				$this->set('commentAuth', $this->AclExtend->userPermissions("Comments", null, '*', null, true));
			}
		}
	}
}
?>