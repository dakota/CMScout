<?php
/**
 * MooTools Engine Helper for JsHelper
 *
 * Provides MooTools specific Javascript for JsHelper.
 * Assumes that you have the following MooTools packages
 *
 * - Remote, Remote.HTML, Remote.JSON
 * - Fx, Fx.Tween, Fx.Morph
 * - Selectors, DomReady,
 * - Drag, Drag.Move
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2006-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright       Copyright 2006-2008, Cake Software Foundation, Inc.
 * @link            http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package         cake
 * @subpackage      cake.views.helpers
 * @license         http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Helper', 'Js');

class MootoolsEngineHelper extends JsBaseEngineHelper {
/**
 * Option mappings for MooTools
 *
 * @var array
 **/
	var $_optionMap = array(
		'request' => array(
			'complete' => 'onComplete',
			'success' => 'onSuccess',
			'before' => 'onRequest',
			'error' => 'onFailure'
		),
		'sortable' => array(
			'distance' => 'snap',
			'containment' => 'constrain',
			'sort' => 'onSort',
			'complete' => 'onComplete',
			'start' => 'onStart',
		),
		'drag' => array(
			'snapGrid' => 'snap',
			'start' => 'onStart',
			'drag' => 'onDrag',
			'stop' => 'onComplete',
		),
		'drop' => array(
			'drop' => 'onDrop',
			'hover' => 'onEnter',
			'leave' => 'onLeave',
		),
		'slider' => array(
			'complete' => 'onComplete',
			'change' => 'onChange',
			'direction' => 'mode',
			'step' => 'steps'
		)
	);

/**
 * Create javascript selector for a CSS rule
 *
 * @param string $selector The selector that is targeted
 * @return object instance of $this. Allows chained methods.
 **/
	function get($selector) {
		if ($selector == 'window' || $selector == 'document') {
			$this->selection = "$(" . $selector .")";
			return $this;
		}
		if (preg_match('/^#[^\s.]+$/', $selector)) {
			$this->selection = '$("' . substr($selector, 1) . '")';
			return $this;
		}
		$this->selection = '$$("' . $selector . '")';
		return $this;
	}

/**
 * Add an event to the script cache. Operates on the currently selected elements.
 *
 * ### Options
 *
 * - 'wrap' - Whether you want the callback wrapped in an anonymous function. (defaults true)
 * - 'stop' - Whether you want the event to stopped. (defaults true)
 *
 * @param string $type Type of event to bind to the current dom id
 * @param string $callback The Javascript function you wish to trigger or the function literal
 * @param array $options Options for the event.
 * @return string completed event handler
 **/
	function event($type, $callback, $options = array()) {
		$defaults = array('wrap' => true, 'stop' => true);
		$options = array_merge($defaults, $options);

		$function = 'function (event) {%s}';
		if ($options['wrap'] && $options['stop']) {
			$callback = "event.stop();\n" . $callback;
		}
		if ($options['wrap']) {
			$callback = sprintf($function, $callback);
		}
		$out = $this->selection . ".addEvent(\"{$type}\", $callback);";
		return $out;
	}

/**
 * Create a domReady event. This is a special event in many libraries
 *
 * @param string $functionBody The code to run on domReady
 * @return string completed domReady method
 **/
	function domReady($functionBody) {
		$this->selection = 'window';
		return $this->event('domready', $functionBody, array('stop' => false));
	}

/**
 * Create an iteration over the current selection result.
 *
 * @param string $method The method you want to apply to the selection
 * @param string $callback The function body you wish to apply during the iteration.
 * @return string completed iteration
 **/
	function each($callback) {
		return $this->selection . '.each(function (item, index) {' . $callback . '});';
	}

/**
 * Trigger an Effect.
 *
 * @param string $name The name of the effect to trigger.
 * @param array $options Array of options for the effect.
 * @return string completed string with effect.
 * @see JsBaseEngineHelper::effect()
 **/
	function effect($name, $options = array()) {
		$speed = null;
		if (isset($options['speed']) && in_array($options['speed'], array('fast', 'slow'))) {
			if ($options['speed'] == 'fast') {
				$speed = '"short"';
			} elseif ($options['speed'] == 'slow') {
				$speed = '"long"';
			}
		}
		$effect = '';
		switch ($name) {
			case 'hide':
				$effect = 'setStyle("display", "none")';
			break;
			case 'show':
				$effect = 'setStyle("display", "")';
			break;
			case 'fadeIn':
			case 'fadeOut':
			case 'slideIn':
			case 'slideOut':
				list($effectName, $direction) = preg_split('/([A-Z][a-z]+)/', $name, -1, PREG_SPLIT_DELIM_CAPTURE);
				$direction = strtolower($direction);
				if ($speed) {
					$effect .= "set(\"$effectName\", {duration:$speed}).";
				}
				$effect .= "$effectName(\"$direction\")";
			break;
		}
		return $this->selection . '.' . $effect . ';';
	}

