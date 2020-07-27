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

    function get($where)
    {
        $this->db->select("
        m_branch.name as branch_name,
        pos.*
        ");

        $this->db->from("t_pos pos");
        $this->db->join("m_branch", "m_branch.id = pos.branch_id", "left");
        $this->db->order_by("pos.id desc");
        if (!array_key_exists("id", $where)) {
            $where['pos.flag <>'] = 99;
        }
        $this->db->where($where);
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

    function get_this_month($where = '')
    {
        $this->db->select("id");
        $this->db->from("t_pos");

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
}
