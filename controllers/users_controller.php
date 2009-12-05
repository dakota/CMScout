<?php
/**
 * This file is part of CMScout.
 *  
 * CMScout is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *  
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with CMScout.  If not, see <http://www.gnu.org/licenses/>.
 *    
 * @filesource
 * @copyright		Copyright 2009, CMScout.
 * @link			http://www.cmscout.co.za/
 * @package			cmscout3
 * @subpackage		cmscout3.core
 * @since			CMScout3 v 1.0.0
 * @license			GPLv3 
 *  
 */
 class UsersController extends AppController
 {
 	/**
 	 * Name property
 	 * @var unknown_type
 	 */
 	public $name = 'Users';

  	public	$actionMap = array(
  		'admin_loadInformation' => array('UGP Manager', 'read')
 	);
 	
 	public $adminNode = 'Users';  	
 	
 	/**
 	 * Component array
 	 * @var array
 	 */
 	public $components = array('Upload');

	/**
	 * beforeFilter callback
	 * @see app/AppController#beforeFilter()
	 */
 	function beforeFilter()
 	{
 		parent::beforeFilter();

 		$this->Auth->allow('register', 'reset');
 		
 		if(in_array($this->params['action'], array('register', 'reset', 'login')) && $this->_userDetails != null)
 		{
 			$this->redirect('/');
 		}
 	}

 	/*
 	 * Standard actions
 	 */

 	/**
 	 * Logs a user in
 	 * @return void
 	 */
 	public function login()
 	{
	 	//-- code inside this function will execute only when autoRedirect was set to false (i.e. in a beforeFilter).
		if ($this->Auth->user())
		{
			if (!empty($this->data) && $this->data['User']['auto_login'])
			{
				$cookie = array();
				$cookie['username'] = $this->data['User']['username'];
				$cookie['password'] = $this->data['User']['password'];
				$this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
				unset($this->data['User']['auto_login']);
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
					$this->Session->delete('Message.auth');
					$this->redirect($this->Auth->redirect());
				}
				else
				{
					// Delete invalid Cookie
					$this->Cookie->delete('Auth.User');
				}
			}
		}
	}

	/**
	 * 
	 * @return void
	 */
 	public function admin_login()
 	{
 		$this->redirect("/users/login");
 	}

	/**
	 * Logs a user out.
	 * @return void
	 */
 	public function logout()
 	{ 	
 		if(!is_null($this->Cookie->read('Auth.User')))
 		{
 			$this->Cookie->delete('Auth.User');
 		}
 		$this->Auth->logout();
 		$this->redirect('/');
 	}

 	/**
 	 * Registers a new user.
 	 * @return void
 	 */
 	public function register()
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
 					$this->Session->setFlash(__('Thank you for registering', true), null);
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
 					$this->Session->setFlash(__('There was an error found', true), null);
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

 

    public function admin_homepage()
  	{
  	}

  	public function admin_loadInformation($userId = null)
  	{
  		if($userId != 'guest')
  			$this->data = $this->User->find('first', array('conditions' => array('id'=>$userId), 'contains'=> false));
  	}

  	public function admin_toggleStatus($userId)
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

  	public function admin_edit($userId)
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
 					$this->Session->setFlash(__('Saved.', true), null);
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
 					$this->Session->setFlash(__('There was an error found', true), null);
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

   	public function admin_delete($userId)
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
  	
 	public function index()
	{
		$this->set('pluginUCPActions', $this->Event->trigger('getUcpActions'));
	}

	public function publicProfile($username = null)
	{
		if ($username == null)
		{
			$username = $this->Auth->user('username');
		}

		$this->set('profileInfo', $this->User->find('first', array('conditions' => array('username' => $username))));
	}

	public function profileEdit()
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

	public function notifications()
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
		    	if ($this->AclExtend->userPermissions('Notification:'.$notification['Notification']['id'], 'read'))
		    	{
		    		$allowedNotifications[] = $notification;
		    	}
		    }

		    $this->set('notifications', $allowedNotifications);
			$this->data = $this->User->getNotifications($userId);
		}
	}

	public function contribute()
	{
		$this->set('contributions', $this->Event->trigger('getContributionActions'));
	}

	public function reset()
	{
		if(isset($this->data))
		{
			$users = $this->User->find('all', array('conditions' => $this->postConditions($this->data), 'fields' => array('User.id', 'User.username')));
			if(count($users) == 1)
			{
				$this->Session->setFlash('Your password has been reset, and the new one emailed to you.');
				$this->redirect('/');
			}
			elseif(count($users) == 0)
			{
				$this->Session->setFlash('No user associated with that email address was found.');
				$this->redirect(array('action' => 'reset'));
			}
			else
			{
				
			}
		}
	}
}
 ?>