<?php
	$this->Html->script('jquery.blockui', false);
	$this->Html->script('jquery.metadata', false);
	$this->Html->script('jquery.livextra', false);
	$this->Html->script('menus/admin_index', false);
	$this->Html->script('jquery.qq', false);
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
	<ul class="menuList">
		<?php 
			foreach($categoryLinks as $link)
			{
				if(!isset($link['options']))
					$link['options'] = array();
					
				$menuLink = array();
				$menuLink['controller'] = $link['controller'];
				$menuLink['action'] = $link['action'];
				$menuLink['admin'] = false;

				if(isset($link['plugin']))
				{
					$menuLink['plugin'] = Inflector::underscore($link['plugin']['name']);
				}

				$metadata = array();
				$metadata['itemInfo'] = $link;
				$metadata['linkUrl'] = $this->Html->url($menuLink);
				
				if(isset($link['edit_action']))
				{
					$editLink = $menuLink;
					$editLink['action'] = $link['edit_action'];
					$metadata['editUrl'] = $this->Html->url($editLink);
				}

				$metadata['isbox'] = false;

				$metadata = htmlspecialchars(json_encode($metadata));
				$randomId = rand(0, time());
				echo '<li class="draggable link" id="'.$randomId.'" metadata="'.$metadata.'">';
				echo $link['title'];
				echo '</li>';
			}
		?>
	</ul>
<?php endforeach; ?>
</div>

<div style="float:left;">
<h2>Side boxes</h2>
<?php foreach ($availableMenus['Sideboxes'] as $category => $categorySideboxes) :?>
	<h3><?php echo $category; ?></h3>
	<ul id="sideboxes" class="menuList">
		<?php 
			foreach($categorySideboxes as $sidebox):
				$metadata = array();
				$metadata['itemInfo'] = $sidebox;
				$metadata['isbox'] = true;
		?>
		<li class="sidedraggable box" id="<?php echo rand(0, time()); ?>" metadata="<?php echo htmlspecialchars(json_encode($metadata)); ?>"><?php echo $sidebox['title']; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endforeach; ?>
</div>