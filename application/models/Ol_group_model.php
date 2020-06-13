<?php

class Ol_group_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("ol_group", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            olgroup.*

            FROM ol_group as olgroup

            where olgroup.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("ol_group", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("ol_group", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("ol_group", array("flag" => 99));
        return $this->get($where);
    }
}
