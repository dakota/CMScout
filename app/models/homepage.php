<?php
class Homepage extends AppModel 
{
 var $name = 'Homepage';
 var $belongsTo = array('MenuLink' => array('conditions' => 'MenuLink.frontpage = 1'));
 var $helpers = array('Cache');
 
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