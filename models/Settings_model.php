<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Settings_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();  
    } 

    // get all timezone list
    public function getTimezonList()
	{
		$query = $this->db->select(['gmt', 'timezone_location'])->order_by('timezone_location','asc')->get('timezones');
		return $query->result();
	}

    // get all date format
    public function getDateFormateList()
    {
        $query = $this->db->select(['format', 'date_format'])->get('date_format');
        return $query->result();
    }

    // get timezone from configuration
    public function getTimezoneConfig( $user ){
        return $this->db->where(['sys_key'=>'TIMEZONE', 'user'=>$user])->get('sys_config')->row()->sys_value;
    }

    // get timezone description from configuration
    public function getTimezoneDescConfig( $user ){
        return $this->db->where(['sys_key'=>'TIMEZONE', 'user'=>$user])->get('sys_config')->row()->description;
    }

    // get dateformat from configuration
    public function getDateformatConfig( $user ){
        return $this->db->where(['sys_key'=>'DATEFORMAT', 'user'=>$user])->get('sys_config')->row()->sys_value;
    }	
   
    // add new timezone and date format configuration
	public function storeTimezone($data1, $data2)
	{
		$this->db->insert('sys_config', $data1); 
        $this->db->insert('sys_config', $data2); 
	}

    // update new timezone and date format configuration
    public function updateTimezone($condition1, $condition2, $data1, $data2)
    {
        // set update condition
        $this->db->where($condition1);
        // update sys configuration
        $this->db->update('sys_config', $data1); 

        // set update condition
        $this->db->where($condition2);
        // update sys configuration
        $this->db->update('sys_config', $data2); 
    }


    public function getAllCategories()
    {
        $query = $this->db->select(['cat_id','cat_name'])->order_by("cat_id", "desc")->get('ems_category');
        return $query->result();
    }
	
    // get unique computer list according user id
    public function storeCategory( $data ){
        return $this->db->insert('setting_categories', $data); 
    }

    // Count all record of table "contact_info" in database.
    public function record_count( $condition ) {
        $query = $this->db->where($condition)->get('setting_categories');
        return $query->num_rows();
    }

    // get settings category
    public function getSettingsCategory($condition, $limit, $start){
        $query = $this->db->where( $condition )->order_by("id", "desc")->limit( $limit, $start )->get('setting_categories');
        return $query->result();
    }

    // update settings category
    public function updateSetCategory($data, $condition){
        $this->db->where($condition);
        $this->db->update('setting_categories', $data);
    }

    // delete settings category
    public function deleteSetCategory($condition){
        $this->db->where($condition);
        $this->db->delete('setting_categories');
    }
	           
}
