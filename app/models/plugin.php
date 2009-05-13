<?php
class Plugin extends AppModel
{
 var $name = 'Plugin';
 var $hasMany = array('Notification', 'Sidebox', 'MenuLink', 'Contribution');
 var $actsAs = array('Acl'=>'controlled');

 	function parentNode()
	{
	    return "Plugins";
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