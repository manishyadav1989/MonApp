<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Screenshot_model extends CI_Model {
    /* Login Model */

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    /*     * ************************
     * get all screenshot
     * 
     * Description:This function is use to username and password Which is use to validate the user.
     *  ************************* */

    public function getAllScreenshot( $condition, $limit, $start ) {
     
        // define blank array
        $screenshots = array();

        // Run the query
        $query = $this->db->select('system_screenshots.*, user.user_name ')->from('system_screenshots')->join('user', 'user.id = system_screenshots.userId')->where($condition)->order_by('id', 'desc')->limit( $limit, $start )->get();
        // Let's check if there are any results

        $result=$query->row_array();

        //if ($query->num_rows == 1) {
		if (count($result)> 0) {
            // If there is a user, then create session data   auth_view
            $screenshots = $query->result();
        }

        // return screenshot
        return $screenshots;
    }

    // Count all record of table "contact_info" in database.
    public function record_count( $condition ) {
        $query = $this->db->where($condition)->get('system_screenshots');
        return $query->num_rows();
    }

    // get current screenshots with screenshot id
    public function getCurrentScreenshotFiles( $screenshots ) {
        $query = $this->db->select(['id','filename'])->where_in('id', $screenshots)->get("system_screenshots");
        return $query->result();
    }

    // get all screenshots with screenshot id
    public function getAllScreenshotFiles( $condition ) {
        $query = $this->db->select(['id','filename'])->where($condition)->get("system_screenshots");
        return $query->result();
    }

    // delete screenshot
    public function deleteScreenshot( $screenshot_id ) {
        return $this->db->where('id', $screenshot_id)->delete('system_screenshots');
    }

}

?>