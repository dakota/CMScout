<?php 
class CommentableBehavior extends ModelBehavior
{
	function setup(&$Model)
	{

	}

	function fetchComments(&$Model, $itemID)
	{
		$modelName = (isset($Model->plugin)) ? $Model->plugin . '.' : '';
		$modelName .= $Model->name;
		
		return ClassRegistry::init('Comment')->find('all', array('conditions' => array('Comment.model' => $modelName, 'Comment.foreign_id' => $itemID)));
	}
	
	function saveComment(&$Model, $commentData)
	{
		$modelName = (isset($Model->plugin)) ? $Model->plugin . '.' : '';
		$modelName .= $Model->name;
		
		$commentData['Comment']['model'] = $modelName;
		
		return ClassRegistry::init('Comment')->save($commentData);
	}
}
?>