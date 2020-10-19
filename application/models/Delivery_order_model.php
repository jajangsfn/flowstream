<?php

class Delivery_order_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("delivery_order", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            deliv.*,
            branch.name as branch_name

            FROM delivery_order as deliv
            LEFT JOIN m_branch as branch on branch.id = deliv.branch_id
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("delivery_order", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("delivery_order", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete("delivery_order");
    }
}
