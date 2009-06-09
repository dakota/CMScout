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
class ThemesController extends AppController
{
	/**
	 * Name property
	 * @var string
	 */
	public $name = "Themes";
	
	/**
	 * Loads installed themes.
	 * @return void
	 */
	public function admin_index()
	{
		$this->set('themes', $this->Theme->find('all'));
	}
	
	/**
	 * Shows list of non-installed themes, and installs them.
	 * TODO: Needs to be refactored into more actions, and code needs to be moved into the model.
	 * 
	 * @return void
	 */
	public function admin_install()
	{
		if (empty($this->data))
		{
			$notInstalled = array();
			
			$dh = opendir(WWW_ROOT . 'themed/');
			
			if (!$dh) 
				die('Unable to open directory');
				
			App::import('Xml'); 
			
			while (($resource = readdir($dh)) !== false) 
			{
				if (file_exists(WWW_ROOT . 'themed' . DS . $resource . DS . 'settings.xml'))
				{
					$fileName = WWW_ROOT . 'themed' . DS . $resource . DS . 'settings.xml';
					$xml = new Xml ($fileName);
					$xml = Set::reverse($xml);
					
					if ($this->Theme->find('count', array('conditions' => array('unique_id' => $xml['Theme']['uniqueId']))) == 0)
					{
						$notInstalled[$resource] = $xml['Theme']['title'];
					}			
				}
			}
			
			$this->set('notInstalledThemes', $notInstalled);
		}
		else
		{
			if ($this->data['Theme']['install_type'] == 0)
			{
				
			}
			else
			{
				$installTheme = $this->data['Theme']['themes'][0];

				App::import('Xml'); 
				
				$fileName = WWW_ROOT . 'themed/' . $installTheme . '/settings.xml';
				$xml = new Xml ($fileName);
				$xml = Set::reverse($xml);
				
				if ($this->Theme->installTheme($xml))
				{
					$this->Session->setFlash('Theme installed', null);
					$this->redirect('/admin/themes');
				}
			}
		}
	}
	
	/**
	 * Changes a theme into the site theme.
	 * 
	 * @param integer $id New site theme
	 * @return void
	 */
	public function admin_siteTheme($id = null)
	{
		$this->Theme->updateAll(array('site_theme' => '0'));
		
		$this->Theme->save(array('Theme' => array('id' => $id, 'site_theme' => '1')));
		
		$this->Session->setFlash('Theme changed', null);
		$this->redirect('/admin/themes');
	}
}
?>