<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_session_details() 
{
	$CI =& get_instance();
	$data = (object)$CI->session->all_userdata();
	return $data;
}
function is_logged_in()
{
	$CI =& get_instance();
//        echo"<pre>";
//        print_r($CI);
//        die();
	$is_logged_in = $CI->session->userdata('userid');
	if(!$is_logged_in)
	{
        $CI->session->sess_destroy();
		redirect('logout/logoutAdmin');    
	}       
}
function isAgent()
{
	$CI =& get_instance();
//        echo"<pre>";
//        print_r($CI);
//        die();
	$is_Agent = $CI->session->userdata('user_type');
	if($is_Agent=='2')
	{
     	$CI->session->sess_destroy();
		redirect('logout/logoutUser');    
	}       
}

function getUserDetails($userId=NULL,$field='')
{
   $CI =& get_instance();
   $mod = $CI->load->model('user_model');
   $conditions = array('users.id'=>$userId);
   $result = $CI->user_model->getUsers($conditions);
   if($result->num_rows()>0) {
        $data = $result->row();
        $res = $data->$field;
   } else {
        $res = '';
   }
return $res;
}

function getComNames( $field='' )
{
   $field = explode(',', $field);

   if( is_array($field) ){
      $field = implode("','", $field);
   } 

   $CI =& get_instance();
   $mod = $CI->load->model('Restrict_model');
   $conditions = "id in ('".$field."')";
   $result = $CI->Restrict_model->getComNames($conditions);
  
   $data = '';
   if( count($result) > 0) {
        $data = $result->comName;
   } 

return $data;
}