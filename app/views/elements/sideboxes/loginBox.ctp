<?php
   if (!isset($userInfo))
   {
		echo $form->create('User', array('url' => '/users/login'));
	    echo $form->input('username');
	    echo $form->input('password');
	    echo $form->input('auto_login', array('type' => 'checkbox', 'label' => 'Remember me'));
	    echo $form->end('Login');
	    echo $html->link('Register', '/users/register', array('class' => 'dialogLink', 'title' => 'Register an account'));
	    echo $html->link('Password reminder', '/users/reminder', array('class' => 'dialogLink'));
   }
   else
   {
   		echo "Welcome back, " . $userInfo['User']['username'] . "<br />";
   		echo $html->link('Logout', '/users/logout');
   }
?>