	<?php

/**
 * TODO:
 * 
 * does it work with trees? it would have to be transaction(-like)
 * recursive rewrite
 * recursive micro-revisions
 * inline & shadow tables
 *
 */

class VersionBehavior extends ModelBehavior {
	
	/**
	 * The snapshot in time requested
	 *
	 * @var string
	 */
	var $date;
				
	/**
	 * Behavior settings for models
	 * 
	 * showErrors - (boolean) trigger errors when shadow not found
	 * modelProperties - (array) properties to pass to the version object
	 *
	 * @var array
	 */
	var $settings;
			
	function setup($model, $config = array()) {
		$settings = am(array(
			'version_id' => 'version_id',
			'date_start' => 'vb_date_start',
			'date_end' => 'vb_date_end',
			'showErrors' => true,
			'modelProperties' => array()
		), $config);
		$this->settings[$model->alias] = $settings;
	}
		
	/**
	 * Limits the model search to the datetime set in revision()
	 *
	 * @param unknown_type $model
	 * @param unknown_type $query
	 * @return unknown
	 */
	function beforeFind(&$model, $query) {
		extract($this->settings[$model->alias]);
		if (isset($query['conditions']) && is_array($query['conditions']) && array_key_exists('date', $query['conditions'])) {
			$date = $query['conditions']['date'];
			unset($query['conditions']['date']);
			$model = $model->revision($date);
		}
		if (isset($model->date)) {
			$date = $model->date;
			$conditions = array(
				'OR' => array(
					"'$date' BETWEEN $model->alias.$date_start AND $model->alias.$date_end",
					"'$date' >= $model->alias.$date_start AND $model->alias.$date_end IS NULL"
				)
			);
			$query['conditions'] = am($conditions, $query['conditions']);
		}
		return $query;
	}
			
	/**
	 * Updates the date of the current revision, then promotes a new version
	 *
	 * @param unknown_type $model
	 */
	function afterSave($model) {
		if (!$this->__shadowExists($model)) {
			return false;
		}
		$date = $this->__updateOldRevision($model);
		$this->__saveNewRevision($model, $date);
	}
	
	/**
	 * Terminates the lifetime of a revision record
	 *
	 */
	function beforeDelete($model) {
		if (!$this->__shadowExists($model)) {
			return true;
		}
		$this->__updateOldRevision($model);
	}
		
	/**
	 * Saves a new revision of the model and its HABTM relations
	 *
	 * @param unknown_type $model
	 */
 		function __saveNewRevision($model, $date = null) {
		extract($this->settings[$model->alias]);
		$db = ConnectionManager::getDataSource($model->useDbConfig);
		if ($date) {
			$d = getdate(strtotime($date));
			$d = mktime($d['hours'], $d['minutes'], $d['seconds']+1, $d['mon'], $d['mday'], $d['year']);
			$date = $this->__getDate($model, $d);
		} else {
			$date = $this->__getDate($model, $date);
		}
		$model->vb_date_start = $date;
				
		$version = $model->getVersionModel();
		
		$data = $model->data[$model->alias];
		$data['id'] = $model->id;
		
		$data[$date_start] = $date;
		$version->create($data);
		$version->save();
		
		$tables = $db->listSources();

		if (isset($model->hasAndBelongsToMany)) {
			foreach ($model->hasAndBelongsToMany as $name => $assoc) {
				if (isset($model->data[$name][$name]) && is_array($model->data[$name][$name])) {
					$table = $db->config['prefix'] . Inflector::singularize($assoc['joinTable']).'_versions';
					if (!in_array($table, $tables)) {
						if ($showErrors) {
							trigger_error('Could not locate shadow table: '.$table);
						} else {
							continue;
						}
					}
					$db->execute("UPDATE $table SET $date_end = '$date' WHERE {$assoc['foreignKey']} = {$data[$model->primaryKey]}");
					foreach ($model->data[$name][$name] as $v) {
						$db->execute("INSERT INTO $table ({$assoc['foreignKey']}, {$assoc['associationForeignKey']}, $date_start) VALUES ({$data[$model->primaryKey]}, $v, '$date')");
					}
				}
			}
		}		
	}
	
	/**
	 * Deprecates current revision of the model
	 *
	 */
	function __updateOldRevision($model) {
		extract($this->settings[$model->alias]);
		$date = $model->vb_date_end = $this->date = $this->__getDate($model);
		$version = $model->getVersionModel();
		$conditions = array(
			"$version->name.$model->primaryKey" => $model->id,
			"$version->name.$date_end" => null
		);
		$old = $version->find($conditions);
		if ($old) {
			$old[$version->name][$date_end] = $date;
			$version->save($old);
			return $date;
		}
	}
	
