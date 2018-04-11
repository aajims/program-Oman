<?php //if(!define('BASEPATH')) exit('No direct script access allowed');
Class Model_login extends CI_Model {
    
    function login($username,$password){
        $pwd = md5($password);
        $this->db->where('username',$username);
        $this->db->where('password',$pwd);
        $query = $this->db->get('admin');
        if($query->num_rows()>0){
            foreach($query->result() as $row){
                $sess = array('username' => $row->username,
                			  'level' => $row->level,	
                              'nama_lengkap'=> $row->nama_lengkap);
                $this->session->set_userdata($sess);
                redirect('Dashboard');
            }
        }
        else {
            $this->session->set_flashdata('info','Maaf Username dan Password anda salah');
            redirect('Auth');
            }
    }
}
