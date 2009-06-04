<?php
class Homepage extends AppModel 
{
 var $name = 'Homepage';
 var $belongsTo = array('MenuLink' => array('conditions' => 'MenuLink.frontpage = 1'));
 var $helpers = array('Cache');
 
 function getHomepage()
 {
 	$items = $this->find('all', array('order' => 'Homepage.`order` ASC AND Homepage.column ASC', 'contain' => array('MenuLink' => array('Plugin'))));
	$homepage = array();
	
	foreach ($items as $item)
	{							
		$modelName = ((isset($item['MenuLink']['Plugin']['directory'])) ? Inflector::camelize($item['MenuLink']['Plugin']['directory']) . '.' : '') . Inflector::classify($item['MenuLink']['controller']);
		
		if ($modelName != '')
		{			
			$item['Data'] = ClassRegistry::init($modelName)->getHomepage($item);
		}
		
		$homepage[$item['Homepage']['order']][$item['Homepage']['column']] = $item;
	}

	return $homepage;
 }
 
 function saveHomepage($data)
 {
 	$this->query('truncate table homepages;');
	
	foreach($data['items'] as $number => $column)
	{
		$order = 0;
		foreach ($column as $item)
		{
			
			$temp['order'] = ++$order;
			$temp['name'] = $item['name'];
			$temp['menu_link_id'] = $item['menu_link_id'];
			$temp['options'] = $item['options'] == 'null' ? '' : $item['options'];
			$temp['column'] = $number;
			
			$this->data[] = $temp;
		}
	}

	return $this->saveAll($this->data);
 }
}
?>