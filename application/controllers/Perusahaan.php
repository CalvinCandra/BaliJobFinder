<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        
        $this->load->library('form_validation');
        $this->load->model(array('M_perusahaan', 'M_auth'));

        // cek
       $cek = $this->M_auth->getUser($this->session->userdata('email'))->row();

       if(!$cek){
           redirect('Auth/login');
       }

       if($cek->role == 'pelamar' || $cek->role == 'admin'){
            redirect('Balijobfinder');
        }
        
    }

    // function buat alert
    public function SweetAlert($icon, $title, $text){
        $this->session->set_flashdata('swal_icon', $icon);
        $this->session->set_flashdata('swal_title', $title);
        $this->session->set_flashdata('swal_text', $text);
    }

    public function index(){
       redirect('Perusahaan/home');
    }

    // function menampikan dashboard
    public function home()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // memberikan data - data ke dalam view
        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($users->id_users),
            'JumlahLowongan' => $this->M_perusahaan->LowonganCount($users->id_users),
            'totalLamaran' => $this->M_perusahaan->LamaranCount($users->id_users),
            'session' => $users->name
        );
        $this->template->load('perusahaan/template','perusahaan/Dashboard',$data);
        
    }

    // function menampilkan profile
    public function profile()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();
        
        // kirim data-data pada view
        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($users->id_users),
            'session' => $users->name
        );
        
        $this->template->load('perusahaan/template','perusahaan/profile',$data);
    }

    // function simpan profile
    public function simpanProfile()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // get data perusahaan
        $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users)->row();
    
        // melakukan pengecekan apakah ada file di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {

            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/img/profile/perusahaan'; //tempat upload logonya nanti
            $config['allowed_types'] = 'jpeg|jpg|png'; // esktesion yang diperbolehkan
            $config['max_size']      = 3072000; // set ukuran menjadi 3mb (dalam byte)
            $config['file_name'] = date("his").'_'.$_FILES['logo_file']['name'];
    
            $this->load->library('upload', $config);
            
            // jika gambar lebih dari 3 MB
            if($_FILES['logo_file']['size'] >= $config['max_size']){
                $this->SweetAlert('error', 'Gagal!', 'Gagal Update Profile, Mohon Untuk Upload Gambar Ukuran Max 3MB');
                redirect('Perusahaan/profile');
            }
    
            //jika file gambar diupload
            if ($this->upload->do_upload('logo_file')) {
                // upload
                $upload_data = $this->upload->data();

                // melakukan penghapusan gambar sebelumnya dari path agar lebih hemat :)
                if(!empty($perusahaan->logo)){
                    unlink('assets/img/profile/perusahaan/' .$perusahaan->logo);
                }
    
                // // menyimpan logo ke database
                $this->M_perusahaan->saveLogoPath($perusahaan->id_perusahaan, $upload_data['file_name']);
            }else{
                $this->SweetAlert('error', 'Gagal!', 'Gagal Update Profile, Mohon Untuk Upload Gambar Format .jpg .jpeg .png');
                redirect('Perusahaan/profile');
            }
        }

        // ambil data inputan user
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $no_tlp = $this->input->post('no_tlp');
        $kota = $this->input->post('kota');
        $alamat = $this->input->post('alamat');

        $updateProfile = $this->M_perusahaan->simpanProfile($nama_perusahaan, $no_tlp, $kota, $alamat, $users->id_users);
        
        if($updateProfile){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Data Profile');
            redirect('perusahaan/profile');
        }
    }

    // function menampilkan data lowongan
    public function management()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // mengambil data perusahaan
        $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users);

        $DataPerusahaan = $perusahaan->row();
        
        //memberikan data-data ke dalam view 
        $data = array(
            'perusahaan' => $perusahaan,
            // ngecek data profile
            'cekData' => $this->M_perusahaan->cekData($DataPerusahaan->id_perusahaan),
            'session' => $users->name
        );

        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword']=$this->session->userdata('keyword');
        }

        // config pagination
        $config['base_url'] = base_url().'Perusahaan/management';
        $config['total_rows'] = $this->M_perusahaan->LowonganCount($users->id_users, $data['keyword']);
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
        $data['lowongan'] = $this->M_perusahaan->getLowongan($DataPerusahaan->id_perusahaan, $config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('perusahaan/template','perusahaan/management',$data);
    }

    // function untuk tambah lowongan
    public function addLowongan()
    {
        // ambil id_users yang sedang lofin
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // ambil data perusahaan berdasarkan id_users yang login
        $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users)->row();

        // ambil data data inputan user
        $posisi = $this->input->post('posisi_lowongan');
        $salary = $this->input->post('salary');
        $syarat = $this->input->post('syarat_lowongan');
        
        $addLowongan = $this->M_perusahaan->inputlowongan($posisi, $salary, $syarat, $perusahaan->id_perusahaan);

        if($addLowongan == 1){
            $this->SweetAlert('error', 'Gagal!', 'Gagal Tambah Lowongan Kerja, Mohon Posisi Lowongan Kerja Tidak Boleh Ada Lebih Dari 1');
            redirect('perusahaan/management');
        }else{
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Tambah Lowongan Kerja');
            redirect('perusahaan/management');
        }
        
    }

    // function edit lowongan
    public function editLowongan()
    {
        // ambil data data inputan user
        $posisi = $this->input->post('posisi');
        $salary = $this->input->post('salary');
        $syarat = $this->input->post('syarat');
        $status = $this->input->post('status');
        $lowongan = $this->input->post('lowongan');

        // manggil function editLowongan pada M_perusahaan
        $updateLowongan = $this->M_perusahaan->editLowongan($posisi, $salary, $syarat, $status, $lowongan);

        if($updateLowongan){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Update Lowongan Kerja');
            redirect('perusahaan/management');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Update Lowongan Kerja');
            redirect('perusahaan/management');
        }
    }

    // function delete lowongan
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

    // function cek lamaran
    public function lamaran()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // mengambil data perusahaan
        $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users)->row();
        
        // memberikan data-data ke view
        $data = array(
            'perusahaan' => $this->M_perusahaan->getPerusahaan($users->id_users),
            'session' => $users->name
        );

        // ambil data dari kolom pencarian
        if($this->input->post('cari_lamaran')){
            $data['key_lamaran'] = $this->input->post('key_lamaran');
            $this->session->set_userdata('key_lamaran',$data['key_lamaran']);
        }else{
            $data['key_lamaran']=$this->session->userdata('key_lamaran');
        }

        // config pagination
        $config['base_url'] = base_url().'Perusahaan/lamaran';
        $config['total_rows'] = $this->M_perusahaan->LamaranCount($perusahaan->id_perusahaan, $data['key_lamaran']);
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
        $data['lamaran'] = $this->M_perusahaan->getLamaran($perusahaan->id_perusahaan,$config['per_page'],$data['start'],$data['key_lamaran']);
        $this->template->load('perusahaan/template','perusahaan/daftar_pelamar',$data);
    }

    public function deleteLamaran($id)
    {
        // manggil function deleteLamaran pada M_perusahaan
        $hapuslamaran = $this->M_perusahaan->deleteLamaran($id);

        if($hapuslamaran){
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Hapus Lamaran');
            redirect('perusahaan/lamaran');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Hapus Lamaran');
            redirect('perusahaan/lamaran');
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
            // Menggunakan model M_perusahaan untuk mengonfirmasi status lamaran di database
            $this->M_perusahaan->konfirmasiStatusLamaran($id_lamaran, $status);

            $this->SweetAlert('info', 'Semangat!', 'Semangat Ya Untuk Mencari Pekerja Yang Sesuai');

            // Redirect ke halaman daftar pelamar setelah konfirmasi
            redirect('perusahaan/lamaran');
        }
    }
    

    
    

}

/* End of file Perusahaan.php */
