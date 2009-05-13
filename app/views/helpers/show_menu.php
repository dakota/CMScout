<?php
 class showMenuHelper extends AppHelper
 {
 	var $helpers = array('Html');

 	function menuList($menuArray, $menuId, $currentPage, $menuClass = false, $menuEditMode = false)
 	{
 		$menuOutput = '';
 		$View =& ClassRegistry::getObject('view');
 		if (isset($menuArray))
 		{
	 		foreach ($menuArray as $menuItem)
	 		{
	 			if ($menuItem['Menu']['menu_id'] == $menuId)
	 			{
	 				if ($menuItem['Menu']['menu_link_id'] != 0)
	 				{
		 				if (!$menuEditMode)
		 				{
		 					$menuLink = array();

							$menuLink['plugin'] = (isset($menuItem['MenuLink']['Plugin']['directory'])) ? $menuItem['MenuLink']['Plugin']['directory'] : '';
							$menuLink['controller'] = $menuItem['MenuLink']['controller'];
							$menuLink['action'] = (isset($menuItem['MenuLink']['action']) && $menuItem['MenuLink']['action'] != '') ? $menuItem['MenuLink']['action'] : 'index';
							$menuLink[] = (isset($menuItem['Menu']['option']) && $menuItem['Menu']['option'] != '') ? $menuItem['Menu']['option'] : '';
							$menuLink['admin'] = false;

							$menuLink = Router::url($menuLink);

		 					$menuOutput .= "<li " . ($menuClass ? "class=\"$menuClass link\">" : ">") .
		 					"<a href=\"" . $menuLink . "\" id=\"link_" . $menuItem['Menu']['id'] ."\" ".
		 					($currentPage == $menuLink ? "class=\"active\"" : "") .">" . trim($menuItem['Menu']['name']) . "</a></li>";
		 				}
		 				else
		 				{
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

		 					$menuLink = array();

							$menuLink['plugin'] = (isset($menuItem['MenuLink']['Plugin']['directory'])) ? $menuItem['MenuLink']['Plugin']['directory'] : '';
							$menuLink['controller'] = $menuItem['MenuLink']['controller'];
							$menuLink['action'] = (isset($menuItem['MenuLink']['action']) && $menuItem['MenuLink']['action'] != '') ? $menuItem['MenuLink']['action'] : 'index';
							$menuLink[] = (isset($menuItem['Menu']['option']) && $menuItem['Menu']['option'] != '') ? $menuItem['Menu']['option'] : '';
							$menuLink['admin'] = false;

							$menuLink = Router::url($menuLink);

							$menuItemId = 'link_' . $menuItem['MenuLink']['id'] . '_' . rand();

							//$editLink

							$menuOutput .= "<li " . ($menuClass ? "class=\"$menuClass link\">" : ">") .
							'<span class="hoverAction" style="background-color:#fff;">'.
							$this->Html->image("/img/edit.png", array("alt" => "Edit",
																'border' => '0',
				    											'url' => $menuEditLink ,
				    											'class' => 'editLink')).
							'&nbsp;'.
							$this->Html->image("/img/remove.png", array("alt" => "Remove",
																'border' => '0',
				    											'url' => '#',
				    											'class' => 'removeLink')).
							'</span>'.
							"<a style=\"z-index:1;\" href=\"" . $menuLink . "\"
		 					rel=\"" . $menuItem['Menu']['option']. "\" id=\"" . $menuItemId ."\">" . trim($menuItem['Menu']['name']) . "</a></li>";
		 				}
	 				}
	 				else
	 				{
	 					if (!$menuEditMode)
		 				{
		 					$element = $View->element('sidebox', array('sidebox' => $menuItem['Sidebox']));
		 					$menuOutput .= "<li " . ($menuClass ? "class=\"$menuClass box\">" : "class=\"box\">") .
		 					'<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" rel="">' .
							'<div class="portlet-header ui-widget-header ui-corner-all" rel="">' .
							'<span class="portlet-name">' . trim($menuItem['Menu']['name']) . '</span>' .
							'</div>'.
		 					'<div class="portlet-content">' .
		 					$element .
		 					'</div>'.
							'</div>'.
		 					"</li>";
		 				}
		 				else
		 				{
		 					$menuOutput .= "<li " . ($menuClass ? "class=\"$menuClass box\">" : "class=\"box\">") .
		 					'<span class="hoverAction" style="background-color:#fff;">'.
							$this->Html->image("/img/edit.png", array("alt" => "Edit",
																'border' => '0',
				    											'url' =>"#",
				    											'class' => 'editLink')).
							'&nbsp;'.
							$this->Html->image("/img/remove.png", array("alt" => "Remove",
																'border' => '0',
				    											'url' => '#',
				    											'class' => 'removeLink')).
							'</span>'.
		 					'<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="sidebox_' . $menuItem['Sidebox']['id'] . '" rel="' . $menuItem['Sidebox']['element'] . '">' .
							'<div class="portlet-header ui-widget-header ui-corner-all">' .
							'<span class="portlet-name">' . trim($menuItem['Menu']['name']) . '</span>' .
							'</div>'.
							'</div>'.
		 					"</li>";
		 				}
	 				}
	 			}
	 		}
 		}
 		return $this->output($menuOutput);
 	}
 }
?>