#!/usr/bin/php -q
<?php
/**
 * Command-line code generation utility to automate programmer chores.
 *
 * Shell dispatcher class
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008,	Cake Software Foundation, Inc.
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console
 * @since         CakePHP(tm) v 1.2.0.5012
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
if (!defined('E_DEPRECATED')) {
	define('E_DEPRECATED', 8192);
}
/**
 * Shell dispatcher
 *
 * @package       cake
 * @subpackage    cake.cake.console
 */
class ShellDispatcher {

/**
 * Standard input stream.
 *
 * @var filehandle
 * @access public
 */
	var $stdin;

/**
 * Standard output stream.
 *
 * @var filehandle
 * @access public
 */
	var $stdout;

/**
 * Standard error stream.
 *
 * @var filehandle
 * @access public
 */
	var $stderr;

/**
 * Contains command switches parsed from the command line.
 *
 * @var array
 * @access public
 */
	var $params = array();

/**
 * Contains arguments parsed from the command line.
 *
 * @var array
 * @access public
 */
	var $args = array();

/**
 * The file name of the shell that was invoked.
 *
 * @var string
 * @access public
 */
	var $shell = null;

/**
 * The class name of the shell that was invoked.
 *
 * @var string
 * @access public
 */
	var $shellClass = null;

/**
 * The command called if public methods are available.
 *
 * @var string
 * @access public
 */
	var $shellCommand = null;

/**
 * The path locations of shells.
 *
 * @var array
 * @access public
 */
	var $shellPaths = array();

/**
 * The path to the current shell location.
 *
 * @var string
 * @access public
 */
	var $shellPath = null;

/**
 * The name of the shell in camelized.
 *
 * @var string
 * @access public
 */
	var $shellName = null;

/**
 * Constructs this ShellDispatcher instance.
 *
 * @param array $args the argv.
 */
	function ShellDispatcher($args = array()) {
		$this->__construct($args);
	}

/**
 * Constructor
 *
 * The execution of the script is stopped after dispatching the request with
 * a status code of either 0 or 1 according to the result of the dispatch.
 *
 * @param array $args the argv
 * @return void
 * @access public
 */
	function __construct($args = array()) {
		set_time_limit(0);

		$this->__initConstants();
		$this->parseParams($args);
		$this->_initEnvironment();
		$this->__buildPaths();
		$this->_stop($this->dispatch() === false ? 1 : 0);
	}

/**
 * Defines core configuration.
 *
 * @access private
 */
	function __initConstants() {
		if (function_exists('ini_set')) {
			ini_set('display_errors', '1');
			ini_set('error_reporting', E_ALL);
			ini_set('html_errors', false);
			ini_set('implicit_flush', true);
			ini_set('max_execution_time', 0);
		}

		if (!defined('CAKE_CORE_INCLUDE_PATH')) {
			define('PHP5', (PHP_VERSION >= 5));
			define('DS', DIRECTORY_SEPARATOR);
			define('CAKE_CORE_INCLUDE_PATH', dirname(dirname(dirname(__FILE__))));
			define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
			define('DISABLE_DEFAULT_ERROR_HANDLING', false);
			define('CAKEPHP_SHELL', true);
		}
		require_once(CORE_PATH . 'cake' . DS . 'basics.php');
	}

/**
 * Defines current working environment.
 *
 * @access protected
 */
	function _initEnvironment() {
		$this->stdin = fopen('php://stdin', 'r');
		$this->stdout = fopen('php://stdout', 'w');
		$this->stderr = fopen('php://stderr', 'w');

		if (!$this->__bootstrap()) {
			$this->stderr("\nCakePHP Console: ");
			$this->stderr("\nUnable to load Cake core:");
			$this->stderr("\tMake sure " . DS . 'cake' . DS . 'libs exists in ' . CAKE_CORE_INCLUDE_PATH);
			$this->_stop();
		}

		if (!isset($this->args[0]) || !isset($this->params['working'])) {
			$this->stderr("\nCakePHP Console: ");
			$this->stderr('This file has been loaded incorrectly and cannot continue.');
			$this->stderr('Please make sure that ' . DIRECTORY_SEPARATOR . 'cake' . DIRECTORY_SEPARATOR . 'console is in your system path,');
			$this->stderr('and check the manual for the correct usage of this command.');
			$this->stderr('(http://manual.cakephp.org/)');
			$this->_stop();
		}

		if (basename(__FILE__) !=  basename($this->args[0])) {
			$this->stderr("\nCakePHP Console: ");
			$this->stderr('Warning: the dispatcher may have been loaded incorrectly, which could lead to unexpected results...');
			if ($this->getInput('Continue anyway?', array('y', 'n'), 'y') == 'n') {
				$this->_stop();
			}
		}

		$this->shiftArgs();
	}

/**
 * Builds the shell paths.
 *
 * @access private
 * @return void
 */
	function __buildPaths() {
		$paths = array();
		$pluginPaths = App::path('plugins');
		if (!class_exists('Folder')) {
			require LIBS . 'folder.php';
		}
		foreach ($pluginPaths as $pluginPath) {
			$Folder =& new Folder($pluginPath);
			list($plugins,) = $Folder->read(false, true);
			foreach ((array)$plugins as $plugin) {
				$path = $pluginPath . Inflector::underscore($plugin) . DS . 'vendors' . DS . 'shells' . DS;
				if (file_exists($path)) {
					$paths[] = $path;
				}
			}
		}

		$vendorPaths = array_values(App::path('vendors'));
		foreach ($vendorPaths as $vendorPath) {
			$path = rtrim($vendorPath, DS) . DS . 'shells' . DS;
			if (file_exists($path)) {
				$paths[] = $path;
			}
		}

		$this->shellPaths = array_values(array_unique(array_merge($paths, App::path('shells'))));
	}

/**
 * Initializes the environment and loads the Cake core.
 *
 * @return boolean Success.
 * @access private
 */
	function __bootstrap() {

		define('ROOT', $this->params['root']);
		define('APP_DIR', $this->params['app']);
		define('APP_PATH', $this->params['working'] . DS);
		define('WWW_ROOT', APP_PATH . $this->params['webroot'] . DS);

		$includes = array(
			CORE_PATH . 'cake' . DS . 'config' . DS . 'paths.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'object.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'inflector.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'configure.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'file.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'cache.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'string.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'class_registry.php',
			CORE_PATH . 'cake' . DS . 'console' . DS . 'error.php'
		);

		foreach ($includes as $inc) {
			if (!require($inc)) {
				$this->stderr("Failed to load Cake core file {$inc}");
				return false;
			}
		}

		Configure::getInstance(file_exists(CONFIGS . 'bootstrap.php'));

		if (!file_exists(APP_PATH . 'config' . DS . 'core.php')) {
			include_once CORE_PATH . 'cake' . DS . 'console' . DS . 'templates' . DS . 'skel' . DS . 'config' . DS . 'core.php';
			App::build();
		}

		Configure::write('debug', 1);
		return true;
	}

/**
 * Clear the console
 *
 * @return void
 * @access public
 */
	function clear() {
		if (empty($this->params['noclear'])) {
			if ( DS === '/') {
				passthru('clear');
			} else {
				passthru('cls');
			}
		}
	}

/**
 * Dispatches a CLI request
 *
 * @return boolean
 * @access public
 */
	function dispatch() {
		$arg = $this->shiftArgs();

		if (!$arg) {
			$this->help();
			return false;
		}
		if ($arg == 'help') {
			$this->help();
			return true;
		}

		if (strpos($arg, '.') !== false)  {
			list($plugin, $shell) = explode('.', $arg);
		} else {
			$plugin = null;
			$shell = $arg;
		}
		$this->shell = $shell;
		$this->shellName = Inflector::camelize($shell);
		$this->shellClass = $this->shellName . 'Shell';

		$arg = null;

		if (isset($this->args[0])) {
			$arg = $this->args[0];
			$this->shellCommand = Inflector::variable($arg);
		}

		$Shell = $this->_getShell($plugin);

		if (!$Shell) {
			$title = sprintf(__('Error: Class %s could not be loaded.', true), $this->shellClass);
			$this->stderr($title . "\n");
			return false;
		}

		$methods = array();

		if (is_a($Shell, 'Shell')) {
			$Shell->initialize();
			$Shell->loadTasks();

			foreach ($Shell->taskNames as $task) {
				if (is_a($Shell->{$task}, 'Shell')) {
					$Shell->{$task}->initialize();
					$Shell->{$task}->loadTasks();
				}
			}

			$task = Inflector::camelize($arg);

			if (in_array($task, $Shell->taskNames)) {
				$this->shiftArgs();
				$Shell->{$task}->startup();

				if (isset($this->args[0]) && $this->args[0] == 'help') {
					if (method_exists($Shell->{$task}, 'help')) {
						$Shell->{$task}->help();
					} else {
						$this->help();
					}
					return true;
				}
				return $Shell->{$task}->execute();
			}
			$methods = array_diff(get_class_methods('Shell'), array('help'));
		}
		$methods = array_diff(get_class_methods($Shell), $methods);
		$added = in_array(strtolower($arg), array_map('strtolower', $methods));
		$private = $arg[0] == '_' && method_exists($Shell, $arg);

		if (!$private) {
			if ($added) {
				$this->shiftArgs();
				$Shell->startup();
				return $Shell->{$arg}();
			}
			if (method_exists($Shell, 'main')) {
				$Shell->startup();
				return $Shell->main();
			}
		}

		$title = sprintf(__('Error: Unknown %1$s command %2$s.', true), $this->shellName, $arg);
		$message = sprintf(__('For usage try `cake %s help`', true), $this->shell);
		$this->stderr($title . "\n" . $message . "\n");
		return false;
	}
/**
 * Get shell to use, either plugin shell or application shell
 *
 * All paths in the shellPaths property are searched.
 * shell, shellPath and shellClass properties are taken into account.
 *
 * @param string $plugin Optionally the name of a plugin
 * @return mixed False if no shell could be found or an object on success
 * @access protected
 */
	function _getShell($plugin = null) {
		foreach ($this->shellPaths as $path) {
			$this->shellPath = $path . $this->shell . '.php';
			$pluginShellPath =  DS . $plugin . DS . 'vendors' . DS . 'shells' . DS;

			if ((strpos($path, $pluginShellPath) !== false || !$plugin) && file_exists($this->shellPath)) {
				$loaded = true;
				break;
			}
		}
		if (!isset($loaded)) {
			return false;
		}

		if (!class_exists('Shell')) {
			require CONSOLE_LIBS . 'shell.php';
		}

		if (!class_exists($this->shellClass)) {
			require $this->shellPath;
		}
		if (!class_exists($this->shellClass)) {
			return false;
		}
		$Shell = new $this->shellClass($this);
		return $Shell;
	}

/**
 * Prompts the user for input, and returns it.
 *
 * @param string $prompt Prompt text.
 * @param mixed $options Array or string of options.
 * @param string $default Default input value.
 * @return Either the default value, or the user-provided input.
 * @access public
 */
	function getInput($prompt, $options = null, $default = null) {
		if (!is_array($options)) {
			$printOptions = '';
		} else {
			$printOptions = '(' . implode('/', $options) . ')';
		}

		if ($default == null) {
			$this->stdout($prompt . " $printOptions \n" . '> ', false);
		} else {
			$this->stdout($prompt . " $printOptions \n" . "[$default] > ", false);
		}
		$result = fgets($this->stdin);

		if ($result === false) {
			exit;
		}
		$result = trim($result);

		if ($default != null && empty($result)) {
			return $default;
		}
		return $result;
	}

/**
 * Outputs to the stdout filehandle.
 *
 * @param string $string String to output.
 * @param boolean $newline If true, the outputs gets an added newline.
 * @access public
 */
	function stdout($string, $newline = true) {
		if ($newline) {
			fwrite($this->stdout, $string . "\n");
		} else {
			fwrite($this->stdout, $string);
		}
	}

/**
 * Outputs to the stderr filehandle.
 *
 * @param string $string Error text to output.
 * @access public
 */
	function stderr($string) {
		fwrite($this->stderr, $string);
	}

/**
 * Parses command line options
 *
 * @param array $params Parameters to parse
 * @access public
 */
	function parseParams($params) {
		$this->__parseParams($params);
		$defaults = array('app' => 'app', 'root' => dirname(dirname(dirname(__FILE__))), 'working' => null, 'webroot' => 'webroot');
		$params = array_merge($defaults, array_intersect_key($this->params, $defaults));
		$isWin = false;
		foreach ($defaults as $default => $value) {
			if (strpos($params[$default], '\\') !== false) {
				$isWin = true;
				break;
			}
		}
		$params = str_replace('\\', '/', $params);

		if (!empty($params['working']) && (!isset($this->args[0]) || isset($this->args[0]) && $this->args[0]{0} !== '.')) {
			if (empty($this->params['app']) && $params['working'] != $params['root']) {
				$params['root'] = dirname($params['working']);
				$params['app'] = basename($params['working']);
			} else {
				$params['root'] = $params['working'];
			}
		}

		if ($params['app'][0] == '/' || preg_match('/([a-z])(:)/i', $params['app'], $matches)) {
			$params['root'] = dirname($params['app']);
		} elseif (strpos($params['app'], '/')) {
			$params['root'] .= '/' . dirname($params['app']);
		}

		$params['app'] = basename($params['app']);
		$params['working'] = rtrim($params['root'], '/') . '/' . $params['app'];

		if (!empty($matches[0]) || !empty($isWin)) {
			$params = str_replace('/', '\\', $params);
		}

		$this->params = array_merge($this->params, $params);
	}

/**
 * Helper for recursively parsing params
 *
 * @return array params
 * @access private
 */
	function __parseParams($params) {
		$count = count($params);
		for ($i = 0; $i < $count; $i++) {
			if (isset($params[$i])) {
				if ($params[$i]{0} === '-') {
					$key = substr($params[$i], 1);
					$this->params[$key] = true;
					unset($params[$i]);
					if (isset($params[++$i])) {
						if ($params[$i]{0} !== '-') {
							$this->params[$key] = str_replace('"', '', $params[$i]);
							unset($params[$i]);
						} else {
							$i--;
							$this->__parseParams($params);
						}
					}
				} else {
					$this->args[] = $params[$i];
					unset($params[$i]);
				}

			}
		}
	}

/**
 * Removes first argument and shifts other arguments up
 *
 * @return mixed Null if there are no arguments otherwise the shifted argument
 * @access public
 */
	function shiftArgs() {
		return array_shift($this->args);
	}

/**
 * Shows console help
 *
 * @access public
 */
	function help() {
		$this->clear();
		$this->stdout("\nWelcome to CakePHP v" . Configure::version() . " Console");
		$this->stdout("---------------------------------------------------------------");
		$this->stdout("Current Paths:");
		$this->stdout(" -app: ". $this->params['app']);
		$this->stdout(" -working: " . rtrim($this->params['working'], DS));
		$this->stdout(" -root: " . rtrim($this->params['root'], DS));
		$this->stdout(" -core: " . rtrim(CORE_PATH, DS));
		$this->stdout("");
		$this->stdout("Changing Paths:");
		$this->stdout("your working path should be the same as your application path");
		$this->stdout("to change your path use the '-app' param.");
		$this->stdout("Example: -app relative/path/to/myapp or -app /absolute/path/to/myapp");

		$this->stdout("\nAvailable Shells:");
		$_shells = array();
		foreach ($this->shellPaths as $path) {
			if (is_dir($path)) {
				$shells = App::objects('file', $path);
				$path = str_replace(CAKE_CORE_INCLUDE_PATH . DS . 'cake' . DS, 'CORE' . DS, $path);
				$path = str_replace(APP, 'APP' . DS, $path);
				$path = str_replace(ROOT, 'ROOT', $path);
				$path = rtrim($path, DS);
				$this->stdout("\n " . $path . ":");
				if (empty($shells)) {
					$this->stdout("\t - none");
				} else {
					sort($shells);
					foreach ($shells as $shell) {

						if ($shell !== 'shell.php') {
							$this->stdout("\t " . str_replace('.php', '', $shell));
						}
					}
				}
			}
		}
		$this->stdout("\nTo run a command, type 'cake shell_name [args]'");
		$this->stdout("To get help on a specific command, type 'cake shell_name help'");
	}

/**
 * Stop execution of the current script
 *
 * @param $status see http://php.net/exit for values
 * @return void
 * @access protected
 */
	function _stop($status = 0) {
		exit($status);
	}
}
if (!defined('DISABLE_AUTO_DISPATCH')) {
	$dispatcher = new ShellDispatcher($argv);
}
?>