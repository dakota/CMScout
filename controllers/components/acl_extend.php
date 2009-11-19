<?php
App::import('Component', 'Acl');

class AclExtendComponent extends AclComponent
{
	var $user;

 	function _loadAcoBranch($children)
 	{
  		$leaves = array();

  		foreach($children as $child)
 		{
 			if ($child['Aco']['foreign_key'])
 			{
	 			$leaf = array();
	 			$leaf['attributes']['id'] = $child['Aco']['id'];

	 			$model = ClassRegistry::init($child['Aco']['model']);
	 			$itemData = $model->find('first', array('conditions'=> array($model->alias.'.id' => $child['Aco']['foreign_key']), 'contain' => false));

	 			if (isset($itemData))
	 			{
		 			$leaf['data'] = isset($itemData[$model->alias]['title']) ? $itemData[$model->alias]['title'] : $itemData[$model->alias]['slug'];

		 			if ($leaf['data'] != 'null' && $leaf['data'] != '')
		 			{
			 			$leaf['state'] = '';
			 			$leaf['metadata']['type'] = "'ChildACO'";
			 			$leaf['icons'] = Router::url('/img/file.png');

			 		 	if (isset($child['children'][0]))
			 			{
			 				$leaf['children'] = $this->_loadAcoBranch($child['children']);
			 				$leaf['state'] = 'closed';
 							$leaf['metadata']['type'] = "'ParentACO'";
			 				unset($leaf['icons']);
			 			}

			 			$leaves[] = $leaf;
		 			}
	 			}
 			}
 			else
 			{
	 			$leaf = array();
	 			$leaf['attributes']['id'] = $child['Aco']['id'];

	 			$leaf['data'] = $child['Aco']['alias'];
	 			if ($leaf['data'] != 'null' && $leaf['data'] != '')
	 			{
		 			$leaf['state'] = '';
		 			$leaf['metadata']['type'] = "'ChildACO'";
		 			$leaf['icons'] = Router::url('/img/file.png');

	 				if (isset($child['children'][0]))
			 		{
			 			$leaf['children'] = $this->_loadAcoBranch($child['children']);
			 			$leaf['state'] = 'closed';
 						$leaf['metadata']['type'] = "'ParentACO'";
 						unset($leaf['icons']);
			 		}

		 			$leaves[] = $leaf;
	 			}
 			}
 		}
 		return $leaves;
 	}

	function AcoTree()
	{
		 $aco = new Aco();

 		$items = array();

 		$acos = $aco->find('threaded', array('contain' => false));

 		$items['children'] = $this->_loadAcoBranch($acos);

 		return $items;
	}

 	function AroTree()
 	{
 		$user = ClassRegistry::init('User');

		$itemsToLoad = $user->Group->find('all', array('order' => 'Group.title ASC', 'contain' => array('User' => array('order' => 'User.username ASC'))));

 		$items = array();

 		$items['children'] = array();

 		foreach ($itemsToLoad as $item)
 		{
 			$tempItem = array();

 			$tempItem['attributes']['id'] = 'group_' . $item['Group']['id'];
 			$tempItem['data'] = $item['Group']['title'];
 			$tempItem['state'] = $item['Group']['title'] == 'Guests' ? '' : 'closed';
 			$tempItem['metadata']['type'] = "'group'";
 			$tempItem['metadata']['copy'] = "true";
 			if ($item['Group']['title'] == 'Guests')
 			{
 				$tempItem['icons'] = Router::url('/img/file.png');
 				$tempItem['metadata']['deletable'] = "false";
 				$tempItem['metadata']['valid_children'] = "[]";
 			}

 			if ($item['Group']['protected'])
 			{
 				$tempItem['metadata']['deletable'] = "false";
 				$tempItem['metadata']['membersDeletable'] = "true";
 				$tempItem['metadata']['renamable'] = "false";
 			}
 			if ($item['Group']['members_protected'])
 			{
 				$tempItem['metadata']['deletable'] = "false";
 				$tempItem['metadata']['valid_children'] = "[]";
 			}

 			$children = array();

 			foreach ($item['User'] as $user)
 			{
 				$child = array();
 				$child['attributes']['id'] = 'group_' . $item['Group']['id'] . '_user_' . $user['id'];
 				$child['data'] = $user['username'];
 				$child['icons'] = Router::url('/img/file.png');
 				$child['metadata']['type'] = "'user'";
 				$child['metadata']['dragable'] = "true";
 				if ($item['Group']['protected'] && !$item['Group']['members_protected'])
 				{
 					$child['metadata']['deletable'] = "true";
 				}
 				else if ($item['Group']['members_protected'])
 				{
 					$child['metadata']['deletable'] = "false";
 				}

 				$child['active'] = $user['active'];

 				$children[] = $child;
  			}
  			$tempItem['children'] = $children;
 			$items['children'][] = $tempItem;
 		}

 		$tempItem = array();
 		$tempItem['attributes']['id'] = 'guest';
 		$tempItem['data'] = "Guest";
 		$tempItem['state'] = '';
 		$tempItem['metadata']['type'] = "'group'";
		$tempItem['icons'] = Router::url('/img/file.png');
		$tempItem['metadata']['deletable'] = "false";
		$tempItem['metadata']['valid_children'] = "[]";
 		$items['children'][] = $tempItem;

 		return $items;
  	}

