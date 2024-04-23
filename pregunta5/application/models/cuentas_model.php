<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cuentas_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
	public function cuentas()
	{
		$this->load->database();
        $query = $this->db->query("SELECT * from cuenta WHERE activo = 1");
        return $query->result();
	}
   
    public function borrar_cuenta($id)
    {
        $this->load->database();
        $query = $this->db->query("UPDATE cuenta SET activo = 0 WHERE id = '$id'");
    }
}
