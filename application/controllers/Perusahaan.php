<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->library('form_validation');
    }

    public function index(){
        
        redirect('Perusahaan/home');
        
    }

    public function home()
    {
        $this->template->load('perusahaan/template','perusahaan/Dashboard');
        
    }

}

/* End of file Perusahaan.php */
