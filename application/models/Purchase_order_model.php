<?php

class Purchase_order_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("t_purchase_order", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            po.*,
            branch.name as branch_name, 
            salesman.name as salesman_name

            FROM purchase_order as po
            LEFT JOIN m_branch as branch on branch.id = po.branch_id
            LEFT JOIN m_salesman as salesman on salesman.id = po.salesman_id

            WHERE po.flag <> 99 
            "
        );
    } 

    function insert($data)
    {
        $this->db->insert("t_purchase_order", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_purchase_order", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        return $this->update($where, array("flag" => 99));
    }

    function get_po_no()
    {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('purchase_order_no');
        $this->db->where("branch_id",$branch_id);
        return $this->db->get("t_purchase_order");
    }

    function get_all_trx($where=null,$group_by=null)
    {

        $this->db->select("tab4.id partner_id,tab4.name partner_name,tab1.*,
                                        
                        floor(  sum(
                                        (tab2.price* tab2.quantity) -  
                                     (
                                        (tab2.price * tab2.quantity) * (ifnull(tab2.discount, 0)/100)
                                      )
                                    )
                            ) sum_trx
                            ,tab2.goods_id,tab5.brand_description goods_name,tab2.price goods_price,sum( `tab2`.`quantity`) goods_qty,ifnull(tab2.discount,0) goods_discount,tab5.plu_code,tab5.sku_code,tab6.name branch_name,tab3.name salesman_name, tab2.id purchase_order_detail_id,
                                ( sum(tab2.quantity) - ifnull(tab7.diterima, 0) )sisa
                            ");
        $this->db->from("t_purchase_order tab1");
        $this->db->join("t_purchase_order_detail tab2","tab2.purchase_order_id=tab1.id ");
        $this->db->join("m_partner_salesman tab3","tab3.id=tab1.salesman_id");
        $this->db->join("m_partner tab4","tab4.id=tab3.partner_id");
        $this->db->join("m_goods tab5","tab5.id=tab2.goods_id");
        $this->db->join("m_branch tab6","tab6.id=tab4.branch_id");
        $this->db->join("(SELECT tab1.purchase_order_id,tab2.*,sum(quantity) diterima 
                            FROM t_receiving tab1 
                            JOIN t_receiving_detail tab2 ON tab2.receiving_id=tab1.id
                            WHERE tab1.flag=2
                            GROUP BY tab1.id,tab1.purchase_order_id,tab2.goods_id) tab7","tab7.purchase_order_id=tab1.id","left");
        $this->db->where("tab2.flag<>99");
        if ($where) {
            $this->db->where($where);
        }
        
        #$this->db->having("sisa > 0");

        if ($group_by) {
            $this->db->group_by($group_by);
        }

        $this->db->order_by("tab1.id desc,tab2.id");


        return $this->db->get();
        
    }


    function approve_po($where)
    {
        $data['flag'] = 2;
        $this->db->where($where);
        return $this->db->update("t_purchase_order",$data);
    }
}
