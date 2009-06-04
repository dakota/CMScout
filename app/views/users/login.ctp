<?php
	echo $form->create('User', array('action' => 'login'));
    echo $form->input('username');
    echo $form->input('password');
	echo $form->input('auto_login', array('type' => 'checkbox', 'label' => 'Remember me'));
    echo $form->end('Login');
?>