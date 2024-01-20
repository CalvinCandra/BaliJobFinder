<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_perusahaan extends CI_Model {

        // function untuk mengambil data perusahaan yang login
        public function getPerusahaan($id_users){
            return $this->db->get_where('data_perusahaan', array('fk_id_users' => $id_users));
        }

        // function untuk menghitung jumlah lowongan berdasarkan perusahaan yang login
        public function LowonganCount($user_id, $keyword=null)
        {
            // hitung semua data
            $this->db->select('COUNT(*) as total_lowongan');
            // memanggil view
            $this->db->from('lowongan'); 

            $this->db->where('fk_id_users', $user_id);
            // jika data yang dicari ada
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->group_end();
            }

            return $this->db->get()->row()->total_lowongan;
                    
        }

        // function untuk menghitung jumlah lamaran berdasarkan lowongan kerja perusahaan
        public function LamaranCount($user_id, $keyword=null)
        {
            // mengambil id perusahaan
            $id_perusahaan = $this->getPerusahaan($user_id)->row()->id_perusahaan;

            $this->db->select('COUNT(*) as total_lamaran');
            $this->db->from('lamaranpelamar'); //view
           
            $this->db->where('id_perusahaan', $id_perusahaan);

            // jika ada data yang dicari oleh user
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('nama_lengkap', $keyword);
                $this->db->group_end();
            }

            $query = $this->db->get();
            return $query->row()->total_lamaran;
        }


        // function untuk cek data profile apakah ada atau tidak
        public function cekData($id_perusahaan){
            // jika data tidak ada
            if($this->db->get_where('data_perusahaan', ['id_perusahaan' => $id_perusahaan])->num_rows() == 0){
                return 1;
            }else{
                $perusahaan = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $id_perusahaan])->row();
                if(is_null($perusahaan->logo) || is_null($perusahaan->alamat_perusahaan) || is_null($perusahaan->tlp_perusahaan) || 
                    is_null($perusahaan->kota)){
                    return 1;
                }else{
                    return 0;
                }
            }
        }

        // function untuk simpan profile
        public function simpanProfile($nama_perusahaan, $telp, $alamat, $kota, $id_users)
        {

            // db transition start
            $this->db->trans_start();

            // update data
            $query = $this->db->query("call sp_update_data_perusahaan('".$nama_perusahaan."', '".$telp."', '".$alamat."', '".$kota."', '".$id_users."')");

            // update nama_perusahaan di table users
            $this->db->where('id_users', $id_users);
            $query = $this->db->update('users', ['name' => $nama_perusahaan]);

            // db transision end
            $this->db->trans_complete();

            return $query;
        }

        // function untuk menyimpan logo
        public function saveLogoPath($id, $file_name)
        {
            // pilih id berdasarkan user yang upload
            $this->db->where('id_perusahaan', $id);
            // update
            $this->db->update('data_perusahaan', ['logo' => $file_name]);
        }
    
        // function get data lowongan
        public function getLowongan($id_perusahaan, $limit, $start,$keyword=null)
        {
            // memanggil view database
            $this->db->select('*');
            $this->db->from('lowongan');

            $this->db->where('fk_id_perusahaan', $id_perusahaan);
            // menentukan batasan dari pagination
            $this->db->limit($limit,$start);
            
            // jika data yang dicari ada
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->group_end();
            }

            return $this->db->get();
        }

        // function memasukkan inputan ke dalam tabel
        public function inputlowongan($posisi, $salary, $syarat, $id_perusahaan)
        {
            // memanggil sp_insert_lowongan
            return $this->db->query("call sp_insert_lowongan('".$posisi."', '".$salary."', '".$syarat."', '1', '".$id_perusahaan."' )");
        }

        // function mengedit atau update data lowongan
        public function editLowongan($posisi, $salary, $syarat, $status, $id_lowongan)
        {
            // memanggil sp_update_lowongan
            return $this->db->query("call sp_update_lowongan('".$posisi."', '".$salary."','".$syarat."','".$status."','".$id_lowongan."')");
        }

        // menghapus data lowongan dari tabel
        public function deleteLowongan($id_lowongan)
        {
            // memanggil sp_delete_lowongan
            return $this->db->query("call sp_delete_lowongan('".$id_lowongan."')");
        }

        // function get data lamaran
        public function getLamaran($id_perusahaan, $limit, $start, $keyword = null)
        {
            // join 3 table yaitu lowonngan_kerja, data_pelamar, data_perusahaan
            $this->db->select('*');
            $this->db->from('lamaranpelamar');

            $this->db->where('id_perusahaan', $id_perusahaan);

            // batasan pagination
            $this->db->limit($limit, $start);

            // tampilkan data berdasarkan yang dicari user
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('nama_lengkap', $keyword);
                $this->db->group_end();
            }


            return $this->db->get();
        }

        // hapus lamaran dari table lamaran
        public function deleteLamaran($id)
        {
            // Mulai transaksi
            $this->db->trans_start();

            // Hapus CV untuk hemat memori
            $fileCV = $this->db->get_where('lamaran', ['id_lamaran' => $id])->row()->cv;
            unlink('assets/CV/' . $fileCV);

            //memanggil sp_delete_lamaran 
            $this->db->query("call sp_delete_lamaran('".$id."')");

            // Selesai transaksi
            $this->db->trans_complete();

            // Kembalikan status transaksi
            return $this->db->trans_status();
        }   

        // mengkonfirmasi atau mengubah status lamaran pelamar
        public function konfirmasiStatusLamaran($id_lamaran, $status) {
            // memanggil sp_update_lamaran
            return $this->db->query("call sp_update_lamaran('".$status."','".$id_lamaran."')");
        }


    }
    
    /* End of file perusahaan.php */
