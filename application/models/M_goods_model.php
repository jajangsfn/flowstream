<?php

class M_goods_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_goods", $where);
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
        m_goods.brand_description name,
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

    function get_goods_price($where)
    {
        $this->db->select("m_goods.*,m_price.price,
                    ifnull(sum(m_price_alternate.price)/count(*),0) price_alternate");
        $this->db->from("m_goods");
        $this->db->join("m_price","m_price.goods_id=m_goods.id","left");
        $this->db->join("m_price_alternate","m_price_alternate.price_id=m_price.id","left");

        $this->db->where($where);

        return $this->db->get();
    }

    function get_goods_per_supplier($where)
    {
        $this->db->select("tab1.id partner_id,tab1.name partner_name,tab1.tax_number,tab1.branch_id,tab5.name branch_name,tab2.id salesman_id,tab2.name salesman,tab4.*");
        $this->db->from("m_partner tab1");
        $this->db->join("m_partner_salesman tab2","tab2.partner_id=tab1.id");
        $this->db->join("m_salesman_map tab3","tab3.salesman_id=tab2.id");
        $this->db->join("m_goods tab4","tab4.id=tab3.goods_id");
        $this->db->join("m_branch tab5","tab5.id=tab1.branch_id");
        $this->db->where($where);
        $this->db->order_by("tab4.brand_description");

        return $this->db->get();
    }
}
