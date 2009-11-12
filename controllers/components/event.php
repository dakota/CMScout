<?php
/**
 * Description of event
 *
 * @author wlalk
 */
class EventComponent extends Object
{
	public $controler = null;
	private $enabledPlugins = array();
	private $eventClasses = array();
	private $eventHandlerCache = array();


    public function initialize(&$controller, $settings = array())
	{
		$this->controller =& $controller;
	
		$this->enabledPlugins = $this->controller->enabledPlugins;
		
		$this->__loadEventHandlers();
	}

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

	private function __handlerMethodName($eventName)
	{
		return 'on'.Inflector::camelize($eventName);
	}

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

					$availableMethods = get_class_methods($this->eventClasses[$className]);

					foreach($availableMethods as $availableMethod)
					{
						if(strpos($availableMethod, 'on') === 0)
						{
							$handlerName = lcfirst(substr($availableMethod, 2));
							$this->eventHandlerCache[$handlerName][] = $className;
						}
					}
				}
			}
		}
	}

	private function __loadEventClass($className, $filename)
	{
		App::Import('file', $className, true, array(), $filename);

		$this->eventClasses[$className] =& new $className();
	}

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