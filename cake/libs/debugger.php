<?php
/* SVN FILE: $Id$ */
/**
 * Framework debugging and PHP error-handling class
 *
 * Provides enhanced logging, stack traces, and rendering debug views
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
 * @subpackage		cake.cake.libs
 * @since			CakePHP(tm) v 1.2.4560
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Included libraries.
 *
 */
	if (!class_exists('Object')) {
		 uses('object');
	}
	uses('cake_log');
/**
 * Provide custom logging and error handling.
 *
 * Debugger overrides PHP's default error handling to provide stack traces and enhanced logging
 *
 * @package		cake
 * @subpackage	cake.cake.libs
 */
class Debugger extends Object {

/**
 * Holds a reference to errors generated by the application
 *
 * @var array
 * @access public
 */
	var $errors = array();
/**
 * Contains the base URL for error code documentation
 *
 * @var string
 * @access public
 */
	var $helpPath = null;
/**
 * Constructor
 *
 */
	function __construct() {
		$docRef = ini_get('docref_root');
		if (empty($docRef)) {
			ini_set('docref_root', 'http://php.net/');
		}
		if (!defined('E_RECOVERABLE_ERROR')) {
			define('E_RECOVERABLE_ERROR', 4096);
		}
		if (Configure::read() > 0) {
			Configure::version(); // Make sure the core config is loaded
			$this->helpPath = Configure::read('Cake.Debugger.HelpPath');
		}
	}
/**
 * Gets a reference to the Debugger object instance
 *
 * @return object
 */
	function &getInstance() {
		static $instance = array();

		if (!isset($instance[0]) || !$instance[0]) {
			$instance[0] = &new Debugger();
		}
		return $instance[0];
	}
/**
 * Overrides PHP's default error handling
 *
 * @param int $code
 * @param string $description
 * @param string $file
 * @param int $line
 * @param array $context
 * @return void
 */
	function handleError($code, $description, $file = null, $line = null, $context = null) {
		if (error_reporting() == 0) {
			// Error suppression (@) enabled
			return;
		}

		if (empty($file)) {
			$file = '[internal]';
		}
		if (empty($line)) {
			$line = '??';
		}
		$file = $this->trimPath($file);

		$info = compact('code', 'description', 'file', 'line');
		if (!in_array($info, $this->errors)) {
			$this->errors[] = $info;
		} else {
			return;
		}

		$level = LOG_DEBUG;
		switch ($code) {
			case E_PARSE:
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
				$error = 'Fatal Error';
				$level = LOG_ERROR;
			break;
			case E_WARNING:
			case E_USER_WARNING:
			case E_COMPILE_WARNING:
			case E_RECOVERABLE_ERROR:
				$error = 'Warning';
				$level = LOG_WARNING;
			break;
			case E_NOTICE:
				$error = 'Notice';
				$level = LOG_NOTICE;
			break;
			default:
				return false;
			break;
		}

		$helpCode = null;
		if (!empty($this->helpPath) && preg_match('/.*\[([0-9]+)\]$/', $description, $codes)) {
			if (isset($codes[1])) {
				$helpCode = $codes[1];
				$description = trim(preg_replace('/\[[0-9]+\]$/', '', $description));
			}
		}

		$link = "document.getElementById(\"CakeStackTrace" . count($this->errors) . "\").style.display = (document.getElementById(\"CakeStackTrace" . count($this->errors) . "\").style.display == \"none\" ? \"\" : \"none\")";
		$out = "<a href='javascript:void(0);' onclick='{$link}'><b>{$error}</b> ({$code})</a>: {$description} [<b>{$file}</b>, line <b>{$line}</b>]";

		if (Configure::read() > 0) {
			debug($out);
			e('<div id="CakeStackTrace' . count($this->errors) . '" class="cake-stack-trace" style="display: none;">');
			if (!empty($context)) {
				$link = "document.getElementById(\"CakeErrorContext" . count($this->errors) . "\").style.display = (document.getElementById(\"CakeErrorContext" . count($this->errors) . "\").style.display == \"none\" ? \"\" : \"none\")";
				e("<a href='javascript:void(0);' onclick='{$link}'>Context</a> | ");
				$link = "document.getElementById(\"CakeErrorCode" . count($this->errors) . "\").style.display = (document.getElementById(\"CakeErrorCode" . count($this->errors) . "\").style.display == \"none\" ? \"\" : \"none\")";
				e("<a href='javascript:void(0);' onclick='{$link}'>Code</a>");

				if (!empty($helpCode)) {
					e(" | <a href='{$this->helpPath}{$helpCode}' target='blank'>Help</a>");
				}

				e("<pre id=\"CakeErrorContext" . count($this->errors) . "\" class=\"cake-context\" style=\"display: none;\">");
				foreach ($context as $var => $value) {
					e("\${$var}\t=\t" . $this->exportVar($value, 1) . "\n");
				}
				e("</pre>");
			}
		}

		$files = $this->trace(array('start' => 1, 'format' => 'points'));
		$listing = Debugger::excerpt($files[0]['file'], $files[0]['line'] - 1, 2);

		if (Configure::read() > 0) {
			e("<div id=\"CakeErrorCode" . count($this->errors) . "\" class=\"cake-code-dump\" style=\"display: none;\">");
			pr(implode("\n", $listing));
			e('</div>');

			pr($this->trace(array('start' => 1)));
			e('</div>');
		}

		if (Configure::read('log')) {
			CakeLog::write($level, "{$error} ({$code}): {$description} in [{$file}, line {$line}]");
		}
		
		if ($error == 'Fatal Error') {
			die();
		}	
		return true;
	}
/**
 * Outputs a stack trace with the given options
 *
 * @param array $options
 * @return string
 */
	function trace($options = array()) {
		$options = am(array(
				'depth'		=> 999,
				'format'	=> '',
				'args'		=> false,
				'start'		=> 0,
				'scope'		=> null,
				'exclude'	=> null
			),
			$options
		);

		$backtrace = debug_backtrace();
		$back = array();

		for ($i = $options['start']; $i < count($backtrace) && $i < $options['depth']; $i++) {
			$trace = am(
				array(
					'file' => '[internal]',
					'line' => '??'
				),
				$backtrace[$i]
			);

			if (isset($backtrace[$i + 1])) {
				$next = am(
					array(
						'line'		=> '??',
						'file'		=> '[internal]',
						'class'		=> null,
						'function'	=> '[main]'
					),
					$backtrace[$i + 1]
				);
				$function = $next['function'];

				if (!empty($next['class'])) {
					$function = $next['class'] . '::' . $function . '(';
					if ($options['args'] && isset($next['args'])) {
						$args = array();
						foreach ($next['args'] as $arg) {
							$args[] = Debugger::exportVar($arg);
						}
						$function .= join(', ', $args);
					}
					$function .= ')';
				}
			} else {
				$function = '[main]';
			}
			if (in_array($function, array('call_user_func_array', 'trigger_error'))) {
				continue;
			}
			if ($options['format'] == 'points' && $trace['file'] != '[internal]') {
				$back[] = array('file' => $trace['file'], 'line' => $trace['line']);
			} elseif (empty($options['format'])) {
				$back[] = $function . ' - ' . Debugger::trimPath($trace['file']) . ', line ' . $trace['line'];
			}
		}

		if ($options['format'] == 'array' || $options['format'] == 'points') {
			return $back;
		}
		return join("\n", $back);
	}
/**
 * Shortens file paths by replacing the application base path with 'APP', and the CakePHP core
 * path with 'CORE'
 *
 * @param string $path
 * @return string
 */
	function trimPath($path) {
		if (!defined('CAKE_CORE_INCLUDE_PATH') || !defined('APP')) {
			return $path;
		}

		if (strpos($path, CAKE_CORE_INCLUDE_PATH) === 0) {
			$path = r(CAKE_CORE_INCLUDE_PATH, 'CORE', $path);
		} elseif (strpos($path, APP) === 0) {
			$path = r(APP, 'APP' . DS, $path);
		} elseif (strpos($path, ROOT) === 0) {
			$path = r(ROOT, 'ROOT' . DS, $path);
		}
		return $path;
	}
/**
 * Grabs an excerpt from a file and highlights a given line of code
 *
 * @param string $file Absolute path to a PHP file
 * @param int $line Line number to highlight
 * @param int $context Number of lines of context to extract above and below $line
 * @return array
 */
	function excerpt($file, $line, $context = 2) {
		$data = $lines = array();
		$data = @explode("\n", file_get_contents($file));

		if (empty($data) || !isset($data[$line])) {
			return;
		}
		for ($i = $line - ($context + 1); $i < $line + $context; $i++) {
			if (!isset($data[$i])) {
				continue;
			}
			if ($i == $line) {
				$lines[] = '<span class="code-highlight">' . highlight_string($data[$i], true) . '</span>';
			} else {
				$lines[] = highlight_string($data[$i], true);
			}
		}
		return $lines;
	}
/**
 * Converts a variable to a string for debug output
 *
 * @param string $var
 * @return string
 */
	function exportVar($var, $recursion = 0) {
		switch(low(gettype($var))) {
			case 'boolean':
				return ife($var, 'true', 'false');
			break;
			case 'integer':
			case 'double':
				return $var;
			break;
			case 'string':
				return '"' . $var . '"';
			break;
			case 'array':
				$out = 'array(';
				if ($recursion != 0) {
					$vars = array();
					foreach ($var as $key => $val) {
						$vars[] = Debugger::exportVar($key) . ' => ' . Debugger::exportVar($val, $recursion - 1);
					}
					return $out . join(', ', $vars) . ')';
				} else {
					return 'array';
				}
			break;
			case 'resource':
				return low(gettype($var));
			break;
			case 'object':
				return get_class($var) . ' object';
			break;
			case 'null':
				return 'null';
			break;
		}
	}
/**
 * Verify that the application's salt has been changed from the default value
 *
 */
	function checkSessionKey() {
		if (CAKE_SESSION_STRING == 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi') {
			trigger_error('Please change the value of CAKE_SESSION_STRING in app/config/core.php to a salt value specific to your application', E_USER_NOTICE);
		}
	}
/**
 * Invokes the given debugger object as the current error handler, taking over control from the previous handler
 * in a stack-like hierarchy.
 *
 * @param object $debugger A reference to the Debugger object
 * @return void
 */
	function invoke(&$debugger) {
		set_error_handler(array(&$debugger, 'handleError'));
	}
}

if (!defined('DISABLE_DEFAULT_ERROR_HANDLING')) {
	Debugger::invoke(Debugger::getInstance());
}

?>