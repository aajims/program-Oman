<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
     function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
		$this->load->model(array('model_masuk','model_guru','model_keluar','model_admin'));
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('template','pagination','form_validation','upload'));
        
    }

	public function index(){
            $isi['judul']    = 'Dashboard';			
			$isi['masuk']	= $this->model_masuk->tampil_masuk()->num_rows();
			$isi['keluar']	= $this->model_keluar->tampil_keluar()->num_rows();
			$isi['guru']	= $this->model_guru->tampil_guru()->num_rows();
			$isi['admin']	= $this->model_admin->tampil_admin()->num_rows();          
            $this->template->utama('dashboard',$isi);
		
	}
}
