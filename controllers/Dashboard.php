<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->model('login_model');
		//is_logged_in();
		define('CONTROLLER', strtolower(__CLASS__));
    }
	function index(){
		
		$this->load->view('dashboard');
	}
    function get_all_parameter() {
		
		$dataResponse=array();
		//$result=array();
		/*if(isset($_REQUEST['data'])&& !empty($_REQUEST['data'])){
			$result['msg']='Success';
			$result['response']=json_decode($_REQUEST['data']);
			//print_r($result);
			echo json_encode($result);
		}else{
			$result['msg']='Error';
			//print_r($result);
			echo json_encode($result);
		}
		*/
		$user_name='';
		$password='';
		$responce=array();
		if(isset( $_REQUEST['user_name']) && !empty( $_REQUEST['user_name'])&& isset( $_REQUEST['password']) && !empty( $_REQUEST['password'])){
			$result = $this->login_model->validate_user($user_name,$password);
            if ($result == '0') {
				$responce['status']='error';
				$responce['massage']='No user exist from is ID.';
            } elseif ($result == '-1') {
                $responce['status']='error';
				$responce['massage']='The username is not active !!';
            } else {
				$responce['status']='success';
				$responce['massage']=$this->session->userdata('userid');
            }
			echo json_encode($responce);
		}
	}
}