<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Balijobfinder extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model(array('M_auth', 'M_perusahaan', 'M_pelamar', 'M_landing'));
        // $this->load->model();
        $this->load->library('form_validation'); 
    }

    public function index(){
        redirect('Balijobfinder/home', 'refresh');
    }

    // function ngecek digunakan untuk ngecek sudah login apa blm
    public function cek(){
        if(!$this->session->userdata('email')){
            
            redirect('Auth/Login');
            
        }
    }

    public function home()
    {
        // get data email
        $email = $this->session->userdata('email');

        // ambil id_users
        $datas = $this->M_auth->getUser($email);

        if($datas){
            // mengambil gambar profile berdasarkan role
            if($datas->role == 'pelamar'){
                // mengambil data pelamar yang sedang login
                $pelamar = $this->M_pelamar->getPelamar($datas->id_users)->row();
                if(empty($pelamar->gambar)){
                    $logo = 'assets/img/dashboard/profile.png';
                }else{
                    $logo = $pelamar->gambar;
                }
                
            }elseif($datas->role == 'perusahaan'){
                // mengambil data perusaahan yang sedang login
                $perusahaan = $this->M_perusahaan->getPerusahaan($datas->id_users)->row();
                if(empty($perusahaan->logo)){
                    $logo = 'assets/img/dashboard/profile.png';
                }else{
                    $logo = $perusahaan->logo;
                }

            }else{
                $logo = 'assets/img/dashboard/profile.png';
            };

            // kirim data ke dalam view dengan session
            $data = array(
                'title' => 'Bali Job Finder',
                'css' => 'assets/css/landing/landing.css',
                'session_name' => $datas->name,
                'role' => $datas->role,
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

        // get data email
        $email = $this->session->userdata('email');

        // ambil id_users berdasarkan email
        $datas = $this->M_auth->getUser($email);

        // mengambil gambar profile
        if($datas->role == 'pelamar'){
            // mengambil data pelamar yang sedang login
            $pelamar = $this->M_pelamar->getPelamar($datas->id_users)->row();
            if(empty($pelamar->gambar)){
                $logo = 'assets/img/dashboard/profile.png';
            }else{
                $logo = $pelamar->gambar;
            }
            
        }elseif($datas->role == 'perusahaan'){
            // mengambil data perusaahan yang sedang login
            $perusahaan = $this->M_perusahaan->getPerusahaan($datas->id_users)->row();
            if(empty($perusahaan->logo)){
                $logo = 'assets/img/dashboard/profile.png';
            }else{
                $logo = $perusahaan->logo;
            }

        }else{
            $logo = 'assets/img/dashboard/profile.png';
        };

        //kirim data ke view
        $data = array(
            'title' => 'Lowongan Kerja',
            'session_name' => $datas->name,
            'role' => $datas->role,
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

        $jumlah_data = $this->M_landing->jumlahLowongan();

        $config['base_url'] = base_url(). 'Balijobfinder/Lowongan';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 16;

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
    public function Details(){
         // pengecekan jika blm login 
         $this->cek();

         // get data email
         $email = $this->session->userdata('email');
 
         // ambil id_users berdasarkan email
         $datas = $this->M_auth->getUser($email);
 
         // mengambil gambar profile berdasarkan role
         if($datas->role == 'pelamar'){
             // mengambil data pelamar yang sedang login
             $pelamar = $this->M_pelamar->getPelamar($datas->id_users)->row();
             if(empty($pelamar->gambar)){
                 $logo = 'assets/img/dashboard/profile.png';
             }else{
                 $logo = $pelamar->gambar;
             }
             
         }elseif($datas->role == 'perusahaan'){
             // mengambil data perusaahan yang sedang login
             $perusahaan = $this->M_perusahaan->getPerusahaan($datas->id_users)->row();
             if(empty($perusahaan->logo)){
                 $logo = 'assets/img/dashboard/profile.png';
             }else{
                 $logo = $perusahaan->logo;
             }
 
         }else{
             $logo = 'assets/img/dashboard/profile.png';
         };

         //  get posisi lowongan dan nama perusahaan dari url
         $posisi = $this->input->get('lowongan');
         $perusahaan = $this->input->get('perusahaan');
 
         //kirim data ke view
         $data = array(
             'title' => 'Details Lowongan',
             'session_name' => $datas->name,
             'role' => $datas->role,
             'logo' => $logo,
             'css' => 'assets/css/landing/details.css'
         );

         $data['datalowongan'] = $this->M_landing->getDataLowongan($posisi, $perusahaan);

        $this->load->view('landing/_partials/header', $data);
        $this->load->view('landing/detailLowongan');
        $this->load->view('landing/_partials/footer');

    }

    public function uploadCV(){
        // get user
        $user = $this->M_auth->getUser($this->session->userdata('email'));

        // get data pelamar
        $pelamar = $this->M_landing->getPelamar($user->id_users);

        // ambil id_lowongan yang disembunyiin
        $lowongan = $this->input->post('id_lowongan');

        if (!empty($_FILES['cv']['name'])) {

            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/CV/'; //tempat upload CV nanti
            $config['allowed_types'] = 'pdf'; // esktesion yang diperbolehkan
            $config['max_size']      = 10000; // set ukuran menjadi 10mb
    
            $this->load->library('upload', $config); 
    
            //jika file gambar diupload
            if ($this->upload->do_upload('cv')) {
                // upload
                $upload_data = $this->upload->data();
                // lalu simpan pada path
                $logo_path = 'assets/CV/' . $upload_data['file_name'];
    
                // menyimpan lcvgo ke database
                $cv = $this->M_landing->UploadPathCV($pelamar->id_pelamar, $logo_path, $lowongan);

                if($cv){
                    $this->session->set_flashdata('pesan', "Berhasil Mengirim Lamaran Kerja");
                    redirect('Balijobfinder/home','refresh');
                    
                }
                
            } else {
                // mengatasi jika error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('Balijobfinder/home','refresh');
            }
        }

    }




}

/* End of file balijobfinder.php */
