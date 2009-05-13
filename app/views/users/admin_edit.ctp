<?php 
	echo $form->create('User'); 
	echo $form->input('id');
	echo $form->input('username', array('id' => 'username'));
	echo $form->input('clear_password', array('label' => 'Password (Leave blank if you do not wish to change it)', 'value' => '', 'id' => 'clear_password'));
	echo $form->input('first_name', array('id' => 'first_name'));
	echo $form->input('last_name', array('id' => 'last_name'));
	echo $form->input('email_address', array('id' => 'email_address'));
	echo $form->end('Update user');
?>

