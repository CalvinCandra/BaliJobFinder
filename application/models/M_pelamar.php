<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_pelamar extends CI_Model {
        // get data pelamar
        public function getDataPelamar($user_id)
        {
            return $this->db->get_where('data_pelamar', array('fk_id_users' => $user_id));
        }

        // get data pendidikan sesuai id yang dikirim
        public function getDataPendidikan($id_pelamar) {
            return $this->db->get_where('pendidikan', array('fk_id_pelamar' => $id_pelamar));
        }
        
        // get data pendidikan sesuai id yang dikirim
        public function getDataPengalaman($id_pelamar) {
            return $this->db->get_where('pengalaman', array('fk_id_pelamar' => $id_pelamar));
        }

        // get data pendidikan sesuai id yang dikirim
        public function getDataSkill($id_pelamar) {
            return $this->db->get_where('skil', array('fk_id_pelamar' => $id_pelamar));
        }

        // cek data profile apakah ada atau tidak
        public function cekData($id_pelamar){
            // jika data tidak ada
            if($this->db->get_where('data_pelamar', ['id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{
                $pelamar = $this->db->get_where('data_pelamar', ['id_pelamar' => $id_pelamar])->row();
                if(is_null($pelamar->gambar) || is_null($pelamar->alamat) || is_null($pelamar->no_hp)){
                    return 1;
                }else{
                    return 0;
                }
            }
        }
   
        // cek data pendidikan berdasarkan user yang login apakah ada atau tidak
        public function cekDataPendidikan($id_pelamar){
            // jika data pendidikan tidak ada
            if($this->db->get_where('pendidikan', ['fk_id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{ // jika data pendidikan ada
                return 0;
            }
        }
   
         // cek data pengalaman berdasarkan user yang login apakah ada atau tidak
        public function cekDataPengalaman($id_pelamar){
            // jika data pengalaman tidak ada
            if($this->db->get_where('pengalaman', ['fk_id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{ // jika data pengalaman ada
                return 0;
            }
        }

        // cek data skill berdasarkan user yang login apakah ada atau tidak
        public function cekDataSkill($id_pelamar){
            // jika data skill tidak ada
            if($this->db->get_where('skil', ['fk_id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{// jika data skill ada
                return 0;
            }
        }

        // get jumlah lamaran
        public function LamaranCount($id_pelamar)
        {
            $this->db->select('COUNT(*) as total_lamaran');
            $this->db->from('lamaran');
            // join table data_pelamar
            $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            $this->db->where('lamaran.fk_id_pelamar', $id_pelamar);

            return $this->db->get()->row()->total_lamaran;
        }

        // get jumlah lamaran yang statusnya belum terkonfirmasi
        public function LamaranCountStatus($id_pelamar)
        {
            $this->db->select('COUNT(*) as total');
            $this->db->from('lamaran');
            // join table data_pelamar
            $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            $this->db->where([
                'lamaran.fk_id_pelamar'=> $id_pelamar, 
                'lamaran.status_lamaran' => 'Belum Terkonfrimasi' 
            ]);
            return $this->db->get()->row()->total;
        }

        public function simpanProfile($user_id)
        {
            // ambil data yang di input user
            $edit = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
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

        // menyimpan logo
        public function saveLogoPath($id, $file_name)
        {
            // pilih id berdasarkan user yang upload
            $this->db->where('fk_id_users', $id);
            // update
            $this->db->update('data_pelamar', ['gambar' => $file_name]);
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

        // simpan data pendidikan
        public function SimpanPendidikan($id_pelamar){
            // membuat array untuk dimasukan kedalam database
            $data = array(
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'jenjang_pendidikan' => $this->input->post('jenjang_pendidikan'),
                'bidang_studi' => $this->input->post('bidang_studi'),
                'bulan_mulai' => $this->input->post('bulan_mulai'),
                'tahun_mulai' => $this->input->post('tahun_mulai'),
                'bulan_akhir' => $this->input->post('bulan_akhir'),
                'tahun_akhir' => $this->input->post('tahun_akhir'),
                'nilai_akhir' => $this->input->post('nilai_akhir'),
                'fk_id_pelamar' => $id_pelamar
            );

            return $this->db->insert('pendidikan', $data);
        }

        // Update data pendidikan
        public function UpdatePendidikan(){
            // membuat array untuk dimasukan kedalam database
            $data = array(
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'jenjang_pendidikan' => $this->input->post('jenjang_pendidikan'),
                'bidang_studi' => $this->input->post('bidang_studi'),
                'bulan_mulai' => $this->input->post('bulan_mulai'),
                'tahun_mulai' => $this->input->post('tahun_mulai'),
                'bulan_akhir' => $this->input->post('bulan_akhir'),
                'tahun_akhir' => $this->input->post('tahun_akhir'),
                'nilai_akhir' => $this->input->post('nilai_akhir'),
            );

            $this->db->where('id_pendidikan', $this->input->post('pendidikan'));
            return $this->db->update('pendidikan', $data);
        }

        // hapus data pendidikan
        public function HapusPendidikan($id_pendidikan){
            $this->db->where('id_pendidikan', $id_pendidikan);
            return $this->db->delete('pendidikan');
        }

        // simpan data Pengalaman
        public function SimpanPengalaman($id_pelamar){
            // membuat array untuk dimasukan kedalam database
            $data = array(
                'jabatan' => $this->input->post('jabatan'),
                'status_pekerja' => $this->input->post('status_pekerja'),
                'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                'lokasi_perusahaan' => $this->input->post('lokasi_perusahaan'),
                'sistem_kerja' => $this->input->post('sistem_kerja'),
                'status_kerja' => $this->input->post('status_kerja'),
                'bulan_mulai_kerja' => $this->input->post('bulan_mulai_kerja'),
                'tahun_mulai_kerja' => $this->input->post('tahun_mulai_kerja'),
                'bulan_akhir_kerja' => $this->input->post('bulan_akhir_kerja'),
                'tahun_akhir_kerja' => $this->input->post('tahun_akhir_kerja'),
                'fk_id_pelamar' => $id_pelamar
            );
        
            return $this->db->insert('pengalaman', $data);
        }

        // Update data Pengalaman
        public function UpdatePengalaman(){
            // membuat array untuk dimasukan kedalam database
            $data = array(
                'jabatan' => $this->input->post('jabatan'),
                'status_pekerja' => $this->input->post('status_pekerja'),
                'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                'lokasi_perusahaan' => $this->input->post('lokasi_perusahaan'),
                'sistem_kerja' => $this->input->post('sistem_kerja'),
                'status_kerja' => $this->input->post('status_kerja'),
                'bulan_mulai_kerja' => $this->input->post('bulan_mulai_kerja'),
                'tahun_mulai_kerja' => $this->input->post('tahun_mulai_kerja'),
                'bulan_akhir_kerja' => $this->input->post('bulan_akhir_kerja'),
                'tahun_akhir_kerja' => $this->input->post('tahun_akhir_kerja'),
            );
            $this->db->where('id_pengalaman', $this->input->post('pengalaman'));
        
            return $this->db->update('pengalaman', $data);
        }

        // hapus data pendidikan
        public function HapusPengalaman($id_pengalaman){

            $this->db->where('id_pengalaman', $id_pengalaman);

            return $this->db->delete('pengalaman');
        }

        // simpan data pendidikan
        public function SimpanSkill($id_pelamar){
            // membuat array untuk dimasukan kedalam database
            $data = array(
                'fk_id_pelamar' => $id_pelamar,
                'nama_skill' => $this->input->post('nama_skill'),
                'value' => $this->input->post('value'),
            );

            return $this->db->insert('skil', $data);
        }

        // Update data pendidikan
        public function UpdateSkill(){
            // membuat array untuk dimasukan kedalam database
            $data = array(
                'nama_skill' => $this->input->post('nama_skill'),
                'value' => $this->input->post('value'),
            );

            $this->db->where('id_skill', $this->input->post('skill'));
            return $this->db->update('skil', $data);
        }

        // hapus data pendidikan
        public function HapusSkill($id_skill){
            $this->db->where('id_skill', $id_skill);
            return $this->db->delete('skil');
        }
    

}
    /* End of file perusahaan.php */