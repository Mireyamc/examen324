<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lectura extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('cuentas_model');
        $this->load->helper('url');
    }

	public function index()
	{
        $this->load->model("cuentas_model");
        $this->load->helper('url');
        $cuentas=$this->cuentas_model->cuentas();
        $datos["cuentas"]=$cuentas;
		$this->load->view('viewlectura',$datos);
	}
    public function borrar($id)
    {
        $this->load->model('cuentas_model');
        $this->cuentas_model->borrar_cuenta($id);
        redirect('Lectura');
    }

}
