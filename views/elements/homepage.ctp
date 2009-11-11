<?php 
if ($item['MenuLink']['plugin_id'] == 0)
{
	$View =& ClassRegistry::getObject('view');
	echo $View->element('homepages/' . $item['MenuLink']['controller'], array('item' => $item));
}
else
{
	$View =& ClassRegistry::getObject('view');
	echo $View->element('homepages/' . $item['MenuLink']['controller'], array('item' => $item, 'plugin' => $item['MenuLink']['Plugin']['directory']));
}
?>