<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.scripts
 * @since			CakePHP(tm) v 0.10.0.1232
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
uses ('controller'.DS.'components'.DS.'acl', 'model'.DS.'db_acl');
/**
 * @package		cake
 * @subpackage	cake.cake.scripts
 */
class AclScript extends CakeScript {
/**
 * Enter description here...
 *
 * @var unknown_type
 */
	var $acl;
/**
 * Enter description here...
 *
 * @var unknown_type
 */
	var $args;
/**
 * Enter description here...
 *
 * @var unknown_type
 */
	var $dataSource = 'default';
/**
 * override intialize of the CakeScript
 *
 */
	function initialize () {		
	}
/**
 * Main method called from dispatch
 *
 */
	function main () {
		$this->dataSource = 'default';

		if (isset($this->params['datasource'])) {
			$this->dataSource = $this->params['datasource'];
		}

		if (ACL_CLASSNAME != 'DB_ACL') {
			$out = "--------------------------------------------------\n";
			$out .= "Error: Your current Cake configuration is set to \n";
			$out .= "an ACL implementation other than DB. Please change \n";
			$out .= "your core config to reflect your decision to use \n";
			$out .= "DB_ACL before attempting to use this script.\n";
			$out .= "--------------------------------------------------\n";
			$out .= "Current ACL Classname: " . ACL_CLASSNAME . "\n";
			$out .= "--------------------------------------------------\n";
			$this->err($out);
			exit();
		}
		
		$command = null;
		if(isset($this->args[0])) {
			$command = $this->args[0];	
		}
		if($command && !in_array($command, array('help'))) {
			if(!file_exists(CONFIGS.'database.php')) {
				$this->out('');
				$this->out('Your database configuration was not found.');
				$this->out('Take a moment to create one:');
				$this->doDbConfig();
			}
			require_once (CONFIGS.'database.php');

			if(!in_array($command, array('initdb'))) {
				$this->Acl = new AclComponent();
				$this->db =& ConnectionManager::getDataSource($this->dataSource);
			}
		}
		
		switch ($command) {
			case 'create':
				$this->create();
			break;
			case 'delete':
				$this->delete();
			break;
			case 'setParent':
				$this->setParent();
			break;
			case 'getPath':
				$this->getPath();
			break;
			case 'grant':
				$this->grant();
			break;
			case 'deny':
				$this->deny();
			break;
			case 'inherit':
				$this->inherit();
			break;
			case 'view':
				$this->view();
			break;
			case 'initdb':
				$this->initdb();
			break;
			case 'upgrade':
				$this->upgradedb();
			break;
			case 'help':
				$this->help();
			break;
			default:
				$this->err("Unknown ACL command '$command'.\nFor usage, try 'cake acl help'.\n\n");
			break;
		}
	}
/**
 * Enter description here...
 *
 */
	function create() {
		$this->checkArgNumber(4, 'create');
		$this->checkNodeType();
		extract($this->__dataVars());

		if (preg_match('/^([\w]+)\.(.*)$/', $this->args[2], $matches)) {
			pr($matches);
			die();
		} else {
			$parent = $this->args[2];
		}
		if(!$this->Acl->{$class}->create(intval($this->args[1]), $parent, $this->args[3])){
			$this->displayError("Parent Node Not Found", "There was an error creating the ".$class.", probably couldn't find the parent node.\n If you wish to create a new root node, specify the <parent_id> as '0'.");
		}
		$this->out("New $class '".$this->args[3]."' created.\n\n");
	}
/**
 * Enter description here...
 *
 */
	function delete() {
		$this->checkArgNumber(2, 'delete');
		$this->checkNodeType();
		extract($this->__dataVars());
		if(!$this->Acl->{$class}->delete($this->args[1])) {
			$this->displayError("Node Not Deleted", "There was an error deleting the ".$class.". Check that the node exists.\n");
		}
		$this->out("{$class} deleted.\n\n");
	}

/**
 * Enter description here...
 *
 */
	function setParent() {
		$this->checkArgNumber(3, 'setParent');
		$this->checkNodeType();
		extract($this->__dataVars());
		if (!$this->Acl->{$class}->setParent($this->args[2], $this->args[1])){
			$this->out("Error in setting new parent. Please make sure the parent node exists, and is not a descendant of the node specified.\n");
		} else {
			$this->out("Node parent set to ".$this->args[2]."\n\n");
		}
	}
/**
 * Enter description here...
 *
 */
	function getPath() {
		$this->checkArgNumber(2, 'getPath');
		$this->checkNodeType();
		extract($this->__dataVars());
		$id = (is_numeric($this->args[2])) ? intval($this->args[1]) : $this->args[1];
		$nodes = $this->Acl->{$class}->getPath($id);
		if (empty($nodes)) {
			$this->displayError("Supplied Node '".$this->args[1]."' not found", "No tree returned.");
		}
		for ($i = 0; $i < count($nodes); $i++) {
			$this->out(str_repeat('  ', $i) . "[" . $nodes[$i][$class]['id'] . "]" . $nodes[$i][$class]['alias'] . "\n");
		}
	}
/**
 * Enter description here...
 *
 */
	function grant() {
		$this->checkArgNumber(3, 'grant');
		//add existence checks for nodes involved
		$aro = (is_numeric($this->args[0])) ? intval($this->args[0]) : $this->args[0];
		$aco = (is_numeric($this->args[1])) ? intval($this->args[1]) : $this->args[1];
		$this->Acl->allow($aro, $aco, $this->args[2]);
		$this->out("Permission granted.\n");
	}
/**
 * Enter description here...
 *
 */
	function deny() {
		$this->checkArgNumber(3, 'deny');
		//add existence checks for nodes involved
		$aro = (is_numeric($this->args[0])) ? intval($this->args[0]) : $this->args[0];
		$aco = (is_numeric($this->args[1])) ? intval($this->args[1]) : $this->args[1];
		$this->Acl->deny($aro, $aco, $this->args[2]);
		$this->out("Requested permission successfully denied.\n");
	}
/**
 * Enter description here...
 *
 */
	function inherit() {
		$this->checkArgNumber(3, 'inherit');
		$aro = (is_numeric($this->args[0])) ? intval($this->args[0]) : $this->args[0];
		$aco = (is_numeric($this->args[1])) ? intval($this->args[1]) : $this->args[1];
		$this->Acl->inherit($aro, $aco, $this->args[2]);
		$this->out("Requested permission successfully inherited.\n");
	}
/**
 * Enter description here...
 *
 */
	function view() {
		$this->checkArgNumber(1, 'view');
		$this->checkNodeType();
		extract($this->__dataVars());
		if (!is_null($this->args[1])) {
			$conditions = $this->Acl->{$class}->_resolveID($this->args[1]);
		} else {
			$conditions = null;
		}
		$nodes = $this->Acl->{$class}->findAll($conditions, null, 'lft ASC');
		if (empty($nodes)) {
			$this->displayError($this->args[1]." not found", "No tree returned.");
		}
		$right = array();

		$this->out($class . " tree:");
		$this->hr(true);

		for($i = 0; $i < count($nodes); $i++){
			if (count($right) > 0){
				while ($right[count($right)-1] < $nodes[$i][$class]['rght']){
					if ($right[count($right)-1]){
						array_pop($right);
					} else {
						break;
					}
				}
			}
			$this->out(str_repeat('  ',count($right)) . "[" . $nodes[$i][$class]['id'] . "]" . $nodes[$i][$class]['alias']."\n");
			$right[] = $nodes[$i][$class]['rght'];
		}
		$this->hr(true);
	}
/**
 * Enter description here...
 *
 */
	function initdb() {
		$db =& ConnectionManager::getDataSource($this->dataSource);
		$this->out("Initializing Database...\n");
		$this->out("Creating access control objects table (acos)...\n");
		$sql = " CREATE TABLE ".$db->fullTableName('acos')." (
				".$db->name('id')." ".$db->column($db->columns['primary_key']).",
				".$db->name('object_id')." ".$db->column($db->columns['integer'])." default NULL,
				".$db->name('alias')." ".$db->column($db->columns['string'])." NOT NULL default '',
				".$db->name('lft')." ".$db->column($db->columns['integer'])." default NULL,
				".$db->name('rght')." ".$db->column($db->columns['integer'])." default NULL,
				PRIMARY KEY  (".$db->name('id').")
				);";
		if ($db->query($sql) === false) {
			die("Error: " . $db->lastError() . "\n\n");
		}

