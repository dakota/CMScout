<?php
	class appModel extends model
	{
		var $actsAs = array('Containable', 'Eventful.Event');
		
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
		
		function findById($id, $contain = false)
		{
			return $this->find('first', array('conditions' => array($this->alias . '.id' => $id), 'contain' => $contain));
		}
		
		function findBySlug($slug, $contain = false)
		{
			return $this->find('first', array('conditions' => array($this->alias . '.slug' => $slug), 'contain' => $contain));
		}
	}
?>