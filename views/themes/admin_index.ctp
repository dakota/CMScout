<?php echo $html->link("Install theme", '/admin/themes/install');?>
<?php if (count($themes) > 0) {?>
<table width="100%">
<tr>
	<th><?php __('Theme name'); ?></th>
	<th><?php __('Site theme'); ?></th>
</tr>
<?php $i = 0;foreach ($themes as $theme) { 
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}?>
<tr<?php echo $class; ?>">
	<td>
		<?php echo $theme['Theme']['title']; ?>
	</td>
	<td><?php echo $html->link($theme['Theme']['site_theme'] == "1" ? "Yes" : "No", "/admin/themes/siteTheme/" . $theme['Theme']['id']); ?></td>	
</tr>
<?php }?>
</table>
<?php } ?>