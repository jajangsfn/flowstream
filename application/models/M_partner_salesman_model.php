<?php

class M_partner_salesman_model extends CI_Model
{
    function register_general($supplier_id)
    {
        $data = array(
            "partner_id" => $supplier_id,
        );
        $this->db->insert("m_partner_salesman", $data);
    }

    function update($where, $data)
    {
        $this->db->update("m_partner_salesman", $data, $where);
    }
}
