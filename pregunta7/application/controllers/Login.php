<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('login_view');
    }

    public function iniciar_sesion()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $usuario = $this->Usuario_model->verificar_credenciales($username, $password);

        if ($usuario) {
            $this->session->set_userdata('usuario', $usuario);
            if ($usuario->tipo_us == 'cliente') {
                redirect('cliente');
            } elseif ($usuario->tipo_us == 'administrador') {
                redirect('admin');
            }
        } else {
            $this->session->set_flashdata('mensaje_error', 'Nombre de usuario o contraseña incorrectos.');
            redirect('Login');
        }
    }

    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}
