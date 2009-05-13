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

	echo $html->getCrumbs(' > ');

	$paginator->options(array('url'=>$this->passedArgs));
?>
<table class="forumTable">
	<tr>
		<th colspan="2"><?php echo $thread['ForumThread']['title'];?></th>
	</tr>
<?php foreach($posts as $post) :?>
	<tr id="<?php echo $post['ForumPost']['id']; ?>">
		<td>
			<div class="username"><?php echo $post['User']['username'];?></div>

			<?php if($post['User']['avatar'] != ''):?>
				<div class="avatar">
					<?php echo $html->image('/avatars/' . $post['User']['avatar']); ?>
				</div>
			<?php endif;?>
		</td>
		<td width="80%">
			<a name="<?php echo $post['ForumPost']['id']; ?>"></a>

			<?php if ($post['ForumPost']['title'] != '') :?>
				<div class="subject">
					<?php echo $post['ForumPost']['title'];?>
				</div>
			<?php endif; ?>

			<div class="created">
				<?php echo $time->niceShort($post['ForumPost']['created']); ?>
			</div>

			<div class="post" rel="<?php echo $post['User']['username'];?>"><?php echo $post['ForumPost']['text'];?></div>

			<?php if($post['User']['signature'] != ''):?>
				<div class="signature">
					<?php echo $post['User']['signature']; ?>
				</div>
			<?php endif;?>

			<div class="actions">
				<a href="#" class="addQuote">Quote</a>
			</div>
		</td>
	</tr>
<?php endforeach;?>
</table>
<div class="paginate">
	<ul>
		<?php
			echo '<li class="count">'.$paginator->counter('Page %page% of %pages%').'</li> ';
			echo $paginator->first('<< First',array('separator' => null, 'tag' => 'li'));
			echo $paginator->hasPrev() ? '<li>' . $paginator->prev('<', array('tag' => 'li')) . '</li>' : '';
			echo $paginator->numbers(array('separator' => null, 'tag' => 'li'));
			echo $paginator->hasNext() ? '<li>' . $paginator->next('>', array('tag' => 'li')) . '</li>' : '';
			echo $paginator->last('Last >>',array('separator' => null, 'tag' => 'li'));
		?>
	</ul>
</div>

<div id="quickReply">
<?php
 echo $form->create('ForumPost', array('url' => array('controller' => 'forums', 'action' => 'reply', $thread['ForumThread']['slug'])));
 echo "<fieldset>";
 echo "<legend>Quick Reply</legend>";
 echo $form->input('title', array('value' => 'Re: ' . $thread['ForumThread']['title']));
 echo $form->input('tags', array('after' => '<a href="#" id="autoFill">Auto tag</a>', 'id' => 'postTags'));
 echo $form->input('text', array('type' => 'textbox', 'rows' => 15,'class' => 'mceEditor', 'id' => 'postText'));
 echo $form->input('subscribe', array('label' => 'Notify me if anybody replies to this thread.', 'type' => 'checkbox', 'checked' => 1));
 echo $form->end('Post reply');
 echo "</fieldset>";
?>
</div>

<script type="text/javascript">
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

	$(".addQuote").live('click', function() {
		console.log($(this).parent('div').siblings('.post').html());
		console.log($(this).parent('div').siblings('.post').html().trim());

		var quote = '[quote=' + $(this).parent('div').siblings('.post').attr('rel') + ']' +
					$(this).parent('div').siblings('.post').html().trim() + '[/quote]';
		tinyMCE.execInstanceCommand('postText', 'mceInsertContent', false, quote, false);

		return false;
	});

	$("#autoFill").click(function() {
		tinyMCE.triggerSave();

		var value = 'text=' + $("#postText").val().replace(/<[^>]*>/g, "");

		$.post('<?php echo $html->url(array('plugin' => 'forums', 'controller' => 'forums', 'action' => 'autoTag', 'admin' => false)); ?>', value, function(response) {
			$("#postTags").val(response);
		});

		return false;
	});
</script>