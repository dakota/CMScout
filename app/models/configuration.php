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
								'rule'      => VALID_NOT_EMPTY,  
								'message'   => 'FATAL: No variable name specified'  
							)  
					);  
	  
	function load()  
	{  
		$settings = $this->find('all');  
		  
		foreach ($settings as $variable)  
		{  
			Configure::write('CMScout.'.$variable['Configuration']['category_name'].'.'.$variable['Configuration']['name'],	$variable['Configuration']['value']);  
		}  
	}  
	
	function saveConfiguration($values)
	{
		$data = array();
		foreach ($values as $id => $value)
		{
			$tempData['id'] = $id;
			$tempData['value'] = $value;
			$data[] = $tempData;
		}
		
		return $this->saveAll($data);
	}
	
	function readConfigs()
	{
		$configData = $this->find('all', array('order' => '`order` ASC'));
		
		$configs = array();
		foreach ($configData as $configItem)
		{
			$configs[$configItem['Configuration']['category_name']][] = $configItem;			
		}
		
		return $configs;		
	}
}  
?>