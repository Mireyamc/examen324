<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class departamento extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cuentas_model');
        $this->load->library('session');
        $this->load->helper('url');
    }
    public function index()
    {
        if (!$this->session->userdata('usuario') || $this->session->userdata('usuario')->tipo_us != 'administrador') {
            redirect('Login');
        }
        $saldos_departamentos = $this->cuentas_model->obtener_saldos_departamentos();
        $datos['saldos_departamentos'] = $saldos_departamentos;
        $this->load->view('nav_barview');
        $this->load->view('departamento_view', $datos);
    }
}
