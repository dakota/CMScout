<?php
class User extends AppModel 
{
 var $name = 'User';
 var $actsAs = array('Acl'=>'requester', 'ExtendAssociations', 'SoftDeletable'); 
 var $hasAndBelongsToMany = array("Group", 'Notification');
 var $displayField = 'username';
 var $validate = array(
 	'username' => array(
 		'minLength' => array(
 			'rule' => array('minLength', '1'),
 			'message' => 'You must enter a username'
 		),
 		'uniqueUsername' => array (
 			'rule' => 'isUnique',
 			'message' => 'That username has already been used.'
 		)
 	),
 	'clear_password' => array(
 		'minlength' => array(
 			'rule' => array('minLength', '6'),
 			'message' => 'Your password must be at least 6 characters long'
 			)
 	),
 	'password_confirm' => array(
 		'rule' => 'checkPasswords',
 		'message' => 'Your passwords do not match'
 	),
 	'email_address' => array(
 		'rule' => 'email',
 		'message' => 'Enter a valid email address'
 	)
 );
	
	function checkPasswords($data) 
	{	
		if($this->data['User']['password'] == $this->data['User']['password_confirmHash'])
		{	
			return true;
		}
		
		return false;
	}

  
	function parentNode()
	{
	    return "Users";
	}
 
	
 	function isAuthorized($user, $controller, $action)
 	{
 		return true;
 	}
 	
 	function getNotifications($userId)
 	{	    
	    $userNotifications = $this->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('id'), 'contain' => array('Notification' => array('fields' => array('Notification.id')))));
	    
	    $data = array();
	    foreach ($userNotifications['Notification'] as $notification)
	    {
	    	$data['NotificationUser'][$notification['id']] = 1;
	    }
	    
	    return $data;
 	}
}
?>