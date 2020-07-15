<?php

/**
 * 
 */
class Receiving_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($where) 
    {
        return $this->db->get_where("t_receiving", $where);
    }

	function get_receive_no()
    {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('receiving_no');
        $this->db->where("branch_id",$branch_id);
        return $this->db->get("t_receiving");
    }

    function insert($data)
    {
        $this->db->insert("t_receiving", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_receiving", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        return $this->update($where, array("flag" => 99));
    }

    function get_all_receive($where=null, $supplier_id=null, $group_by=null)
    {

        return $this->db->query("SELECT tab1.*,tab4.name supplier_name,tab4.name partner_name,tab4.id partner_id FROM 
                            (
                            SELECT tab1.*,tab2.goods_id,tab3.brand_description goods_name,tab3.sku_code,tab3.plu_code, sum(tab2.quantity) receive_qty,
                            floor (sum( (tab2.quantity * tab2.price) - ( (tab2.quantity * tab2.price * tab2.discount)/100) ))sum_trx ,tab1.flag flag_receive,tab1.id receiving_id,
                            tab2.price,tab2.quantity,tab2.discount
                            FROM t_receiving tab1 
                            JOIN t_receiving_detail tab2 on tab2.receiving_id=tab1.id
                            JOIN `m_goods` `tab3` ON `tab3`.`id`=`tab2`.`goods_id` 
                            WHERE tab2.flag<>99
                            ".(($where) ? " and ".$where : "")."
                            GROUP BY tab1.id ".(($group_by) ? ",".$group_by: "").") tab1 

                            JOIN `t_purchase_order` `tab2` ON `tab2`.`id`=`tab1`.`purchase_order_id` 
                            JOIN `m_partner_salesman` `tab3` ON `tab3`.`id`=`tab2`.`salesman_id` 
                            JOIN `m_partner` `tab4` ON `tab4`.`id`=`tab3`.`partner_id` 
                            LEFT JOIN `m_warehouse` `tab5` ON `tab5`.`id`=`tab1`.`warehouse_id` 
                            ".(($supplier_id) ? "WHERE ".$supplier_id : "")." 
                            ORDER BY tab1.id desc");
 
        

    }

    function approve_receive($where)
    {
        // set param
        $data['flag'] = 2;
        // update receiving
        $this->db->where($where);
        $this->db->update("t_receiving",$data);
        
        // set flag receiving_detail
        $where_receiving['receiving_id']      = $where['id'];
        $where_receiving['flag']              = 1;
        $this->db->where($where_receiving);
        $this->db->update("t_receiving_detail",$data);

        // get reference no
        $where_goods['ref_no']       = $this->get(array("id"=>$where['id']))->result()[0]->reference_no;
        // update qty all goods
        $where_goods['receiving_id'] = $where['id'];
        return $this->update_qty_goods($where_goods);
    }

    function update_qty_goods($where)
    {   
        $where_rd           = "receiving_id=".$where['receiving_id']." and flag<>99";
        $data = $this->db->get_where("t_receiving_detail",$where_rd)->result();
        // echo json_encode($data);exit;
        if ($data) {
            foreach ($data as $key => $val) {
                // update quantity
                $this->db->set("quantity","quantity+".$val->quantity,FALSE);
                $this->db->where("id", $val->goods_id );
                $this->db->update("m_goods");

                //insert price history
                $param['branch_id']         = $this->session->userdata('branch_id');
                $param['reference_no']      = $where['ref_no'];
                $param['goods_id']          = $val->goods_id;
                $param['discount']          = $val->discount;
                $param['price']             = $val->price;
                $param['transaction_flag']  = 1;
                $param['flag']              = 1;
                $param['created_date']      = date('Y-m-d H:i:s');
                $param['created_by']        = $this->session->userdata('id');

                $this->db->insert("m_price_history",$param);
            }
        }

    } 


    function get_goods_receive($where,$group_by = null)
    {
        return $this->db->query("SELECT tab1.*,tab4.id partner_id,tab6.goods_id,tab6.goods_name,tab6.sku_code,
                                tab6.goods_price,tab6.plu_code,tab6.goods_discount,(tab6.order_qty - ifnull(tab7.receive_qty,0) )sisa   
                                FROM t_purchase_order tab1 
                                JOIN t_purchase_order_detail tab2 ON tab2.purchase_order_id=tab1.id
                                JOIN `m_partner_salesman` `tab3` ON `tab3`.`id`=`tab1`.`salesman_id` 
                                JOIN `m_partner` `tab4` ON `tab4`.`id`=`tab3`.`partner_id` 
                                LEFT JOIN
                                     (SELECT tab2.purchase_order_id,tab2.goods_id,tab3.brand_description goods_name,tab3.sku_code,tab3.plu_code,sum(tab2.quantity) order_qty ,tab2.price goods_price,tab2.discount  goods_discount
                                      FROM t_purchase_order tab1 
                                      JOIN t_purchase_order_detail tab2 ON tab2.purchase_order_id=tab1.id 
                                      LEFT JOIN m_goods tab3 ON tab3.id=tab2.goods_id
                                      WHERE tab1.flag = 2 and tab2.flag<>99
                                      GROUP BY tab1.id,tab2.goods_id)tab6 on tab6.purchase_order_id=tab1.id
                                LEFT JOIN 
                                        (SELECT tab1.purchase_order_id,tab2.goods_id,sum(tab2.quantity) receive_qty 
                                        FROM t_receiving tab1 
                                        JOIN t_receiving_detail tab2 ON tab2.receiving_id=tab1.id 
                                        LEFT JOIN m_goods tab3 ON tab3.id=tab2.goods_id
                                        WHERE tab1.flag=2 and tab2.flag<>99
                                        GROUP BY tab1.purchase_order_id,tab2.goods_id)tab7 on tab7.purchase_order_id = tab6.purchase_order_id and tab7.goods_id=tab6.goods_id
                                WHERE ".$where."
                                GROUP BY tab1.id ".(($group_by)?",".$group_by: "")."
                                HAVING sisa >0 ");


    }
}
?>