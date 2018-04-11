<?php
Class Bank extends CI_Controller{
       
         
    function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
        $this->load->database();
        $this->load->model('model_bank');
        $this->load->library(array('template','pagination','form_validation','upload'));
    }
        
    function index(){
        $isi['judul']    = ' Halaman Data Bank';
        $isi['bank']     = $this->model_bank->tampilkan();
        $this->template->utama('master/view_bank',$isi);
       }
       
       function tambah(){
        $data = array(
            'nm_bank' => $this->input->post('nama'),
			'rek'=>  $this->input->post('rek'),
            'atasnam'=>  $this->input->post('nm')
        );
		$this->session->set_flashdata('success', 'Data Berhasil di Tambah');
        $this->model_bank->tambah($data);
       echo json_encode(array("status" => TRUE));
    }
    
    function edit($id){
        $data = $this->model_bank->get_id($id);
        echo json_encode($data);
		}
                
    function update(){
         $data = array(
             'nm_bank' => $this->input->post('nama'),
             'rek'=>  $this->input->post('rek'),
             'atasnama'=>  $this->input->post('nm')
        );		
       $this->model_bank->update(array('id_rek' => $this->input->post('id_rek')), $data);
        echo json_encode(array("status" => TRUE));
        $this->session->set_flashdata('success', 'Data Berhasil di Update');
    }

    
    function delete($id){
	$this->model_bank->delete_id($id);
	echo json_encode(array("status" => TRUE));
    }
}