  	function updatePermissions($data)
  	{
  		 	$aco_id = $data['aco'];
	 		$aro_id = explode('_', $data['aro']);

	 		unset ($data['aco']);
	 		unset ($data['aro']);

	 	 	if (isset($aro_id[3]))
	 		{
	 			$aroCondition = array('model'=>'User', 'foreign_key' => $aro_id[3]);
	 			$mode = 'user';
	 		}
	 		elseif (isset($aro_id[1]))
	 		{
	 			$aroCondition = array('model'=>'Group', 'foreign_key' => $aro_id[1]);
	 			$mode = 'group';
	 		}
	 		else
	 		{
	 			$aroCondition = "Guest";
	 			$mode = 'group';
	 		}

	 		$aco = new Aco();
	 	 	$currentAco = $aco->find('first', array('conditions' => array('Aco.id' => $aco_id)));

	 	 	if ($currentAco['Aco']['parent_id'] && $currentAco['Aco']['foreign_key'] != 'NULL' && !empty($currentAco['Aco']['foreign_key']) && !empty($currentAco['Aco']['model']))
	 		{
	 			$acoCondition = array('model' => $currentAco['Aco']['model'], 'foreign_key' => $currentAco['Aco']['foreign_key']);
	 			$acoMode = 'child';
	 		}
	 		elseif($currentAco['Aco']['parent_id'] == 'NULL')
	 		{
	 			$acoCondition = $currentAco['Aco']['alias'];
	 			$acoMode = 'parent';
	 		}
	 		else
	 		{
	 			$acoCondition = $currentAco['Aco']['alias'];
	 			$acoMode = 'child';
	  		}

	 		foreach($data as $key => $value)
	 		{
 				switch ($value)
 				{
 					case 0  :  if ($mode == 'user' || $acoMode == 'child') $this->inherit($aroCondition, $acoCondition, $key); else $this->Acl->deny($aroCondition, $acoCondition, $key);
 							   break;
 					case 1  :  $this->allow($aroCondition, $acoCondition, $key);
 							   break;
 					case -1 :  $this->deny($aroCondition, $acoCondition, $key);
 							   break;
 				}
	 		}
  	}
  	
