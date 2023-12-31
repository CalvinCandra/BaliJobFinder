<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent:: __construct();

        // jika user blm login redirect ke halaman login
        if(!$this->session->userdata('email')){
            redirect('Auth/Login');
        }
        $this->load->model(array('M_auth', 'M_admin'));
        
        $this->load->library('form_validation');
    }

    // Fungsi ini akan meredirect ke fungsi home
    public function index(){
        redirect('Admin/home');
    }

    // Fungsi untuk menampilkan halaman dashboard admin
    public function home()
    {
        // Mendapatkan data user dari session
        $email = $this->session->userdata('email');

        $datas = $this->M_auth->getUser($email);
        
        if($datas){
            $data = array(
                'session' => $datas->name,
                'totalLowongan' =>  $this->M_admin->LowonganCount(),
                'totalPerusahaan' =>  $this->M_admin->PerusahaanCount(),
                'totalPelamar' =>  $this->M_admin->PelamarCount(),
            );

        }
        // Menampilkan halaman dashboard dengan template
        $this->template->load('admin/template','admin/Dashboard',$data);
        
    }


    
    // Fungsi untuk menampilkan data lowongan pekerjaan
    // dan melakukan operasi pencarian dengan pagination
    public function datalowongan()
    {
        // Mendapatkan data user dari session
        $email = $this->session->userdata('email');
        $datas = $this->M_auth->getUser($email);

        $data = array(
            'session' => $datas->name,
        );
        
        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword']=$this->session->userdata('keyword');
        }

        // Konfigurasi pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/admin/dataLowongan';
        $config['total_rows'] = $this->M_admin->LowonganCount($data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;    

        // initialize pagination
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['lowongan_kerja'] = $this->M_admin->getLowongan($config['per_page'],$data['start'],$data['keyword']);
        $this->template->load('admin/template','admin/management',$data);
    }

    
    // Fungsi untuk menampilkan data pelamar pekerjaan
    // dan melakukan operasi pencarian dengan pagination
    public function dataPelamar()
    {
        // Mendapatkan data user dari session
        $email = $this->session->userdata('email');
        $datas = $this->M_auth->getUser($email);

        $data = array(
            'session' => $datas->name,
        );
        
        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['key_pelamar'] = $this->input->post('keyword');
            $this->session->set_userdata('key_pelamar',$data['key_pelamar']);
        }else{
            $data['key_pelamar']=$this->session->userdata('key_pelamar');
        }

        // Konfigurasi  pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/admin/dataPelamar';
        $config['total_rows'] = $this->M_admin->PelamarCount($data['key_pelamar']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;    

        // initialize pagination
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['pelamar'] = $this->M_admin->getDataPelamar($config['per_page'],$data['start'],$data['key_pelamar']);

        $this->template->load('admin/template','admin/data_pelamar',$data);
    }


    // Fungsi untuk menampilkan data perusahaan
    // dan melakukan operasi pencarian dengan pagination
    public function dataPerusahaan()
    {
        // Mendapatkan data user dari session
        $email = $this->session->userdata('email');
        $datas = $this->M_auth->getUser($email);
  
        $data = array(
            'session' => $datas->name,
        );
            
        // ambil data dari kolom pencarian
        if($this->input->post('cari')){
            $data['key_perusahaan'] = $this->input->post('keyword');
            $this->session->set_userdata('key_perusahaan',$data['key_perusahaan']);
        }else{
            $data['key_perusahaan']=$this->session->userdata('key_perusahaan');
        }

        // Konfigurasi  pagination
        $config['base_url'] = 'http://localhost/BaliJobFinder/admin/dataPerusahaan';
        $config['total_rows'] = $this->M_admin->PerusahaanCount($data['key_perusahaan']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;    

        // initialize pagination
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['perusahaan'] = $this->M_admin->getDataPerusahaan($config['per_page'],$data['start'],$data['key_perusahaan']);

        $this->template->load('admin/template','admin/data_perusahaan',$data);
    }

    
    // Fungsi untuk melakukan edit data lowongan
    public function editLowongan()
    {
        $this->M_admin->editLowongan();
        redirect('admin/dataLowongan');
        
    }

    // Fungsi untuk menghapus data lowongan berdasarkan ID
    public function deleteLowongan($id)
    {
        $this->M_admin->deleteLowongan($id );
        redirect('admin/dataLowongan'); 
    }


    // Fungsi untuk melakukan edit data perusahaan
    public function editperusahaan()
    {
        // melakukan pengecekan apakah ada logo di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {
            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/img/profile/perusahaan';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 2048; // 2MB
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('logo_file')) {
                $upload_data = $this->upload->data();
                $logo_path = 'assets/img/profile/perusahaan/' . $upload_data['file_name'];
    
                // menyimpan logo ke database
                $this->M_admin->SavelogoPerusahaan($logo_path);
            } else {
                // mengatasi jika error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('upload_error', $error);
            }
        }

        $this->M_admin->editPerusahaan();
        redirect('admin/dataPerusahaan');
        
    }

    
    // Fungsi untuk menghapus data perusahaan berdasarkan ID
    public function deleteperusahaan($id)
    {
        $this->M_admin->deleteperusahaan($id);
        redirect('admin/dataPerusahaan'); 
    }

    // Fungsi untuk melakukan edit data pelamar
    public function editpelamar()
    {
        // melakukan pengecekan apakah ada file di unggah atau tidak
        if (!empty($_FILES['logo_file']['name'])) {
            // Config untuk upload file berupa foto
            $config['upload_path']   = './assets/img/profile/pelamar';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 2048; // 2MB
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('logo_file')) {
                $upload_data = $this->upload->data();
                $logo_path = 'assets/img/profile/pelamar/' . $upload_data['file_name'];
    
                // menyimpan logo ke database
                $this->M_admin->SavelogoPelamar($logo_path);
            } else {
                // mengatasi jika error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('upload_error', $error);
            }
        }

        $this->M_admin->editpelamar();
        redirect('admin/dataPelamar');
        
    }

    // Fungsi untuk menghapus data pelamar berdasarkan ID
    public function deletepelamar($id)
    {
        $this->M_admin->deletepelamar($id );
        redirect('admin/dataPelamar'); 
    }
    

}

/* End of file Admin.php */
