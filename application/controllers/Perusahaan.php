<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->library('form_validation');
        $this->load->model('M_perusahaan');
        
    }

    public function index(){
        
        redirect('Perusahaan/home');
        
    }

    public function home()
    {
        $user_id = $this->M_perusahaan->getUser();

        // unset session untuk pencarian
        // $this->session->unset_userdata('keyword');
        // $this->session->unset_userdata('key_lamaran');

        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($user_id->id_users),
            'JumlahLowongan' => $this->M_perusahaan->LowonganCount($user_id->id_users),
            'totalLamaran' => $this->M_perusahaan->LamaranCount($user_id->id_users),
            'session' => $user_id->name
        );
        $this->template->load('perusahaan/template','perusahaan/Dashboard',$data);
        
    }

    public function management()
    {
        $user_id = $this->M_perusahaan->getUser();
        $data['perusahaan'] = $this->M_perusahaan->getPerusahaan($user_id);

        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword']=$this->session->userdata('keyword');
        }

        // config pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/perusahaan/management';
        $config['total_rows'] = $this->M_perusahaan->LowonganCount($user_id, $data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['lowongan'] = $this->M_perusahaan->getLowongan($user_id,$config['per_page'],$data['start'],$data['keyword']);
        $this->template->load('perusahaan/template','perusahaan/management',$data);

        // unset session untuk pencarian di lamaran
        // $this->session->unset_userdata('key_lamaran');
    }

    public function addLowongan()
    {
        $user_id = $this->M_perusahaan->getUser();
        $this->M_perusahaan->input($user_id);
        redirect('perusahaan/management');
        
    }

    public function editLowongan()
    {
        $this->M_perusahaan->editLowongan();
        redirect('perusahaan/management');
        
    }

    public function deleteLowongan($id)
    {
        $this->M_perusahaan->deleteLowongan($id );
        redirect('perusahaan/management'); 
    }

    public function lamaran()
    {
        $user_id = $this->M_perusahaan->getUser();
        $data['perusahaan'] = $this->M_perusahaan->getPerusahaan($user_id);

        // ambil data dari kolom pencarian
        if($this->input->post('cari_lamaran')){
            $data['key_lamaran'] = $this->input->post('key_lamaran');
            $this->session->set_userdata('key_lamaran',$data['key_lamaran']);
        }else{
            $data['key_lamaran']=$this->session->userdata('key_lamaran');
        }

        // config pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/perusahaan/lamaran';
        $config['total_rows'] = $this->M_perusahaan->LamaranCount($user_id, $data['key_lamaran']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['lamaran'] = $this->M_perusahaan->getPelamar($user_id,$config['per_page'],$data['start'],$data['key_lamaran']);
        $this->template->load('perusahaan/template','perusahaan/daftar_pelamar',$data);

        // unset session untuk pencarian di lowongan
        // $this->session->unset_userdata('keyword');
    }

    public function deleteLamaran($id)
    {
        $this->M_perusahaan->deleteLamaran($id );
        redirect('perusahaan/lamaran'); 
    }

    public function profile()
    {
        $user_id = $this->M_perusahaan->getUser();
        $data['perusahaan'] = $this->M_perusahaan->getPerusahaan($user_id);
        $this->template->load('perusahaan/template','perusahaan/profile',$data);
    }

    public function simpanProfile()
    {
        $user_id = $this->M_perusahaan->getUser();
    
        // melakukan pengecekan apakah ada file di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {
            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/img/profile/perusahaan';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 2048; // 2MB
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('logo_file')) {
                $upload_data = $this->upload->data();
                $logo_path = 'assets/img/profile/perusahaan/' . $upload_data['file_name'];
    
                // menyimpan logo ke database
                $this->M_perusahaan->saveLogoPath($user_id, $logo_path);
            } else {
                // mengatasi jika error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('upload_error', $error);
            }
        }

        $this->M_perusahaan->simpanProfile($user_id);
        redirect('perusahaan/profile');
    }
    

}

/* End of file Perusahaan.php */
