<?php
/**
 * Tests of CiCodeGeneratorTest librarie
 *
 * Run the phpunit with command
 *
 *  	php vendor/phpunit/phpunit/composer/bin/phpunit -c tests/phpunit.xml --verbose --coverage-text tests/
 * OR
 *  	php vendor/phpunit/phpunit/composer/bin/phpunit -c tests/phpunit.xml --testdox tests/
 *
 * @author      Wilson Mendes Neto <willmendesneto@gmail.com>
 * @license     Nops!
 * @version     0.1
 * @since       January 17, 2013
 */

require_once dirname(__FILE__) . '/../application/third_party/CIUnit/bootstrap_phpunit.php';

class CiCodeGeneratorTest extends CIUnit_TestCase {

	/**
	 * Dependency injection with CI_Code_Generator class
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

		//	Setting Models Directory
		$this->modelsDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR;

		//	Setting Views Directory
		$this->viewsDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

		//	Setting Controllers Directory
		$this->controllersDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;

		$this->deleteFiles($this->viewsDirectory);
		$this->deleteFiles($this->modelsDirectory);
		$this->deleteFiles($this->controllersDirectory);

        $CI = new $class();

        $GLOBALS['CI'] =& $CI;

		$CI->load->library('CI_Code_Generator');
		$this->_generator =  new CI_Code_Generator();
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
		$this->assertTrue( (bool) file_get_contents($this->viewsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue($this->deleteFiles($this->viewsDirectory));
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
		$this->deleteFiles($this->viewsDirectory);

		$this->_generator->run($this->_args);
		$this->assertTrue(is_dir($this->viewsDirectory));

		$this->assertTrue( (bool) file_get_contents($this->viewsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue( (bool) file_get_contents($this->viewsDirectory . $this->_args[2] . '.php' ));
		$this->assertTrue( (bool) file_get_contents($this->viewsDirectory . $this->_args[3] . '.php' ));

		$this->assertTrue($this->deleteFiles($this->viewsDirectory));
	}


	/**
	 * Testing generator Controller File
	 *
	 * @return void
	 */
	public function test_generatorController(){
		$this->_args = array(
			0 => 'generator:controller',
			1 => 'test_controller'
		);

		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->controllersDirectory) );
		$this->assertTrue( (bool) file_get_contents($this->controllersDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue($this->deleteFiles($this->controllersDirectory));
	}

	/**
	 * Testing generator Controller File With Methods
	 *
	 * @return void
	 */
	public function test_generatorControllerWithMethods(){
		$this->_args = array(
			0 => 'generator:controller',
			1 => 'test_with_methods_controller',
			2 => 'index',
			3 => 'viewInfoTest',
			4 => 'insertInfoTest',
			5 => 'updateInfoTest',
			6 => 'deleteInfoTest'
		);

		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->controllersDirectory) );
		$this->assertTrue( (bool) file_get_contents($this->controllersDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue($this->deleteFiles($this->controllersDirectory));
	}

	/**
	 * Testing generator Controller File
	 *
	 * @return void
	 */
	public function test_generatorModel(){
		$this->_args = array(
			0 => 'generator:model',
			1 => 'test_model'
		);

		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->modelsDirectory) );
		$this->assertTrue( (bool) file_get_contents($this->modelsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue($this->deleteFiles($this->modelsDirectory));
	}

	/**
	 * Testing generator Controller File With Methods
	 *
	 * @return void
	 */
	public function test_generatorModelWithMethods(){
		$this->_args = array(
			0 => 'generator:model',
			1 => 'test_with_methods_model',
			2 => 'getInfoTest',
			3 => 'insertInfoTest',
			4 => 'updateInfoTest',
			5 => 'deleteInfoTest'
		);

		$this->_generator->run($this->_args);
		$this->assertTrue( is_dir($this->modelsDirectory) );
		$this->assertTrue( (bool) file_get_contents($this->modelsDirectory . $this->_args[1] . '.php' ));
		$this->assertTrue($this->deleteFiles($this->modelsDirectory));
	}

    /**
     * Exclui todos os arquivos contidos no caminho do diretório fornecido.
     * Os arquivos devem ter permissão de escrita ou de propriedade do sistema, a fim de ser excluído.
     *
     * @access protected
     * @param $path = diretorio onde encontra-se o(s) arquivo(s)
     *
     * @return bool
     */
    protected function deleteFiles($path = NULL) {
    	return TRUE;
    }

    /**
     * Tear down of test
     *
     * @return type
     */
	public function tearDown(){
		$this->deleteFiles($this->viewsDirectory);
		$this->deleteFiles($this->modelsDirectory);
	}

}

/* End of file CiCodeGeneratorTest.php */
/* Location: .//D/projects/ci-code-generator/tests/CiCodeGeneratorTest.php */