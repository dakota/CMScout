<?php
class Plugin extends AppModel
{
 var $name = 'Plugin';
 var $hasMany = array('Notification', 'Sidebox', 'MenuLink', 'Contribution', 'PluginAction');
 var $actsAs = array('Acl'=>'controlled');

 	function parentNode()
	{
	    return "Plugins";
	}
	
	function enablePlugin($pluginDetails)
	{
		$this->save($pluginDetails);
		
		$file = 'schema.php';
		$path = $pluginDetails['Plugin']['pluginPath'] . DS . $pluginDetails['Plugin']['name'] . DS . 'config' . DS . 'schema' . DS;
		$plugin = Inflector::camelize($pluginDetails['Plugin']['name']);
		
		if(file_exists($path . $file))
		{
			App::import('Model', 'CakeSchema', false);
			$db = $this->getDataSource();
			
			$schema =& new CakeSchema(compact('path', 'file', 'plugin'));
			
			$schemaObject =& $schema->load();
			$existingTables = $db->listSources();

			$oldPrefix = $db->config['prefix'];
			$newPrefix = $db->config['prefix'] . $pluginDetails['Plugin']['name'] . '_';
			$sqlBits = array();
			foreach($schemaObject->tables as $table => $fields)
			{
				$db->config['prefix'] = $newPrefix; 
				$tableName = $db->fullTableName($table, false);
				
				if(in_array($tableName, $existingTables))
				{
					$db->config['prefix'] = $oldPrefix;
					$old = $schema->read(array('models' => array(Inflector::classify($table))));
					pr($old);
				}
				else
				{
					$sqlBits[] = $db->createSchema($schemaObject, $table);
				}
			}
			$db->config['prefix'] = $oldPrefix;
			
			foreach($sqlBits as $sql)
			{
				if (!$db->execute($sql)) {
					die($db->lastError());
				}
			}
			
			return true;
		}
	}

	function installPlugin($xml, $installPlugin)
	{
		$data['Plugin']['title'] = $xml['Plugin']['title'];
		$data['Plugin']['version'] = $xml['Plugin']['version'];
		$data['Plugin']['plugin_type'] = $xml['Plugin']['type'];
		$data['Plugin']['tag_models'] = $xml['Plugin']['tagModels'];
		$data['Plugin']['show_ucp'] = $xml['Plugin']['showUcp'];
		$data['Plugin']['main_model'] = $xml['Plugin']['mainModel'];
		$data['Plugin']['profile_extend'] = $xml['Plugin']['extendsProfile'];
		$data['Plugin']['directory'] = $installPlugin;

		if (isset($xml['Plugin']['Components']['Notifications']))
		{
			foreach ($xml['Plugin']['Components']['Notifications'] as $notification)
			{
				$data['Notification'][] = $notification;
			}
		}

		if (isset($xml['Plugin']['Components']['Sideboxes']))
		{
			foreach ($xml['Plugin']['Components']['Sideboxes'] as $sidebox)
			{
				$data['Sidebox'][] = $sidebox;
			}
		}

		if (isset($xml['Plugin']['Components']['Menus']))
		{
			foreach ($xml['Plugin']['Components']['Menus'] as $menu)
			{
				$data['MenuLink'][] = $menu;
			}
		}

		if (isset($xml['Plugin']['Components']['Contributions']))
		{
			foreach ($xml['Plugin']['Components']['Contributions'] as $contribution)
			{
				$data['Contribution'][] = $contribution;
			}
		}

		$this->create();
		return $this->saveAll($data);
	}
}
?>