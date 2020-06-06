<?php

class User_Model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("user", $where);
    }

    function get_all()
    {
        return $this->db->get("user");
    }

    function insert($data)
    {
        $this->db->insert("user", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("user", $data);
        return $this->get($where);
    }
}
