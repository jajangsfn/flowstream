<?php

/**
 * 
 */
class Receiving_detail_model extends CI_Model
{
	
	function __construct()
	{
		
	}

	function get($where)
    {
        return $this->db->get_where("t_receiving_detail", $where);
    }


     function insert($rv_id,$data)
    {
        if ($data) {
           for ($i=0; $i < count($data['goods_id']) ; $i++) { 
               
               $param['receiving_id']       = $rv_id;
               $param['goods_id']           = $data['goods_id'][$i];
               $param['quantity']           = $data['goods_qty'][$i];
               $param['price']              = $data['goods_price'][$i];
               $param['discount']           = $data['goods_discount'][$i];
               $param['flag']               = 1;

               $this->db->insert("t_receiving_detail", $param);

           }
        }
        $where['receiving_id'] = $rv_id;
        return $this->get($where);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_receiving_detail", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        // return $this->update($where, array("flag" => 99));

        $this->db->where($where);
        $this->db->set("flag",99);
        return $this->db->update("t_receiving_detail");
    }
}
?>