<?php
/**
 * Tests of CIToolsConfigTest librarie
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

class CIToolsConfigTest extends PHPUnit_Framework_TestCase {

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
	public $applicationConfigDirectory;

	/**
	 * Setting up the tests
	 *
	 * @return type
	 */
	public function setUp(){
		parent::setUp();
		parent::tearDown();

		//	Setting config Directory
		$this->applicationConfigDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;

		$this->_generator =  new \CITools\Service\CITools();
	}

	/**
	 * Testing generator Encription Key
	 *
	 * @return void
	 */
	public function test_generatorEncriptionKey(){
		$this->_args = array(
			0 => 'generator:key',
		);

		$this->_generator->run($this->_args);
        $this->applicationConfigDirectory = $this->applicationConfigDirectory;

        $this->assertTrue(file_exists($this->applicationConfigDirectory . 'config.php'));

        $configFile = file_get_contents($this->applicationConfigDirectory . 'config.php');
        $this->assertTrue(strpos( '$config[\'encryption_key\'] = \'\';', $configFile) === FALSE);
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