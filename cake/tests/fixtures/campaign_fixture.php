<?php 
/* SVN FILE: $Id$ */
/**
 * Short description for campaign_fixture.php
 * 
 * Long description for campaign_fixture.php
 * 
 * PHP versions 4 and 5
 * 
 * CakePHP(tm) : Rapid Development Framework <http://www.cakephp.org/>
 * 
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @filesource
 * @copyright            CakePHP(tm) : Rapid Development Framework <http://www.cakephp.org/>
 * @link                 http://www.cakephp.org
 * @package              cake
 * @subpackage           cake.tests.fixtures
 * @since                1.2
 * @version              $Revision$
 * @modifiedBy           $LastChangedBy$
 * @lastModified         $Date$
 * @license              http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * CampaignFixture class
 * 
 * @package              cake
 * @subpackage           cake.tests.fixtures
 */
class CampaignFixture extends CakeTestFixture {
/**
 * name property
 * 
 * @var string 'Campaign'
 * @access public
 */
    var $name = 'Campaign';    
/**
 * fields property
 * 
 * @var array
 * @access public
 */
    var $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'name' => array('type' => 'string', 'length' => 255, 'null' => false),
    ); 
/**
 * records property
 * 
 * @var array
 * @access public
 */
    var $records = array(
        array( 'id' => 1 , 'name' => 'Hurtigruten' ),
        array( 'id' => 2 , 'name' => 'Colorline' ),
        array( 'id' => 3 , 'name' => 'Queen of Scandinavia' )    
    );
} 
?> 
