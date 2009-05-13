<?php 
	$javascript->link('plugins/admin_index', false);
?>
<?php echo $html->link("Install plugin", '/admin/plugins/install');?>
<?php if (count($plugins) > 0) {?>
<table width="100%">
<tr>
	<th width="70%"><?php __('Name'); ?></th>
	<th><?php __('Version'); ?></th>
</tr>
<?php $i = 0;foreach ($plugins as $plugin) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $plugin['Plugin']['id']; ?>">
	<td>
		<?php echo $plugin['Plugin']['title'];?>
		<div class="actions" style="text-align:left;display:none;">
		<?php echo $html->link(__('Config', true), '/admin/' . $plugin['Plugin']['directory']); ?> | 
		<?php echo $html->link(__('Uninstall', true), '/admin/plugins/uninstall/' . $plugin['Plugin']['id'], array('class' => 'deleteLink')); ?>
		</div>
	</td>
	<td><?php echo $plugin['Plugin']['version']; ?></td>
</tr>
<?php }?>
</table>
<?php } ?>