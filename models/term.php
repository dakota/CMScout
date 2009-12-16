<?php
class Term extends AppModel {
	var $name = 'Term';
	var $validate = array(
		'parent_id' => array(
			'numeric' => array('rule' => array('numeric')),
		),
		'vocabulary_id' => array(
			'numeric' => array('rule' => array('numeric')),
		),
		'slug' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'title' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'status' => array(
			'boolean' => array('rule' => array('boolean')),
		),
		'lft' => array(
			'numeric' => array('rule' => array('numeric')),
		),
		'rght' => array(
			'numeric' => array('rule' => array('numeric')),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ParentTerm' => array(
			'className' => 'Term',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vocabulary' => array(
			'className' => 'Vocabulary',
			'foreignKey' => 'vocabulary_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>