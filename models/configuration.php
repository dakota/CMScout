<?php 
class Configuration extends AppModel  
{  
	var $name = 'Configuration';  
	var $useTable = 'configuration';     
	var $validate =  
					array  
					(  
						'name' =>  
							array  
							(  
								'rule'      => 'notEmpty',  
								'message'   => 'FATAL: No variable name specified'  
							)  
					);
	var $belongsTo = array('Plugin');
	  
	function load()  
	{  
		if(($configuration = Cache::read('configuration', 'core')) === false)
		{
			$dbConfig = $this->find('all');
			
			@Set::apply('/Configuration/value', $dbConfig, 'unserialize');

			$configuration = Set::combine($dbConfig, '{n}.Configuration.name', '{n}.Configuration.value', '{n}.Configuration.category_name');
			
			Cache::write('configuration', $configuration, 'core');
		}
		
		Configure::write('CMScout', $configuration);
	}  
	
	function saveConfiguration($values)
	{
		$data = array();
		foreach ($values as $id => $value)
		{
			if(is_array($value))
				$value = serialize($value);
			$tempData['id'] = $id;
			$tempData['value'] = $value;
			$data[] = $tempData;
		}
		
		Cache::delete('configuration', 'core');
		return $this->saveAll($data);
	}
	
	function readConfigs()
	{
		$configData = $this->find('all', array('order' => '`order` ASC', 'contain' => array('Plugin')));
	
		$configs = array();
		foreach ($configData as $configItem)
		{
			if($configItem['Configuration']['plugin_id'] == null || $configItem['Plugin']['enabled'] == 1 )
				$configs[$configItem['Configuration']['category_name']][] = $configItem;
		}
		
		return $configs;		
	}
}  
?>