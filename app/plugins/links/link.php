<?php
class Link extends AppModel 
{
 var $name = 'Link';
 var $actsAs = array('Tag'=>array('table_label'=>'tags', 'tags_label'=>'tag', 'separator'=>','), 'Sluggable'); 
 var $hasAndBelongsToMany = "Tag";
}
?>