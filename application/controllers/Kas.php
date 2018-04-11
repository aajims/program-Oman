<?php
Class Kas extends CI_Controller{
       
         
    function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
        $this->load->database();
		$this->load->helper('fungsidate');
        $this->load->model('model_kas');
        $this->load->library(array('template','pagination','form_validation'));
    }
        
    function index(){
        $isi['judul']    = ' Halaman Kas';		
        $isi['kas']     = $this->model_kas->tampilkan();		
        $this->template->utama('view_kas',$isi);        
       }
	
	function view(){
        $isi['judul']    = ' Halaman Kas';		
        $isi['kas']     = $this->model_kas->tampilkan();		
        $this->template->utama('lihat_kas',$isi);        
       }
       
     function tambah(){
	    $this->_validate();
       	$this->model_kas->tambah();
		redirect('view_kas');       	   
    }
    
    function edit($id){
	$data = $this->model_kas->get_id($id);
	echo json_encode($data);
		}
                
    function update(){
        $this->_validate();
         $data = array(             
            'dana'=>  $this->input->post('dn'),
            'saldo'=>  $this->input->post('sal')
        );
       $this->model_kas->update(array('id_kas' => $this->input->post('id_kas')), $data);
	echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('dn') == '' )
        {
            $data['inputerror'][] = 'dn';
            $data['error_string'][] = 'Dana Harus di Isi ';
            $data['status'] = FALSE;
        }

        if($this->input->post('sal') == '')
        {
            $data['inputerror'][] = 'sal';
            $data['error_string'][] = 'Data saldo Harus di Isi';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    function delete($id){
	$this->model_kas->delete_id($id);
	echo json_encode(array("status" => TRUE));
    }
}