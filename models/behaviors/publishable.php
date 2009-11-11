<?php
/**
 * Model behavior to support soft deleting records.
 *
 * @package app
 * @subpackage app.models.behaviors
 */
class PublishableBehavior extends ModelBehavior
{
	/**
	 * Contain settings indexed by model name.
	 *
	 * @var array
	 * @access private
	 */
	var $__settings = array();

	/**
	 * Initiate behaviour for the model using settings.
	 *
	 * @param object $Model Model using the behaviour
	 * @param array $settings Settings to override for model.
	 * @access public
	 */
	function setup(&$Model, $settings = array())
	{
		$default = array('field' => 'published', 'userIdField' => 'user_id', 'find' => true, 'userVisible' => true);

		if (!isset($this->__settings[$Model->alias]))
		{
			$this->__settings[$Model->alias] = $default;
		}

		$this->__settings[$Model->alias] = am($this->__settings[$Model->alias], ife(is_array($settings), $settings, array()));
	}

	function setUser(&$Model, $userId)
	{
		$this->__settings[$Model->alias]['userId'] = $userId;
	}

	function enablePublishable(&$Model, $methods, $enable = true)
	{
		if (is_bool($methods))
		{
			$enable = $methods;
			$methods = array('find', 'userVisible');
		}

		if (!is_array($methods))
		{
			$methods = array($methods);
		}

		foreach($methods as $method)
		{
			$this->__settings[$Model->alias][$method] = $enable;
		}
	}

	/**
	 * Run before a model is about to be find, used only fetch for published records.
	 *
	 * @param object $Model Model about to be found.
	 * @param array $queryData Data used to execute this query, i.e. conditions, order, etc.
	 * @return mixed Set to false to abort find operation, or return an array with data used to execute query
	 * @access public
	 */
	function beforeFind(&$Model, $queryData)
	{
		if ($this->__settings[$Model->alias]['find'] && $Model->hasField($this->__settings[$Model->alias]['field']))
		{
			$Db =& ConnectionManager::getDataSource($Model->useDbConfig);
			$include = false;

			if (!empty($queryData['conditions']) && is_string($queryData['conditions']))
			{
				$include = true;

				$fields = array(
					$Db->name($Model->alias) . '.' . $Db->name($this->__settings[$Model->alias]['field']),
					$Db->name($this->__settings[$Model->alias]['field']),
					$Model->alias . '.' . $this->__settings[$Model->alias]['field'],
					$this->__settings[$Model->alias]['field']
				);

				foreach($fields as $field)
				{
					if (preg_match('/^' . preg_quote($field) . '[\s=!]+/i', $queryData['conditions']) || preg_match('/\\x20+' . preg_quote($field) . '[\s=!]+/i', $queryData['conditions']))
					{
						$include = false;
						break;
					}
				}
			}
			else if (empty($queryData['conditions']) || (!in_array($this->__settings[$Model->alias]['field'], array_keys($queryData['conditions'])) && !in_array($Model->alias . '.' . $this->__settings[$Model->alias]['field'], array_keys($queryData['conditions']))))
			{
				$include = true;
			}

			if ($include)
			{
				if (empty($queryData['conditions']))
				{
					$queryData['conditions'] = array();
				}

				if (is_string($queryData['conditions']))
				{
					$condition = $Db->name($Model->alias) . '.' . $Db->name($this->__settings[$Model->alias]['field']) . '= 1';
					if ($this->__settings[$Model->alias]['userVisible'] && isset($this->__settings[$Model->alias]['userId']))
					{
						$condition = ' OR ' . $Db->name($Model->alias) . '.' . $Db->name($this->__settings[$Model->alias]['userIdField']) . ' = ' . $this->__settings[$Model->alias]['userId'];
					}
					$queryData['conditions'] = '(' . $condition . ') AND ' . $queryData['conditions'];
				}
				else
				{
					$queryData['conditions']['or'][$Model->alias . '.' . $this->__settings[$Model->alias]['field']] = '1';
					if ($this->__settings[$Model->alias]['userVisible'] && isset($this->__settings[$Model->alias]['userId']))
					{
						$queryData['conditions']['or'][$Model->alias . '.' . $this->__settings[$Model->alias]['userIdField']] = $this->__settings[$Model->alias]['userId'];
					}
				}
			}
		}

		return $queryData;
	}
}
?>