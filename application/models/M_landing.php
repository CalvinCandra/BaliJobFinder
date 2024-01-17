<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_landing extends CI_Model {

    // function untuk jumlah lowongan
    public function jumlahLowongan($search=null){
        //join table dan hitung total lowongan digunakan untuk pagination saat search
        $this->db->select('COUNT(*) as total_lowongan');
        $this->db->from('lowongan_kerja');
        $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
        // kondisi jika statusnya aktif
        $this->db->where(array('lowongan_kerja.status' =>  1));

        // jika data yang dicari ada
        if ($search) {
            $this->db->group_start();
            $this->db->like('posisi_lowongan', $search);
            $this->db->group_end();
        }

        // mengambil data dan dijadikan num_row
        return $this->db->get()->row()->total_lowongan;
    }

    // ambil data lowongan berdasarkan yang aktif dan tampilkan secara acak
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

    // function untuk melihat lowongan yang lebih banyak, dan tampilkan secara acak
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

    // function untuk melihat data lowongan secara details
    public function getDataLowongan($posisi, $perusahaan){
        //join table
        $this->db->select('*');
        $this->db->from('lowongan_kerja');
        $this->db->join('data_perusahaan', 'data_perusahaan.id_perusahaan = lowongan_kerja.fk_id_perusahaan');
        $this->db->where(array(
            'lowongan_kerja.status' => 1,
            'lowongan_kerja.posisi_lowongan' => $posisi,
            'data_perusahaan.nama_perusahaan' => $perusahaan,
        ));

        $query = $this->db->get();
        return $query;
    }

    // function untuk mengecek lamaran
    public function CekLamaran($id_pelamar, $id_lowongan){
        $lamaran = $this->db->get_where('lamaran', 
        [
            'fk_id_pelamar' => $id_pelamar,
            'fk_id_lowongan' => $id_lowongan
        ])->row();


        if($lamaran->status_lamaran == "Belum Terkonfrimasi"){
            return $nilai = 1;
        }else if($lamaran->status_lamaran == "Diterima"){
            return $nilai = 2;
        }else{
            return 0;
        }

    }

    // function untuk insert ke lamaran
    public function UploadPathCV($pelamar, $file_name, $lowongan){
        // memanggil sp_insert_lamaran
        return $this->db->query("call sp_insert_lamaran('".$file_name."', '".$lowongan."', '".$pelamar."')");
    }
    
    

}

/* End of file M_landing.php */
