<?php
/**
 * This file is part of CMScout.
 *  
 * CMScout is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *  
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with CMScout.  If not, see <http://www.gnu.org/licenses/>.
 *    
 * @filesource
 * @copyright		Copyright 2009, CMScout.
 * @link			http://www.cmscout.co.za/
 * @package			cmscout3
 * @subpackage		cmscout3.core
 * @since			CMScout3 v 1.0.0
 * @license			GPLv3 
 *  
 */
class PluginsController extends AppController
{
	/**
	 * Name property
	 * 
	 * @var string
	 */
	public $name = 'Plugins';
	
 	public	$actionMap = array(
 		'admin_index' => 'read',
 		'admin_install' => 'create'
 	);
 	
 	public $adminNode = 'Plugin Manager';
 	
	/**
	 * Shows list of installed plugins
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		$availablePlugins = array();
		
		$pluginsPaths = App::path('plugins');
		
		App::import('Xml');
		
		foreach($pluginsPaths as $pluginsPath)
		{
			$Folder =& new Folder($pluginsPath);
			$folderList = $Folder->read(true,true,true);
			
			foreach($folderList[0] as $folder)
			{
				$folderParts = explode(DS, $folder);
				$pluginInfo = $this->__readPluginInfo(end($folderParts));
				
				if($pluginInfo !== false)
					$availablePlugins[] = $pluginInfo;
			}
		}
		
		Set::sort($availablePlugins, '{n}.Plugin.title', 'asc');
		
		$categories = Set::extract($availablePlugins, '{n}.Plugin.category');
		sort($categories);
		$categories = Set::normalize($categories);

		foreach($availablePlugins as $availablePlugin)
		{
			$category = $availablePlugin['Plugin']['category'];
			if(!is_array($categories[$category]))
				$categories[$category] = array();
				
			$categories[$category][] = $availablePlugin;
		}
		
		$this->set(compact('categories'));
	}

	public function admin_install()
	{
		foreach($this->data['Plugin'] as $pluginName => $enabled)
		{
			list($pluginFolder, $pluginId) = explode(':', $pluginName);

			$plugin = $this->__readPluginInfo($pluginFolder);
			
			$plugin['Plugin']['enabled'] = $enabled;
			
			if($plugin['Plugin']['enabled'] == 1)
			{
				$this->Plugin->enablePlugin($plugin);
				$this->enabledPlugins =  $this->CmscoutCore->loadEnabledPlugins(true);
				$this->Event->refreshEventHandlers();
				$this->Event->trigger($plugin['Plugin']['name'] . '.install', array('installInfo' => $plugin));
			}
			elseif($plugin['Plugin']['enabled'] == 0 && isset($plugin['Plugin']['database']))
			{
				$this->Plugin->disablePlugin($plugin);
			}
		}
	
		$this->AclExtend->reorder();
		$this->redirect(array('action' => 'index'));
	}
	
	private function __readPluginInfo($pluginName)
	{
		$pluginsPaths = App::path('plugins');
			
		App::import('Xml');		
		
		foreach($pluginsPaths as $pluginsPath)
		{			
			$fileName = $pluginsPath . Inflector::underscore($pluginName) . DS . 'settings.xml';
			
			if(file_exists($fileName))
			{
				$xml = new Xml ($fileName);
				$xml = Set::reverse($xml);
				$xml['Plugin']['name'] =  Inflector::camelize($pluginName);
				$xml['Plugin']['pluginPath'] = $pluginsPath;
				
				$pluginDatabase = $this->Plugin->findById($xml['Plugin']['id']);
				
				if($pluginDatabase !== false)
					$xml['Plugin']['database'] = $pluginDatabase['Plugin'];
				
				break;
			}
			else
			{
				$xml = false;
			}
		}
		
		return $xml;
	}
}
?>