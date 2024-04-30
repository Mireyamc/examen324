<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lectura extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('cuentas_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

	public function index()
	{
        if (!$this->session->userdata('usuario') || $this->session->userdata('usuario')->tipo_us != 'administrador') {
            redirect('Login');
        }
        $this->load->model("cuentas_model");
        $this->load->helper('url');
        $cuentas=$this->cuentas_model->cuentas();
        $datos["cuentas"]=$cuentas;
        $this->load->view('nav_barview');
		$this->load->view('viewlectura',$datos);
	}
    public function borrar($id)
    {
        $this->load->model('cuentas_model');
        $this->cuentas_model->borrar_cuenta($id);
        redirect('Lectura');
    }

}
