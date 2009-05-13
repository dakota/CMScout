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
class PagesController extends AppController
{
	var $name = 'Pages';
	var $components = array('Keywords');

	/**
	 * @var Page
	 */
	var $Page;
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

	function beforeFilter()
	{
		parent::beforeFilter();

		$this->Auth->allow('index');
	}

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

	function autoTag()
	{
		echo $this->Keywords->keywordIt($this->params['form']['text']);

		exit;
	}

	function admin_add()
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'create'))
		{
			if (!empty($this->data))
			{
				if ($this->Page->save($this->data))
				{
					$this->Session->setFlash('Page added.', '');
					$this->redirect('/admin/pages/index');
				}
			}
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/admin/pages');
		}
	}

	function admin_edit($slug, $manager = false)
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
						$this->Session->setFlash('Page updated.', '');
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
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/admin/pages');
		}
	}

	function admin_index()
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'read'))
		{
			$this->set('pages', $this->paginate('Page'));

			$this->set('permissions', $this->AclExtend->userPermissions("Page manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/');
		}
	}

	function admin_trash()
	{
		if ($this->AclExtend->userPermissions("Page manager", null, 'read'))
		{
			$this->set('pages', $this->paginate('Page', array('Page.deleted' => 1)));

			$this->set('permissions', $this->AclExtend->userPermissions("Page manager", null, '*', null, true));
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/');
		}
	}

  	function admin_homepage()
  	{
  		$this->set('pages', $this->Page->find('all', array('contain' => false)));
  	}

    function admin_delete($id)
    {
		if ($this->AclExtend->userPermissions("Page manager", null, 'delete'))
		{
    		$this->Page->delete($id, true);
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/admin/pages');
		}
    	exit;
    }

    function admin_hardDelete($id)
    {
		if ($this->AclExtend->userPermissions("Page manager", null, 'delete'))
		{
    		$this->Page->hardDelete($id, true);
		}
		else
		{
			$this->Session->setFlash('You do not have authorisation to access that page.');
			$this->redirect('/admin/pages');
		}
    	exit;
    }

    function admin_restore($id)
    {
    	$this->Page->undelete($id);
    	exit;
    }
}
?>