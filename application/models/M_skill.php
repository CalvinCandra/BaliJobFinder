<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_skill extends CI_Model {

    // get data pendidikan sesuai id yang dikirim
    public function getDataSkill($id_pelamar) {
        return $this->db->get_where('skil', array('fk_id_pelamar' => $id_pelamar));
    }

}

/* End of file M_skill.php */
