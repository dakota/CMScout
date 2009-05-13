<?php 
	$html->css('ui.theme/ui.tabs', null, array(), false);
	$html->css('ui.theme/ui.accordion', null, array(), false);
?>
<div id="tabs">
	<ul>
		<li><a href="<?php echo $html->url("/users/publicProfile"); ?>">My Public Profile</a></li>
		<li><a href="<?php echo $html->url("/users/profileEdit"); ?>">Edit profile</a></li>
		<li><a href="<?php echo $html->url("/users/privacy"); ?>">Privacy settings</a></li>
		<li><a href="<?php echo $html->url("/users/notifications"); ?>">Notifications</a></li>
		<li><a href="<?php echo $html->url("/users/contribute"); ?>">Contribute something</a></li>
	</ul>
</div>
<script type="text/javascript">
	$("#tabs").tabs({
		selected: 0
	});
</script>