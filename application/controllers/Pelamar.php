<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->model(array('M_auth', 'M_pelamar'));
    }

    // function buat alert
    public function SweetAlert($icon, $title, $text){
        $this->session->set_flashdata('swal_icon', $icon);
        $this->session->set_flashdata('swal_title', $title);
        $this->session->set_flashdata('swal_text', $text);
    }

    public function index(){
        redirect('Pelamar/home');
    }

    public function home()
    {

        // get id_user sesuai email yang login
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // get semua data Pelamar
        $pelamar = $this->M_pelamar->getDataPelamar($user_id->id_users)->row();

        $data = array(
            // memberikan data gambar
            'foto_profile'=> $pelamar->gambar,
            // session
            'session' => $user_id->name,
             // ngecek data profile
            'cekData' => $this->M_pelamar->cekData($pelamar->id_pelamar),
             // ngecek data pendidikan
            'cekDataPendidikan' => $this->M_pelamar->cekDataPendidikan($pelamar->id_pelamar),
             // ngecek data pengalaman
            'cekDataPengalaman' => $this->M_pelamar->cekDataPengalaman($pelamar->id_pelamar),
             // ngecek data skill
            'cekDataSkill' => $this->M_pelamar->cekDataSkill($pelamar->id_pelamar),
             // hitung jumlah Lamaran yang di lamar oleh user
            'totalLamaran' => $this->M_pelamar->LamaranCount($pelamar->id_pelamar),
            // hitung jumlah Lamaran yang di lamar oleh user yang berstatus Belum Terkonfirmasi
            'totalLamaranKonfrimasi' => $this->M_pelamar->LamaranCountStatus($pelamar->id_pelamar)
        );
 
        $this->template->load('pelamar/template' , 'pelamar/pelamar', $data);
           
    }
    
    public function managementStatus()
    {
        // get id_user sesuai email yang login
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // get semua data Pelamar
        $pelamar = $this->M_pelamar->getDataPelamar($user_id->id_users)->row();

        $data = array(
             // memberikan data gambar
            'foto_profile'=> $pelamar->gambar,
            // session
            'session' => $user_id->name,
            // ngecek data profile
            'cekData' => $this->M_pelamar->cekData($pelamar->id_pelamar),
            // ngecek data pendidikan
            'cekDataPendidikan' => $this->M_pelamar->cekDataPendidikan($pelamar->id_pelamar),
            // ngecek data pengalaman
            'cekDataPengalaman' => $this->M_pelamar->cekDataPengalaman($pelamar->id_pelamar),
            // ngecek data skill
            'cekDataSkill' => $this->M_pelamar->cekDataSkill($pelamar->id_pelamar),
            // hitung jumlah Lamaran yang di lamar oleh user
            'totalLamaran' => $this->M_pelamar->LamaranCount($pelamar->id_pelamar),
        );

        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword']=$this->session->userdata('keyword');
        }

        // config pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/Pelamar/StatusLamaran';
        $config['total_rows'] = $this->M_pelamar->LamaranCount($pelamar->id_pelamar, $data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        // memanggil function getpelamar di M_perusahaan
        $data['lamaran'] = $this->M_pelamar->getStatusLamaran($pelamar->id_pelamar, $config['per_page'],$data['start'],$data['keyword']);

        $this->template->load('pelamar/template' , 'pelamar/management_lamaran', $data);
    }

    public function profile()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // ambil data pelamar berdasarkan id_users yang login
        $DataPelamar = $this->M_pelamar->getDataPelamar($user_id->id_users);

        // membuat datapelamar menjadi row
        $pelamar = $DataPelamar->row();
        
        // kirim data-data pada view
        $data = array(
            // mengirim gambar untuk navbar
            'foto_profile' => $pelamar->gambar,
            // mengirim data dari table data_pelamar
            'profile' => $DataPelamar->result_array(),
            // mengirim data pendidikan yang polosan dalam bentuk array
            'pendidikan'=> $this->M_pelamar->getDataPendidikan($pelamar->id_pelamar)->result_array(),
            // mengirim data pengalaman yang polosan dalam bentuk array
            'pengalaman'=> $this->M_pelamar->getDataPengalaman($pelamar->id_pelamar)->result_array(),
            // mengirim data skill yang polosan dalam bentuk array
            'skill'=> $this->M_pelamar->getDataSkill($pelamar->id_pelamar)->result_array(),

            // ngecek data profile
            'cekData' => $this->M_pelamar->cekData($pelamar->id_pelamar),
             // ngecek data pendidikan
            'cekDataPendidikan' => $this->M_pelamar->cekDataPendidikan($pelamar->id_pelamar),
             // ngecek data pengalaman
            'cekDataPengalaman' => $this->M_pelamar->cekDataPengalaman($pelamar->id_pelamar),
             // ngecek data skill
            'cekDataSkill' => $this->M_pelamar->cekDataSkill($pelamar->id_pelamar),

            'session' => $user_id->name
        );
        
        $this->template->load('pelamar/template','pelamar/profile_pelamar',$data);
    }

    public function simpanProfile()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // ambil data pelamar
        $pelamar = $this->M_pelamar->getDataPelamar($user_id->id_users)->row();
    
        // melakukan pengecekan apakah ada file di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {

            // melakukan penghapusan gambar sebelumnya dari path agar lebih hemat :)
            if(!empty($pelamar->gambar)){
                unlink('assets/img/profile/pelamar/' .$pelamar->gambar);
            }

            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/img/profile/pelamar'; //tempat upload logonya nanti
            $config['allowed_types'] = 'jpg|png'; // esktesion yang diperbolehkan
            $config['max_size']      = 5048; // set ukuran menjadi 5mb
    
            $this->load->library('upload', $config); 
    
            //jika file gambar diupload
            if ($this->upload->do_upload('logo_file')) {
                // upload
                $upload_data = $this->upload->data();
                // lalu simpan pada path
                $logo_path = 'assets/img/profile/pelamar/' . $upload_data['file_name'];

                $file_name = $upload_data['file_name'];
    
                // menyimpan logo ke database
                $this->M_pelamar->saveLogoPath($user_id->id_users, $file_name);

            } else {
                // mengatasi jika error
                $this->SweetAlert('error', 'Gagal!', 'Gagal Update Profile, Mohon Untuk Upload Gambar Format .jpg .png Dengan Ukuran Max 5MB');
                redirect('pelamar/profile');
            }
        }

        $cek = $this->M_pelamar->simpanProfile($user_id->id_users);

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Update Profile Berhasil');
            redirect('pelamar/profile');
        }

    }

    // function simpan data pendidikan
    public function simpanPendidikan(){
        // get user
        $user = $this->M_auth->getUser($this->session->userdata('email'));

        // get data pelamar bedasarkan yang login
        $pelamar = $this->M_pelamar->getDataPelamar($user->id_users)->row();

        // manggil function simpan dalam model
        $cek = $this->M_pelamar->SimpanPendidikan($pelamar->id_pelamar);

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Tambah Data Pendidikan');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Tambah Data Pendidikan');
            redirect('Pelamar/profile');
        }
        
    }

    // function update data pendidikan
    public function updatePendidikan(){
        // manggil function update dalam model
        $cek = $this->M_pelamar->UpdatePendidikan();

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Data Pendidikan');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Update Data Pendidikan');
            redirect('Pelamar/profile');
        }
    }

    // function hapus data pendidikan
    public function hapusPendidikan($id_pendidikan){
        // manggil function hapus dalam model
        $cek = $this->M_pelamar->HapusPendidikan($id_pendidikan);

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Hapus Data Pendidikan');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Berhasil Hapus Data Pendidikan');
            redirect('Pelamar/profile');
        }
    }

    // function simpan data pengalaman
    public function simpanPengalaman(){
        // get user
        $user = $this->M_auth->getUser($this->session->userdata('email'));

        // get data pelamar bedasarkan yang login
        $pelamar = $this->M_pelamar->getDataPelamar($user->id_users)->row();

        // manggil function simpan dalam model
        $cek = $this->M_pelamar->SimpanPengalaman($pelamar->id_pelamar);
        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Tambah Data Pengalaman');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'gagal!', 'Gagal Tambah Data Pengalaman');
            redirect('Pelamar/profile');
        }
        
    }

       // function update data pengalaman
       public function updatePengalaman(){
        // manggil function update dalam model
        $cek = $this->M_pelamar->UpdatePengalaman();

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Data Pengalaman');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Update Data Pengalaman');
            redirect('Pelamar/profile');
        }
    }

    // function hapus data pendidikan
    public function hapusPengalaman($id_pengalaman){
        // manggil function hapus dalam model
        $cek = $this->M_pelamar->HapusPengalaman($id_pengalaman);

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Hapus Data Pengalaman');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'gagal!', 'Gagal Hapus Data Pengalaman');
            redirect('Pelamar/profile');
        }
    }

    // function simpan data Skill
    public function simpanSkill(){
        // get user
        $user = $this->M_auth->getUser($this->session->userdata('email'));

        // get data pelamar bedasarkan yang login
        $pelamar = $this->M_pelamar->getDataPelamar($user->id_users)->row();

        // manggil function simpan dalam model
        $cek = $this->M_pelamar->SimpanSkill($pelamar->id_pelamar);

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Tambah Data Skill');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Tambah Data Skill');
            redirect('Pelamar/profile');
        }
        
    }

    // function update data Skill
    public function updateSkill(){
        // manggil function update dalam model
        $cek = $this->M_pelamar->UpdateSkill();

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Data Skill');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Update Data Skill');
            redirect('Pelamar/profile');
        }

    }

    // function hapus data Skill
    public function hapusSkill($id_skill){
        // manggil function hapus dalam model
        $cek = $this->M_pelamar->HapusSkill($id_skill);
        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Data Skill');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Update Data Skill');
            redirect('Pelamar/profile');
        }
    }


}
/* End of file Pelamar.php */