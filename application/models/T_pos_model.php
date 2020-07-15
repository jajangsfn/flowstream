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
}
