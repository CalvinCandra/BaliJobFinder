<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengalaman extends CI_Model {

    // get data pendidikan sesuai id yang dikirim
    public function getDataPengalaman($id_pelamar) {
        return $this->db->get_where('pengalaman', array('fk_id_pelamar' => $id_pelamar));
    }

}

/* End of file M_pengalaman.php */
