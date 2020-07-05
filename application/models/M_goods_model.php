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
            m_goods.*,
            
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
        m_goods.*,
        
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
        ref7.id as unit_id,

        ref8.price as default_price,
        ref9.price as price_1,
        ref10.price as price_2,
        ref11.price as price_3,
        ref12.price as price_4,
        ref13.price as price_5
        
        FROM `m_goods`
        
        left join s_reference ref1 on ref1.id = m_goods.division
        left join s_reference ref2 on ref2.id = m_goods.sub_division
        left join s_reference ref3 on ref3.id = m_goods.category
        left join s_reference ref4 on ref4.id = m_goods.sub_category
        left join s_reference ref5 on ref5.id = m_goods.package
        left join s_reference ref6 on ref6.id = m_goods.color
        left join m_unit ref7 on ref7.id = m_goods.unit
        left join m_price ref8 on ref8.goods_id = m_goods.id
        left join m_price_alternate ref9 on ref9.price_index = '1' and ref9.price_id = ref8.id 
        left join m_price_alternate ref10 on ref10.price_index = '2' and ref10.price_id = ref8.id 
        left join m_price_alternate ref11 on ref11.price_index = '3' and ref11.price_id = ref8.id 
        left join m_price_alternate ref12 on ref12.price_index = '4' and ref12.price_id = ref8.id 
        left join m_price_alternate ref13 on ref13.price_index = '5' and ref13.price_id = ref8.id 
        
        WHERE m_goods.flag <> 99
        
        ORDER BY m_goods.id desc"
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

    function get_price($where)
    {
        return $this->db->get_where("m_price", $where);
    }

    function change_main_price($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_price", $data);
    }

    function change_price_alternate($where, $data)
    {
        $this->db->update("m_price_alternate", $data, $where);
    }
}
