<?php
 class UsersController extends AppController
 {
 	var $name = 'Users';

 	var $uses = array('User', 'Contribution');

 	var $components = array('Upload');

 	var $helpers = array('Threaded');
 	 /**
 	 * @var User
 	 */
 	var $User;
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
 	 * @var UploadComponent
 	 */
 	var $Upload;

 	function beforeFilter()
 	{
 		parent::beforeFilter();

 		$this->Auth->allow('register', 'reminder');
 	}

 	/*
 	 * Standard actions
 	 */

 	function login()
 	{
	 	//-- code inside this function will execute only when autoRedirect was set to false (i.e. in a beforeFilter).
		if ($this->Auth->user())
		{
			if (!empty($this->data) && $this->data['User']['remember_me'])
			{
				$cookie = array();
				$cookie['username'] = $this->data['User']['username'];
				$cookie['password'] = $this->data['User']['password'];
				$this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
				unset($this->data['User']['remember_me']);
			}
			$this->redirect($this->Auth->redirect());
		}

		if (empty($this->data))
		{
			$cookie = $this->Cookie->read('Auth.User');
			if (!is_null($cookie))
			{
				if ($this->Auth->login($cookie))
				{
					//  Clear auth message, just in case we use it.
					$this->Session->del('Message.auth');
					$this->redirect($this->Auth->redirect());
				}
				else
				{
					// Delete invalid Cookie
					$this->Cookie->del('Auth.User');
				}
			}
		}
 	}

 	function admin_login()
 	{
 		$this->redirect("/users/login");
 	}


 	function logout()
 	{
 		$this->Cookie->del('Auth.User');
 		$this->Auth->logout();
 		$this->redirect('/');
 	}

 	function register()
 	{
 		if (!empty($this->data))
 		{
			if(isset($this->data['User']['password_confirm']))
			{
				$this->data['User']['password_confirmHash'] = $this->Auth->password($this->data['User']['password_confirm']);
			}

			if(isset($this->data['User']['clear_password']))
			{
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['clear_password']);
			}

			$this->User->create();

 			if ($this->User->save($this->data))
 			{
 				$group = $this->User->Group->find('first', array('conditions' => array('title' => 'All users'), 'contain' => false));
 				$this->User->Group->habtmAdd('User', $group['Group']['id'], $this->User->id);

 				$this->Notification->sendNotification('new_user', $this->data);
 				$this->Notification->sendIndividualNotification('registration_info', $this->User->id);

 				if (!$this->RequestHandler->isAjax())
 				{
 					$this->Session->setFlash(__('Thank you for registering', true), '');
 					$this->redirect('/users/login');
 				}
 				else
 				{
 					$this->view = 'Json';
        			$this->set('allGood', 'true');
        			$this->set('json', 'allGood');
         			$this->data = null;
 				}
 			}
 			else
 			{
 				if (!$this->RequestHandler->isAjax())
 				{
 					$this->Session->setFlash(__('There was an error found', true));
 					$this->data = null;
 				}
 				else
 				{
        			$errorItems = $this->User->invalidFields();;

 					$this->view = 'Json';
        			$this->set('errorItems', $errorItems);
        			$this->set('json', 'errorItems');
         			$this->data = null;
 				}
 			}
 		}
 	}

 	/*
 	 * Administrative actions and functions
 	 */
 	function admin_index()
 	{
 		if ($this->AclExtend->userPermissions("UGP manager", null, 'read'))
		{
			$this->set('UGPPermissions', $this->AclExtend->userPermissions("UGP manager", null, '*', null, true));
			$this->set('userPermissions', $this->AclExtend->userPermissions("Users", null, '*', null, true));
			$this->set('groupPermissions', $this->AclExtend->userPermissions("Groups", null, '*', null, true));
			$this->set('ACOTree', $this->AclExtend->AcoTree());
			$this->set('AROTree', $this->AclExtend->AroTree());
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/');
		}
 	}

  	function admin_loadAroTree()
  	{
  		$this->set('AROTree', $this->AclExtend->AroTree());
  	}

  	function admin_loadAcoTree()
  	{
  		$this->set('ACOTree', $this->AclExtend->AcoTree());
  	}

 	function admin_updatePermissions()
 	{
 		if ($this->AclExtend->userPermissions("UGP manager", null, 'update'))
 		{
			$this->AclExtend->updatePermissions($this->params['form']);
 		}

 		exit;
 	}

 	function admin_loadPermissions()
 	{
        $this->set('returnVar', $this->AclExtend->loadPermissions($this->params['form']));
  	}

 	function admin_updateUserGroups()
 	{
 		if ($this->AclExtend->userPermissions("User groups", null, 'update'))
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

	 		debug($userGroups);

	 		$groupUsers->query('truncate table groups_users;');
			$groupUsers->saveAll($userGroups);
 		}
 		exit;
 	}

   	function admin_homepage()
  	{
  	}

  	function admin_loadInformation($userId = null)
  	{
  		$this->data = $this->User->find('first', array('conditions' => array('id'=>$userId), 'contains'=> false));
  	}

  	function admin_toggleStatus($userId)
  	{
  		$this->User->toggleField('active', $userId);

  		$this->Notification->sendIndividualNotification('user_status', $userId);

  		if ($this->RequestHandler->isAjax())
  		{
  			echo Router::url(array('controller' => 'users', 'action' => 'loadInformation', 'prefix' => 'admin', 0 => $userId), true);
  			exit;
  		}
  		else
  		{
  			$this->redirect(array('controller' => 'users', 'action' => 'loadInformation', 'prefix' => 'admin', 0 => $userId));
  		}
  	}

  	function admin_edit($userId)
  	{
  		if (!empty($this->data))
 		{
 			if(isset($this->data['User']['clear_password']))
			{
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['clear_password']);
			}

 		 	if ($this->User->save($this->data))
 			{
 				if (!$this->RequestHandler->isAjax())
 				{
 					$this->Session->setFlash(__('Saved.', true), '');
 					$this->redirect(array('controller' => 'users', 'action' => 'loadInformation', 'prefix' => 'admin', 0 => $userId));
 				}
 				else
 				{
 					$this->view = 'Json';
        			$this->set('allGood',array('url' => Router::url(array('controller' => 'users', 'action' => 'loadInformation', 'prefix' => 'admin', 0 => $userId)), 'ok' => 'true'));
        			$this->set('json', 'allGood');
         			$this->data = null;
 				}
 			}
 			else
 			{
 				if (!$this->RequestHandler->isAjax())
 				{
 					$this->Session->setFlash(__('There was an error found', true));
 					$this->data = null;
 				}
 				else
 				{
        			$errorItems = $this->User->invalidFields();;

 					$this->view = 'Json';
        			$this->set('errorItems', $errorItems);
        			$this->set('json', 'errorItems');
         			$this->data = null;
 				}
 			}
 		}
 		else
 		{
  			$this->data = $this->User->find('first', array('conditions' => array('id'=>$userId), 'contains'=> false));
 		}
  	}

   	function admin_delete($userId)
  	{
  		$this->User->delete($userId);
  		if ($this->RequestHandler->isAjax())
  		{
  			echo Router::url(array('controller' => 'users', 'action' => 'loadInformation', 'prefix' => 'admin', 0 => $userId), true);
  			exit;
  		}
  		else
  		{
  			$this->redirect(array('controller' => 'users', 'action' => 'loadInformation', 'prefix' => 'admin', 0 => $userId));
  		}
  	}

  	/*
  	 * User Profile actions
  	 */

 	function index()
	{

	}

	function publicProfile($username = null)
	{
		if ($username == null)
		{
			$username = $this->Auth->user('username');
		}

		$this->set('userInfo', $this->User->find('first', array('conditions' => array('username' => $username))));
	}

	function profileEdit()
	{
		$userId = $this->Auth->user('id');

		if (empty($this->data))
		{
			$this->data = $this->User->find('first', array('conditions'=> array ('User.id' => $userId), 'contain' => false));
		}
		else
		{
			if (isset($this->data['User']['oldpassword']) && $this->data['User']['oldpassword'] != '')
			{
				$password = $this->Auth->password($this->data['User']['oldpassword']);
				if ($this->User->find('count', array('conditions' => array('id' => $userId, 'password' => $password))) > 0)
				{
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['clear_password']);
					$this->data['User']['password_confirmHash'] = $this->Auth->password($this->data['User']['password_confirm']);
				}
				else
				{
					unset($this->data['User']['password_confirm']);
					unset($this->data['User']['clear_password']);
				}
			}
			else
			{
				unset($this->data['User']['password_confirm']);
				unset($this->data['User']['clear_password']);
			}

			$this->User->id = $userId;

			$fileUpload = false;

			if (isset($this->data['User']['avatar']))
			{
				$userAvatar = $this->User->find('first', array('conditions'=> array ('User.id' => $userId), 'fields' => array('avatar'), 'contain' => false));

				$result = $this->Upload->upload($this->data['User']['avatar'], WWW_ROOT . 'avatars', null, array('type' => 'resize', 'size' => 100));
				$fileUpload = true;
				if (!$result){
					@unlink(WWW_ROOT . 'avatars' . DS . $userAvatar['User']['avatar']);
					$this->data['User']['avatar'] = $this->Upload->result;
				} else {
					// display error
					$errors = $this->Upload->errors;

					// piece together errors
					if(is_array($errors)){ $errors = implode("<br />",$errors); }

					//print_r($errors);
					//exit();
				}
			}


			if ($this->User->save($this->data))
			{
				if ($fileUpload)
				{
					$this->view = 'Json';
					if (isset($errors))
					{
						$this->set('userInfo', array('avatar' => $errors));
					}
					else
					{
		        		$this->set('userInfo', array ('allOk' => true));
					}
		        	$this->set('json', 'userInfo');
		        	$this->set('textarea', true);
				}
				elseif ($this->RequestHandler->isAjax() && !$fileUpload)
				{
		        	$this->view = 'Json';
		        	$this->set('userInfo', array ('allOk' => true));
		        	$this->set('json', 'userInfo');
				}
			}
			else
			{
				if ($fileUpload)
				{
					$this->view = 'Json';
					$validation = $this->User->validationErrors;
					if (isset($errors))
					{
						$validation['avatar'] = $errors;
					}
					$this->set('validation', $validation);
		        	$this->set('json', 'validation');
		        	$this->set('textarea', true);
				}
				elseif ($this->RequestHandler->isAjax() && !$fileUpload)
				{
		        	$this->view = 'Json';
		        	$this->set('validation', $this->User->validationErrors);
		        	$this->set('json', 'validation');
				}
			}
		}
	}

	function notifications()
	{
		$userId = $this->Auth->user('id');

		if (isset($this->data))
		{
			foreach ($this->data['NotificationUser'] as $id => $value)
			{
				if ($value == 1)
				{
					$this->User->habtmAdd('Notification', $userId, $id);
				}
				else
				{
					$this->User->habtmDelete('Notification', $userId, $id);
				}
			}
			exit;
		}
		else
		{
 			$allNotifications = $this->User->Notification->find('all', array('contain' => false));

		    $allowedNotifications = array();

		    foreach($allNotifications as $notification)
		    {
		    	if ($this->AclExtend->userPermissions('Notification', $notification['Notification']['id'], 'read'))
		    	{
		    		$allowedNotifications[] = $notification;
		    	}
		    }

		    $this->set('notifications', $allowedNotifications);
			$this->data = $this->User->getNotifications($userId);
		}
	}

	function contribute()
	{
		$this->Contribution->bindModel(
		        array('belongsTo' => array(
		                'Plugin' => array(
		                    'className' => 'Plugin'
		                )
		            )
		        )
		 );

		$this->set('contributions', $this->Contribution->find('all', array('contain' => 'Plugin')));
	}

	function reminder()
	{

	}
}
 ?>