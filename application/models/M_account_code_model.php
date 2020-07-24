<?php

class M_account_code_model extends CI_Model
{
    function get($where)
    {
        $this->db->select("*");
        $this->db->from("m_account_code");
        $this->db->where($where);
        $this->db->order_by("acc_code asc");
        return $this->db->get();
    }

    function insert($data)
    {
        $this->db->insert("m_account_code", $data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_account_code", $data);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_account_code", array("flag" => 99));
    }
}
