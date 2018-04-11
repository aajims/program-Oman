<?php

 Class Model_squrity extends CI_Model{
        function getsqurity(){
        $username = $this->session->userdata('username');
        if(empty($username)){
            $this->session->sess_destroy();
            redirect('Auth');
        }
    }
}
