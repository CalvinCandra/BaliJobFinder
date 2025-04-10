<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_CV extends CI_Model {

    // get data pendidikan sesuai id yang dikirim
    public function getDataPendidikan($id_pelamar) {
        return $this->db->get_where('pendidikan', array('fk_id_pelamar' => $id_pelamar));
    }

    // get data skill sesuai id yang dikirim
    public function getDataPengalaman($id_pelamar) {
        return $this->db->get_where('pengalaman', array('fk_id_pelamar' => $id_pelamar));
    }

    // get data skill sesuai id yang dikirim
    public function getDataSkill($id_pelamar) {
        return $this->db->get_where('skil', array('fk_id_pelamar' => $id_pelamar));
    }

}

/* End of file CV.php */
