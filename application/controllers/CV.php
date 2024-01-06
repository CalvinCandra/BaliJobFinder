<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class CV extends CI_Controller {
    public function __construct(){
        parent:: __construct();

        $this->load->model(array('M_auth', 'M_CV', 'M_pelamar'));

        $this->load->library('form_validation'); 
    }

    public function GenerateCV(){

        // get session email
        $email = $this->session->userdata('email');

        //get user
        $pelamar = $this->M_auth->getUser($email);

        //get data-data pelamar
        $data_pelamar = $this->M_pelamar->getDataPelamar($pelamar->id_users)->row();

        // get data pendidikan
        $data_pendidikan = $this->M_CV->getDataPendidikan($data_pelamar->id_pelamar)->result_array();
        
        // get data pengalaman
        $data_pengalaman = $this->M_CV->getDataPengalaman($data_pelamar->id_pelamar)->result_array();
        
        // get data skill
        $data_skill = $this->M_CV->getDataSkill($data_pelamar->id_pelamar)->result_array();

        // DOMPDF
        $this->load->library('pdfgenerator');

        $data['title'] = "Curriculum vitae";

        $file_pdf = $data['title'];

        $paper = 'A4';

        $orientation = "portrait";

        $data=array(
            'email_pelamar' => $pelamar->email,
            'nama_pelamar' => $data_pelamar->nama_lengkap,
            'deskripsi_pelamar' =>$data_pelamar->deskripsi_pelamar,
            'no_hp' =>$data_pelamar->no_hp,
            'alamat' =>$data_pelamar->alamat,
            'foto' =>$data_pelamar->gambar,
            'pendidikan' =>$data_pendidikan,
            'pengalaman' =>$data_pengalaman,
            'skill' =>$data_skill,
        );

        $html =  $this->load->view('Cv/LayoutCVNew', $data, TRUE);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

}

/* End of file CV.php */
