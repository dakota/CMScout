<?php
	 echo $form->create('Album', array('url' => '/photos/add'));
	 echo $form->input('title');
	 echo $form->input('tags', array('type'=>'text'));
	 echo $form->end('Add');
?>