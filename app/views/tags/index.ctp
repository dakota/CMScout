<?php
	$javascript->link('quicksilver', false);
	$javascript->link('jquery.livesearch', false);
?>
Filter: <input id="filterInput" value="" type="text" />
<ul class="tagsList">
<?php
	foreach ($tags as $tag) :
?>
	<li><?php echo $html->link($tag['Tag']['tag'], array('controller' => 'tags', 'action' => 'index', $tag['Tag']['slug'])); ?></li>
<?php
	endforeach;
?>
</ul>
<script type="text/javascript">
	$('#filterInput').liveUpdate('.tagsList', '').focus();
</script>