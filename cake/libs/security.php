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
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs
 * @since			CakePHP(tm) v .0.10.0.1233
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * @package		cake
 * @subpackage	cake.cake.libs
 */
class Security extends Object {

/**
 * Default hash method
 *
 * @var string
 * @access public
 */
	var $hashType = null;
/**
  * Singleton implementation to get object instance.
  *
  * @return object
  * @access public
  * @static
  */
	function &getInstance() {
		static $instance = array();
	 	if (!$instance) {
	 		$instance[0] =& new Security;
	 	}
	 	return $instance[0];
	}
/**
  * Get allowed minutes of inactivity based on security level.
  *
  * @return integer Allowed inactivity in minutes
  * @access public
  * @static
  */
	function inactiveMins() {
		$_this =& Security::getInstance();
		switch(Configure::read('Security.level')) {
			case 'high':
				return 10;
			break;
			case 'medium':
				return 100;
			break;
			case 'low':
			default:
				return 300;
				break;
		}
	}
/**
  * Generate authorization hash.
  *
  * @return string Hash
  * @access public
  * @static
  */
	function generateAuthKey() {
		$_this =& Security::getInstance();
		if(!class_exists('String')) {
			App::import('Core', 'String');
		}
		return $_this->hash(String::uuid());
	}
/**
 * Validate authorization hash.
 *
 * @param string $authKey Authorization hash
 * @return boolean Success
 * @access public
 * @static
 */
	function validateAuthKey($authKey) {
		$_this =& Security::getInstance();
		return true;
	}
/**
 * Create a hash from string using given method.
 *
 * @param string $string String to hash
 * @param string $type Method to use (sha1/sha256/md5)
 * @param boolean $salt If true, automatically appends the application's salt
 * 				  value to $string (Security.salt)
 * @return string Hash
 * @access public
 * @static
 */
	function hash($string, $type = null, $salt = false) {
		$_this =& Security::getInstance();

		if ($salt) {
			$string = Configure::read('Security.salt') . $string;
		}
		if (empty($type)) {
			$type = $_this->hashType;
		}
		$type = strtolower($type);

		if ($type == 'sha1' || $type == null) {
			if (function_exists('sha1')) {
				$return = sha1($string);
				return $return;
			} else {
				$type = 'sha256';
			}
		}

		if ($type == 'sha256') {
			if (function_exists('mhash')) {
				$return = bin2hex(mhash(MHASH_SHA256, $string));
				return $return;
			} else {
				$type = 'md5';
	 		}
		}

		if ($type == 'md5') {
			$return = md5($string);
			return $return;
		}
	}
/**
 * Sets the default hash method for the Security object.  This affects all objects using
 * Security::hash().
 *
 * @param string $hash Method to use (sha1/sha256/md5)
 * @access public
 * @static
 * @see Security::hash()
 */
	function setHash($hash) {
		$_this =& Security::getInstance();
		$_this->hashType = $hash;
	}
/**
 * Encripts/Decrypts a text using the given key.
 *
 * @param string $text Encrypted string to decrypt, normal string to encrypt
 * @param string $key Key to use
 * @return string Encrypted/Decrypted string
 * @access public
 * @static
 */
	function cipher($text, $key) {
		if (empty($key)) {
			trigger_error('You cannot use an empty key for Security::cipher()');
			return '';
		}

		$_this =& Security::getInstance();
		if (!defined('CIPHER_SEED')) {
			//This is temporary will change later
			define('CIPHER_SEED', '76859309657453542496749683645');
		}
		srand (CIPHER_SEED);
		$out = '';

		for ($i = 0; $i < strlen($text); $i++) {
			for ($j = 0; $j < ord(substr($key, $i % strlen($key), 1)); $j++) {
				$toss = rand(0, 255);
			}
			$mask = rand(0, 255);
			$out .= chr(ord(substr($text, $i, 1)) ^ $mask);
		}
		return $out;
	}
}
?>