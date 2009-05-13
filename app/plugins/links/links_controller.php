  <?php
 class LinksController extends AppController 
 {
 	var $name = 'Links';
 	 /**
 	 * @var Link
 	 */
 	var $Link;
 	 /**
 	 * @var SessionComponent
 	 */
 	var $Session;
 	
 	function index()
 	{
 		$this->set("linkList", $this->Link->findAll());
 	}
 	
  	function admin_index()
 	{
 		$this->set("linkList", $this->Link->findAll());
 	}
 	
 	function open($slug)
 	{
 		$linkToShow = $this->Link->find('first', array('conditions' => array("Link.slug" => $slug)));

		$this->set("linkToShow", $linkToShow);
		$this->set("redirect", true);
 	}
 	
    function admin_add()
    {
        if (!empty($this->data))
        {
        	$this->data['Link']['url'] = strpos($this->data['Link']['url'], "http://") ? $this->data['Link']['url'] : "http://".$this->data['Link']['url'];
        	
        	$this->Link->save($this->data);
            $this->Session->setFlash('Link added.', '');
            $this->redirect('/admin/pages/manager#links');
        }
    }
    
    function admin_delete($id)
    {
    	$this->Link->delete($id);
    	exit;
    }
    
    function admin_edit($id = false)
    {
 		$this->Link->id = $id;
 		if (empty($this->data))
 		{
 			$this->data = $this->Link->Read();
 		}
 		else
 		{
            $this->Link->save($this->data);
            $this->Session->setFlash('Link updated.', '');
            $this->redirect('/links/index/true');
        }
    }
    
   	function admin_homepage()
  	{
  	}
 }
 ?>