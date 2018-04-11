<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kas extends CI_Model {

	var $table = 'kas';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function tampil_kas()
	{
		return $this->db->get('kas');
	}
	
	function  get_kas($id){
      $query = $this->db->query("SELECT * FROM kas WHERE id_kas = '$id'");
      return $query->row_array();
    }

			
    function tampilkan(){
       $this->db->from('kas');
       $query=$this->db->get();
       return $query->result();
    }
    function get_id($id){
	$this->db->from($this->table);
	$this->db->where('id_kas',$id);
	$query = $this->db->get();
	return $query->row();
	}
	
    function tambah(){
     $data = array(
            'id_kas' => $this->input->post('id_kas'),
            'dana'=>  $this->input->post('dn'),
            'saldo'=>  $this->input->post('sal')                 
        );
        $this->db->insert('kas',$data);
       echo json_encode(array("status" => TRUE));
    }
    
    function update($where, $data){
       $this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }

    public function delete_id($id)	{
	$this->db->where('id_kas', $id);
	$this->db->delete($this->table);
	}

}