  	function __rawPermissions($model, $foreign_key = null, $action = '*', $aroNodeOverride = null, $returnAll = false)
  	{	
  		$aro = new Aro();
		if ($aroNodeOverride == null)
		{
			$aroNode = $aro->find('first', array('conditions' => $this->user, 'contain' => false));
		}
		elseif (is_array($aroNodeOverride))
		{
			$aroNode = $aroNodeOverride;
		}
		else
		{
			$user = array('Aro.model' => "User", "Aro.foreign_key" => $aroNodeOverride);
			$aroNode = $aro->find('first', array('conditions' => $user, 'contain' => false));
		}
		$nodePermissions = $this->acoPermissions($aroNode, $model, $foreign_key);
		if ($aroNode['Aro']['model'] == "User")
		{
	 		$user = ClassRegistry::init("User");
			$userInfo = $user->find('first', array('conditions' => array('User.id'=>$aroNode['Aro']['foreign_key']), 'fields' => array('id'), 'contain' => array('Group')));
	 		foreach ($userInfo['Group'] as $group)
	 		{
	 			$aroGroupNode = $aro->find('first', array('conditions' => array('Aro.model'=>'Group', 'Aro.foreign_key' => $group['id']), 'contain' => false));
	 			$currentGroupPermissions = $this->acoPermissions($aroGroupNode, $model, $foreign_key);
	 			if (isset($currentGroupPermissions) && $currentGroupPermissions != 0)
	 			{
		 			foreach($currentGroupPermissions as $key => $value)
		 			{
		 				if (isset($groupPermissions[$key]))
		 				{
		 					$groupPermissions[$key] = $groupPermissions[$key] == 1 || $value == 1 ? 1 : 0;
		 				}
		 				else
		 				{
		 					$groupPermissions[$key] = $value == 1 ? 1 : 0;
		 				}
		 			}
	 			}
	 		}
	 		if (isset($nodePermissions) && $nodePermissions != 0)
	  		{
	 			foreach($nodePermissions as $column => $value)
	 			{
 					$permissions[$column] = $value;
    				if ($value == 1)
 					{
 						$permissions[$column] = 1;
 					}
 					elseif($value == 0)
 					{
 						$permissions[$column] = $groupPermissions[$column];
 					}
 					elseif($value == -1)
 					{
 						$permissions[$column] = 0;
 					}
	 			}
	  		}
	  		elseif (isset($groupPermissions))
	  		{
	  			$permissions = $groupPermissions;
	  		}
	  		else
	  		{
	  			$permissions = 0;
	  		}
		}
		else
		{
			$permissions = $nodePermissions;
		}

		return $returnAll == false ? ($action == '*' ? max($permissions) : (isset($permissions[$action]) && $permissions[$action] == 1 ? 1 : 0)) : $permissions;
  	}

