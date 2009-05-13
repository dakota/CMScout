<?php
class Comment extends AppModel
{
	var $name = "Comment";
	var $actAs = array('Publishable');
	var $belongsTo = array('User');
}
?>