<?php
class Notification extends AppModel {
	var $name = 'Notification';
	var $validate = array(
		'name' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'type' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'title' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'subject' => array(
			'notempty' => array('rule' => array('notempty')),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Plugin' => array(
			'className' => 'Plugin',
			'foreignKey' => 'plugin_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>