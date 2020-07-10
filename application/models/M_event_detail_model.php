<?php

class M_event_detail_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_event_detail", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT
            detail.*,
            eventm.name as event_name,
            promo.name as promo_name,
            goods.brand_description as goods_name

            FROM m_event_detail detail
            LEFT JOIN m_event eventm on eventm.id = detail.event_id
            LEFT JOIN m_promo promo on promo.id = detail.promo_code
            LEFT JOIN m_goods goods on goods.id = detail.goods_id
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("m_event_detail", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_event_detail", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete("m_event_detail");
    }
}
