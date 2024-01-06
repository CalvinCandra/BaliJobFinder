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
        $this->load->model(array('M_perusahaan', 'M_auth'));
        
    }

    public function index(){
        redirect('Perusahaan/home');
    }

    // function buat alert
    public function SweetAlert($icon, $title, $text){
        $this->session->set_flashdata('swal_icon', $icon);
        $this->session->set_flashdata('swal_title', $title);
        $this->session->set_flashdata('swal_text', $text);
    }

    public function home()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

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
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // mengambil data perusahaan
        $perusahaan = $this->M_perusahaan->getPerusahaan($user_id->id_users);

        $DataPerusahaan = $perusahaan->row();
        
        //memberikan data-data ke dalam view 
        $data = array(
            'perusahaan' => $perusahaan,
            // ngecek data profile
            'cekData' => $this->M_perusahaan->cekData($DataPerusahaan->id_perusahaan),
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
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // manggil function input pada M_perusahaan
        $addLowongan = $this->M_perusahaan->inputlowongan($user_id->id_users);

        if($addLowongan){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Tambah Lowongan Kerja');
            redirect('perusahaan/management');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Tambah Lowongan Kerja');
            redirect('perusahaan/management');
        }
        
    }

    public function editLowongan()
    {
        // manggil function editLowongan pada M_perusahaan
        $updateLowongan = $this->M_perusahaan->editLowongan();

        if($updateLowongan){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Lowongan Kerja');
            redirect('perusahaan/management');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Update Lowongan Kerja');
            redirect('perusahaan/management');
        }
    }

    public function deleteLowongan($id)
    {
        // manggil function deleteLowongan pada M_perusahaan
        $hapuslowongan = $this->M_perusahaan->deleteLowongan($id);

        if($hapuslowongan){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Hapus Lowongan Kerja');
            redirect('perusahaan/management');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Hapus Lowongan Kerja');
            redirect('perusahaan/management');
        }
    }

    public function lamaran()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));
        
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
        $hapuslamaran = $this->M_perusahaan->deleteLamaran($id);

        if($hapuslamaran){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Hapus Lamaran');
            redirect('perusahaan/management');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Hapus Lamaran');
            redirect('perusahaan/management');
        }
    }

    public function konfirmasiLamaran($id_lamaran) 
    {
        // Mengambil nilai status dari input POST
        $status = $this->input->post('status');
    
        // Memeriksa apakah status valid ('Diterima' atau 'Ditolak')
        if ($status == 'Diterima') {
            // Menggunakan model M_perusahaan untuk mengonfirmasi status lamaran di database
            $this->M_perusahaan->konfirmasiStatusLamaran($id_lamaran, $status);

            $this->SweetAlert('success', 'Selamat!', 'Selamat Telah Mendapatkan Pekerja Yang Cocok Dengan Anda');
    
            // Redirect ke halaman daftar pelamar setelah konfirmasi
            redirect('perusahaan/lamaran');

        }elseif($status == 'Ditolak'){

            $this->SweetAlert('info', 'Semangat!', 'Semangat Ya Untuk Mencari Pekerja Yang Sesuai');

            // Redirect ke halaman daftar pelamar setelah konfirmasi
            redirect('perusahaan/lamaran');
        }
    }
    

    public function profile()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));
        
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
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));
        // get data perusahaan
        $perusahaan = $this->M_perusahaan->getPerusahaan($user_id->id_users)->row();
    
        // melakukan pengecekan apakah ada file di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {

            // melakukan penghapusan gambar sebelumnya dari path agar lebih hemat :)
            if(!empty($perusahaan->logo)){
                unlink('assets/img/profile/perusahaan/' .$perusahaan->logo);
            }

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

                $file_name = $upload_data['file_name'];
    
                // // menyimpan logo ke database
                $this->M_perusahaan->saveLogoPath($user_id->id_users, $file_name);
            } else {
                // mengatasi jika error
                $this->SweetAlert('error', 'Gagal!', 'Gagal Update Profile, Mohon Untuk Upload Gambar Format .jpg .png Dengan Ukuran Max 5MB');
                redirect('perusahaan/profile');
            }
        }

        $updateProfile = $this->M_perusahaan->simpanProfile($user_id->id_users, $file_name);
        
        if($updateProfile){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Data Profile');
            redirect('perusahaan/profile');
        }
    }
    

}

/* End of file Perusahaan.php */
