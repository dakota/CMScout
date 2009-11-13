
<div id="adminLinks" class="ui-state-default">
	<span id="adminLinksOpen">Admin functions</span>
	<div id="adminLinkDiv">
		<ul id="adminLinkList">
			<li><?php echo $html->link(__('Configuration manager', true), '/admin/configurations/index', array('title' => 'Configuration manager')); ?></li>
			<li><?php echo $html->link(__('User manager', true), '/admin/users/index', array('title' => 'Users, groups and permissions manager')); ?></li>
			<li><?php echo $html->link(__('Homepage manager', true), '/admin/homepages/index', array('title' => 'Homepage manager')); ?></li>
			<li><?php echo $html->link(__('Menu manager', true), '/admin/menus/index', array('title' => 'Menu manager')); ?></li>
			<li><?php echo $html->link(__('Plugin manager', true), '/admin/plugins/index', array('title' => 'Plugins')); ?></li>
			<li><?php echo $html->link(__('Theme manager', true), '/admin/themes/index', array('title' => 'Themes')); ?></li>
			<?php
				if(isset($pluginList) && $pluginList !== false)
				{
					foreach ($pluginList as $category => $plugins)
					{
						echo '<li>';
						echo $category;
						echo '<ul>';
						foreach ($plugins as $plugin => $pluginLinks)
						{
							echo '<li>';
							echo $plugin;
							echo '<ul>';
							foreach($pluginLinks as $link)
							{
								echo '<li>' . $html->link($link['name'], array('plugin' => $link['plugin'], 'controller' => $link['controller'], 'action' => $link['action'], 'admin' => true), array('title' => $link['name'])) . '</li>';
							}
							echo '</ul>';
							echo '</li>';
						}
						echo '</ul>';
						echo '</li>';
					}
				}
			?>

		</ul>
	</div>
	<script type="text/javascript">
		var timer;

		function hideList()
		{
			$("#adminLinkDiv").fadeOut('fast', function() {
				$("#adminLinks").switchClass("adminOpen", "ui-state-default", 0);
			});
		}

		$("#adminLinkDiv").hide();

		$("#adminLinks li").addClass('ui-state-default').hover(function() {
			if (!$(this).hasClass('ui-state-hover'))
			{
				$(this).addClass('ui-state-hover');
			}
		}, function() {
			$(this).removeClass('ui-state-hover');
		});

		$("#adminLinks").mouseenter(function() {
			clearTimeout(timer);
			if ($("#adminLinkDiv:visible").length == 0)
			{
				$("#adminLinkDiv").fadeIn('fast');
				$("#adminLinks").switchClass("ui-state-default", "adminOpen", 0);
			}

			return false;
		}).mouseleave(function() {
			clearTimeout(timer);
			timer = setTimeout('hideList()', 1000);
		});
	</script>
</div>