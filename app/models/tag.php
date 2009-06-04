<?php
class Tag extends AppModel
{
	var $name = 'Tag';
	var $hasAndBelongsToMany = array("Page" => array('fields' => array('id')));
	var $actsAs = array("Sluggable" => array('label' => 'tag'));
	var $order = array('Tag.tag ASC');

	function getTagedItems($slug)
	{
		$plugins = ClassRegistry::init('Plugin')->find('all', array('conditions' => array('Plugin.tag_models <>' => ''), 'contain' => false));

		$tagModels = array();

		foreach ($plugins as $plugin)
		{
			$models = explode(',', $plugin['Plugin']['tag_models']);
			$pluginName = Inflector::camelize($plugin['Plugin']['directory']);

			foreach ($models as $model)
			{
				$tagModels[$model]['plugin'] = $plugin['Plugin']['directory'];
				$tagModels[$model]['name'] = $plugin['Plugin']['title'];

				$this->bindModel(
			        array('hasAndBelongsToMany' => array(
			                $model => array(
			                    'className' => $pluginName . '.' . $model,
			                	'fields' => array('id', 'slug', 'title')
			                )
			            )
			        )
			    );
			}
		}

		$tag = $this->find('first', array('conditions' => array('Tag.slug' => $slug)));
		$formatedTags = array();

		$tagItems = array();

		foreach ($tag as $model => $data)
		{
			if ($model != 'Tag' && count($data))
			{
				foreach ($data as $dataItem)
				{
					$tagItem['model'] = $model;
					if (isset($tagModels[$model]))
						$tagItem['plugin'] = $tagModels[$model];

					$tagItem['data'] = $dataItem;

					$tagItems[] = $tagItem;
				}
			}
		}

		return $tagItems;
	}

	function getTagCloud($countLimit = 0)
	{
		$plugins = ClassRegistry::init('Plugin')->find('all', array('conditions' => array('Plugin.tag_models <>' => ''), 'contain' => false));

		$tagModels = array();

		foreach ($plugins as $plugin)
		{
			$models = explode(',', $plugin['Plugin']['tag_models']);
			$pluginName = Inflector::camelize($plugin['Plugin']['directory']);

			foreach ($models as $model)
			{
				$tagModels[$model]['plugin'] = $plugin['Plugin']['directory'];
				$tagModels[$model]['name'] = $plugin['Plugin']['title'];

				$this->bindModel(
			        array('hasAndBelongsToMany' => array(
			                $model => array(
			                    'className' => $pluginName . '.' . $model,
			                	'fields' => array($model . '.id')
			                )
			            )
			        )
			    );
			}
		}
		
		$tags = $this->find('all');

		$tagCounts = array();

		foreach ($tags as $tag)
		{
			$tagItem = array();
			$tagItem['count'] = 0;
			$tagItem['tag'] = $tag['Tag']['tag'];
			$tagItem['slug'] = $tag['Tag']['slug'];

			foreach ($tag as $model => $data)
			{
				if ($model != 'Tag' && count($data))
				{
					foreach ($data as $dataItem)
					{
						$tagItem['count']++;
					}
				}
			}

			if ($tagItem['count'] > $countLimit)
			{
				$tagCounts[] = $tagItem;
			}
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
			return $this->getTagCloud(0);
		}
	}

	function getMenu()
	{
		return $this->getTagCloud(1);
	}
}
?>