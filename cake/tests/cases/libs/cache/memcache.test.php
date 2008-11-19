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
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package       cake.tests
 * @subpackage    cake.tests.cases.libs.cache
 * @since         CakePHP(tm) v 1.2.0.5434
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
if (!class_exists('Cache')) {
	require LIBS . 'cache.php';
}/**
 * Short description for class.
 *
 * @package       cake.tests
 * @subpackage    cake.tests.cases.libs.cache
 */
/**
 * MemcacheEngineTest class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.cache
 */
class MemcacheEngineTest extends CakeTestCase {
/**
 * skip method
 *
 * @access public
 * @return void
 */
	function skip() {
		$skip = true;
		if (Cache::engine('Memcache')) {
			$skip = false;
		}
		$this->skipIf($skip, 'Memcache is not installed or configured properly');
	}
/**
 * setUp method
 *
 * @access public
 * @return void
 */
	function setUp() {
		Cache::config('memcache', array('engine'=>'Memcache', 'prefix' => 'cake_'));
	}
/**
 * tearDown method
 *
 * @access public
 * @return void
 */
	function tearDown() {
		Cache::config('default');
	}
/**
 * testSettings method
 *
 * @access public
 * @return void
 */
	function testSettings() {
		$settings = Cache::settings();
		$expecting = array('prefix' => 'cake_',
						'duration'=> 3600,
						'probability' => 100,
						'servers' => array('127.0.0.1'),
						'compress' => false,
						'engine' => 'Memcache'
						);
		$this->assertEqual($settings, $expecting);
	}
/**
 * testSettings method
 *
 * @access public
 * @return void
 */
	function testMultipleServers() {
		$servers = array('127.0.0.1:11211', '127.0.0.1:11222');

		$Cache =& Cache::getInstance();
		$MemCache =& $Cache->_Engine['Memcache'];

		$available = true;
		foreach($servers as $server) {
			list($host, $port) = explode(':', $server);
			if (!@$MemCache->__Memcache->connect($host, $port)) {
				$available = false;
			}
		}

		if ($this->skipIf(!$available, 'Need memcache servers at ' . implode(', ', $servers) . ' to run this test')) {
			return;
		}

		unset($MemCache->__Memcache);
		$MemCache->init(array('engine' => 'Memcache', 'servers' => $servers));

		$servers = array_keys($MemCache->__Memcache->getExtendedStats());
		$settings = Cache::settings();
		$this->assertEqual($servers, $settings['servers']);
	}
/**
 * testConnect method
 *
 * @access public
 * @return void
 */
	function testConnect() {
		$Cache =& Cache::getInstance();
		$result = $Cache->_Engine['Memcache']->connect('127.0.0.1');
		$this->assertTrue($result);
	}

/**
 * testReadAndWriteCache method
 *
 * @access public
 * @return void
 */
	function testReadAndWriteCache() {
		$result = Cache::read('test');
		$expecting = '';
		$this->assertEqual($result, $expecting);

		$data = 'this is a test of the emergency broadcasting system';
		$result = Cache::write('test', $data, 1);
		$this->assertTrue($result);

		$result = Cache::read('test');
		$expecting = $data;
		$this->assertEqual($result, $expecting);
	}
/**
 * testExpiry method
 *
 * @access public
 * @return void
 */
	function testExpiry() {
		sleep(2);
		$result = Cache::read('test');
		$this->assertFalse($result);

		$data = 'this is a test of the emergency broadcasting system';
		$result = Cache::write('other_test', $data, 1);
		$this->assertTrue($result);

		sleep(2);
		$result = Cache::read('other_test');
		$this->assertFalse($result);

		$data = 'this is a test of the emergency broadcasting system';
		$result = Cache::write('other_test', $data, "+1 second");
		$this->assertTrue($result);

		sleep(2);
		$result = Cache::read('other_test');
		$this->assertFalse($result);

		$data = 'this is a test of the emergency broadcasting system';
		$result = Cache::write('other_test', $data);
		$this->assertTrue($result);

		$result = Cache::read('other_test');
		$this->assertEqual($result, $data);

		Cache::engine('Memcache', array('duration' => '+1 second'));
		sleep(2);

		$result = Cache::read('other_test');
		$this->assertFalse($result);

		Cache::engine('Memcache', array('duration' => 3600));
	}
/**
 * testDeleteCache method
 *
 * @access public
 * @return void
 */
	function testDeleteCache() {
		$data = 'this is a test of the emergency broadcasting system';
		$result = Cache::write('delete_test', $data);
		$this->assertTrue($result);

		$result = Cache::delete('delete_test');
		$this->assertTrue($result);
	}
}
?>
