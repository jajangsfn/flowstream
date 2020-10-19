<?php

/**
 * 
 */
class Receiving_model extends CI_Model
{
	
	function __construct()
	{
        parent::__construct();
        $this->load->model(
                            array(
                                'T_jurnal_model' => 'jurnal',
                                'Keuangan_model' => 'keumod',
                            )
                        );
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
                            SELECT tab1.*,tab2.goods_id,tab3.barcode,tab3.brand_description goods_name,tab3.sku_code,tab3.plu_code, sum(tab2.quantity) receive_qty,
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
        $this->update_qty_goods($where_goods);
        // create jurnal & jurnal_detail
        $this->create_jurnal($where);

        return 1;
    }

    
    function update_qty_goods($where)
    {   
        $where_rd           = "receiving_id=".$where['receiving_id']." and flag<>99";
        $data = $this->db->get_where("t_receiving_detail",$where_rd)->result();
        
        if ($data) {
            foreach ($data as $key => $val) {

                // get m goods qty and price
                $goods = $this->db->get_where("m_goods", array("id" => $val->goods_id))->row();
                // calculate m goods qty * price
                $sum_m_goods = ( $goods->quantity * $goods->hpp );
                // calculate qty * price receiving
                $sum_r_detail= ( $val->quantity * $val->price );
                //  sum (summary m_goods + summary receiving detail) / (qty m goods + qty receiving detail)
                $new_hpp     =  floor( ($sum_m_goods + $sum_r_detail) / ($goods->quantity + $val->quantity) );
                // update hpp & qty m goods
                $new_qty     = $goods->quantity + $val->quantity;
                $arr_hpp     = array( "quantity" => $new_qty,"hpp" => $new_hpp);
                // $this->db->set($arr_hpp,FALSE);
                $this->db->where("id", $val->goods_id );
                $this->db->update("m_goods",$arr_hpp);

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
        return $this->db->query("SELECT tab1.*,tab4.id partner_id,tab6.goods_id,tab6.goods_name,tab6.barcode,tab6.plu_code,tab6.sku_code,
                                tab6.goods_price,tab6.plu_code,tab6.goods_discount,(tab6.order_qty - ifnull(tab7.receive_qty,0) )sisa   
                                FROM t_purchase_order tab1 
                                JOIN t_purchase_order_detail tab2 ON tab2.purchase_order_id=tab1.id
                                JOIN `m_partner_salesman` `tab3` ON `tab3`.`id`=`tab1`.`salesman_id` 
                                JOIN `m_partner` `tab4` ON `tab4`.`id`=`tab3`.`partner_id` 
                                LEFT JOIN
                                     (SELECT tab2.purchase_order_id,tab2.goods_id,tab3.brand_description goods_name,tab3.sku_code,tab3.plu_code,tab3.barcode,sum(tab2.quantity) order_qty ,tab2.price goods_price,tab2.discount  goods_discount
                                      FROM t_purchase_order tab1 
                                      JOIN t_purchase_order_detail tab2 ON tab2.purchase_order_id=tab1.id 
                                      LEFT JOIN m_goods tab3 ON tab3.id=tab2.goods_id
                                      WHERE tab1.flag = 2 and tab2.flag<>99
                                      GROUP BY tab1.id,tab2.goods_id)tab6 on tab6.purchase_order_id=tab1.id
                                LEFT JOIN 
                                        (SELECT tab1.purchase_order_id,tab2.goods_id,sum(tab2.quantity) receive_qty 
                                        FROM t_receiving tab1 
                                        LEFT JOIN t_receiving_detail tab2 ON tab2.receiving_id=tab1.id 
                                        LEFT JOIN m_goods tab3 ON tab3.id=tab2.goods_id
                                        WHERE tab1.flag=2 and tab2.flag<>99
                                        GROUP BY tab1.purchase_order_id,tab2.goods_id)tab7 on tab7.purchase_order_id = tab6.purchase_order_id and tab7.goods_id=tab6.goods_id
                                WHERE ".$where."
                                GROUP BY  ".(($group_by)? $group_by: " tab1.id")."
                                HAVING sisa >0 ");


    }

    public function get_price_method()
    {
        return $this->db->query("SELECT * FROM s_reference WHERE group_data ='PRICE_METHOD'");
    }

    public function create_jurnal($where) {

        //get header
        $this->db->select("*");
        $this->db->where("id", $where['id']);
        $header = $this->db->get("t_receiving")->result();

        //get detail
        $this->db->select("*");
        $this->db->where("receiving_id", $where['id']);
        $detail = $this->db->get("t_receiving_detail")->result();
        
        $dpp_dipungut = 0;
        //counting dpp dipungut from detail
        foreach($detail as $key => $row) {
            $dpp_dipungut+= ($row->price * $row->quantity) - (( ($row->price * $row->quantity) * $row->discount) /100);
        }
        
        
        //data
        $branch_id    = $this->session->branch_id;
        $journal_no   = $this->jurnal->get_next_jurnal_no($branch_id);
        $journal_date = date('Y-m-d');
        $invoice_no   = $header[0]->receiving_no;
        $username     = $this->session->username;

        //header
        $temp_jurnal  = array("jurnal_no" => $journal_no,
                             "branch_id" => $branch_id,
                             "jurnal_date" => $journal_date,
                             "invoice_no" => $invoice_no,
                             "username" => $username,
                             "dpp_dipungut" => $dpp_dipungut,
                             "dpp_ditanggung" => $dpp_dipungut,
                             "created_date" => date('Y-m-d H:i:s'),
                             "updated_date" => date('Y-m-d H:i:s'),
                        );
        
        // insert into t_journal
        $this->db->insert("t_jurnal", $temp_jurnal);

        //get data journal mapping
        $this->db->where("JOURNAL_CD", "PO");
        $this->db->order_by("SEQ_LINE");
        $journal_ref = $this->db->get("m_journal_mapping")->result();

        foreach($journal_ref as $key => $row) {

            if ($row->SEQ_LINE == 1) {
                $debit = 0;
                $credit= $dpp_dipungut;
            }else {
                $debit = $dpp_dipungut;
                $credit= 0;
            }
            //get master id          
            $master_id = $this->db->query("SELECT salesman.partner_id 
                                           FROM t_purchase_order po 
                                           JOIN m_partner_salesman salesman on salesman.id=po.salesman_id
                                           WHERE po.id=".$header[0]->purchase_order_id)->row()->partner_id;

            $temp_jurnal_detail = array("jurnal_no" => $journal_no,
                                        "invoice_no" => $invoice_no,
                                        "acc_code" => $row->ACCOUNT_CODE,
                                        "invoice_no" => $invoice_no,
                                        "debit" => $debit,
                                        "credit" => $credit,
                                        "master_id" => $master_id);
            
            //insert into jurnal detail
            $this->db->insert("t_jurnal_detail", $temp_jurnal_detail);

            // 2. entry tagihan hutang
            $this->keumod->entry_tagihan_hutang_baru($invoice_no, $dpp_dipungut);
        }     

    }

}
?>