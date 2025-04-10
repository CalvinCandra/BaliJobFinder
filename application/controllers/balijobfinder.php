<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Balijobfinder extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model(array('M_auth', 'M_perusahaan', 'M_pelamar', 'M_landing'));
        // $this->load->model();
        $this->load->library('form_validation'); 
    }

    // function ngecek digunakan untuk ngecek sudah login apa blm
    public function cek(){
        if(!$this->session->userdata('email')){ 
            redirect('Auth/Login');
        }
    }

    public function SweetAlert($icon, $title, $text){
        $this->session->set_flashdata('swal_icon', $icon);
        $this->session->set_flashdata('swal_title', $title);
        $this->session->set_flashdata('swal_text', $text);
    }

    public function index(){
        // ambil id_users
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        if($users){
            // mengambil gambar profile berdasarkan role
            if($users->role == 'pelamar'){
                // mengambil data pelamar yang sedang login
                $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();
                if(empty($pelamar->gambar)){
                    $logo = 'assets/img/dashboard/profile.png';
                }else{
                    $logo = 'assets/img/profile/pelamar/'.$pelamar->gambar;
                }
                
            }elseif($users->role == 'perusahaan'){
                // mengambil data perusaahan yang sedang login
                $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users)->row();
                if(empty($perusahaan->logo)){
                    $logo = 'assets/img/dashboard/profile.png';
                }else{
                    $logo = 'assets/img/profile/perusahaan/'.$perusahaan->logo;
                }

            }else{
                $logo = 'assets/img/dashboard/profile.png';
            };

            // kirim data ke dalam view dengan session
            $data = array(
                'title' => 'Bali Job Finder',
                'css' => 'assets/css/landing/landing.css',
                'session_name' => $users->name,
                'role' => $users->role,
                'logo' => $logo,
                'datalowongan' => $this->M_landing->getLowonganLanding()
            );

        }else{ //jika tidak ada
            //kirim data tanpa session
            $data = array(
                'title' => 'Bali Job Finder',
                'css' => 'assets/css/landing/landing.css',
                'session_name' => NULL,
                'role' => '',
                'datalowongan' => $this->M_landing->getLowonganLanding()
            );
        }

        $this->load->view('landing/_partials/header', $data);
        $this->load->view('landing/landing');
        $this->load->view('landing/_partials/footer');
    }

    public function Lowongan(){
        // pengecekan jika blm login 
        $this->cek();

        // ambil id_users berdasarkan email
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // mengambil gambar profile
        if($users->role == 'pelamar'){
            // mengambil data pelamar yang sedang login
            $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();
            if(empty($pelamar->gambar)){
                $logo = 'assets/img/dashboard/profile.png';
            }else{
                $logo = 'assets/img/profile/pelamar/'.$pelamar->gambar;
            }
            
        }elseif($users->role == 'perusahaan'){
            // mengambil data perusaahan yang sedang login
            $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users)->row();
            if(empty($perusahaan->logo)){
                $logo = 'assets/img/dashboard/profile.png';
            }else{
                $logo = 'assets/img/profile/perusahaan/'.$perusahaan->logo;
            }

        }else{
            $logo = 'assets/img/dashboard/profile.png';
        };

        //kirim data ke view
        $data = array(
            'title' => 'Lowongan Kerja',
            'session_name' => $users->name,
            'role' => $users->role,
            'logo' => $logo,
            'css' => 'assets/css/landing/lowongan.css',
        );

        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['search'] = $this->input->post('search');
            $this->session->set_userdata('search',$data['search']);
        }else{
            $data['search']=$this->session->userdata('search');
        }

        // config pagination for lowongan
        // ambil jumlah data lowongan kerja

        $config['base_url'] = base_url(). 'Balijobfinder/Lowongan';
        $config['total_rows'] = $this->M_landing->jumlahLowongan($data['search']);
        $config['per_page'] = 15;

        // initialize pagination
        $this->pagination->initialize($config);

        // mengambil link menjadi 3 bagian
        //1. base_url
        //2. Balijobfinder
        //3. Lowongan
        $data['start'] = $this->uri->segment(3);

         // panggil function di M_landing
        $data['datalowongan'] = $this->M_landing->getLowonganMore($config['per_page'], $data['start'], $data['search']);

        $this->load->view('landing/_partials/header', $data);
        $this->load->view('landing/lowongan');
        $this->load->view('landing/_partials/footer');
    }

    // menampilkan halaman details
    public function Details($posisi, $nama_perusahaan){
         // pengecekan jika blm login 
         $this->cek();
 
         // ambil id_users berdasarkan email
         $users = $this->M_auth->getUser($this->session->userdata('email'))->row();
 
         // mengambil gambar profile berdasarkan role
         if($users->role == 'pelamar'){
             // mengambil data pelamar yang sedang login
             $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();
             if(empty($pelamar->gambar)){
                 $logo = 'assets/img/dashboard/profile.png';
             }else{
                 $logo ='assets/img/profile/pelamar/'.$pelamar->gambar;
             }
             
         }elseif($users->role == 'perusahaan'){
             // mengambil data perusaahan yang sedang login
             $perusahaan = $this->M_perusahaan->getPerusahaan($users->id_users)->row();
             if(empty($perusahaan->logo)){
                 $logo = 'assets/img/dashboard/profile.png';
             }else{
                $logo = 'assets/img/profile/perusahaan/'.$perusahaan->logo;
             }
 
         }else{
             $logo = 'assets/img/dashboard/profile.png';
         };
 
         //kirim data ke view
         $data = array(
             'title' => 'Details Lowongan',
             'session_name' => $users->name,
             'role' => $users->role,
             'logo' => $logo,
             'css' => 'assets/css/landing/details.css'
         );

        // // lalu menganti %20(spasi di url) menjadi spasi biasa
        $perusahaan = str_replace("%20", " ", $nama_perusahaan);

        // // lalu menganti %20(spasi di url) menjadi spasi biasa
        $posisiLowongan = str_replace("%20", " ", $posisi);

        $data['datalowongan'] = $this->M_landing->getDataLowongan($posisiLowongan, $perusahaan);

        $this->load->view('landing/_partials/header', $data);
        $this->load->view('landing/detailLowongan');
        $this->load->view('landing/_partials/footer');

    }

    // function untuk upload CV
    public function uploadCV(){
        // get user
        $users = $this->M_auth->getUser($this->session->userdata('email'))->row();

        // ambil id_lowongan, posisi yang sedang dilamar, dan nama perusahaan yang disembunyiin
        $lowongan = $this->input->post('id_lowongan');
        $posisi = $this->input->post('posisi');
        $perusahaan = $this->input->post('perusahaan');

        // jika role
        if($users->role == "admin"){ // Jika Admin
            $this->SweetAlert('info', 'Informasi', 'Anda Tidak Bisa Melamar, Karena Anda Adalah Seorang Admin');          
            redirect('Balijobfinder/Details/'.$posisi.'/'.$perusahaan);

        }else if($users->role == "perusahaan"){ //Jika Perusahaan
            $this->SweetAlert('info', 'Informasi', 'Anda Tidak Bisa Melamar, Karena Anda Adalah Perusahaan');          
            redirect('Balijobfinder/Details/'.$posisi.'/'.$perusahaan);

        }else{ // Jika Pelamar

            // get data pelamar
            $pelamar = $this->M_pelamar->getDataPelamar($users->id_users)->row();

            // cek jika pelamar sudh pernah melamar, namun memiliki status diterima dan belum dikonfrimasi
            $cekBelum = $this->M_landing->CekLamaranStatusBelum($pelamar->id_pelamar, $lowongan);
            $cekTerima = $this->M_landing->CekLamaranStatusTerima($pelamar->id_pelamar, $lowongan);

            if($cekBelum > 0){
                $this->SweetAlert('warning', 'Informasi', 'Anda Sudah Melamar Pekerjaan Ini, Silahkan Menunggu Konfrimasi');          
                redirect('Balijobfinder/Details/'.$posisi.'/'.$perusahaan);
            }else{
                if($cekTerima > 0){
                    $this->SweetAlert('warning', 'Informasi', 'Anda Sudah Melamar Pekerjaan Ini, Silahkan Menunggu Balasan Dari Perusahaan');          
                    redirect('Balijobfinder/Details/'.$posisi.'/'.$perusahaan);
                }else{
                    if (!empty($_FILES['cv']['name'])) {
        
                        // Config untuk upload file berupa foto
                        $config['upload_path']   = './assets/CV/'; //tempat upload CV nanti
                        $config['allowed_types'] = 'pdf'; // esktesion yang diperbolehkan
                        $config['max_size']      = 5028; // set ukuran menjadi 5mb
                        $config['file_name'] = date("his").'_'.$_FILES['cv']['name'];
                
                        $this->load->library('upload', $config); 
                
                        //jika file gambar diupload
                        if ($this->upload->do_upload('cv')) {
                            // upload
                            $upload_data = $this->upload->data();
                
                            // menyimpan lcvgo ke database
                            $this->M_landing->UploadPathCV($pelamar->id_pelamar, $upload_data['file_name'], $lowongan);
            
                            $this->SweetAlert('success', 'Berhasil', 'Selamat, Anda Berhasil Melamar Pekerjaan, Silahkan Menunggu Konfirmasi Dari Perusahaan');           
                            redirect('Balijobfinder/Details/'.$posisi.'/'.$perusahaan);
                            
                        } else {
                            // mengatasi jika error
                            $this->SweetAlert('error', 'Gagal', 'Silahkan Upload File Dengan Format .pdf Dengan Ukuran Di bawah 5MB'); 
                            redirect('Balijobfinder/Details/'.$posisi.'/'.$perusahaan);
                        }
                    }
                }
            }
        }


    } 




}

/* End of file balijobfinder.php */
