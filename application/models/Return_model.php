<?php

/**
 * 
 */
class Return_model extends CI_Model
{
	 
	function __construct()
	{
		parent::__construct();
	}

	function get($where) 
    {
        return $this->db->get_where("t_purchase_return", $where);
    }


    function get_return_no()
    {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('return_no');
        $this->db->where("branch_id",$branch_id);
        return $this->db->get("t_purchase_return");
    } 

    function insert($data, $param)
    {
        // insert header
        $this->db->insert("t_purchase_return", $data);
        $header = $this->get($data);

        // insert detail
        $this->insert_detail($header,$param);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_purchase_return", $data);
        // $return_header =  $this->get($where);
        return $this->cut_qty($where['id']);
    
    }


    function cut_qty($id)
    {

        $this->db->trans_begin();
      
      // get detail return
        $retur_detail = $this->db->query("SELECT tab1.id retur_id,tab1.reference_no,tab2.* 
                                          FROM t_purchase_return tab1  
                                          JOIN t_purchase_return_detail tab2 ON tab2.purchase_return_id=tab1.id 
                                          and tab2.flag<>99 WHERE tab1.id =".$id)->result();
        
        // loop data retur
        foreach ($retur_detail as $key => $val) {
            
            // ambil data warehouse
            $warehouse_detail  = $this->db->query("SELECT tab1.reference_no,tab2.* 
                                                    FROM t_physical_warehouse tab1 
                                                    JOIN t_physical_warehouse_detail tab2 ON tab2.physical_warehouse_id=tab1.id
                                                    WHERE tab1.flag = 2 and 
                                                          tab1.actual_warehouse = ".$val->warehouse_id." and
                                                          tab1.reference_no='".$val->reference_no."' 
                                                          and tab2.goods_id=".$val->goods_id)->row();
            // update warehouse detail

            if ($warehouse_detail) {
                $this->db->set("quantity","quantity-".$val->quantity,FALSE);
                $this->db->where("id",$warehouse_detail->id);
                $this->db->update("t_physical_warehouse_detail");
            }

            // ambil data receiving
            $receiving_detail = $this->db->query("SELECT tab2.* FROM t_receiving tab1 
                                                  JOIN t_receiving_detail tab2 ON tab2.receiving_id=tab1.id  and tab2.flag<>99
                                                  WHERE tab1.flag =2 and  
                                                        tab1.reference_no='".$val->reference_no."' 
                                                        and tab2.goods_id=".$val->goods_id)->row();
            // update data receiving
            if ($receiving_detail) {
                $this->db->set("quantity","quantity-".$val->quantity,FALSE);
                $this->db->where("id",$receiving_detail->id);
                $this->db->update("t_receiving_detail");
            }

            // ambil data m goods
            $goods = $this->db->query("SELECT * FROM m_goods WHERE id=".$val->goods_id)->row();
            $this->db->set("quantity","quantity-".$val->quantity,FALSE);
            $this->db->where("id",$val->goods_id);
            $this->db->update("m_goods");
            
        }

        if ($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            return null;
        }else {
            $this->db->trans_commit();
            return 1;
        }

    }

    function delete($where)
    {   
        $this->db->where("id",$where);
        $this->db->delete("t_purchase_return");
        $this->delete_detail($where);
    }

    function delete_detail($return_id)
    {
        $where['purchase_return_id'] = $return_id;
        $this->db->delete("t_purchase_return_detail",$where);
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
                            "price" => $param['goods_price_chart'][$i],
                            "flag" => 1
                        );
            $this->db->insert("t_purchase_return_detail", $arr_detail);
        }
    }

    function get_all($where = null, $group = null,$type = 1)
    {
 
        $data = $this->db->query("SELECT tab1.*,tab7.`name` supplier_name,tab8.`name` warehouse_name ,tab8.id warehouse_id,
                            (tab2.quantity * tab2.price) total,tab9.barcode,
                            tab9.id goods_id, tab9.brand_description goods_name,tab9.plu_code,tab9.sku_code,tab2.price,tab2.quantity,tab7.id supplier_id,tab5.quantity qty_receive,date_format(tab1.return_date, '%Y-%m-%d') return_date_convert
                            FROM t_purchase_return tab1 
                            LEFT JOIN t_purchase_return_detail tab2 ON tab2.purchase_return_id=tab1.id 
                            LEFT JOIN t_receiving tab3 ON tab3.receiving_no=tab1.reference_no
                            LEFT JOIN `t_purchase_order` `tab4` ON `tab4`.`id`=`tab3`.`purchase_order_id` 
                            LEFT JOIN t_purchase_order_detail tab5 on tab5.purchase_order_id = tab4.id 
                            LEFT JOIN `m_partner_salesman` `tab6` ON `tab6`.`id`=`tab4`.`salesman_id` 
                            LEFT JOIN `m_partner` `tab7` ON `tab7`.`id`=`tab6`.`partner_id` 
                            LEFT JOIN `m_warehouse` `tab8` ON `tab8`.`id`=`tab2`.`warehouse_id` 
                            LEFT JOIN  m_goods tab9 ON tab9.id=tab2.goods_id
                            ".(($where) ? "WHERE ".$where : "")."
                            GROUP BY tab1.id ".(($group) ? ",".$group : "")
                            ." ORDER BY tab1.updated_date desc");

        if ( $type == 1) {
            return $data->result();
        } else {
            return $data->result_array();
        }
    }


}