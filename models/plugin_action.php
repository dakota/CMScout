<?php
	class PluginAction extends AppModel
	{
		var $name = "PluginAction";
		var $belongsTo = "Plugin";
		
		function fetchLinks($category)
		{
			$actions = $this->find('all', array('conditions' => array('PluginAction.action_type' => $category), 'contain' => 'Plugin'));
			
			$links = array();
			foreach($actions as $action)
			{
				$url = array('plugin' => $action['Plugin']['directory'], 
							'controller' => $action['PluginAction']['controller'] , 
							'action' => $action['PluginAction']['action'], 
							'admin' => $action['PluginAction']['admin']);
				$links[$action['PluginAction']['link_label']] = $url;
			}
			
			return $links;
		}	
	}
?>