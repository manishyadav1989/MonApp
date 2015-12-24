<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';


class Login extends REST_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('login_model');
    }

    function login_post(){
        $data=array();
    

        if($this->post('action')=='login' && $this->post('username')!=''){
            $username               = $this->post('username');
            $password               = $this->post('password');
            $systemName             = $this->post('sysName');          
            
            $return_value = $this->login_model->checkUser($username,$password, $systemName);
            
            if(!empty($return_value)){
                $this->response($return_value, 200); // 200 being the HTTP response code
            }else{
                $this->response(array('msg' => 'user does not exist','status'=>'0'), 200);
            }
        }else{
            $this->response(array('msg' => 'not a valid requests','status'=>'0'), 200);
        }
    }

    public function index() {
        /* Login View */
        $this->load->view('login/product_view');
    }
	public function user_login() {
        /* Login View */
        $this->load->view('login/login_view');
    }
    
    public function user_exist() {
         /* Check Valid User */
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation', 'Fill Form Properly');
            redirect("login/user_login");
        } else {
            $result = $this->login_model->validate_user();
            if ($result == '0') {
                $this->session->set_flashdata('error', 'The username/password combination is not correct, please try again !!');
                redirect("login/user_login");
            } elseif ($result == '-1') {

                $this->session->set_flashdata('error', 'The username is not active !!');
                redirect("login/user_login");
            } else {
                redirect('exedownload/exedownload_frm');
            }
        }
    }

    
    public function emailexist() {
         /* Forget password View */
        $this->load->view('login/forget');
    }


    public function forgetpassword() {
         /* check Forget Password User is valid   */
     
        $this->form_validation->set_rules('email', 'Enter you email ID', 'required|valid_email');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login/forget');
        } else {
            $email = $this->input->post('email');
            $result = $this->login_model->forgetpassword($email);
            if (!$result) {
               // die('here');
                $this->session->set_flashdata('error', '<font color=red>Email Address is not Exist.</font>');
                redirect('login/emailexist');
            } else {
                   /* Send mail to valid User   */
                error_reporting(0);
                $id = $result[0]['id'];
                $password = $result[0]['password'];
                $message = "Your Password is " . $password;
                $msg = wordwrap($message, 70);
                $subject = "Your Forget Password on AEC";
                $v = $email . "</br>" . $subject . "</br>" . $msg;
                echo $v;

                //$mail=mail($email, $subject, $msg);
                if (!empty($v)) {
                    $this->session->set_flashdata('success', 'Thank you!! </br> Please Check your Email For Updating Your Password');
                    redirect('login/user_login');
                }
            }
        }
    }



}

?>