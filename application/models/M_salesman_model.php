<?php

class M_salesman_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_salesman", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "
            SELECT m_salesman.*, m_partner.name AS partner_name
            FROM m_salesman
            LEFT JOIN m_partner on m_salesman.partner_id = m_partner.id
            WHERE m_salesman.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("m_salesman", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_salesman", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_salesman", array("flag" => 99));
        return $this->get($where);
    }
}