		$this->out("Creating access request objects table (aros)...\n");
		$sql2 = "CREATE TABLE ".$db->fullTableName('aros')." (
				".$db->name('id')." ".$db->column($db->columns['primary_key']).",
				".$db->name('foreign_key')." ".$db->column($db->columns['integer'])." default NULL,
				".$db->name('alias')." ".$db->column($db->columns['string'])." NOT NULL default '',
				".$db->name('lft')." ".$db->column($db->columns['integer'])." default NULL,
				".$db->name('rght')." ".$db->column($db->columns['integer'])." default NULL,
				PRIMARY KEY  (".$db->name('id').")
				);";
		if ($db->query($sql2) === false) {
			die("Error: " . $db->lastError() . "\n\n");
		}

		$this->out("Creating relationships table (aros_acos)...\n");
		$sql3 = "CREATE TABLE ".$db->fullTableName('aros_acos')." (
				".$db->name('id')." ".$db->column($db->columns['primary_key']).",
				".$db->name('aro_id')." ".$db->column($db->columns['integer'])." default NULL,
				".$db->name('aco_id')." ".$db->column($db->columns['integer'])." default NULL,
				".$db->name('_create')." ".$db->column($db->columns['integer'])." NOT NULL default '0',
				".$db->name('_read')." ".$db->column($db->columns['integer'])." NOT NULL default '0',
				".$db->name('_update')." ".$db->column($db->columns['integer'])." NOT NULL default '0',
				".$db->name('_delete')." ".$db->column($db->columns['integer'])." NOT NULL default '0',
				PRIMARY KEY  (".$db->name('id').")
				);";
		if ($db->query($sql3) === false) {
			die("Error: " . $db->lastError() . "\n\n");
		}

		$this->out("\nDone.\n");
	}

