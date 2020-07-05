<?php

class User_Model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_user", $where);
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
