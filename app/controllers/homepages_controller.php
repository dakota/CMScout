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
class HomepagesController extends AppController
{
	/**
	 * Name property
	 * @var String
	 */
	public $name = "Homepages";
	
	/**
	 * beforeFilter callback
	 * @see app/AppController#beforeFilter()
	 */
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow('index');
	}

	/**
	 * Loads homepage items.
	 * 
	 * @return Void
	 */
	public function index()
	{
		$items = $this->Homepage->find('all', array('order' => 'Homepage.`order` ASC AND Homepage.column ASC', 'contain' => array('MenuLink' => array('Plugin'))));
	 	
		$homepage = array();
		
		foreach ($items as $item)
		{
			$model = Inflector::classify($item['MenuLink']['controller']);
					
			$modelName = ((isset($item['MenuLink']['Plugin']['directory'])) ? Inflector::camelize($item['MenuLink']['Plugin']['directory']) . '.' : '') . $model;
			
			if ($modelName != '')
			{
				if (is_numeric($item['Homepage']['options']))
				{
					if ($this->AclExtend->userPermissions(array('model' => $model, 'foreign_key' => $item['Homepage']['options']), null, 'read'))
					{
						$item['Data'] = ClassRegistry::init($modelName)->getHomepage($item);
					}
				}
				else
				{
					$item['Data'] = ClassRegistry::init($modelName)->getHomepage($item);
				}
			}
			if (isset($item['Data']))
				$homepage[$item['Homepage']['order']][$item['Homepage']['column']] = $item;
		}
		
		$this->set(compact('homepage'));
	}
	
	/**
	 * Administration of homepage items
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		if ($this->AclExtend->userPermissions('Homepage manager', null, 'read'))
		{
			$this->set('firstColumn', $this->Homepage->find('all', array('conditions' => array('column' => 0), 'contains' => array('MenuLink' => array('Plugin')))));
			$this->set('secondColumn', $this->Homepage->find('all', array('conditions' => array('column' => 1), 'contains' => array('MenuLink' => array('Plugin')))));
			
			$this->set('links', $this->Homepage->MenuLink->find('all', array('conditions' => array('frontpage' => 1), 'contains' => 'Plugin')));
			
			$this->set('permissions', $this->AclExtend->userPermissions("Homepage manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/');
		}
	}
	
	public function admin_homepage()
	{
	}
	
	/**
	 * Saves homepage changes
	 * 
	 * @return Void
	 */
	public function admin_save()
	{	
		if ($this->AclExtend->userPermissions("Homepage manager", null, 'update'))
		{
			$this->Homepage->saveHomepage($this->params['form']);
		}
		
		exit;
	}
}

?>