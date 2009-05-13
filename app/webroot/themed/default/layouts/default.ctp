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
		echo $html->meta('icon');
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
/*		echo $html->css('jquery.lightbox');
		echo "\n";
		echo $html->css('tree_component');
		echo "\n";
		echo $html->css('ui.dialog');
		echo "\n";
		echo $html->css('ui.core');
		echo "\n";
		echo $html->css('ui.theme');
		echo "\n";*/

		echo $javascript->link('jquery');
		echo "\n";
		echo $javascript->link('jquery.jgrowl');
		echo "\n";
		echo $javascript->link('jquery.ui');
		echo "\n";
/*		echo $javascript->link('jquery.jgrowl');
		echo "\n";
		echo $javascript->link('blockui');
		echo "\n";
		echo $javascript->link('jquery.timeago');
		echo "\n";
		echo $javascript->link('tree_component');
		echo "\n";
		echo $javascript->link('jquery.listen');
		echo "\n";
		echo $javascript->link('jquery.metadata');
		echo "\n";
		echo $javascript->link('swfupload');
		echo "\n";
		echo $javascript->link('swfupload.queue');
		echo "\n";
		echo $javascript->link('jquery.lightbox');
		echo "\n";*/

		echo $scripts_for_layout;
  ?>

  <script type="text/javascript">
		var rootLink = '<?php echo $html->url('/');?>';

  		function refreshItems()
  		{
  			//$('.timeago').timeago();
  		}

    	var swfu;

		$(document).bind("ajaxStop", function(request, settings){
				refreshItems();
 			}
 		);

        $(document).ready(function()
        {
        	var flashMessage = '<?php echo $session->flash(); ?>';
        	var authMessage = '<?php echo $session->flash('auth'); ?>';
        	if (flashMessage != '')
        	{
        		$.jGrowl(flashMessage);
        	}

        	if (authMessage != '')
        	{
        		authMessage = authMessage.replace('<div id="authMessage" class="message">', '');
        		authMessage = authMessage.replace('</div>', '');
        		$.jGrowl(authMessage);
        	}

    		$("#genericDialog").dialog({
    			autoOpen: false,
    			bgiframe: true,
    			modal: true,
    			title: '',
    			width: "350px",
    			draggable: false,
    			//hide: 'fade',
    			//show: 'fade',
    			position: 'top',
    			overlay: {
    				backgroundColor: '#000',
    				opacity: 0.7
    			},
    			resizable: false
    		});

			refreshItems();

			$(".submit input, button").live('mouseover', function() {$(this).addClass('hover');});
			$(".submit input, button").live('mouseout', function() {$(this).removeClass('hover');});

			$('.dialogLink').live('click', function () {
					$("#genericDialog").html('<img src="<?php echo $html->url('/img/throbber.gif'); ?>" alt="" /><?php __('Loading'); ?>...');

					$("#genericDialog").load($(this).attr('href'));

					$("#genericDialog").dialog('option', 'title', $(this).attr('title'));

					$("#genericDialog").dialog('open');
					return false;
				});

			$("#layoutSearch").bind('focus', function() {$(this).val(''); });
			$("#layoutSearch").bind('blur', function() {$(this).val('Search'); });

			if (typeof pageScript != 'undefined')
				pageScript('<?php echo $html->url('/');?>');
        });
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
						<?php if (isset($menuArray)) { echo $showMenu->menuList($menuArray, 'menu1', Router::url("", true), false, $menuadminMode); } ?>
				</ul>

				<ul id="menu2" class="subnav menu">
						<?php if (isset($menuArray)) { echo $showMenu->menuList($menuArray, 'menu2', Router::url("", true), false, $menuadminMode); } ?>
				</ul>
		</div>

		<table width="100%" border="0" style="border: 0px;">
		<tr style="border: 0px;">
		<td id="sidebar">
			<ul class="subnav menu sideboxes" id="menu3">
				<?php if (isset($menuArray)) { echo $showMenu->menuList($menuArray, 'menu3', Router::url("", true), false, $menuadminMode); } ?>
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
<?php if (isset($adminMode) && $adminMode) : ?>
	<?php echo $this->element('admin_links', $pluginList); ?>
<?php endif;	?>


	<?php echo $cakeDebug; ?>

</body>
</html>