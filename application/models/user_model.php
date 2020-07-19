<?php

class User_Model extends CI_Model
{
    function get($where)
    {
        $this->db->select("
        m_user.*,
        m_branch.address,
        ifnull(m_employee.branch_id,1) branch_id,
        s1.detail_data as level_name, 
        s2.detail_data as position_name, 
        ifnull(m_branch.name, '') branch_name");
      
        $this->db->from("m_user");
        $this->db->join("m_employee", "m_employee.user_id = m_user.id", "left");
        $this->db->join("m_branch", "m_branch.id = m_employee.branch_id", "left");
        $this->db->join("s_reference s1", "s1.id = m_employee.level_id", "left");
        $this->db->join("s_reference s2", "s2.id = m_employee.position_id", "left");
        $this->db->where($where);
        return $this->db->get();
    }

    function get_all() 
    {
        return $this->db->get("m_user");
    }

    function insert($data)
    {
        $this->db->insert("m_user", $data);
        return $this->get(array("m_user.id" => $this->db->insert_id()));
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_user", $data);
        return $this->get($where);
    }

    function login($where)
    {
        $this->db->update("m_user", array("last_login" => date("Y-m-d h:i:s")), $where);
    }
}
