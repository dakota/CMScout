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

	/**
	 * Shows list of installed plugins
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		if ($this->AclExtend->userPermissions("Plugin manager", null, 'read'))
		{
			$this->set('plugins', $this->Plugin->find('all'));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/');
		}
	}

	/**
	 * Shows list of non-installed plugins, and installs them.
	 * TODO: Needs to be refactored into more actions, and code needs to be moved into the model.
	 * 
	 * @return void
	 */
	public function admin_install()
	{
			if (empty($this->data))
		{
			$notInstalled = array();

			$pluginDir = ROOT . DS . APP_DIR . DS . 'plugins' . DS;

			$dh = opendir($pluginDir);

			if (!$dh)
				die('Unable to open directory');

			App::import('Xml');

			while (($resource = readdir($dh)) !== false)
			{
				if (file_exists($pluginDir . $resource . DS . 'settings.xml'))
				{
					$fileName = $pluginDir . $resource . DS . 'settings.xml';
					$xml = new Xml ($fileName);
					$xml = Set::reverse($xml);

					if ($this->Plugin->find('count', array('conditions' => array('directory' => $resource))) == 0)
					{
						$notInstalled[$resource] = $xml['Plugin']['title'] . ' (Version: ' . $xml['Plugin']['version'] . ')';
					}
				}
			}

			$this->set('notInstalledPlugins', $notInstalled);
		}
		else
		{
			if ($this->data['Plugin']['install_type'] == 0)
			{

			}
			else
			{
				$installPlugin = $this->data['Plugin']['plugin'][0];

				App::import('Xml');

				$pluginDir = ROOT . DS . APP_DIR . DS . 'plugins' . DS;
				$fileName = $pluginDir . $installPlugin . DS . 'settings.xml';
				$xml = new Xml ($fileName);
				$xml = Set::reverse($xml);

				if ($this->Plugin->installPlugin($xml, $installPlugin))
				{
					if (isset($xml['Plugin']['Configuration']))
					{
						$config = array();

						foreach ($xml['Plugin']['Configuration'] as $name => $configurationItem)
						{
							$configurationItem['name'] = $name;
							$configurationItem['category_name'] = $xml['Plugin']['title'];
							$config[]['Configuration'] = $configurationItem;
						}

						ClassRegistry::init('Configuration')->saveAll($config);
					}

					if (isset($xml['Plugin']['Acl']))
					{
						$aco = new Aco();

						$aco->save(array('Aco' => array('model' => 'Plugin', 'foreign_key' => $this->Plugin->id, 'alias' => $xml['Plugin']['title'], 'explanation' => $xml['Plugin']['Acl']['explanation'])));
					}

					if (isset($xml['Plugin']['Tables']))
					{
						foreach ($xml['Plugin']['Tables']['Table'] as $table)
						{
							$tableSQL = "CREATE TABLE IF NOT EXISTS `". $table['name'] . "` ( ";
							foreach ($table['Columns']['Column'] as $column)
							{
								$tableSQL .= "`" . $column['name'] . "` " . $column['type'] . " " . $column['extra'] . ',';
							}
							$tableSQL .= "PRIMARY KEY (`" . $table['primary_key'] . "`)";
							$tableSQL .= ");";

							$this->Plugin->query($tableSQL);
						}
					}

					$this->Session->setFlash('Plugin installed', null);
					$this->redirect('/admin/plugins');
				}
			}
		}
	}
}
?>