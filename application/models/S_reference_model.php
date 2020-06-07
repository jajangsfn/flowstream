<?php

class S_reference_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("s_reference", $where);
    }

    function get_all()
    {
        return $this->db->get_where("s_reference", array("flag <>" => 99));
    }

    function get_group_data()
    {
        return $this->db->query(
            "select DISTINCT group_data from s_reference"
        );
    }

    function insert($data)
    {
        $this->db->insert("s_reference", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("s_reference", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("s_reference", array("flag" => 99));
        return $this->get($where);
    }
}
