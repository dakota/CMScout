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
class FilmFileFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'FilmFile'
 * @access public
 */
	var $name = 'FilmFile';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'name' => array('type' => 'string', 'length' => 255)
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array('id' => 1, 'name' => 'one'),
		array('id' => 2, 'name' => 'two')
	);
}

?>