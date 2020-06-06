<?php

class M_goods_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("user", $where);
    }

    function get_all()
    {
        return $this->db->get("user");
    }

    function get_complete()
    {
        return $this->db->query(
            "SELECT 
        m_goods.id,
        m_goods.barcode,
        m_goods.sku_code,
        m_goods.plu_code,
        m_goods.name,
        m_goods.hpp,
        m_goods.quantity,
        m_goods.tax,
        
        ref1.detail_data as division,
        ref2.detail_data as sub_division,
        ref3.detail_data as category,
        ref4.detail_data as sub_category,
        ref5.detail_data as package,
        ref6.detail_data as color,
        ref7.name as unit
        
        FROM `m_goods`
        
        left join s_reference ref1 on ref1.id = m_goods.division
        left join s_reference ref2 on ref2.id = m_goods.sub_division
        left join s_reference ref3 on ref3.id = m_goods.category
        left join s_reference ref4 on ref4.id = m_goods.sub_category
        left join s_reference ref5 on ref5.id = m_goods.package
        left join s_reference ref6 on ref6.id = m_goods.color
        left join m_unit ref7 on ref7.id = m_goods.id"
        );
    }

    function insert($data)
    {
        $this->db->insert("user", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("user", $data);
        return $this->get($where);
    }
}
