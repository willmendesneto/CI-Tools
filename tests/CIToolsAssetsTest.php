<?php
/**
 * Tests of CIToolsAssetsTest librarie
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

class CIToolsAssetsTest extends PHPUnit_Framework_TestCase {

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
	public $assetsDirectory;

	/**
	 * Setting up the tests
	 *
	 * @return type
	 */
	public function setUp(){
		parent::setUp();
		parent::tearDown();

		//	Setting Assets Directory
		$this->assetsDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;

		$this->_generator =  new \CITools\Service\CITools();
	}

	/**
	 * Testing generator View File Method
	 *
	 * @return void
	 */
	public function test_generatorAsset(){
		$this->_args = array(
			0 => 'generator:asset',
			1 => 'test.css'
		);

		$this->_generator->run($this->_args);

		$ext = $this->_generator->getExtension($this->_args[1]);
		$assets_path = $this->_generator->getFileAssetsDirectory($this->_args[1]);

		$this->assertTrue( is_dir( str_replace($this->_args[1], '', $this->assetsDirectory . $assets_path)));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path ));
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path), 'css');
		//	Removing file generated
		unlink($this->assetsDirectory . $assets_path);
		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path));
	}

	/**
	 * Testing generator Views Files Method
	 *
	 * @return void
	 */
	public function test_generatorAssets(){
		$this->_args = array(
			0 => 'generator:assets',
			1 => 'test1.css',
			2 => 'test2.js',
			3 => 'test3.coffee',
			4 => 'test3.scss',
			5 => 'test3.sass',
			6 => 'test3.less',
		);

		$this->_generator->run($this->_args);

		$assets_path[1] = $this->_generator->getFileAssetsDirectory($this->_args[1]);
		$assets_path[2] = $this->_generator->getFileAssetsDirectory($this->_args[2]);
		$assets_path[3] = $this->_generator->getFileAssetsDirectory($this->_args[3]);
		$assets_path[4] = $this->_generator->getFileAssetsDirectory($this->_args[4]);
		$assets_path[5] = $this->_generator->getFileAssetsDirectory($this->_args[5]);
		$assets_path[6] = $this->_generator->getFileAssetsDirectory($this->_args[6]);

		$this->assertTrue(is_dir($this->assetsDirectory));

		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[1] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[2] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[3] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[4] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[5] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[6] ));

		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[1]), 'css');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[2]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[3]), 'coffee');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[4]), 'scss');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[5]), 'sass');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[6]), 'less');

		//	Removing files generateDIRECTORY_SEPARATOR
		unlink($this->assetsDirectory . $assets_path[1] );
		unlink($this->assetsDirectory . $assets_path[2] );
		unlink($this->assetsDirectory . $assets_path[3] );
		unlink($this->assetsDirectory . $assets_path[4] );
		unlink($this->assetsDirectory . $assets_path[5] );
		unlink($this->assetsDirectory . $assets_path[6] );

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[1] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[2] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[3] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[4] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[5] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[6] ));
	}

	/**
	 * Testing generator Assets Files Method with external files
	 *
	 * @return void
	 */
	public function test_generatorAssetsWithExternalFiles(){
		$this->_args = array(
			0 => 'generator:assets',
			1 => 'jquery.js',
			2 => 'backbone.js',
			3 => 'underscore.js',
			4 => 'handlebars.js',
			5 => 'jasmine-jquery.js',
			6 => 'live.js',
			7 => 'normalize.css',
			8 => 'reset.css',
		);

		$this->_generator->run($this->_args);

		$assets_path[1] = $this->_generator->getFileAssetsDirectory($this->_args[1]);
		$assets_path[2] = $this->_generator->getFileAssetsDirectory($this->_args[2]);
		$assets_path[3] = $this->_generator->getFileAssetsDirectory($this->_args[3]);
		$assets_path[4] = $this->_generator->getFileAssetsDirectory($this->_args[4]);
		$assets_path[5] = $this->_generator->getFileAssetsDirectory($this->_args[5]);
		$assets_path[6] = $this->_generator->getFileAssetsDirectory($this->_args[6]);
		$assets_path[7] = $this->_generator->getFileAssetsDirectory($this->_args[7]);
		$assets_path[8] = $this->_generator->getFileAssetsDirectory($this->_args[8]);

		$this->assertTrue(is_dir($this->assetsDirectory));

		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[1] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[2] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[3] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[4] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[5] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[6] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[7] ));
		$this->assertTrue( file_exists($this->assetsDirectory . $assets_path[8] ));

		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[1]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[2]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[3]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[4]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[5]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[6]), 'js');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[7]), 'css');
		$this->assertEquals( $this->_generator->getExtension($this->assetsDirectory . $assets_path[8]), 'css');

		//	Removing files generateds
		unlink($this->assetsDirectory . $assets_path[1] );
		unlink($this->assetsDirectory . $assets_path[2] );
		unlink($this->assetsDirectory . $assets_path[3] );
		unlink($this->assetsDirectory . $assets_path[4] );
		unlink($this->assetsDirectory . $assets_path[5] );
		unlink($this->assetsDirectory . $assets_path[6] );
		unlink($this->assetsDirectory . $assets_path[7] );
		unlink($this->assetsDirectory . $assets_path[8] );

		//	Verifying if file was deleted
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[1] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[2] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[3] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[4] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[5] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[6] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[7] ));
		$this->assertTrue( !file_exists($this->assetsDirectory . $assets_path[8] ));
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