/**
 * Enter description here...
 *
 */
	function upgradedb() {
		$db =& ConnectionManager::getDataSource($this->dataSource);
		$this->out("Initializing Database...\n");
		$this->out("Upgrading table (aros)...\n");
		$sql = "ALTER TABLE ".$db->fullTableName('aros')."
				CHANGE ".$db->name('user_id')."
				".$db->name('foreign_key')."
				INT( 10 ) UNSIGNED NULL DEFAULT NULL;";
		$sql .= "ALTER TABLE " . $db->name('aros_acos') . " CHANGE " . $db->name('_create')
				. " " . $db->name('_create') . " CHAR(2) NOT NULL DEFAULT '0';";
		$sql .= "ALTER TABLE " . $db->name('aros_acos') . " CHANGE " . $db->name('_update')
				. " " . $db->name('_update') . " CHAR(2) NOT NULL DEFAULT '0';";
		$sql .= "ALTER TABLE " . $db->name('aros_acos') . " CHANGE " . $db->name('_read')
				. " " . $db->name('_read') . " CHAR(2) NOT NULL DEFAULT '0';";
		$sql .= "ALTER TABLE " . $db->name('aros_acos') . " CHANGE " . $db->name('_delete')
				. " " . $db->name('_delete') . " CHAR(2) NOT NULL DEFAULT '0';";
		if ($db->query($sql) === false) {
			die("Error: " . $db->lastError() . "\n\n");
		}
		$this->out("\nDatabase upgrade is complete.\n");
	}

