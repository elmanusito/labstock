<?php
class Usuarios extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
	}

	public function index()
	{
		$data['usuarios'] = $this->usuarios_model->get_usuarios();
		$view = 'usuarios/usuarios';
		$this->uri_autoformat_view($data, $view);
	}
}
