<?php

class M_partner_model extends CI_Model
{
    function get($where)
    {
        if (is_array($where)) {
            $this->db->order_by("name");
            return $this->db->get_where("m_partner", $where);
        }
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch, 
            m.name as master
            FROM m_partner p
            LEFT JOIN m_branch b on b.id = p.branch_id
            LEFT JOIN m_master m on m.code = p.master_code
            
            WHERE p.flag <> 99 AND " . $where . "
            ORDER BY p.name"
        );
    }

    function get_customer($order = "p.id desc")
    {
        if ($this->session->userdata("role_code") == "ROLE_SUPER_ADMIN") {
            return $this->db->query(
                "SELECT p.*, 
                b.name as branch, 
                m.name as master
                FROM m_partner p
                LEFT JOIN m_branch b on b.id = p.branch_id
                LEFT JOIN m_master m on m.code = p.master_code
                
                WHERE p.flag <> 99 AND p.is_customer = 1
                
                ORDER BY $order"
            );
        } else {
            $branch_id = $this->session->branch_id;
            return $this->db->query(
                "SELECT p.*, 
                b.name as branch, 
                m.name as master
                FROM m_partner p
                LEFT JOIN m_branch b on b.id = p.branch_id
                LEFT JOIN m_master m on m.code = p.master_code
                
                WHERE p.flag <> 99 AND p.is_customer = 1 AND b.id = $branch_id
                
                ORDER BY $order"
            );
        }
    }

    function get_customer_with_invoice($order = "p.id desc")
    {
        if ($this->session->userdata("role_code") == "ROLE_SUPER_ADMIN") {
            return $this->db->query(
                "SELECT DISTINCT p.*, 
                b.name as branch, 
                m.name as master,
                SUM(innerdet.debit),
                pos.payment_total

                FROM m_partner p
                LEFT JOIN m_branch b on b.id = p.branch_id
                LEFT JOIN m_master m on m.code = p.master_code
                LEFT JOIN t_pos pos on pos.partner_id = p.id
                LEFT JOIN (
                    SELECT innerdet.debit, innerdet.invoice_no
                    FROM t_jurnal_detail innerdet 
                    WHERE innerdet.acc_code = 
                        (
                            SELECT ACCOUNT_CODE FROM m_journal_mapping WHERE JOURNAL_CD = 'KAS' AND BRANCH_ID = 1 AND SEQ_LINE = 2
                        )
                    ) innerdet on innerdet.invoice_no = pos.invoice_no
                
                WHERE p.flag <> 99 AND p.is_customer = 1 AND pos.id IS NOT NULL
                GROUP BY pos.id
                HAVING SUM(innerdet.debit) is null or SUM(innerdet.debit) < pos.payment_total

                ORDER BY $order"
            );
        } else {
            $branch_id = $this->session->branch_id;
            return $this->db->query(
                "SELECT DISTINCT p.*, 
                    b.name as branch, 
                    m.name as master,
                    SUM(innerdet.debit),
                    pos.payment_total
                
                FROM m_partner p
                LEFT JOIN m_branch b on b.id = p.branch_id
                LEFT JOIN m_master m on m.code = p.master_code
                LEFT JOIN t_pos pos on pos.partner_id = p.id
                LEFT JOIN (
                    SELECT innerdet.debit, innerdet.invoice_no
                    FROM t_jurnal_detail innerdet 
                    WHERE innerdet.acc_code = 
                        (
                            SELECT ACCOUNT_CODE FROM m_journal_mapping WHERE JOURNAL_CD = 'KAS' AND BRANCH_ID = $branch_id AND SEQ_LINE = 2
                        )
                    ) innerdet on innerdet.invoice_no = pos.invoice_no
                
                WHERE p.flag <> 99 AND p.is_customer = 1 AND pos.id IS NOT NULL
                GROUP BY pos.id
                HAVING SUM(innerdet.debit) is null or SUM(innerdet.debit) < pos.payment_total

                ORDER BY $order"
            );
        }
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

    function get_supplier_where($where)
    {
        $this->db->select("
            p.*,
            b.name as branch,
            m.name as master,
            count(ps.name) as salesman_total
        ");

        $this->db->from("m_partner p");
        $this->db->join("m_branch b", "b.id = p.branch_id", "left");
        $this->db->join("m_master m", "m.code = p.master_code", "left");
        $this->db->join("m_partner_salesman ps", "ps.partner_id = p.id", "left");

        $where['p.flag <>'] = 99;
        $where['p.is_supplier'] = 1;
        $where['ps.flag <>'] = 99;

        $this->db->where($where);

        $this->db->group_by("p.id");

        $this->db->order_by("p.id desc");

        return $this->db->get();
    }

    function get_customer_where($where)
    {
        $this->db->select("
            p.*,
            b.name as branch,
            m.name as master,
            map.price_index as index_harga,
            count(ps.id) as salesman_total
        ");

        $this->db->from("m_partner p");
        $this->db->join("m_branch b", "b.id = p.branch_id", "left");
        $this->db->join("m_master m", "m.code = p.master_code", "left");
        $this->db->join("m_map map", "map.partner_type = p.partner_type", "left");
        $this->db->join("m_user_salesman ps", "ps.partner_id = p.id", "left");

        $where['p.flag <>'] = 99;
        $where['p.is_customer'] = 1;

        $this->db->where($where);

        $this->db->group_by("p.id");

        $this->db->order_by("p.id desc");

        return $this->db->get();
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT p.*, 
            b.name as branch, 
            m.name as master
            FROM m_partner p
            LEFT JOIN m_branch b on b.id = p.branch_id
            LEFT JOIN m_master m on m.id = p.master_code
            
            WHERE p.flag <> 99"
        );
    }

    function insert($data)
    {
        $data['flag'] = 1;
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
