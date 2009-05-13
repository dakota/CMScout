<?php echo $html->link("Add article", '/admin/articles/add');?>
<?php if (count($articles) > 0) {?>
<table width="100%">
<tr>
	<th><?php __('Title'); ?></th>
	<th><?php __('Tags'); ?></th>
	<th><?php __('Created'); ?></th>
	<th><?php __('Modified'); ?></th>
</tr>
<?php $i = 0;foreach ($articles as $article) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $article['Article']['name']; ?>">
	<td>
		<?php echo $article['Article']['title']; ?>
		<div class="actions" style="text-align:left;display:none;">
		<?php echo $html->link(__('Edit', true), '/admin/articles/edit/' . $article['Article']['name']); ?> | 
		<?php echo $html->link(__('Delete', true), '/admin/articles/delete/' . $article['Article']['id'], array('class' => 'ajaxLink')); ?>
		</div>
	</td>
	<td><?php echo $article['Article']['tags']; ?></td>
	<td class="timeago"><?php echo $article['Article']['created']; ?></td>
	<td class="timeago"><?php echo $article['Article']['modified']; ?></td>	
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
	$("#tabContent").load('<?php echo $html->url(array('controller' => 'articles', 'action' => 'index', 'prefix' => 'admin')); ?>');
	return false;
});
</script>
<?php } ?>