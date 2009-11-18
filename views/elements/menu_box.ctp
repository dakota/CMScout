<?php 
if ($menuItem['plugin'] == '')
{
	$View =& ClassRegistry::getObject('view');
	$sidebox = $View->element('sideboxes' . DS  . $menuItem['action'], array('item' => $menuItem));
}
else
{
	$View =& ClassRegistry::getObject('view');
	$sidebox = $View->element('sideboxes' . DS . $menuItem['action'], array('item' => $menuItem, 'plugin' => $menuItem['plugin']));
}
?>
 <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" rel="">
	<div class="portlet-header ui-widget-header ui-corner-all" rel="">
		<span class="portlet-name"><?php echo $menuItem['title']; ?></span>
	</div>
 	<div class="portlet-content">
 		<?php echo $sidebox; ?>
 	</div>
</div>