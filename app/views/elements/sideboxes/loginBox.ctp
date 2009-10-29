<?php
   if (!isset($userInfo))
   {
		echo $form->create('User', array('action' => 'login'));
	    echo $form->input('username');
	    echo $form->input('password');
	    echo $form->input('auto_login', array('type' => 'checkbox', 'label' => 'Remember me'));
	    echo $form->end('Login');
	    echo $html->link('Register', array('controller' => 'users', 'action' => 'register'), array('class' => 'dialogLink', 'title' => 'Register an account'));
	    echo $html->link('Password reset', array('controller' => 'users', 'action' => 'reset'), array('class' => 'dialogLink'));
   }
   else
   {
   		echo "Welcome back, " . $userInfo['User']['username'] . "<br />";
   		echo $html->link('Logout', '/users/logout');
   }
?>