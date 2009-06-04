<?php 
	if(!isset($itemWrapper)) $itemWrapper = 'li';
	if(!isset($itemClass)) $itemClass = '';
	if(!isset($activeClass)) $activeClass = 'active';
?>
<?php foreach($menuArray as $menuItem) :?>
	<?php if ($menuItem['Menu']['menu_id'] == $menuId) :?>
			<?php if ($menuItem['Menu']['menu_link_id'] != null):?>
				<?php 
					$metaData = array();
					$metaData['isBox'] = false;
					$metaData['name'] = trim($menuItem['Menu']['name']);
					$metaData['linkId'] = $menuItem['Menu']['id'];
					$metaData['option'] = $menuItem['Menu']['option'];
					echo '<'.$itemWrapper.' id ="'.$menuItem['Menu']['id'].'" class="'.$itemClass.'" data="'.str_replace('"', "'", json_encode($metaData)).'">'; 
				?>
				<?php 
		 			$menuLink = array();
	
					$menuLink['plugin'] = (isset($menuItem['MenuLink']['Plugin']['directory'])) ? $menuItem['MenuLink']['Plugin']['directory'] : '';
					$menuLink['controller'] = $menuItem['MenuLink']['controller'];
					$menuLink['action'] = (isset($menuItem['MenuLink']['action']) && $menuItem['MenuLink']['action'] != '') ? $menuItem['MenuLink']['action'] : 'index';
					$menuLink[] = (isset($menuItem['Menu']['option']) && $menuItem['Menu']['option'] != '') ? $menuItem['Menu']['option'] : '';
					$menuLink['admin'] = false;
	
					$menuLink = Router::url($menuLink);
					
					$menuEditLink = array();
					if ($menuItem['MenuLink']['menu_action'] != '')
					{
	 					$menuEditLink['plugin'] = (isset($menuItem['MenuLink']['Plugin']['directory'])) ? $menuItem['MenuLink']['Plugin']['directory'] : '';
						$menuEditLink['controller'] = $menuItem['MenuLink']['controller'];
	 					$menuEditLink['action'] = $menuItem['MenuLink']['menu_action'];
					}
					else
					{
						$menuEditLink = '#';
					}					
				?>
				<span class="hoverAction" style="background-color:#fff;">
					<?php echo $html->image("/img/edit.png", array("alt" => "Edit",
														'border' => '0',
		    											'url' => $menuEditLink ,
		    											'class' => 'editLink'))?>
					&nbsp;
					<?php echo $html->image("/img/remove.png", array("alt" => "Remove",
														'border' => '0',
		    											'url' => '#',
		    											'class' => 'removeLink')) ?>
				</span>				
				<a  style="z-index:1;" rel="<?php echo $menuItem['Menu']['option']?>" href="<?php echo $menuLink; ?>" id="link_<?php echo $menuItem['Menu']['id']; ?>" <?php echo ($this->here == $menuLink ? 'class="'.$activeClass.'"' : "");?>><?php echo trim($menuItem['Menu']['name']); ?></a>
			<?php else :?>
				<?php echo '<'.$itemWrapper.' id ="'.$menuItem['Menu']['id'].'" class="'.$itemClass.' box">'; ?>
				<span class="hoverAction" style="background-color:#fff;">
					<?php echo $html->image("/img/edit.png", array("alt" => "Edit",
														'border' => '0',
		    											'url' => '#' ,
		    											'class' => 'editLink'))?>
					&nbsp;
					<?php echo $html->image("/img/remove.png", array("alt" => "Remove",
														'border' => '0',
		    											'url' => '#',
		    											'class' => 'removeLink')) ?>
				</span>				
 				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="sidebox_<?php echo $menuItem['Sidebox']['id'] ?>" rel="<?php echo $menuItem['Sidebox']['element'] ?>">
					<div class="portlet-header ui-widget-header ui-corner-all" rel="">
						<span class="portlet-name"><?php echo trim($menuItem['Menu']['name']); ?></span>
					</div>
				</div>
			<?php endif;?>
		<?php echo '</'.$itemWrapper.'>';?>
	<?php endif; ?>
<?php endforeach;?>