<?php
/* SVN FILE: $Id: default.ctp 7690 2008-10-02 04:56:53Z nate $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link			http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.view.templates.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7690 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2008-10-02 00:56:53 -0400 (Thu, 02 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<?php echo $html->docType(); echo "\n"; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo Configure::read('CMScout.Core.SiteName'); ?> ::
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $html->meta('icon');
		echo "\n";

		echo $html->css('aqueous_light');
		echo "\n";
		echo $html->css('cake.generic');
		echo "\n";
		echo $html->css('jquery.jgrowl');
		echo "\n";
		echo $html->css('ui.theme/ui.core');
		echo "\n";
		echo $html->css('ui.theme/ui.theme');
		echo "\n";
		echo $html->css('ui.theme/ui.dialog');
		echo "\n";
		echo $html->css('jquery.alerts');

		echo $javascript->link('jquery');
		echo "\n";
		echo $javascript->link('jquery.jgrowl');
		echo "\n";
		echo $javascript->link('jquery.ui');
		echo "\n";
		echo $javascript->link('jquery.alerts');
		echo "\n";
		echo $javascript->link('functions');
		
		echo $scripts_for_layout;			
		
  ?>
<script type="text/javascript">
	var rootLink = '<?php echo $html->url('/', true);?>';
	var controllerLink = '<?php 
		$controllerLink = $html->url(array('plugin' => $this->params['plugin'], 'controller' => $this->params['controller'], 'action' => false));
		$controllerLink = explode('/', $controllerLink);
		$controllerLink[count($controllerLink)-1] = '';
		echo implode('/', $controllerLink);
	?>';
	var themeDir = rootLink + 'themed/<?php echo $this->theme; ?>/';

    var swfu;

    var flashMessage = '<?php $session->flash(); ?>';
    
    var authMessage = '<?php $session->flash('auth'); ?>';
</script>  
</head>
<body>
<div id="wrapper">
<div id="innerwrapper">
		<div id="header">
				<form action="<?php echo $html->url('/search/search');?>" method="post">
					<input value="Search" name="data[Search][q]" id="layoutSearch" />
				</form>
				<h1><?php echo $html->link(Configure::read('CMScout.Core.SiteName'), '/'); ?></h1>

				<h2>
						<?php echo Configure::read('CMScout.Core.SiteTag'); ?>
				</h2>

				<ul id="menu1" class="menu">
						<?php if (isset($menuArray)) echo $this->element((isset($menuadminMode) ? 'menuEdit' : 'menu'), array('menuArray' => $menuArray,
																						'menuId' => 'menu1'));?>
				</ul>

				<ul id="menu2" class="subnav menu">
						<?php if (isset($menuArray)) echo $this->element((isset($menuadminMode) ? 'menuEdit' : 'menu'), array('menuArray' => $menuArray,
																						'menuId' => 'menu2'));?>
				</ul>
		</div>

		<table width="100%" border="0" style="border: 0px;">
		<tr style="border: 0px;">
		<td id="sidebar">
			<ul class="subnav menu sideboxes" id="menu3">
						<?php if (isset($menuArray)) echo $this->element((isset($menuadminMode) ? 'menuEdit' : 'menu'), array('menuArray' => $menuArray,
																						'menuId' => 'menu3'));?>
			</ul>
		</td>
		<td id="contentArea">
        	<?php echo stripslashes($content_for_layout);?>
		</td>
		</tr>
		</table>

		<div id="footer">
			<!-- Please leave this line intact -->
			<p>Template design by <a href="http://www.sixshootermedia.com">Six Shooter Media</a>.<br />
			<!-- you can delete below here -->
			</p>
		</div>
</div>
</div>
<div style="display: none;" id="genericDialog"></div>
<?php echo $cakeDebug; ?>

<?php if (isset($adminMode) && $adminMode) :?>
	<?php echo $this->element('admin_links', array('pluginList' => $pluginList, 'cache' => '+1 hour')); ?>
<?php endif;	?>
</body>
</html>