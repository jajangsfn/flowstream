<?php

class Delivery_team_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("delivery_team", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            team.*,
            delor.delivery_no

            FROM delivery_team as team
            LEFT JOIN delivery_order as delor on delor.id = team.delivery_order_id
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("delivery_team", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("delivery_team", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete("delivery_team");
    }
}
