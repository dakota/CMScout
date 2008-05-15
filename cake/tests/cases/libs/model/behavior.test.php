<?php

require_once dirname(__FILE__) . DS . 'models.php';
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.model
 */
class TestBehavior extends ModelBehavior {

	var $mapMethods = array('/test(\w+)/' => 'testMethod', '/look for\s+(.+)/' => 'speakEnglish');

	function setup(&$model, $config = array()) {
		parent::setup($model, $config);
		$this->settings[$model->alias] = array_merge(array('beforeFind' => 'on', 'afterFind' => 'off'), $config);
	}

	function beforeFind(&$model, $query) {
		$settings = $this->settings[$model->alias];
		if (!isset($settings['beforeFind']) || $settings['beforeFind'] == 'off') {
			return parent::beforeFind($model, $query);
		}
		switch ($settings['beforeFind']) {
			case 'on':
				return false;
			break;
			case 'test':
				return null;
			break;
			case 'modify':
				$query['fields'] = array($model->alias . '.id', $model->alias . '.name', $model->alias . '.mytime');
				$query['recursive'] = -1;
				return $query;
			break;
		}
	}

	function afterFind(&$model, $results, $primary) {
		$settings = $this->settings[$model->alias];
		if (!isset($settings['afterFind']) || $settings['afterFind'] == 'off') {
			return parent::afterFind($model, $results, $primary);
		}
		switch ($settings['afterFind']) {
			case 'on':
				return array();
			break;
			case 'test':
				return true;
			break;
			case 'test2':
				return null;
			break;
			case 'modify':
				return Set::extract($results, '{n}.' . $model->alias);
			break;
		}
	}
	
	function beforeSave(&$model) {
		$settings = $this->settings[$model->alias];
		if (!isset($settings['beforeSave']) || $settings['beforeSave'] == 'off') {
			return parent::beforeSave($model);
		}
		switch ($settings['beforeSave']) {
			case 'on':
				return false;
			break;
			case 'test':
				return null;
			break;
			case 'modify':
				$model->data[$model->alias]['name'] .= ' modified before';
				return true;
			break;
		}	
	}

	function afterSave(&$model, $created) {
		$settings = $this->settings[$model->alias];
		if (!isset($settings['afterSave']) || $settings['afterSave'] == 'off') {
			return parent::afterSave($model, $created);
		}
		$string = 'modified after';
		if ($created) {
			$string .= ' on create';
		}
		switch ($settings['afterSave']) {
			case 'on':
				$model->data[$model->alias]['aftersave'] = $string;
			break;
			case 'test':
				unset($model->data[$model->alias]['name']);
			break;
			case 'test2':
				return false;
			break;
			case 'modify':
				$model->data[$model->alias]['name'] .= ' ' . $string;
			break;	
		}
	}
	
	function beforeValidate(&$model) {
		$settings = $this->settings[$model->alias];
		if (!isset($settings['validate']) || $settings['validate'] == 'off') {
			return parent::beforeValidate($model);
		}
		switch ($settings['validate']) {
			case 'on':
				$model->invalidate('name');
				return true;
			break;
			case 'test':
				return null;
			break;
			case 'whitelist':
				$this->_addToWhitelist($model, array('name'));
				return true;
			break;
			case 'stop':
				$model->invalidate('name');
				return false;
			break;
		}	
	}
	
	function beforeDelete(&$model, $cascade = true) { }

	function afterDelete(&$model) { }
	
	function onError() { }
		
	function beforeTest(&$model) {
		$model->beforeTestResult[] = get_class($this);
		return get_class($this);
	}

	function testMethod(&$model, $param = true) {
		if ($param === true) {
			return 'working';
		}
	}

	function testData(&$model) {
		if (!isset($model->data['Apple']['field'])) {
			return false;
		}
		$model->data['Apple']['field_2'] = true;
		return true;
	}

	function validateField(&$model, $field) {
		return current($field) === 'Orange';
	}

	function speakEnglish(&$model, $method, $query) {
		$method = preg_replace('/look for\s+/', 'Item.name = \'', $method);
		$query = preg_replace('/^in\s+/', 'Location.name = \'', $query);
		return $method . '\' AND ' . $query . '\'';
	}
}

class Test2Behavior extends TestBehavior{
	
}

class Test3Behavior extends TestBehavior{

}

class BehaviorTest extends CakeTestCase {

	var $fixtures = array('core.apple', 'core.sample');

