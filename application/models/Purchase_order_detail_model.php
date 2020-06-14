<?php

class Purchase_order_detail_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("purchase_order_detail", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            po_det.*,
            goods.name as goods_name,
            po.purchase_order_no as po_no

            FROM purchase_order_detail as po_det
            LEFT JOIN purchase_order as po on po.id = po_det.purchase_order_id
            LEFT JOIN m_goods as goods on goods.id = po_det.goods_id

            WHERE po_det.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("purchase_order_detail", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("purchase_order_detail", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        return $this->update($where, array("flag" => 99));
    }
}
