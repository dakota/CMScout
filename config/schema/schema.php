<?php 
/* SVN FILE: $Id$ */
/* Cmscout schema generated on: 2009-12-16 19:12:18 : 1260993078*/
class CmscoutSchema extends CakeSchema {
	var $name = 'Cmscout';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'explanation' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'acos_idx1' => array('column' => array('lft', 'rght'), 'unique' => 0), 'acos_idx2' => array('column' => 'alias', 'unique' => 0), 'acos_idx3' => array('column' => array('model', 'foreign_key'), 'unique' => 0)),
		'tableParameters' => array()
	);
	var $aros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'aros_idx1' => array('column' => array('lft', 'rght'), 'unique' => 0), 'aros_idx2' => array('column' => 'alias', 'unique' => 0), 'aros_idx3' => array('column' => array('model', 'foreign_key'), 'unique' => 0)),
		'tableParameters' => array()
	);
	var $aros_acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_admin' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_reply' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_moderate' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_sticky' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_announcement' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'aroaco_idx' => array('column' => array('aro_id', 'aco_id'), 'unique' => 0)),
		'tableParameters' => array()
	);
	var $configuration = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'key' => 'unique'),
		'value' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'category_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'input_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'options' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 500),
		'label' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'order' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'auto_edit' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'plugin_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1), 'plugin_id' => array('column' => 'plugin_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $groups = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 400),
		'protected' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 1),
		'members_protected' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $groups_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'group_id' => array('column' => 'group_id', 'unique' => 0), 'user_id' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $menus = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'plugin' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'controller' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'action' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'edit_action' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'options' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'sidebox' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'menu_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'order' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $model_terms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'foreign_key' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'term_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $notifications = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'plugin_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 15),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'subject' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $notifications_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'notification_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'active' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'user_id' => array('column' => 'user_id', 'unique' => 0), 'notification_id' => array('column' => 'notification_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $plugins = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'version' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 5),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'category' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'enabled' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $terms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'vocabulary_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'rght' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $themes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'directory' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'site_theme' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'email_address' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 350),
		'active' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'last_login' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'signature' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'public_profile' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'show_name' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'show_email' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $vocabularies = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'flat' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'term_count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
}
?>