<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* 
 * This is only viewable to those members that are logged in
 */

class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('login_model');
        error_reporting(0);
    }
 
   
    public function logoutAdmin() {
        // If the user is validated, then this function will run
        //echo 'You are successfully logout';
        $this->session->set_flashdata('success', 'You are successfully logout!!');
        $this->session->sess_destroy();
        redirect('login/user_login');
       // $this->load->view('login/login_view');
    }
    public function auto() {
        
        $this->load->view('autocomplete');
    }
}

?>