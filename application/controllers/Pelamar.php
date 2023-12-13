<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        // $this->load->model('M_auth');
        $this->load->library('form_validation');
    }

    public function index(){
        redirect('Pelamar/home');
    }

    public function home()
    {
        $this->template->load('pelamar/template' , 'pelamar/pelamar');
           
    }

}

/* End of file Pelamar.php */
