<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_model extends CI_Model {
    /* Login Model */

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    
    function saveSystemAction($userId,$sysName,$date,$time){
        $userExist = $this->checkUserWithID($userId);
        if($userExist>0){
            $data['userId'] = $userId;
            $data['sysName'] = $sysName;
            $data['start_date'] = $date;
            $data['start_time'] = $time;

            $this->db->insert('system',$data);
            $insert_id = $this->db->insert_id();
            return array('msg'=>'Data inserted successfully','status'=>1, 'lastLoginId'=>$insert_id);
        }
        else{
            return array();    
        }
        

    }

    function saveSystemApprunning($userId,$data){
        $userExist = $this->checkUserWithID($userId);
        if($userExist>0){
            $this->db->insert('system_app_log',$data);
            return array('msg'=>'Data inserted successfully','status'=>1);
        }
        else{
            return array();    
        }
        

    }


    function saveCpuPerformance($userId,$sysPerformance,$currentDateTime, $lastLoginId){
        $userExist = $this->checkUserWithID($userId);
        if($userExist>0){
            $data['userId'] = $userId;
            $data['sysPerformance'] = $sysPerformance;
            $data['currentDateTime'] = $currentDateTime;

            $this->db->insert('system_cpu_performance',$data);

            // update end date of running system
            $date = explode(' ', $currentDateTime);
            $sdata['end_date'] = $date[0];
            $sdata['end_time'] = $date[1];
            $this->db->where('id', $lastLoginId);
            $this->db->update('system',$sdata);
            // end code

            return array('msg'=>'Data inserted successfully','status'=>1);
        }
        else{
            return array();    
        }
        

    }

    function saveSystemScreenshots($userId,$filename,$date,$time){
        $userExist = $this->checkUserWithID($userId);
        if($userExist>0){
            $data['userId'] = $userId;
            $data['filename'] = $filename;
            $data['date'] = $date;
            $data['time'] = $time;

            $this->db->insert('system_screenshots',$data);
            return array('msg'=>'Data inserted successfully','status'=>1);
        }
        else{
            return array();    
        }
        

    }

    function checkUserWithID($userId){
        $this->db->where('id',$userId);
        return $this->db->count_all_results('user');
    }
}

?>