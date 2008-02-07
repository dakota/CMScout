<?php
/* SVN FILE: $Id$ */
/**
 * Oracle layer for DBO.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.model.datasources.dbo
 * @since			CakePHP v 1.2.0.4041
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Long description for class
 *
 * @package		cake
 * @subpackage	cake.cake.libs.model.datasources.dbo
 */
class DboOracle extends DboSource {
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access public
 */
	var $config;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access public
 */
	var $alias = '';
/**
  * The name of the model's sequence
  *
  * @var unknown_type
  */
	var $sequence = '';
/**
 * Transaction in progress flag
 *
 * @var boolean
 */
	var $__transactionStarted = false;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access public
 */
	var $columns = array(
		'primary_key' => array('name' => 'number NOT NULL'),
		'string' => array('name' => 'varchar2', 'limit' => '255'),
		'text' => array('name' => 'varchar2'),
		'integer' => array('name' => 'numeric'),
		'float' => array('name' => 'float'),
		'datetime' => array('name' => 'date', 'format' => 'Y-m-d H:i:s'),
		'timestamp' => array('name' => 'date', 'format' => 'Y-m-d H:i:s'),
		'time' => array('name' => 'date', 'format' => 'Y-m-d H:i:s'),
		'date' => array('name' => 'date', 'format' => 'Y-m-d H:i:s'),
		'binary' => array('name' => 'bytea'),
		'boolean' => array('name' => 'boolean'),
		'number' => array('name' => 'numeric'),
		'inet' => array('name' => 'inet'));
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $connection;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $_limit = -1;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $_offset = 0;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $_map;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $_currentRow;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $_numRows;
/**
 * Enter description here...
 *
 * @var unknown_type
 * @access protected
 */
	var $_results;
	
/**
 * Base configuration settings for MySQL driver
 *
 * @var array
 */
	var $_baseConfig = array(
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'system',
		'password' => '',
		'database' => 'cake',
		'nls_sort' => '',
		'nls_sort' => ''
	);
/**
 * Connects to the database using options in the given configuration array.
 *
 * @return boolean True if the database could be connected, else false
 * @access public
 */
	function connect() {
		$config = $this->config;
		$this->connected = false;
		$config['charset'] = !empty($config['charset']) ? $config['charset'] : null;
		
		if ($this->config['persistent']) {
			$connect = 'ociplogon';
		} else {
			$connect = 'ocilogon';
		}
		$this->connection = $connect($config['login'], $config['password'], $config['database'], $config['charset']);

		if ($this->connection) {
			$this->connected = true;
			if (!empty($config['nls_sort'])) {
				$this->execute('ALTER SESSION SET NLS_SORT='.$config['nls_sort']);
			}

			if (!empty($config['nls_comp'])) {
				$this->execute('ALTER SESSION SET NLS_COMP='.$config['nls_comp']);
			}
			$this->execute("ALTER SESSION SET NLS_DATE_FORMAT='YYYY-MM-DD HH24:MI:SS'");
		} else {
			$this->connected = false;
		}
		return $this->connected;
	}
/**
 * Sets the encoding language of the session
 *
 * @param string $lang language constant
 * @return bool
 */
	function setEncoding($lang) {
		if (!$this->execute('ALTER SESSION SET NLS_LANGUAGE='.$lang)) {
			return false;
		}
		return true;
	}
/**
 * Gets the current encoding language
 *
 * @return string language constant
 */
	function getEncoding() {
		$sql = 'SELECT VALUE FROM NLS_SESSION_PARAMETERS WHERE PARAMETER=\'NLS_LANGUAGE\'';
		if (!$this->execute($sql)) {
			return false;
		}

		if (!$row = $this->fetchRow()) {
			return false;
		}
		return $row[0]['VALUE'];
	}
/**
 * Disconnects from database.
 *
 * @return boolean True if the database could be disconnected, else false
 * @access public
 */
	function disconnect() {
		if ($this->connection) {
			$this->connected = !ocilogoff($this->connection);
			return !$this->connected;
		}
	}
/**
 * Scrape the incoming SQL to create the association map. This is an extremely
 * experimental method that creates the association maps since Oracle will not tell us.
 *
 * @param string $sql
 * @return false if sql is nor a SELECT
 * @access protected
 */
	function _scrapeSQL($sql) {
		$sql = str_replace("\"", '', $sql);
		$preFrom = preg_split('/\bFROM\b/', $sql);
		$preFrom = $preFrom[0];
		$find = array('SELECT');
		$replace = array('');
		$fieldList = trim(str_replace($find, $replace, $preFrom));
		$fields = preg_split('/,\s+/', $fieldList);//explode(', ', $fieldList);
		$lastTableName	= '';

		foreach($fields as $key => $value) {
			if ($value != 'COUNT(*) AS count') {
				if (preg_match('/\s+(\w+(\.\w+)*)$/', $value, $matches)) {
					$fields[$key]	= $matches[1];

					if (preg_match('/^(\w+\.)/', $value, $matches)) {
						$fields[$key]	= $matches[1] . $fields[$key];
						$lastTableName	= $matches[1];
					}
				}
				/*
				if (preg_match('/(([[:alnum:]_]+)\.[[:alnum:]_]+)(\s+AS\s+(\w+))?$/i', $value, $matches)) {
					$fields[$key]	= isset($matches[4]) ? $matches[2] . '.' . $matches[4] : $matches[1];
				}
				*/
			}
		}
		$this->_map = array();

		foreach($fields as $f) {
			$e = explode('.', $f);
			if (count($e) > 1) {
				$table = $e[0];
				$field = strtolower($e[1]);
			} else {
				$table = 0;
				$field = $e[0];
			}
			$this->_map[] = array($table, $field);
		}
	}
/**
 * Modify a SQL query to limit (and offset) the result set
 *
 * @param integer $limit Maximum number of rows to return
 * @param integer $offset Row to begin returning
 * @return modified SQL Query
 * @access public
 */
	function limit($limit = -1, $offset = 0) {
		$this->_limit = (int) $limit;
		$this->_offset = (int) $offset;
	}
/**
 * Returns number of rows in previous resultset. If no previous resultset exists,
 * this returns false.
 *
 * @return integer Number of rows in resultset
 * @access public
 */
	function lastNumRows() {
		return $this->_numRows;
	}
/**
 * Executes given SQL statement. This is an overloaded method.
 *
 * @param string $sql SQL statement
 * @return resource Result resource identifier or null
 * @access protected
 */
	function _execute($sql) {
		$this->_statementId = ociparse($this->connection, $sql);
		if (!$this->_statementId) {
			return null;
		}

		if ($this->__transactionStarted) {
			$mode = OCI_DEFAULT;
		} else {
			$mode = OCI_COMMIT_ON_SUCCESS;
		}

		if (!ociexecute($this->_statementId, $mode)) {
			return false;
		}

		switch(ocistatementtype($this->_statementId)) {
			case 'DESCRIBE':
			case 'SELECT':
				$this->_scrapeSQL($sql);
			break;
			default:
				return $this->_statementId;
			break;
		}

		if ($this->_limit >= 1) {
			ocisetprefetch($this->_statementId, $this->_limit);
		} else {
			ocisetprefetch($this->_statementId, 3000);
		}
		$this->_numRows = ocifetchstatement($this->_statementId, $this->_results, $this->_offset, $this->_limit, OCI_NUM | OCI_FETCHSTATEMENT_BY_ROW);
		$this->_currentRow = 0;
		$this->limit();
		return $this->_statementId;
	}
/**
 * Enter description here...
 *
 * @return unknown
 * @access public
 */
	function fetchRow() {
		if ($this->_currentRow >= $this->_numRows) {
			ocifreestatement($this->_statementId);
			$this->_map = null;
			$this->_results = null;
			$this->_currentRow = null;
			$this->_numRows = null;
			return false;
		}
		$resultRow = array();

		foreach($this->_results[$this->_currentRow] as $index => $field) {
			list($table, $column) = $this->_map[$index];

			if (strpos($column, ' count')) {
				$resultRow[0]['count'] = $field;
			} else {
				$resultRow[$table][$column] = $this->_results[$this->_currentRow][$index];
			}
		}
		$this->_currentRow++;
		return $resultRow;
	}
/**
 * Checks to see if a named sequence exists
 *
 * @param string $sequence
 * @return bool
 * @access public
 */
	function sequenceExists($sequence) {
		$sql = "SELECT SEQUENCE_NAME FROM USER_SEQUENCES WHERE SEQUENCE_NAME = '$sequence'";
		if (!$this->execute($sql)) {
			return false;
		}
		return $this->fetchRow();
	}
/**
 * Creates a database sequence
 *
 * @param string $sequence
 * @return bool
 * @access public
 */
	function createSequence($sequence) {
		$sql = "CREATE SEQUENCE $sequence";
		return $this->execute($sql);
	}
/**
 * Enter description here...
 *
 * @param unknown_type $table
 * @return unknown
 * @access public
 */
	function createTrigger($table) {
		$sql = "CREATE OR REPLACE TRIGGER pk_$table" . "_trigger BEFORE INSERT ON $table FOR EACH ROW BEGIN SELECT pk_$table.NEXTVAL INTO :NEW.ID FROM DUAL; END;";
		return $this->execute($sql);
	}
/**
 * Returns an array of tables in the database. If there are no tables, an error is
 * raised and the application exits.
 *
 * @return array tablenames in the database
 * @access public
 */
	function listSources() {
		$cache = parent::listSources();
		if ($cache != null) {
			return $cache;
		}
		$sql = 'SELECT view_name AS name FROM user_views UNION SELECT table_name AS name FROM user_tables';

		if (!$this->execute($sql)) {
			return false;
		}
		$sources = array();

		while($r = $this->fetchRow()) {
			$sources[] = strtolower($r[0]['name']);
		}
		parent::listSources($sources);
		return $sources;
	}
/**
 * Returns an array of the fields in given table name.
 *
 * @param object instance of a model to inspect
 * @return array Fields in table. Keys are name and type
 * @access public
 */
	function describe(&$model) {
		$cache = parent::describe($model);

		if ($cache != null) {
			return $cache;
		}
		$sql = 'SELECT COLUMN_NAME, DATA_TYPE, DATA_LENGTH FROM user_tab_columns WHERE table_name = \'';
		$sql .= strtoupper($this->fullTableName($model)) . '\'';

		if (!$this->execute($sql)) {
			return false;
		}
		$fields = array();

		for($i=0; $row = $this->fetchRow(); $i++) {
			$fields[strtolower($row[0]['COLUMN_NAME'])] = array('type'=> $this->column($row[0]['DATA_TYPE']),
			 													'length'=> $row[0]['DATA_LENGTH']);
		}
		$this->__cacheDescription($this->fullTableName($model, false), $fields);
		return $fields;
	}
	
/**
 * Returns an array of the indexes in given table name.
 *
 * @param string $model Name of model to inspect
 * @return array Fields in table. Keys are column and unique
 */
	function index($model) {
		$index = array();
		$table = $this->fullTableName($model, false);
		if($table) {
			$indexes = $this->query('SELECT 
			  cc.table_name,
			  cc.column_name,
			  cc.constraint_name,
			  c.constraint_type,
			  i.index_name,
			  i.uniqueness
			FROM user_cons_columns cc 
			LEFT JOIN user_indexes i ON(cc.constraint_name = i.index_name) 
			LEFT JOIN user_constraints c ON(c.constraint_name = cc.constraint_name)
			WHERE cc.table_name = \'' . strtoupper($table) .'\'');
			foreach ($indexes as $i => $idx) {
				if ($idx['c']['constraint_type'] == 'P') {
					$key = 'PRIMARY';	
				} else {
					continue;
				}
				if(!isset($index[$key])) {
					$index[$key]['column'] = strtolower($idx['cc']['column_name']);
					$index[$key]['unique'] = ife($idx['i']['uniqueness'] == 'UNIQUE', 1, 0);
				} else {
					if(!is_array($index[$key]['column'])) {
						$col[] = $index[$key]['column'];
					}
					$col[] = strtolower($idx['cc']['column_name']);
					$index[$key]['column'] = $col;
				}
			}
		}
		return $index;
	}
	
/**
 * Generate a Oracle Alter Table syntax for the given Schema comparison
 *
 * @param unknown_type $schema
 * @return unknown
 */
	function alterSchema($compare, $table = null) {
		if(!is_array($compare)) {
			return false;
		}
		$out = '';
		$colList = array();
		foreach($compare as $curTable => $types) {
			if (!$table || $table == $curTable) {
				$out .= 'ALTER TABLE ' . $this->fullTableName($curTable) . " \n";
				foreach($types as $type => $column) {
					switch($type) {
						case 'add':
							foreach($column as $field => $col) {
								$col['name'] = $field;
								$alter = 'ADD '.$this->buildColumn($col);
								if(isset($col['after'])) {
									$alter .= ' AFTER '. $this->name($col['after']);
								}
								$colList[] = $alter;
							}
						break;
						case 'drop':
							foreach($column as $field => $col) {
								$col['name'] = $field;
								$colList[] = 'DROP '.$this->name($field);
							}
						break;
						case 'change':
							foreach($column as $field => $col) {
								if(!isset($col['name'])) {
									$col['name'] = $field;
								}
								$colList[] = 'CHANGE '. $this->name($field).' '.$this->buildColumn($col);
							}
						break;
					}
				}
				$out .= "\t" . join(",\n\t", $colList) . ";\n\n";
			}
		}
		return $out;
	}
	
/**
 * This method should quote Oracle identifiers. Well it doesn't.
 * It would break all scaffolding and all of Cake's default assumptions.
 *
 * @param unknown_type $var
 * @return unknown
 * @access public
 */
	function name($var) {
		switch($var) {
			case '_create':
			case '_read':
			case '_update':
			case '_delete':
				return "\"$var\"";
			break;
			default:
				return $var;
			break;
		}
	}
/**
 * Begin a transaction
 *
 * @param unknown_type $model
 * @return boolean True on success, false on fail
 * (i.e. if the database/model does not support transactions).
 */
	function begin() {
		$this->__transactionStarted = true;
		return true;
	}
/**
 * Rollback a transaction
 *
 * @param unknown_type $model
 * @return boolean True on success, false on fail
 * (i.e. if the database/model does not support transactions,
 * or a transaction has not started).
 */
	function rollback() {
		return ocirollback($this->connection);
	}
/**
 * Commit a transaction
 *
 * @param unknown_type $model
 * @return boolean True on success, false on fail
 * (i.e. if the database/model does not support transactions,
 * or a transaction has not started).
 */
	function commit() {
		$this->__transactionStarted = false;
		return ocicommit($this->connection);
	}
/**
 * Converts database-layer column types to basic types
 *
 * @param string $real Real database-layer column type (i.e. "varchar(255)")
 * @return string Abstract column type (i.e. "string")
 * @access public
 */
	function column($real) {
		if (is_array($real)) {
			$col = $real['name'];

			if (isset($real['limit'])) {
				$col .= '('.$real['limit'].')';
			}
			return $col;
		} else {
			$real = strtolower($real);
		}
		$col = str_replace(')', '', $real);
		$limit = null;

		@list($col, $limit) = explode('(', $col);
		if (in_array($col, array('date', 'timestamp'))) {
			return $col;
		}
		if (strpos($col, 'number') !== false) {
			return 'integer';
		}
		if (strpos($col, 'integer') !== false) {
			return 'integer';
		}
		if (strpos($col, 'char') !== false) {
			return 'string';
		}
		if (strpos($col, 'text') !== false) {
			return 'text';
		}
		if (strpos($col, 'blob') !== false) {
			return 'binary';
		}
		if (in_array($col, array('float', 'double', 'decimal'))) {
			return 'float';
		}
		if ($col == 'boolean') {
			return $col;
		}
		return 'text';
	}
/**
 * Returns a quoted and escaped string of $data for use in an SQL statement.
 *
 * @param string $data String to be prepared for use in an SQL statement
 * @return string Quoted and escaped
 * @access public
 */
	function value($data, $column = null, $safe = false) {
	    $parent = parent::value($data, $column, $safe);

	    if ($parent != null) {
			return $parent;
		}

		if ($data === null) {
			return 'NULL';
		}

		if ($data === '') {
			return  "''";
		}

		switch($column) {
			case 'date':
				$data = date('Y-m-d H:i:s', strtotime($data));
				$data = "TO_DATE('$data', 'YYYY-MM-DD HH24:MI:SS')";
			    break;
			case 'integer' :
			case 'float' :
			case null :
				if (is_numeric($data)) {
					break;
				}
			default:
			    $data = str_replace("'", "''", $data);
			    $data = "'$data'";
			    break;
		}
		return $data;
	}
/**
 * Returns the ID generated from the previous INSERT operation.
 *
 * @param string
 * @return integer
 * @access public
 */
	function lastInsertId($source) {
		$sequence = (!empty($this->sequence)) ? $this->sequence : $source . '_seq';
		$sql = "SELECT $sequence.currval FROM dual";

		if (!$this->execute($sql)) {
			return false;
		}

		while($row = $this->fetchRow()) {
			return $row[$sequence]['currval'];
		}
		return false;
	}
/**
 * Returns a formatted error message from previous database operation.
 *
 * @return string Error message with error number
 * @access public
 */
	function lastError() {
		$errors = ocierror();

		if (($errors != null) && (isset($errors["message"]))) {
			return($errors["message"]);
		}
		return null;
	}
/**
 * Returns number of affected rows in previous database operation. If no previous operation exists, this returns false.
 *
 * @return int Number of affected rows
 * @access public
 */
	function lastAffected() {
		return $this->_statementId ? ocirowcount($this->_statementId): false;
	}
/**
 * Inserts multiple values into a join table
 *
 * @param string $table
 * @param string $fields
 * @param array $values
 */
	function insertMulti($table, $fields, $values) {
		parent::__insertMulti($table, $fields, $values);
	}
	
/**
 * Renders a final SQL statement by putting together the component parts in the correct order
 *
 * @param string $type
 * @param array $data
 * @return string
 */
	function renderStatement($type, $data) {
		extract($data);
		$aliases = null;

		switch (strtolower($type)) {
			case 'select':
				return "SELECT {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$order} {$limit}";
			break;
			case 'update':
				if (!empty($alias)) {
					$aliases = "{$this->alias}{$alias} ";
				}
				return "UPDATE {$table} {$aliases}SET {$fields} {$conditions}";
			break;
			case 'delete':
				if (!empty($alias)) {
					$aliases = "{$this->alias}{$alias} ";
				}
				return "DELETE FROM {$table} {$aliases}{$conditions}";
			break;
		}
	}
	
/**
 * Enter description here...
 *
 * @param Model $model
 * @param unknown_type $linkModel
 * @param string $type Association type
 * @param unknown_type $association
 * @param unknown_type $assocData
 * @param unknown_type $queryData
 * @param unknown_type $external
 * @param unknown_type $resultSet
 * @param integer $recursive Number of levels of association
 * @param array $stack
 */
	function queryAssociation(&$model, &$linkModel, $type, $association, $assocData, &$queryData, $external = false, &$resultSet, $recursive, $stack) {

		if ($query = $this->generateAssociationQuery($model, $linkModel, $type, $association, $assocData, $queryData, $external, $resultSet)) {
			if (!isset($resultSet) || !is_array($resultSet)) {
				if (Configure::read() > 0) {
					e('<div style = "font: Verdana bold 12px; color: #FF0000">' . sprintf(__('SQL Error in model %s:', true), $model->alias) . ' ');
					if (isset($this->error) && $this->error != null) {
						e($this->error);
					}
					e('</div>');
				}
				return null;
			}
			$count = count($resultSet);

			if ($type === 'hasMany' && (!isset($assocData['limit']) || empty($assocData['limit']))) {
				$ins = $fetch = array();
				for ($i = 0; $i < $count; $i++) {
					if ($in = $this->insertQueryData('{$__cakeID__$}', $resultSet[$i], $association, $assocData, $model, $linkModel, $stack)) {
						$ins[] = $in;
					}
				}

				if (!empty($ins)) {
					$fetch = array();
					$ins = array_chunk($ins, 1000);
					foreach ($ins as $i) {
						$q = str_replace('{$__cakeID__$}', join(', ', $i), $query);
						$res = $this->fetchAll($q, $model->cacheQueries, $model->alias);
						$fetch = am($fetch, $res);
					}
				}

				if (!empty($fetch) && is_array($fetch)) {
					if ($recursive > 0) {

						foreach ($linkModel->__associations as $type1) {
							foreach ($linkModel->{$type1} as $assoc1 => $assocData1) {
								$deepModel =& $linkModel->{$assoc1};
								$tmpStack = $stack;
								$tmpStack[] = $assoc1;

								if ($linkModel->useDbConfig === $deepModel->useDbConfig) {
									$db =& $this;
								} else {
									$db =& ConnectionManager::getDataSource($deepModel->useDbConfig);
								}
								$db->queryAssociation($linkModel, $deepModel, $type1, $assoc1, $assocData1, $queryData, true, $fetch, $recursive - 1, $tmpStack);
							}
						}
					}
				}
				return $this->__mergeHasMany($resultSet, $fetch, $association, $model, $linkModel, $recursive);
			} elseif ($type === 'hasAndBelongsToMany') {
				$ins = $fetch = array();
				for ($i = 0; $i < $count; $i++) {
					if ($in = $this->insertQueryData('{$__cakeID__$}', $resultSet[$i], $association, $assocData, $model, $linkModel, $stack)) {
						$ins[] = $in;
					}
				}
				
				$foreignKey = $model->hasAndBelongsToMany[$association]['foreignKey'];
				$joinKeys = array($foreignKey, $model->hasAndBelongsToMany[$association]['associationForeignKey']);
				list($with, $habtmFields) = $model->joinModel($model->hasAndBelongsToMany[$association]['with'], $joinKeys);
				$habtmFieldsCount = count($habtmFields);

				if (!empty($ins)) {
					$fetch = null;
					$ins = array_chunk($ins, 1000);
					foreach ($ins as $i) {
						$q = str_replace('{$__cakeID__$}', '(' .join(', ', $i) .')', $query);
						$q = str_replace('=  (', 'IN (', $q);
						$q = str_replace('  WHERE 1 = 1', '', $q);
						$q = $this->insertQueryData($q, null, $association, $assocData, $model, $linkModel, $stack);
						if ($q != false) {
							$res = $this->fetchAll($q, $model->cacheQueries, $model->alias);
							$fetch = am($fetch, $res);
						}
					}
				}
			}

			for ($i = 0; $i < $count; $i++) {
				$row =& $resultSet[$i];

				if ($type !== 'hasAndBelongsToMany') {
					$q = $this->insertQueryData($query, $resultSet[$i], $association, $assocData, $model, $linkModel, $stack);
					if ($q != false) {
						$fetch = $this->fetchAll($q, $model->cacheQueries, $model->alias);
					} else {
						$fetch = null;
					}
				}

				if (!empty($fetch) && is_array($fetch)) {
					if ($recursive > 0) {

						foreach ($linkModel->__associations as $type1) {
							foreach ($linkModel->{$type1} as $assoc1 => $assocData1) {

								$deepModel =& $linkModel->{$assoc1};
								if (($type1 === 'belongsTo') || ($deepModel->alias === $model->alias && $type === 'belongsTo') || ($deepModel->alias != $model->alias)) {
									$tmpStack = $stack;
									$tmpStack[] = $assoc1;
									if ($linkModel->useDbConfig == $deepModel->useDbConfig) {
										$db =& $this;
									} else {
										$db =& ConnectionManager::getDataSource($deepModel->useDbConfig);
									}
									$db->queryAssociation($linkModel, $deepModel, $type1, $assoc1, $assocData1, $queryData, true, $fetch, $recursive - 1, $tmpStack);
								}
							}
						}
					}
					if ($type == 'hasAndBelongsToMany') {
						$merge = array();
						foreach($fetch as $j => $data) {
							if (isset($data[$with]) && $data[$with][$foreignKey] === $row[$model->alias][$model->primaryKey]) {
								if ($habtmFieldsCount > 2) {
									$merge[] = $data;
								} else {
									$merge[] = Set::diff($data, array($with => $data[$with]));
								}
							}
						}
						if (empty($merge) && !isset($row[$association])) {
							$row[$association] = $merge;
						} else {
							$this->__mergeAssociation($resultSet[$i], $merge, $association, $type);
						}
					} else {
						$this->__mergeAssociation($resultSet[$i], $fetch, $association, $type);
					}
					$resultSet[$i][$association] = $linkModel->afterfind($resultSet[$i][$association]);

				} else {
					$tempArray[0][$association] = false;
					$this->__mergeAssociation($resultSet[$i], $tempArray, $association, $type);
				}
			}
		}
	}
	
}

?>