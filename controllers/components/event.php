<?php
/**
 * EventComponent for CMScout
 *
 * @author wlalk
 */
class EventComponent extends Object
{
	/**
	 * Controller Instance
	 * @var object
	 */
	public $controler = null;

	/**
	 * List of plugins that are enabled
	 * @var array
	 */
	private $enabledPlugins = array();

	/**
	 * Event objects
	 *
	 * @var array
	 */
	private $eventClasses = array();

	/**
	 * Available handlers and what eventclasses they appear in.
	 *
	 * @var array
	 */
	private $eventHandlerCache = array();

	/**
	 * Startup
	 *
	 * @param object $controller
	 *
	 */
    public function initialize(&$controller)
	{
		$this->controller =& $controller;
	
		$this->enabledPlugins = $this->controller->enabledPlugins;
		
		$this->__loadEventHandlers();
	}

	/**
	 * Trigger an event or array of events
	 *
	 * @param string|array $eventName
	 * @param array $data (optional) Array of data to pass along to the event handler
	 * @return array
	 *
	 */
	public function trigger($eventName, $data = array())
	{
		if(is_array($eventName))
		{
			$eventNames = Set::filter($eventName);
			foreach($eventNames as $eventName)
			{
				$return[$eventName] = $this->__dispatchEvent($eventName, $data);
			}
		}
		else
		{
			$return[$eventName] = $this->__dispatchEvent($eventName, $data);
		}

		return $return;
	}

	/**
	 * Dispatch Event
	 *
	 * @param string $eventName
	 * @param array $data (optional)
	 * @return array
	 *
	 */
	private function __dispatchEvent($eventName, $data = array())
	{
		$eventHandlerMethod = $this->__handlerMethodName($eventName);

		$return = array();
		if(isset($this->eventHandlerCache[$eventName]))
		{
			foreach($this->eventHandlerCache[$eventName] as $eventClass)
			{
				if(isset($this->eventClasses[$eventClass]) && is_object($this->eventClasses[$eventClass]))
				{
					$pluginName = $this->__extractPluginName($eventClass);
					$eventObject = $this->eventClasses[$eventClass];

					$event = new Event($eventName, &$this->controller, $pluginName, $data);

			
					$return[$pluginName] = call_user_func_array(array(&$eventObject, $eventHandlerMethod), array(&$event));
				}
			}
		}

		return $return;
	}

	/**
	 * Converts event name into a handler method name
	 *
	 * @param string $eventName
	 * @return string
	 *
	 */
	private function __handlerMethodName($eventName)
	{
		return 'on'.Inflector::camelize($eventName);
	}

	/**
	 * Loads all available event handler classes for enabled plugins
	 *
	 */
	private function __loadEventHandlers()
	{
		$pluginsPaths = App::path('plugins');
		
		foreach($this->enabledPlugins as $plugin)
		{
			foreach($pluginsPaths as $pluginPath)
			{
				$filename = $pluginPath . $plugin['Plugin']['name'] . DS . $plugin['Plugin']['name'] . '_events.php';
				$className = Inflector::camelize($plugin['Plugin']['name'] . '_events');
				if(file_exists($filename))
				{
					$this->__loadEventClass($className, $filename);

					$this->__getAvailableHandlers($this->eventClasses[$className]);
				}
			}
		}
	}

	/**
	 * Loads list of available event handlers in a event object
	 *
	 * @param object $Event
	 *
	 */
	private function __getAvailableHandlers(&$Event)
	{
		$availableMethods = get_class_methods($Event);

		foreach($availableMethods as $availableMethod)
		{
			if(strpos($availableMethod, 'on') === 0)
			{
				$handlerName = lcfirst(substr($availableMethod, 2));
				$this->eventHandlerCache[$handlerName][] = get_class($Event);
			}
		}
	}

	/**
	 * Loads and initialises an event class
	 *
	 * @param string $className
	 * @param string $filename
	 *
	 */
	private function __loadEventClass($className, $filename)
	{
		App::Import('file', $className, true, array(), $filename);

		$this->eventClasses[$className] =& new $className();
	}

	/**
	 * Extracts the plugin name out of the class name
	 *
	 * @param string $className
	 * @return string
	 *
	 */
	private function __extractPluginName($className)
	{
		return substr($className, 0, strlen($className) - 6);
	}
}

/**
 * Event Object
 *
 * @package eventful-component
 */
class Event {

	/**
	 * Contains assigned values
	 *
	 * @var array
	 */
	protected $values = array();

	/**
	 * Constructor with EventName and EventData (optional)
	 *
	 * Event Data is automaticly assigned as properties by array key
	 *
	 * @param string $eventName Name of the Event
	 * @param array $data optional array with k/v data
	 */
	public function __construct($eventName, &$controller, $pluginName, $data = array()) {
		$this->name = $eventName;
		$this->controller = $controller;
		$this->plugin = $pluginName;

		if (!empty($data)) {
			foreach ($data as $name => $value) {
				$this->{$name} = $value;
			} // push data values to props
		}
	}

	/**
	 * Write to object
	 *
	 * @param string $name Key
	 * @param mixed $value Value
	 */
	public function __set($name, $value) {
		$this->values[$name] = $value;
	}

	/**
	 * Read from object
	 *
	 * @param string $name Key
	 */
	public function __get($name) {
		return $this->values[$name];
	}
}