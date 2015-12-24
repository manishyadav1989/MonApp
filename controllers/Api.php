<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';


class Api extends REST_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('api_model');
    }

    /* 
        This api is used to save data when system starts and shuts
    */
    function systemaction_post(){
        $data=array();
    
        
        if($this->post('action')=='systemaction'){
            $userId                 = $this->post('userId');
            $sysName                = $this->post('sysName');          
            $date                   = $this->post('date');          
            $time                   = $this->post('time');  

            $dateA = explode("-",$date);
            $new_date = $dateA[2]."-".$dateA[1]."-".$dateA[0];         
            
            $return_value = $this->api_model->saveSystemAction($userId,$sysName,$new_date,$time);
            
            if(!empty($return_value)){
                $this->response($return_value, 200); // 200 being the HTTP response code
            }else{
                $this->response(array('msg'=>'User does not exist','status'=>0), 200);
            }
        }else{
            $this->response(array('msg' => 'not a valid requests','status'=>'0'), 200);
        }
    }

    public function systemAppLog_post() {
        $data=array();
    
        if($this->post('action')=='systemApprunning'){
            $userId               = $this->post('userId');
            $appLog               = $this->post('appLog');          
            $currentDateTime      = $this->post('currentDateTime');  
            $rand_token           = $this->post('app_token'); 
            $duration             = $this->post('duration');

            $dateA = explode(" ", $currentDateTime);        
            $dateAA = explode("-", $dateA[0]);
            $new_date = $dateAA[2]."-".$dateAA[1]."-".$dateAA[0];
            
            $new_date_time = $new_date." ".$dateA[1];

           // $appLog = str_replace('"', '', $appLog); // remove double quotes from array json string
            //$appLog = str_replace("'", '"', $appLog); // replace single quotes with double quotes
            //$appLog = stripslashes($appLog); // remove stripslashes

            $data['userId'] = $userId;
            $data['currentDateTime'] = $new_date_time;
            $data['rand_token'] = $rand_token;
            $data['duration'] = $duration;

            $return_value = array();

            if( count($appLog) > 0 ){

                foreach( $appLog as $value ){

                    $d = explode(':=>', $value);

                    if( $d[0] != 'DCSHelper' ){
                        $data['appName'] = $d[0];
                        $data['appTitle'] = $d[1];

                        // insert record into database
                       $return_value = $this->api_model->saveSystemApprunning($userId, $data);
                    }                   
                }
            }
           
            if(!empty($return_value)){
                $this->response($return_value, 200); // 200 being the HTTP response code
            }else{
                $this->response(array('msg'=>'User does not exist','status'=>0), 200);
            }
        }else{
            $this->response(array('msg' => 'not a valid requests','status'=>'0'), 200);
        }
    }
	

     public function systemRunning_post() {
        $data=array();
    

        if($this->post('action')=='systemrunning'){
            $userId                 = $this->post('userId');
            $lastLoginId                 = $this->post('lastLoginId');
            $sysPerformance                = $this->post('sysPerformance');          
            $currentDateTime                   = $this->post('currentDateTime');     

            $dateA = explode(" ", $currentDateTime);        
            $dateAA = explode("-", $dateA[0]);
            $new_date = $dateAA[2]."-".$dateAA[1]."-".$dateAA[0];
            
            $new_date_time = $new_date." ".$dateA[1];     
            
            $return_value = $this->api_model->saveCpuPerformance($userId,$sysPerformance,$new_date_time, $lastLoginId);
            
            if(!empty($return_value)){
                $this->response($return_value, 200); // 200 being the HTTP response code
            }else{
                $this->response(array('msg'=>'User does not exist','status'=>0), 200);
            }
        }else{
            $this->response(array('msg' => 'not a valid requests','status'=>'0'), 200);
        }
    }

    /**
    * Code edited by Manish Yadav
    **/
    public function systemScreenshots_post() {
        $data=array();
//mail('bhuvneshgupta03@gmail.com','sysPerformance',json_encode($_POST));        
        if($this->post('action')=='systemscreenshots'){
            $userId                 = $this->post('user');
            $filename               = $this->post('filename');
            $file                   = base64_decode($this->post('file'));          
            $date                   = $this->post('date');          
            $time                   = $this->post('time');    

            $dateA = explode("-",$date);
            $new_date = $dateA[2]."-".$dateA[1]."-".$dateA[0];
            
            file_put_contents("uploads/screenshots/".$filename,$file); 

            // resized original image
            if(!$this->cropImage("uploads/screenshots/".$filename, "uploads/screenshots/thumb/".$filename, 150, 150) ){
                 //mail('bhuvneshgupta03@gmail.com','image manipulation','Sorry, image could not resized');
            }
            
            $return_value = $this->api_model->saveSystemScreenshots($userId,$filename,$new_date,$time);
            
            if(!empty($return_value)){
                $this->response($return_value, 200); // 200 being the HTTP response code
            }else{
                $this->response(array('msg'=>'User does not exist...','status'=>0), 200);
            }
        }else{
            $this->response(array('msg' => 'not a valid requests','status'=>'0'), 200);
        }
    }


    /**
    * Create image thumb
    * @Author Manish Yadav
    * 
    * @Param string source path of image
    * @Param string destination path of image save
    * @Param int height new height of resize image
    * @Param int width new width of resize image
    * @return boolean value
    *
    **/
    public function cropImage($source, $destination, $height, $width){

        // set image configuration 
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $source;
        $image_config['create_thumb'] = FALSE;
        $image_config['maintain_ratio'] = TRUE;
        $image_config['new_image'] = $destination;
        $image_config['quality'] = "100%";
        $image_config['width'] = $width;
        $image_config['height'] = $height;
        //$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
        //$image_config['master_dim'] = ($dim > 0)? "height" : "width";
        $image_config['master_dim'] = "width";
         
        // load image library
        $this->load->library('image_lib');

        // intilise configuration
        $this->image_lib->initialize($image_config);

        if(!$this->image_lib->resize() ){ //Resize image
            return false; //If error
        }else{ 
            return true; 
        }
    }


}

?>