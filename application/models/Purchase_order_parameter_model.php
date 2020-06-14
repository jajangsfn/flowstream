<?php

class Purchase_order_parameter_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("purchase_order_parameter", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT
            parameter.*,
            code.rekening_no

            FROM purchase_order_parameter parameter
            LEFT JOIN m_rekening_code code on code.id = parameter.rekening_code_id

            WHERE parameter.flag <> 99 
        "
        );
    }

    function insert($data)
    {
        $this->db->insert("purchase_order_parameter", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("purchase_order_parameter", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("purchase_order_parameter", array("flag" => 99));
        return $this->get($where);
    }
}