/**
 * Enter description here...
 *
 */
	function help() {
		$out = "Usage: cake acl <command> <arg1> <arg2>...\n";
		$out .= "-----------------------------------------------\n";
		$out .= "Commands:\n";
		$out .= "\n";
		$out .= "\tcreate aro|aco <link_id> <parent_id> <alias>\n";
		$out .= "\t\tCreates a new ACL object under the parent specified by <parent_id>, an id/alias (see\n";
		$out .= "\t\t'view'). The link_id allows you to link a user object to Cake's\n";
		$out .= "\t\tACL structures. The alias parameter allows you to address your object\n";
		$out .= "\t\tusing a non-integer ID. Example: \"\$php acl.php create aro 57 0 John\"\n";
		$out .= "\t\twould create a new ARO object at the root of the tree, linked to 57\n";
		$out .= "\t\tin your users table, with an internal alias 'John'.";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tdelete aro|aco <id>\n";
		$out .= "\t\tDeletes the ACL object with the specified ID (see 'view').\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tsetParent aro|aco <id> <parent_id>\n";
		$out .= "\t\tUsed to set the parent of the ACL object specified by <id> to the ID\n";
		$out .= "\t\tspecified by <parent_id>.\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tgetPath aro|aco <id>\n";
		$out .= "\t\tReturns the path to the ACL object specified by <id>. This command is\n";
		$out .= "\t\tis useful in determining the inhertiance of permissions for a certain\n";
		$out .= "\t\tobject in the tree.\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tgrant <aro_id> <aco_id> <aco_action>\n";
		$out .= "\t\tUse this command to grant ACL permissions. Once executed, the ARO\n";
		$out .= "\t\tspecified (and its children, if any) will have ALLOW access to the\n";
		$out .= "\t\tspecified ACO action (and the ACO's children, if any).\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tdeny <aro_id> <aco_id> <aco_action>\n";
		$out .= "\t\tUse this command to deny ACL permissions. Once executed, the ARO\n";
		$out .= "\t\tspecified (and its children, if any) will have DENY access to the\n";
		$out .= "\t\tspecified ACO action (and the ACO's children, if any).\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tinherit <aro_id> <aco_id> <aco_action> \n";
		$out .= "\t\tUse this command to force a child ARO object to inherit its\n";
		$out .= "\t\tpermissions settings from its parent.\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tview aro|aco [id]\n";
		$out .= "\t\tThe view command will return the ARO or ACO tree. The optional\n";
		$out .= "\t\tid/alias parameter allows you to return only a portion of the requested\n";
		$out .= "\t\ttree.\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\tinitdb\n";
		$out .= "\t\tUse this command to create the database tables needed to use DB ACL.\n";
		$out .= "\n";
		$out .= "\n";
		$out .= "\thelp\n";
		$out .= "\t\tDisplays this help message.\n";
		$out .= "\n";
		$out .= "\n";
		$this->out($out);
	}
/**
 * Enter description here...
 *
 * @param unknown_type $title
 * @param unknown_type $msg
 */
	function displayError($title, $msg) {
		$out = "\n";
		$out .= "Error: $title\n";
		$out .= "$msg\n";
		$out .= "\n";
		$this->out($out);
		exit();
	}
/**
 * Enter description here...
 *
 * @param unknown_type $expectedNum
 * @param unknown_type $command
 */
	function checkArgNumber($expectedNum, $command) {
		if (count($this->args) < $expectedNum) {
			$this->displayError('Wrong number of parameters: '.count($this->args), 'Please type \'php acl.php help\' for help on usage of the '.$command.' command.');
		}
	}
/**
 * Enter description here...
 *
 */
	function checkNodeType() {
		if ($this->args[0] != 'aco' && $this->args[0] != 'aro') {
			$this->displayError("Missing/Unknown node type: '".$this->args[0]."'", 'Please specify which ACL object type you wish to create.');
		}
	}
/**
 * Enter description here...
 *
 * @param unknown_type $type
 * @param unknown_type $id
 * @return unknown
 */
	function nodeExists($type, $id) {
		//$this->out("Check to see if $type with ID = $id exists...\n");
		extract($this->__dataVars($type));
		$conditions = $this->Acl->{$class}->_resolveID($id);
		$possibility = $this->Acl->{$class}->findAll($conditions);
		return $possibility;
	}

/**
 * Enter description here...
 *
 * @param unknown_type $type
 * @return unknown
 */
	function __dataVars($type = null) {
		if ($type == null) {
			$type = $this->args[0];
		}

		$vars = array();
		$class = ucwords($type);
		$vars['secondary_id'] = ($class == 'aro' ? 'foreign_key' : 'object_id');
		$vars['data_name'] = $type;
		$vars['table_name'] = $type . 's';
		$vars['class'] = $class;
		return $vars;
	}
