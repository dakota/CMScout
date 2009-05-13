<?php
 $javascript->link('tiny_mce/tiny_mce_gzip', false);
 if (Configure::read('CMScout.CMScout Forums.editorType') == 0)
 {
 	$javascript->link('tinyMCE.gz.simple', false);
 	$javascript->link('tinyMCE.init.simple', false);
 }
 elseif (Configure::read('CMScout.CMScout Forums.editorType') == 1)
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
	$html->addCrumb($forum['ForumForum']['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $forum['ForumForum']['slug']));


	echo '<div class="breadcumbs">' . $html->getCrumbs(' > ') . '</div>';
	echo '<div class="finalBreadcrumb">New topic</div>';

 echo $form->create('ForumThread', array('url' => array('controller' => 'forums', 'action' => 'newtopic', $forumSlug)));
 echo $form->input('title');
 echo $form->input('description');
 echo $form->input('tags', array('after' => '<a href="#" id="autoFill">Auto tag</a>', 'id' => 'postTags'));
 echo $form->input('post', array('type' => 'textbox', 'rows' => 15,'class' => 'mceEditor', 'id' => 'postText'));
 echo $form->end('Post topic');
?>
 <script type="text/javascript">
	$("#autoFill").click(function() {
		tinyMCE.triggerSave();

		var value = 'text=' + $("#postText").val().replace(/<[^>]*>/g, "");

		$.post('<?php echo $html->url(array('plugin' => 'forums', 'controller' => 'forums', 'action' => 'autoTag', 'admin' => false)); ?>', value, function(response) {
			$("#postTags").val(response);
		});

		return false;
	});
</script>