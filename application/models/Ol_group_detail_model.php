<?php

class Ol_group_detail_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("ol_group_detail", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            olgroup_det.*,
            olgroup.name as group_name,
            branch.name as branch_name

            FROM ol_group_detail as olgroup_det
            LEFT JOIN ol_group as olgroup on olgroup.id = olgroup_det.group_id
            LEFT JOIN m_branch as branch on branch.id = olgroup_det.member_id
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("ol_group_detail", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("ol_group_detail", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete("ol_group_detail");
    }
}
