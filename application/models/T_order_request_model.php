<?php

class T_order_request_model extends CI_Model
{
    function get_next_no($where)
    {
        $this->db->select("order_no");
        $this->db->from("t_order_request");
        $this->db->where($where);
        $this->db->order_by("order_no desc");
        $this->db->limit(1);

        $q_result = $this->db->get();
        if ($q_result->num_rows()) {
            $current_order_no = $q_result->row()->order_no;
            $current_order_no = intval($current_order_no);
            $current_order_no++;

            $current_order_no = sprintf('%08d', $current_order_no);
        } else {
            $current_order_no = sprintf('%08d', 1);
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

        $this->db->select("
        ordet.*, 
        m_goods.barcode,
        m_goods.brand_name,
        m_goods.brand_description,
        m_unit.initial as unit_name
        ");
        $this->db->from("t_order_request_detail ordet");
        $this->db->join("m_goods", "m_goods.id = ordet.goods_id", "left");
        $this->db->join("m_unit", "m_unit.id = m_goods.unit", "left");
        $this->db->where(array("ordet.order_request_id" => $id));
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
}
