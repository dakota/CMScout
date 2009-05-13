<ul class="comments">
<?php
	foreach ($comments as $comment) :
?>
	<li>
		<div class="user"><?php echo $comment['User']['username']; ?></div>
		<div class="dateInfo"><?php echo $comment['Comment']['created']; ?></div>
		<div class="comment"><?php echo $comment['Comment']['text']; ?></div>
	</li>
<?php endforeach; ?>
	<li>
	<?php 
		echo $form->create('Comment', array('url' => '/comments/post'));
		echo $form->input('text', array('label' => 'Comment', 'type' => 'textarea'));
		echo $form->input('model', array('type' => 'hidden', 'value' => $model));
		echo $form->input('foreign_id', array('type' => 'hidden', 'value' => $itemId));
		echo $form->input('currentPage', array('type' => 'hidden', 'value' => Router::url("", true)));
		echo $form->end('Post comment'); 
	?>
	</li>
</ul>