  	function loadPermissions($data)
  	{
  		$aco_id = $data['aco'];
  		
  		if(isset($data['aro']))
  		{
 			$aro_id = explode('_', $data['aro']);
  		}
   		else
  		{
  			$aro_id[3] = $this->user['foreign_key'];
  		}

 		$aco = new Aco();
 		$aro = new Aro();
 		$join = ClassRegistry::init("ArosAco");

 	 	if (isset($aro_id[3]))
 		{
 			$aroCondition = array('Aro.model'=>'User', 'Aro.foreign_key' => $aro_id[3]);
 			$mode = 'User';
 		}
 	 	elseif (isset($aro_id[1]))
 		{
 			$aroCondition = array('Aro.model'=>'Group', 'Aro.foreign_key' => $aro_id[1]);
 			$mode = 'Group';
 		}
 		else
 		{
 			$aroCondition =  array('Aro.alias'=>'Guest');
 			$mode = 'Group';
 		}

 		$columns = $join->getColumnTypes();
 		$permissionColumns = array();
		foreach($columns as $columnName => $columnType)
		{
			if (strpos($columnName, '_') === 0)
	 		{
	 			$column = ltrim($columnName, '_');
	 			$permissionColumns[] = $column;
	 		}
		} 		
		
 		$aroNode = $aro->find('first', array('conditions' => $aroCondition, 'contain' => false));

 		$nodePermissions = $join->find('first', array('conditions' => array('ArosAco.aco_id' => $aco_id, 'ArosAco.aro_id' => $aroNode['Aro']['id'])));

 		$permissions = array();

 		$currentAco = $aco->find('first', array('conditions' => array('Aco.id' => $aco_id)));

		if ($currentAco['Aco']['parent_id'] && $currentAco['Aco']['explanation'] == '')
 		{
 			$acoInfo = $aco->find('first', array('conditions' => array('Aco.id' => $currentAco['Aco']['parent_id']), 'contain' => false));
 			$acoMode = 'child';
 		}
 		else
 		{
 			$acoInfo = $currentAco;
 			$acoMode = 'parent';
 		}

 		if ($mode == 'Group')
 		{
  			if (isset($nodePermissions['ArosAco']))
  			{
	 			foreach($permissionColumns as $column)
	 			{
 					$value = $acoMode == 'parent' ? ($nodePermissions['ArosAco']['_' . $column] <= 0 ? 0 : 1) : $nodePermissions['ArosAco']['_' . $column];
 					$permissions[$column] = $value;
 					$actualPermission[$column] = $this->__rawPermissions(($currentAco['Aco']['model'] == null ? $currentAco['Aco']['alias'] : $currentAco['Aco']['model']), $currentAco['Aco']['foreign_key'], $column, $aroNode);
	 			}
  			}
 		  	else
  			{
  				$permissions = 0;
	 			$actualPermission = $this->__rawPermissions(($currentAco['Aco']['model'] == null ? $currentAco['Aco']['alias'] : $currentAco['Aco']['model']), $currentAco['Aco']['foreign_key'], '*', $aroNode, true);
  			}
 		}
 		elseif ($mode == 'User')
 		{
  			if (isset($nodePermissions['ArosAco']))
  			{
	 			foreach($permissionColumns as $column)
	 			{
 					$permissions[$column] = $nodePermissions['ArosAco']['_' . $column];
 					$actualPermission[$column] = $this->__rawPermissions(($currentAco['Aco']['model'] == null ? $currentAco['Aco']['alias'] : $currentAco['Aco']['model']), $currentAco['Aco']['foreign_key'], $column, $aroNode);
	 			}
  			}
  			else
  			{
  				$permissions = 0;
	 			$actualPermission = $this->__rawPermissions(($currentAco['Aco']['model'] == null ? $currentAco['Aco']['alias'] : $currentAco['Aco']['model']), $currentAco['Aco']['foreign_key'], '*', $aroNode, true);
  			}
 		}

 		$details = explode(',', $acoInfo['Aco']['explanation']);		
		
 		$permissionDetails = array();
 		foreach ($details as $key => $detail)
 		{
 			if(strpos($detail, '|') !== false)
 			{
 				$detail = explode('|', $detail);	
 				$permissionDetails[strtolower($detail[0])] = isset($detail[1]) && $detail[1] != '' ? $detail[1] : 0;
 			}
 			else
 			{
 				$permissionDetails[$permissionColumns[$key]] = isset($detail) && $detail != '' ? $detail : 0;
 			}
 		}

 		$returnVar['permissions'] = $permissions;
 		$returnVar['actualPermissions'] = $actualPermission;
 		$returnVar['details'] = $permissionDetails;
 		$returnVar['AROmode'] = $mode;
 		$returnVar['ACOmode'] = $acoMode;

 		return $returnVar;
  	}

