<?php

class M_user_salesman_model extends CI_Model
{
    function get($where)
    {
        $this->db->select("
            m_user_salesman.*,
            m_employee.name
        ");
        $this->db->from("m_user_salesman");
        $this->db->join("m_employee", "m_employee.id = m_user_salesman.employee_id", "left");
        $where['m_user_salesman.flag <>'] = 99;
        $this->db->where($where);

        return $this->db->get();
    }

    function insert($data)
    {
        $this->db->insert("m_user_salesman", $data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_user_salesman", $data);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_user_salesman", array("flag" => 99));
    }
}
