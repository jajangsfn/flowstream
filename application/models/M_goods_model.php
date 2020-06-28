<?php

class M_goods_model extends CI_Model
{
    function get($where)
    {
        if (is_array($where)) {
            return $this->db->get_where("m_goods", $where);
        } else {
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
            m_goods.rekening_no,
            
            ref1.detail_data as division,
            ref1.id as division_id,
            ref2.detail_data as sub_division,
            ref2.id as sub_division_id,
            ref3.detail_data as category,
            ref3.id as category_id,
            ref4.detail_data as sub_category,
            ref4.id as sub_category_id,
            ref5.detail_data as package,
            ref5.id as package_id,
            ref6.detail_data as color,
            ref6.id as color_id,
            ref7.name as unit,
            ref7.id as unit_id
            
            FROM `m_goods`
            
            left join s_reference ref1 on ref1.id = m_goods.division
            left join s_reference ref2 on ref2.id = m_goods.sub_division
            left join s_reference ref3 on ref3.id = m_goods.category
            left join s_reference ref4 on ref4.id = m_goods.sub_category
            left join s_reference ref5 on ref5.id = m_goods.package
            left join s_reference ref6 on ref6.id = m_goods.color
            left join m_unit ref7 on ref7.id = m_goods.id
            
            WHERE m_goods.flag <> 99 AND $where"
            );
        }
    }

    function get_all()
    {
        return $this->db->get("m_goods");
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
        m_goods.rekening_no,
        
        ref1.detail_data as division,
        ref1.id as division_id,
        ref2.detail_data as sub_division,
        ref2.id as sub_division_id,
        ref3.detail_data as category,
        ref3.id as category_id,
        ref4.detail_data as sub_category,
        ref4.id as sub_category_id,
        ref5.detail_data as package,
        ref5.id as package_id,
        ref6.detail_data as color,
        ref6.id as color_id,
        ref7.name as unit,
        ref7.id as unit_id
        
        FROM `m_goods`
        
        left join s_reference ref1 on ref1.id = m_goods.division
        left join s_reference ref2 on ref2.id = m_goods.sub_division
        left join s_reference ref3 on ref3.id = m_goods.category
        left join s_reference ref4 on ref4.id = m_goods.sub_category
        left join s_reference ref5 on ref5.id = m_goods.package
        left join s_reference ref6 on ref6.id = m_goods.color
        left join m_unit ref7 on ref7.id = m_goods.id
        
        WHERE m_goods.flag <> 99"
        );
    }

    function insert($data)
    {
        $this->db->insert("m_goods", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_goods", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_goods", array("flag" => 99));
        return $this->get($where);
    }
}
