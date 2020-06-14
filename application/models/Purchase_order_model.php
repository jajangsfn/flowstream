<?php

class Purchase_order_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("purchase_order", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            po.*,
            branch.name as branch_name,
            salesman.name as salesman_name

            FROM purchase_order as po
            LEFT JOIN m_branch as branch on branch.id = po.branch_id
            LEFT JOIN m_salesman as salesman on salesman.id = po.salesman_id

            WHERE po.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("purchase_order", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("purchase_order", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        return $this->update($where, array("flag" => 99));
    }
}
