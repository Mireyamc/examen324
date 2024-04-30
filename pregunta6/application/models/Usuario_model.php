<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function verificar_credenciales($username, $password)
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM usuario WHERE telefono = ? AND pwd = ?", array($username, $password));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}