 	function acoPermissions($aroNode, $acoModel, $acoForeign_key = null)
 	{
 		$acoConditions = $acoForeign_key == null ? array("Aco.alias" => $acoModel) : array('Aco.model' => $acoModel, "Aco.foreign_key" => $acoForeign_key) ;

 		$aco = new Aco();
 		$join = ClassRegistry::init("ArosAco");

		$acoNode = $aco->find('first', array('conditions' => $acoConditions, 'contain' => array('Aro' => array('conditions' => array('Aro.id' => $aroNode['Aro']['id'])))));
		
		$nodeDatabase = isset($acoNode['Aro'][0]['Permission']) ? $acoNode['Aro'][0]['Permission'] : array();;
		
		if (count($nodeDatabase))
  		{
	 		foreach($nodeDatabase as $column => $value)
	 		{
	 			if (strpos($column, '_') === 0)
	 			{
	 					$nodePermissions[ltrim($column, '_')] = $value;
	 			}
	 		}
  		}
		if ($acoNode['Aco']['parent_id'] && $acoNode['Aco']['explanation'] == '')
		{
			$parentNodePermissions = $join->find('first', array('conditions' => array('ArosAco.aco_id' => $acoNode['Aco']['parent_id'], 'ArosAco.aro_id' => $aroNode['Aro']['id'])));

  			if (isset($parentNodePermissions['ArosAco']))
  			{
	 			foreach($parentNodePermissions['ArosAco'] as $column => $value)
	 			{
	 				if (strpos($column, '_') === 0)
	 				{
	 						$parentPermissions[ltrim($column, '_')] = $value;
	 				}
	 			}
   			}
		}

		if(isset($parentPermissions))
		{
			if(isset($nodePermissions))
			{
				foreach($parentPermissions as $key => $value)
				{
					switch ($nodePermissions[$key])
					{
						case 0	: $permissions[$key] = $parentPermissions[$key];
									break;
						case 1	: $permissions[$key] = 1;
									break;
						case -1	: $permissions[$key] = -1;
									break;
					}
				}
			}
			else
			{
				$permissions = $parentPermissions;
			}
		}
		else if (isset($nodePermissions))
		{
			$permissions = $nodePermissions;
		}
		else
		{
			$permissions = 0;
		}

  		return $permissions;
 	}

/**
 * Checks if the current user has $permissions for $model/$foreign_key. If an alias is desired place alias into $model, and $foreign_key = null
 *
 * @param string $model Model or Alias to check permissions for
 * @param integer $foreign_key Foreign_key for model check (defaults to null)
 * @param string $action Permission (defaults to *)
 * @return boolean Success (true if user has access to action in ACO, false otherwise)
 * @access public
 */
	function userPermissions($acoNode, $action = '*', $userOverride = null)
	{
		if(is_string($acoNode))
		{
			if(strpos($acoNode, ':'))
			{
				$node = explode(':', $acoNode);
				$acoNode = array('model' => $node[0], "foreign_key" => $node[1]);
			}
		}
		
		if ($userOverride == null)
		{
			if(!empty($this->user))
			{
				$aroNode = $this->user;
			}
			else
			{
				$aroNode = array('alias' => 'Guest');
			}
		}
		elseif (is_array($userOverride))
		{
			$aroNode = $userOverride;
		}
		else
		{
			$aroNode = array('model' => "User", "foreign_key" => $userOverride);
		}		

		if (isset($aroNode['model']) && $aroNode['model'] == 'User')
		{
			$user = ClassRegistry::init("User");
			$userInfo = $user->find('first', array('conditions' => array('User.id'=>$aroNode['foreign_key']), 'fields' => array('id'), 'contain' => array('Group')));
			
			$permission = $this->check($aroNode, $acoNode, $action);
	
			foreach ($userInfo['Group'] as $group)
		 	{
				$permission = $permission || $this->check(array('model' => 'Group', 'foreign_key' => $group['id']), $acoNode, $action);
		 	}
		}
		elseif (isset($aroNode['model']) && $aroNode['model'] == 'Group')
		{
			$permission = $this->check($aroNode, $acoNode, $action);
		}
		else
		{
			$permission = $this->check($aroNode['alias'], $acoNode, $action);
		}

	 	return $permission;
	}

	function setUser($userId)
	{
		$userId = $userId == null ? 0 : $userId;
		$this->user = $userId != 0 ? array('model' => "User", "foreign_key" => $userId) : array('alias' => "Guest");
	}
	