	function testBehaviorBinding() {
		$Apple = new Apple();
		$this->assertIdentical($Apple->Behaviors->attached(), array());

		$Apple->Behaviors->attach('Test', array('key' => 'value'));
		$this->assertIdentical($Apple->Behaviors->attached(), array('Test'));
		$this->assertEqual(strtolower(get_class($Apple->Behaviors->Test)), 'testbehavior');
		$this->assertEqual($Apple->Behaviors->Test->settings['Apple'], array('beforeFind' => 'on', 'afterFind' => 'off', 'key' => 'value'));
		$this->assertEqual(array_keys($Apple->Behaviors->Test->settings), array('Apple'));

		$this->assertIdentical($Apple->Sample->Behaviors->attached(), array());
		$Apple->Sample->Behaviors->attach('Test', array('key2' => 'value2'));
		$this->assertIdentical($Apple->Sample->Behaviors->attached(), array('Test'));
		$this->assertEqual($Apple->Sample->Behaviors->Test->settings['Sample'], array('beforeFind' => 'on', 'afterFind' => 'off', 'key2' => 'value2'));

		$this->assertEqual(array_keys($Apple->Behaviors->Test->settings), array('Apple'));
		$this->assertEqual(array_keys($Apple->Sample->Behaviors->Test->settings), array('Sample'));
		$this->assertNotIdentical($Apple->Behaviors->Test->settings['Apple'], $Apple->Sample->Behaviors->Test->settings['Sample']);

		$Apple->Behaviors->attach('Test', array('key2' => 'value2', 'key3' => 'value3', 'beforeFind' => 'off'));
		$Apple->Sample->Behaviors->attach('Test', array('key' => 'value', 'key3' => 'value3', 'beforeFind' => 'off'));
		$this->assertEqual($Apple->Behaviors->Test->settings['Apple'], array('beforeFind' => 'off', 'afterFind' => 'off', 'key' => 'value', 'key2' => 'value2', 'key3' => 'value3'));
		$this->assertEqual($Apple->Behaviors->Test->settings['Apple'], $Apple->Sample->Behaviors->Test->settings['Sample']);

		$this->assertFalse(isset($Apple->Child->Behaviors->Test));
		$Apple->Child->Behaviors->attach('Test', array('key' => 'value', 'key2' => 'value2', 'key3' => 'value3', 'beforeFind' => 'off'));
		$this->assertEqual($Apple->Child->Behaviors->Test->settings['Child'], $Apple->Sample->Behaviors->Test->settings['Sample']);

		$this->assertFalse(isset($Apple->Parent->Behaviors->Test));
		$Apple->Parent->Behaviors->attach('Test', array('key' => 'value', 'key2' => 'value2', 'key3' => 'value3', 'beforeFind' => 'off'));
		$this->assertEqual($Apple->Parent->Behaviors->Test->settings['Parent'], $Apple->Sample->Behaviors->Test->settings['Sample']);

		$Apple->Parent->Behaviors->attach('Test', array('key' => 'value', 'key2' => 'value', 'key3' => 'value', 'beforeFind' => 'off'));
		$this->assertNotEqual($Apple->Parent->Behaviors->Test->settings['Parent'], $Apple->Sample->Behaviors->Test->settings['Sample']);

		$this->assertFalse($Apple->Behaviors->attach('NoSuchBehavior'));

		$Apple->Behaviors->attach('Plugin.Test', array('key' => 'new value'));
		$this->assertEqual($Apple->Behaviors->Test->settings['Apple'], array('beforeFind' => 'off', 'afterFind' => 'off', 'key' => 'new value', 'key2' => 'value2', 'key3' => 'value3'));
	}

	function testBehaviorToggling() {
		$Apple = new Apple();
		$this->assertIdentical($Apple->Behaviors->enabled(), array());

		$Apple->Behaviors->init('Apple', array('Test' => array('key' => 'value')));
		$this->assertIdentical($Apple->Behaviors->enabled(), array('Test'));

		$Apple->Behaviors->disable('Test');
		$this->assertIdentical($Apple->Behaviors->attached(), array('Test'));
		$this->assertIdentical($Apple->Behaviors->enabled(), array());

		$Apple->Sample->Behaviors->attach('Test');
		$this->assertIdentical($Apple->Sample->Behaviors->enabled('Test'), true);
		$this->assertIdentical($Apple->Behaviors->enabled(), array());

		$Apple->Behaviors->enable('Test');
		$this->assertIdentical($Apple->Behaviors->attached('Test'), true);
		$this->assertIdentical($Apple->Behaviors->enabled(), array('Test'));

		$Apple->Behaviors->disable('Test');
		$this->assertIdentical($Apple->Behaviors->enabled(), array());
		$Apple->Behaviors->attach('Test', array('enabled' => true));
		$this->assertIdentical($Apple->Behaviors->enabled(), array('Test'));
		$Apple->Behaviors->attach('Test', array('enabled' => false));
		$this->assertIdentical($Apple->Behaviors->enabled(), array());
		$Apple->Behaviors->detach('Test');
		$this->assertIdentical($Apple->Behaviors->enabled(), array());
	}

