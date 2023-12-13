<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Balijobfinder extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('M_auth');
        $this->load->library('form_validation'); 
    }

    public function index()
    {
        // get data
        $email = $this->session->userdata('email');

        $datas = $this->M_auth->getUser($email);

        if($datas){
            $data = array(
                'title' => 'Bali Job Finder',
                'css' => 'assets/css/landing/landing.css',
                'session_name' => $datas->name,
                'role' => $datas->role
            );
        }else{
            $data = array(
                'title' => 'Bali Job Finder',
                'css' => 'assets/css/landing/landing.css',
                'session_name' => NULL,
                'role' => ''
            );
        }

        $this->load->view('landing/_partials/header', $data);
        $this->load->view('landing/landing');
        $this->load->view('landing/_partials/footer');
    }

}

/* End of file balijobfinder.php */
