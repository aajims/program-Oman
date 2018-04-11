<?php
Class Admin extends CI_Controller{
       
         
    function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
        $this->load->database();
        $this->load->model('model_admin');
        $this->load->library(array('template','pagination','form_validation','upload'));
    }
        
    function index(){
        $isi['judul']    = ' Halaman Admin';
        $isi['admin']     = $this->model_admin->tampilkan();
        $this->template->utama('master/view_admin',$isi);
        
       }

    function tambah(){
        $this->_validate();
        $data = array(
            'username' => $this->input->post('user'),
            'password' => md5($this->input->post('pass')),
            'nama_lengkap' => $this->input->post('nama'),
            'no_telp' => $this->input->post('telp'),
            'email'=>  $this->input->post('email'),
            'level'=>  $this->input->post('level')
        );
        $this->model_admin->tambah($data);
        echo json_encode(array("status" => TRUE));
    }

    function edit($id){
        $data = $this->model_admin->get_id($id);
        echo json_encode($data);
    }

    function update(){
        $this->_validate();
        if ($this->input->post('pass')) {
            $data = array(
                'username' => $this->input->post('user'),
                'password' => md5($this->input->post('pass')),
                'nama_lengkap' => $this->input->post('nama'),
                'no_telp' => $this->input->post('telp'),
                'email'=>  $this->input->post('email'),
                'level'=>  $this->input->post('level')
            );
        } else {
            $data = array(
                'username' => $this->input->post('user'),
                'nama_lengkap' => $this->input->post('nama'),
                'no_telp' => $this->input->post('telp'),
                'email'=>  $this->input->post('email'),
                'level'=>  $this->input->post('level')
            );
        }
        $this->model_admin->update(array('id_admin' => $this->input->post('id_admin')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('user') == '' )
        {
            $data['inputerror'][] = 'user';
            $data['error_string'][] = 'Username Harus di Isi dan minimal 4 Karakter';
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

        if($this->input->post('level') == '')
        {
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'level belum di pilih';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    function delete($id){
	$this->model_admin->delete_id($id);
	echo json_encode(array("status" => TRUE));
    }
}