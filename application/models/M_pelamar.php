<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_pelamar extends CI_Model {
        // get data pelamar
        public function getDataPelamar($user_id)
        {
            return $this->db->get_where('data_pelamar', array('fk_id_users' => $user_id));
        }
    
        public function getLowongan($user_id, $limit, $start,$keyword=null)
        {
            // meng join 2 tabel data_perusahaan dengan lowongan_kerja
            $this->db->select('*');
            $this->db->from('data_perusahaan');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.fk_id_perusahaan = data_perusahaan.id_perusahaan');

            $this->db->where('data_perusahaan.fk_id_users', $user_id);
            // menentukan batasan dari pagination
            $this->db->limit($limit,$start);
            
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->group_end();
            }

            $result = $this->db->get();
            return $result;
        }

        // mengambil id_user yang login
        public function getUser()
        {
            $email = $this->session->userdata('email');
            $user_id = $this->db->get_where('users', ['email' => $email])->row();
            return $user_id;
        }

        // memasukkan inputan ke dalam tabel
        public function input($user_id)
        {
            // mengambil nilai id perusahaan yang login
            $query = $this->db->select('id_perusahaan')->get_where('data_perusahaan', ['fk_id_users' => $user_id]);
            $id_perusahaan = $query->row()->id_perusahaan;

            $insert = array(
                'posisi_lowongan' => $this->input->post('posisi_lowongan'),
                'salary' => $this->input->post('salary'),
                'syarat_lowongan' => $this->input->post('syarat_lowongan'),
                'status' => 1,
                'fk_id_perusahaan'=> $id_perusahaan,
                
            );
            $result= $this->db->insert('lowongan_kerja', $insert);
            return $result;
            
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

        // menghapus data lowongan dari tabel
        public function deleteLowongan($id)
        {
            $this->db->where('id_lowongan', $id);
            $result = $this->db->delete('lowongan_kerja');
            return $result;
        }

        // menghitung jumlah lowongan berdasarkan perusahaan yang login
        public function LowonganCount($user_id, $keyword=null)
        {
            // mengambil id perusahaan yang login
            $query = $this->db->select('id_perusahaan')->get_where('data_perusahaan', ['fk_id_users' => $user_id]);
            $id_perusahaan = $query->row()->id_perusahaan;

            // pencarian data di tabel berdasarkan keyword
            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('salary', $keyword);
                $this->db->group_end();
            }

            // menghitung jumlah lowongan berdasarkan id lowongan
            $count = $this->db->where('fk_id_perusahaan', $id_perusahaan)->count_all_results('lowongan_kerja');
            return $count;
            
        }
        
        public function getPelamar($user_id, $limit, $start, $keyword = null)
        {
            $this->db->select('*');
            $this->db->from('lamaran');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
            $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
            $this->db->where('data_perusahaan.fk_id_users', $user_id);

            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('nama_lengkap', $keyword);
                $this->db->group_end();
            }

            $this->db->limit($limit, $start);

            $result = $this->db->get();
            return $result;
        }



        public function LamaranCount($user_id,$keyword=null)
        {
            $this->db->select('COUNT(*) as total_lamaran');
            $this->db->from('lamaran');
            $this->db->join('lowongan_kerja', 'lowongan_kerja.id_lowongan = lamaran.fk_id_lowongan');
            $this->db->join('data_pelamar', 'data_pelamar.id_pelamar = lamaran.fk_id_pelamar');
            $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
            $this->db->where('data_perusahaan.fk_id_users', $user_id);

            if ($keyword) {
                $this->db->group_start();
                $this->db->like('posisi_lowongan', $keyword);
                $this->db->or_like('nama_lengkap', $keyword);
                $this->db->group_end();
            }

            $query = $this->db->get();
            return $query->row()->total_lamaran;
        }

        public function deleteLamaran($id)
        {
            $this->db->where('id_lamaran', $id);
            $result = $this->db->delete('lamaran');
            return $result;
        }

        public function getPerusahaan($user_id)
        {
            return $this->db->get_where('data_perusahaan', array('fk_id_users' => $user_id));
        }

        public function simpanProfile()
        {
            $edit = array(
                'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                'tlp_perusahaan' => $this->input->post('no_tlp'),
                'alamat_perusahaan' => $this->input->post('alamat'),
            );
            $this->db->where('id_perusahaan', $this->input->post('id'));
            $result = $this->db->update('data_perusahaan', $edit);
            return $result;
        }

        public function saveLogoPath($id, $logoPath)
        {
            $this->db->where('fk_id_users', $id);
            $this->db->update('data_perusahaan', ['logo' => $logoPath]);
        }


    }
    
    /* End of file perusahaan.php */