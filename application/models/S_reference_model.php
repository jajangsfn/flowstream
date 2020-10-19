<?php

class S_reference_model extends CI_Model
{
    function get($where)
    {
        $where['flag <>'] = 99;
        return $this->db->get_where("s_reference", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "
            SELECT s_reference.*, m_branch.name AS branch_name
            FROM s_reference
            LEFT JOIN m_branch on s_reference.branch_id = m_branch.id
            WHERE s_reference.flag <> 99
            "
        );
    }

    function get_group_data()
    {
        return $this->db->query(
            "select DISTINCT group_data from s_reference"
        );
    }

    function insert($data)
    {
        $this->db->insert("s_reference", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("s_reference", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("s_reference", array("flag" => 99));
        return $this->get($where);
    }

    function get_default_password()
    {
        $query = $this->db->get_where(
            "s_reference",
            array(
                "branch_id" => $this->session->userdata("branch_id"),
                "group_data" => "DEFAULT_PASSWORD"
            )
        );
        return md5($query->num_rows() > 0 ? $query->row()->detail_data : "flowstream");
    }


    public function get_type_price($where = null) {

        return $this->db->query("SELECT id,detail_data,flag FROM s_reference 
                                 WHERE group_data LIKE 'PRICE_METHOD'" . (isset($where) ? " and ".$where : ""));
    }

    public function update_type_price($data) {
        // update set flag = 1 where type price changed
        $this->db->where("id", $data);
        $this->db->update("s_reference", array("flag"=>1));

        // update set flag = 99 where type price except id changed
        $where = array("id!=" => $data, "group_data"=>"PRICE_METHOD");
        $this->db->where($where);
        $this->db->update("s_reference", array("flag"=>99));
    }
}
