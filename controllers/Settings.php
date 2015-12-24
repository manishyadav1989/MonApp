<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('form_validation','session')); // load form lidation libaray & session library
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
        $this->load->model('settings_model');
		//is_logged_in();
		define('CONTROLLER', strtolower(__CLASS__));
    }
	function index(){
		$this->load->view('settings');
	}

	// show time zone
	public function timeZone(){

		$data['timezone'] = $this->settings_model->getTimezonList(); // get timezone list
		$data['dateTime'] = $this->settings_model->getDateFormateList(); // get date time format

        $data['configTimezone']     = $this->settings_model->getTimezoneConfig(1);
        $data['configTimezoneDesc'] = $this->settings_model->getTimezoneDescConfig(1);
        $data['configDateFormat']   = $this->settings_model->getDateformatConfig(1);

		// show time zone content
		$this->load->view('time-zone', $data);
	}

    // show categories tab
    public function categories(){

        // get settings category
        $data = $this->getSettingsCategories();

        $data['categories'] = $this->settings_model->getAllCategories();
        // show categories content
        $this->load->view('settings-category', $data);
    }

    public function getSettingsCategories(){
        $condition = "1=1";

        // search record
        if( isset($_REQUEST['s']) ){
            $search = $this->input->get('s');
            
            if( $search != '' ){
                $condition = "domain_name LIKE '%".$search."%' or application_name LIKE '%".$search."%'";
            }
        }

        // search record by category
        if( isset($_REQUEST['cat']) ){
            $search = $this->input->get('cat');
            
            if( $search != '' ){
                $condition = "category = ".$search;
            }
        }

        $data               = array();
        $total_row = $this->settings_model->record_count( $condition );
        $data["links"] = array();
        $data['settingCategory'] = array();

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

            $pageUrl = $perPageUrl = base_url().'index.php/settings?';
            //$pageUrl = $perPageUrl.'page=';

            // if( isset( $_REQUEST['per_page'] ) ){
            //     $config["per_page"] = $_REQUEST['per_page'];        
            // }

            if( isset( $_REQUEST['per_page'] ) ){
                $config['uri_segment'] = $_REQUEST['per_page'];
                $page = ($_REQUEST['per_page']-1);
                $page = $page*$config["per_page"];          
            }
            
            // set configuration for pagination
            $config["base_url"] = $pageUrl;
            $this->pagination->initialize($config);
            $data['settingCategory'] = $this->settings_model->getSettingsCategory( $condition, $config["per_page"], $page ); // get domains
            // create pagination link
            $str_links = $this->pagination->create_links();
            //$str_links = str_replace('=/','=',$str_links);
            $data["links"] = explode('&nbsp;',$str_links );            
        }

        return $data;
    }

	/**
	* Store timezone with dateformat into configuration
	* @request post
	* @Author Manish Yadav
	**/
	public function storeTimezone(){
		// set validation rules
        $this->form_validation->set_rules('timezone', 'Timezone', 'required');
        $this->form_validation->set_rules('dateformat', 'Date Format', 'required');
    
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('settings');

        }else{

            $actionType                = $this->input->post('atype');

            // set first configuration
            $data1['sys_key']          = 'TIMEZONE';
            $data1['sys_value']        = $this->input->post('timezone');
            $data1['user']        	   = '1';
            $data1['description']      =$this->input->post('description');

            // set second configuration
            $data2['sys_key']          = 'DATEFORMAT';
            $data2['sys_value']        = $this->input->post('dateformat');
            $data2['user']        	   = '1';
            $data2['description']      = 'date format';

            // action type  
            if( $actionType == 'store' ){
                $this->settings_model->storeTimezone($data1, $data2);
            }
            else if( $actionType == 'update' ){
                // set conditions
                $condition1 = array('sys_key'=>'TIMEZONE', 'user'=>'1');
                $condition2 = array('sys_key'=>'DATEFORMAT', 'user'=>'1');

                // update system configuration
                $this->settings_model->updateTimezone($condition1, $condition2, $data1, $data2);
            }

            $this->session->set_flashdata('notification', "Timezone update successfully!");
            redirect(base_url().'index.php/settings','refresh');
        }
	}

    /**
    * Store category with domain name and application name
    * @request post
    * @Author Manish Yadav
    **/
    public function storeCategory(){
        // set validation rules
        $this->form_validation->set_rules('mark_as', 'Mark As', 'required');
        // $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('domain_name', 'Domain Name', 'callback_validateName');
    
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('settings');

        }else{

            if( isset( $_POST['actype'] ) ){
                $data['productive']         = $this->input->post('mark_as');
                $data['category']           = $this->input->post('category');
                $data['domain_name']        = $this->input->post('domain_name');
                $data['application_name']   = $this->input->post('application_name');

                if( $this->input->post('actype') == 'add' ){
                    // add new category settings
                    $this->settings_model->storeCategory( $data );
                    $this->session->set_flashdata('notification', "Application/Domain add in category successfully!");    
                }
                else if( $this->input->post('actype') == 'update' ){
                    // add new category settings
                    $this->settings_model->updateSetCategory( $data, ['id'=> $this->input->post('_uid')] );
                    $this->session->set_flashdata('notification', "Application/Domain update in category successfully!");    
                }
                
            }
            else{
                $this->session->set_flashdata('notification', "Sorry, something is missing in post request");
            }
            
            redirect(base_url().'index.php/settings','refresh');
        }
    }

    // validate domain and application anem
    public function validateName($str) {
        if ($str == '' && $this->input->post('application_name') == '' ){
            $this->form_validation->set_message('domain_name', 'Domain/Application name one is required');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function manageActions(){

        $setCategory = $this->input->post('settings_category');

        if( count( $setCategory ) > 0 ){
            $action = $this->input->post('atype');    

            // check action 
            if( $action == 'productive' ){
                $data['productive'] = '1';
                $this->session->set_flashdata('notification', "Domain/Application update with productive");
            } 
            else if( $action == 'unproductive' ){
                $data['productive'] = '0';
                $this->session->set_flashdata('notification', "Domain/Application update with unproductive");
            }   
            else if( $action == 'delete' ){
                $this->session->set_flashdata('notification', "Domain/Application deleted successfully!");
            } 

            foreach( $setCategory as $cat ){
                // check action
                if( $action == 'productive' || $action == 'unproductive' ){
                    $this->settings_model->updateSetCategory( $data, ['id'=>$cat] ); // update record
                }
                else if( $action == 'delete' ){
                    $this->settings_model->deleteSetCategory(['id'=>$cat] ); // update record
                }
            }      
        }
        else{
            $this->session->set_flashdata('notification', "Please select category perform action");
        }
        redirect(base_url().'index.php/settings','refresh');
    }

}