<?php
class PageEvents extends AppModelEvents
{
	function onGetTags($event)
	{
		$tags = ClassRegistry::init('PagesTag')->find('all', array('fields' => array('PagesTag.tag_id', 'count(PagesTag.tag_id) as `tagCount`'), 'group' => 'PagesTag.tag_id'));
		
		$returnData = array();
		foreach($tags as $tag)
		{
			$returnData[$tag['PagesTag']['tag_id']] = $tag[0]['tagCount'];	
		}
		
		return $returnData;
	}
	
	function onGetTagItems($event)
	{
		$tagModel = ClassRegistry::init('PagesTag');
		
		$tagModel->bindModel(array('belongsTo' => array('Page')));
		
		$tagItems = $tagModel->find('all', array('conditions' => array('PagesTag.tag_id' => $event->tagId), 'contain' => array('Page' => array('fields' => array('Page.id', 'Page.slug', 'Page.title')))));
		
		$returnData = array();
		foreach($tagItems as $tagItem)
		{
			$item = $tagItem['Page'];
			$item['controller'] = 'pages';
			$item['action'] = 'index';
			
			$returnData[] = $item;
		}
		
		return $returnData;
	}
	
	function onSearch($event)
	{
		$searchResults = ClassRegistry::init('Page')->find('all', array('fields' => array('Page.slug', 'Page.title', 'Page.text', 'Page.created', "MATCH (Page.title, Page.text, Page.tags) AGAINST ('".$event->query."' IN boolean MODE) AS score"),
 																	'conditions' =>  "MATCH(Page.title, Page.text, Page.tags) AGAINST('".$event->query."' IN boolean MODE) HAVING score >= 1",
 																	'order' => 'score DESC', 'contain' => false));
		
		
		$returnData = array();
		foreach($searchResults as $result)
		{
			$returnData[] = array('slug' => $result['Page']['slug'],
									'title' => $result['Page']['title'],
									'text' => $result['Page']['text'],
									'created' => $result['Page']['created'],
									'score' => $result[0]['score'],
									'controller' => 'pages', 
									'action' => 'index');
		}
		
		return $returnData;
	}
	
	function onGetIndex($event)
	{
		$items = ClassRegistry::init('Page')->find('all', array('contain' => false));
		
		$returnData = array();
		foreach($items as $item)
		{
			$returnData[] = array('slug' => array('type'=>'unindexed', 'value'=>$item['Page']['slug']),
									'title' => array('type'=>'indexed', 'value'=>$item['Page']['title']),
									'text' => array('type'=>'indexed', 'value'=>$item['Page']['text']),
									'tags' => array('type'=>'indexed', 'value'=>$item['Page']['tags']),
									'created' => array('type'=>'unindexed', 'value'=>$item['Page']['created']),
									'controller' => array('type'=>'unindexed', 'value'=>'pages'), 
									'action' => array('type'=>'unindexed', 'value'=>'index'),
									'AclModel' => array('type'=>'unindexed', 'value'=>'Page'),
									'AclId' => array('type'=>'unindexed', 'value' => $item['Page']['id']));	
		}
		
		return $returnData;
	}
}
?>