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
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.fixtures
 * @since			CakePHP(tm) v 1.2.0.6700
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.fixtures
 */
class DataTestFixture extends CakeTestFixture {
	var $name = 'DataTest';
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'count' => array('type' => 'integer', 'default' => 0),
		'float' => array('type' => 'float', 'default' => 0),
		//'timestamp' => array('type' => 'timestamp', 'default' => null, 'null' => true),
		'created' => array('type' => 'datetime', 'default' => null),
		'updated' => array('type' => 'datetime', 'default' => null)
	);
	var $records = array();
}

?>