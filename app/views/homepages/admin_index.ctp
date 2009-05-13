<?php
	$javascript->link('jquery.blockui', false);
	$javascript->link('homepages/admin_index', false);
?>

<div id="homepageContainer" style="width: 100%;">
	<div id="homepageArea" style="float:right; width: 70%; border: 2px dashed #f00;">
		<div class="column" id="firstColumn" style="border-right: 2px dashed #0f0;">
			<?php foreach ($firstColumn as $item) :
					if ($item['MenuLink']['frontpage_action'] != '')
					{
						$menuLink = (isset($item['Plugin']['directory'])) ? $item['Plugin']['directory'] . '/' : '';
						$menuLink .= $item['MenuLink']['controller'];
					}
					else
					{
						$menuLink = '';
					}
			?>
				<div class="portlet" id="<?php echo $item['Homepage']['menu_link_id'] . '_' . $item['Homepage']['id']; ?>" rel="<?php echo $menuLink . '/' . $item['MenuLink']['frontpage_action']; ?>">
				<div class="portlet-header">
					<span class="infoSpan" style="display:none;"><?php echo $item['Homepage']['options']; ?></span>
					<span class="portlet-name"><?php echo $item['Homepage']['name']; ?></span>
				</div>
				<div class="portlet-content">
				<?php if ($item['MenuLink']['frontpage_action'] == '') :?>
					No options
				<?php else : ?>
					<img src="<?php echo $html->url('/img/throbber.gif'); ?>" /> <?php __('Loading'); ?>...
				<?php endif; ?></div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="column" id="secondColumn">
			<?php foreach ($secondColumn as $item) :
					if ($item['MenuLink']['frontpage_action'] != '')
					{
						$menuLink = (isset($item['Plugin']['directory'])) ? $item['Plugin']['directory'] . '/' : '';
						$menuLink .= $item['MenuLink']['controller'];
					}
					else
					{
						$menuLink = '';
					}
			?>
				<div class="portlet" id="<?php echo $item['Homepage']['menu_link_id'] . '_' . $item['Homepage']['id']; ?>" rel="<?php echo $menuLink . '/' . $item['MenuLink']['frontpage_action']; ?>">
				<div class="portlet-header">
					<span class="infoSpan" style="display:none;"><?php echo $item['Homepage']['options']; ?></span>
					<span class="portlet-name"><?php echo $item['Homepage']['name']; ?></span>
				</div>
				<div class="portlet-content">
				<?php if ($item['MenuLink']['frontpage_action'] == '') :?>
					No options
				<?php else : ?>
					<img src="<?php echo $html->url('/img/throbber.gif'); ?>" /> <?php __('Loading'); ?>...
				<?php endif; ?></div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
<ul class="menuList" id="modules">
	<?php foreach ($links as $link) :
		if ($link['MenuLink']['frontpage_action'] != '')
		{
			$menuLink = (isset($link['Plugin']['directory'])) ? $link['Plugin']['directory'] . '/' : '';
			$menuLink .= $link['MenuLink']['controller'];
			$menuLink .= '/' . $link['MenuLink']['frontpage_action'];

			$class = '';
		}
		else
		{
			$menuLink = '';
			$class = 'noLoad';
		}

		$menuName = (isset($link['MenuLink']['title']) && $link['MenuLink']['title'] != '') ? $link['MenuLink']['title'] : $link['Plugin']['title'];

	?>
		<li class="module <?php echo $class; ?>"><span rel="<?php echo $menuLink; ?>" id="<?php echo $link['MenuLink']['id']?>"><?php echo $menuName; ?></span></li>
	<?php endforeach;?>

	<li class="module noLoad"><span rel="stretch" id="0"><?php __('Force stretch'); ?></span></li>
	<li class="module noLoad"><span rel="blank" id="-1"><?php __('Blank block'); ?></span></li>
</ul>
</div>