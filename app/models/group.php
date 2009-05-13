<?php
class Group extends AppModel 
{
 var $name = 'Group';
 var $actsAs = array('Acl'=>'requester', 'ExtendAssociations', 'SoftDeletable'); 
 var $hasAndBelongsToMany = "User";

 function parentNode()
 {
	    return "Groups";
 }
}
?>