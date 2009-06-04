<?php
	class appModel extends model
	{
		var $actsAs = array('Containable');
		
		function toggleField($field, $id=null) 
		{
			if(empty($id)) 
			{
				$id = $this->id;
			}
			
			$field = $this->escapeField($field);
			
			return $this->updateAll(array($field => '1 -' . $field),
										array($this->escapeField() => $id)
									);
		}
		
		function doesIdExist($id)
		{
			return !$this->isUnique(array($this->alias . '.id' => $id));
		}
		
		function findById($id)
		{
			return $this->find('first', array('conditions' => array($this->alias . '.id' => $id), 'contain' => false));
		}
	}
?>