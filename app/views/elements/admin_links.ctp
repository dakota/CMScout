<div id="adminLinks" class="ui-state-default">
	<span id="adminLinksOpen">Admin functions</span>
	<div id="adminLinkDiv">
		<ul id="adminLinkList">
			<li><?php echo $html->link(__('Configuration manager', true), '/admin/configurations/index', array('title' => 'Configuration manager')); ?></li>
			<li><?php echo $html->link(__('User manager', true), '/admin/users/index', array('title' => 'Users, groups and permissions manager')); ?></li>
			<li><?php echo $html->link(__('Home manager', true), '/admin/homepages/index', array('title' => 'Home manager')); ?></li>
			<li><?php echo $html->link(__('Menu manager', true), '/admin/menus/index', array('title' => 'Menu manager')); ?></li>
			<li><?php echo $html->link(__('Page manager', true), '/admin/pages/index', array('title' => 'Page manager')); ?></li>
			<li id="plugins" class="hasSubMenu"><?php echo $html->link(__('Plugin manager', true), '/admin/plugins/index', array('title' => 'Plugins')); ?></li>
			<li><?php echo $html->link(__('Theme manager', true), '/admin/themes/index', array('title' => 'Themes')); ?></li>
		</ul>
		<ul id="pluginsList" class="adminSubMenu">
			<?php foreach ($pluginList as $plugin) :?>
			<li><?php echo $html->link($plugin['Plugin']['title'], array('plugin' => $plugin['Plugin']['directory'], 'controller' => $plugin['Plugin']['directory'], 'action' => 'index', 'prefix'=>'admin', 'admin' => 1), array('title' => $plugin['Plugin']['title'])); ?></li>
			<?php endforeach;?>
		</ul>
	</div>
	<script type="text/javascript">
		var timer;
		var subTimer;

		function hideList()
		{
			$("#adminLinkDiv").fadeOut('fast', function() {
				$("#adminLinks").switchClass("ui-widget-header", "ui-state-default", 0);
			});
		}

		$("#adminLinkDiv").hide();
		$(".adminSubMenu").hide();

		$(".hasSubMenu").hover(function () {
			var id = this.id;
			$(".adminSubMenu").hide();
			clearTimeout(subTimer);

			$("#" + id + "List").show('fast').hover(function(){
					clearTimeout(subTimer);
				},
				function(){
					clearTimeout(subTimer);
					subTimer = setTimeout('$("#' + this.id + '").hide("fast");', 1000);
				});
		},
		function ()
		{
			var id = this.id;

			clearTimeout(subTimer);
			subTimer = setTimeout('$("#' + id + 'List").hide("fast");', 1000);
		});

		$("#adminLinks li").addClass('ui-state-default').hover(function() {
			if (!$(this).hasClass('ui-state-hover'))
			{
				$(this).addClass('ui-state-hover');
			}

			clearTimeout(subTimer);

			if (!$(this).hasClass('hasSubMenu') && !$(this).parent('ul').hasClass('adminSubMenu'))
			{
				clearTimeout(subTimer);
				subTimer = setTimeout('$(".adminSubMenu").hide("fast");', 1000);
			}

		}, function() {
			$(this).removeClass('ui-state-hover');
		});

		$("#adminLinks").mouseenter(function() {
			clearTimeout(timer);
			if ($("#adminLinkDiv:visible").length == 0)
			{
				$("#adminLinkDiv").fadeIn('fast');
				$("#adminLinks").switchClass("ui-state-default", "ui-widget-header", 0);
			}

			return false;
		}).mouseleave(function() {
			clearTimeout(timer);
			timer = setTimeout('hideList()', 1000);
		});
	</script>
</div>