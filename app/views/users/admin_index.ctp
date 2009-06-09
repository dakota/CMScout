<?php 
	$css->link('tree_component', null, array(), false);
	$css->link('tree_component_theme', null, array(), false);
	$css->link('ui.theme/ui.tabs', null, array(), false);
	
	$javascript->link('tree_component', false);
	$javascript->link('css', false);
	$javascript->link('jquery.metadata', false);
	$javascript->link('jquery.blockui', false);
	$javascript->link('quicksilver', false);
	$javascript->link('jquery.livesearch', false);
	$javascript->link('users/admin_index', false);
?>
<table style="border:0px;width:100%">
<tr style="vertical-align:top">
<td style="width:25%;text-align:left;">
<button id="deleteButton" style="width:100%" disabled="disabled"><?php __('Delete group'); ?></button><br />
<button id="renameButton" style="width:100%" disabled="disabled"><?php __('Rename group'); ?></button><br />
<button id="newGroupButton" style="width:100%"><?php __('Create group'); ?></button><br />
Filter: <input id="filterInput" value="" type="text" />
<div id="aros">
	<?php echo $threaded->show($AROTree); ?>
</div>

</td>
<td id="middle" style="text-align:left;">
	<div id="tabs">
		<ul>
		<li><a href="#informationTab"><?php __('Information'); ?></a></li>
		<li><a href="#permissionTab"><?php __('Permissions'); ?></a></li>
		</ul>
		<div id="informationTab">No item loaded</div>
		<div id="permissionTab">No item loaded</div>
	</div>
</td>
<td style="width:25%;text-align:left;">

<div id="acos">
<?php echo $threaded->show($ACOTree); ?>
</div>

</td>
</tr>
</table>