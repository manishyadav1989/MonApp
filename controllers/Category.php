<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->model('Cat_model');

		define('CONTROLLER', strtolower(__CLASS__));

        $this->load->library(array('form_validation','session')); // load form lidation libaray & session library
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
        $this->load->library('pagination');

    }
    //Category View Code//
	function index(){
		
        $this->load->view('category', $this->getCategories() );
	}
	
    // get all category list
    public function getCategories(){

        $data               = array();
        $total_row = $this->Cat_model->record_count();

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

            $pageUrl = $perPageUrl = base_url().'index.php/category?';
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
            $data['selectpage'] = $this->Cat_model->get_all_category( $config["per_page"], $page );
            $str_links = $this->pagination->create_links();
            //$str_links = str_replace('=/','=',$str_links);
            $data["links"] = explode('&nbsp;',$str_links );
        }

        return $data;
    }

    //add Category code//
    public function add_category()
	{
        // set validation rules
        $this->form_validation->set_rules('cat_name', 'Category name', 'required|min_length[2]');
    
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {

            $data               = array();
            $data['selectpage'] = $this->Cat_model->get_all_category();
            $this->load->view('category',$data);

        }else{

            $data                        =array();
            $website_link                =$this->input->post('website_link');
            $data['cat_name']            =$this->input->post('cat_name');
            $this->Cat_model->add_cat($data);
            $this->session->set_flashdata('notification', "Category Add successfully!");
            redirect(base_url().'index.php/category','refresh');
        }

	}
	//Update Category code//
	public function update_category($id=0, $token)
	 {
        $data               = array();
        if($id){

        $id = base64_decode($id);    
        $data['cat']       = $this->Cat_model->edit_cat($id);
        $data['ID']         = $id;
        $this->load->view('edit_cat', $data);
        }else{
        redirect(getUrl('category'));
        }
    }
	//Remove Category code//
	public function delete_category($cat_id, $token)
	{
        $cat_id = base64_decode($cat_id);
		$this->Cat_model->delete_cat($cat_id);
		redirect(site_url().'/category');
	}
	function save_category()
    {
        // set validation rules
        $this->form_validation->set_rules('cat_name', 'Category name', 'required|min_length[2]');
    
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {

            $id = base64_decode($this->input->post('cat_id'));    
            $data['cat']       = $this->Cat_model->edit_cat($id);
            $data['ID']         = $id;
            $this->load->view('edit_cat', $data);

        }else{

            $data                        = array();
            $data['cat_id']              = base64_decode( $this->input->post('cat_id') );
           	$data['cat_name']            = $this->input->post('cat_name');
            $this->Cat_model->update_cat($data);
            $this->session->set_flashdata('notification',"Category has been updated successfully.");
            redirect(base_url().'index.php/category');
        }
    }

    // delete selected categories
    public function deleteCategories(){

        if( isset($_POST['categories']) ){

            $categories = $this->input->post('categories');

            if( count($categories) > 0 ){
                foreach( $categories as $key=>$value ){
                    $cat_id = base64_decode($value);
                    $this->Cat_model->delete_cat($cat_id);
                }
                // set flash message after delete categories
                $this->session->set_flashdata('notification',"Selected categories has been deleted successfully.");
            }
            else{
                $this->session->set_flashdata('notification',"Please select category/categories.");
            }
            
            // redirect to category page after done work
            redirect(site_url().'/category');
        }
        else{
            // return back to category page if categories not found
            $this->session->set_flashdata('notification',"Sorry, your request could not completed!");
            redirect(base_url().'index.php/category');
        }
    }
}