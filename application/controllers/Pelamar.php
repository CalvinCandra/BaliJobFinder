<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->model('M_auth');
        $this->load->library('form_validation');
    }

    public function index(){
        redirect('Pelamar/home');
    }

    public function home()
    {
        $datas = $this->M_auth->getUser($this->session->userdata('email'));

        $data = array(
            'session' => $datas->name
        );

        $this->template->load('pelamar/template' , 'pelamar/pelamar', $data);
           
    }
    public function management()
    {
        $user_id = $this->M_perusahaan->getUser();
        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($user_id->id_users),
            'session' => $user_id->name
        );

        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword']=$this->session->userdata('keyword');
        }

        // config pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/perusahaan/management';
        $config['total_rows'] = $this->M_perusahaan->LowonganCount($user_id->id_users, $data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['lowongan'] = $this->M_perusahaan->getLowongan($user_id->id_users,$config['per_page'],$data['start'],$data['keyword']);
        $this->template->load('perusahaan/template','perusahaan/management',$data);
    }
}
/* End of file Pelamar.php */