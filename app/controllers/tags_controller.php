<?php
class TagsController extends AppController
{
	var $name = "Tags";

	/**
	 *
	 * @var Tag
	 */
	var $Tag;

	function index($slug = null)
	{
		if ($slug == null)
		{
			$this->set('tags', $this->Tag->find('all'));
		}
		else
		{
			$this->set('tags', $this->Tag->getTagedItems($slug));
			$this->render('view');
		}
	}

	function admin_homepage()
	{

	}
}
?>