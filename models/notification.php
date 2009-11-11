<?php
class Notification extends AppModel
{
	var $name = 'Notification';
	var $hasAndBelongsToMany = array('User');
	var $actsAs = array('Acl'=>'controlled');
	var $belongsTo = array('Plugin');

	function parentNode()
	{
	    return "Notifications";
	}
}
?>