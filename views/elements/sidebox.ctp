<?php
if ($sidebox['plugin_id'] == 0)
{
	$View =& ClassRegistry::getObject('view');
	echo $View->element('sideboxes/' . $sidebox['element'], array('item' => $sidebox));
}
else
{
	$View =& ClassRegistry::getObject('view');
	echo $View->element('sideboxes/' . $sidebox['element'], array('item' => $sidebox, 'plugin' => $sidebox['Plugin']['directory']));
}
?>