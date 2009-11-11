<?php 
	if(!isset($itemWrapper)) $itemWrapper = 'li';
	if(!isset($itemClass)) $itemClass = '';
	if(!isset($activeClass)) $activeClass = 'active';
?>
<?php foreach($menuArray as $menuItem) :?>
	<?php if ($menuItem['Menu']['menu_id'] == $menuId) :?>
			<?php if ($menuItem['Menu']['menu_link_id'] != null):?>
				<?php echo '<'.$itemWrapper.' class="'.$itemClass.'">'; ?>
				<?php 
		 			$menuLink = array();
	
					$menuLink['plugin'] = (isset($menuItem['MenuLink']['Plugin']['directory'])) ? $menuItem['MenuLink']['Plugin']['directory'] : '';
					$menuLink['controller'] = $menuItem['MenuLink']['controller'];
					$menuLink['action'] = (isset($menuItem['MenuLink']['action']) && $menuItem['MenuLink']['action'] != '') ? $menuItem['MenuLink']['action'] : 'index';
					$menuLink['admin'] = false;
					$menuLink[] = (isset($menuItem['Menu']['option']) && $menuItem['Menu']['option'] != '') ? $menuItem['Menu']['option'] : '';
	
					$menuLink = Router::url($menuLink);
				?>
				<a href="<?php echo $menuLink; ?>" id="link_<?php echo $menuItem['Menu']['id']; ?>" <?php echo ($this->here == $menuLink ? 'class="'.$activeClass.'"' : "");?>>
					<?php echo $menuItem['Menu']['name']; ?>
				</a>
			<?php else :?>
				<?php $element = $this->element('sidebox', array('sidebox' => $menuItem['Sidebox'])); ?>
				<?php echo '<'.$itemWrapper.' class="'.$itemClass.' box">'; ?>
 				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" rel="">
					<div class="portlet-header ui-widget-header ui-corner-all" rel="">
						<span class="portlet-name"><?php echo $menuItem['Menu']['name']; ?></span>
					</div>
		 			<div class="portlet-content">
		 				<?php echo $element; ?>
		 			</div>
				</div>
			<?php endif;?>
		<?php echo '</'.$itemWrapper.'>';?>
	<?php endif; ?>
<?php endforeach;?>