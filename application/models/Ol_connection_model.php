<?php

class Ol_connection_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("ol_connection", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            connection.*,
            req.name as request_name, 
            rec.name as receive_name

            FROM ol_connection as connection
            LEFT JOIN m_branch req on req.id = connection.request_id
            LEFT JOIN m_branch rec on rec.id = connection.receive_id

            where connection.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("ol_connection", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("ol_connection", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("ol_connection", array("flag" => 99));
        return $this->get($where);
    }
}
