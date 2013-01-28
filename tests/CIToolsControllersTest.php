<?php
/**
 * Tests of CIToolsControllersTest librarie
 *
 * Run the phpunit with command
 *
 *  	php vendor/phpunit/phpunit/composer/bin/phpunit --verbose --coverage-text
 * OR
 *  	php vendor/phpunit/phpunit/composer/bin/phpunit --testdox
 *
 * @author      Wilson Mendes Neto <willmendesneto@gmail.com>
 * @license     Nops!
 * @version     0.2
 * @since       January 25, 2013
 */

class CIToolsControllersTest extends PHPUnit_Framework_TestCase {

	/**
	 * Dependency injection with CI class
	 *
	 */
    private $CI;

	/**
	 * Dependency injection with \CITools\Service\CITools() class
	 *
	 *	@var object
	 */
	private $_generator;

	/**
	 * Array of method arguments
	 *
	 *	@var array
	 */
	private $_args = array();

	/**
	 * Controllers Directory
	 *
	 * @var string
	 */
	public $controllersDirectory;

	/**
	 * Setting up the tests
	 *
	 * @return type
	 */
	public function setUp(){
		parent::setUp();
		parent::tearDown();

		//	Setting Models Directory
		$this->controllersDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;
		//	Setting Assets Directory
		$this->_generator =  new \CITools\Service\CITools();
	}

	/**
	 * Testing generator Controller File
	 *
	 * @return void
	 */
	public function test_generatorController(){
		$this->_args = array(
			0 => 'generator:controller',
			1 => 'Test_controller'
		);


		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->controllersDirectory) );
		$this->assertTrue( file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->controllersDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Controller File With MethoDIRECTORY_SEPARATOR
	 *
	 * @return void
	 */
	public function test_generatorControllerWithMethods(){
		$this->_args = array(
			0 => 'generator:controller',
			1 => 'Test_with_methods_controller',
			2 => 'index',
			3 => 'viewInfoTest',
			4 => 'insertInfoTest',
			5 => 'updateInfoTest',
			6 => 'deleteInfoTest'
		);


		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->controllersDirectory) );
		$this->assertTrue( file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->controllersDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));
	}

    /**
     * Tear down of test
     *
     * @return type
     */
	public function tearDown() {}

}

/* End of file CiCodeGeneratorTest.php */
/* Location: .//D/projects/ci-code-generator/tests/CiCodeGeneratorTest.php */