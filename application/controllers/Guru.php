<?php
Class Guru extends CI_Controller{
       
         
    function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
        $this->load->database();
        $this->load->model('model_guru');
        $this->load->library(array('template','pagination','form_validation','upload'));
    }
        
    function index(){
        $isi['judul']    = ' Halaman Guru';
        $isi['guru']     = $this->model_guru->tampilkan();
        $this->template->utama('master/view_guru',$isi);        
       }
       
       function tambah(){
        $this->_validate();
        $data = array(            
            'nip'=>  $this->input->post('nip'),
            'nm_guru' => $this->input->post('nama'),		
			'bid_studi'=>  $this->input->post('studi'),			
			'no_telp'=>  $this->input->post('telp'),
			'email'=>  $this->input->post('email')     
        );
		$this->session->set_flashdata('success', 'Transaksi Berhasil di Tambah');
        $this->model_guru->tambah($data);
       echo json_encode(array("status" => TRUE));
    }
    
    function edit($id){
	$data = $this->model_guru->get_id($id);
	echo json_encode($data);
		}
                
    function update(){
        $this->_validate();
         $data = array(            
            'nip'=>  $this->input->post('nip'),
            'nm_guru' => $this->input->post('nama'),		
			'bid_studi'=>  $this->input->post('studi'),			
			'no_telp'=>  $this->input->post('telp'),
			'email'=>  $this->input->post('email') 
        );		
       $this->model_guru->update(array('id_guru' => $this->input->post('id_guru')), $data);
	echo json_encode(array("status" => TRUE));
	$this->session->set_flashdata('success', 'Transaksi Berhasil di Edit');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nip') == '' )
        {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'NIP Harus di Isi ';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Lengkap Harus di Isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('telp') == '')
        {
            $data['inputerror'][] = 'telp';
            $data['error_string'][] = 'No Telp Harus di Isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email Harus di Isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('studi') == '')
        {
            $data['inputerror'][] = 'studi';
            $data['error_string'][] = 'Nama Studi belum di pilih';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    function delete($id){
	$this->model_guru->delete_id($id);
	echo json_encode(array("status" => TRUE));
    }
}