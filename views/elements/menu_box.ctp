<?php 
if(!$adminMode)
{
	if ($menuItem['plugin'] == '')
	{
		$sidebox = $this->element('sideboxes' . DS  . $menuItem['action'], array('item' => $menuItem));
	}
	else
	{
		$sidebox = $this->element('sideboxes' . DS . $menuItem['action'], array('item' => $menuItem, 'plugin' => $menuItem['plugin']));
	}
}
?>
 <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" rel="">
	<div class="portlet-header ui-widget-header ui-corner-all" rel="">
		<span class="portlet-name core-menu-title"><?php echo $menuItem['title']; ?></span>
		<?php 
			if($adminMode)
			{
				echo $this->element('menu_admin_links');
			}
		?>
	</div>
	<?php if(!$adminMode) :?>
	 	<div class="portlet-content">
	 		<?php echo $sidebox; ?>
	 	</div>
 	<?php endif; ?>
</div>