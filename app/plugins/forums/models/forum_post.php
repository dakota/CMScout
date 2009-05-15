<?php
class ForumPost extends ForumsAppModel
{
 var $name = 'ForumPost';
 var $belongsTo = array('ForumThread' => array('className' => 'Forums.ForumThread'), 'User' => array('fields' => array("id", "username", "avatar", "signature")));
 var $actsAs = array('Tag'=>array('table_label'=>'tags', 'tags_label'=>'tag', 'separator'=>','), 'Sluggable');

 var $hasAndBelongsToMany = "Tag";

 function getPageNumber($pageId, $perPage=25)
 {
  	$viewPost = $this->find('first', array('conditions' => array('ForumPost.id' => $pageId), 'fields' => array('id', 'forum_thread_id','created'),
 										'contain' => false));
  	$numberOfPost = $this->find('count', array("conditions" => array ('ForumPost.forum_thread_id' => $viewPost['ForumPost']['forum_thread_id'], 'ForumPost.id <=' => $pageId)));
  	return ceil($numberOfPost / $perPage);
 }
}
?>