<?php

class M_branch_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_branch", $where);
    }

    function get_all()
    {
        return $this->db->get_where("m_branch", array("flag <>" => 99));
    }

    function create_new_branch($data)
    {
        $this->db->insert("m_branch", $data);
        $branch_id = $this->db->insert_id();

        $this->db->insert_batch("s_reference", array(
            array(
                "branch_id" => $branch_id,
                "group_data" => "BANK",
                "detail_data" => "BCA",
                "flag" => 1,
                "created_date" => date("Y-m-d h:i:s"),
                "updated_date" => date("Y-m-d h:i:s")
            ),
            array(
                "branch_id" => $branch_id,
                "group_data" => "PAYMENT_METHOD",
                "detail_data" => "CASH",
                "flag" => 1,
                "created_date" => date("Y-m-d h:i:s"),
                "updated_date" => date("Y-m-d h:i:s")
            ),
            array(
                "branch_id" => $branch_id,
                "group_data" => "PAYMENT_METHOD",
                "detail_data" => "TRANSFER",
                "flag" => 1,
                "created_date" => date("Y-m-d h:i:s"),
                "updated_date" => date("Y-m-d h:i:s")
            ),
            array(
                "branch_id" => $branch_id,
                "group_data" => "PAYMENT_METHOD",
                "detail_data" => "CREDIT",
                "flag" => 1,
                "created_date" => date("Y-m-d h:i:s"),
                "updated_date" => date("Y-m-d h:i:s")
            ),
        ));

        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_branch", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_branch", array("flag" => 99));
        return $this->get($where);
    }
}
