<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link			http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake.tests
 * @subpackage		cake.tests.fixtures
 * @since			CakePHP(tm) v 1.2.0.6879 //Correct version number as needed**
 * @version			$Revision$
 * @modifiedby 		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * @package      cake.tests
 * @subpackage   cake.tests.fixtures
 * @since        CakePHP(tm) v 1.2.0.6879 //Correct version number as needed**
 */
class NodeFixture extends CakeTestFixture {
/**
 * name property
 * 
 * @var string 'Node'
 * @access public
 */
	var $name = 'Node';
/**
 * fields property
 * 
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'name' => 'string',
		'state' => 'integer'
	);
	var $records = array(
		array('id' => 1, 'name' => 'First', 'state' => 50),
		array('id' => 2, 'name' => 'Second', 'state' => 60),
	);
}

?>
