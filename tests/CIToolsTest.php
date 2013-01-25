<?php
/**
 * Tests of CIToolsTest librarie
 *
 * Run the phpunit with command
 *
 *  	php vendor/phpunit/phpunit/composer/bin/phpunit -c tests/phpunit.xml --verbose --coverage-text tests/
 * OR
 *  	php vendor/phpunit/phpunit/composer/bin/phpunit -c tests/phpunit.xml --testdox tests/
 *
 * @author      Wilson Mendes Neto <willmendesneto@gmail.com>
 * @license     Nops!
 * @version     0.2
 * @since       January 25, 2013
 */

class CIToolsTest extends PHPUnit_Framework_TestCase {

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
	 * Models Directory
	 *
	 * @var string
	 */
	public $modelsDirectory;

	/**
	 * Views Directory
	 *
	 * @var string
	 */
	public $viewsDirectory;

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

        //$this->CI = &get_instance();

		//	Setting Models Directory
		$this->modelsDirectory = __DIR__ . DS . '..' . DS . 'application' . DS . 'models' . DS;
		//	Setting Views Directory
		$this->viewsDirectory = __DIR__ . DS . '..' . DS . 'application' . DS . 'views' . DS;
		//	Setting Controllers Directory
		$this->controllersDirectory = __DIR__ . DS . '..' . DS . 'application' . DS . 'controllers' . DS;

		$this->_generator =  new \CITools\Service\CITools();
	}

	/**
	 * Testing generator View File Method
	 *
	 * @return void
	 */
	public function test_generatorView(){
		$this->_args = array(
			0 => 'generator:view',
			1 => 'test'
		);

		//$_generator =  new \CITools\Service\CITools()();
		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->viewsDirectory) );
		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[1] . '.php' ));
		//	Removing file generated
		unlink($this->viewsDirectory . $this->_args[1] . '.php' );
		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Views Files Method
	 *
	 * @return void
	 */
	public function test_generatorViews(){
		$this->_args = array(
			0 => 'generator:view',
			1 => 'test1',
			2 => 'test2',
			3 => 'test3',
		);

		//$_generator =  new \CITools\Service\CITools()();
		$this->_generator->run($this->_args);
		$this->assertTrue(is_dir($this->viewsDirectory));

		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[2] . '.php' ));
		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[3] . '.php' ));

		//	Removing files generateds
		unlink($this->viewsDirectory . $this->_args[1] . '.php' );
		unlink($this->viewsDirectory . $this->_args[2] . '.php' );
		unlink($this->viewsDirectory . $this->_args[3] . '.php' );

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[2] . '.php' ));
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[3] . '.php' ));
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


		//$_generator =  new \CITools\Service\CITools()();
		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->controllersDirectory) );
		$this->assertTrue( file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->controllersDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Controller File With Methods
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


		//$_generator =  new \CITools\Service\CITools()();
		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->controllersDirectory) );
		$this->assertTrue( file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->controllersDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->controllersDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Controller File
	 *
	 * @return void
	 */
	public function test_generatorModel(){
		$this->_args = array(
			0 => 'generator:model',
			1 => 'Test_model'
		);


		//$_generator =  new \CITools\Service\CITools()();
		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->modelsDirectory) );
		$this->assertTrue( file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->modelsDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Controller File With Methods
	 *
	 * @return void
	 */
	public function test_generatorModelWithMethods(){
		$this->_args = array(
			0 => 'generator:model',
			1 => 'Test_with_methods_model',
			2 => 'getInfoTest',
			3 => 'insertInfoTest',
			4 => 'updateInfoTest',
			5 => 'deleteInfoTest'
		);


		//$_generator =  new \CITools\Service\CITools()();
		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->modelsDirectory) );
		$this->assertTrue( file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->modelsDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));
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