<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_landing extends CI_Model {

    // ambil data lowongan berdasarkan yang aktif dan tampilkan secara acak
    public function getLowonganLanding(){
        // manggil view database
        $this->db->select('*');
        $this->db->from('lowongan');
        // kondisi jika statusnya aktif
        $this->db->where('status',  1);
        // mebuat data acak supaya mnampilkan secara acak
        $this->db->order_by('lowongan_kerja.id_lowongan','RANDOM');
       // batas 6 saja
       $this->db->limit(6);

       $query = $this->db->get();
       return $query;
   }

    // function untuk jumlah lowongan
    public function jumlahLowongan($search=null){
        //manggil view dan hitung total lowongan
        $this->db->select('COUNT(*) as total_lowongan');
        $this->db->from('lowongan');
        // kondisi jika statusnya aktif
        $this->db->where('status', 1);

        // jika data yang dicari ada
        if ($search) {
            $this->db->group_start();
            $this->db->like('posisi_lowongan', $search);
            $this->db->group_end();
        }

        // mengambil data dan dijadikan num_row
        return $this->db->get()->row()->total_lowongan;
    }

    // function untuk melihat lowongan yang lebih banyak, dan tampilkan secara acak
    public function getLowonganMore($limit, $start, $search=null){

        //  manggil view
         $this->db->select('*');
         $this->db->from('lowongan');

         // kondisi jika statusnya aktif
         $this->db->where(array('status' =>  1));
         // mebuat data acak supaya mnampilkan secara acak
         $this->db->order_by('id_lowongan','RANDOM');
        // batas 16 saja
        $this->db->limit($limit,$start);

        // jika data yang dicari ada
        if ($search) {
            $this->db->group_start();
            $this->db->like('posisi_lowongan', $search);
            $this->db->or_like('nama_perusahaan', $search);
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query;
    }

    // function untuk melihat data lowongan secara details
    public function getDataLowongan($posisi, $perusahaan){
        // manggil view database
        $this->db->select('*');
        $this->db->from('lowongan');
        
        $this->db->where(array(
            'status' => 1,
            'posisi_lowongan' => $posisi,
            'nama_perusahaan' => $perusahaan,
        ));

        $query = $this->db->get();
        return $query;
    }

    // function untuk ngecek lamaran apakah sebelumnya ada diterima atau tidak
    public function CekLamaranStatusBelum($id_pelamar, $id_lowongan){
        return $this->db->get_where('lamaran',
        [
            'fk_id_pelamar' => $id_pelamar,
            'fk_id_lowongan' => $id_lowongan,
            'status_lamaran' => "Belum Terkonfrimasi",
        ])->num_rows();

    }

    // function untuk ngecek lamaran apakah sebelumnya ada diterima atau tidak
    public function CekLamaranStatusTerima($id_pelamar, $id_lowongan){
        return $this->db->get_where('lamaran',
        [
            'fk_id_pelamar' => $id_pelamar,
            'fk_id_lowongan' => $id_lowongan,
            'status_lamaran' => "Diterima",
        ])->num_rows();
    }

    // function untuk insert ke lamaran
    public function UploadPathCV($pelamar, $file_name, $lowongan){
        // memanggil sp_insert_lamaran
        return $this->db->query("call sp_insert_lamaran('".$file_name."', '".$lowongan."', '".$pelamar."', 'Belum Terkonfrimasi')");
    }
    
    

}

/* End of file M_landing.php */
