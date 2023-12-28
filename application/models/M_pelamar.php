<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_pelamar extends CI_Model {
        // get data pelamar
        public function getDataPelamar($user_id)
        {
            return $this->db->get_where('data_pelamar', array('fk_id_users' => $user_id));
        }
   
        public function lamaran($user_id)
        {
            $this->db->select('*');
            $this->db->from('lamaran');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
            $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
            $this->db->where('data_pelamar.fk_id_users', $user_id);

            $result = $this->db->get();
            return $result;
        }
        public function simpanProfile($user_id)
        {
            // ambil data yang di input user
            $edit = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),   
            );
            // ambil data id
            $this->db->where('id_pelamar', $this->input->post('id'));

            // update
            $result = $this->db->update('data_pelamar', $edit);

            if ($result) {
                // Jika update data perusahaan sukses, update juga nama perusahaan di tabel users
                $nama_pelamar_baru = $this->input->post('nama_lengkap');
                $this->db->where('id_users', $user_id);
                $this->db->update('users', ['name' => $nama_pelamar_baru]);
            }
            return $result;


    }
}
    /* End of file perusahaan.php */