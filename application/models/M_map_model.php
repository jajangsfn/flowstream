<?php

class M_map_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_map", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            map.id,
            map.event_id,
            map.goods_id,
            map.partner_id,
            map.price,
            map.flag,
            event.name as event_name, 
            partner.name as partner_name,
            goods.brand_description as goods_name

            FROM m_map as map
            LEFT JOIN m_event event on event.id = map.event_id
            LEFT JOIN m_partner partner on partner.id = map.partner_id
            LEFT JOIN m_goods goods on goods.id = map.goods_id

            where map.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("m_map", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_map", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_map", array("flag" => 99));
        return $this->get($where);
    }
}
