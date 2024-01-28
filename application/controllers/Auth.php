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

    // function menampikan form login
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

    // function menampilkan pilihan register
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

    // function menampilkan halaman register pelamar
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
    
    // function register sebagai pelamar
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

            // get inputan data yang ada di form
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $name = $this->input->post('name');

            // manggil function regisPelamar di M_auth
            $this->M_auth->regisPelamar($email, htmlspecialchars(password_hash($pass, PASSWORD_DEFAULT)), $name);

            $this->SweetAlert('success', 'Berhasil!', 'Selamat, Anda Berhasil Membuat Akun. Silahkan Verifikasi Akun Anda Di Gmail');
            redirect('Auth/login');
            
        }
    }

    // function menampilkan halaman register perusaahaan
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

    // function register sebagai perusahaan
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

            // get inputan data yang ada di form
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $name = $this->input->post('name');

            // manggil function regisPerusahaan di M_auth
            $this->M_auth->regisPerusahaan($email, htmlspecialchars(password_hash($pass, PASSWORD_DEFAULT)), $name);

            $this->SweetAlert('success', 'Berhasil!', 'Selamat, Anda Berhasil Membuat Akun. Silahkan Verifikasi Akun Anda Di Gmail');
            redirect('Auth/login'); 
        }
    }

    // function untuk melakukan verifikasi
    public function verify(){
        // ngambil dari url (get)
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // ambil data users
        $user = $this->M_auth->getUser($email)->row();

        //jika ada users
        if($user){
           // jika token sama dengan token di database menggunakan fungsi hash_equals
           if(hash_equals($token, $user->token)){

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

    // function untuk menampilkan halaman halaman form email untuk change password
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

    //function mengirim pesan ke email untuk change password
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
           $user = $this->M_auth->getUser($email)->row();

           // mengecek apakah email sudah terdaftar apa belum
           if($user->email === $email){
               $this->M_auth->kirimChangeForget($email, $user->id_users);
               $this->SweetAlert('success', 'Berhasil!', 'Link Ganti Password Berhasil Terkirim Ke Email Anda, Silakan Klik Link Yang Dikirim');
               redirect('Auth/VForget');
           }else{
                $this->SweetAlert('error', 'Gagal!', 'Email Tidak Cocok');
                redirect('Auth/login');
           }
       }
    }

    // function untuk menmapilkan halaman change password
    public function ForgetPassword(){
        // ngambil dari url (get)
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // ambil data users
        $user = $this->M_auth->getUser($email)->row();

        //jika ada users
        if($user){
           // jika token sama dengan token di database
           if(hash_equals($token, $user->token)){
                $data = array(
                    'title' => 'Forget Password',
                    'css' => 'assets/css/auth/forget.css',
                    'users' => $user->id_users
                );
                // memanggil komponen view
                $this->load->view('auth/_partials/header', $data);
                $this->load->view('auth/forget/formForget');
                $this->load->view('auth/_partials/footer');

           }else{ //jika token berbeda
                $this->SweetAlert('error', 'Gagal!', 'Token Tidak Cocok');
                redirect('Auth/login');
           }
        }else{ //jika email blm register
            $this->SweetAlert('error', 'Gagal!', 'Email Tidak Cocok');
            redirect('Auth/login');
        }
    }

    // function untuk proses change password
    public function prosesForget(){
        // ambil data input user
        $pass = $this->input->post('password');
        $id_users = $this->input->post('users');

        //set rules
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]',[
            'in_lenght' => 'Your Passoword To Short',
        ]);
        $this->form_validation->set_rules('confrim', 'Confrim Password', 'required|matches[password]',[
            'matches' => 'Your Passoword Dont Matches',
        ]);

        // jika rules form validation ada yang melanggar, maka akan menampilkan pesannya pada view
        if ($this->form_validation->run() == FALSE) {

            $data = array(
                'title' => 'Forget Password',
                'css' => 'assets/css/auth/forget.css',
                'users' => $id_users
            );
            // memanggil komponen view
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/forget/formForget');
            $this->load->view('auth/_partials/footer');

        } else {

            // panggil function forget di M_auth
            $this->M_auth->forget(htmlspecialchars(password_hash($pass, PASSWORD_DEFAULT)), $id_users);
            
            $this->SweetAlert('success', 'Berhasil!', 'Selamat! Berhasil Mengganti Password Akun Anda. Silahkan Login Dengan Password Baru');
            redirect('Auth/login');
        }
        
    }

    // function untuk proses multiuser
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
            $users = $this->M_auth->getUser($email)->row();

            // ngecek apakah ada usernya
            if($users){
                // jika ada, cek passwordnya apakah sama dengan database
                if(password_verify($password, $users->password) || $users->password == $password){
                    // jika password sudah sama, cek apakah sudah di verifikasi email
                    if($users->email_verified == NULL){
                        $this->SweetAlert('error', 'Gagal!', 'Akun Belum Terverifikasi, Silahkan Verifikasi');
                        redirect('Auth/login');
                    }else{
                        // jika sudah, pindahkan sesuai role mereka
                        if($users->role == "pelamar"){
                            // set session
                            $data_session = array(
                                'email' => $users->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);
                            redirect('Pelamar');

                        }else if($users->role == "perusahaan"){

                            // set session
                            $data_session = array(
                                'email' => $users->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);  
                            redirect('Perusahaan'); 

                        }else{

                            // set session
                            $data_session = array(
                                'email' => $users->email,
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

    // function untuk logout
    public function logout(){
        // hapus semua session
        session_destroy();
        redirect('Balijobfinder');
    }
       

}

/* End of file Auth.php */
