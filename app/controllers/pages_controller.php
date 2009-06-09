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
class PagesController extends AppController
{
	/**
	 * Name property
	 * 
	 * @var String
	 */
	public $name = 'Pages';
	/**
	 * Components array
	 * 
	 * @var array
	 */
	public $components = array('Keywords');

	/**
	 * beforeFilter callback
	 * @see app/AppController#beforeFilter()
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();

		$this->Auth->allow('index');
	}

	/**
	 * Fetches page defined by $slug. If no slug is defined, then a list of pages is fetched.
	 * 
	 * @param string $slug
	 * @return void
	 */
	function index($slug = null)
	{
		if (isset($slug) && $slug != null)
		{
			$pageToShow = $this->Page->find('first', array('conditions' => array("Page.slug" => $slug), 'contain' => array('Tag')));

			if ($this->AclExtend->userPermissions('Page', $pageToShow['Page']['id'], 'read'))
			{
				$this->set(compact("pageToShow"));
				$this->pageTitle = $pageToShow['Page']['title'];

				$this->render('view');
			}
			else
			{
				if (!$this->Auth->user())
				{
					$this->redirect($this->Auth->loginAction);
				}
			}
		}
		else
		{

		}
	}

	/**
	 * Automagically calculates tags for the page.
	 * 
	 * @return String
	 */
	public function autoTag()
	{
		echo $this->Keywords->keywordIt($this->params['form']['text']);

		exit;
	}

	/**
	 * Adds a new page.
	 * 
	 * @return void
	 */
	public function admin_add()
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'create'))
		{
			if (!empty($this->data))
			{
				if ($this->Page->save($this->data))
				{
					$this->Session->setFlash('Page added.', null);
					$this->redirect('/admin/pages/index');
				}
			}
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/admin/pages');
		}
	}

	/**
	 * Edits an existing page.
	 * 
	 * @param string $slug
	 * @param boolean $manager Used to determine location that the edit was initiated from (Page manger, or the page itself)
	 * @return void
	 */
	public function admin_edit($slug, $manager = false)
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'update'))
		{
			$page = $this->Page->find('first', array('conditions' => array("Page.slug" => $slug)));

			if (empty($this->data))
			{
				$this->data = $page;
				$this->pageTitle = $this->data['Page']['title'];
				$this->set('useEditor', true);
				$this->set('manager', $manager);
			}
			else
			{
				if ($this->Page->save($this->data))
				{
					if ($manager)
					{
						$this->Session->setFlash('Page updated.', null);
						$this->redirect('/admin/pages/index');
					}
					else
					{
						$update = $this->Page->Read();
						$this->redirect('/pages/' . $update['Page']['slug']);
					}
				}
			}
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/admin/pages');
		}
	}

	/**
	 * Page manager
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'read'))
		{
			$this->set('pages', $this->paginate('Page'));

			$this->set('permissions', $this->AclExtend->userPermissions("Page manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/');
		}
	}

	/**
	 * Shows pages that are in the trash area.
	 * 
	 * @return void
	 */
	public function admin_trash()
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'read'))
		{
			$this->set('pages', $this->paginate('Page', array('Page.deleted' => 1)));

			$this->set('permissions', $this->AclExtend->userPermissions("Page manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/');
		}
	}

	/**
	 * Loads list of pages for homepage and menu managers.
	 * @return void
	 */
  	public function admin_homepage()
  	{
  		$this->set('pages', $this->Page->find('list', array('contain' => false, 'order' => 'title ASC')));
  	}

  	/**
  	 * Deletes a page
  	 * @param integer $id
  	 * @return void
  	 */
    public function admin_delete($id)
    {
		if ($this->AclExtend->userPermissions("Page manager", null, 'delete'))
		{
    		$this->Page->delete($id, true);
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/admin/pages');
		}
    	exit;
    }

    /**
     * Permentally deletes a page.
     * 
     * @param integer $id
     * @return void
     */
    function admin_hardDelete($id)
    {
		if ($this->AclExtend->userPermissions("Page manager", null, 'delete'))
		{
    		$this->Page->hardDelete($id, true);
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.', null);
			$this->redirect('/admin/pages');
		}
    	exit;
    }

    /**
     * Restores a page from the trash area.
     * 
     * @param integer $id
     * @return void
     */
    function admin_restore($id)
    {
    	$this->Page->undelete($id);
    	exit;
    }
}
?>