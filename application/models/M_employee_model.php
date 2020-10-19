<?php

class M_employee_model extends CI_Model
{
    function get($where)
    {
        $this->db->select("
        m_employee.*,
        s1.detail_data as level_name,
        s2.detail_data as position_name,
        usr.role_code
        ");

        $this->db->from("m_employee");
        $this->db->join("s_reference s1", "s1.id = m_employee.level_id", "left");
        $this->db->join("s_reference s2", "s2.id = m_employee.position_id", "left");
        $this->db->join("m_user usr", "usr.id = m_employee.user_id", "left");

        $where['m_employee.flag <>'] = 99;
        $this->db->where($where);

        $this->db->order_by("id desc");

        return $this->db->get();
    }

    function get_all()
    {
        return $this->db->get_where("m_employee", array("flag <>" => 99));
    }

    function insert($data)
    {
        $this->db->insert("m_employee", $data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_employee", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_employee", array("flag" => 99));
    }
}
