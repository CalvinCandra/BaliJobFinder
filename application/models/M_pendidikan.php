<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendidikan extends CI_Model {

    // get data pendidikan sesuai id yang dikirim
    public function getDataPendidikan($id_pelamar) {
        return $this->db->get_where('pendidikan', array('fk_id_pelamar' => $id_pelamar));
    }

}

/* End of file M_pendidikan.php */
