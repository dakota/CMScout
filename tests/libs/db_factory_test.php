<?php

uses ('test', 'db_factory');

class DbFactoryTest extends TestCase {
	var $abc;

	// constructor of the test suite
	function DbFactoryTest($name) {
		$this->TestCase($name);
	}

	// called before the test functions will be executed
	// this function is defined in PHPUnit_TestCase and overwritten
	// here
	function setUp() {
		$this->abc = new DbFactory ();
	}

	// called after the test functions are executed
   // this function is defined in PHPUnit_TestCase and overwritten
   // here
   function tearDown() {
        unset($this->abc);
   }


	function testMake () {
		$config = loadDatabaseConfig ('test');

		$output = $this->abc->make($config);
		$this->assertTrue(is_object($output));

		if (preg_match('#^(adodb)_.*$#i', $config['driver'], $res)) {
			$desired_driver_name = $res[1];
		}
		else
			$desired_driver_name = $config['driver'];

		$desired_class_name = 'dbo_'.strtolower($desired_driver_name);
		$output_class_name = is_object($output)? get_class($output): false;

		$this->assertEquals($output_class_name, $desired_class_name);

		$this->assertTrue($output->connected);
	}

// this test expect an E_USER_ERROR to occur during it's run
// disabled until I find a way to assert it happen
// 
//	function testBadConfig () {
//		$output = $this->abc->make(null);
//		$this->assertTrue($output === false);
//	}
}


?>