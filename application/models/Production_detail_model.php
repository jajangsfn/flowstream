<?php

class Production_detail_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("production_detail", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT p.*, 
            b.brand_description as goods_name, 
            m.name as production_name
            FROM production_detail p
            LEFT JOIN m_goods b on b.id = p.goods_id
            LEFT JOIN production m on m.id = p.production_id
            
            WHERE p.flag <> 99"
        );
    }

    function insert($data)
    {
        $this->db->insert("production_detail", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("production_detail", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("production_detail", array("flag" => 99));
        return $this->get($where);
    }
}
