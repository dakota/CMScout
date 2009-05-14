<?php
function __compareCreated($a, $b)
{
	$a = strtotime($a['lastPost']['created']);
	$b = strtotime($b['lastPost']['created']);

	if ($a == $b)
		return 0;

	return ($a > $b) ? 1 : -1 ;
}

function __compareNumber($a, $b)
{
	$a = $a['number_posts'];
	$b = $b['number_posts'];

	if ($a == $b)
		return 0;

	return ($a > $b) ? 1 : -1 ;
}

class ForumThread extends ForumsAppModel
{
 var $name = 'ForumThread';
 var $belongsTo = array('ForumForum' => array('className' => 'Forums.ForumForum'), 'User' => array('fields' => array("id", "username")));
 var $hasMany = array('ForumPost' => array (
 							'className' => 'Forums.ForumPost',
 							'dependent' => true
 						),
 						'ForumUnreadPost' => array (
 							'className' => 'Forums.ForumUnreadPost',
 							'dependent' => true
 						),
 						'ForumSubscriber' => array (
 							'className' => 'Forums.ForumSubscriber',
 							'dependent' => true
 						));
 var $actsAs = array('Sluggable');


	function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array())
	{
		if (is_array($order) && in_array(key($order), array('number_posts', 'lastPost')))
		{
			$useOrder['field'] = key($order);
			$useOrder['direction'] = $order[$useOrder['field']];
			$order = array();
		}
		elseif (!is_array($order))
		{
			$useOrder['field'] = 'lastPost';
			$useOrder['direction'] = 'desc';
			$order = array();
		}
		else
		{
			$useOrder = '';
		}
		$returnData = array();

		$this->recursive = -1;

		$threads = $this->find('all', compact('conditions', 'fields', 'limit', 'page', 'group', 'order') + $extra);

		foreach($threads as $thread)
		{
			$returnThread = array();

			$returnThread['title'] = $thread['ForumThread']['title'];
			$returnThread['slug'] = $thread['ForumThread']['slug'];
			$returnThread['description'] = $thread['ForumThread']['description'];
			$returnThread['views'] = $thread['ForumThread']['views'];
			$returnThread['number_posts'] = $this->ForumPost->find('count', array('contain' => false, 'conditions' => array('ForumPost.forum_thread_id' => $thread['ForumThread']['id'])));
			$returnThread['userPost'] = $thread['User'];
			$returnThread['lastPost'] = $thread['ForumPost'][0];
			$returnThread['unreadPost'] = isset($thread['ForumUnreadPost'][0]['forum_thread_id']) ? 1 : 0;

			$returnData[] = $returnThread;
		}

		if (isset($useOrder['field']) && $useOrder['field'] == 'lastPost')
			usort($returnData, '__compareCreated');
		elseif (isset($useOrder['field']) && $useOrder['field'] == 'number_posts')
			usort($returnData, '__compareNumber');

		if (isset($useOrder['direction']) && $useOrder['direction'] == 'desc')
			$returnData = array_reverse($returnData);

		return $returnData;
	}

	function fetchBreadcrumbs($slug)
	{
		$returnData = array();

		$this->recursive = -1;
		$thread = $this->findBySlug($slug);

		$parentForum = $this->ForumForum->findById($thread['ForumThread']['forum_forum_id']);

		$returnData[0]['title'] = $parentForum['ForumCategory']['title'];
		$returnData[0]['slug'] = $parentForum['ForumCategory']['slug'];
		$i = 1;
		if ($parentForum['ParentForum']['id'] != '')
		{
			if ($parentForum['ParentForum']['parent_id'] != 0)
			{
				$extraParents = $this->ForumForum->findParents($parentForum['ParentForum'], $i);
				$i += count($extraParents);
				$returnData = $returnData + $extraParents;
			}

			$returnData[$i]['title'] = $parentForum['ParentForum']['title'];
			$returnData[$i++]['slug'] = $parentForum['ParentForum']['slug'];
		}
		$returnData[$i]['title'] = $parentForum['ForumForum']['title'];
		$returnData[$i]['slug'] = $parentForum['ForumForum']['slug'];

		ksort($returnData);

		return $returnData;
	}
}
?>