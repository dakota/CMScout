
<div id="adminLinks" class="ui-state-default">
	<span id="adminLinksOpen">Admin functions</span>
	<div id="adminLinkDiv">
		<ul id="adminLinkList">
			<?php
				foreach($adminMenu as $category => $links)
				{
					echo '<li>';
					echo $category;
					echo '<ul>';
					foreach ($links as $key => $link)
					{
						echo '<li>';
						if(isset($link['title']))
						{
							echo $html->link($link['title'], array('plugin' => null, 'controller' => $link['controller'], 'action' => $link['action'], 'admin' => true), array('title' => $link['title']));
						}
						else
						{
							echo $key;
							echo '<ul>';
							foreach($link as $pluginLink)
							{
								echo '<li>' . $html->link($pluginLink['title'], array('plugin' => $pluginLink['plugin'], 'controller' => $pluginLink['controller'], 'action' => $pluginLink['action'], 'admin' => true), array('title' => $pluginLink['title'])) . '</li>';
							}
							echo '</ul>';
						}
						echo '</li>';
					}
					echo '</ul>';
					echo '</li>';
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