<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Screenshots extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->model('screenshot_model');
        $this->load->model('custom_model');
        $this->load->library('pagination');
		//is_logged_in();
		define('CONTROLLER', strtolower(__CLASS__));
		$this->load->library('zip');
		$this->load->library('session');
		$this->load->helper('download');
    }


	function index(){
		$this->load->view('screenshots', $this->screenShotList() );
	}
   
   	// get screenshots list
	public function screenShotList(){

		$data = $condition = array();
		$data['screenshots'] = array();
		$data['links'] = array();

		// set conidition according user 
		$condition['1'] = '1';
		if( isset($_REQUEST['user_filter']) ){
			$condition['userId'] = $_REQUEST['user_filter'];
		}

		// set condition according computer name wise
		if( isset($_REQUEST['com_filter']) ){
			$user = $this->custom_model->getComUser( $_REQUEST['com_filter'] ); 
			if( $user  > 0 ){
				$condition['userId'] = $user;
			}			
		}

		// get total rows no according condition
		$total_row = $this->screenshot_model->record_count($condition);

		$pageUrl = $perPageUrl = base_url().'index.php/screenshots?';
		//$pageUrl = $perPageUrl.'page=';
		$userUrl = $perPageUrl; 
		$comUrl = $perPageUrl; 

		if( $total_row > 0 ){
			$config = array();
	
			$config['page_query_string'] = TRUE;
			$config["total_rows"] = $total_row;
			$config["per_page"] = 12;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['uri_segment'] = 1;
			$config['num_links'] = 10;
			$config['cur_tag_open'] = '&nbsp;<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Newer <i class="fa fa-angle-right"></i>';
			$config['prev_link'] = '<i class="fa fa-angle-left"></i> Older';
			$page = 0;

			if( isset( $_REQUEST['per_page_rec'] ) ){
				$config["per_page"] = $_REQUEST['per_page_rec'];		
			}

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
		      	//$pageUrl .= '&per_page=';

		      	unset($vars['per_page_rec']);
		      	$perPageUrl .= '?'.http_build_query($vars);

		      	unset($vars['user_filter']);
		      	$userUrl .= '?'.http_build_query($vars);

		      	unset($vars['com_filter']);
		      	$comUrl .= '?'.http_build_query($vars);

		  	}

		  	// set configuration for pagination
			$config["base_url"] = $pageUrl;
			//pr($config);
			$this->pagination->initialize($config);

			$data['screenshots'] = $this->screenshot_model->getAllScreenshot( $condition, $config["per_page"], $page );
			$str_links = $this->pagination->create_links();
			//$str_links = str_replace('=/','=',$str_links);
			$data["links"] = explode('&nbsp;',$str_links );
		}		

		// set data to show on view page
		$data['url'] = $perPageUrl;
		$data['userUrl'] = $userUrl;
		$data['comUrl'] = $comUrl;
		$data['users'] = $this->custom_model->getAllUsers();
		$data['comps'] = $this->custom_model->getComName();

		return $data;
	}

	// export all/current screenshots
    public function downloadScreenshot(){

    	try{

    		// get current screenshots ids
	    	$screenshots = $this->input->post('_screenshots', TRUE);

	    	if( count( $screenshots ) > 0 ){

	    		$param =  $this->input->post('dtype');
	    		if( $param == 'current' ){
	    			// get current screenshots names
		    		$screenshotList = $this->screenshot_model->getCurrentScreenshotFiles( $screenshots );
	    		}
		    	else if( $param == 'all' ){
		    		$data = $condition = array();
					// set conidition according user 
					$condition['1'] = '1';
					if( isset($_REQUEST['user_filter']) ){
						$condition['userId'] = $_REQUEST['user_filter'];
					}

					// set condition according computer name wise
					if( isset($_REQUEST['com_filter']) ){
						$user = $this->screenshot_model->getComUser( $_REQUEST['com_filter'] ); 
						if( $user  > 0 ){
							$condition['userId'] = $user;
						}			
					}

					// get all screenshots names
					$screenshotList = $this->screenshot_model->getAllScreenshotFiles( $condition );
		    	}

		    	// check screenshots available or not
		    	if( count( $screenshotList ) > 0 ){
		    		// create zip directory name
			    	$zipFileName = date('d-m-Y').'_'.$param;

			    	foreach($screenshotList as $key=>$value){
			    		// prepare screenshot file path
			    		$path = 'uploads/screenshots/'.$value->filename;
			    		// check file exists or not
			    		if( file_exists($path) )
							$this->zip->read_file($path); 
			    	}

					// Download the file to your desktop. Name it "my_backup.zip"
					$this->zip->download($zipFileName.'.zip');
		    	}
		    	else{
		    		$this->session->set_userdata('flash_message', 'Sorry, screenshot not available!');
		    		$this->redirect(base_url().'index.php/screenshots');
		    	}		    	
	    	}
	    	else{
	    		die('There is no screenshots!');
	    	}	
    	}
    	catch (Exception $e) {
		    //alert the user then kill the process
		    echo $e->getMessage();
		}  	
    } 

    // delete all/current screenshots
    public function deleteScreenshot(){

    	try{

    		// get current screenshots ids
	    	$screenshots = $this->input->post('_screenshots', TRUE);

	    	if( count( $screenshots ) > 0 ){

	    		$param =  $this->input->post('dtype');
	    		if( $param == 'current' ){
	    			// get current screenshots names
		    		$screenshotList = $this->screenshot_model->getCurrentScreenshotFiles( $screenshots );
	    		}
		    	else if( $param == 'all' ){
		    		$data = $condition = array();
					// set conidition according user 
					$condition['1'] = '1';
					if( isset($_REQUEST['user_filter']) ){
						$condition['userId'] = $_REQUEST['user_filter'];
					}

					// set condition according computer name wise
					if( isset($_REQUEST['com_filter']) ){
						$user = $this->screenshot_model->getComUser( $_REQUEST['com_filter'] ); 
						if( $user  > 0 ){
							$condition['userId'] = $user;
						}			
					}

					// get all screenshots names
					$screenshotList = $this->screenshot_model->getAllScreenshotFiles( $condition );
		    	}

		    	// check screenshots available or not
		    	if( count( $screenshotList ) > 0 ){
			    	foreach($screenshotList as $key=>$value){
			    		// prepare screenshot file path
			    		$path = 'uploads/screenshots/'.$value->filename;
			    		// check and delete file 
			    		if( file_exists($paths) )
							unlink($path); 

						// delete record from database
						$this->screenshot_model->deleteScreenshot( $value->id );
			    	}

			    	$this->session->set_userdata('flash_message', 'Screenshots delete successfully!');
		    		$this->redirect(base_url().'index.php/screenshots');
		    	}
		    	else{
		    		$this->session->set_userdata('flash_message', 'Sorry, screenshot not delete!');
		    		$this->redirect(base_url().'index.php/screenshots');
		    	}		    	
	    	}
	    	else{
	    		die('There is no screenshots!');
	    	}	
    	}
    	catch (Exception $e) {
		    //alert the user then kill the process
		    echo $e->getMessage();
		}  	
    }      

    // download single file
    public function downloadSingleFile( $filename ){

    	if( $filename != '' ){
    		$data = file_get_contents("uploads/screenshots/".$filename); // Read the file's contents
			$name = $filename; // define new file name
			// force download file 
			force_download($name, $data);
    	}
    	
    }
}