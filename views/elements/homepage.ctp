<?php 
if ($item['MenuLink']['plugin_id'] == 0)
{
	echo $this->element('homepages/' . $item['MenuLink']['controller'], array('item' => $item));
}
else
{
	echo $this->element('homepages/' . $item['MenuLink']['controller'], array('item' => $item, 'plugin' => $item['MenuLink']['Plugin']['directory']));
}
?>