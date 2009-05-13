<?php
 echo $form->create('Page', array('action' => 'admin_add'));
 echo $form->input('title');
 echo $form->input('tags', array('type'=>'text', 'after' => '<a href="#" id="autoFill">Auto tag</a>'));
 echo $form->input('text', array('class' => 'mceEditor tall'));
 echo $form->end('Save Page');

 $javascript->link('tiny_mce/tiny_mce_gzip', false);
 $javascript->link('tinyMCE.gz', false);
 $javascript->link('tinyMCE.init', false);
?>
<script type="text/javascript">
	$("#autoFill").click(function() {
		tinyMCE.triggerSave();

		var value = 'text=' + $("#PageText").val().replace(/<[^>]*>/g, "");

		$.post('<?php echo $html->url(array('controller' => 'pages', 'action' => 'autoTag', 'admin' => false)); ?>', value, function(response) {
			$("#PageTags").val(response);
		});

		return false;
	});
</script>