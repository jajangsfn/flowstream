<?php

class T_order_request_model extends CI_Model
{
    function get_next_no($where)
    {
        $this->db->select("order_no");
        $this->db->from("t_order_request");

        // 6 digit id branch
        $nomor_nota = sprintf("%06d", $where['branch_id']);

        // 2 digit transaction code
        $nomor_nota .= "11";

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

    function insert($data)
    {
        $this->db->insert("t_order_request", $data);
    }

    function insert_detail($data)
    {
        $this->db->insert("t_order_request_detail", $data);
    }

    function get_specific($id)
    {
        $where["or.id"] = $id;

        $this->db->select("
        m_branch.name as branch_name,
        or.*
        ");

        $this->db->from("t_order_request or");
        $this->db->join("m_branch", "m_branch.id = or.branch_id", "left");
        $this->db->where($where);
        $this->db->order_by("or.id desc");

        $mainobj = $this->db->get()->row();

        $this->db->distinct();
        $this->db->select("
        ordet.*,
        m_goods.barcode,
        m_goods.brand_name,
        m_goods.brand_description,
        m_goods.ratio_flag,
        m_goods.sku_code,
        m_goods.plu_code,
        m_goods.quantity as last_quantity,
        m_unit.name as unit_name,
        m_unit.initial as unit_initial,
        m_unit.quantity as converted_quantity,
        checksheet.quantity checksheet_qty,
        m_goods.sku_code,
        checksheet.id checksheet_id,
        checksheet.order_placement,
        checksheet.available
        ");
        $this->db->from("t_order_request_detail ordet");
        $this->db->join("m_goods", "m_goods.id = ordet.goods_id", "left");
        $this->db->join("m_unit", "m_unit.id = m_goods.unit", "left");
        $this->db->join("t_checksheet checksheet", "checksheet.order_request_detail_id = ordet.id", "left");
        $this->db->where(array("ordet.order_request_id" => $id));
        $this->db->order_by("checksheet.order_placement asc");
        $mainobj->details = $this->db->get()->result();

        return $mainobj;
    }

    function get_all()
    {
        $this->db->select("
        m_branch.name as branch_name,
        or.*
        ");

        $this->db->from("t_order_request or");
        $this->db->join("m_branch", "m_branch.id = or.branch_id", "left");
        $this->db->order_by("or.id desc");
        $this->db->where("or.flag <> 99");
        return $this->db->get();
    }

    function get($where)
    {
        $this->db->select("
        m_branch.name as branch_name,
        m_branch.tax_status,
        or.*
        ");

        $this->db->from("t_order_request or");
        $this->db->join("m_branch", "m_branch.id = or.branch_id", "left");
        $this->db->order_by("or.id desc");

        if (!array_key_exists("id", $where)) {
            $where['or.flag <>'] = 99;
        }

        $this->db->where($where);
        return $this->db->get();
    }

    function get_non_pos($where = '')
    {
        $query =
            "SELECT id 
            FROM t_order_request 
            WHERE flag = 2 ";
        if ($where) {
            $query .= " AND $where";
        }
        return $this->db->query($query);
    }

    function get_this_month($where = '')
    {
        $this->db->select("id");
        $this->db->from("t_order_request");

        if ($where) {
            $where['created_date < '] = date("Y-m-d", strtotime('first day of next month'));
            $where['created_date >= '] = date("Y-m-d", strtotime('first day of this month'));
        } else {
            $where = array(
                "created_date < " => date("Y-m-d", strtotime('first day of next month')),
                "created_date >= " => date("Y-m-d", strtotime('first day of this month'))
            );
        }

        $this->db->where($where);
        return $this->db->get();
    }

    function delete($where)
    {
        $this->db->update("t_order_request", array("flag" => 99), $where);
    }

    function delete_detail($where)
    {
        $this->db->delete("t_order_request_detail", $where);
    }

    function update($where, $data)
    {
        $this->db->update("t_order_request", $data, $where);
    }

    function checksheet_update($or_id, $goods_id, $final_quantity, $order_placement, $available)
    {
        $where = array(
            "order_request_id" => $or_id,
            "goods_id" => $goods_id
        );
        $old = $this->db->get_where("t_order_request_detail", $where)->row();

        // UPDATE 30 Agustus, masukan / update entry t_checksheet tanpa ubah informasi order request

        // ambil info stok saat ini
        $stock = $this->db->query(
            "SELECT
                case
                    when m_goods.ratio_flag = 0
                    then m_goods.quantity
                    else m_goods.quantity * m_unit.quantity
                end as old_stock
            FROM m_goods
            LEFT JOIN m_unit on m_unit.id = m_goods.unit
            WHERE m_goods.id = $goods_id"
        )->row()->old_stock;

        // Entry t_checksheet
        // update if exist, insert otherwise
        $data = array(
            "order_request_detail_id" => $old->id,
            "quantity" => $final_quantity,
            "old_quantity" => $stock,
            "flag" => 1,
            "created_by" => $this->session->userdata("id"),
            "order_placement" => $order_placement,
            "available" => $available == "on" ? 1 : 0
        );

        $find = $this->db->get_where("t_checksheet", array(
            "order_request_detail_id" => $old->id
        ));

        if ($find->num_rows()) {
            $data["updated_date"] = date("Y-m-d h:i:s");
            $this->db->update("t_checksheet", $data, array(
                "order_request_detail_id" => $old->id
            ));
        } else {
            $this->db->insert("t_checksheet", $data);
        }

        // update t_order_request, set flag = 10
        $this->db->update("t_order_request", array("flag" => 10), array("id" => $or_id));
    }

    public function delete_checksheet_entry($or_id, $goods_id)
    {
        $where = array(
            "order_request_id" => $or_id,
            "goods_id" => $goods_id
        );
        $old = $this->db->get_where("t_order_request_detail", $where)->row();

        $this->db->delete("t_checksheet", array(
            "order_request_detail_id" => $old->id
        ));

        $this->db->delete("t_order_request_detail", $where);
    }
}
