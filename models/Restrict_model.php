<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Restrict_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();  
    } 

    public function get_domain( $condition, $limit, $start)
	{
        $this->db->where( $condition );
		$this->db->order_by("restriction_id", "desc"); 
		$query = $this->db->limit( $limit, $start )->get('ems_restriction_domain');
		return $query->result_array();
	}
	
    // Count all record of table "contact_info" in database.
    public function record_count( $condition ) {
        $this->db->where( $condition );
        $query = $this->db->get('ems_restriction_domain');
        return $query->num_rows();
    }

    // delete selected domain
    public function delete_domain($cat_id)
	{
		$this->db->delete('ems_restriction_domain', array('restriction_id' => $cat_id)); 
	}

    // add new domain in restriction list
	public function add_domain($data)
	{
		$this->db->insert('ems_restriction_domain', $data); 
	}
	
    // block domain selected computer
    public function block_systems($data, $domain_id)
    {
        $this->db->where('restriction_id', $domain_id ); 
        $this->db->update('ems_restriction_domain', $data);
    }
	
    // get unique computer list according user id
    public function getComList(){
        $query = $this->db->select(['id', 'CONCAT(com_name,"->", user_name) as com_name'])->where('com_name IS NOT NULL', null)->get('user');
        return $query->result();
    }

    // get computer names
    public function getComNames($condition){
        $query = $this->db->query("SELECT GROUP_CONCAT( CONCAT(com_name,'->', user_name) SEPARATOR ', ') as comName FROM user WHERE ".$condition);
        return $query->row();
    }
	
}
