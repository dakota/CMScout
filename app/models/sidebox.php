<?php
class Sidebox extends AppModel 
{
	var $name = 'Sidebox';
	var $actsAs = array('Acl'=>'controlled'); 
	var $belongsTo = 'Plugin';
	
	function parentNode()
	{
	    return "Sideboxes";
	} 
}
?>