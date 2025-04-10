<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_admin extends CI_Model {
        // function untuk menghitung jumlah keselurahan lowongan
        public function LowonganCount($keyword=null){
            // view database
            $this->db->select('COUNT(*) as total_lowongan');
            $this->db->from('lowongan');
            
            // jika data yang dicari ada
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->or_like('nama_perusahaan', $keyword);
                $this->db->group_end();
            }

            // menghitung jumlah lowongan 
            return $this->db->get()->row()->total_lowongan;
        }

        // function untuk menghitung jumlah keselurahan akun perusahaan
        public function PerusahaanCount($keyword=null){
            // menghitung jumlah pelamar pada table
            $this->db->select('COUNT(*) as total_perusahaan');
            $this->db->from('data_perusahaan');

            // pencarian data di tabel berdasarkan keyword
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('nama_perusahaan', $keyword);
                $this->db->group_end();
            }

            return $this->db->get()->row()->total_perusahaan;
        }

        // function untuk menghitung jumlah keselurahan akun pelamar
        public function PelamarCount($keyword=null){
            // menghitung jumlah pelamar pada table
            $this->db->select('COUNT(*) as total_pelamar');
            $this->db->from('data_pelamar');

            // pencarian data di tabel berdasarkan keyword untuk result
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('nama_lengkap', $keyword);
                $this->db->group_end();
            }

            return $this->db->get()->row()->total_pelamar;
        }

        // function untuk mengambil data perusahaan dan meng join 2 tabel lowongan_kerja Dengan data_perusahaan
        public function getlowongan($limit, $start,$keyword=null) {
            // manggil view
            $this->db->select('*');
            $this->db->from('lowongan');

            // menentukan batasan dari pagination
            $this->db->limit($limit,$start);
            
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->or_like('nama_perusahaan', $keyword);
                $this->db->group_end();
            }

            return $this->db->get();
        } 
    
        // function untuk mengambil data pelamar meng join 2 tabel data_pelamar Dengan users
        public function getDataPelamar($limit, $start,$keyword=null) {
            $this->db->select('*');
            $this->db->from('data_pelamar');
            $this->db->join('users', 'users.id_users = data_pelamar.fk_id_users');

            $this->db->limit($limit,$start);

            // pencarian data di tabel berdasarkan keyword
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('nama_lengkap', $keyword);
                $this->db->group_end();
            }

            $query = $this->db->get();
            return $query;
        } 

        // meng join 2 tabel data_perusahaan Dengan users
        public function getDataPerusahaan($limit, $start,$keyword=null) {
            $this->db->select('*');
            $this->db->from('data_perusahaan');
            $this->db->join('users', 'users.id_users = data_perusahaan.fk_id_users');

            $this->db->limit($limit,$start);

            // pencarian data di tabel berdasarkan keyword
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('nama_perusahaan', $keyword);
                $this->db->group_end();
            }
            
            return $this->db->get();
        } 

        // function untuk mengedit atau update data lowongan
        public function editLowongan($posisi, $salary, $syarat, $status, $id_lowongan)
        {
            // memanggil sp_update_lowongan
            return $this->db->query("call sp_update_lowongan('".$posisi."', '".$salary."','".$syarat."','".$status."','".$id_lowongan."')");
        }

         // menghapus data lowongan dari tabel
         public function deleteLowongan($id)
         {
            // memanggil sp_delete_lowongan
            return $this->db->query("call sp_delete_lowongan('".$id."')");
         }

        // mengedit atau update data perusahhaan
        public function editperusahaan($nama_perusahaan, $alamat_perusahaan, $tlp_perusahaa, $kota, $id, $logo)
        {
            // mengambil Data Perusahaan
            $Perusahaan = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $id])->row();

            if($logo == "1"){
                $edit = array(
                    'nama_perusahaan' => $nama_perusahaan,
                    'alamat_perusahaan' => $alamat_perusahaan,
                    'tlp_perusahaan' => $tlp_perusahaa,
                    'kota' => $kota,
                    'logo' => NULL
                );

                // melakukan penghapusan gambar sebelumnya dari path agar lebih hemat :)
                if(!empty($Perusahaan->logo)){
                    unlink('assets/img/profile/perusahaan/' .$Perusahaan->logo);
                }

                // update
                $result = $this->db->update('data_perusahaan', $edit, ['id_perusahaan' => $id]);
   
               if($result) {
                   // Jika update data perusahaan sukses, update juga email perusahaan di tabel users
                   $email_baru = $this->input->post('email');
                   $this->db->where('id_users', $Perusahaan->fk_id_users);
                   $this->db->update('users', ['email' => $email_baru]);
               }

            }else{
                $edit = array(
                    'nama_perusahaan' => $nama_perusahaan,
                    'alamat_perusahaan' => $alamat_perusahaan,
                    'tlp_perusahaan' => $tlp_perusahaa,
                    'kota' => $kota,
                );

                $this->db->where('id_perusahaan', $id);
                $result = $this->db->update('data_perusahaan', $edit);
   
               if($result) {
                   // Jika update data perusahaan sukses, update juga email perusahaan di tabel users
                   $email_baru = $this->input->post('email');
                   $this->db->where('id_users', $Perusahaan->fk_id_users);
                   $this->db->update('users', ['email' => $email_baru]);
               }
   
            }
             
        }

        // menghapus data perusahaan dari tabel
        public function deletePerusahaan($id)
        {
            // Mulai transaksi
            $this->db->trans_start();

            // mendapatkan id users
            $user_id = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $id])->row()->fk_id_users;

            // Hapus logo agar hemat memori
            $image = $this->db->get_where('data_perusahaan', ['id_perusahaan' => $id])->row()->logo;
            if(!empty($image)){
                unlink('assets/img/profile/perusahaan/' . $image);
            }

            // Hapus data lowongan kerja
            $this->db->where('fk_id_perusahaan', $id)->delete('lowongan_kerja');

            // Hapus data perusahaan
            $this->db->where('id_perusahaan', $id)->delete('data_perusahaan');

            // Hapus data users
            $this->db->where('id_users', $user_id)->delete('users');

            // Selesai transaksi
            $this->db->trans_complete();

            // Kembalikan status transaksi
            return $this->db->trans_status();
        }

        // mengedit atau update data pelamar
        public function editpelamar($nama_lengkap, $no_hp, $alamat, $deskripsi_pelamar, $id, $gambar)
        {
            // mengambil data pelamar
            $Pelamar = $this->db->get_where('data_pelamar', ['id_pelamar' => $id])->row();

            if($gambar == '1'){
                $edit = array(
                    'nama_lengkap' => $nama_lengkap,
                    'no_hp' => $no_hp,
                    'alamat' => $alamat,   
                    'deskripsi_pelamar' => $deskripsi_pelamar,   
                    'gambar' => NULL,   
                );

                // melakukan penghapusan gambar sebelumnya dari path agar lebih hemat :)
                if(!empty($Pelamar->gambar)){
                    unlink('assets/img/profile/pelamar/' .$Pelamar->gambar);
                }

                // update
                $result = $this->db->update('data_pelamar', $edit, ['id_pelamar' => $id]);

                if ($result) {
                    // Jika update data perusahaan sukses, update juga email perusahaan di tabel users
                    $email_baru = $this->input->post('email');
                    $this->db->where('id_users', $Pelamar->fk_id_users);
                    $this->db->update('users', ['email' => $email_baru]);
                }
            }else{
                $edit = array(
                    'nama_lengkap' => $nama_lengkap,
                    'no_hp' => $no_hp,
                    'alamat' => $alamat,   
                    'deskripsi_pelamar' => $deskripsi_pelamar,     
                );

                $this->db->where('id_pelamar',$id);
                $result = $this->db->update('data_pelamar', $edit);

                if ($result) {
                    // Jika update data perusahaan sukses, update juga email perusahaan di tabel users
                    $email_baru = $this->input->post('email');
                    $this->db->where('id_users', $Pelamar->fk_id_users);
                    $this->db->update('users', ['email' => $email_baru]);
                }
            }
        }
 
        // menghapus data pelamar dari tabel
        public function deletePelamar($id)
        {
            // Mulai transaksi
            $this->db->trans_start();

            // mendapatkan id users
            $pelamar = $this->db->get_where('data_pelamar', ['id_pelamar' => $id])->row();

            if(!empty($pelamar->gambar)){
                unlink('assets/img/profile/pelamar/' . $pelamar->gambar);
            }

            // Hapus CV untuk hemat memori
            $lamaran = $this->db->get_where('lamaran', ['fk_id_pelamar' => $id])->row();
            if($lamaran){
                unlink('assets/CV/' . $lamaran->cv);
                // Hapus data dari tabel lamaran
                $this->db->where('fk_id_pelamar', $id)->delete('lamaran');
            }

            // Hapus data dari tabel pendidikan
            $this->db->where('fk_id_pelamar', $id)->delete('pendidikan');

            // Hapus data dari tabel pengalaman
            $this->db->where('fk_id_pelamar', $id)->delete('pengalaman');

            // Hapus data dari tabel skil
            $this->db->where('fk_id_pelamar', $id)->delete('skil');

            // Hapus data dari tabel data_pelamar
            $this->db->delete('data_pelamar', ['id_pelamar' => $id]);

            // Hapus data dari tabel users
            $this->db->delete('users', ['id_users' => $pelamar->fk_id_users]);

            // Selesai transaksi
            $this->db->trans_complete();

            // Kembalikan status transaksi
            return $this->db->trans_status();
        }
    
    }
    
    /* End of file ModelName.php */
    
?>