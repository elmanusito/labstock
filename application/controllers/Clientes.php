<?php
class Clientes extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('clientes');
	}

	public function listAllPages()
	{
		$data['page_title'] = 'Your title';
		$string = $this->load->view('login', $data);
		$this->load->view('clientes');
		$this->load->view('productos');
		//$this->load->view('footer');
	}
}
