<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link			https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.console
 * @since			CakePHP(tm) v 1.2.0.5432
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
if (!defined('DISABLE_AUTO_DISPATCH')) {
	define('DISABLE_AUTO_DISPATCH', true);
}

if (!class_exists('ShellDispatcher')) {
	ob_start();
	$argv = false;
	require CAKE . 'console' .  DS . 'cake.php';
	ob_end_clean();
}

class TestShellDispatcher extends ShellDispatcher {

	var $params = array();

	function __construct($args = array()) {
		set_time_limit(0);
		$this->__initConstants();
		$this->parseParams($args);
	}

}
/**
 * Short description for class.
 *
 * @package    cake.tests
 * @subpackage cake.tests.cases.libs
 */
class ShellDispatcherTest extends UnitTestCase {

	function testParseParams() {
		$Dispatcher =& new TestShellDispatcher();

		$params = array(
			'/cake/1.2.x.x/cake/console/cake.php',
			'bake',
			'-app',
			'new',
			'-working',
			'/var/www/htdocs'
		);

		$expected = array(
			'app' => 'new',
			'webroot' => 'webroot',
			'working' => '/var/www/htdocs/new',
			'root' => '/var/www/htdocs'
		);

		$Dispatcher->parseParams($params);

		$this->assertEqual($expected, $Dispatcher->params);


		$params = array('cake.php');

		$expected = array(
			'app' => 'app',
			'webroot' => 'webroot',
			'working' => ROOT . DS . 'app',
			'root' => ROOT,
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);


		$params = array(
			'cake.php',
			'-app',
			'new',
		);

		$expected = array(
			'app' => 'new',
			'webroot' => 'webroot',
			'working' => ROOT . DS . 'new',
			'root' => ROOT
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);


		$params = array(
			'./cake.php',
			'bake',
			'-app',
			'new',
			'-working',
			'/cake/1.2.x.x/cake/console'
		);

		$expected = array(
			'app' => 'new',
			'webroot' => 'webroot',
			'working' => ROOT . DS . 'new',
			'root' => ROOT
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);


		$params = array(
			'./console/cake.php',
			'bake',
			'-app',
			'new',
			'-working',
			'/cake/1.2.x.x/cake'
		);

		$expected = array(
			'app' => 'new',
			'webroot' => 'webroot',
			'working' => ROOT . DS . 'new',
			'root' => ROOT
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);

		$params = array(
			'./console/cake.php',
			'bake',
			'-app',
			'new',
			'-dry',
			'-working',
			'/cake/1.2.x.x/cake'
		);

		$expected = array(
			'app' => 'new',
			'webroot' => 'webroot',
			'working' => ROOT . DS . 'new',
			'root' => ROOT,
			'dry' => 1
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);

		$params = array(
			'./console/cake.php',
			'-working',
			'/cake/1.2.x.x/cake',
			'schema',
			'run',
			'create',
			'-dry',
			'-f',
			'-name',
			'DbAcl'
		);

		$expected = array(
			'app' => 'app',
			'webroot' => 'webroot',
			'working' => ROOT . DS . 'app',
			'root' => ROOT,
			'dry' => 1,
			'f' => 1,
			'name' => 'DbAcl'
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);

		$expected = array('./console/cake.php', 'schema', 'run', 'create');
		$this->assertEqual($expected, $Dispatcher->args);

		$params = array(
			'/cake/1.2.x.x/cake/console/cake.php',
			'-working',
			'/cake/1.2.x.x/app',
			'schema',
			'run',
			'create',
			'-dry',
			'-name',
			'DbAcl'
		);

		$expected = array(
			'app' => 'app',
			'webroot' => 'webroot',
			'working' => '/cake/1.2.x.x/app',
			'root' => '/cake/1.2.x.x',
			'dry' => 1,
			'name' => 'DbAcl'
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);

		$expected = array('/cake/1.2.x.x/cake/console/cake.php', 'schema', 'run', 'create');
		$this->assertEqual($expected, $Dispatcher->args);

		$params = array(
			'cake.php',
			'-working',
			'C:/wamp/www/cake/app',
			'bake',
			'-app',
			'C:/wamp/www/apps/cake/app',
		);

		$expected = array(
			'app' => 'app',
			'webroot' => 'webroot',
			'working' => 'C:\wamp\www\apps\cake\app',
			'root' => 'C:\wamp\www\apps\cake'
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);

		$params = array(
			'cake.php',
			'-working',
			'C:\wamp\www\cake\app',
			'bake',
			'-app',
			'C:\wamp\www\apps\cake\app',
		);

		$expected = array(
			'app' => 'app',
			'webroot' => 'webroot',
			'working' => 'C:\wamp\www\apps\cake\app',
			'root' => 'C:\wamp\www\apps\cake'
		);

		$Dispatcher->params = $Dispatcher->args = array();
		$Dispatcher->parseParams($params);
		$this->assertEqual($expected, $Dispatcher->params);

	}
}
?>