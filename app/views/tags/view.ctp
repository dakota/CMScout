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
		$link['plugin'] = (isset($tag['plugin']['plugin'])) ? $tag['plugin']['plugin'] : '';
		$link['controller'] = strtolower(Inflector::pluralize($tag['model']));
		$link['action'] = 'index';
		$link[] = $tag['data']['slug'];
		$link['admin'] = false;
		echo $html->link($tag['data']['title'], $link);
	?></li>
<?php
	endforeach;
?>
</ul>
<script type="text/javascript">
	$('#filterInput').liveUpdate('.tagsList', '').focus();
</script>