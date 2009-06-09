<?php
class Tag extends AppModel
{
	var $name = 'Tag';
	var $actsAs = array("Sluggable" => array('label' => 'tag'));
	var $order = array('Tag.tag ASC');

	function getTagedItems($slug)
	{
		$tag = $this->findBySlug($slug);
		
		$eventReturns = $this->dispatchEvent('getTagItems', array('tagId' => $tag['Tag']['id']));

		$tagItems = array();
		
		foreach($eventReturns as $eventReturn)
		{
			$tagItems = am($tagItems, $eventReturn['returns']);
		}

		return $tagItems;
	}

	function getTagCloud()
	{
		if(($tagCounts = Cache::read('tag_cloud_data', 'core')) === false)
		{
			$tagList = $this->dispatchEvent('getTags');
			
			$tagCounts = array();
			
			foreach($tagList as $tagItems)
			{
				foreach($tagItems['returns'] as $tagId => $tagCount)
				{
					if(isset($tagCounts[$tagId]))
					{
						$tagCounts[$tagId]['count'] += $tagCount;
					}
					else
					{
						$tagCounts[$tagId]['count'] = $tagCount;
						$tag = $this->findById($tagId);
						$tagCounts[$tagId]['tag'] = $tag['Tag']['tag'];
						$tagCounts[$tagId]['slug'] = $tag['Tag']['slug'];
					}
				}
			}
			
			Cache::write('tag_cloud_data', $tagCounts, 'core');
		}
		
		return $tagCounts;
	}

	function getHomepage($itemOptions)
	{
		if ($itemOptions['Homepage']['options'] == '')
		{

			return $this->getTags();
		}
		else
		{
			return $this->getTagCloud();
		}
	}

	function getMenu()
	{
		return $this->getTagCloud();
	}
}
?>