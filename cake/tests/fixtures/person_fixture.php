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
 * @since         CakePHP(tm) v 1.2.0.6700
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
class PersonFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'Person'
 * @access public
 */
	var $name = 'Person';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 32),
		'mother_id' => array('type' => 'integer', 'null' => false, 'key' => 'index'),
		'father_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mother_id' => array('column' => array('mother_id', 'father_id'), 'unique' => 0)
		)
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('name' => 'person', 'mother_id' => 2, 'father_id' => 3),
		array('name' => 'mother', 'mother_id' => 4, 'father_id' => 5),
		array('name' => 'father', 'mother_id' => 6, 'father_id' => 7),
		array('name' => 'mother - grand mother', 'mother_id' => 0, 'father_id' => 0),
		array('name' => 'mother - grand father', 'mother_id' => 0, 'father_id' => 0),
		array('name' => 'father - grand mother', 'mother_id' => 0, 'father_id' => 0),
		array('name' => 'father - grand father', 'mother_id' => 0, 'father_id' => 0)
	);
}
?>