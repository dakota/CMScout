<?php 
	echo $javascript->link('/photos/js/photos_contribute_index');
?>
<?php if ($permissions['create']) echo $html->link("Add album", '/photos/add', array('id' => 'addLink'));?>
<?php if (count($albums) > 0) {?>
<table width="100%">
<tr>
	<th width="25%"><?php __('Title'); ?></th>
	<th><?php __('Tags'); ?></th>
	<th><?php __('Created'); ?></th>
	<th><?php __('Modified'); ?></th>
</tr>
<?php $i = 0;foreach ($albums as $album) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $album['Album']['slug']; ?>">
	<td>
		<?php echo $album['Album']['title']; ?>

		<div class="actions" style="text-align:left;">
			<?php echo $html->link(__('View', true), '/photos/index/' . $album['Album']['slug']); ?>&nbsp;
			<?php if ($permissions['update']) echo $html->link(__('Edit', true), '/photos/edit/' . $album['Album']['slug'], array('class' => 'editLink')); ?>&nbsp; 
			<?php if ($permissions['delete']) echo $html->link(__('Delete', true), '/photos/delete/' . $album['Album']['id'], array('class' => 'deleteLink')); ?>
		</div>
	</td>
	<td><?php echo $album['Album']['tags']; ?></td>
	<td class="timeago"><?php echo $album['Album']['created']; ?></td>
	<td class="timeago"><?php echo $album['Album']['modified']; ?></td>	
</tr>
<?php }?>
</table>
<?php } ?>