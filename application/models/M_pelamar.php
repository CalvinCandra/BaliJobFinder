<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelamar extends CI_Model {

    // get data pelamar
    public function getPelamar($user_id)
    {
        return $this->db->get_where('data_pelamar', array('fk_id_users' => $user_id));
    }

}

/* End of file M_pelamar.php */
