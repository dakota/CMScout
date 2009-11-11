<?php
<<<<<<< HEAD
/* SVN FILE: $Id$ */

=======
>>>>>>> cake1.3/1.3
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
<<<<<<< HEAD
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
=======
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
>>>>>>> cake1.3/1.3
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
 * @subpackage    cake.tests.fixtures
 * @since         CakePHP(tm) v 1.2.0.6317
<<<<<<< HEAD
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
=======
>>>>>>> cake1.3/1.3
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */

/**
 * Short description for class.
 *
 * @package       cake
 * @subpackage    cake.tests.fixtures
 */
class JoinACFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'JoinAsJoinC'
 * @access public
 */
	var $name = 'JoinAsJoinC';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'join_a_id' => array('type' => 'integer', 'length' => 10, 'null' => true),
		'join_c_id' => array('type' => 'integer', 'default' => null),
		'other' => array('type' => 'string', 'default' => ''),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true)
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('join_a_id' => 1, 'join_c_id' => 2, 'other' => 'Data for Join A 1 Join C 2', 'created' => '2008-01-03 10:57:22', 'updated' => '2008-01-03 10:57:22'),
		array('join_a_id' => 2, 'join_c_id' => 3, 'other' => 'Data for Join A 2 Join C 3', 'created' => '2008-01-03 10:57:23', 'updated' => '2008-01-03 10:57:23'),
		array('join_a_id' => 3, 'join_c_id' => 1, 'other' => 'Data for Join A 3 Join C 1', 'created' => '2008-01-03 10:57:24', 'updated' => '2008-01-03 10:57:24')
	);
}

?>