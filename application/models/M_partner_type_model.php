<?php

class M_partner_type_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get("m_partner_type");
    }

    function get($where)
    {
        $where['flag <>'] = 99;
        return $this->db->get_where("m_partner_type", $where);
    }

    function insert($data)
    {
        $this->db->insert("m_partner_type", $data);
    }

    function update($where, $data)
    {
        $this->db->update("m_partner_type", $data, $where);
    }

    function get_unmap($branch_id)
    {
        return $this->db->query(
            "SELECT * FROM m_partner_type WHERE type NOT IN ( SELECT partner_type FROM m_map WHERE branch_id = $branch_id and flag <> 99)"
        );
    }
}
