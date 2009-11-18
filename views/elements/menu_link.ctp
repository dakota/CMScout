<?php
	$linkArray = array_merge(array(
		'plugin' => $menuItem['plugin'],
		'controller' => $menuItem['controller'],
		'action' => $menuItem['action'],
		'admin' => false),
		$menuItem['options']
	);

	echo $this->Html->link($menuItem['title'], $linkArray);