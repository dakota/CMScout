<?php
	$this->Html->script('jquery.blockui', false);
	$this->Html->script('jquery.metadata', false);
	$this->Html->script('jquery.livextra', false);
	$this->Html->script('menus/admin_index', false);
	$this->Html->script('jquery.queue', false);
	$this->Html->script('json2', false);
?>
<div id="actions" style="display: none;">
	<div class="input text">
		<label for="title"><?php __('Title'); ?></label>
		<input name="title" type="text" maxlength="255" value="" id="title" style="width: 80%;" />
	</div>
	<div id="options">

	</div>
</div>
<div style="float:left;margin-right:20px;">
<h2>Menu links</h2>
<?php foreach($availableMenus['MenuLinks'] as $category => $categoryLinks) : ?>
	<h3><?php echo $category; ?></h3>
	<ul id="core-available-links" class="menuList">
		<?php 
			foreach($categoryLinks as $link)
			{
				$randomId = rand(0, time());
				echo '<li class="draggable link" id="'.$randomId.'" metadata="'.$this->Menu->linkMetadata($link).'">';
				echo $link['title'];
				echo '</li>';
			}
		?>
	</ul>
<?php endforeach; ?>
</div>

<div style="float:left;margin-right:10px;">
<h2>Side boxes</h2>
<?php foreach ($availableMenus['Sideboxes'] as $category => $categorySideboxes) :?>
	<h3><?php echo $category; ?></h3>
	<ul id="core-available-sideboxes" class="menuList">
		<?php foreach($categorySideboxes as $sidebox):?>
		<li class="sidedraggable box" id="<?php echo rand(0, time()); ?>" metadata="<?php echo $this->Menu->boxMetadata($sidebox); ?>"><?php echo $sidebox['title']; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endforeach; ?>
</div>

<div style="float:left;">
	<span id="core-menu-trash">TRASH</span>
</div>