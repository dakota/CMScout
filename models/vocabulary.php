<?php
class Vocabulary extends AppModel {
	var $name = 'Vocabulary';
	var $validate = array(
		'slug' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'title' => array(
			'notempty' => array('rule' => array('notempty')),
		),
		'multiple' => array(
			'boolean' => array('rule' => array('boolean')),
		),
		'flat' => array(
			'boolean' => array('rule' => array('boolean')),
		),
		'textbox' => array(
			'boolean' => array('rule' => array('boolean')),
		),
		'term_count' => array(
			'numeric' => array('rule' => array('numeric')),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
}
?>