	function testBehaviorFindCallbacks() {
		$Apple = new Apple();
		$expected = $Apple->find('all');

		$Apple->Behaviors->attach('Test');
		$this->assertIdentical($Apple->find('all'), null);

		$Apple->Behaviors->attach('Test', array('beforeFind' => 'off'));
		$this->assertIdentical($Apple->find('all'), $expected);

		$Apple->Behaviors->attach('Test', array('beforeFind' => 'test'));
		$this->assertIdentical($Apple->find('all'), $expected);

		$Apple->Behaviors->attach('Test', array('beforeFind' => 'modify'));
		$expected2 = array(
			array('Apple' => array('id' => '1', 'name' => 'Red Apple 1', 'mytime' => '22:57:17')),
			array('Apple' => array('id' => '2', 'name' => 'Bright Red Apple', 'mytime' => '22:57:17')),
			array('Apple' => array('id' => '3', 'name' => 'green blue', 'mytime' => '22:57:17'))
		);
		$result = $Apple->find('all', array('conditions' => array('Apple.id' => '< 4')));
		$this->assertEqual($result, $expected2);

		$Apple->Behaviors->disable('Test');
		$result = $Apple->find('all');
		$this->assertEqual($result, $expected);

		$Apple->Behaviors->attach('Test', array('beforeFind' => 'off', 'afterFind' => 'on'));
		$this->assertIdentical($Apple->find('all'), array());

		$Apple->Behaviors->attach('Test', array('afterFind' => 'off'));
		$this->assertEqual($Apple->find('all'), $expected);

		$Apple->Behaviors->attach('Test', array('afterFind' => 'test'));
		$this->assertEqual($Apple->find('all'), $expected);

		$Apple->Behaviors->attach('Test', array('afterFind' => 'test2'));
		$this->assertEqual($Apple->find('all'), $expected);

		$Apple->Behaviors->attach('Test', array('afterFind' => 'modify'));
		$expected = array(
			array('id' => '1', 'apple_id' => '2', 'color' => 'Red 1', 'name' => 'Red Apple 1', 'created' => '2006-11-22 10:38:58', 'date' => '1951-01-04', 'modified' => '2006-12-01 13:31:26', 'mytime' => '22:57:17'),
			array('id' => '2', 'apple_id' => '1', 'color' => 'Bright Red 1', 'name' => 'Bright Red Apple', 'created' => '2006-11-22 10:43:13', 'date' => '2014-01-01', 'modified' => '2006-11-30 18:38:10', 'mytime' => '22:57:17'),
			array('id' => '3', 'apple_id' => '2', 'color' => 'blue green', 'name' => 'green blue', 'created' => '2006-12-25 05:13:36', 'date' => '2006-12-25', 'modified' => '2006-12-25 05:23:24', 'mytime' => '22:57:17'),
			array('id' => '4', 'apple_id' => '2', 'color' => 'Blue Green', 'name' => 'Test Name', 'created' => '2006-12-25 05:23:36', 'date' => '2006-12-25', 'modified' => '2006-12-25 05:23:36', 'mytime' => '22:57:17'),
			array('id' => '5', 'apple_id' => '5', 'color' => 'Green', 'name' => 'Blue Green', 'created' => '2006-12-25 05:24:06', 'date' => '2006-12-25', 'modified' => '2006-12-25 05:29:16', 'mytime' => '22:57:17'),
			array('id' => '6', 'apple_id' => '4', 'color' => 'My new appleOrange', 'name' => 'My new apple', 'created' => '2006-12-25 05:29:39', 'date' => '2006-12-25', 'modified' => '2006-12-25 05:29:39', 'mytime' => '22:57:17'),
			array('id' => '7', 'apple_id' => '6', 'color' => 'Some wierd color', 'name' => 'Some odd color', 'created' => '2006-12-25 05:34:21', 'date' => '2006-12-25', 'modified' => '2006-12-25 05:34:21', 'mytime' => '22:57:17')
		);
		$this->assertEqual($Apple->find('all'), $expected);
	}

