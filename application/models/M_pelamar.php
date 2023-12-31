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
                'deskripsi_pelamar' => $this->input->post('deskripsi'),
                   
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

        // get jumlah lamaran
        public function LamaranCount($id_pelamar,$keyword=null)
        {
            // join 3 table yaitu lowongan_kerja, data_pelamar, data_perusahaan
            $this->db->select('COUNT(*) as total_lamaran');
            $this->db->from('lamaran');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
            $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
            $this->db->where('lamaran.fk_id_pelamar', $id_pelamar);

            $query = $this->db->get();
            return $query->row()->total_lamaran;
        }

        // get data berdasarkan fk_id_pelamar
        public function getLamaran($id_pelamar){
            return $this->db->get_where('lamaran', array('fk_id_pelamar' => $id_pelamar));
        }

        public function getStatusLamaran($id_pelamar,  $limit, $start, $keyword = null){
            $this->db->select('*');
            $this->db->from('lamaran');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
            $this->db->where(array(
                'lamaran.fk_id_pelamar', $id_pelamar,
            ));

            // jika ada data yang dicari oleh user
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('nama_perusahaan', $keyword);
                $this->db->group_end();
            }

            // batasan pagination
            $this->db->limit($limit, $start);

            $result = $this->db->get();

            return $result;
        }
    

}
    /* End of file perusahaan.php */