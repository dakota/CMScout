<?php
class Page extends AppModel
{
	var $name = 'Page';
	var $actsAs = array('Acl'=>'controlled', 'Tag'=>array('table_label'=>'tags', 'tags_label'=>'tag', 'separator'=>','), 'Sluggable', 'SoftDeletable', 'Searchable');
	var $hasAndBelongsToMany = "Tag";

	function parentNode()
	{
	    return "Pages";
	}

	function getHomepage($itemOptions)
	{
		if ($itemOptions['Homepage']['options'] != '')
		{
			return $this->find('first', array('conditions' => array("Page.slug" => $itemOptions['Homepage']['options']), 'contain' => false));
		}
	}
}
?>