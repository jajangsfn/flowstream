<?php

class T_pos_model extends CI_Model
{
    function get_next_invoice_no($where)
    {
        $this->db->select("invoice_no");
        $this->db->from("t_pos");

        // 6 digit id branch
        $nomor_nota = sprintf("%06d", $where['branch_id']);

        // 2 digit transaction code
        $nomor_nota .= "13";

        // 4 digit year
        $nomor_nota .= date("Y");

        // 2 digit month
        $nomor_nota .= date("m");

        // 6 digit transaction incremental

        $where['invoice_no like'] = "$nomor_nota%";
        $this->db->where($where);
        $this->db->order_by("invoice_no desc");
        $this->db->limit(1);

        $q_result = $this->db->get();
        if ($q_result->num_rows()) {
            $curr_invoice_No = $q_result->row()->invoice_no;
            $curr_invoice_No = intval($curr_invoice_No);
            $curr_invoice_No++;

            $curr_invoice_No = sprintf('%020d', $curr_invoice_No);
        } else {
            $curr_invoice_No = $nomor_nota . "000001";
        }
        return $curr_invoice_No;
    }

    function insert($data)
    {
        $this->db->insert("t_pos", $data);
    }

    function insert_detail($data)
    {
        $this->db->insert("t_pos_detail", $data);
    }

    function delete($where)
    {
        $this->db->update("t_pos", array("flag" => 99), $where);
    }

    function delete_detail($where)
    {
        $this->db->delete("t_pos_detail", $where);
    }

    function update($where, $data)
    {
        $this->db->update("t_pos", $data, $where);
    }

    function get_all()
    {
        $this->db->select("
        m_branch.name as branch_name,
        pos.*
        ");

        $this->db->from("t_pos pos");
        $this->db->join("m_branch", "m_branch.id = pos.branch_id", "left");
        $this->db->order_by("pos.id desc");
        $this->db->where("pos.flag <> 99");
        return $this->db->get();
    }

    function get_next_no($where)
    {
        $this->db->select("order_no");
        $this->db->from("t_pos");

        // 6 digit id branch
        $nomor_nota = sprintf("%06d", $where['branch_id']);

        // 2 digit transaction code
        $nomor_nota .= "12";

        // 4 digit year
        $nomor_nota .= date("Y");

        // 2 digit month
        $nomor_nota .= date("m");

        // 6 digit transaction incremental

        $where['order_no like'] = "$nomor_nota%";
        $this->db->where($where);
        $this->db->order_by("order_no desc");
        $this->db->limit(1);

        $q_result = $this->db->get();
        if ($q_result->num_rows()) {
            $current_order_no = $q_result->row()->order_no;
            $current_order_no = intval($current_order_no);
            $current_order_no++;

            $current_order_no = sprintf('%020d', $current_order_no);
        } else {
            $current_order_no = $nomor_nota . "000001";
        }
        return $current_order_no;
    }


    function cut_qty($id)
    {

        $this->db->trans_begin();
      
      // get detail return
        $retur_detail = $this->db->query("SELECT tab1.id retur_id,tab1.reference_no,tab2.* 
                                          FROM t_po_return tab1  
                                          JOIN t_po_return_detail tab2 ON tab2.po_return_id=tab1.id 
                                          and tab2.flag<>99 WHERE tab1.id =".$id)->result();
        
        // loop data retur
        foreach ($retur_detail as $key => $val) {
            
            // ambil data pos
            $po_detail  = $this->db->query("SELECT tab1.order_no,tab1.reference_no,tab2.* 
                                                    FROM t_pos tab1 
                                                    JOIN t_pos_detail tab2 ON tab2.pos_id=tab1.id
                                                    WHERE tab1.flag = 2 and 
                                                          tab1.warehouse_id = ".$val->warehouse_id." and
                                                          tab1.invoice_no='".$val->reference_no."' 
                                                          and tab2.goods_id=".$val->goods_id)->row();
            // echo json_encode($warehouse_detail);exit; 
            // update pos detail
            $this->db->set("quantity","quantity+".$val->quantity,FALSE);
            $this->db->where("id",$po_detail->id);
            $this->db->update("t_pos_detail");

            // ambil data order request
            $order_detail = $this->db->query("SELECT tab2.* FROM t_order_request tab1 
                                                  JOIN t_order_request_detail tab2 ON tab2.order_request_id=tab1.id  and tab2.flag<>99
                                                  WHERE tab1.flag =2 and  
                                                        tab1.order_no='".$po_detail->order_no."' 
                                                        and tab2.goods_id=".$val->goods_id)->row();
            // update data receiving
            $this->db->set("quantity","quantity+".$val->quantity,FALSE);
            $this->db->where("id",$order_detail->id);
            $this->db->update("t_order_request_detail");

            // ambil data m goods
            $goods = $this->db->query("SELECT * FROM m_goods WHERE id=".$val->goods_id)->row();
            $this->db->set("quantity","quantity+".$val->quantity,FALSE);
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
}
