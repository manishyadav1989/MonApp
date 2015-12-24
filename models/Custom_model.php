<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Custom_model extends CI_Model {
    /* Login Model */

    function __construct() {
        parent::__construct();
    }

    // get all users from database
    public function getAllUsers() {
        $query = $this->db->select(['id','user_name'])->get("user");
        return $query->result();
    }

    // get computer name from database
    public function getComName() {
        $query = $this->db->select(['id','CONCAT(com_name,"->", user_name) as sysName'])->get("user");
        return $query->result();
    }

    // get computer name from database
    public function getComUser( $comName ) {
        $con = explode('->', $comName);
        if(is_array( $con )){
            $condition['com_name'] = $con[0];
            $condition['user_name'] = $con[1];
            return $this->db->where( $condition )->get("user")->row()->id;
        }
        else{
            return $this->db->where('com_name', $con)->get("user")->row()->id;
        }
    }
 }