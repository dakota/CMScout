<?php
class Article extends ArticlesAppModel
{
 var $name = 'Article';
 var $useTable = 'articles_articles';
 var $belongsTo = array('User' => array('fields' => array("id", "username")));
 var $actsAs = array('Tag'=>array('table_label'=>'tags', 'tags_label'=>'tag', 'separator'=>','), 'Sluggable', 'SoftDeletable', 'Searchable', 'Publishable', 'Commentable');
 var $hasAndBelongsToMany = array("Tag");

	function getHomepage($itemOptions)
	{
		if ($itemOptions['Homepage']['options'] != '')
		{
			return $this->find('first', array('conditions' => array("Article.slug" => $itemOptions['Homepage']['options'])));
		}
	}
}
?>