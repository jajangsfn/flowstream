<?php

class T_delivery_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_delivery($where = null) {

        $this->db->select("pack.*,order.id order_id,order.delivery_no,
                            order.delivery_date,order.car_number,order.description order_desc,
                            partner.name,partner.address_1 address_partner,
                            team.id delivery_team_id,team.employee_id,
                            employee.name employee_name,
                            team.job_description,
                            good.plu_code, 
                            detail.id detail_id,detail.goods_id,good.sku_code, good.barcode,
                            good.brand_description,
                            detail.qty");
        $this->db->from("t_delivery_package pack");
        $this->db->join("t_delivery_order order", "order.id=pack.delivery_order_id");
        $this->db->join("t_delivery_order_detail detail","detail.delivery_order_id=order.id");
        $this->db->join("t_delivery_team team","team.delivery_order_id=order.id");
        $this->db->join("t_pos pos","pos.invoice_no=pack.invoice_no");
        $this->db->join("m_goods good","good.id=detail.goods_id","left");
        $this->db->join("m_partner partner","partner.id=pos.partner_id","left");
        $this->db->join("m_employee employee","employee.id=team.employee_id","left");

        if(is_null($where)) {
            $this->db->group_by("order.delivery_no");
        }else {
            $this->db->where($where);
            $this->db->group_by("order.delivery_no,detail.id,team.id,pack.id");
        }

        $this->db->order_by("order.delivery_no","desc");


        
        return $this->db->get();

    }


    public function get_employee() {
        $branch_id = ($this->session->userdata('branch_id')!="") ? $this->session->userdata('branch_id') : 1;

        return $this->db->get_where("m_employee", array("branch_Id" => $branch_id, "level_id" => 7));

    }

    public function get_delivery_no() {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('delivery_no');
        $this->db->where("branch_id", $branch_id);
        return $this->db->get("t_delivery_order");
    }
    

    public function get_po_no($po_no = null, $all = null) {
        
        return $this->db->query("SELECT partner.name,partner.address_1 address,employee.name employee_name,pos.*,deliv.*,goods.sku_code,goods.plu_code,goods.brand_description,(pos.qty_pos - COALESCE(deliv.qty_deliv,0)) sisa 
                                FROM 
                                ( 
                                    SELECT pos.id,pos.partner_id,pos.invoice_no, pos_detail.goods_id goods_id_pos, 
                                    sum(pos_detail.quantity) qty_pos 
                                    FROM t_pos pos 
                                    JOIN t_pos_detail pos_detail ON pos_detail.pos_id=pos.id 
                                        ".(isset($po_no) ? " WHERE pos.invoice_no='$po_no' " : "")."
                                        GROUP BY pos.invoice_no ".(isset($po_no) ? ",pos_detail.goods_id" : "")."
                                ) pos 
                                LEFT JOIN 
                                (
                                    SELECT pack.invoice_no invoice_no_deliv,delivorderdetail.goods_id goods_id_deliv,
                                           sum(delivorderdetail.qty) qty_deliv, team.employee_id
                                    FROM t_delivery_package pack 
                                    JOIN t_delivery_order delivorder ON delivorder.id= pack.delivery_order_id
                                    JOIN t_delivery_order_detail delivorderdetail ON delivorderdetail.delivery_order_id=delivorder.id
                                    JOIN t_delivery_team team ON team.delivery_order_id=delivorder.id
                                    ".(isset($po_no) ? " WHERE pack.invoice_no='$po_no'" : "")." 
                                    GROUP BY pack.invoice_no ".(isset($po_no) ? ",delivorderdetail.goods_id" : "")."
                                ) deliv ON deliv.invoice_no_deliv=pos.invoice_no
                                ".(isset($po_no) ? "AND deliv.goods_id_deliv=pos.goods_id_pos" : "")."
                                LEFT JOIN m_goods goods ON goods.id=pos.goods_id_pos
                                LEFT JOIN m_partner partner ON partner.id=pos.partner_id
                                LEFT JOIN m_employee employee ON employee.id=deliv.employee_id
                                GROUP BY pos.invoice_no ".(isset($po_no) ? ", pos.goods_id_pos" : "")."
                                ".(isset($all) ? "" : "HAVING sisa > 0"));
    }


    public function insert_delivery($table, $data, $return_id = false) {

        $this->db->insert($table, $data);

        if ($return_id) {
            return $this->db->insert_id();
        }
    }

    public function update_delivery($table, $data, $where) {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update($table);
    }


    public function delete_delivery($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

?>