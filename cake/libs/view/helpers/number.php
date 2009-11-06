<?php
/**
 * Number Helper.
 *
 * Methods to make numbers more readable.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Number helper library.
 *
 * Methods to make numbers more readable.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 */
class NumberHelper extends AppHelper {

/**
 * Currencies supported by the helper.  You can add additional currency formats
 * with NumberHelper::addFormat
 *
 * @var array
 * @access protected
 **/
	var $_currencies = array(
		'USD' => array(
			'before' => '$', 'after' => 'c', 'zero' => 0, 'places' => 2, 'thousands' => ',',
			'decimals' => '.', 'negative' => '()', 'escape' => true
		),
		'GBP' => array(
			'before'=>'&#163;', 'after' => 'p', 'zero' => 0, 'places' => 2, 'thousands' => ',',
			'decimals' => '.', 'negative' => '()','escape' => false
		),
		'EUR' => array(
			'before'=>'&#8364;', 'after' => 'c', 'zero' => 0, 'places' => 2, 'thousands' => '.',
			'decimals' => ',', 'negative' => '()', 'escape' => false
		)
	);

/**
 * Default options for currency formats
 *
 * @var array
 * @access protected
 **/
	var $_currencyDefaults = array(
		'before'=>'', 'after' => '', 'zero' => '0', 'places' => 2, 'thousands' => ',',
		'decimals' => '.','negative' => '()', 'escape' => true
	);

/**
 * Formats a number with a level of precision.
 *
 * @param  float	$number	A floating point number.
 * @param  integer $precision The precision of the returned number.
 * @return float Enter description here...
 */
	function precision($number, $precision = 3) {
		return sprintf("%01.{$precision}f", $number);
	}

/**
 * Returns a formatted-for-humans file size.
 *
 * @param integer $length Size in bytes
 * @return string Human readable size
 */
	function toReadableSize($size) {
		switch (true) {
			case $size < 1024:
				return sprintf(__n('%d Byte', '%d Bytes', $size, true), $size);
			case round($size / 1024) < 1024:
				return sprintf(__('%d KB', true), $this->precision($size / 1024, 0));
			case round($size / 1024 / 1024, 2) < 1024:
				return sprintf(__('%.2f MB', true), $this->precision($size / 1024 / 1024, 2));
			case round($size / 1024 / 1024 / 1024, 2) < 1024:
				return sprintf(__('%.2f GB', true), $this->precision($size / 1024 / 1024 / 1024, 2));
			default:
				return sprintf(__('%.2f TB', true), $this->precision($size / 1024 / 1024 / 1024 / 1024, 2));
		}
	}

/**
 * Formats a number into a percentage string.
 *
 * @param float $number A floating point number
 * @param integer $precision The precision of the returned number
 * @return string Percentage string
 */
	function toPercentage($number, $precision = 2) {
		return $this->precision($number, $precision) . '%';
	}

/**
 * Formats a number into a currency format.
 *
 * @param float $number A floating point number
 * @param integer $options if int then places, if string then before, if (,.-) then use it
 *   or array with places and before keys
 * @return string formatted number
 */
	function format($number, $options = false) {
		$places = 0;
		if (is_int($options)) {
			$places = $options;
		}

		$separators = array(',', '.', '-', ':');

		$before = $after = null;
		if (is_string($options) && !in_array($options, $separators)) {
			$before = $options;
		}
		$thousands = ',';
		if (!is_array($options) && in_array($options, $separators)) {
			$thousands = $options;
		}
		$decimals = '.';
		if (!is_array($options) && in_array($options, $separators)) {
			$decimals = $options;
		}

		$escape = true;
		if (is_array($options)) {
			$options = array_merge(array('before'=>'$', 'places' => 2, 'thousands' => ',', 'decimals' => '.'), $options);
			extract($options);
		}

		$out = $before . number_format($number, $places, $decimals, $thousands) . $after;

		if ($escape) {
			return h($out);
		}
		return $out;
	}

/**
 * Formats a number into a currency format.
 *
 * @param float $number
 * @param string $currency Shortcut to default options. Valid values are 'USD', 'EUR', 'GBP', otherwise
 *   set at least 'before' and 'after' options.
 * @param array $options
 * @return string Number formatted as a currency.
 */
	function currency($number, $currency = 'USD', $options = array()) {
		$default = $this->_currencyDefaults;

		if (isset($this->_currencies[$currency])) {
			$default = $this->_currencies[$currency];
		} elseif (is_string($currency)) {
			$options['before'] = $currency;
		}

		$options = array_merge($default, $options);

		$result = null;

		if ($number == 0 ) {
			if ($options['zero'] !== 0 ) {
				return $options['zero'];
			}
			$options['after'] = null;
		} elseif ($number < 1 && $number > -1 ) {
			$multiply = intval('1' . str_pad('', $options['places'], '0'));
			$number = $number * $multiply;
			$options['before'] = null;
			$options['places'] = null;
		} elseif (empty($options['before'])) {
			$options['before'] = null;
		} else {
			$options['after'] = null;
		}

		$abs = abs($number);
		$result = $this->format($abs, $options);

		if ($number < 0 ) {
			if ($options['negative'] == '()') {
				$result = '(' . $result .')';
			} else {
				$result = $options['negative'] . $result;
			}
		}
		return $result;
	}

/**
 * Add a currency format to the Number helper.  Makes reusing
 * currency formats easier.
 *
 * {{{ $number->addFormat('NOK', array('before' => 'Kr. ')); }}}
 * 
 * You can now use `NOK` as a shortform when formatting currency amounts.
 *
 * {{{ $number->currency($value, 'NOK'); }}}
 *
 * Added formats are merged with the following defaults.
 *
 * {{{
 *	array(
 *		'before' => '$', 'after' => 'c', 'zero' => 0, 'places' => 2, 'thousands' => ',',
 *		'decimals' => '.', 'negative' => '()', 'escape' => true
 *	)
 * }}}
 *
 * @param string $formatName The format name to be used in the future.
 * @param array $options The array of options for this format.
 * @return void
 **/
	function addFormat($formatName, $options) {
		$this->_currencies[$formatName] = $options + $this->_currencyDefaults;
	}

}
?>