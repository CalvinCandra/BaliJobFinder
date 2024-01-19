<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_pelamar extends CI_Model {
        // function get data pelamar
        public function getDataPelamar($user_id)
        {
            return $this->db->get_where('data_pelamar', array('fk_id_users' => $user_id));
        }

        // function cek data profile apakah ada atau tidak
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

           
        // function cek data pendidikan berdasarkan user yang login apakah ada atau tidak
        public function cekDataPendidikan($id_pelamar){
            // jika data pendidikan tidak ada
            if($this->db->get_where('pendidikan', ['fk_id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{ // jika data pendidikan ada
                return 0;
            }
        }
   
         // function cek data pengalaman berdasarkan user yang login apakah ada atau tidak
        public function cekDataPengalaman($id_pelamar){
            // jika data pengalaman tidak ada
            if($this->db->get_where('pengalaman', ['fk_id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{ // jika data pengalaman ada
                return 0;
            }
        }

        // function cek data skill berdasarkan user yang login apakah ada atau tidak
        public function cekDataSkill($id_pelamar){
            // jika data skill tidak ada
            if($this->db->get_where('skil', ['fk_id_pelamar' => $id_pelamar])->num_rows() == 0){
                return 1;
            }else{// jika data skill ada
                return 0;
            }
        }

         // function get jumlah lamaran
         public function LamaranCount($id_pelamar,$keyword=null)
         {
             $this->db->select('COUNT(*) as total_lamaran');
             $this->db->from('lamaran');
             // join table data_pelamar
             $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            //  join table lowongan_kerja, data_perusahaan untuk count result di pencarian
             $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
             $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
             $this->db->where('lamaran.fk_id_pelamar', $id_pelamar);
 
             // jika ada data yang dicari oleh user
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('nama_perusahaan', $keyword);
                $this->db->group_end();
            }

             return $this->db->get()->row()->total_lamaran;
         }
 
         // function get jumlah lamaran berdasarkan statusnya belum terkonfirmasi
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

        //  function untuk get status lamaran
        public function getStatusLamaran($id_pelamar,  $limit, $start, $keyword = null){
            $this->db->select('*');
            $this->db->from('lamaran');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
            $this->db->where(array(
                'lamaran.fk_id_pelamar'=> $id_pelamar,
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

            return $this->db->get();
        }

        // functio get data pendidikan sesuai id yang dikirim
        public function getDataPendidikan($id_pelamar) {
            return $this->db->get_where('pendidikan', array('fk_id_pelamar' => $id_pelamar));
        }
        
        // function get data pendidikan sesuai id yang dikirim
        public function getDataPengalaman($id_pelamar) {
            return $this->db->get_where('pengalaman', array('fk_id_pelamar' => $id_pelamar));
        }

        // function get data pendidikan sesuai id yang dikirim
        public function getDataSkill($id_pelamar) {
            return $this->db->get_where('skil', array('fk_id_pelamar' => $id_pelamar));
        }

        // function update profile
        public function simpanProfile($nama_lengkap, $no_telp, $alamat, $deskripsi_pelamar, $id_users)
        {
            
            // db transition start
            $this->db->trans_start();

            // update data dengan sp
            $query = $this->db->query("call sp_update_data_pelamar('".$nama_lengkap."', '".$no_telp."', '".$alamat."', '".$deskripsi_pelamar."', '".$id_users."')");

            // update nama_perusahaan di table users
            $this->db->where('id_users', $id_users);
            $query = $this->db->update('users', ['name' => $nama_lengkap]);

            // db transision end
            $this->db->trans_complete();

            return $query;
        }

        //function menyimpan logo
        public function saveLogoPath($id, $file_name)
        {
            // pilih id berdasarkan user yang upload
            $this->db->where('id_pelamar', $id);
            // update
            $this->db->update('data_pelamar', ['gambar' => $file_name]);
        }   

        // function simpan data pendidikan
        public function SimpanPendidikan($nama_sekolah, $jenjang_pendidikan, $bidang_studi, $bulan_mulai, $tahun_mulai, $bulan_akhir, $tahun_akhir, $nilai_akhir, $id_pelamar){
            // memanggil sp_insert_pendidikan
            return $this->db->query("
                call sp_insert_pendidikan(
                    '".$nama_sekolah."',
                    '".$jenjang_pendidikan."',
                    '".$bidang_studi."',
                    '".$bulan_mulai."',
                    '".$tahun_mulai."',
                    '".$bulan_akhir."',
                    '".$tahun_akhir."',
                    '".$nilai_akhir."',
                    '".$id_pelamar."'
                )
            ");
        }

        // fucntion Update data pendidikan
        public function UpdatePendidikan($nama_sekolah, $jenjang_pendidikan, $bidang_studi, $bulan_mulai, $tahun_mulai, $bulan_akhir, $tahun_akhir, $nilai_akhir, $id_pendidikan){
            // memanggil sp_insert_pendidikan
            return $this->db->query("
                call sp_update_pendidikan(
                    '".$nama_sekolah."',
                    '".$jenjang_pendidikan."',
                    '".$bidang_studi."',
                    '".$bulan_mulai."',
                    '".$tahun_mulai."',
                    '".$bulan_akhir."',
                    '".$tahun_akhir."',
                    '".$nilai_akhir."',
                    '".$id_pendidikan."'
                )
            ");
        }

        // function hapus data pendidikan
        public function HapusPendidikan($id_pendidikan){
            return $this->db->query("call sp_hapus_pendidikan('".$id_pendidikan."')");
        }

        //function simpan data Pengalaman
        public function SimpanPengalaman($jabatan, $statusPekerja, $perusahaan, $lokasi, $sistemKerja, $statusKerja, $bulanMulai, $tahunMulai, $bulanAkhir, $tahunAkhir, $id_pelamar){
        
            return $this->db->query("call sp_insert_pengalaman(
                '".$jabatan."',
                '".$statusPekerja."',
                '".$perusahaan."',
                '".$lokasi."',
                '".$sistemKerja."',
                '".$statusKerja."',
                '".$bulanMulai."',
                '".$tahunMulai."',
                '".$bulanAkhir."',
                '".$tahunAkhir."',
                '".$id_pelamar."'
            )");
        }

        //function Update data Pengalaman
        public function UpdatePengalaman($jabatan, $statusPekerja, $perusahaan, $lokasi, $sistemKerja, $statusKerja, $bulanMulai, $tahunMulai, $bulanAkhir, $tahunAkhir, $pengalaman){
            // jika statusnya sudah selesai maka masukan juga inputan bulan dan tahun selesai
            if($statusKerja == 0){
                return $this->db->query("call sp_update_pengalaman(
                    '".$jabatan."',
                    '".$statusPekerja."',
                    '".$perusahaan."',
                    '".$lokasi."',
                    '".$sistemKerja."',
                    '".$statusKerja."',
                    '".$bulanMulai."',
                    '".$tahunMulai."',
                    '".$bulanAkhir."',
                    '".$tahunAkhir."',
                    '".$pengalaman."'
                )");

            // jika statusnya Masih Kerja maka inputan bulan dan tahun selesai kerja dibuat NULL
            }else{
                return $this->db->query("call sp_update_pengalaman(
                    '".$jabatan."',
                    '".$statusPekerja."',
                    '".$perusahaan."',
                    '".$lokasi."',
                    '".$sistemKerja."',
                    '".$statusKerja."',
                    '".$bulanMulai."',
                    '".$tahunMulai."',
                    'NULL',
                    'NULL',
                    '".$pengalaman."'
                )");
            }
            

        }

        //function hapus data pendidikan
        public function HapusPengalaman($id_pengalaman){
            return $this->db->query("call sp_delete_pengalaman('".$id_pengalaman."')");
        }

        //function  simpan data pendidikan
        public function SimpanSkill($id_pelamar, $nama_skill, $value){
            // memanggil sp
            return $this->db->query("call sp_insert_skill('".$id_pelamar."', '".$nama_skill."', '".$value."')");
        }

        // Update data pendidikan
        public function UpdateSkill($nama_skill, $value, $skill){
            // memanggil sp
            return $this->db->query("call sp_update_skill('".$nama_skill."', '".$value."', '".$skill."')");
        }

        // hapus data pendidikan
        public function HapusSkill($id_skill){
           // memanggil sp
           return $this->db->query("call sp_delete_skill('".$id_skill."')");
        }
    

}
    /* End of file perusahaan.php */