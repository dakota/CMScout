<?php
class MenuLink extends AppModel 
{
	var $name = 'MenuLink';
	var $belongsTo = 'Plugin';
	var $hasMany = 'Menu';
}
?>