<?php echo $html->link("Add album", '/admin/albums/add');?>
<?php if (count($albums) > 0) {?>
<table width="100%">
<tr>
	<th><?php __('Title'); ?></th>
	<th><?php __('Tags'); ?></th>
	<th><?php __('Created'); ?></th>
	<th><?php __('Modified'); ?></th>
</tr>
<?php $i = 0;foreach ($albums as $album) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $album['Album']['name']; ?>">
	<td>
		<?php echo $album['Album']['title']; ?>
		<div class="actions" style="text-align:left;display:none;">
		<?php echo $html->link(__('Edit', true), '/admin/albums/edit/' . $article['Album']['name']); ?> | 
		<?php echo $html->link(__('Delete', true), '/admin/albums/delete/' . $album['Album']['id'], array('class' => 'ajaxLink')); ?>
		</div>
	</td>
	<td><?php echo $album['Album']['tags']; ?></td>
	<td class="timeago"><?php echo $album['Album']['created']; ?></td>
	<td class="timeago"><?php echo $album['Album']['modified']; ?></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">
$("tr").bind('mouseenter', function() {
	$(this).find('.actions').fadeIn('fast');
});
$("tr").bind('mouseleave', function() {
	$(this).find('.actions').fadeOut('fast');
});

$(".ajaxLink").click(function() {
	$.get($(this).attr('href'));
	$("#tabContent").load('<?php echo $html->url("/admin/albums/index"); ?>');
	return false;
});
</script>
<?php } ?>