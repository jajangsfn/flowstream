<?php

class M_warehouse_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_warehouse", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch_name
            FROM m_warehouse p
            LEFT JOIN m_branch b on b.id = p.branch_id
            
            WHERE p.flag <> 99" 
        );
    }

    function insert($data)
    {
        $this->db->insert("m_warehouse", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_warehouse", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_warehouse", array("flag" => 99));
        return $this->get($where);
    }
}
