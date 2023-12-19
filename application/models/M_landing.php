<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_landing extends CI_Model {

    public function jumlahLowongan(){
        // mengambil data dan dijadikan num_row
        return $this->db->get('lowongan_kerja')->num_rows();
    }

    // ambil data lowongan
    public function getLowonganLanding(){
         //join table
         $this->db->select('*');
         $this->db->from('lowongan_kerja');
         $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
         // kondisi jika statusnya aktif
         $this->db->where(array('lowongan_kerja.status' =>  1));
         // mebuat data acak supaya mnampilkan secara acak
         $this->db->order_by('lowongan_kerja.id_lowongan','RANDOM');
        // batas 6 saja
        $this->db->limit(6);

        $query = $this->db->get();
        return $query;
    }

    public function getLowonganMore($limit, $start, $search=null){

         //join table
         $this->db->select('*');
         $this->db->from('lowongan_kerja');
         $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
         // kondisi jika statusnya aktif
         $this->db->where(array('lowongan_kerja.status' =>  1));
         // mebuat data acak supaya mnampilkan secara acak
         $this->db->order_by('lowongan_kerja.id_lowongan','RANDOM');
        // batas 16 saja
        $this->db->limit($limit,$start);

        // jika data yang dicari ada
        if ($search) {
            $this->db->group_start();
            $this->db->like('posisi_lowongan', $search);
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query;
    }

    public function getDataLowongan($posisi, $perusahaan){
        //join table
        $this->db->select('*');
        $this->db->from('lowongan_kerja');
        $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan' );
        $this->db->where(array(
            'lowongan_kerja.status' => 1,
            'lowongan_kerja.posisi_lowongan' => $posisi,
            'data_perusahaan.nama_perusahaan' => $perusahaan,)
        );

        $query = $this->db->get();
        return $query;
    }

    public function getPelamar($user){
        return $this->db->get_where('data_pelamar', ['fk_id_users'=> $user])->row();
    }

    public function UploadPathCV($pelamar, $logo_path, $lowongan){
        $data = array(
            'cv' => $logo_path,
            'fk_id_lowongan' => $lowongan,
            'fk_id_pelamar' => $pelamar,
        );

        $query = $this->db->insert('lamaran', $data);
        return $query;
        
    }
    
    

}

/* End of file M_landing.php */
