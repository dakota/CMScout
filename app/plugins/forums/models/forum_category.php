<?php
class ForumCategory extends ForumsAppModel
{
 var $name = 'ForumCategory';
 var $hasMany = array('ForumForum' => array (
 							'className' => 'Forums.ForumForum',
 							'order' => 'ForumForum.order ASC',
 							'dependent' => true
 						));
 var $actAs = array('Sluggable');
 var $order = "ForumCategory.order ASC";

 function fetchCategories($slug, $userId)
 {
 	$returnData = array();

 	$conditions = array();
 	if ($slug != null)
 	{
 		$conditions['ForumCategory.slug'] = $slug;
 	}

 	$categories = $this->find('all', array('conditions' => $conditions, 'contain' => array('ForumForum' => array('conditions'=> array('ForumForum.parent_id' => '0'), 'ChildForum'))));

 	foreach($categories as $category)
 	{
 		$returnCategory = array();
 		$returnCategory['slug'] = $category['ForumCategory']['slug'];
 		$returnCategory['title'] = $category['ForumCategory']['title'];
		$returnCategory['forums'] = array();
 		foreach($category['ForumForum'] as $forum)
 		{
 			$returnForum = array();

			$numberThreads = $this->ForumForum->ForumThread->find('count', array('contain' => false, 'conditions' => array('ForumThread.forum_forum_id' => $forum['id'])));
			$threadList = $this->ForumForum->ForumThread->find('list', array('contain' => false, 'conditions' => array('ForumThread.forum_forum_id' => $forum['id'])));
			$numberPosts = $this->ForumForum->ForumThread->ForumPost->find('count', array('contain' => false, 'conditions' => array('ForumPost.forum_thread_id' => array_keys($threadList))));
			$lastPost = $this->ForumForum->ForumThread->ForumPost->find('first', array('contain' => array('User', 'ForumThread'), 'conditions' => array('ForumPost.forum_thread_id' => array_keys($threadList)), 'order' => array('ForumPost.created DESC')));
			$hasUnread = $this->ForumForum->ForumThread->ForumUnreadPost->find('count', array('conditions' => array('ForumUnreadPost.user_id' => $userId, 'ForumUnreadPost.forum_thread_id' => array_keys($threadList))));

			$returnForum['title'] = $forum['title'];
			$returnForum['slug'] = $forum['slug'];
			$returnForum['description'] = $forum['description'];
			$returnForum['number_threads'] = $numberThreads;
			$returnForum['number_posts'] = $numberPosts;
			$returnForum['lastPost'] = $lastPost;
			$returnForum['unreadPost'] = $hasUnread;
			$returnForum['ChildForum'] = $forum['ChildForum'];

			$returnCategory['forums'][] = $returnForum;
 		}

 		$returnData[] = $returnCategory;
 	}

 	return $returnData;
 }
}
?>