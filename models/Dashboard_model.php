<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    /* Dashboard Model */

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

        /*     * ************************
     * validate_user()
     * 
     * Description:This function is use to username and password Which is use to validate the user.
     *  ************************* */

    public function validate_user($username,$password) {
        $this->db->where('user_name', $username);
        $this->db->where('password', $password);
        // Run the query
        $query = $this->db->get('user');
		$result=$query->row_array();
			if (count($result)> 0) {
            // If there is a user, then create session data   auth_view
            $row = $query->row();
            $status = $row->status;
            if ($status == '1') {
                $data = array(
                    'userid' => $row->id,
                    'username' => $row->user_name,
                    'validated' => true,
                    'is_loggedin' => true
                );
                $this->session->set_userdata($data);
                return 1;
            } else {
                return -1;
            }
        }
        return 0;
    }
}

?>