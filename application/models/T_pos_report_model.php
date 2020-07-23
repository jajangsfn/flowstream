<?php

/**
 * 
 */
class T_pos_report_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function pos_report($where=null, $group=null)
	{
 
		return $this->db->query("SELECT ROUND(
								SUM(
									(tab3.quantity * (tab3.total / tab3.quantity)) - ((tab3.total * tab3.discount)/100)
									)
								)
								total,
								(tab3.total / tab3.quantity) price,
								tab1.*,tab4.id goods_id,tab4.barcode,tab4.plu_code,tab4.sku_code, 
								tab4.brand_name,tab4.brand_description,tab3.quantity,tab3.discount,tab3.tax ,
								count(DISTINCT tab1.id) total_trans
						FROM `t_pos` tab1 
						JOIN m_partner tab2 ON tab2.id=tab1.partner_id
						JOIN t_pos_detail tab3 ON tab3.pos_id=tab1.id
						LEFT JOIN m_goods tab4 ON tab4.id=tab3.goods_id ".(($where) ? "WHERE ".$where  : ""). (($group) ? " GROUP BY ".$group : ""). 
						" ORDER BY tab1.invoice_no desc,tab1.updated_date desc");


	}
}
?>