	/**
	 * Flattens an array of values
	 *
	 * @param unknown_type $array
	 * @return unknown
	 */
	function __flatten($array) {
		$data = array();
		foreach ($array as $a) {
			if (is_array($a)) {
				$data = am($data, $this->__flatten($a));
			} else {
				$data = array_values($array);
			}
		}
		return $data;
	}
		
	/**
	 * Returns an array highlighting the differences between two arrays
	 *
	 * @param object $model
	 * @param array $new
	 * @param array $old
	 * @param array $meta An array of fields 
	 * @return unknown
	 */
	function diff(&$model, $new, $old, $meta = array()) {
		
		static $stack;
		
		$result = array(
			'added' => array(),
			'modified' => array(),
			'deleted' => array()
		);
		
		foreach ($new as $k => $n) {
			$stack[] = $k;
			$path = implode('.', $stack);
			if (is_array($n)) {
				if (array_key_exists($k, $old)) {
					$deleted = array_diff_key($old[$k], $n);
					if ($deleted) {
						foreach ($deleted as $kd => $d) {
							$s = $stack;
							array_push($s, $kd);
							$p = implode('.', $s);
							$result = Set::insert($result, 'deleted.'.$p, $d);
						}
					}
					$res = $this->diff($model, $n, $old[$k]);
					$result = Set::merge($result, $res);
				} else {
					$result = Set::insert($result, 'added.'.$path, $n);
				}
			} else {
				if (!array_key_exists($k, $old)) {
					$result = Set::insert($result, 'added.'.$path, $n);
				} else if (array_key_exists($k, $old) && $n != $old[$k]) {
					$result = Set::insert($result, 'modified.'.$path, $n);
				}
			}
			array_pop($stack);
		}
		return $result;
	}
	

	
	/**
	 * Retrieves full revision history for an object
	 *
	 * @param unknown_type $model
	 * @param unknown_type $id
	 * @return unknown
	 */
	function history($model, $id, $conditions = null, $fields = null, $order = null, $limit = null, $recursive = null) {
		
		extract($this->settings[$model->alias]);
		
		if (!$id) {
			return false;
		}
		
		$model = new $model->alias;
		$version = $model->revision(null, true);
		$conditions = array(
			$version->alias.'.'.$version->primaryKey => $id
		);
		$results = $version->findAll($conditions, $fields, $order, $limit, $recursive);
		
		#debug($results);
		#exit;
		
		$dates = Set::extract($results, "{n}.$version->alias.$date_start");
		foreach ($version->__associations as $association) {
			foreach ($version->$association as $name => $assoc) {
				switch ($association) {
					case 'hasOne':
					case 'belongsTo':
						$dates = array_merge($dates, Set::extract($results, "{n}.$name.$date_start"));
						break;
					case 'hasAndBelongsToMany':
					case 'hasMany':
						$data = Set::extract($results, "{n}.$name.{n}.$date_start");
						$dates = array_merge($dates, $this->__flatten($data));
						break;
				}
				
			}
		}
		unset($results);
		$dates = Set::filter(array_unique($dates));
		$revisions = array();
		foreach ($dates as $d) {
			$model = new $model->alias;
			$version = $model->revision($d);
			$conditions = array(
				$version->alias.'.'.$version->primaryKey => $id
			);
			$revisions[$d] = $version->find($conditions, $fields, $order, $limit, $recursive);
		}
		krsort($revisions);
		return $revisions;
	}
	
	/**
	 * Promotes an old revision to the current one
	 *
	 * @param unknown_type $model
	 */
	function promote(&$model) {
		
	}
		
	/**
	 * Prepares dates
	 *
	 * @param unknown_type $date
	 * @return unknown
	 */
	function __getDate($model, $date = null) {
		$db = ConnectionManager::getDataSource($model->useDbConfig);
		if (!$date && isset($this->date)) {
			$date = $this->date;
		}
		if (!$date) {
			$date = date($db->columns['datetime']['format'], time());
		} else {
			if (is_numeric($date)) {
				$date = date($db->columns['datetime']['format'], $date);
			} else {
				$date = date($db->columns['datetime']['format'], strtotime($date));
			}
		}
		return $this->date = $date;
	}
	