	function AcoInfo($acoCondition)
	{
		$aco = new Aco();
		$acoNode = $aco->find('first', array('contain' => false, 'conditions' => $acoCondition));
		$aco->Behaviors->detach('Tree');
		$aco->Behaviors->attach('Tree', array('recursive' => 1));
		$nodes = $aco->getpath($acoNode['Aco']['id']);
		
		if (count($nodes) == 0)
		{
			return false;
		}
		$items = array();
		$addedItems = array();
		$explanation = $nodes[0]['Aco']['explanation'];
		$number = 0;
		foreach($nodes as $nodeKey => $node)
		{
			foreach ($node['Aro'] as $aroKey => $aro)
			{
				$model = ClassRegistry::init($aro['model']);
				if ($aro['model'] == 'User')
				{
					$fields = array('id', 'username');
				}
				else
				{
					$fields = array('id', 'title');
				}
				
				$info = $model->find('first', array('fields' => $fields, 'contain' => false, 'conditions' => array('id' => $aro['foreign_key'])));
				
				$nodes[$nodeKey]['Aro'][$aroKey][$aro['model']] = $info[$aro['model']];
				
				$itemName = $aro['model'] . '_' . $info[$aro['model']]['id'];
				$nodeInfo['explanation'] = $explanation;
				$nodeInfo['info'] = $info[$aro['model']];
				$nodeInfo['Aro'] = $aro;
				unset($nodeInfo['Aro']['Permission']);
				
				if(!isset($addedItems[$itemName]))
				{
					$items[$number] = $nodeInfo;
					$addedItems[$itemName] = $number++;
				}
			}
		}
	
		foreach($items as $key =>$item)
		{
			$permissions = $this->__rawPermissions($acoCondition['Aco.model'], $acoCondition['Aco.foreign_key'], '*', $item, true);
			$items[$key]['permissions'] = $permissions;	
		}
		
		return $items;
	}
	
	function permissionArray($model, $foreign_key)
	{
		return $this->__rawPermissions($model, $foreign_key, '*', null, true);
	}

	public function addAcoNode($nodePath, $explain)
	{
		$aco = new Aco();

		$existingNode = $aco->node($nodePath);

		if($existingNode === false)
		{
			$nodePathArray = explode('/', $nodePath);

			$newNode['alias'] = end($nodePathArray);
			unset($nodePathArray[key($nodePathArray)]);
			$newNode['explanation'] = $explain;

			if(count($nodePathArray) >= 1 )
			{
				$parentNodePath = implode('/', $nodePathArray);
				$parentNode = $aco->node($parentNodePath);

				if($parentNode === false)
				{
					$parentNode = $this->addAcoNode($nodePath, $xplain);
				}

				$newNode['parent_id'] = $parentNode[0]['Aco']['id'];
			}

			$aco->create();
			$aco->save($newNode);

			$existingNode = $aco->node($nodePath);
		}
		else
		{
			$existingNode[0]['Aco']['explanation'] = $explain;

			$aco->save($existingNode[0]['Aco']);
		}

		$this->__createAuthFields($explain);

		return $existingNode;
	}

	private function __createAuthFields($explain)
	{
		App::import('Model', 'CakeSchema', false);
		$Schema =& new CakeSchema();
		$db =& ConnectionManager::getDataSource($Schema->connection);
		
		$currentArosAcoSchema = $Schema->read(array('models' => array('ArosAco')));

		unset($currentArosAcoSchema['tables']['acos']);
		unset($currentArosAcoSchema['tables']['aros']);
		unset($currentArosAcoSchema['tables']['missing']);

		$explains = explode(',', $explain);

		$newArosAcoSchema = $currentArosAcoSchema;
		foreach($explains as $explain)
		{
			$explain = explode('|', $explain);
			if(count($explain) > 1)
			{
				$columnName = '_' . Inflector::underscore($explain[0]);

				if(!isset($currentArosAcoSchema['tables']['aros_acos'][$columnName]))
				{
					$newArosAcoSchema['tables']['aros_acos'][$columnName] = array(
						'type' => 'string',
						'null' => '',
						'default' => '0',
						'length' => 2
					);
				}
			}
		}

		$compare = $Schema->compare($currentArosAcoSchema, $newArosAcoSchema);
		$sql = $db->alterSchema($compare, 'aros_acos');

		if ($sql != '' && !$db->execute($sql))
		{
			die($db->lastError());
		}
	}

	public function reorder()
	{
		$Aco = new Aco();
		$Aro = new Aro();

		$Aco->reorder(array('field' => 'Aco.alias'));
		$Aro->reorder(array('field' => 'Aro.alias'));
	}
}
?>