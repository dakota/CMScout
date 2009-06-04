<?php 
	$html->css('ui.theme/ui.tabs', null, array(), false);
	$html->css('ui.theme/ui.accordion', null, array(), false);
?>
<div id="tabs">
	<ul>
		<li><?php echo $html->link('Public profile', "/users/publicProfile");?></li>
		<li><?php echo $html->link('Edit settings', "/users/profileEdit");?></li>
		<li><?php echo $html->link('Contribute something', "/users/contribute");?></li>
		<?php foreach($pluginUCPActions as $label => $link) :?>
			<li><?php echo $html->link($label, $link); ?></li>
		<?php endforeach;?>		
	</ul>
</div>
<script type="text/javascript">
	$("#tabs").tabs({
		selected: 0
	});
</script>