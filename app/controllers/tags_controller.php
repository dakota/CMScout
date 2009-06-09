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
class TagsController extends AppController
{
	/**
	 * Name property
	 * @var string
	 */
	public $name = "Tags";

	/**
	 * Shows list of tags, or items that are taged with a tag defined by $slug.
	 * TODO: Split into two actions.
	 * 
	 * @param string $slug
	 * @return void
	 */
	public function index($slug = null)
	{
		if ($slug == null)
		{
			$this->set('tags', $this->Tag->find('all'));
		}
		else
		{
			$this->set('tags', $this->Tag->getTagedItems($slug));
			$this->set('thisTag', $this->Tag->findBySlug($slug));
			$this->render('view');
		}
	}

	function admin_homepage()
	{

	}
}
?>