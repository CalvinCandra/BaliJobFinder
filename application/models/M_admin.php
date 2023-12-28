<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_admin extends CI_Model {

          // meng join 2 tabel   lowongan_kerja Dengan data_perusahaan
        public function getlowongan($limit, $start,$keyword=null) {
            $this->db->select('*');
            $this->db->from('lowongan_kerja');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');

            // menentukan batasan dari pagination
            $this->db->limit($limit,$start);
            
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->group_end();
            }

            $query = $this->db->get();
            return $query;
        } 
    
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
            
            $query = $this->db->get();
            return $query;
        } 

      // mengedit atau update data lowongan
        public function editLowongan()
        {
            $edit = array(
                
                'posisi_lowongan' => $this->input->post('posisi'),
                'salary' => $this->input->post('salary'),
                'syarat_lowongan' => $this->input->post('syarat'),
                'status' => $this->input->post('status'),
                
            );
            $this->db->where('id_lowongan', $this->input->post('id'));
            $result = $this->db->update('lowongan_kerja', $edit);
            return $result;
        }

        // menghitung jumlah lowongan berdasarkan perusahaan yang login
        public function LowonganCount($keyword=null)
        {

            // pencarian data di tabel berdasarkan keyword
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->group_end();
            }

            // menghitung jumlah lowongan berdasarkan id lowongan
            $count = $this->db->count_all_results('lowongan_kerja');
            return $count;
            
        }
        // menghitung jumlah lowongan berdasarkan perusahaan yang login
        public function PelamarCount($keyword=null)
        {

            // pencarian data di tabel berdasarkan keyword
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('nama_lengkap', $keyword);
                $this->db->group_end();
            }

            // menghitung jumlah lowongan berdasarkan id lowongan
            $count = $this->db->count_all_results('data_pelamar');
            return $count;
            
        }

         // menghitung jumlah lowongan berdasarkan perusahaan yang login
         public function PerusahaanCount($keyword=null)
         {
 
             // pencarian data di tabel berdasarkan keyword
             if ($keyword) {
                 $this->db->group_start();
                 $this->db->like('nama_perusahaan', $keyword);
                 $this->db->group_end();
             }
 
             // menghitung jumlah lowongan berdasarkan id lowongan
             $count = $this->db->count_all_results('data_perusahaan');
             return $count;
             
         }
        

         // menghapus data lowongan dari tabel
         public function deleteLowongan($id)
         {
             $this->db->where('id_lowongan', $id);
             $result = $this->db->delete('lowongan_kerja');
             return $result;
         }

      // mengedit atau update data perusahhaan
         public function editperusahaan()
         {
             $edit = array(
                 'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                 'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
                 'tlp_perusahaan' => $this->input->post('tlp_perusahaan'),
                 'kota' => $this->input->post('kota'),
                 
             );
             $this->db->where('id_perusahaan', $this->input->post('id'));
             $result = $this->db->update('data_perusahaan', $edit);
             if ($result) {
                // Jika update data perusahaan sukses, update juga email perusahaan di tabel users
                $email_baru = $this->input->post('email');
                $this->db->where('id_users', $id_users);
                $this->db->update('users', ['email' => $email_baru]);
            }

             return $result;
         }
 
         
               // menyimpan logo perusahaan ke dalam tabel
         public function SavelogoPerusahaan($logoPath)
         {
            $this->db->where('id_perusahaan', $this->input->post('id'));
            $this->db->update('data_perusahaan', ['logo' => $logoPath]);
         }

          // menghapus data perusahaan dari tabel
          public function deleteperusahaan($id)
          {
              $this->db->where('id_perusahaan', $id);
              $result = $this->db->delete('data_perusahaan');
              return $result;
          }

      // mengedit atau update data pelamar
          public function editpelamar()
          {
              $edit = array(
                  'nama_lengkap' => $this->input->post('nama_lengkap'),
                  'tgl_lahir' => $this->input->post('tgl_lahir'),
                  'no_hp' => $this->input->post('no_hp'),
                  'alamat' => $this->input->post('alamat'),
                 
                  
              );
              $this->db->where('id_pelamar', $this->input->post('id'));
              $result = $this->db->update('data_pelamar', $edit);
              if ($result) {
                // Jika update data perusahaan sukses, update juga email perusahaan di tabel users
                $email_baru = $this->input->post('email');
                $this->db->where('id_users', $id_users);
                $this->db->update('users', ['email' => $email_baru]);
            }

             return $result;
         }
  
               // menyimpan profile pelamar ke dalam tabel
         public function SavelogoPelamar($logoPath)
         {
            $this->db->where('id_pelamar', $this->input->post('id'));
            $this->db->update('data_pelamar', ['gambar' => $logoPath]);
         }
 
           // menghapus data pelamar dari tabel
           public function deletepelamar($id)
           {
               $this->db->where('id_pelamar', $id);
               $result = $this->db->delete('data_pelamar');
               return $result;
           }
    
    }
    
    /* End of file ModelName.php */
    
?>