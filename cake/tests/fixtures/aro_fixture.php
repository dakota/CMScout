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
 * @since         CakePHP(tm) v 1.2.0.4667
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
class AroFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'Aro'
 * @access public
 */
	var $name = 'Aro';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'length' => 10, 'null' => true),
		'model' => array('type' => 'string', 'null' => true),
		'foreign_key' => array('type' => 'integer', 'length' => 10, 'null' => true),
		'alias' => array('type' => 'string', 'default' => ''),
		'lft' => array('type' => 'integer', 'length' => 10, 'null' => true),
		'rght' => array('type' => 'integer', 'length' => 10, 'null' => true)
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('parent_id' => null, 'model' => null, 'foreign_key' => null, 'alias' => 'ROOT', 'lft' => 1, 'rght' => 8),
		array('parent_id' => '1', 'model' => 'Group', 'foreign_key' => '1', 'alias' => 'admins', 'lft' => 2, 'rght' => 7),
		array('parent_id' => '2', 'model' => 'AuthUser', 'foreign_key' => '1', 'alias' => 'Gandalf', 'lft' => 3, 'rght' => 4),
		array('parent_id' => '2', 'model' => 'AuthUser', 'foreign_key' => '2', 'alias' => 'Elrond', 'lft' => 5, 'rght' => 6)
	);
}

?>