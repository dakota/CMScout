<?php
class ModelTerm extends AppModel {
	var $name = 'ModelTerm';
	var $validate = array(
		'model' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'foreign_key' => array(
			'numeric' => array('rule' => array('numeric')),
		),
		'term_id' => array(
			'numeric' => array('rule' => array('numeric')),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Term' => array(
			'className' => 'Term',
			'foreignKey' => 'term_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>