	function testBehaviorSaveCallbacks() {
		$Sample = new Sample();
		$record = array('Sample' => array('apple_id' => 6, 'name' => 'sample99'));

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'on'));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), false);

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'off'));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $record);

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'test'));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $record);

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'modify'));
		$expected = Set::insert($record, 'Sample.name', 'sample99 modified before');
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $expected);
		
		$Sample->Behaviors->disable('Test');
		$this->assertIdentical($Sample->save($record), $record);

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'off', 'afterSave' => 'on'));
		$expected = Set::merge($record, array('Sample' => array('aftersave' => 'modified after on create')));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $expected);

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'modify', 'afterSave' => 'modify'));
		$expected = Set::merge($record, array('Sample' => array('name' => 'sample99 modified before modified after on create')));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $expected);

		$Sample->Behaviors->attach('Test', array('beforeSave' => 'off', 'afterSave' => 'test'));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $record);
		
		$Sample->Behaviors->attach('Test', array('afterSave' => 'test2'));
		$Sample->create();
		$this->assertIdentical($Sample->save($record), $record);
		
		$Sample->Behaviors->attach('Test', array('beforeFind' => 'off', 'afterFind' => 'off'));
		$record2 = $Sample->read(null, 1);

		$Sample->Behaviors->attach('Test', array('afterSave' => 'on'));
		$expected = Set::merge($record2, array('Sample' => array('aftersave' => 'modified after')));
		$Sample->create();
		$this->assertIdentical($Sample->save($record2), $expected);

		$Sample->Behaviors->attach('Test', array('afterSave' => 'modify'));
		$expected = Set::merge($record2, array('Sample' => array('name' => 'sample1 modified after')));
		$Sample->create();
		$this->assertIdentical($Sample->save($record2), $expected);
	}
	
	function testBehaviorValidateCallback() {
		$Apple = new Apple();

		$Apple->Behaviors->attach('Test');
		$this->assertIdentical($Apple->validates(), true);

		$Apple->Behaviors->attach('Test', array('validate' => 'on'));
		$this->assertIdentical($Apple->validates(), false);
		$this->assertIdentical($Apple->validationErrors, array('name' => true));
		
		$Apple->Behaviors->attach('Test', array('validate' => 'stop'));
		$this->assertIdentical($Apple->validates(), false);
		$this->assertIdentical($Apple->validationErrors, array('name' => true));

		$Apple->Behaviors->attach('Test', array('validate' => 'whitelist'));
		$Apple->validates();
		$this->assertIdentical($Apple->whitelist, array());
		
		$Apple->whitelist = array('unknown');
		$Apple->validates();
		$this->assertIdentical($Apple->whitelist, array('unknown', 'name'));
	}

	function testBehaviorValidateMethods() {
		$Apple = new Apple();
		$Apple->Behaviors->attach('Test');
		$Apple->validate['color'] = 'validateField';

		$result = $Apple->save(array('name' => 'Genetically Modified Apple', 'color' => 'Orange'));
		$this->assertEqual(array_keys($result['Apple']), array('name', 'color', 'modified', 'created'));

		$Apple->create();
		$result = $Apple->save(array('name' => 'Regular Apple', 'color' => 'Red'));
		$this->assertFalse($result);
	}

	function testBehaviorMethodDispatching() {
		$Apple = new Apple();
		$Apple->Behaviors->attach('Test');

		$expected = 'working';
		$this->assertEqual($Apple->testMethod(), $expected);
		$this->assertEqual($Apple->Behaviors->dispatchMethod($Apple, 'testMethod'), $expected);

		$result = $Apple->Behaviors->dispatchMethod($Apple, 'wtf');
		$this->assertEqual($result, array('unhandled'));

		$result = $Apple->{'look for the remote'}('in the couch');
		$expected = "Item.name = 'the remote' AND Location.name = 'the couch'";
		$this->assertEqual($result, $expected);
	}

	function testBehaviorMethodDispatchingWithData() {
		$Apple = new Apple();
		$Apple->Behaviors->attach('Test');

		$Apple->set('field', 'value');
		$this->assertTrue($Apple->testData());
		$this->assertTrue($Apple->data['Apple']['field_2']);
	}

	function testBehaviorTrigger() {
		$Apple = new Apple();
		$Apple->Behaviors->attach('Test');
		$Apple->Behaviors->attach('Test2');
		$Apple->Behaviors->attach('Test3');

		$Apple->beforeTestResult = array();
		$Apple->Behaviors->trigger($Apple, 'beforeTest');
		$expected = array('TestBehavior', 'Test2Behavior', 'Test3Behavior');
		$this->assertIdentical($Apple->beforeTestResult, $expected);

		$Apple->beforeTestResult = array();
		$Apple->Behaviors->trigger($Apple, 'beforeTest', array(), array('break' => true, 'breakOn' => 'Test2Behavior'));
		$expected = array('TestBehavior', 'Test2Behavior');
		$this->assertIdentical($Apple->beforeTestResult, $expected);

		$Apple->beforeTestResult = array();
		$Apple->Behaviors->trigger($Apple, 'beforeTest', array(), array('break' => true, 'breakOn' => array('Test2Behavior', 'Test3Behavior')));
		$expected = array('TestBehavior', 'Test2Behavior');
		$this->assertIdentical($Apple->beforeTestResult, $expected);
	}

	function tearDown() {
		ClassRegistry::flush();
	}
}

?>
