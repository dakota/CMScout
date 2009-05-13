<?php
class Album extends PhotosAppModel 
{
 var $name = 'Album';
 var $useTable = 'photos_albums';
 var $belongsTo = array('User' => array('fields' => array("id", "username")));
 var $actsAs = array('Tag'=>array('table_label'=>'tags', 'tags_label'=>'tag', 'separator'=>','), 'Sluggable', 'Publishable', 'Commentable'); 
 var $hasAndBelongsToMany = "Tag";
 var $hasMany = array("Photo" => array('className' => 'Photos.Photo'));
}
?>