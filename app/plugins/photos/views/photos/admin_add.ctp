<?php
	 echo $form->create('Album');
	 echo $form->input('title');
	 echo $form->input('tags', array('type'=>'text'));
	 echo $form->end('Add');
?>