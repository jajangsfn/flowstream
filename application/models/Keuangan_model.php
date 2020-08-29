<?php

class Keuangan_model extends CI_Model
{
    function entry_tagihan_piutang_baru($journal_no, $payment)
    {
        $this->db->insert("t_pembayaran_piutang", array(
            "jurnal_no" => $journal_no,
            "payment" => $payment,
            "created_by" => $this->session->userdata("id")
        ));
    }

    function get_customer_with_invoice_piutang()
    {
        if ($this->session->role_code == "ROLE_SUPER_ADMIN") {
            $where = "1";
        } else {
            $where = "t_pos.branch_id = " . $this->session->branch_id;
        }
        return $this->db->query(
            "SELECT 
                m_partner.*
            FROM m_partner
            LEFT JOIN t_pos on t_pos.partner_id = m_partner.id
            LEFT JOIN t_jurnal on t_jurnal.invoice_no = t_pos.invoice_no
            LEFT JOIN t_pembayaran_piutang tpp on tpp.jurnal_no = t_jurnal.jurnal_no
            WHERE $where AND tpp.flag = 0
            "
        );
    }

    function get_invoice_customer_with_piutang($customer_id)
    {
        return $this->db->query(
            "SELECT 
                tpp.id,
                t_pos.id as pos_id,
                t_pos.invoice_no

            FROM m_partner
            LEFT JOIN t_pos on t_pos.partner_id = m_partner.id
            LEFT JOIN t_jurnal on t_jurnal.invoice_no = t_pos.invoice_no
            LEFT JOIN t_pembayaran_piutang tpp on tpp.jurnal_no = t_jurnal.jurnal_no
            WHERE m_partner.id = $customer_id AND tpp.flag = 0"
        );
    }
}
