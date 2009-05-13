<?php
 class NotificationComponent extends Object
 {
 	var $controller;
 	var $components = array('Email');

 	/**
 	 *
 	 * @var EmailComponent
 	 */
 	var $Email;

	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array())
	{
		// saving the controller reference for later use
		$this->controller =& $controller;
	}

	//called after Controller::beforeFilter()
	function startup(&$controller)
	{
	}

	//called after Controller::beforeRender()
	function beforeRender(&$controller)
	{
	}

	//called after Controller::render()
	function shutdown(&$controller)
	{
	}

	//called before Controller::redirect()
	function beforeRedirect(&$controller, $url, $status=null, $exit=true)
	{
	}

	function _sendEmail($toAddress, $subject, $template, $receipientData = null, $receipientInfo = null, $plugin = null)
	{
		$this->Email->reset();
 		$this->Email->to = $toAddress;
	    $this->Email->subject = Configure::read('CMScout.Email.EmailPrefix') . ' ' . $subject;
	    $this->Email->replyTo = Configure::read('CMScout.Core.SiteName') . ' <' . Configure::read('CMScout.Email.SiteEmail') . '>';
	    $this->Email->from = Configure::read('CMScout.Core.SiteName') . ' <' . Configure::read('CMScout.Email.SiteEmail') . '>';
	    $this->Email->template = $template;

	    $this->controller->set('receipientData', $receipientData);
	    $this->controller->set('receipientInfo', $receipientInfo);
		$this->controller->set('plugin', $plugin);

	    if (Configure::read('CMScout.Email.SMTP') == 1)
	    {
	        $this->Email->smtpOptions = array(
		        'port'=>Configure::read('CMScout.Email.SMTPPort'),
		        'timeout'=>'30',
		        'host' => Configure::read('CMScout.Email.SMTPHost'),
		        'username'=>Configure::read('CMScout.Email.SMTPUsername'),
		        'password'=>Configure::read('CMScout.Email.SMTPPassword'));

		    /* Set delivery method */
		    $this->Email->delivery = 'smtp';
	    }

	    $this->Email->send();
	}

 	function sendNotification ($notificationName, $data = null, $skipPermissionCheck = false, $allowedUsers = null)
 	{
	 	$notificationModel = ClassRegistry::init('Notification');

	 	$notification = $notificationModel->find('first', array('conditions' => array('Notification.name' => $notificationName), 'contain' => array('User' => array('conditions' => array('User.active' => '1'), 'fields' => array('User.id', 'User.username', 'User.email_address', 'User.active')))));

	 	if ($notification['Notification']['plugin_id'] != 0)
	 	{
	 		$plugin = $notificationModel->Plugin->findById($notification['Notification']['plugin_id']);
	 	}
	 	else
	 	{
	 		$plugin = null;
	 	}

	 	if ($notification['Notification']['type'] == 'email')
	 	{
 			if ($skipPermissionCheck == false)
 			{
	 			foreach ($notification['User'] as $user)
	 			{
	 				if ($this->controller->AclExtend->userPermissions('Notification', $notification['Notification']['id'], 'read', $user['id']))
	 				{
						$this->_sendEmail($user['email_address'], $notification['Notification']['subject'], $notification['Notification']['name'], $data, $user, $plugin);
	 				}
	 			}
	 		}
	 		else
	 		{
				$userModel = ClassRegistry::init('User');

				$conditions = array();

				if (is_array($allowedUsers))
				{
					$conditions['User.id'] = $allowedUsers;
				}

				$users = $userModel->find('all', array('conditions' => $conditions, 'contain' => false, 'fields' => array('User.id', 'User.username', 'User.email_address', 'User.active')));

				foreach($users as $user)
				{
					$this->_sendEmail($user['User']['email_address'], $notification['Notification']['subject'], $notification['Notification']['name'], $data, $user['User'], $plugin);
				}
	 		}
	 	}
 	}

 	function sendIndividualNotification($notificationName, $userId, $data = null)
 	{
 	 	$notificationModel = ClassRegistry::init('Notification');
 	 	$userModel = ClassRegistry::init('User');

 		$notification = $notificationModel->find('first', array('conditions' => array('Notification.name' => $notificationName), 'contain' => false));

		$user = $userModel->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('id', 'username', 'email_address', 'active'), 'contain' => false));

 		if ($notification['Notification']['type'] == 'email')
 		{
			$this->_sendEmail($user['User']['email_address'], $notification['Notification']['subject'], $notification['Notification']['name'], $data, $user['User']);
 		}
 	}
 }
?>