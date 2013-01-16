<?php

include_once dirname(__FILE__) . '/../../application/third_party/CIUnit/bootstrap_phpunit.php';

class Test_Ci_Code_Generator extends CIUnit_TestCase {

	private $usuarios = array();
	private $usuario;
	private $usuario_mapper;

	public function setUp(){
		parent::setUp();
		parent::tearDown();
	}

	public function test_soma(){
		$this->assertEquals(1, 1);
		$this->assertEquals(2, 2);
		$this->assertEquals(3, 3);
	}

	protected function get_cli_option($option, $default = null)
{
	foreach (Laravel\Request::foundation()->server->get('argv') as $argument)
	{
		if (starts_with($argument, "--{$option}="))
		{
			return substr($argument, strlen($option) + 3);
		}
	}

	return value($default);
}
/*
	public function test_cria_usuario(){
		$this->assertEquals(1, $this->usuario_mapper->save($this->usuarios[1]));
		$this->assertEquals(2, $this->usuario_mapper->save($this->usuarios[2]));
		$this->assertEquals(3, $this->usuario_mapper->save($this->usuarios[3]));
	}*/

	/**
	 *	depends test_cria_usuario
	 **/
	 /*
	public function test_salva_usuario(){
		$this->test_cria_usuario();
		$email = 'teste@teste.com';
		$id = 1;
		$this->usuarios[1]->id = $id;
		$this->usuarios[1]->email = $email;

		$this->assertTrue($this->usuario_mapper->save($this->usuarios[1]));
		$usuario = $this->usuario_mapper->find($id);

		$this->assertEquals($email, $usuario->email);

	}
*/

	public function tearDown(){
		//$this->CI->db->truncate('usuarios');
	}

}

/* End of file test_usuario.php */
/* Location: .//D/projects/my-codeigniter-skeleton/tests/models/test_usuario.php */
