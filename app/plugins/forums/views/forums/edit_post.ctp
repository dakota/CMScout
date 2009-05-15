<?php if (isset($ajaxLoad)):?>
<?php
	 echo $form->create('ForumPost', array('url' => array('controller' => 'forums', 'action' => 'editPost', $this->data['ForumPost']['id'])));
	 echo $form->input('id', array('type' => 'hidden'));
	 echo $form->input('text', array('label' => 'Message', 'type' => 'textbox', 'rows' => 15, 'style' => 'width: 100%','class' => 'mceEditor', 'id' => 'postText'. $this->data['ForumPost']['id']));
?>
	<div class="submit">
		<input type="submit" name="save" value="Save edit">&nbsp;
		<input type="submit" name="advanced" value="Go Advanced">&nbsp;
		<input type="button" class="delete" name="delete" value="Delete">&nbsp;
		<input type="button" class="cancel" name="cancel" value="Cancel">
	</div>
<?php 
	echo $javascript->codeBlock("tinyMCE.execCommand('mceAddControl', true, 'postText{$this->data['ForumPost']['id']}');");
?>
<?php else :?>
<?php
	$html->css('/forums/css/forums', null, array(), false);

	 $javascript->link('tiny_mce/tiny_mce_gzip', false);
	 if (Configure::read('CMScout.CMScout Forums.editorType') == 0)
	 {
	 	$javascript->link('tinyMCE.gz.bbcode', false);
	 	$javascript->link('tinyMCE.init.bbcode', false);
	 }
	 elseif (Configure::read('CMScout.CMScout Forums.editorType') == 1)
	 {
	 	$javascript->link('tinyMCE.gz.simple', false);
	 	$javascript->link('tinyMCE.init.simple', false);
	 }
	 elseif (Configure::read('CMScout.CMScout Forums.editorType') == 2)
	 {
	 	$javascript->link('tinyMCE.gz', false);
	 	$javascript->link('tinyMCE.init', false);
	 }

	$html->addCrumb('Forums', array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index'));
	foreach ($breadcrumbs as $key => $crumb)
	{
		if ($key == 0)
			$html->addCrumb($crumb['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index', $crumb['slug']));
		else
			$html->addCrumb($crumb['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $crumb['slug']));
	}
	$html->addCrumb($thread['ForumThread']['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'thread', $thread['ForumThread']['slug']));
	
	echo $html->getCrumbs(' > ');
?>

<div>
<h2>Edit post</h2>
<?php
	 echo $form->create('ForumPost', array('url' => array('controller' => 'forums', 'action' => 'editPost', $this->data['ForumPost']['id'])));
	 echo $form->input('id', array('type' => 'hidden'));
	 echo $form->input('title');
	 echo $form->input('tags', array('after' => '<a href="#" id="autoFill">Auto tag</a>', 'id' => 'postTags'));
?>
	<table width="100%">
		<tr>
			<td width="70%"><?php echo $form->input('text', array('label' => 'Message', 'type' => 'textbox', 'rows' => 15, 'style' => 'width: 100%','class' => 'mceEditor', 'id' => 'postText'));?></td>
			<td>
				<fieldset style="height: 100%">
					<legend>Smilies</legend>
					<?php echo $this->element('smilies');?>
				</fieldset>
			</td>
		</tr>
	</table>

	<div class="submit">
		<input type="submit" name="save" value="Save edit">&nbsp;
		<input type="submit" name="cancel" value="Cancel">
	</div>
</div>

<script type="text/javascript">
	$("#autoFill").click(function() {
		tinyMCE.triggerSave();

		var value = 'text=' + $("#postText").val().replace(/<[^>]*>/g, "");

		$.post('<?php echo $html->url(array('plugin' => 'forums', 'controller' => 'forums', 'action' => 'autoTag', 'admin' => false)); ?>', value, function(response) {
			$("#postTags").val(response);
		});

		return false;
	});

	$(".smilies a").click(function() {
		tinyMCE.execInstanceCommand('postText', 'mceInsertContent', false, $(this).attr('id'), false);
		return false
	});
</script>
<?php endif;?>