<?php

class M_journal_mapping_model extends CI_Model
{
    function get($where = null)
    {
        $this->db->select("m_journal_mapping.*, m_account_code.acc_name");
        $this->db->from("m_journal_mapping");
        $this->db->join("m_account_code", "m_account_code.acc_code = m_journal_mapping.ACCOUNT_CODE", "left");
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by("JOURNAL_CD asc, SEQ_LINE asc");
        return $this->db->get();
    }

    function insert($data)
    {
        $this->db->insert("m_journal_mapping", $data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_journal_mapping", $data);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_journal_mapping", array("flag" => 99));
    }
}
