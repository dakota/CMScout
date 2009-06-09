
<div id="adminLinks" class="ui-state-default">
	<span id="adminLinksOpen">Admin functions</span>
	<div id="adminLinkDiv">
		<ul id="adminLinkList">
			<li><?php echo $html->link(__('Configuration manager', true), '/admin/configurations/index', array('title' => 'Configuration manager')); ?></li>
			<li><?php echo $html->link(__('User manager', true), '/admin/users/index', array('title' => 'Users, groups and permissions manager')); ?></li>
			<li><?php echo $html->link(__('Homepage manager', true), '/admin/homepages/index', array('title' => 'Homepage manager')); ?></li>
			<li><?php echo $html->link(__('Menu manager', true), '/admin/menus/index', array('title' => 'Menu manager')); ?></li>
			<li><?php echo $html->link(__('Page manager', true), '/admin/pages/index', array('title' => 'Page manager')); ?></li>
			<li><?php echo $html->link(__('Plugin manager', true), '/admin/plugins/index', array('title' => 'Plugins')); ?></li>
			<li><?php echo $html->link(__('Theme manager', true), '/admin/themes/index', array('title' => 'Themes')); ?></li>
			<?php foreach ($pluginList as $plugin) :?>
				<?php foreach ($plugin as $pluginLink) :?>
					<li><?php echo $html->link($pluginLink['name'], array('plugin' => $pluginLink['plugin'], 'controller' => $pluginLink['controller'], 'action' => $pluginLink['action'], 'prefix'=>'admin', 'admin' => 1), array('title' => $pluginLink['name'])); ?></li>
				<?php endforeach; ?>
			<?php endforeach;?>
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