<?php

class M_event_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_event", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "
            SELECT e.*, b.name as branch_name
            FROM m_event e
            LEFT JOIN m_branch b on e.branch_id = b.id

            WHERE e.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("m_event", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_event", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_event", array("flag" => 99));
        return $this->get($where);
    }
}
