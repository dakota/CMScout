<?php
	function tagElementCmp($a, $b)
	{
		return strcasecmp($a['tag'], $b['tag']);
	}

	$tagList = array();

	usort($tags, 'tagElementCmp');
	foreach ($tags as $tag)
	{
		$tagList[] = '<a href="'.Router::url(array('controller' => 'tags', 'action' => 'index', 0 => $tag['slug'])).'">'.$tag['tag'].'</a>';
	}

	echo implode(', ', $tagList);
?>