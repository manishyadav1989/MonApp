<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rules extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->model('Rules_model');
		//is_logged_in();
		define('CONTROLLER', strtolower(__CLASS__));

        $this->load->library(array('form_validation','session')); // load form lidation libaray & session library
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
        $this->load->library('pagination');

    }

	function index(){
          $this->writeRulesFile(); // delete rule from rule json file
        $data = $this->getRules();
        $data['category']  = $this->Rules_model->getAllCategory();
		$this->load->view('rules', $data);
	}

    // get all category list
    public function getRules(){

        $condition          = array('1'=>'1');
        $data               = array('rules'=>array(), 'links'=>array() );

        // search record
        if( isset($_REQUEST['s']) ){
            $search = $this->input->get('s');
            
            if( $search != '' ){
                $condition = "rules.name LIKE '%".$search."%'";
            }
        }

        $total_row  = $this->Rules_model->record_count($condition);

        if( $total_row > 0 ){

            $config = array();
            $config['page_query_string'] = TRUE;
            $config["total_rows"] = $total_row;
            $config["per_page"] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['uri_segment'] = 1;
            $config['num_links'] = 10;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Newer <i class="fa fa-angle-right"></i>';
            $config['prev_link'] = '<i class="fa fa-angle-left"></i> Older';
            $page = 0;

            $pageUrl = $perPageUrl = base_url().'index.php/rules?';
            //$pageUrl = $perPageUrl.'page=';

            // if( isset( $_REQUEST['per_page'] ) ){
            //     $config["per_page"] = $_REQUEST['per_page'];        
            // }

            if( isset( $_REQUEST['per_page'] ) ){
                $config['uri_segment'] = $_REQUEST['per_page'];
                $page = ($_REQUEST['per_page']-1);
                $page = $page*$config["per_page"];          
            }
            
            // check ? in url
            if ( $_SERVER['QUERY_STRING'] ) {

                $userUrl = $perPageUrl = $pageUrl = strtok($_SERVER['REQUEST_URI'], '?');

                parse_str($_SERVER['QUERY_STRING'], $vars);
                unset($vars['per_page']);
                $pageUrl .= '?'.http_build_query($vars);
                //$pageUrl .= '&page=';

                // unset($vars['per_page']);
                // $perPageUrl .= '?'.http_build_query($vars);

            }

            // set configuration for pagination
            $config["base_url"] = $pageUrl;
            $this->pagination->initialize($config);
            $data['rules'] = $this->Rules_model->getRules( $condition, $config["per_page"], $page );
            $str_links = $this->pagination->create_links();
            //$str_links = str_replace('=/','=',$str_links);
            $data["links"] = explode('&nbsp;',$str_links );
        }

        return $data;
    }
    
    /**
    * add new rules with require fields validation
    * Get Data from post method
    * Redirect to index method
    * @Author Manish Yadav
    **/
    public function manageRule(){
    	
    	// set validation rules
        $this->form_validation->set_rules('rule_name', 'Rule name', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('screenshot_settings', 'Screenshot Settings', 'required');

        if( $this->input->post('type') == "Title Bar" || $this->input->post('type') == "Domain/URL" ){
        	$this->form_validation->set_rules('contains', 'Contains', 'required');
        	$this->form_validation->set_rules('popup_msg', 'Popup Message', 'required');
        }
        else{
        	$this->form_validation->set_rules('seconds', 'Screenshot Seconds', 'required');
        }
    
        // hold error messages in div 
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {
            $data['category']  = $this->Rules_model->getAllCategory();
        	$this->load->view('rules', $data);
        }else{

            $rule_array = array();
        	$data = array();

        	$data['name']          =   $this->input->post('rule_name');
        	$data['type']          =   $this->input->post('type');
            $data['category_id']   =   $this->input->post('category'); 
        	$data['status'] = '1';

            if( $this->input->post('type') == "Title Bar" || $this->input->post('type') == "Domain/URL" ){

        		$data['contains']  			=  $this->input->post('contains');
        		$data['one_screenshot'] 	=  '1';
        		$data['popup_message']		=  $this->input->post('popup_msg');

        	}
        	else{

        		$data['one_screenshot'] 			   =  '0';
        		$data['ever_second_screenshot']		   =  $this->input->post('seconds');
        	}

        	// check terminate option
        	if( isset($_POST['terminate']) ){
        		$data['terminate_application']		=  '1';
        	}

            if( $this->input->post('atype') == 'add' ){
                // insert data into database
                $this->Rules_model->addRule($data);
                $this->session->set_flashdata('notification', "Rule Add successfully!");
            }
            else if( $this->input->post('atype') == 'update' ){
                // update data into database
                $this->Rules_model->updateRule($data, $this->input->post('_uid'));
                $this->session->set_flashdata('notification', "Rule Update successfully!");
            }

            // add rule into rule file
            $this->writeRulesFile(); // write json file

            redirect(base_url().'index.php/rules','refresh');
        }	
    }

    public function deleteRules(){

        $rules = $this->input->post('rules');

        if( count($rules) > 0 ){

            foreach( $rules as $rule ){
                $this->Rules_model->deleteRule($rule);
                $this->writeRulesFile(); // delete rule from rule json file
            }

            $this->session->set_flashdata('notification', "Rule deleted successfully!");
        }
        else{
            $this->session->set_flashdata('notification', "Rule could not deleted successfully!");
        }

        $this->writeRulesFile(); // delete rule from rule json file

        redirect(base_url().'index.php/rules','refresh');
    }

    public function writeRulesFile(){

       if( file_exists( APP_BASE_PATH.'/nodeApp/rules/rules.json' ) ){
           
            $this->deleteRuleFile(); // rules file 

            $data = $this->getRulesData();
            if( count( $data ) > 0 ){
                $data = json_encode($data); // encode data before write into file
                $this->writeJsonFile( $data ); // write file 
            }

       }else{

            $data = $this->getRulesData();
            if( count( $data ) > 0 ){
                $data = json_encode($data); // encode data before write into file
                $this->writeJsonFile( $data ); // write file 
            }
       }
    }

    /**
    * Write json into rule file
    * @param data is json string
    * @Author Manish Yadav
    **/
    private function writeJsonFile( $data ){
        // create read and write file again
        $fp = fopen(APP_BASE_PATH.'/nodeApp/rules/rules.json', "x+");
        fwrite($fp, $data);
        fclose($fp);

        // change file permission
        chmod(APP_BASE_PATH.'/nodeApp/rules/rules.json', 0775);
    }

    /**
    * read data from database for create json file
    * @return string object
    * @Author Manish Yadav
    **/
    private function getRulesData(){
        $rules_data = $this->Rules_model->getRulesData( array('status'=>'1') );

        $rules['rules'] = array();
        $rules['last_update'] = date('Y-m-d H:i:s');

        if( count($rules_data) > 0 ){
            foreach( $rules_data as $key=>$value ){

                $rule_array = array();

                // set rules
                $rule_array['id']                   = $value->id;
                $rule_array['name']                 = $value->name;
                $rule_array['type']                 = $value->type;

                // set rules if choose one screenshot
                if( $value->one_screenshot == 1 ){
                    $rule_array['contains']             = $value->contains;
                    $rule_array['one_screenshot']       = $value->one_screenshot;
                    $rule_array['popup_message']        = $value->popup_message;
                }
                else if( $value->type == 'time' ){
                    // set rules
                    $rule_array['ever_second_screenshot']  = $value->ever_second_screenshot;
                }

                // check terminate condition
                if( $value->terminate_application ){
                    $rule_array['terminate_application']  = $value->terminate_application;
                }

               $rules['rules'][] = $rule_array;
            }
        }

        return $rules;
    }

    /**
    * Delete rule json file
    * @Author Manish Yadav
    **/
    public function deleteRuleFile(){
        // delete file
        @unlink(APP_BASE_PATH.'/nodeApp/rules/rules.json');
    }

    /**
    * change status
    * @Author Manish Yadav
    **/
    public function changeStatus($id, $status){
        if( $status == 1 ){
            $data['status'] = 0;
            $this->Rules_model->updateStatus($data, base64_decode($id));
            $this->session->set_flashdata('notification', "Rule status update successfully!");
            $this->writeRulesFile(); // delete rule from rule json file
        }
        else if( $status == 0 ){
            $data['status'] = 1;
            $this->Rules_model->updateStatus($data, base64_decode($id));
            $this->session->set_flashdata('notification', "Rule status update successfully!");
            $this->writeRulesFile(); // delete rule from rule json file
        }

        redirect(base_url().'index.php/rules','refresh');
    }
}