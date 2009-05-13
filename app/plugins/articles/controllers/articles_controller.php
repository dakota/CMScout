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
class ArticlesController extends ArticlesAppController
{
	var $name = 'Articles';
	var $components = array('RequestHandler');
	
	/**
	 * @var Article
	 */
	var $Article;
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
	
	function index($slug = null)
	{
		if ($slug == null)
		{
			$this->set('articles', $this->Article->find('all'));
		}
		else
		{
			$article = $this->Article->find('first', array('conditions' => array("Article.slug" => $slug)));
			$this->set('article', $article);
			$this->set('comments' , $this->Article->fetchComments($article['Article']['id']));
			$this->render('view');
		}
	}
	
	function contributeIndex($contributionId)
	{
		$this->Article->enablePublishable('find', false);
		$this->set('articles', $this->Article->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')))));
		$this->set('permissions', $this->AclExtend->userPermissions('Contribution', $contributionId, '*', null, true));
	}
	
	function owned()
	{
		
	}
	
	function add()
	{
		if (!empty($this->data))
		{
			$this->data['Article']['user_id'] = $this->Auth->user('id');
			$this->Article->save($this->data);
			$this->Session->setFlash('Article added.', '');
			$this->redirect('/users/index#contributions');
		}
		else
		{
			$this->data['Article']['author'] = $this->Auth->user('username');
		}
	}
	
	function edit($slugId)
	{
		if (!empty($this->data))
		{
			$this->Article->id = $slugId;
			$this->data['Article']['id'] = $slugId;
			$this->Article->save($this->data);
			$this->Session->setFlash('Article saved.', '');
			$this->redirect('/users/index#contributions');
		}
		else
		{
			$this->data = $this->Article->find('first', array('conditions' => array('slug' => $slugId)));
		}
	}
	
	function delete($id)
	{
		$this->Article->del($id,true);
		exit;
	}
	
	function admin_add()
	{
		$this->set('useEditor', true);
		
		if (!empty($this->data))
		{
			$this->data['Article']['user_id'] = $this->Auth->user('id');
			$this->Article->save($this->data);
			$this->Session->setFlash('Article added.', '');
			$this->redirect('/admin/pages/manager#articles');
		}
	}
	
  	function admin_homepage()
  	{
  		$this->set('articles', $this->Article->find('all', array('contain' => false)));
  	}
  	
  	function admin_index()
  	{
  		$this->set('articles', $this->Article->find('all', array('contain' => false)));
  	}
  	
    function admin_delete($id)
    {
    	$this->Article->delete($id, true);
    	exit;
    }
}
?>