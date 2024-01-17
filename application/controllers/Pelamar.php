<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct(){
        parent:: __construct();

        $this->load->model(array('M_auth', 'M_pelamar'));

        // cek
       $cek = $this->M_auth->getUser($this->session->userdata('email'))->row();

       if(!$cek){
           redirect('Auth/login');
       }

        if($cek->role == 'perusahaan' || $cek->role == 'admin'){
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
        redirect('Pelamar/home');
    }

    // function menampilkan dashboard
    public function home()
    {
        
        // get id_user sesuai email yang login
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // get semua data Pelamar
        $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();

        $data = array(
            // memberikan data gambar
            'foto_profile'=> $pelamar->gambar,
            // session
            'session' => $users->name,
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

    // function menampilkan profile
    public function profile()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // ambil data pelamar berdasarkan id_users yang login
        $DataPelamar = $this->M_pelamar->getDataPelamar($users->id_users);

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

            'session' => $users->name
        );
        
        $this->template->load('pelamar/template','pelamar/profile_pelamar',$data);
    }

    // function simpan profile
    public function simpanProfile()
    {
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // ambil data pelamar
        $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();
    
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
            $config['file_name'] = date("his").'_'.$_FILES['logo_file']['name'];
    
            $this->load->library('upload', $config);
    
            //jika file gambar diupload
            if ($this->upload->do_upload('logo_file')) {
                // upload
                $upload_data = $this->upload->data();
    
                // menyimpan logo ke database
                $this->M_pelamar->saveLogoPath($pelamar->id_pelamar, $upload_data['file_name']);

            } else {
                // mengatasi jika error
                $this->SweetAlert('error', 'Gagal!', 'Gagal Update Profile, Mohon Untuk Upload Gambar Format .jpg .png Dengan Ukuran Max 5MB');
                redirect('pelamar/profile');
            }
        }

        // ambil data inputan user
        $nama_lengkap = $this->input->post('nama_lengkap');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $deskripsi_pelamar = $this->input->post('deskripsi');

        $cek = $this->M_pelamar->simpanProfile($nama_lengkap, $no_hp, $alamat, $deskripsi_pelamar, $users->id_users);

        if($cek){
            $this->SweetAlert('success', 'Berhasil!', 'Update Profile Berhasil');
            redirect('pelamar/profile');
        }

    }


     // function simpan data pendidikan
     public function simpanPendidikan(){
        // get user
        $user = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // get data pelamar bedasarkan yang login
        $pelamar = $this->M_pelamar->getDataPelamar($user->id_users)->row();

        // ambil data data inputan
        $nama_sekolah = $this->input->post('nama_sekolah');
        $jenjang_pendidikan = $this->input->post('jenjang_pendidikan');
        $bidang_studi = $this->input->post('bidang_studi');
        $bulan_mulai = $this->input->post('bulan_mulai');
        $tahun_mulai = $this->input->post('tahun_mulai');
        $bulan_akhir = $this->input->post('bulan_akhir');
        $tahun_akhir = $this->input->post('tahun_akhir');
        $nilai_akhir = $this->input->post('nilai_akhir');

        // manggil function simpan dalam model
        $cek = $this->M_pelamar->SimpanPendidikan($nama_sekolah, $jenjang_pendidikan, $bidang_studi, $bulan_mulai, $tahun_mulai, $bulan_akhir, $tahun_akhir, $nilai_akhir, $pelamar->id_pelamar);

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

        // ambil data data inputan
        $nama_sekolah = $this->input->post('nama_sekolah');
        $jenjang_pendidikan = $this->input->post('jenjang_pendidikan');
        $bidang_studi = $this->input->post('bidang_studi');
        $bulan_mulai = $this->input->post('bulan_mulai');
        $tahun_mulai = $this->input->post('tahun_mulai');
        $bulan_akhir = $this->input->post('bulan_akhir');
        $tahun_akhir = $this->input->post('tahun_akhir');
        $nilai_akhir = $this->input->post('nilai_akhir');
        $id_pendidikan = $this->input->post('pendidikan');

        // manggil function update dalam model
        $cek = $this->M_pelamar->UpdatePendidikan($nama_sekolah, $jenjang_pendidikan, $bidang_studi, $bulan_mulai, $tahun_mulai, $bulan_akhir, $tahun_akhir, $nilai_akhir, $id_pendidikan);

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
        $user = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // get data pelamar bedasarkan yang login
        $pelamar = $this->M_pelamar->getDataPelamar($user->id_users)->row();

        // ambil data data inputan 
        $jabatan = $this->input->post('jabatan');
        $statusPekerja = $this->input->post('status_pekerja');
        $perusahaan = $this->input->post('nama_perusahaan');
        $lokasi = $this->input->post('lokasi_perusahaan');
        $sistemKerja = $this->input->post('sistem_kerja');
        $statusKerja = $this->input->post('status_kerja');
        $bulanMulai = $this->input->post('bulan_mulai_kerja');
        $tahunMulai = $this->input->post('tahun_mulai_kerja');
        $bulanAkhir = $this->input->post('bulan_akhir_kerja');
        $tahunAkhir = $this->input->post('tahun_akhir_kerja');

        // manggil function simpan dalam model
        $cek = $this->M_pelamar->SimpanPengalaman($jabatan, $statusPekerja, $perusahaan, $lokasi, $sistemKerja, $statusKerja, $bulanMulai, $tahunMulai, $bulanAkhir, $tahunAkhir, $pelamar->id_pelamar);
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
        // ambil data data inputan 
        $jabatan = $this->input->post('jabatan');
        $statusPekerja = $this->input->post('status_pekerja');
        $perusahaan = $this->input->post('nama_perusahaan');
        $lokasi = $this->input->post('lokasi_perusahaan');
        $sistemKerja = $this->input->post('sistem_kerja');
        $statusKerja = $this->input->post('status_kerja');
        $bulanMulai = $this->input->post('bulan_mulai_kerja');
        $tahunMulai = $this->input->post('tahun_mulai_kerja');
        $bulanAkhir = $this->input->post('bulan_akhir_kerja');
        $tahunAkhir = $this->input->post('tahun_akhir_kerja');
        $pengalaman = $this->input->post('pengalaman');

        // manggil function update dalam model
        $cek = $this->M_pelamar->UpdatePengalaman($jabatan, $statusPekerja, $perusahaan, $lokasi, $sistemKerja, $statusKerja, $bulanMulai, $tahunMulai, $bulanAkhir, $tahunAkhir, $pengalaman);

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
        $user = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // get data pelamar bedasarkan yang login
        $pelamar = $this->M_pelamar->getDataPelamar($user->id_users)->row();

        // ambil data inputan user
        $nama_skill = $this->input->post('nama_skill');
        $value = $this->input->post('value');

        // manggil function simpan dalam model
        $cek = $this->M_pelamar->SimpanSkill($pelamar->id_pelamar, $nama_skill, $value);

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

        // ambil data inputan user
        $nama_skill = $this->input->post('nama_skill');
        $value = $this->input->post('value');
        $skill = $this->input->post('skill');

        // manggil function update dalam model
        $cek = $this->M_pelamar->UpdateSkill($nama_skill, $value, $skill);

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
            $this->SweetAlert('success', 'Berhasil!', 'Berhasil Hapus Data Skill');
            redirect('Pelamar/profile');
        }else{
            $this->SweetAlert('error', 'Gagal!', 'Gagal Hapus Data Skill');
            redirect('Pelamar/profile');
        }
    }


    // function menampilkan lamaran
    public function managementStatus()
    {
        // get id_user sesuai email yang login
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // get semua data Pelamar
        $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();

        $data = array(
             // memberikan data gambar
            'foto_profile'=> $pelamar->gambar,
            // session
            'session' => $users->name,
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


}
/* End of file Pelamar.php */