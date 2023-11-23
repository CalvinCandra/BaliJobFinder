<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('name')){
            redirect('Auth/Login');
        }
        // $this->load->model('M_auth');
        $this->load->library('form_validation');
    }

    public function home()
    {
        $this->load->view('perusahaan/test');
        
    }

}

/* End of file Perusahaan.php */
