<?php
class Theme extends AppModel
{
	var $name = "Theme";
	
	function installTheme($xml)
	{
		$data['Theme']['title'] = $xml['Theme']['title'];
		$data['Theme']['slug'] = $xml['Theme']['slug'];
		$data['Theme']['unique_id'] = $xml['Theme']['uniqueId'];
		
		$this->create();
		return $this->save($data);
		
	}
}
?>