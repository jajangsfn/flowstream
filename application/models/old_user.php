<?php

class User_Model extends CI_Model
{
    function get($where)
    {
<<<<<<< HEAD
        $this->db->select("user.*,ifnull(m_employee.branch_id,1) branch_id, ifnull(m_branch.name, '') branch_name");
        $this->db->from("user");
        $this->db->join("m_employee","m_employee.user_id=user.id","left");
        $this->db->join("m_branch","m_branch.id=m_employee.branch_id","left");
        $this->db->where($where);
        return $this->db->get();
=======
        return $this->db->get_where("m_user", $where);
>>>>>>> fa489e559145584cbd9d12f2dbab3dbb28d708b6
    }

    function get_all()
    {
        return $this->db->get("m_user");
    }

    function insert($data)
    {
        $this->db->insert("m_user", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_user", $data);
        return $this->get($where);
    }
}
