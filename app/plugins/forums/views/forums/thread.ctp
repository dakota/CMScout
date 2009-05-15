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
	<tr class="postRow">
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

			<div class="post" rel="<?php echo $post['User']['username'];?>" id="<?php echo $post['ForumPost']['id']; ?>">
				<?php echo $bbcode->parse($post['ForumPost']['text'], $html->url(array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'thread', $thread['ForumThread']['slug'])));?>
			</div>
			<div class="editor" style="display:none;">
			</div>

			<div class="actions">
				<?php echo $html->link('Edit', array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'editPost', $post['ForumPost']['id']), array('class' => 'edit'))?>&nbsp;
				<a href="#quickReply" class="quickReply">Quick reply to this message</a>
			</div>
			<?php if($post['User']['signature'] != ''):?>
				<div class="signature">
					<?php echo $post['User']['signature']; ?>
				</div>
			<?php endif;?>

		</td>
	</tr>
<?php endforeach;?>
</table>
<div class="paginate">
	<ul>
		<?php
			echo '<li class="count">'.$paginator->counter('Page %page% of %pages%').'</li> ';
			echo $paginator->hasPrev() ? $paginator->first('<< First',array('separator' => null, 'tag' => 'li')) : '';
			echo $paginator->hasPrev() ? '<li>' . $paginator->prev('<', array('tag' => 'li')) . '</li>' : '';
			echo $paginator->numbers(array('separator' => null, 'tag' => 'li'));
			echo $paginator->hasNext() ? '<li>' . $paginator->next('>', array('tag' => 'li')) . '</li>' : '';
			echo $paginator->hasNext() ? $paginator->last('Last >>',array('separator' => null, 'tag' => 'li')) : '';
		?>
	</ul>
</div>

<div id="quickReply">
<h2>Quick Reply</h2><a name="quickReply"></a>
<?php
	 echo $form->create('ForumPost', array('url' => array('controller' => 'forums', 'action' => 'reply', $thread['ForumThread']['slug'])));
	 echo $form->input('text', array('label' => 'Message', 'type' => 'textbox', 'rows' => 15, 'style' => 'width: 100%','class' => 'mceEditor', 'id' => 'postText'));
	 echo $form->input('subscribe', array('label' => 'Notify me if anybody replies to this thread.', 'type' => 'checkbox', 'checked' => 1));
?>
	<div class="submit">
		<input type="submit" name="reply" value="Post reply">&nbsp;
		<input type="submit" name="advanced" value="Go Advanced">
	</div>
</div>

<script type="text/javascript">
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

	$(".edit").click(function() {
		var post = $(this).parent('div').siblings('.post');
		var editor = $(this).parent('div').siblings('.editor');

		if (editor.css('display') == 'none')
		{
			editor.show();
			post.hide();
			editor.html('Loading');
			editor.load($(this).attr('href'), function() {
				editor.find('.cancel').click(function() {
					var textBox = editor.find('textarea');
					tinyMCE.execCommand('mceRemoveControl', null, textBox.attr('id'));
					editor.hide().html('');
					post.show();
				});
			});
			return false;
		}
	});

	$(".quickReply").click(function() {
		var post = $(this).parent('div').siblings('.post')

		var quote = '[quote=' + post.attr('rel') + ';' + post.attr('id') + ']' +
							post.html().trim() + '[/quote]';
		tinyMCE.execInstanceCommand('postText', 'mceInsertContent', false, quote, false);
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