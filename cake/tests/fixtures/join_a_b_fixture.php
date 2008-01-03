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
 * @since			CakePHP(tm) v 1.2.0.6316
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
class JoinABFixture extends CakeTestFixture {
	var $name = 'JoinAsJoinB';
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary', 'extra'=> 'auto_increment'),
		'join_a_id' => array('type' => 'integer', 'length' => 10, 'null' => true),
		'join_b_id' => array('type' => 'integer', 'default' => ''),
		'other' => array('type' => 'string', 'default' => ''),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true)
	);

	var $records = array(
		array('id' => 1, 'join_a_id' => 1, 'join_b_id' => 2, 'other' => 'Data for Join A 1 Join B 2', 'created' => '2008-01-03 10:56:33', 'updated' => '2008-01-03 10:56:33'),
		array('id' => 2, 'join_a_id' => 2, 'join_b_id' => 3, 'other' => 'Data for Join A 2 Join B 3', 'created' => '2008-01-03 10:56:34', 'updated' => '2008-01-03 10:56:34'),
		array('id' => 3, 'join_a_id' => 3, 'join_b_id' => 1, 'other' => 'Data for Join A 3 Join B 1', 'created' => '2008-01-03 10:56:35', 'updated' => '2008-01-03 10:56:35')
	);
}

?>