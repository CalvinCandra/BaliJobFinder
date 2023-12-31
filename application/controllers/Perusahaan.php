<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct(){
        parent:: __construct();

        // jika user blm login
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
        // ambil id_users
        $user_id = $this->M_perusahaan->getUser();

        // memberikan data - data ke dalam view
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
        // ambil id_users
        $user_id = $this->M_perusahaan->getUser();
        
        //memberikan data-data ke dalam view 
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

        // mengambil link menjadi 3 bagian
        //1. BaliJobFinder
        //2. perusahaan
        //3. management
        $data['start'] = $this->uri->segment(3);

        // memanggil function getLowongan di M_perusahaan
        $data['lowongan'] = $this->M_perusahaan->getLowongan($user_id->id_users,$config['per_page'],$data['start'],$data['keyword']);
        $this->template->load('perusahaan/template','perusahaan/management',$data);
    }


    public function addLowongan()
    {
        // ambil id_users
        $user_id = $this->M_perusahaan->getUser();

        // manggil function input pada M_perusahaan
        $this->M_perusahaan->inputlowongan($user_id->id_users);
        redirect('perusahaan/management');
        
    }

    public function editLowongan()
    {
        // manggil function editLowongan pada M_perusahaan
        $this->M_perusahaan->editLowongan();
        redirect('perusahaan/management');
        
    }

    public function deleteLowongan($id)
    {
        // manggil function deleteLowongan pada M_perusahaan
        $this->M_perusahaan->deleteLowongan($id );
        redirect('perusahaan/management'); 
    }

    public function lamaran()
    {
        // ambil id_users
        $user_id = $this->M_perusahaan->getUser();
        
        // memberikan data-data ke view
        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($user_id->id_users),
            'session' => $user_id->name
        );

        // ambil data dari kolom pencarian
        if($this->input->post('cari_lamaran')){
            $data['key_lamaran'] = $this->input->post('key_lamaran');
            $this->session->set_userdata('key_lamaran',$data['key_lamaran']);
        }else{
            $data['key_lamaran']=$this->session->userdata('key_lamaran');
        }

        // config pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/perusahaan/lamaran';
        $config['total_rows'] = $this->M_perusahaan->LamaranCount($user_id->id_users, $data['key_lamaran']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        // mengambil link menjadi 3 bagian
        //1. BaliJobFinder
        //2. perusahaan
        //3. lamaran
        $data['start'] = $this->uri->segment(3);

        // memanggil function getpelamar di M_perusahaan
        $data['lamaran'] = $this->M_perusahaan->getPelamar($user_id->id_users,$config['per_page'],$data['start'],$data['key_lamaran']);
        $this->template->load('perusahaan/template','perusahaan/daftar_pelamar',$data);
    }

    public function deleteLamaran($id)
    {
        // manggil function deleteLamaran pada M_perusahaan
        $this->M_perusahaan->deleteLamaran($id );
        redirect('perusahaan/lamaran'); 
    }

    public function konfirmasiLamaran($id_lamaran) 
    {
        // Mengambil nilai status dari input POST
        $status = $this->input->post('status');
    
        // Memeriksa apakah status valid ('Diterima' atau 'Ditolak')
        if ($status == 'Diterima' || $status == 'Ditolak') {
            // Menggunakan model M_perusahaan untuk mengonfirmasi status lamaran di database
            $this->M_perusahaan->konfirmasiStatusLamaran($id_lamaran, $status);
    
            // Redirect ke halaman daftar pelamar setelah konfirmasi
            redirect('perusahaan/lamaran');
        } 
    }
    

    public function profile()
    {
        // ambil id_users
        $user_id = $this->M_perusahaan->getUser();
        
        // kirim data-data pada view
        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($user_id->id_users),
            'session' => $user_id->name
        );
        
        $this->template->load('perusahaan/template','perusahaan/profile',$data);
    }

    public function simpanProfile()
    {
        // ambil id_users
        $user_id = $this->M_perusahaan->getUser();
    
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

        $this->M_perusahaan->simpanProfile($user_id->id_users);
        redirect('perusahaan/profile');
    }
    

}

/* End of file Perusahaan.php */
