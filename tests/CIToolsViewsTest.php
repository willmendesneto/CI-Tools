<?php
/**
 * Tests of CIToolsViewsTest librarie
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

class CIToolsViewsTest extends PHPUnit_Framework_TestCase {

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
	 * Views Directory
	 *
	 * @var string
	 */
	public $viewsDirectory;

	/**
	 * Setting up the tests
	 *
	 * @return type
	 */
	public function setUp(){
		parent::setUp();
		parent::tearDown();

		//	Setting Views Directory
		$this->viewsDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

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

		$this->_generator->run($this->_args);
		$this->assertTrue(is_dir($this->viewsDirectory));

		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[2] . '.php' ));
		$this->assertTrue( file_exists($this->viewsDirectory . $this->_args[3] . '.php' ));

		//	Removing files generateDIRECTORY_SEPARATOR
		unlink($this->viewsDirectory . $this->_args[1] . '.php' );
		unlink($this->viewsDirectory . $this->_args[2] . '.php' );
		unlink($this->viewsDirectory . $this->_args[3] . '.php' );

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[2] . '.php' ));
		$this->assertTrue( !file_exists($this->viewsDirectory . $this->_args[3] . '.php' ));
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