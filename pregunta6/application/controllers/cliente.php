<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cliente extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        if (!$this->session->userdata('usuario')) {
            redirect('Login');
        }
        $usuario = $this->session->userdata('usuario');
        $datos['usuario'] = $usuario;
        $this->load->view('cliente_view', $datos);
    }
}