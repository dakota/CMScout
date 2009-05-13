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
class PhotosController extends PhotosAppController
{
	var $name = 'Photos';
	var $uses = array("Photos.Album", "Photos.Photo");
	var $components = array('RequestHandler', 'Upload');
	var $helpers = array("Image");
 		
	/**
	 * @var Album
	 */
	var $Album;
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
	/**
	 * @var UploadComponent
	 */
	var $Upload;
	
	function beforeFilter()
	{
		if ($this->action == 'upload') {
            $this->Session->id($this->params['pass'][0]);
            $this->Session->start();
        }
        
        parent::beforeFilter();
		
	}
	
	function index($slug = null)
	{
		if ($slug == null)
		{
			$this->set('albums', $this->Album->find('all', array('contain' => false)));
		}
		else
		{
			$album = $this->Album->find('first', array('conditions' => array("Album.slug" => $slug)));
			$this->set('album', $album);
			$this->set('comments', $this->Album->fetchComments($album['Album']['id']));
			$this->render('view');
		}
	}
	
	function albums($index=null,$slug = null)
	{
		$this->redirect(array('controller' => 'photos', 'plugin' => 'photos', 'action' => 'index', 0 => $slug));
	}
	
	function contributeIndex($contributionId)
	{
		$this->Album->enablePublishable('find', false);
		$this->set('albums', $this->Album->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')))));
		$this->set('permissions', $this->AclExtend->userPermissions('Contribution', $contributionId, '*', null, true));
	}	
	
	function owned()
	{
		
	}
	
	function add()
	{		
		if (!empty($this->data))
		{
			$this->data['Album']['user_id'] = $this->Auth->user('id');
			$this->Album->save($this->data);
			$this->Session->setFlash('Album added.');
			$album = $this->Album->find('first', array('contain' => false));
			$this->redirect('/photos/view/' . $album['Album']['slug']);
			exit;
		}
	}
	
	function admin_add()
	{		
		if (!empty($this->data))
		{
			$this->data['Album']['user_id'] = $this->Auth->user('id');
			$this->Album->save($this->data);
			$this->Session->setFlash('Album added.', '');
			$this->redirect('/admin/pages/manager#albums');
		}
	}
	
	function editPhoto($id)
	{
		$this->Photo->id = $id;
		if (empty($this->data))
		{
			$this->data = $this->Photo->read();
		}
		else
		{
			if ($this->Photo->save($this->data))
			{
				if (!$this->RequestHandler->isAjax())
				{
					$this->Session->setFlash('Photo updated.', '');
					$this->redirect('/photos/' . $update['Page']['name']);
				}
				else
				{
					exit;
				}
			}
		}
	}
	
	function photoBlock($id)
	{
		$this->Photo->id = $id;
		$this->data = $this->Photo->read();
	}
		
	function upload()
	{
		$destination = realpath('../webroot/photos/');

		$file = $this->params['form']['Filedata'];

		// upload the image using the upload component
		$result = $this->Upload->upload($file, $destination, null, array('type' => 'resize', 'size' => '800', 'output' => 'jpg'));

		if (!$result){
			$this->data['Photo']['filename'] = $this->Upload->result;
			$this->data['Photo']['photos_album_id'] = $this->params['pass'][1];
			$this->data['Photo']['"caption"'] = $this->params['form']['caption'];
		} else {
			// display error
			$errors = $this->Upload->errors;

			// piece together errors
			if(is_array($errors)){ $errors = implode("<br />",$errors); }

			print_r($errors);
			exit();
		}
		if ($this->Photo->save($this->data)) {
	
		} else {
			unlink($destination.$this->Upload->result);
		}	
		
		exit;
	}
	
	function thumbnails($slug)
	{
		$this->set('album', $this->Album->find('first', array('conditions' => array("Album.slug" => $slug))));
		$this->layout = 'ajax';
	}
	
  	function admin_homepage()
  	{
  		$this->set('albums', $this->Album->find('all', array('contain' => false)));
  	}
  	
  	function admin_index()
  	{
  		$this->set('albums', $this->Album->find('all', array('contain' => false)));
  	}
  	
    function admin_delete($id)
    {
    	$this->Album->delete($id, true);
    	exit;
    }
}
?>