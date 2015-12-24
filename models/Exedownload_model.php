<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exedownload_model extends CI_Model {
    /* Login Model */

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

     public function addexedownloadUser() {
			$data['user_id'] = $this->session->userdata('userid');
			$data['user_ip'] = $_SERVER['REMOTE_ADDR'];
            $query = $this->db->insert('download_entry', $data);
            //echo $this->db->last_query();
            return $query;
        
    }
}

?>