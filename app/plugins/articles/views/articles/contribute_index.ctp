<?php 
	echo $javascript->link('/articles/js/articles_contribute_index');
?>
<?php if ($permissions['create']) echo $html->link("Add article", '/articles/add', array('id' => 'addLink'));?>
<?php if (count($articles) > 0) {?>
<table width="100%">
<tr>
	<th width="25%"><?php __('Title'); ?></th>
	<th><?php __('Tags'); ?></th>
	<th><?php __('Created'); ?></th>
	<th><?php __('Modified'); ?></th>
</tr>
<?php $i = 0;foreach ($articles as $article) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $article['Article']['slug']; ?>">
	<td>
		<?php echo $article['Article']['title']; ?>
		<div class="actions" style="text-align:left;">
			<?php echo $html->link(__('View', true), '/articles/index/' . $article['Article']['slug']); ?>&nbsp;
			<?php if ($permissions['update']) echo $html->link(__('Edit', true), '/articles/edit/' . $article['Article']['slug'], array('class' => 'editLink')); ?>&nbsp;
			<?php if ($permissions['delete']) echo $html->link(__('Delete', true), '/articles/delete/' . $article['Article']['id'], array('class' => 'deleteLink')); ?>
		</div>
	</td>
	<td><?php echo $article['Article']['tags']; ?></td>
	<td class="timeago"><?php echo $article['Article']['created']; ?></td>
	<td class="timeago"><?php echo $article['Article']['modified']; ?></td>	
</tr>
<?php }?>
</table>
<?php } ?>