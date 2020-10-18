<?php

class M_account_code_model extends CI_Model
{
    function get($where)
    {
        $this->db->select("*");
        $this->db->from("m_account_code");
        $this->db->where($where);
        $this->db->order_by("acc_code asc");
        return $this->db->get();
    }

    function get_akun_pendapatan_aktif($branch_id)
    {
        return $this->db->query(
            "SELECT 
                id, 
                branch_id, 
                acc_code, 
                CONCAT(acc_code, ' - ', acc_name) as acc_name, 
                group_code,
                upr_acc_code,
                is_active,
                inv_required,
                position
                
            FROM m_account_code
            WHERE 
                m_account_code.is_active = '1' AND 
                m_account_code.branch_id = '$branch_id' AND 
                m_account_code.acc_code like (
                    SELECT CONCAT(
                            SUBSTRING(inner_acc.acc_code, 1, 2), '%'
                        )
                    FROM m_account_code as inner_acc
                    WHERE LOWER(acc_name) = 'pendapatan'
            )
            ORDER BY acc_code asc"
        );
    }

    function get_viewable($where)
    {
        $this->db->select("m_account_code.*, CONCAT(acc_code, ' - ', acc_name) as acc_code_name");
        $this->db->from("m_account_code");
        $this->db->where($where);
        $this->db->order_by("acc_code asc");
        return $this->db->get();
    }

    function get_non_parameter_neraca_saldo_akhir($branch_id)
    {
        return $this->db->query(
            "SELECT 
                *,
                CONCAT(acc_code, ' ', acc_name) as acc_code_name,
                LENGTH(`acc_code`)

            FROM m_account_code
            
            WHERE 
                branch_id = '$branch_id' AND 
                acc_code NOT IN (
                    SELECT acc_code
                    FROM m_parameter_neraca_saldo
                    WHERE branch_id = $branch_id
                ) AND
                acc_code like '%.00.000'

            ORDER BY acc_code
            "
        );
    }

    function get_non_ikhtisar_saldo($branch_id)
    {
        return $this->db->query(
            "SELECT 
                *,
                CONCAT(acc_code, ' ', acc_name) as acc_code_name

            FROM m_account_code
            
            WHERE 
                branch_id = '$branch_id'
                AND acc_code NOT IN (
                    SELECT acc_code
                    FROM m_parameter_ikhtisar_saldo
                    WHERE branch_id = $branch_id
                ) AND
                acc_code like '%.000' AND
                acc_code NOT like '%.00.000'

            ORDER BY acc_code
            "
        );
    }

    function get_non_saldo_kode_rekening($branch_id)
    {
        return $this->db->query(
            "SELECT 
                *,
                CONCAT(acc_code, ' ', acc_name) as acc_code_name

            FROM m_account_code
            
            WHERE 
                branch_id = '$branch_id'
                AND acc_code NOT IN (
                    SELECT acc_code
                        FROM m_parameter_kode_rekening_saldo
                        WHERE branch_id = '$branch_id'
                ) AND
                acc_code NOT like '%.000' AND
                acc_code NOT like '%.00.000'

            ORDER BY acc_code
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("m_account_code", $data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_account_code", $data);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_account_code", array("flag" => 99));
    }
}