/**
 * Database configuration setup.
 *
 */
	function doDbConfig() {
		$this->hr(true);
		$this->out('Database Configuration:');
		$this->hr(true);

		$driver = '';

		while ($driver == '') {
			$driver = $this->in('What database driver would you like to use?', array('mysql','mysqli','mssql','sqlite','postgres', 'odbc'), 'mysql');
			if ($driver == '') {
				$this->out('The database driver supplied was empty. Please supply a database driver.');
			}
		}

		switch($driver) {
			case 'mysql':
			$connect = 'mysql_connect';
			break;
			case 'mysqli':
			$connect = 'mysqli_connect';
			break;
			case 'mssql':
			$connect = 'mssql_connect';
			break;
			case 'sqlite':
			$connect = 'sqlite_open';
			break;
			case 'postgres':
			$connect = 'pg_connect';
			break;
			case 'odbc':
			$connect = 'odbc_connect';
			break;
			default:
			$this->out('The connection parameter could not be set.');
			break;
		}

		$host = '';

		while ($host == '') {
			$host = $this->in('What is the hostname for the database server?', null, 'localhost');
			if ($host == '') {
				$this->out('The host name you supplied was empty. Please supply a hostname.');
			}
		}
		$login = '';

		while ($login == '') {
			$login = $this->in('What is the database username?', null, 'root');

			if ($login == '') {
				$this->out('The database username you supplied was empty. Please try again.');
			}
		}
		$password = '';
		$blankPassword = false;

		while ($password == '' && $blankPassword == false) {
			$password = $this->in('What is the database password?');
			if ($password == '') {
				$blank = $this->in('The password you supplied was empty. Use an empty password?', array('y', 'n'), 'n');
				if($blank == 'y')
				{
					$blankPassword = true;
				}
			}
		}
		$database = '';

		while ($database == '') {
			$database = $this->in('What is the name of the database you will be using?', null, 'cake');

			if ($database == '')  {
				$this->out('The database name you supplied was empty. Please try again.');
			}
		}

		$prefix = '';

		while ($prefix == '') {
			$prefix = $this->in('Enter a table prefix?', null, 'n');
		}
		if(low($prefix) == 'n') {
			$prefix = '';
		}

		$this->hr(true);
		$this->out('The following database configuration will be created:');
		$this->hr(true);
		$this->out("Driver:        $driver");
		$this->out("Connection:    $connect");
		$this->out("Host:          $host");
		$this->out("User:          $login");
		$this->out("Pass:          " . str_repeat('*', strlen($password)));
		$this->out("Database:      $database");
		$this->out("Table prefix:  $prefix");
		$this->hr(true);
		$looksGood = $this->in('Look okay?', array('y', 'n'), 'y');

		if (low($looksGood) == 'y' || low($looksGood) == 'yes') {
			$this->bakeDbConfig($driver, $connect, $host, $login, $password, $database, $prefix);
		} else {
			$this->out('Bake Aborted.');
		}
	}
/**
 * Creates a database configuration file for Bake.
 *
 * @param string $host
 * @param string $login
 * @param string $password
 * @param string $database
 */
	function bakeDbConfig( $driver, $connect, $host, $login, $password, $database, $prefix) {
		$out = "<?php\n";
		$out .= "class DATABASE_CONFIG {\n\n";
		$out .= "\tvar \$default = array(\n";
		$out .= "\t\t'driver' => '{$driver}',\n";
		$out .= "\t\t'connect' => '{$connect}',\n";
		$out .= "\t\t'host' => '{$host}',\n";
		$out .= "\t\t'login' => '{$login}',\n";
		$out .= "\t\t'password' => '{$password}',\n";
		$out .= "\t\t'database' => '{$database}', \n";
		$out .= "\t\t'prefix' => '{$prefix}' \n";
		$out .= "\t);\n";
		$out .= "}\n";
		$out .= "?>";
		$filename = CONFIGS.'database.php';
		$this->createFile($filename, $out);
	}
}

?>