/**
 * Create an new Request.
 * 
 * Requires `Request`.  If you wish to use 'update' key you must have ```Request.HTML```
 * if you wish to do Json requests you will need ```JSON``` and ```Request.JSON```.
 *
 * @param mixed $url
 * @param array $options
 * @return string The completed ajax call.
 **/
	function request($url, $options = array()) {
		$url = $this->url($url);
		$options = $this->_mapOptions('request', $options);
		$type = $data = null;
		if (isset($options['type']) && strtolower($options['type']) == 'json') {
			$type = '.JSON';
			if (!empty($options['data'])) {
				$data = $this->object($options['data']);
				unset($options['data']);
			}
			unset($options['type']);
		}
		if (isset($options['update'])) {
			$options['update'] = str_replace('#', '', $options['update']);
			$type = '.HTML';
			if (!empty($options['data'])) {
				$data = $this->_toQuerystring($options['data']);
				unset($options['data']);
			}
			unset($options['type']);
		}
		$options['url'] = $url;
		$callbacks = array('onComplete', 'onFailure', 'onRequest', 'onSuccess', 'onCancel', 'onException');
		$options = $this->_parseOptions($options, $callbacks);
		return "var jsRequest = new Request$type({{$options}}).send($data);";
	}

/**
 * Create a sortable element.
 *
 * Requires the `Sortables` plugin from MootoolsMore
 *
 * @param array $options Array of options for the sortable.
 * @return string Completed sortable script.
 * @see JsHelper::sortable() for options list.
 **/
	function sortable($options = array()) {
		$options = $this->_mapOptions('sortable', $options);
		$callbacks = array('onStart', 'onSort', 'onComplete');
		$options = $this->_parseOptions($options, $callbacks);
		return 'var jsSortable = new Sortables(' . $this->selection . ', {' . $options . '});';
	}

/**
 * Create a Draggable element.
 *
 * Requires the `Drag` plugin from MootoolsMore
 *
 * @param array $options Array of options for the draggable.
 * @return string Completed draggable script.
 * @see JsHelper::drag() for options list.
 **/
	function drag($options = array()) {
		$options = $this->_mapOptions('drag', $options);
		$callbacks = array('onBeforeStart', 'onStart', 'onSnap', 'onDrag', 'onComplete');
		$options = $this->_parseOptions($options, $callbacks);
		return 'var jsDrag = new Drag(' . $this->selection . ', {' . $options . '});';
	}

/**
 * Create a Droppable element.
 *
 * Requires the `Drag` and `Drag.Move` plugins from MootoolsMore
 *
 * Droppables in Mootools function differently from other libraries.  Droppables
 * are implemented as an extension of Drag.  So in addtion to making a get() selection for
 * the droppable element. You must also provide a selector rule to the draggable element. Furthermore,
 * Mootools droppables inherit all options from Drag.
 *
 * @param array $options Array of options for the droppable.
 * @return string Completed droppable script.
 * @see JsHelper::drop() for options list.
 **/
	function drop($options = array()) {
		if (empty($options['drag'])) {
			trigger_error(
				__('MootoolsEngine::drop() requires a "drag" option to properly function', true), E_USER_WARNING
			);
			return false;
		}
		$options['droppables'] = $this->selection;

		$this->get($options['drag']);
		unset($options['drag']);

		$options = $this->_mapOptions('drop', $options);
		$options = $this->_mapOptions('drag', $options);
		$callbacks = array('onBeforeStart', 'onStart', 'onSnap', 'onDrag', 'onComplete', 'onDrop', 
			'onLeave', 'onEnter', 'droppables');

		$optionString = $this->_parseOptions($options, $callbacks);
		if (!empty($optionString)) {
			$optionString = ', {' . $optionString . '}';
		}
		$out = 'var jsDrop = new Drag.Move(' . $this->selection . $optionString . ');';
		$this->selection = $options['droppables'];
		return $out;
	}

/**
 * Create a slider control
 *
 * Requires `Slider` from MootoolsMore
 *
 * @param array $options Array of options for the slider.
 * @return string Completed slider script.
 * @see JsHelper::slider() for options list.
 **/
	function slider($options = array()) {
		$slider = $this->selection;
		$this->get($options['handle']);
		unset($options['handle']);

		$callbacks = array('onStart', 'onTick', 'onChange', 'onComplete');
		$options = $this->_mapOptions('slider', $options);
		if (isset($options['min']) && isset($options['max'])) {
			$options['range'] = array($options['min'], $options['max']);
			unset($options['min'], $options['max']);
		}
		$optionString = $this->_parseOptions($options, $callbacks);
		if (!empty($optionString)) {
			$optionString = ', {' . $optionString . '}';
		}
		$out = 'var jsSlider = new Slider(' . $slider . ', ' . $this->selection . $optionString . ');';
		$this->selection = $slider;
		return $out;
	}
}
?>
