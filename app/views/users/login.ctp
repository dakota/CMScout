<?php
	echo $form->create('User', array('action' => 'login'));
    echo $form->input('username');
    echo $form->input('password');
    echo $form->input('remember_me', array('type' => 'checkbox'));
    echo $form->end('Login');
?>