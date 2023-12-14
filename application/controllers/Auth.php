<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('M_auth');
        $this->load->library('form_validation'); 
        $this->load->library('email'); 
    }

    public function template(){
        $this->load->view('auth/verify/template');
    }

    public function index()
    {
        redirect('Auth/login');
    }

// ==================================================================menampilkan halaman login
    public function login(){
        $data = array(
            'title' => 'Login',
            'css' => 'assets/css/auth/loginn.css',
        );
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/_partials/footer');
    }

// ====================================================================menampilkan pilihan register
    public function register_pilihan(){
        $data = array(
            'title' => 'Register',
            'css' => 'assets/css/auth/regipil.css',
        );
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/pilihan_register');
        $this->load->view('auth/_partials/footer');
    }

    // menampilkan halaman register pelamar
    public function nampil_registerPelamar(){
        $data = array(
            'title' => 'Register',
            'css' => 'assets/css/auth/register.css',
        );
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/register_pelamar');
        $this->load->view('auth/_partials/footer');
    }
    
// ================================================================= Register  PELAMAR
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

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register',
                'css' => 'assets/css/auth/register.css',
            );
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/register_pelamar');
            $this->load->view('auth/_partials/footer');
        } else {
            $this->M_auth->regisPelamar();     
            $this->session->set_flashdata('pesan','Congratulation! your account has been created. Please Activated Your Account On Gmail'); 
            redirect('Auth/login');
            
        }
    }


// ===================================================================== Register PERUSAHAAN
    // menampilkan halaman register perusaahaan
    public function nampil_registerPerusahaan(){
        $data = array(
            'title' => 'Register',
            'css' => 'assets/css/auth/register.css',
        );
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/register_perusahaan');
        $this->load->view('auth/_partials/footer');
    }

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

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register',
                'css' => 'assets/css/auth/register.css',
            );
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/register_perusahaan');
            $this->load->view('auth/_partials/footer');
        } else {
            $this->M_auth->regisPerusahaan();
            $this->session->set_flashdata('pesan','Congratulation! your account has been created. Please Activated Your Account On Gmail');   
            redirect('Auth/login');  
        }
    }

//=============================================================================== Verify akun agar bisa login
    public function verify(){
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->M_auth->getUser($email);

        if($user){
            if($token === $user->token){
                $this->M_auth->email_verified();
                $this->session->set_flashdata('pesan','Congratulation! your account has been Activated. Please Login');  
                redirect('Auth/login');
            }else{
                $this->session->set_flashdata('error','Account Activation Failed. Wrong Token.');  
                redirect('Auth/login'); 
            }
        }else{
            $this->session->set_flashdata('error','Account Activation Failed. Wrong Email.');  
            redirect('Auth/login'); 
        }
    }


// =============================================================================== LOGIN ALL USER
    public function proses_login(){
         // set rules form validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

       
       if ($this->form_validation->run() == FALSE) {
            // panggil view
            $data = array(
                'title' => 'Login',
                'css' => 'assets/css/auth/login.css'
            );
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/_partials/footer');

       }else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $data = $this->M_auth->getUser($email);

            // ngecek apakah ada usernya
            if($data){
                // jika ada, cek passwordnya apakah sama dengan database
                if(password_verify($password, $data->password) || $data->password == $password){
                    // jika password sudah sama, cek apakah sudah di verifikasi email
                    if($data->email_verified == NULL){
                        $this->session->set_flashdata('error','Account not Verify, Please Verify on Gmail');  
                        redirect('Auth/login'); 
                    }else{
                        // jika sudah, pindahkan sesuai role mereka
                        if($data->role == "pelamar"){
                            $this->session->set_flashdata('pesan','Login Success');
                            // set session
                            $data_session = array(
                                'email' => $data->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);
                            redirect('Pelamar'); 
                        }else if($data->role == "perusahaan"){
                            $this->session->set_flashdata('pesan','Login Success');
                            // set session
                            $data_session = array(
                                'email' => $data->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);  
                            redirect('Perusahaan'); 
                        }else{
                            $this->session->set_flashdata('pesan','Login Success');
                            // set session
                            $data_session = array(
                                'email' => $data->email,
                            );  
                            // kirim session
                            $this->session->set_userdata($data_session);  
                            redirect('Admin'); 
                        }
                    }
                }else{
                    $this->session->set_flashdata('error','Wrong Password');  
                    redirect('Auth/login'); 
                }
            }else{
                $this->session->set_flashdata('error','Email is not Registered');  
                redirect('Auth/login'); 
            }
       }
           
    }

// ======================================================================== Forget Password
    // mmenampilkan input email untuk forget akun
    public function VForget(){
        $data = array(
            'title' => 'Forget Password',
            'css' => 'assets/css/auth/forget.css',
        );
        $this->load->view('auth/_partials/header', $data);
        $this->load->view('auth/forget/forget');
        $this->load->view('auth/_partials/footer');
    }

    //function mengirim pesan ke email
    public function KirimEmailPass(){
         // mengambil data inputan user
         $email = $this->input->post('email');

        // set rules form validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            // panggil view
            $data = array(
                'title' => 'Forget Password',
                'css' => 'assets/css/auth/forget.css',
            );
            $this->load->view('auth/_partials/header', $data);
            $this->load->view('auth/forget/forget');
            $this->load->view('auth/_partials/footer');
        } else {
            $data = $this->M_auth->getUser($email);
            // mengecek apakah email sudah terdaftar apa belum
            if($data->email === $email){
                $this->M_auth->kirimChange($email);
                $this->session->set_flashdata('pesan','Congratulation! Password Change link has been send. Please Check On Gmail');   
                redirect('Auth/VForget');
            }else{ 
                $this->session->set_flashdata('error','Email is not Registered');  
                redirect('Auth/login');  
            }
        }
    }

    // menampilkan halaman form update
    public function ForgetPassword(){
         // ngambil dari url (get)
         $email = $this->input->get('email');
         $token = $this->input->get('token');

         // ngecek apakah sudah terdaftar
         $user = $this->M_auth->getUser($email);
 
         if($user){
            if($token === $user->token){
                $this->load->view('auth/forget/formForget');
            }else{
                $this->session->set_flashdata('error','Link Failed. Wrong Token.');  
                redirect('Auth/login'); 
            }
         }else{
             $this->session->set_flashdata('error','Link Failed, Email Not Register');  
             redirect('Auth/login'); 
         }
    }

    // proses ubah password
    public function prosesForget(){
        //set rules
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]',[
            'in_lenght' => 'Your Passoword To Short',
        ]);
        $this->form_validation->set_rules('confrim', 'Confrim Password', 'trim|required|matches[password]',[
            'matches' => 'Your Passoword Dont Matches',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/forget/formForget');
        } else {
            $this->M_auth->forget();
            $this->session->set_flashdata('pesan','Congratulation! your password has been change. Please Login');  
            redirect('Auth/login');
        }
        
        
    }

// ======================================================================== logout
    public function logout(){
        session_destroy();
        redirect('Auth/login');
    }
       

}

/* End of file Auth.php */
