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


      /**
    * function price_method
    * price_method = 1 harga faktur terakhir
    * price_method = 2 harga rata2.
    *@author Jajang
    */ 
    function price_method($param)
    {
        $hpp = 0;
        if ($param) {
           

                // get m goods qty and price
                $goods = $this->db->get_where("m_goods", array("id" => $param['goods_id']))->row();
                $new_qty = $goods->quantity + $param['quantity'];
                // jika metode harga yg dipilih adalah faktur terakhir
                if ($param['price_method'] == 31) {
                    $new_hpp = $goods->hpp;
                }else {
                    // calculate m goods qty * price
                    $sum_m_goods = ( $goods->quantity * $goods->hpp );
                    // calculate qty * price receiving
                    $sum_r_detail= ( $param['quantity'] * $param['price'] ) - ( ($param['quantity'] * $param['price']) * $param['discount'] / 100);
                    //  sum (summary m_goods + summary receiving detail) / (qty m goods + qty receiving detail)
                    $new_hpp     =  floor( ($sum_m_goods + $sum_r_detail) / ($new_qty) );
                }

                $hpp = $new_hpp;
               
        }

        return $hpp;


    }
}
?>