<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {
    /* Login Model */

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    /*     * ************************
     * validate_user()
     * 
     * Description:This function is use to username and password Which is use to validate the user.
     *  ************************* */

    public function validate_user() {
        // Grab user input
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        // Prep the query
        $this->db->where('user_name', $username);
        $this->db->where('password', $password);
        // Run the query
        $query = $this->db->get('user');
        // Let's check if there are any results
//echo $this->db->last_query();

$result=$query->row_array();

        //if ($query->num_rows == 1) {
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

    function checkUser($username,$password, $systemName=''){
        $this->db->where('user_name', $username);
        $this->db->where('password', $password);
        // Run the query
        $query = $this->db->get('user');
        // Let's check if there are any results

        $result=$query->row_array();

        //if ($query->num_rows == 1) {
        if (count($result)> 0) {
        // If there is a user, then create session data   auth_view
            $row = $query->row();
            $status = $row->status;
            if ($status == '1') {

                // update system name
                if( $systemName != '' ){
                    $update['com_name'] = $systemName;
                    $this->db->where('id', $row->id);
                    $this->db->update('user', $update);
                }

                $data = array(
                    'userid' => $row->id,
                    'username' => $row->user_name,
                    'validated' => true,
                    'is_loggedin' => true
                );
                $this->session->set_userdata($data);
                return array('user_id'=>$row->id,'msg'=>'Success','status'=>1);
            } else {
                return array('user_id'=>$row->id,'msg'=>'User is not verified','status'=>1);
            }
        }
        return array();

    }


    /*     * ************************
     * forgetpassword()
     * 
     * Description:This function is use to send a mail to user for his/her forget password.
     *  ************************* */

    public function forgetpassword($email) {
        // Prep the query
        $this->db->select('*');
        $this->db->where('email_id', $email);
        $query = $this->db->get('user');
        return $query->result_array();
    }

}

?>