<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->model(array('M_auth', 'M_pelamar', 'M_pendidikan','M_pengalaman','M_skill'));

        $this->load->library('form_validation');
    }

    public function index(){
        redirect('Pelamar/home');
    }

    public function home()
    {

        // get id_user sesuai email yang login
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // get semua data Pelamar
        $Datapelamar = $this->M_pelamar->getDataPelamar($user_id->id_users);
        // ubah menjadi row
        $pelamar = $Datapelamar->row();

        $data = array(
            'profile'=> $Datapelamar->result_array(),
            'session' => $user_id->name,
            'totalLamaran' => $this->M_pelamar->LamaranCount($pelamar->id_pelamar),
        );
 
        $this->template->load('pelamar/template' , 'pelamar/pelamar', $data);
           
    }
    
    public function managementStatus()
    {
        // get id_user sesuai email yang login
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // get semua data Pelamar
        $Datapelamar = $this->M_pelamar->getDataPelamar($user_id->id_users);
        // ubah menjadi row
        $pelamar = $Datapelamar->row();

        $data = array(
            'profile'=> $Datapelamar->result_array(),
            'session' => $user_id->name,
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
        $data['lamaran'] = $this->M_pelamar->getStatusLamaran($user_id->id_users,$config['per_page'],$data['start'],$data['keyword']);

        $this->template->load('pelamar/template' , 'pelamar/management_lamaran', $data);
    }

    public function profile()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));

        // ambil data pelamar berdasarkan id_users yang login
        $Datapelamar = $this->M_pelamar->getDataPelamar($user_id->id_users);

        // ubah data pelamar menjadi row, agar bisa mengambil id_pelamar untuk paramter
        $pelamar = $Datapelamar->row();
        
        // kirim data-data pada view
        $data = array(
            // mengirim data pelamar yang polosan dalam bentuk array
            'profile' => $Datapelamar->result_array(),
            // mengirim data pendidikan yang polosan dalam bentuk array
            'pendidikan'=> $this->M_pendidikan->getDataPendidikan($pelamar->id_pelamar)->result_array(),
            // mengirim data pengalaman yang polosan dalam bentuk array
            'pengalaman'=> $this->M_pengalaman->getDataPengalaman($pelamar->id_pelamar)->result_array(),
            // mengirim data skill yang polosan dalam bentuk array
            'skill'=> $this->M_skill->getDataSkill($pelamar->id_pelamar)->result_array(),
            'session' => $user_id->name
        );
        
        $this->template->load('pelamar/template','pelamar/profile_pelamar',$data);
    }

    public function simpanProfile()
    {
        // ambil id_users
        $user_id = $this->M_auth->getUser($this->session->userdata('email'));
    
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
                $logo_path = 'assets/img/profile/pelamar/' . $upload_data['file_name'];
    
                // menyimpan logo ke database
                $this->M_perusahaan->saveLogoPath($user_id->id_users, $logo_path);
            } else {
                // mengatasi jika error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('upload_error', $error);
            }
        }

        $this->M_pelamar->simpanProfile($user_id->id_users);
        redirect('pelamar/profile');
    }
}
/* End of file Pelamar.php */