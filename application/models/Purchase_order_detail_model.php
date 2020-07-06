<?php

class Purchase_order_detail_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("t_purchase_order_detail", $where);
    } 

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            po_det.*,
            goods.name as goods_name,
            po.purchase_order_no as po_no

            FROM t_purchase_order_detail as po_det
            LEFT JOIN t_purchase_order as po on po.id = po_det.purchase_order_id
            LEFT JOIN m_goods as goods on goods.id = po_det.goods_id

            WHERE po_det.flag <> 99
            "
        );
    }

    function insert($po_id,$data)
    {
        if ($data) {
           for ($i=0; $i < count($data['goods_id_chart']) ; $i++) { 
               
               $param['purchase_order_id']  = $po_id;
               $param['goods_id']           = $data['goods_id_chart'][$i];
               $param['quantity']           = $data['goods_qty_chart'][$i];
               $param['price']              = $data['goods_price_chart'][$i];
               $param['discount']           = $data['goods_discount_chart'][$i];
               $param['flag']               = 1;

               $this->db->insert("t_purchase_order_detail", $param);

           }
        }
        $where['purchase_order_id'] = $po_id;
        return $this->get($where);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_purchase_order_detail", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        // return $this->update($where, array("flag" => 99));

        $this->db->where($where);
        $this->db->set("flag",99);
        return $this->db->update("t_purchase_order_detail");
    }
}
