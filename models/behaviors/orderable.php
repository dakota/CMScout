<?php
class OrderableBehavior extends ModelBehavior 
{
    /**
     * Model-specific settings
     * @var array
     */
    var $__settings = array();
    
    function setup(&$Model, $settings = array()) {
    	$default = array('orderColumn' => 'order');

		if (!isset($this->__settings[$Model->alias]))
		{
			$this->__settings[$Model->alias] = $default;
		}

		$this->__settings[$Model->alias] = am($this->__settings[$Model->alias], ife(is_array($settings), $settings, array()));
    }
    
    function beforeSave(&$Model)
	{
		$return = parent::beforeSave($Model);
		
		$field = $this->__settings[$Model->alias]['orderColumn'];

		if (!$Model->hasField($field))
		{
			return $return;
		}
		
		if (!isset($Model->data[$Model->alias]['id']) && $Model->id == '')
		{
			$lastItem = $Model->find('first', array('contain' => false, 'fields' => $Model->alias . '.' . $field, 'order' => $Model->alias . '.' . $field . ' DESC'));
			$Model->data[$Model->alias][$field] = $lastItem[$Model->alias][$field] + 1;
		}
		
		return $return;
	}
	
	function moveup(&$Model, $id, $delta = 0)
	{
		if ($delta == 0)
		{
			return;
		}
		
		$field = $this->__settings[$Model->alias]['orderColumn'];

		if (!$Model->hasField($field))
		{
			return $return;
		}
		
		$moveItem = $Model->find('first', array('contain' => false, 'conditions' => array($Model->alias . '.id' => $id)));
		
		$itemsToMove = $Model->find('all', array('contain' => false, 'conditions' => array(
																				$Model->alias . '.' . $field . ' <' => $moveItem[$Model->alias][$field], 
																				$Model->alias . '.' . $field . ' >=' => $moveItem[$Model->alias][$field]-$delta,
																				$Model->alias . '.id <>' => $id)));
		
		$moveItem[$Model->alias][$field] -= $delta;
		foreach($itemsToMove as $key => $itemToMove)
		{
			$itemsToMove[$key][$Model->alias][$field] += 1;		
		} 
		$Model->save($moveItem);
		$Model->saveAll($itemsToMove);
		return;
	}
	
	function movedown(&$Model, $id, $delta = 0)
	{
		if ($delta == 0)
		{
			return;
		}
		
		$field = $this->__settings[$Model->alias]['orderColumn'];

		if (!$Model->hasField($field))
		{
			return $return;
		}
		
		$moveItem = $Model->find('first', array('contain' => false, 'conditions' => array($Model->alias . '.id' => $id)));
		
		$itemsToMove = $Model->find('all', array('contain' => false, 'conditions' => array(
																				$Model->alias . '.' . $field . ' >' => $moveItem[$Model->alias][$field], 
																				$Model->alias . '.' . $field . ' <=' => $moveItem[$Model->alias][$field]+$delta,
																				$Model->alias . '.id <>' => $id)));
		
		$moveItem[$Model->alias][$field] += $delta;
		foreach($itemsToMove as $key => $itemToMove)
		{
			$itemsToMove[$key][$Model->alias][$field] -= 1;		
		} 
		$Model->save($moveItem);
		$Model->saveAll($itemsToMove);
		return;
	}
}
?>