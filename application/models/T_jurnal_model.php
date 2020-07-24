<?php

class T_jurnal_model extends CI_Model
{

    function insert($data)
    {
        $this->db->insert("t_jurnal", $data);
    }

    function insert_detail($data)
    {
        $this->db->insert("t_jurnal_detail", $data);
    }

    function delete($where)
    {
        $this->db->update("t_jurnal", array("flag" => 99), $where);
    }

    function delete_detail($where)
    {
        $this->db->delete("t_jurnal_detail", $where);
    }

    function update($where, $data)
    {
        $this->db->update("t_jurnal", $data, $where);
    }

    function get($where)
    {
        $this->db->select("*");
        $this->db->from("t_jurnal");
        $this->db->where($where);
        return $this->db->get();
    }
}
