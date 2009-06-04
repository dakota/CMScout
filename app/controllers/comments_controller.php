<?php
class CommentsController extends AppController
{
	var $name = "Comments";
	
	function post()
	{
		$this->data['Comment']['user_id'] = $this->Auth->user('id');
		$this->Comment->save($this->data);
		
		if ($this->RequestHandler->isAjax())
		{
			
		}
		else
		{
			$this->Session->setFlash('Thank you for your comment', null);
			$this->redirect($this->data['Comment']['currentPage']);
		}
	}
}
?>