<?php

class M_partner_type_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get("m_partner_type");
    }
}
