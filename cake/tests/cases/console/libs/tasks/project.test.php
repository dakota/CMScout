<?php
/**
 * ProjectTask Test file
 *
 * Test Case for project generation shell task
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2006-2009, Cake Software Foundation, Inc.
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2006-2009, Cake Software Foundation, Inc.
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package       cake
 * @subpackage    cake.tests.cases.console.libs.tasks
 * @since         CakePHP v 1.3.0
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Core', 'Shell');

if (!defined('DISABLE_AUTO_DISPATCH')) {
	define('DISABLE_AUTO_DISPATCH', true);
}

if (!class_exists('ShellDispatcher')) {
	ob_start();
	$argv = false;
	require CAKE . 'console' .  DS . 'cake.php';
	ob_end_clean();
}

if (!class_exists('ProjectTask')) {
	require CAKE . 'console' .  DS . 'libs' . DS . 'tasks' . DS . 'project.php';
}

Mock::generatePartial(
	'ShellDispatcher', 'TestProjectTaskMockShellDispatcher',
	array('getInput', 'stdout', 'stderr', '_stop', '_initEnvironment')
);
Mock::generatePartial(
	'ProjectTask', 'MockProjectTask',
	array('in', '_stop', 'err', 'out', 'createFile')
);

/**
 * ProjectTask Test class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.console.libs.tasks
 */
class ProjectTaskTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 * @access public
 */
	function startTest() {
		$this->Dispatcher =& new TestProjectTaskMockShellDispatcher();
		$this->Dispatcher->shellPaths = Configure::read('shellPaths');
		$this->Task =& new MockProjectTask($this->Dispatcher);
		$this->Task->Dispatch =& $this->Dispatcher;
		$this->Task->path = TMP . 'tests' . DS;
	}

/**
 * tearDown method
 *
 * @return void
 * @access public
 */
	function endTest() {
		ClassRegistry::flush();
	}

/**
 * test bake() method and directory creation.
 *
 * @return void
 **/
	function testBake() {
		$skel = CAKE_CORE_INCLUDE_PATH . DS . CONSOLE_LIBS . 'templates' . DS . 'skel';
		$this->Task->setReturnValueAt(0, 'in', 'y');
		$this->Task->setReturnValueAt(1, 'in', 'n');
		$this->Task->bake($this->Task->path . 'bake_test_app', $skel);

		$path = $this->Task->path . 'bake_test_app';
		$this->assertTrue(is_dir($path), 'No project dir %s');
		$this->assertTrue(is_dir($path . DS . 'controllers'), 'No controllers dir %s');
		$this->assertTrue(is_dir($path . DS . 'controllers' . DS .'components'), 'No components dir %s');
		$this->assertTrue(is_dir($path . DS . 'models'), 'No models dir %s');
		$this->assertTrue(is_dir($path . DS . 'views'), 'No views dir %s');
		$this->assertTrue(is_dir($path . DS . 'views' . DS . 'helpers'), 'No helpers dir %s');
		$this->assertTrue(is_dir($path . DS . 'tests'), 'No tests dir %s');
		$this->assertTrue(is_dir($path . DS . 'tests' . DS . 'cases'), 'No cases dir %s');
		$this->assertTrue(is_dir($path . DS . 'tests' . DS . 'groups'), 'No groups dir %s');
		$this->assertTrue(is_dir($path . DS . 'tests' . DS . 'fixtures'), 'No fixtures dir %s');

		$Folder =& new Folder($this->Task->path . 'bake_test_app');
		$Folder->delete();
	}

}
?>