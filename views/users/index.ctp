<?php 
	$this->Html->css('ui.theme/ui.tabs', null, array('inline' => false));
	$this->Html->css('ui.theme/ui.accordion', null, array('inline' => false));
	$this->Html->script('users/index.js', false);
	echo $this->Html->script('tiny_mce/tiny_mce_gzip');
	echo $this->Html->script('tinyMCE.gz.bbcode');
	echo $this->Html->script('tinyMCE.init.bbcode');	
?>
<div id="tabs">
	<ul>
		<li><?php echo $this->Html->link('Public profile', "/users/publicProfile");?></li>
		<li><?php echo $this->Html->link('Edit settings', "/users/profileEdit");?></li>
		<li><?php echo $this->Html->link('Contribute something', "/users/contribute");?></li>
		<?php /*foreach($pluginUCPActions as $label => $link) :?>
			<li><?php echo $this->Html->link($label, $link); ?></li>
		<?php endforeach;*/?>		
	</ul>
</div>