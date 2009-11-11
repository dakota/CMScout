<p>Please enter the email address you registered with. If there is more then one user registered with the same address, you'll be asked to enter your username as well.</p>
<?php
	echo $form->create('User', array('action' => 'reset'));
    echo $form->input('email_address');
    echo $form->end('Reset my password');
    echo $html->link('Register', array('controller' => 'users', 'action' => 'register'), array('class' => 'dialogLink', 'title' => 'Register an account'));
    echo '&nbsp;|&nbsp;';
    echo $html->link('Back to Login', array('controller' => 'users', 'action' => 'login'), array('class' => 'dialogLink'));
?>