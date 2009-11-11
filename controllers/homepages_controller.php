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
	var $uses = array();
	
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

	}
}

?>