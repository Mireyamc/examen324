<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        if (!$this->session->userdata('usuario') || $this->session->userdata('usuario')->tipo_us != 'administrador') {
            redirect('Login');
        }
        $usuario = $this->session->userdata('usuario');
        $datos['usuario'] = $usuario;
        $this->load->view('nav_barview');
        $this->load->view('admin_view', $datos);
    }
}