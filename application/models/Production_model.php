<?php

class Production_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("production", $where);
    }

    function get_all()
    {
        return $this->db->get_where("production", array("flag <>" => 99));
    }

    function insert($data)
    {
        $this->db->insert("production", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("production", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("production", array("flag" => 99));
        return $this->get($where);
    }
}
