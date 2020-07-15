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
        return $this->get($where);
    }

    function delete($where)
    {
        return $this->update($where, array("flag" => 99));
    }


    function insert_detail($header, $param)
    {
        $return_id = $header->row()->id;

        for ($i=0; $i < count($param['goods_id_chart']) ; $i++) { 
            
            $arr_detail = array(
                            "purchase_return_id" => $return_id,
                            "goods_id" => $param['goods_id_chart'][$i],
                            "warehouse_id" => $param['warehouse_id'],
                            "quantity" => $param['goods_qty_chart'][$i],
                            "flag" => 1
                        );
            $this->db->insert("t_purchase_return_detail", $arr_detail);
        }
    }

    function get_all($where = null, $group = null)
    {

        return $this->db->query("SELECT tab1.*,tab7.`name` supplier_name,tab7.`name` warehouse_name ,
                            (tab2.quantity * tab5.price) total,
                            tab9.brand_description goods_name,tab9.sku_code,tab5.price,tab2.quantity
                            FROM t_purchase_return tab1 
                            JOIN t_purchase_return_detail tab2 ON tab2.purchase_return_id=tab1.id 
                            LEFT JOIN t_receiving tab3 ON tab3.receiving_no=tab1.reference_no
                            JOIN `t_purchase_order` `tab4` ON `tab4`.`id`=`tab3`.`purchase_order_id` 
                            JOIN t_purchase_order_detail tab5 on tab5.purchase_order_id = tab4.id 
                            JOIN `m_partner_salesman` `tab6` ON `tab6`.`id`=`tab4`.`salesman_id` 
                            JOIN `m_partner` `tab7` ON `tab7`.`id`=`tab6`.`partner_id` 
                            LEFT JOIN `m_warehouse` `tab8` ON `tab8`.`id`=`tab3`.`warehouse_id` 
                            LEFT JOIN  m_goods tab9 ON tab9.id=tab2.goods_id
                            ".(($where) ? "WHERE ".$where : "")."
                            GROUP BY tab1.id ".(($group) ? ",".$group : ""))->result();  
    }


}