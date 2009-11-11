<?php
	$javascript->link('jquery.blockui', false);
	$javascript->link('jquery.metadata', false);
	$javascript->link('jquery.livemouse', false);
	$javascript->link('menus/admin_index', false);
	$javascript->link('jquery.qq', false);	
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
<ul id="links" class="menuList">
<?php
	foreach ($links as $link) :
		$menuEditLink = array();
		if ($link['MenuLink']['menu_action'] != '')
		{
 			$menuEditLink['plugin'] = (isset($link['MenuLink']['Plugin']['directory'])) ? $link['MenuLink']['Plugin']['directory'] : '';
			$menuEditLink['controller'] = $link['MenuLink']['controller'];
 			$menuEditLink['action'] = $link['MenuLink']['menu_action'];

 			$menuEditLink = Router::url($menuEditLink);
		}
		else
		{
			$menuEditLink = '#';
		}

 		$menuLink = array();

		$menuLink['plugin'] = (isset($link['MenuLink']['Plugin']['directory'])) ? $link['MenuLink']['Plugin']['directory'] : '';
		$menuLink['controller'] = $link['MenuLink']['controller'];
		$menuLink['action'] = (isset($link['MenuLink']['action']) && $link['MenuLink']['action'] != '') ? $link['MenuLink']['action'] : 'index';
		$menuLink['admin'] = false;
		$menuLink[] = (isset($link['Menu']['option']) && $link['Menu']['option'] != '') ? $link['Menu']['option'] : '';

		$menuLink = Router::url($menuLink);
		$menuName = (isset($link['MenuLink']['title']) && $link['MenuLink']['title'] != '') ? $link['MenuLink']['title'] : $link['Plugin']['title'];
?>
	<li class="draggable link"><a href="<?php echo $menuLink; ?>|<?php echo $menuEditLink ?>" rel="" id="link_<?php echo $link['MenuLink']['id']; ?>"><?php echo $menuName; ?></a></li>
<?php endforeach; ?>
</ul>
</div>

<div style="float:left;">
<h2>Side boxes</h2>
<ul id="sideboxes" class="menuList">
<?php foreach ($sideboxes as $sidebox) :?>
	<li class="sidedraggable box"><a href="#" id="sidebox_<?php echo $sidebox['Sidebox']['id']; ?>" rel="<?php echo $sidebox['Sidebox']['element']; ?>"><?php echo $sidebox['Sidebox']['title']; ?></a></li>
<?php endforeach; ?>
</ul>
</div>