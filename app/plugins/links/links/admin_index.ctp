<?php echo $html->link("Add link", '/admin/links/add');?>
<?php if (count($linkList) > 0) {?>
<table width="100%">
<tr>
	<th><?php __('Title'); ?></th>
	<th><?php __('URL'); ?></th>
	<th><?php __('Tags'); ?></th>
	<th><?php __('Created'); ?></th>
	<th><?php __('Modified'); ?></th>
</tr>
<?php $i = 0;foreach ($linkList as $link) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $link['Link']['name']; ?>">
	<td>
		<?php echo $link['Link']['title']; ?>
		<div class="actions" style="text-align:left;display:none;">
		<?php echo $html->link(__('Edit', true), '/admin/links/edit/' . $link['Link']['name']); ?> | 
		<?php echo $html->link(__('Delete', true), '/admin/links/delete/' . $link['Link']['id'], array('class' => 'ajaxLink')); ?>
		</div>
	</td>
	<td><?php echo $link['Link']['url']; ?></td>
	<td><?php echo $link['Link']['tags']; ?></td>
	<td class="timeago"><?php echo $link['Link']['created']; ?></td>
	<td class="timeago"><?php echo $link['Link']['modified']; ?></td>	
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
	$("#tabContent").load('<?php echo $html->url("/admin/links/index"); ?>');
	return false;
});
</script>
<?php } ?>