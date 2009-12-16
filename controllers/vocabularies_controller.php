<?php
class VocabulariesController extends AppController 
{	
	public	$actionMap = array(
  		'admin_index' => 'read',
		'admin_add' => 'read'
 	);
 	
 	public $adminNode = 'Taxonomy';
 	 
	public function admin_index()
	{
		$this->set('vocabularies', $this->paginate());
	}
	
	public function admin_add()
	{
		if(!empty($this->data))
		{
			if($this->Vocabulary->save($this->data))
			{
				$this->Session->setFlash('New vocabulary added');
				$this->redirect(array('action' => 'index'));
			}
		}	
	}
}
?>