<?php

class M_salesman_map_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_salesman_map", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "
            SELECT 
            map.id, 
            s.name as salesman_name, 
            g.name as goods_name, 
            g.id as goods_id, 
            s.id as salesman_id 

            FROM m_salesman_map map
            left join m_salesman s on s.id = map.salesman_id
            left join m_goods g on g.id = map.goods_id
                    
            where map.flag <> 99
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("m_salesman_map", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_salesman_map", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->delete("m_salesman_map", $where);
    }

    function get_barang($where)
    {
        $this->db->select("m_goods.*");
        $this->db->from("m_salesman_map");
        $this->db->join("m_goods", "m_goods.id = m_salesman_map.goods_id", "left");
        $this->db->where($where);
        return $this->db->get();
    }
}
