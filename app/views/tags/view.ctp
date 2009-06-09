<?php
	$javascript->link('quicksilver', false);
	$javascript->link('jquery.livesearch', false);
?>
Filter: <input id="filterInput" value="" type="text" />
<ul class="tagsList">
<?php
	foreach ($tags as $tag) :
?>
	<li><?php
		$link = array();
		$link['plugin'] = (isset($tag['plugin'])) ? $tag['plugin'] : '';
		$link['controller'] = $tag['controller'];
		$link['action'] = $tag['action'];
		$link[] = $tag['slug'];
		$link['admin'] = false;
		if (isset($tag['params']))
		{
			$link = am($link, $tag['params']);
		}
		echo $html->link($tag['title'], $link);
	?></li>
<?php
	endforeach;
?>
</ul>
<?php echo $html->link('Search for similar items', array('controller' => 'search', 'action' => 'search', urlencode($thisTag['Tag']['tag'])));?>
<script type="text/javascript">
	$('#filterInput').liveUpdate('.tagsList', '').focus();
</script>