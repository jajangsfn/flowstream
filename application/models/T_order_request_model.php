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
}
