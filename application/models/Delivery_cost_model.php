<?php

class Delivery_cost_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("delivery_cost", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            cost.*,
            orderdel.delivery_no, 
            deliv.name

            FROM delivery_cost as cost

            LEFT JOIN delivery_order orderdel on orderdel.id = cost.delivery_order_id
            LEFT JOIN m_delivery deliv on deliv.id = cost.delivery_id
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("delivery_cost", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("delivery_cost", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete("delivery_cost");
    }
}
