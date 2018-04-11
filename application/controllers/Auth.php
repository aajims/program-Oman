<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    function __construct() {
        parent::__construct();
      
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('login');
	}
        
	public function login(){
            $username   =   $this->input->post('username');
            $password   =   $this->input->post('password');
            $this->load->model('model_login');
            $this->model_login->login($username,$password);
	}
        
        public function logout(){
            $this->session->sess_destroy();
                redirect('auth');
	}
}