	/**
	 * Checks to see if a given shadow table name exists
	 * 
	 * @param object $model
	 * @return boolean
	 */
	function __shadowExists($model) {
		extract($this->settings[$model->alias]);
		$db = ConnectionManager::getDataSource($model->useDbConfig);
		$table = Inflector::singularize($model->table).'_versions';
		$tables = $db->listSources();
		if (!in_array($db->config['prefix'] . $table, $tables)) {
			if ($showErrors) {
				trigger_error('Could not locate shadow table: '.$table);
			} else {
				return false;
			}
		}
		return $table;
	}

	/**
	 * Retrieves simple version model with no associations, behaviors, or anything from
	 * the original model. Useful for performing direct query on the shadow tables.
	 *
	 */
	function getVersionModel(&$model) {
		
		if (isset($model->date)) {
			return $model;
		}
		
		if (!$table = $this->__shadowExists($model)) {
			return false;
		} 
		
		extract($this->settings[$model->alias]);
		
		$new = new AppModel(array('name' => $model->alias, 'table' => $table, 'ds' => $model->useDbConfig));
		$this->__checkSchema($new);
		$new->Behaviors->detach('Version');
		$new->primaryKey = $version_id;
		foreach ($modelProperties as $name => $value) {
			$new->{$name} = $value;
		}
		
		return $new;
	}
	
	/**
	 * Check a version object to see if it has the necessary fields to operate
	 *
	 * @param object $obj
	 */
	function __checkSchema($obj) {
		extract($this->settings[$obj->alias]);
		if (!$obj->hasField($date_start)) {
			trigger_error(__("Malformed shadow table. $obj->table is missing the `$date_start` column."));
		}
		if (!$obj->hasField($date_end)) {
			trigger_error(__("Malformed shadow table. $obj->table is missing the `$date_end` column."));
		}
		if (!$obj->hasField($version_id)) {
			trigger_error(__("Malformed shadow table. $obj->table is missing the `$version_id` column."));
		}
	}
		
	/**
	 * Generates a shadow table name from a class name
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	function __shadowName($name) {
		return strtolower(Inflector::underscore(Inflector::singularize($name))) . '_versions';
	}
	
	/**
	 * Rewrites the referenced model+associations to use shadow tables
	 *
	 * @param object $model
	 * @param string/integer $date
	 * @param boolean $bypass
	 * @return object
	 */
	function revision($model, $date = null, $bypass = false) {
		
		extract($this->settings[$model->alias]);
		$db = ConnectionManager::getDataSource($model->useDbConfig);
		$model->setSource($this->__shadowName($model->alias));
		
		if (!$bypass) {
			$model->date = $this->__getDate($model, $date);
		}
		
		unset($model->validate);
		
		$tables  = $db->listSources();
		
		foreach ($model->__associations as $association) {
			foreach ($model->$association as $name => $assoc) {
			
				$obj   = clone(ClassRegistry::getObject($name));
				$alias = $obj->alias;
				$table = $this->__shadowName($obj->table);
				
				if (!in_array($db->config['prefix'].$table, $tables) || !isset($this->settings[$obj->alias])) {
					unset($model->{$association}[$name]);
					unset($model->$name);
					if ($showErrors) {
						trigger_error('Could not locate shadow table: '.$table);
					} else {
						continue;
					}
				}
				$obj->setSource($table);
				$this->__checkSchema($obj);
				
				switch($association) {
					case 'hasAndBelongsToMany':
						if (!strstr($assoc['joinTable'], 'version')) {
							$model->{$association}[$alias]['joinTable'] = Inflector::singularize($assoc['joinTable']) . '_versions';
						}
						if (!$bypass) {
							$model->{$association}[$alias]['conditions'] = am($assoc['conditions'], array(
								'OR' => array(
									"'$model->date' BETWEEN {$assoc['with']}.$date_start AND {$assoc['with']}.$date_end",
									"'$model->date' >= {$assoc['with']}.$date_start AND {$assoc['with']}.$date_end IS NULL"
								)
							));
						}
						$model->{$alias} = $obj;
						break;
					default:
						if (!$bypass) {
							$model->{$association}[$alias]['conditions'] = am($assoc['conditions'], array(
								'OR' => array(
									"'$model->date' BETWEEN $alias.$date_start AND $alias.$date_end",
									"'$model->date' >= $alias.$date_start AND $alias.$date_end IS NULL"
								)
							));
						}
						$model->{$alias} = $obj;
				}
			}
		}
		return $model;
	}
			
}

?>