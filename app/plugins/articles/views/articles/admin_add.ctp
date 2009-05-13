<?php
	 echo $form->create('Article');
	 echo $form->input('title');
	 echo $form->input('tags', array('type'=>'text'));
	 echo $form->input('content', array('type' => 'textarea'));
	 echo $form->end('Add');
?>
<script type="text/javascript">
	tinyMCE.execCommand("mceAddControl", true, 'ArticleContent');
</script>