<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restrictions extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->model('Restrict_model');
        $this->load->library('pagination');
        $this->load->library(array('form_validation','session')); // load form lidation libaray & session library
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional

        define('CONTROLLER', strtolower(__CLASS__));
    }
	function index(){
        $this->load->view('restrictions', $this->getDomains() );
	}

	// get all category list
    public function getDomains(){

    	$condition = "1=1";

    	// search record
    	if( isset($_REQUEST['s']) ){
    		$search = $this->input->get('s');
    		
    		if( $search != '' ){
    			$condition = "domain_name LIKE '%".$search."%'";
    		}
    	}

        $data               = array();
        $total_row = $this->Restrict_model->record_count( $condition );
        $data['selectpage'] = array();
        $data["links"] = array();
        $data["comList"] = array();

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

            $pageUrl = $perPageUrl = base_url().'index.php/restrictions?';
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
            $data['selectpage'] = $this->Restrict_model->get_domain( $condition, $config["per_page"], $page ); // get domains
            $data['comList'] = $this->Restrict_model->getComList(); // get all computers name list with use
           	
            // create pagination link
            $str_links = $this->pagination->create_links();
            //$str_links = str_replace('=/','=',$str_links);
            $data["links"] = explode('&nbsp;',$str_links );            
        }

        return $data;
    }

	public function add_domain()
	{
		        // set validation rules
        $this->form_validation->set_rules('domain_name', 'Domain name', 'required');
    
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {

            $data = $this->getDomains();
            $this->load->view('restrictions',$data);

        }else{

			$data  = array();
	        $domain_status=$this->input->post('domain_status');

			if(empty($domain_status)){
				$domain_status='0';
			}else{
                $data['block_all'] = '1';
				$domain_status='1';
                // get all computer name list form database
                $computers = $this->Restrict_model->getComList();
                $comList = array();

                // check computer available or not
                if( count( $computers ) > 0 ){

                    // if computers more than one 
                    if( count( $computers ) > 1 ){
                        foreach( $computers as $key=>$value ){
                            $comList[] = $value->id;
                        }
                    }
                    else{ // if single computer available
                        $comList[] = $computers->id;
                    }

                    // put computer names into blocked computer with comma seprated
                    $data['blocked_computer'] = implode(',', $comList);                    
                }
			}
			
			$data['domain_name']   = $this->input->post('domain_name');
	        $data['domain_status'] = $domain_status;

	        $this->Restrict_model->add_domain($data);

            $this->session->set_flashdata('notification', "Domain Add successfully!");
            redirect(base_url().'index.php/restrictions','refresh');
        }

	}
	

    /**
    * Delete domains from database
    * @request get post type 
    * @Author Manish Yadav
    **/
	public function delete_domain()
	{
		// get selected domains from post request
		$selected_domains = $this->input->post('selected_item');

		// check len of selected domain
		if( count( $selected_domains ) > 0 ){

			// delete all selected domains
			foreach( $selected_domains as $key=>$value ){
				// delete domain 
				$this->Restrict_model->delete_domain($value);
			}

			// set notification message to user
			$this->session->set_flashdata('notification', "Domains deleted successfully!");
		}
		else{
			// set notification message to user
			$this->session->set_flashdata('notification', "Please select domain");
		}

		// redirect to restriction page
		redirect(base_url().'index.php/restrictions');
	}

	/**
	* block domain to computer by selected computer name
    * @request get post type 
    * @Author Manish Yadav 
	**/	
	public function block_by_computer(){

		// get selected domains from post request
		$block_systems = $this->input->post('block_systems');

		// check len of block systems blocked_computer
		if( count( $block_systems ) ){

			if( isset($_POST['block_all']) ){
				$data['block_all'] = '1';
			}
            else{
                $data['block_all'] = '0';
            }

			$data['blocked_computer'] = implode(',', $block_systems);
			$data['blocked_date'] = date('Y-m-d H:i:s');
			$data['domain_status'] = '1';

			$this->Restrict_model->block_systems( $data, $this->input->post('domain_id') );

			// set notification message to user
			$this->session->set_flashdata('notification', "Domains blocked successfully in selected computers!");
		
		}
		else{
			$data['blocked_computer'] = '';
            $data['block_all'] = '0';
			
			$data['domain_status'] = '0';
			$data['blocked_date'] = date('Y-m-d H:i:s');
			$this->Restrict_model->block_systems( $data, $this->input->post('domain_id') );
			// set notification message to user
			$this->session->set_flashdata('notification', "Domains unblock from all computers successfully!");
			
		}

		// redirect to restriction page
		redirect(base_url().'index.php/restrictions');
	} 

}