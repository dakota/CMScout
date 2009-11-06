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
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package       cake
 * @subpackage    cake.cake.tests.libs
 * @since         CakePHP(tm) v 1.2.0.4433
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */

/**
 * CakeHtmlReporter Reports Results of TestSuites and Test Cases
 * in an HTML format / context.
 *
 * @package cake
 * @subpackage cake.cake.tests.lib
 */
class CakeHtmlReporter extends SimpleReporter {
	var $_character_set;
	var $_show_passes = false;

	var $_timeStart = 0;
	var $_timeEnd = 0;
	var $_timeDuration = 0;

/**
 * Does nothing yet. The first output will
 * be sent on the first test start. For use
 * by a web browser.
 *
 * @access public
 */
	function CakeHtmlReporter($character_set = 'ISO-8859-1') {
		if (isset($_GET['show_passes']) && $_GET['show_passes']) {
			$this->_show_passes = true;
		}
		$this->SimpleReporter();
		$this->_character_set = $character_set;
	}

/**
 * Signals / Paints the beginning of a TestSuite executing.
 * Starts the timer for the TestSuite execution time.
 *
 * @param 
 * @return void
 **/
	function paintGroupStart($test_name, $size) {
		if (empty($this->_timeStart)) {
			$this->_timeStart = $this->_getTime();
		}
		parent::paintGroupStart($test_name, $size);
	}

/**
 * Signals/Paints the end of a TestSuite. All test cases have run
 * and timers are stopped.
 *
 * @return void
 **/
	function paintGroupEnd($test_name) {
		$this->_timeEnd = $this->_getTime();
		$this->_timeDuration = $this->_timeEnd - $this->_timeStart;
		parent::paintGroupEnd($test_name);
	}

/**
 * Get the current time in microseconds. Similar to getMicrotime in basics.php
 * but in a separate function to reduce dependancies.
 *
 * @return float Time in microseconds
 **/
	function _getTime() {
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$sec + (float)$usec);
	}

/**
 * Paints the top of the web page setting the
 * title to the name of the starting test.
 *
 * @param string $test_name Name class of test.
 * @access public
 */
	function paintHeader($testName) {
		$this->sendNoCacheHeaders();
		echo "<h2>$testName</h2>\n";
		echo "<ul class='tests'>\n";
	}

/**
 * Send the headers necessary to ensure the page is
 * reloaded on every request. Otherwise you could be
 * scratching your head over out of date test data.
 *
 * @access public
 * @static
 */
	function sendNoCacheHeaders() {
		if (!headers_sent()) {
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
		}
	}

/**
 * Paints the end of the test with a summary of
 * the passes and failures.
 *
 * @param string $test_name Name class of test.
 * @access public
 */
	function paintFooter($test_name) {
		$colour = ($this->getFailCount() + $this->getExceptionCount() > 0 ? "red" : "green");
		echo "</ul>\n";
		echo "<div style=\"";
		echo "padding: 8px; margin: 1em 0; background-color: $colour; color: white;";
		echo "\">";
		echo $this->getTestCaseProgress() . "/" . $this->getTestCaseCount();
		echo " test cases complete:\n";
		echo "<strong>" . $this->getPassCount() . "</strong> passes, ";
		echo "<strong>" . $this->getFailCount() . "</strong> fails and ";
		echo "<strong>" . $this->getExceptionCount() . "</strong> exceptions.";
		echo "</div>\n";
		echo '<div style="padding:0 0 5px;">';
		echo '<p><strong>Time taken by tests (in seconds):</strong> ' . $this->_timeDuration . '</p>';
		if (function_exists('memory_get_peak_usage')) {
			echo '<p><strong>Peak memory use: (in bytes):</strong> ' . number_format(memory_get_peak_usage()) . '</p>';
		}
		echo '</div>';
	}

/**
 * Paints the test failure with a breadcrumbs
 * trail of the nesting test suites below the
 * top level test.
 *
 * @param string $message Failure message displayed in
 *   the context of the other tests.
 * @access public
 */
	function paintFail($message) {
		parent::paintFail($message);
		echo "<li class='fail'>\n";
		echo "<span>Failed</span>";
		echo "<div class='msg'>" . $this->_htmlEntities($message) . "</div>\n";
		$breadcrumb = Set::filter($this->getTestList());
		array_shift($breadcrumb);
		echo "<div>" . implode(" -&gt; ", $breadcrumb) . "</div>\n";
		echo "</li>\n";
	}

/**
 * Paints the test pass with a breadcrumbs
 * trail of the nesting test suites below the
 * top level test.
 *
 * @param string $message Pass message displayed in the context of the other tests.
 * @access public
 */
	function paintPass($message) {
		parent::paintPass($message);

		if ($this->_show_passes) {
			echo "<li class='pass'>\n";
			echo "<span>Passed</span> ";
			$breadcrumb = Set::filter($this->getTestList());
			array_shift($breadcrumb);
			echo implode(" -&gt; ", $breadcrumb);
			echo "<br />" . $this->_htmlEntities($message) . "\n";
			echo "</li>\n";
		}
	}

/**
 * Paints a PHP error.
 *
 * @param string $message Message is ignored.
 * @access public
 */
	function paintError($message) {
		parent::paintError($message);
		echo "<li class='error'>\n";
		echo "<span>Error</span>";
		echo "<div class='msg'>" . $this->_htmlEntities($message) . "</div>\n";
		$breadcrumb = Set::filter($this->getTestList());
		array_shift($breadcrumb);
		echo "<div>" . implode(" -&gt; ", $breadcrumb) . "</div>\n";
		echo "</li>\n";
	}

/**
 * Paints a PHP exception.
 *
 * @param Exception $exception Exception to display.
 * @access public
 */
	function paintException($exception) {
		parent::paintException($exception);
		echo "<li class='fail'>\n";
		echo "<span>Exception</span>";
		$message = 'Unexpected exception of type [' . get_class($exception) .
			'] with message ['. $exception->getMessage() .
			'] in ['. $exception->getFile() .
			' line ' . $exception->getLine() . ']';
		echo "<div class='msg'>" . $this->_htmlEntities($message) . "</div>\n";
		$breadcrumb = Set::filter($this->getTestList());
		array_shift($breadcrumb);
		echo "<div>" . implode(" -&gt; ", $breadcrumb) . "</div>\n";
		echo "</li>\n";
	}

/**
 * Prints the message for skipping tests.
 *
 * @param string $message    Text of skip condition.
 * @access public
 */
	function paintSkip($message) {
		parent::paintSkip($message);
		echo "<li class='skipped'>\n";
		echo "<span>Skipped</span> ";
		echo $this->_htmlEntities($message);
		echo "</li>\n";
	}

/**
 * Paints formatted text such as dumped variables.
 *
 * @param string $message Text to show.
 * @access public
 */
	function paintFormattedMessage($message) {
		echo '<pre>' . $this->_htmlEntities($message) . '</pre>';
	}

/**
 * Character set adjusted entity conversion.
 *
 * @param string $message Plain text or Unicode message.
 * @return string Browser readable message.
 * @access protected
 */
	function _htmlEntities($message) {
		return htmlentities($message, ENT_COMPAT, $this->_character_set);
	}
}
?>