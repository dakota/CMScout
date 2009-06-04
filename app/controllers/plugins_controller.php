<?php
/**
 * Controller to manage static content pages.
 *
 * PHP versions 4 and 5
 *
 * CMScout <http://www.cmscout.co.za/>
 * Copyright 2005-2008
 *
 * Licensed under GPL
 *
 * @filesource
 * @copyright		Copyright 2005-2008, CMScout.
 * @link			http://www.cmscout.co.za/
 * @package			cmscout3
 * @subpackage		cmscout3.core
 * @since			CMScout3 v 0.0.1
 * @version			$Revision: 1 $
 * @modifiedby		$LastChangedBy: walther $
 * @lastmodified	$Date: 2008-11-22 10:54:00 -0200 (Sat, 22 Nov 2008) $
 * @license			GPL
 */
class PluginsController extends AppController
{
	var $name = 'Plugins';

	/**
	 * @var Plugin
	 */
	var $Plugin;
	/**
	 * @var SessionComponent
	 */
	var $Session;
	/**
	 * @var AclComponent
	 */
	var $Acl;
	/**
	 * @var AuthComponent
	 */
	var $Auth;

	function admin_index()
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

	function admin_install()
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