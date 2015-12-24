<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Rules_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();  
    } 

    public function getAllCategory()
    {
        $this->db->order_by("cat_id", "desc"); 
        $query = $this->db->get('ems_category');
        return $query->result();
    }

    public function getRules( $condition, $limit, $start)
	{
        $this->db->select('rules.*, ems_category.cat_name as category'); // you can write other fields using comma 
        $this->db->from("rules");        
        $this->db->join("ems_category",'ems_category.cat_id = rules.category_id','INNER');
        $this->db->where( $condition );
        $this->db->order_by("id", "desc"); 
        $this->db->limit( $limit, $start );
        $query = $this->db->get();     
        return $query->result();
	}

    public function getRulesData( $condition ){
        $query = $this->db->where( $condition )->get('rules');
        return $query->result();
    }
	
    // Count all record of table "contact_info" in database.
    public function record_count( $condition ) {
        $this->db->where( $condition );
        $query = $this->db->get('rules');
        return $query->num_rows();
    }

    // delete selected domain
    public function deleteRule($id){
		return $this->db->delete('rules', array('id' => $id)); 
	}

    // add new domain in restriction list
	public function addRule($data){
		$this->db->insert('rules', $data); 
        return $this->db->insert_id();
	}
	
    // get unique computer list according user id
    public function updateRule($data, $id){
        $this->deleteRule($id); 
        return $this->addRule($data);
    }

    // update rule status
    public function updateStatus($data, $id){
        $this->db->where('id',$id); 
        return $this->db->update('rules',$data);
    }
}
