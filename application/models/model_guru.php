<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_guru extends CI_Model {

	var $table = 'guru';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function tampil_guru()
	{
		return $this->db->get('guru');
	}
			
    function tampilkan(){
       $this->db->from('guru');
       $query=$this->db->get();
       return $query->result();
    }
    function get_id($id){
	$this->db->from($this->table);
	$this->db->where('id_guru',$id);
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
	$this->db->where('id_guru', $id);
	$this->db->delete($this->table);
	}

}
