<?php 
	$html->css('jquery.tree', null, array('inline' => false));
	$html->css('ui.theme/ui.tabs', null, array('inline' => false));
	
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
<div id="aros">
	<?php echo $threaded->show($AROTree, true); ?>
</div>

</td>
<td id="middle" style="text-align:left;">
	<div id="tabs">
		<ul>
			<li><a href="#informationTab"><?php __('Information'); ?></a></li>
			<li><a href="#permissionTab"><?php __('Permissions'); ?></a></li>
		</ul>
		<div id="informationTab">No information loaded. Please select a group or user in the list on the left.</div>
		<div id="permissionTab">
			<div id="acos">
				<?php echo $threaded->show($ACOTree); ?>
			</div>			
		</div>
	</div>
</td>
</tr>
</table>