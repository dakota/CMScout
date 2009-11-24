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
		if (($settings = Cache::read('settings', 'core')) === false)
		{
			$settings = $this->find('all');
			Cache::write('settings', $settings, 'core');
		}  
		 
		foreach ($settings as $variable)  
		{ 
			$unserialized = @unserialize($variable['Configuration']['value']);
			
			if($unserialized !== false)
				$variable['Configuration']['value'] = $unserialized;
				
			Configure::write('CMScout.'.$variable['Configuration']['category_name'].'.'.$variable['Configuration']['name'],	$variable['Configuration']['value']);  
		}  
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
		
		Cache::delete('settings', 'core');
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