<?php

/**
 * 
 */
class Warehouse_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function get($where)
	{
		return $this->db->get_where("t_physical_warehouse",$where);
	}

	function get_all($where = null, $group_by = null) {

		$this->db->select("tab1.*, sum(tab2.quantity)total_item,tab2.goods_id,tab2.quantity,tab2.aisle_no,tab2.stacking_no,tab2.description desc_detail,tab3.name previous_warehouse_name,tab4.name actual_warehouse_name,tab5.brand_description,tab5.sku_code");
		$this->db->from("t_physical_warehouse tab1");
		$this->db->join("t_physical_warehouse_detail tab2", "tab2.physical_warehouse_id=tab1.id");
		$this->db->join("m_warehouse tab3","tab3.id=tab1.previous_warehouse","LEFT");
		$this->db->join("m_warehouse tab4","tab4.id=tab1.actual_warehouse","LEFT");
		$this->db->join("m_goods tab5","tab5.id=tab2.goods_id","left");

		if ($where) {

			$this->db->where($where);
		}

        $this->db->order_by("tab1.id desc, tab2.id desc");


		if ($group_by) {

			$this->db->group_by($group_by);
		} else {
			$this->db->group_by("tab1.id,tab1.actual_warehouse");
		}

		return $this->db->get();

	}


	function get_ws_no()
    {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('physical_warehouse_no');
        $this->db->where("branch_id",$branch_id);
        return $this->db->get("t_physical_warehouse");
    }


    function insert($data) {

    	$this->db->insert("t_physical_warehouse",$data);
    	return $this->get($data);
    }

    function insert_detail($ws_id, $data) {

    	if ( $data ) {

    		for ($i=0; $i < count($data['id_barang']); $i++) { 
    			
    			$arr = array("physical_warehouse_id" => $ws_id,
    						 "goods_id" => $data['id_barang'][$i],
    						 "quantity" => $data['qty_barang'][$i],
    						 "description"  => $data['desc']);

    			$this->db->insert("t_physical_warehouse_detail", $arr);
    		}
    	}
    }

    function delete_detail($ws_id)
    {
    	$where['physical_warehouse_id'] = $ws_id;
    	$this->db->delete("t_physical_warehouse_detail",$where);
    }

    function update($id,$data)
    {
    	$this->db->where("id",$id);
    	$this->db->update("t_physical_warehouse", $data);

    	return $this->get($data);
    }
}

?>