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


}