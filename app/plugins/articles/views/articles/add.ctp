<?php	
	 echo $form->create('Article');
	 echo $form->input('title');
	 echo $form->input('tags', array('type'=>'text'));
	 echo $form->input('author');
	 echo $form->input('summary', array('type'=>'textarea'));
	 echo $form->input('content', array('type' => 'textarea', 'class'=>'mceEditor tall'));
	 echo $form->end('Add');
	 
	 $javascript->link('tiny_mce/tiny_mce_gzip', false);
 	 $javascript->link('tinyMCE.gz', false);
 	 $javascript->link('tinyMCE.init', false);
?>