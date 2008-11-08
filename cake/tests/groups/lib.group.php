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
 * @subpackage    cake.tests.groups
 * @since         CakePHP(tm) v 1.2.0.4206
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/** AllCoreLibGroupTest
 *
 * This test group will run all test in the cases/libs directory.
 *
 * @package       cake.tests
 * @subpackage    cake.tests.groups
 */
/**
 * AllCoreLibGroupTest class
 *
 * @package       cake
 * @subpackage    cake.tests.groups
 */
class AllCoreLibGroupTest extends GroupTest {
/**
 * label property
 *
 * @var string 'All cake/libs/* (Not yet implemented)'
 * @access public
 */
	var $label = 'All cake/libs/* (Not yet implemented)';
/**
 * AllCoreLibGroupTest method
 *
 * @access public
 * @return void
 */
	function AllCoreLibGroupTest() {
		TestManager::addTestCasesFromDirectory($this, CORE_TEST_CASES . DS . 'libs');
	}
}
?>
