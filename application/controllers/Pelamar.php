<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->model('M_auth');
        $this->load->model('M_pelamar');
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
        $user_id = $this->M_pelamar->getUser();
        $data = array(
            'perusahaan' => $this->M_pelamar->getPerusahaan($user_id->id_users),
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
        $config['base_url'] = 'http://localhost/BaliJobFinder/pelamar/management_pelamar';
        $config['total_rows'] = $this->M_pelamar->LowonganCount($user_id->id_users, $data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['lowongan'] = $this->M_pelamar->getLowongan($user_id->id_users,$config['per_page'],$data['start'],$data['keyword']);
        $this->template->load('pelamar/template','pelamar/management_pelamar',$data);
    }

    public function lamaran()
    {
        $datas = $this->M_auth->getUser($this->session->userdata('email'));

        $data = array(
            'session' => $datas->name,
            'lamaran' =>$this->M_pelamar->lamaran($datas->id_users)
        );

        $this->template->load('pelamar/template' , 'pelamar/management_lamaran', $data);
    }

    public function profile()
    {
        // ambil id_users
        $user_id = $this->M_auth->getuser($this->session->userdata('email'));
        
        // kirim data-data pada view
        $data = array(
            'profile' => $this->M_pelamar->simpanProfile($user_id->id_users),
            'session' => $user_id->name
        );
        $this->template->load('pelamar/template','pelamar/profile_pelamar',$data);
    }

    public function simpanProfile()
    {
        // ambil id_users
        $user_id = $this->M_pelamar->getDataPelamar();
    
        // melakukan pengecekan apakah ada file di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {

            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/img/profile/perusahaan'; //tempat upload logonya nanti
            $config['allowed_types'] = 'jpg|png'; // esktesion yang diperbolehkan
            $config['max_size']      = 5048; // set ukuran menjadi 5mb
    
            $this->load->library('upload', $config); 
    
            //jika file gambar diupload
            if ($this->upload->do_upload('logo_file')) {
                // upload
                $upload_data = $this->upload->data();
                // lalu simpan pada path
                $logo_path = 'assets/img/profile/perusahaan/' . $upload_data['file_name'];
    
                // menyimpan logo ke database
                $this->M_perusahaan->saveLogoPath($user_id->id_users, $logo_path);
            } else {
                // mengatasi jika error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('upload_error', $error);
            }
        }

        $this->M_pelamar->simpanProfile($user_id->id_users);
        redirect('pelamar/profile_pelamar');
    }
}
/* End of file Pelamar.php */