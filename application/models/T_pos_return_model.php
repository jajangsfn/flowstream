<?php


/**
 * 
 */
class T_pos_return_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($where) 
    {
        return $this->db->get_where("t_pos_return", $where);
    }


    function get_return_no()
    {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('return_no');
        $this->db->where("branch_id",$branch_id);
        return $this->db->get("t_pos_return");
    } 

    function insert($data, $param)
    {
        // insert header
        $this->db->insert("t_pos_return", $data);
        $header = $this->get($data);

        // insert detail
        $this->insert_detail($header,$param);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_pos_return", $data);
        $return_header =  $this->get($where);
        return $this->cut_qty($where['id']);
    
    }

    function delete($where)
    {   
        $this->db->where("id",$where);
        $this->db->delete("t_pos_return");
        $this->delete_detail($where);
    }

    function delete_detail($return_id)
    {
        $where['purchase_return_id'] = $return_id;
        $this->db->delete("t_pos_return_detail",$where);
    }


    function insert_detail($header, $param)
    {
        $return_id = $header->row()->id;
 
        for ($i=0; $i < count($param['goods_id_chart']) ; $i++) { 
            
            $arr_detail = array(
                            "purchase_return_id" => $return_id,
                            "goods_id" => $param['goods_id_chart'][$i],
                            "warehouse_id" => $param['goods_ws_id_chart'][$i],
                            "quantity" => $param['goods_qty_chart'][$i],
                            "flag" => 1
                        );
            $this->db->insert("t_pos_return_detail", $arr_detail);
        }
    }

    function get_all($where = null, $group = null)
    {

        return $this->db->query("SELECT tab1.*,tab2.goods_id,
                                tab8.brand_description goods_name,tab8.sku_code,tab8.plu_code,
                                tab2.warehouse_id,tab7.`name` warehouse_name,tab1.partner_id,tab9.name customer,
                                tab2.quantity,tab6.price,
                                (tab2.quantity * tab6.price) total
                                FROM t_pos_return tab1
                                JOIN t_pos_return_detail tab2 ON tab2.purchase_return_id=tab1.id
                                LEFT JOIN t_pos tab3 ON tab3.invoice_no=tab1.reference_no
                                LEFT JOIN t_pos_detail tab4 ON tab4.pos_id=tab3.id
                                LEFT JOIN t_order_request tab5 ON tab5.order_no=tab3.order_no
                                LEFT JOIN t_order_request_detail tab6 ON tab6.order_request_id=tab5.id
                                LEFT JOIN m_warehouse tab7 ON tab7.id=tab2.warehouse_id
                                LEFT JOIN m_goods tab8 ON tab8.id=tab2.goods_id
                                LEFT JOIN m_partner tab9 ON tab9.id=tab1.partner_id
                                ".(($where) ? "WHERE ".$where: "")."
                                GROUP BY tab1.id ".(($group) ? ",".$group: "")."
                                ORDER BY tab1.updated_date desc")->result();  
    }



	function cut_qty($return_id)
    {
      
      // get detail return
        $retur_detail = $this->db->query("SELECT tab1.id retur_id,tab1.reference_no,tab2.* 
                                          FROM t_pos_return tab1  
                                          JOIN t_pos_return_detail tab2 ON tab2.purchase_return_id=tab1.id 
                                          and tab2.flag<>99 WHERE tab1.id =".$return_id)->result();
        // echo json_encode($retur_detail);exit;
        // loop data retur
        foreach ($retur_detail as $key => $val) {
            
            // ambil data pos
            $pos_detail  = $this->db->query("SELECT tab1.order_no,tab2.* 
                                                    FROM t_pos tab1 
                                                    JOIN t_pos_detail tab2 ON tab2.pos_id=tab1.id
                                                    WHERE tab1.flag = 2 and 
                                                          tab2.warehouse_id = ".$val->warehouse_id." and
                                                          tab1.invoice_no='".$val->reference_no."' 
                                                          and tab2.goods_id=".$val->goods_id)->row();
            // echo json_encode($pos_detail);exit;

            // update pos detail
            if ($pos_detail) {
                $this->db->set("quantity","quantity-".$val->quantity,FALSE);
                $this->db->where("id",$pos_detail->id);
                $this->db->update("t_pos_detail");   
            }
            

            // ambil data order request
            $order_detail = $this->db->query("SELECT tab2.* FROM t_order_request tab1 
                                                  JOIN t_order_request_detail tab2 ON tab2.order_request_id=tab1.id  
                                                  and tab2.flag<>99
                                                  WHERE tab1.flag =2 and  
                                                        tab1.order_no='".$pos_detail->order_no."' 
                                                        and tab2.goods_id=".$val->goods_id)->row();
            // echo json_encode($order_detail);exit;
            // update data order request
            if ($order_detail) {
                $this->db->set("quantity","quantity-".$val->quantity,FALSE);
                $this->db->where("id",$order_detail->id);
                $this->db->update("t_order_request_detail");
            }

            // ambil data m goods
            $goods = $this->db->query("SELECT * FROM m_goods WHERE id=".$val->goods_id)->row();
            // echo json_encode($goods);exit;
            if ($goods)
            {
                $this->db->set("quantity","quantity+".$val->quantity,FALSE);
                $this->db->where("id",$val->goods_id);
                $this->db->update("m_goods");
            }
           
            
        }

    }

    function get_all_pos($where=null, $group_by=null)
    {

        return $this->db->query("SELECT tab1.id, tab1.invoice_no,tab1.partner_id,tab2.goods_id,
                                tab5.brand_description goods_name,
                                tab2.quantity,tab2.discount,tab4.price,tab2.warehouse_id,tab6.`name` warehouse_name,tab5.sku_code,tab5.plu_code 
                                FROM t_pos tab1 
                                JOIN t_pos_detail tab2 ON tab2.pos_id=tab1.id
                                LEFT JOIN t_order_request tab3 ON tab3.order_no=tab1.order_no
                                LEFT JOIN t_order_request_detail tab4 ON tab4.order_request_id=tab3.id
                                LEFT JOIN m_goods tab5 ON tab5.id=tab2.goods_id
                                LEFT JOIN m_warehouse tab6 ON tab6.id=tab2.warehouse_id

                                WHERE ".$where.(($group_by) ? " GROUP BY ".$group_by: ""));
                                 
        

    }
}
?>