<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_masuk extends CI_Model {

	var $table = 'kas_masuk';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function tampil_masuk()
	{
		return $this->db->get('kas_masuk');
	}
			
    function tampilkan(){
       $this->db->SELECT('*');
       $this->db->FROM($this->table);
	   $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
       $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
       $query=$this->db->get();
       return $query->result();
    }
	
	function buat_kode()   {    
	  $this->db->select('RIGHT(kas_masuk.kwitansi,2) as kode', FALSE);
	  $this->db->order_by('kwitansi','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('kas_masuk');      //cek dulu apakah ada sudah ada kode di tabel.    
	  if($query->num_rows() <> 0){       
	   //jika kode ternyata sudah ada.      
	   $data = $query->row();      
	   $kode = intval($data->kode) + 1;     
	  }
	  else{       
	   //jika kode belum ada      
	   $kode = 1;     
	  }
	  $today=date('Ym');
	  $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);    
	  $kodejadi = "KWI-".$today.$kodemax;     
	  return $kodejadi;  
	 }
	
	function jumlah(){
		$this->db->select('SUM(nominal) as total');
		$this->db->from('kas_masuk');
		return $this->db->get()->row()->total;
	}
	
    function get_id($id){
	$this->db->from($this->table);
	$this->db->where('id_masuk',$id);
	$query = $this->db->get();
	return $query->row();
	}
			
    function tambah($data){
    	$this->db->insert('kas_masuk',$data);
		return $this->db->insert_id(); 

    }
	
	function updatee($data,$saldo){
		$query_update=$this->db->query("update kas set saldo = saldo +'$saldo' where id_kas=".$data['id_kas']."");
		return $query_update;
	}
    
    function update($where, $data){
       $this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	    }

    function delete($id){
        $data = $this->db->where('id_masuk', $id)->get('kas_masuk')->row();

        $this->db->WHERE('id_masuk',$id);
        $this->db->DELETE($this->table);

        return $data;
    }

	function delete_update($data){
        $query_update = $this->db->query("update kas set saldo = saldo - ".$data->nominal." where id_kas=" . $data->id_kas. "");
        return $query_update;
    }

	function laporan($from,$to,$sumber){
        $this->db->SELECT('*');
        $this->db->FROM($this->table);
		$this->db->WHERE('kas_masuk.id_kas',$sumber);
		$this->db->WHERE('tgl_masuk BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
        $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
	    return $this->db->get();
	}
	
	function lapor($from,$to){
         $this->db->SELECT('*');
         $this->db->FROM($this->table);
		 $this->db->WHERE('tgl_masuk BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
        $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
	     return $this->db->get();
	}

	function lapor_pdf($from,$to){
        $this->db->SELECT('*');
        $this->db->FROM($this->table);
		$this->db->WHERE('tgl_masuk BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
        $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
	     return $this->db->get();
	}

    function laporrek($from,$to){
        $this->db->SELECT('*');
        $this->db->FROM($this->table);
        $this->db->WHERE('tgl_masuk BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
        $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
        return $this->db->get();
    }
    function laporanrek($from,$to,$sumber){
        $this->db->SELECT('*');
        $this->db->FROM($this->table);
        $this->db->WHERE('kas_masuk.id_rek',$sumber);
        $this->db->WHERE('tgl_masuk BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
        $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
        return $this->db->get();
    }
    function lapor_rek_pdf($from,$to){
        $this->db->SELECT('*');
        $this->db->FROM($this->table);
        $this->db->WHERE('tgl_masuk BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $this->db->JOIN('kas','kas.id_kas=kas_masuk.id_kas', 'LEFT');
        $this->db->JOIN('bank','bank.id_rek=kas_masuk.id_rek', 'LEFT');
        return $this->db->get();
    }
	
}
