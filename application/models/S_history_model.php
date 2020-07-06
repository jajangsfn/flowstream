<?php
/**
 * 
 */
class S_history_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($where)
    {
        return $this->db->get_where("s_history", $where);
    }

	function insert($data)
    {
        $this->db->insert("s_history", $data);
        return $this->get($data);
    }
}
?>