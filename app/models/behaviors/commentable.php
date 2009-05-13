<?php 
class CommentableBehavior extends ModelBehavior
{
	function setup(&$Model)
	{

	}

	function fetchComments(&$Model, $itemID)
	{
		App::Import('Model', 'Comment');
		
		$comment = new Comment();

		$modelName = (isset($Model->plugin)) ? $Model->plugin . '.' : '';
		$modelName .= $Model->name;
		
		return $comment->find('all', array('conditions' => array('Comment.model' => $modelName, 'Comment.foreign_id' => $itemID)));
	}
	
	function saveComment(&$Model, $commentData)
	{
		App::Import('Model', 'Comment');
		
		$comment = new Comment();

		$modelName = (isset($Model->plugin)) ? $Model->plugin . '.' : '';
		$modelName .= $Model->name;
		
		$commentData['Comment']['model'] = $modelName;
		
		return $comment->save($commentData);
	}
}
?>