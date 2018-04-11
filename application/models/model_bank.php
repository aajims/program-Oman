<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bank extends CI_Model {

	var $table = 'bank';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function tampil_bank()
	{
		return $this->db->get('bank');
	}
			
    function tampilkan(){
       $this->db->from('bank');
       $query=$this->db->get();
       return $query->result();
    }
    function get_id($id){
	$this->db->from($this->table);
	$this->db->where('id_rek',$id);
	$query = $this->db->get();
	return $query->row();
	}
	
    function tambah($data){
        $this->db->insert($this->table, $data);
	return $this->db->insert_id();
    }
    
    function update($where, $data){
       $this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }

    public function delete_id($id)	{
	$this->db->where('id_rek', $id);
	$this->db->delete($this->table);
	}

}
