<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        // $this->load->model('M_auth');
        $this->load->library('form_validation');
    }

    public function index(){
        redirect('Admin/home');
    }

    public function home()
    {
        $this->load->view('admin/test');
        
    }

}

/* End of file Admin.php */
