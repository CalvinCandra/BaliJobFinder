<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('M_auth');
        $this->load->library('form_validation'); 
        $this->load->library('email'); 
    }


    public function index(){
        redirect('Auth/login');
    }

     // function buat alert
    public function SweetAlert($icon, $title, $text){
        $this->session->set_flashdata('swal_icon', $icon);
        $this->session->set_flashdata('swal_title', $title);
        $this->session->set_flashdata('swal_text', $text);
    }

// ==================================================================menampilkan halaman login
    public function login(){
        // data-data untuk ke view
        $data = array(
            'title' => 'Login',
            'css' => 'assets/css/auth/login.css',
        );
        // memanggil komponen view
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/_partials/footer');
    }

// ====================================================================menampilkan pilihan register
    public function register_pilihan(){
         // data-data untuk ke view
        $data = array(
            'title' => 'Register',
            'css' => 'assets/css/auth/regipil.css',
        );
        // memanggil komponen view
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/pilihan_register');
        $this->load->view('auth/_partials/footer');
    }

// ================================================================= Register  PELAMAR
    // menampilkan halaman register pelamar
    public function nampil_registerPelamar(){
         // data-data untuk ke view
        $data = array(
            'title' => 'Register',
            'css' => 'assets/css/auth/register.css',
        );
        // memanggil komponen view
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/register_pelamar');
        $this->load->view('auth/_partials/footer');
    }
    
    // register sebagai pelamar
    public function register_pelamar(){

        // set rules form validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',[
            'is_unique' => 'This Email has already register',
        ]);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]',[
            'in_lenght' => 'Your Passoword To Short',
        ]);
        $this->form_validation->set_rules('confrim', 'Confrim Password', 'trim|required|matches[password]',[
            'matches' => 'Your Passoword Dont Matches',
        ]);

        // jika rules form validation ada yang melanggar, maka akan menampilkan pesannya pada view
        if ($this->form_validation->run() == FALSE) {
             // data-data untuk ke view
            $data = array(
                'title' => 'Register',
                'css' => 'assets/css/auth/register.css',
            );
            // memanggil komponen view
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/register_pelamar');
            $this->load->view('auth/_partials/footer');
        } else { //jika tidak ada 

            // manggil function regisPelamar di M_auth
            $this->M_auth->regisPelamar();

            $this->SweetAlert('success', 'Berhasil!', 'Selamat, Anda Berhasil Membuat Akun. Silahkan Verifikasi Akun Anda Di Gmail');
            redirect('Auth/login');
            
        }
    }


// ===================================================================== Register PERUSAHAAN
    // menampilkan halaman register perusaahaan
    public function nampil_registerPerusahaan(){
         // data-data untuk ke view
        $data = array(
            'title' => 'Register',
            'css' => 'assets/css/auth/register.css',
        );
        // memanggil komponen view
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/register_perusahaan');
        $this->load->view('auth/_partials/footer');
    }

    // register sebagai perusahaan
    public function register_perusahaan(){
        // set rules form validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',[
            'is_unique' => 'This Email has already register',
        ]);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]',[
            'in_lenght' => 'Your Passoword To Short',
        ]);
        $this->form_validation->set_rules('confrim', 'Confrim Password', 'trim|required|matches[password]',[
            'matches' => 'Your Passoword Dont Matches',
        ]);

        // jika rules form validation ada yang melanggar, maka akan menampilkan pesannya pada view
        if ($this->form_validation->run() == FALSE) {
            // data-data untuk ke view
            $data = array(
                'title' => 'Register',
                'css' => 'assets/css/auth/register.css',
            );
            // memanggil komponen view
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/register_perusahaan');
            $this->load->view('auth/_partials/footer');
        } else {
            // manggil function regisPerusahaan di M_auth
            $this->M_auth->regisPerusahaan();

            $this->SweetAlert('success', 'Berhasil!', 'Selamat, Anda Berhasil Membuat Akun. Silahkan Verifikasi Akun Anda Di Gmail');
            redirect('Auth/login'); 
        }
    }

//=============================================================================== Verify akun agar bisa login
    public function verify(){
        // ngambil dari url (get)
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // ambil data users
        $user = $this->M_auth->getUser($email);

        //jika ada users
        if($user){
           // jika token sama dengan token di database
           if($token === $user->token){

                // manggil function email_verified di M_auth
                $this->M_auth->email_verified($user->id_users);

                // kirim flashdata ke view
                $this->SweetAlert('success', 'Berhasil!', 'Selamat! Akun Anda Berhasil Di Verifikasi. Silahkan Login Kembali');
                redirect('Auth/login');
            }else{ //jika tidak

                // kirim flashdata ke view
                $this->SweetAlert('error', 'Gagal!', 'Aktivasi Akun Gagal, Token Tidak Cocok');
                redirect('Auth/login');
            }
        }else{ //jika tidak

            // kirim flashdata ke view
            $this->SweetAlert('error', 'Gagal!', 'Aktivasi Akun Gagal, Email Tidak Cocok');
            redirect('Auth/login');
        }
    }

