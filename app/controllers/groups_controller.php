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
 class GroupsController extends AppController 
 {
 	/**
 	 * Name property
 	 * 
 	 * @var String
 	 */
 	public $name = 'Groups';
  	
 	/**
 	 * Adds a new group into the database.
 	 * 
 	 * @return Void
 	 */
 	public function admin_newGroup()
 	{	
 		if ($this->AclExtend->userPermissions("Administration Panel/Groups", 'create'))
 		{
	 		$this->data['Group']['title'] = $this->params['form']['name'];
	 		$this->Group->create();
	 		$this->Group->save($this->data);
	 		echo $this->Group->id;
 		}
 		exit;
 	}

 	/**
 	 * Renames an existing group.
 	 * 
 	 * @return Void
 	 */
 	public function admin_renameGroup()
 	{	
 		if ($this->AclExtend->userPermissions("Administration Panel/Groups", 'update'))
 		{ 		
	 		$this->Group->id = $this->params['form']['id'];
	 		$this->data['Group']['title'] = $this->params['form']['name'];
	 		$this->Group->save($this->data);
 		}
 		exit;
 	}
 	
 	/**
 	 * Deletes an existing group.
 	 *  
 	 * @return Void
 	 */
  	public function admin_deleteGroup()
 	{	
 		if ($this->AclExtend->userPermissions("Administration Panel/Groups", 'delete'))
 		{ 	
	 		$this->Group->id = $this->params['form']['id'];
	 		$this->Group->delete();
 		}
 		exit;
 	}
 	
 	/**
 	 * Loads information relating to an existing group.
 	 * 
 	 * @param integer $groupId
 	 * @return void
 	 */
   	public function admin_loadInformation($groupId)
  	{
  		$this->data = $this->Group->find('first', array('conditions' => array('id'=>$groupId), 'contains'=> false));	
  	}
 }
 ?>