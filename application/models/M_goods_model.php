<?php

class M_goods_model extends CI_Model
{
    function get($where)
    {
        $this->db->select("
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
            ref13.price as price_5,
            
            ref9.discount_percent as discount_percent_1,
            ref10.discount_percent as discount_percent_2,
            ref11.discount_percent as discount_percent_3,
            ref12.discount_percent as discount_percent_4,
            ref13.discount_percent as discount_percent_5,

            ref7.quantity as converted_quantity
        ");

        $this->db->from("m_goods");
        $this->db->join("s_reference ref1", "ref1.id = m_goods.division", "left");
        $this->db->join("s_reference ref2", "ref2.id = m_goods.sub_division", "left");
        $this->db->join("s_reference ref3", "ref3.id = m_goods.category", "left");
        $this->db->join("s_reference ref4", "ref4.id = m_goods.sub_category", "left");
        $this->db->join("s_reference ref5", "ref5.id = m_goods.package", "left");
        $this->db->join("s_reference ref6", "ref6.id = m_goods.color", "left");
        $this->db->join("m_unit ref7", "ref7.id = m_goods.unit", "left");
        $this->db->join("m_price ref8", "ref8.goods_id = m_goods.id", "left");
        $this->db->join("m_price_alternate ref9", "ref9.price_index = '1' and ref9.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref10", "ref10.price_index = '2' and ref10.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref11", "ref11.price_index = '3' and ref11.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref12", "ref12.price_index = '4' and ref12.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref13", "ref13.price_index = '5' and ref13.price_id = ref8.id", "left");


        if (!isset($where['id'])) {
            $where['m_goods.flag <>'] = 99;
        }
        $this->db->where($where);

        $this->db->order_by("m_goods.id desc");

        return $this->db->get();
    }

    function get_harga($where)
    {
        $this->db->distinct();
        $this->db->select("
            m_goods.id,
            m_goods.brand_name,
            m_goods.brand_description,
            m_goods.sku_code,

            ref8.price as default_price,
            ref9.price as price_1,
            ref10.price as price_2,
            ref11.price as price_3,
            ref12.price as price_4,
            ref13.price as price_5
        ");

        $this->db->from("m_goods");
        $this->db->join("m_price ref8", "ref8.goods_id = m_goods.id", "left");
        $this->db->join("m_price_alternate ref9", "ref9.price_index = '1' and ref9.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref10", "ref10.price_index = '2' and ref10.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref11", "ref11.price_index = '3' and ref11.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref12", "ref12.price_index = '4' and ref12.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref13", "ref13.price_index = '5' and ref13.price_id = ref8.id", "left");


        if (!isset($where['id'])) {
            $where['m_goods.flag <>'] = 99;
        }
        $this->db->where($where);

        return $this->db->get();
    }

    function get_diskon($where)
    {
        $this->db->distinct();
        $this->db->select("
            m_goods.id,
            m_goods.brand_name,
            m_goods.brand_description,
            m_goods.sku_code,

            ref8.discount as default_discount,
            ref9.discount_percent as discount_1,
            ref10.discount_percent as discount_2,
            ref11.discount_percent as discount_3,
            ref12.discount_percent as discount_4,
            ref13.discount_percent as discount_5
        ");

        $this->db->from("m_goods");
        $this->db->join("m_price ref8", "ref8.goods_id = m_goods.id", "left");
        $this->db->join("m_price_alternate ref9", "ref9.price_index = '1' and ref9.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref10", "ref10.price_index = '2' and ref10.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref11", "ref11.price_index = '3' and ref11.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref12", "ref12.price_index = '4' and ref12.price_id = ref8.id", "left");
        $this->db->join("m_price_alternate ref13", "ref13.price_index = '5' and ref13.price_id = ref8.id", "left");


        if (!isset($where['id'])) {
            $where['m_goods.flag <>'] = 99;
        }
        $this->db->where($where);

        return $this->db->get();
    }

    function get_data($where)
    {
        $this->db->select("
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
        ");

        $this->db->from("m_goods");
        $this->db->join("s_reference ref1", "ref1.id = m_goods.division", "left");
        $this->db->join("s_reference ref2", "ref2.id = m_goods.sub_division", "left");
        $this->db->join("s_reference ref3", "ref3.id = m_goods.category", "left");
        $this->db->join("s_reference ref4", "ref4.id = m_goods.sub_category", "left");
        $this->db->join("s_reference ref5", "ref5.id = m_goods.package", "left");
        $this->db->join("s_reference ref6", "ref6.id = m_goods.color", "left");
        $this->db->join("m_unit ref7", "ref7.id = m_goods.unit", "left");

        if (!isset($where['id'])) {
            $where['m_goods.flag <>'] = 99;
        }

        $this->db->where($where);

        return $this->db->get();
    }

    function get_simple($branch_id)
    {
        return $this->db->query(
            "SELECT
                id,
                brand_name,
                brand_description,
                barcode
            FROM m_goods
            WHERE branch_id = $branch_id"
        );
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
        ref13.price as price_5,

        ref7.quantity as converted_quantity

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
        $data['unique_id'] = $this->get_next_unique_id($data['branch_id']);
        // set unique id
        if (!isset($data['barcode'])) {
            // 2 Digit Awal merupakan kode Standar EAN-13, kode yang dipakai system flowstream adalah 23
            $barcode = "23";

            // 5 Digit selanjutnya adalah kode partner (branch id)
            $barcode .= sprintf('%05d', $data['branch_id']);

            // 5 Digit Selanjutnya adalah unique_id_barang
            $barcode .= sprintf('%05d', $data['unique_id']);

            // 1 Digit terakhit adalah Check Digit.
            $barcode .= $this->setup_checkdigit($barcode);

            $data['barcode'] = $barcode;
        }
        echo "insert done";
        $this->db->insert("m_goods", $data);
        echo "insert done";
    }

    function setup_checkdigit($barcode)
    {
        // Dikalikan dengan	: 1   3   1   3   1   3   1   3   1   3   1   3
        $focus = 0;
        $splitted = str_split($barcode);
        $focus += intval($splitted[0] * 1);
        $focus += intval($splitted[1] * 3);
        $focus += intval($splitted[2] * 1);
        $focus += intval($splitted[3] * 3);
        $focus += intval($splitted[4] * 1);
        $focus += intval($splitted[5] * 3);
        $focus += intval($splitted[6] * 1);
        $focus += intval($splitted[7] * 3);
        $focus += intval($splitted[8] * 1);
        $focus += intval($splitted[9] * 3);
        $focus += intval($splitted[10] * 1);
        $focus += intval($splitted[11] * 3);

        // hasil kali = $focus

        // Dibagi dengan 10, ambil sisanya.
        $focus %= 10;

        // 10 – Sisa bagi
        $focus = 10 - $focus;

        return $focus;
    }

    function get_next_unique_id($branch_id)
    {
        $this->db->select("unique_id");
        $this->db->from("m_goods");
        $this->db->where("branch_id = $branch_id");
        $this->db->order_by("unique_id desc");
        $this->db->limit(1);
        $qres = $this->db->get();
        if ($qres->num_rows() == 0) {
            return 1;
        } else {
            return $qres->row()->unique_id + 1;
        }
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_goods", $data);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_goods", array("flag" => 99));
    }

    function get_price($where)
    {
        return $this->db->get_where("m_price", $where);
    }

    function change_main_price($where, $data)
    {
        if ($this->db->get_where("m_price", $where)->num_rows() == 0) {
            $this->db->insert("m_price", $where);
        }
        $this->db->where($where);
        $this->db->update("m_price", $data);
    }

    function change_price_alternate($where, $data)
    {
        if ($this->db->get_where("m_price_alternate", $where)->num_rows() == 0) {
            $this->db->insert("m_price_alternate", $where);
        }
        $this->db->update("m_price_alternate", $data, $where);
    }

    function get_goods_price($where)
    {
        $this->db->select("m_goods.*,m_price.price,
                    ifnull(sum(m_price_alternate.price)/count(*),0) price_alternate");
        $this->db->from("m_goods");
        $this->db->join("m_price", "m_price.goods_id=m_goods.id", "left");
        $this->db->join("m_price_alternate", "m_price_alternate.price_id=m_price.id", "left");

        $this->db->where($where);

        return $this->db->get();
    }

    function get_goods_per_supplier($where, $group_by = 'tab4.id')
    {
        $this->db->select("tab1.id partner_id,tab1.name partner_name,tab1.tax_number,tab1.branch_id,tab5.name branch_name,tab2.id salesman_id,tab2.name salesman,tab4.*,
            ifnull(sum(tab7.price)/count(*),0) price_alternate");
        $this->db->from("m_partner tab1");
        $this->db->join("m_partner_salesman tab2", "tab2.partner_id=tab1.id", "left");
        $this->db->join("m_salesman_map tab3", "tab3.salesman_id=tab2.id", "left");
        $this->db->join("m_goods tab4", "tab4.id=tab3.goods_id");
        $this->db->join("m_branch tab5", "tab5.id=tab1.branch_id", "left");
        $this->db->join("m_price tab6", "tab6.goods_id=tab4.id", "left");
        $this->db->join("m_price_alternate tab7", "tab7.price_id=tab6.id", "left");
        $this->db->where($where);
        if ($group_by) {
            $this->db->group_by($group_by);    
        }
        
        $this->db->order_by("tab4.brand_description");

        return $this->db->get();
    }

    function update_quantity_from_checksheet($id_barang, $new_quantity)
    {
        $where = array(
            "m_goods.id" => $id_barang
        );
        $this->db->select("m_goods.*, m_unit.quantity as converted_quantity");
        $this->db->from("m_goods");
        $this->db->join("m_unit", "m_unit.id = m_goods.unit", "left");
        $this->db->where($where);
        $old = $this->db->get()->row();
        $final_quantity = $old->ratio_flag == 1 ? $new_quantity / $old->converted_quantity : $new_quantity;

        $set = array(
            "quantity" => $final_quantity
        );
        $this->db->update("m_goods", $set, $where);
    }
}
