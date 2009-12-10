<?php 
	$html->css('jquery.tree', null, array('inline' => false));
	$html->css('ui.theme/ui.accordion', null, array('inline' => false));
	
	$javascript->link('jquery.metadata', false);
	$javascript->link('jquery.tree', false);
	$javascript->link('jquery.tree.metadata', false);
	$javascript->link('css', false);
	$javascript->link('jquery.blockui', false);
	$javascript->link('quicksilver', false);
	$javascript->link('jquery.livesearch', false);
	$javascript->link('ugp/admin_index', false);
?>
<table style="border:0px;width:100%">
<tr style="vertical-align:top">
<td style="width:25%;text-align:left;">
Filter: <input id="filterInput" value="" type="text" />
<div id="core_aros">
	<?php echo $threaded->show($AROTree, true); ?>
</div>

</td>
<td id="middle" style="text-align:left;">
	<div id="core_accordion">
		<h3><a href="#core_informationTab"><?php __('Information'); ?></a></h3>
		<div id="core_informationTab">No information loaded. Please select a group or user in the list on the left.</div>

		<h3><a href="#core_viewPermissionTab"><?php __('View Permissions'); ?></a></h3>
		<div id="core_viewPermissionTab" style="padding-bottom: 25px;">
		</div>

		<h3><a href="#core_setPermissionTab"><?php __('Edit Permissions'); ?></a></h3>
		<div id="core_setPermissionTab" style="padding-bottom: 25px;">
			<div id="core_acos" style="margin-bottom: 10px;">
				<?php echo $threaded->show($ACOTree); ?>
			</div>
			<br />
			<div id="core_ugp_save" style="display:none; margin-top: 10px;">
				<a href="#" id="core_save">Save</a>&nbsp;<a href="#" id="core_cancel">Cancel</a>
			</div>
		</div>
	</div>
</td>
</tr>
</table>