// ======================================================================== Forget Password
    // mmenampilkan input email untuk forget akun
    public function VForget(){
        // data-data untuk ke view
       $data = array(
           'title' => 'Forget Password',
           'css' => 'assets/css/auth/forget.css',
       );
       // memanggil komponen view
       $this->load->view('auth/_partials/header', $data);
       $this->load->view('auth/forget/forget');
       $this->load->view('auth/_partials/footer');
   }

    //function mengirim pesan ke email saat forget
    public function KirimEmailPassForget(){

        // mengambil data inputan user
        $email = $this->input->post('email');

       // set rules form validation
       $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

       // jika rules form validation ada yang melanggar, maka akan menampilkan pesannya pada view
       if ($this->form_validation->run() == FALSE) {
            // data-data untuk ke view
           $data = array(
               'title' => 'Forget Password',
               'css' => 'assets/css/auth/forget.css',
           );
           // memanggil komponen view
           $this->load->view('auth/_partials/header', $data);
           $this->load->view('auth/forget/forget');
           $this->load->view('auth/_partials/footer');
       } else {

           // ambil data users
           $data = $this->M_auth->getUser($email);
           // mengecek apakah email sudah terdaftar apa belum
           if($data->email === $email){
               $this->M_auth->kirimChangeForget($email, $data->id_users);
               $this->SweetAlert('success', 'Berhasil!', 'Link Ganti Password Berhasil Terkirim Ke Email Anda, Silakan Klik Link Yang Dikirim');
               redirect('Auth/VForget');
           }else{
                $this->SweetAlert('error', 'Gagal!', 'Email Tidak Cocok');
                redirect('Auth/login');
           }
       }
    }

    // menampilkan halaman form update
    public function ForgetPassword(){
        // ngambil dari url (get)
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // ambil data users
        $user = $this->M_auth->getUser($email);

        //jika ada users
        if($user){
           // jika token sama dengan token di database
           if($token === $user->token){
               $data=[
                   'users' =>$user->id_users
               ];
               $this->load->view('auth/forget/formForget', $data);
           }else{ //jika token berbeda
                $this->SweetAlert('error', 'Gagal!', 'Token Tidak Cocok');
                redirect('Auth/login');
           }
        }else{ //jika email blm register
            $this->SweetAlert('error', 'Gagal!', 'Tidak Cocok');
            redirect('Auth/login');
        }
    }

    // proses ubah password
    public function prosesForget(){
        //set rules
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]',[
            'in_lenght' => 'Your Passoword To Short',
        ]);
        $this->form_validation->set_rules('confrim', 'Confrim Password', 'required|matches[password]',[
            'matches' => 'Your Passoword Dont Matches',
        ]);

        // jika rules form validation ada yang melanggar, maka akan menampilkan pesannya pada view
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('auth/forget/formForget');
        } else {
            // panggil function forget di M_auth
            $this->M_auth->forget();
            
            $this->SweetAlert('success', 'Berhasil!', 'Selamat! Berhasil Mengganti Password Akun Anda. Silahkan Login Dengan Password Baru');
            redirect('Auth/login');
        }
        
    }


// =============================================================================== LOGIN ALL USER
    public function proses_login(){
         // set rules form validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

       // jika rules form validation ada yang melanggar, maka akan menampilkan pesannya pada view
       if ($this->form_validation->run() == FALSE) {
             // data-data untuk ke view
            $data = array(
                'title' => 'Login',
                'css' => 'assets/css/auth/login.css'
            );
            // memanggil komponen view
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/_partials/footer');

       }else {

            //ambil data inputan user
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // get data Users
            $data = $this->M_auth->getUser($email);

            // ngecek apakah ada usernya
            if($data){
                // jika ada, cek passwordnya apakah sama dengan database
                if(password_verify($password, $data->password) || $data->password == $password){
                    // jika password sudah sama, cek apakah sudah di verifikasi email
                    if($data->email_verified == NULL){
                        $this->SweetAlert('error', 'Gagal!', 'Akun Belum Terverifikasi, Silahkan Verifikasi');
                        redirect('Auth/login');
                    }else{
                        // jika sudah, pindahkan sesuai role mereka
                        if($data->role == "pelamar"){
                            // set session
                            $data_session = array(
                                'email' => $data->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);
                            redirect('Pelamar');

                        }else if($data->role == "perusahaan"){

                            // set session
                            $data_session = array(
                                'email' => $data->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);  
                            redirect('Perusahaan'); 

                        }else{

                            // set session
                            $data_session = array(
                                'email' => $data->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);  
                            redirect('Admin'); 
                            
                        }
                    }
                }else{ //jika password salah
                    $this->SweetAlert('error', 'Gagal!', 'Password Tidak Sama');
                    redirect('Auth/login');
                }
            }else{ //jika email blm terdaftar
                $this->SweetAlert('error', 'Gagal!', 'Email Belum Terdaftar');
                redirect('Auth/login');
            }
       }
           
    }

// ======================================================================== logout
    public function logout(){
        // hapus semua session
        session_destroy();
        redirect('Auth/login');
    }
       

}

/* End of file Auth.php */
