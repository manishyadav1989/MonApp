<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Cat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();  
    } 
    public function get_all_category( $limit, $start )
	{
		$this->db->order_by("cat_id", "desc"); 
		$query = $this->db->limit( $limit, $start )->get('ems_category');
		return $query->result_array();
	}

	// Count all record of table "contact_info" in database.
    public function record_count() {
        return $this->db->count_all('ems_category');
    }

    public function delete_cat($cat_id)
	{
		$this->db->delete('ems_category', array('cat_id' => $cat_id)); 
	}
	public function add_cat($data)
	{
		$this->db->insert('ems_category', $data); 
	}
	public function edit_cat($id)
	{
	
        $this->db->select('*');
        $this->db->from('ems_category');
        $this->db->where('cat_id', $id);
        $query = $this->db->get();
        return $query->row_array();
   }
    public function update_cat($data)
    {
        $this->db->where('cat_id', $data['cat_id']); 
        $this->db->update('ems_category', $data);
    }
	
	
}
