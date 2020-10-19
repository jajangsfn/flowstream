<?php

class M_partner_salesman_model extends CI_Model
{
    function register_general($supplier_id)
    {
        $data = array(
            "name" => "General",
            "salesman_status" => "1",
            "created_date" => date("Y-m-d h:i:s"),
            "flag" => "1",
            "partner_id" => $supplier_id,
        );
        $this->db->insert("m_partner_salesman", $data);
    }

    function update($where, $data)
    {
        $this->db->update("m_partner_salesman", $data, $where);
    }

    function get($where)
    {
        return $this->db->get_where("m_partner_salesman", $where);
    }

    function insert($data)
    {
        $this->db->insert("m_partner_salesman", $data);
    }

    function delete($where)
    {
        $this->update($where, array("flag" => 99));
    }
}
