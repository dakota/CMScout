<?php
class Contribution extends AppModel 
{
	var $name = 'Contribution';
	var $actsAs = array('Acl'=>'controlled'); 
	 
	function parentNode()
	{
	    return "Contributions";
	} 	
}
?>