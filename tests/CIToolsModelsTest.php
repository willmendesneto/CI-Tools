<?php
/**
 * Tests of CIToolsModelsTest librarie
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

class CIToolsModelsTest extends PHPUnit_Framework_TestCase {

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
	 * Models Directory
	 *
	 * @var string
	 */
	public $modelsDirectory;

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
		$this->modelsDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR;

		$this->_generator =  new \CITools\Service\CITools();
	}

	/**
	 * Testing generator Model File
	 *
	 * @return void
	 */
	public function test_generatorModel(){
		$this->_args = array(
			0 => 'generator:model',
			1 => 'Test_model'
		);


		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->modelsDirectory) );
		$this->assertTrue( file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->modelsDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Model File With Methods
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


		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->modelsDirectory) );
		$this->assertTrue( file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));

		//	Removing file generated
		unlink($this->modelsDirectory . $this->_args[1] . '.php');

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->modelsDirectory . $this->_args[1] . '.php' ));
	}

	/**
	 * Testing generator Model File With Methods Setting the parent Model
	 *
	 * @return void
	 */
	public function test_generatorModelSettingParentModel(){
		$this->_args = array(
			0 => 'generator:model',
			1 => 'Test_with_methods_model',
			2 => 'extends:MY_Model',
			3 => 'insertInfoTest',
			4 => 'updateInfoTest',
			5 => 'deleteInfoTest'
		);


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