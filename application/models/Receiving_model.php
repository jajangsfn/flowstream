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

    function get_all_receive($where=null,$group_by=null)
    {
        $this->db->select("tab1.id receiving_id,tab1.receiving_no,tab1.reference_no,tab1.branch_id,tab1.flag,tab5.name supplier_name,tab1.created_date,
                            tab2.*,tab6.brand_description ,floor(sum( (tab2.quantity * tab2.price) - ((tab2.quantity * tab2.price * tab2.discount)/100)) )sum_trx,tab1.description,tab1.flag flag_receive,tab6.sku_code,tab6.plu_code,tab4.partner_id,tab5.name partner_name,tab1.purchase_order_id,tab1.warehouse_id,tab8.id purchase_order_detail_id,tab8.quantity qty_order");
        $this->db->from("t_receiving tab1");
        $this->db->join("t_receiving_detail tab2","tab2.receiving_id=tab1.id and tab2.flag<>99");
        $this->db->join("t_purchase_order tab3","tab3.id=tab1.purchase_order_id");
        $this->db->join("m_partner_salesman tab4","tab4.id=tab3.salesman_id");
        $this->db->join("m_partner tab5","tab5.id=tab4.partner_id");
        $this->db->join("m_goods tab6","tab6.id=tab2.goods_id");
        $this->db->join("m_warehouse tab7","tab7.id=tab1.warehouse_id");
        $this->db->join("t_purchase_order_detail tab8","tab8.purchase_order_id=tab3.id");

        if ( $where ) {
            $this->db->where($where);
        }

        $this->db->group_by("tab1.id");

        if ( $group_by ) {
            $this->db->group_by($group_by);
        }

        $this->db->order_by("tab1.id desc");

        return $this->db->get();

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
        $rd['receiving_id'] = $where['receiving_id'];
        $data = $this->db->get_where("t_receiving_detail",$rd)->result();
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
        return $this->db->query("
                                SELECT tab1.*,tab2.id purchase_order_detail_id,tab5.id goods_id,tab2.price goods_price,tab2.discount goods_discount,tab5.brand_description goods_name,tab5.sku_code,tab5.plu_code, sum(tab6.order_qty - ifnull(tab7.receive_qty,0) ) sisa 
                                FROM t_purchase_order tab1 
                                JOIN t_purchase_order_detail tab2 ON tab2.purchase_order_id=tab1.id
                                JOIN `m_partner_salesman` `tab3` ON `tab3`.`id`=`tab1`.`salesman_id` 
                                JOIN `m_partner` `tab4` ON `tab4`.`id`=`tab3`.`partner_id` 
                                LEFT JOIN m_goods tab5 ON tab5.id=tab2.goods_id
                                LEFT JOIN (
                                SELECT tab2.purchase_order_id,tab2.goods_id,sum(tab2.quantity) order_qty FROM t_purchase_order tab1 
                                JOIN t_purchase_order_detail tab2 ON tab2.purchase_order_id=tab1.id 
                                WHERE tab1.flag = 2 
                                GROUP BY tab1.id,tab2.goods_id
                                )tab6 ON tab6.purchase_order_id = tab1.id

                                LEFT JOIN (
                                SELECT tab1.purchase_order_id,tab2.goods_id,sum(tab2.quantity) receive_qty FROM t_receiving tab1 
                                JOIN t_receiving_detail tab2 ON tab2.receiving_id=tab1.id 
                                WHERE tab1.flag=2
                                GROUP BY tab1.purchase_order_id,tab2.goods_id
                                )tab7 ON tab7.purchase_order_id = tab6.purchase_order_id
                                
                                WHERE ".$where."
                                GROUP BY tab6.purchase_order_id".(($group_by) ? ",".$group_by: "")."
                                HAVING sisa > 0");


    }
}
?>