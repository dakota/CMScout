<?php
/**
* WhoDidIt Model Behavior for CakePHP
*
* Handles created_by, modified_by fields for a given Model, if they exist in the Model DB table.
* It's similar to the created, modified automagic, but it stores the logged User id
* in the models that actsAs = array('WhoDidIt')
*
* This is useful to track who created records, and the last user that has changed them
*
* @package behaviors
* @author Daniel Vecchiato
* @version 1.2
* @date 01/03/2009
* @copyright http://www.4webby.com
* @licence MIT
* @repository https://github.com/danfreak/4cakephp/tree
**/
class WhoDidItBehavior extends ModelBehavior {
/**
* Default settings for a model that has this behavior attached.
*
* @var array
* @access protected
*/
  protected $_defaults = array(
    'auth_session' => 'Auth', //name of Auth session key
    'user_model' => 'User', //name of User model
  	'group_model' => 'Group',
  	'created_by_field' => 'created_by', //the name of the "created_by" field in DB (default 'created_by')
  	'modified_by_field' => 'modified_by', //the name of the "modified_by" field in DB (default 'modified_by'),
  	'created_by_group_field' => 'created_group_id',
  	'auto_bind' => true //automatically bind the model to the User model (default true)
  );
/**
* Initiate WhoMadeIt Behavior
*
* @param object $model
* @param array $config behavior settings you would like to override
* @return void
* @access public
*/
  function setup(&$model, $config = array()) {
    //assigne default settings
    $this->settings[$model->alias] = $this->_defaults;
    
    //merge custom config with default settings
    $this->settings[$model->alias] = array_merge($this->settings[$model->alias], (array)$config);
    
    $hasFieldCreatedBy = $model->hasField($this->settings[$model->alias]['created_by_field']);
    $hasFieldModifiedBy = $model->hasField($this->settings[$model->alias]['modified_by_field']);
    $hasFieldCreatedByGroup = $model->hasField($this->settings[$model->alias]['created_by_group_field']);
    
    $this->settings[$model->alias]['has_created_by'] = $hasFieldCreatedBy;
    $this->settings[$model->alias]['has_modified_by'] = $hasFieldModifiedBy;
    $this->settings[$model->alias]['has_greated_by_group'] = $hasFieldCreatedByGroup;
    
    //handles model binding to the User model
    //according to the auto_bind settings (default true)
    if($this->settings[$model->alias]['auto_bind'])
    {
     if ($hasFieldCreatedBy) {
          $commonBelongsTo = array(
            'CreatedBy' => array('className' => $this->settings[$model->alias]['user_model'],
                      'foreignKey' => $this->settings[$model->alias]['created_by_field'])
                      );
          $model->bindModel(array('belongsTo' => $commonBelongsTo), false);
        }
 
        if ($hasFieldModifiedBy) {
          $commonBelongsTo = array(
            'ModifiedBy' => array('className' => $this->settings[$model->alias]['user_model'],
                      'foreignKey' => $this->settings[$model->alias]['modified_by_field']));
          $model->bindModel(array('belongsTo' => $commonBelongsTo), false);
        }
    }
  }
/**
* Before save callback
*
* @param object $model Model using this behavior
* @return boolean True if the operation should continue, false if it should abort
* @access public
*/
  function beforeSave(&$model) {
    if ($this->settings[$model->alias]['has_created_by'] || $this->settings[$model->alias]['has_modified_by'] || $this->settings[$model->alias]['has_greated_by_group']) {
      $AuthSession = $this->settings[$model->alias]['auth_session'];
      $UserSession = $this->settings[$model->alias]['user_model'];
      $userId = Set::extract($_SESSION, $AuthSession.'.'.$UserSession.'.'.'id');
      if ($userId) {
        $data = array($this->settings[$model->alias]['modified_by_field'] => $userId);
        if (!$model->exists()) {
          $data[$this->settings[$model->alias]['created_by_field']] = $userId;
	        if($this->settings[$model->alias]['has_greated_by_group']) {
	        	$group = ClassRegistry::init($this->settings[$model->alias]['user_model'])->find('first', array('conditions' => array($this->settings[$model->alias]['user_model'] . '.id' => $userId), 'contain' => array('Group')));
	        	$data[$this->settings[$model->alias]['created_by_group_field']] = $group[$this->settings[$model->alias]['group_model']]['id'];
	        }
        }
        $model->set($data);
      }
    }
    return true;
  }
}
?>