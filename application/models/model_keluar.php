<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_keluar extends CI_Model {

	var $table = 'kas_keluar';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function tampil_keluar(){
		return $this->db->get('kas_keluar');
	}
	
	function getdana(){
        return $this->db->get("kas");
    }
	
	function cariDana($kas){
        $this->db->where("id_kas",$kas);
        return $this->db->get("kas");
    }
	
	function get_baris($id_pelanggan)	{
		return $this->db
			->select('id_kas, dana, saldo')
			->where('id_kas', $id_pelanggan)
			->limit(1)
			->get('kas');
	}
			
    function tampilkan(){
       $this->db->SELECT('kas_keluar.id_keluar,kas_keluar.kwitansi,kas_keluar.keperluan,kas_keluar.tgl_keluar,kas_keluar.nominal,guru.nm_guru,kas.dana');	
       $this->db->from('kas_keluar');
	   $this->db->join('guru','guru.id_guru=kas_keluar.id_guru');
	   $this->db->join('kas','kas.id_kas=kas_keluar.id_kas');
       $query=$this->db->get();
       return $query->result();
    }
	
	function buat_kode()   {    
	  $this->db->select('RIGHT(kas_keluar.kwitansi,3) as kode', FALSE);
	  $this->db->order_by('kwitansi','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('kas_keluar');        
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
	  $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
	  $kodejadi = "KW/DN-".$today.$kodemax;     
	  return $kodejadi;  
	 }
	
	function jumlah(){
		$this->db->select('SUM(nominal) as total');
		$this->db->from('kas_keluar');
		return $this->db->get()->row()->total;
	}
	
	function carisaldo($kas){
        $this->db->where("id_kas",$kas);
        return $this->db->get("kas");
    }
	
	 function cek($kode){
        $this->db->where('saldo',$kode);
        $query=$this->db->get('kas');        
        return $query;
    }
	
    function get_id($id){
	$this->db->from($this->table);
	$this->db->where('id_keluar',$id);
	$query = $this->db->get();
	return $query->row();
	}

	function tampil(){
		$sqlcek = $this->db->query("SELECT saldo FROM kas WHERE id_kas=".$data['id_kas']." ");
		return $sqlcek;
	}
	
    function tambah($data){    	
        $this->db->insert('kas_keluar',$data);			
    }
	
	function updateed($data,$saldo){			
		$query_update=$this->db->query("update kas set saldo = saldo -'$saldo' where id_kas=".$data['id_kas']."");
		return $query_update;		
	}
	
	function updated($data,$saldo){
		$sqlcek = $this->db->query("SELECT saldo FROM kas WHERE id_kas=".$data['id_kas']." ");
		 if($sqlcek->num_rows()) 
		 {
		$this->session->set_flashdata('info','Maaf Transaksi Gagal, Saldo di KAS lebih kecil daripada di Kas Pengeluaran');
          
		} else {		
		$query_update=$this->db->query("update kas set saldo = saldo -'$saldo' where id_kas=".$data['id_kas']."");
		return $query_update;			
		}
	}
    
    function update($where, $data){
       $this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }

    public function delete_id($id)	{
        $data = $this->db->where('id_keluar', $id)->get('kas_keluar')->row();

        $this->db->where('id_keluar', $id);
        $this->db->delete($this->table);
        return $data;
	}

    function delete_update($data){
        $query_update = $this->db->query("update kas set saldo = saldo + ".$data->nominal." where id_kas=" . $data->id_kas. "");
        return $query_update;
    }
	
	function laporan($from,$to,$sumber){
		 $this->db->SELECT('kas_keluar.id_keluar,kas_keluar.kwitansi,kas_keluar.keperluan,kas_keluar.tgl_keluar,kas_keluar.nominal,kas_keluar.id_kas,guru.nm_guru,kas.dana');
		 $this->db->WHERE('kas_keluar.id_kas',$sumber);
		 $this->db->WHERE('tgl_keluar BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');		         
	     $this->db->join('guru','guru.id_guru=kas_keluar.id_guru');
	   	 $this->db->join('kas','kas.id_kas=kas_keluar.id_kas');	           
	     return $this->db->get('kas_keluar');
	}
	
	function lapor($from,$to){
		 $this->db->SELECT('kas_keluar.id_keluar,kas_keluar.kwitansi,kas_keluar.keperluan,kas_keluar.tgl_keluar,kas_keluar.nominal,guru.nm_guru,kas.dana');		
		 $this->db->WHERE('tgl_keluar BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');		         
	     $this->db->join('guru','guru.id_guru=kas_keluar.id_guru');
	   	 $this->db->join('kas','kas.id_kas=kas_keluar.id_kas');	           
	     return $this->db->get('kas_keluar');
	}

	function laporan_pdf($from,$to,$sumber){
		 $this->db->SELECT('kas_keluar.id_keluar,kas_keluar.kwitansi,kas_keluar.keperluan,kas_keluar.tgl_keluar,kas_keluar.nominal,guru.nm_guru,kas.dana');
		 $this->db->WHERE('kas_keluar.id_kas',$sumber);
		 $this->db->WHERE('tgl_keluar BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');		         
	     $this->db->join('guru','guru.id_guru=kas_keluar.id_guru');
	   	 $this->db->join('kas','kas.id_kas=kas_keluar.id_kas');	           
	     return $this->db->get('kas_keluar');
	}

	function lapor_pdf($from,$to){
		 $this->db->SELECT('kas_keluar.id_keluar,kas_keluar.kwitansi,kas_keluar.keperluan,kas_keluar.tgl_keluar,kas_keluar.nominal,guru.nm_guru,kas.dana');		
		 $this->db->WHERE('tgl_keluar BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');		         
	     $this->db->join('guru','guru.id_guru=kas_keluar.id_guru');
	   	 $this->db->join('kas','kas.id_kas=kas_keluar.id_kas');	           
	     return $this->db->get('kas_keluar');
	}
	
}
