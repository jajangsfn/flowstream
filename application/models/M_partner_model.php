<?php

class M_partner_model extends CI_Model
{
    function get($where)
    {
        if (is_array($where)) {
            return $this->db->get_where("m_partner", $where);
        }
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch, 
            m.name as master
            FROM m_partner p
            LEFT JOIN m_branch b on b.id = p.branch_id
            LEFT JOIN m_master m on m.code = p.master_code
            
            WHERE p.flag <> 99 AND " . $where
        );
    }

    function get_customer()
    {
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch, 
            m.name as master
            FROM m_partner p
            LEFT JOIN m_branch b on b.id = p.branch_id
            LEFT JOIN m_master m on m.code = p.master_code
            
            WHERE p.flag <> 99 AND p.is_customer = 1
            
            ORDER BY p.id desc"
        );
    }

    function get_supplier()
    {
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch, 
            m.name as master,
            count(ps.name) as salesman_total
            
            FROM m_partner p
            LEFT JOIN m_branch b on b.id = p.branch_id
            LEFT JOIN m_master m on m.code = p.master_code
            LEFT JOIN m_partner_salesman ps on ps.partner_id = p.id
            
            WHERE p.flag <> 99 AND p.is_supplier = 1 AND ps.flag <> 99

            GROUP BY p.id
            
            ORDER BY p.id desc"
        );
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch, 
            m.name as master
            FROM m_partner p
            LEFT JOIN m_branch b on b.id = p.branch_id
            LEFT JOIN m_master m on m.id = p.master_id
            
            WHERE p.flag <> 99"
        );
    }

    function insert($data)
    {
        $this->db->insert("m_partner", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_partner", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_partner", array("flag" => 99));
        return $this->get($where);
    }
}
