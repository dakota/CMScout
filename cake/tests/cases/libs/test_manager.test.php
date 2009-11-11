<?php
<<<<<<< HEAD
/* SVN FILE: $Id$ */

=======
>>>>>>> cake1.3/1.3
/**
 * TestManagerTest file
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
<<<<<<< HEAD
 * Copyright 2005-2008, Cake Software Foundation, Inc.
=======
 * Copyright 2005-2009, Cake Software Foundation, Inc.
>>>>>>> cake1.3/1.3
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
<<<<<<< HEAD
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
=======
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
>>>>>>> cake1.3/1.3
 * @link          https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package       cake
 * @subpackage    cake.tests.cases.libs
 * @since         CakePHP(tm) v 1.2.0.4206
<<<<<<< HEAD
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
=======
>>>>>>> cake1.3/1.3
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
App::import('Core', 'TestManager');

/**
 * TestManagerTest class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs
 */
class TestManagerTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 * @access public
 */
	function setUp() {
		$this->Sut =& new TestManager();
		$this->Reporter =& new CakeHtmlReporter();
	}

/**
 * testRunAllTests method
 *
 * @return void
 * @access public
 */
	function testRunAllTests() {
		$folder =& new Folder($this->Sut->_getTestsPath());
		$extension = str_replace('.', '\.', TestManager::getExtension('test'));
		$out = $folder->findRecursive('.*' . $extension);

		$reporter =& new CakeHtmlReporter();
		$list = TestManager::runAllTests($reporter, true);

		$this->assertEqual(count($out), count($list));
	}

/**
 * testRunTestCase method
 *
 * @return void
 * @access public
 */
	function testRunTestCase() {
		$file = md5(time());
		$result = $this->Sut->runTestCase($file, $this->Reporter);
		$this->assertError('Test case ' . $file . ' cannot be found');
		$this->assertFalse($result);

		$file = str_replace(CORE_TEST_CASES, '', __FILE__);
		$result = $this->Sut->runTestCase($file, $this->Reporter, true);
		$this->assertTrue($result);
	}

/**
 * testRunGroupTest method
 *
 * @return void
 * @access public
 */
	function testRunGroupTest() {
	}

/**
 * testAddTestCasesFromDirectory method
 *
 * @return void
 * @access public
 */
	function testAddTestCasesFromDirectory() {
	}

/**
 * testAddTestFile method
 *
 * @return void
 * @access public
 */
	function testAddTestFile() {
	}

/**
 * testGetTestCaseList method
 *
 * @return void
 * @access public
 */
	function testGetTestCaseList() {
	}

/**
 * testGetGroupTestList method
 *
 * @return void
 * @access public
 */
	function testGetGroupTestList() {
	}
}
?>