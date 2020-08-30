<?php

class Keuangan_model extends CI_Model
{
    function entry_tagihan_piutang_baru($invoice_no, $bill)
    {
        $this->db->insert("t_pembayaran_piutang", array(
            "invoice_no" => $invoice_no,
            "total_bill" => $bill,
            "created_by" => $this->session->userdata("id")
        ));
    }

    function get_customer_with_invoice_piutang()
    {
        $where = "1";
        if ($this->session->role_code != "ROLE_SUPER_ADMIN") {
            $where = "t_pos.branch_id = " . $this->session->branch_id;
        }
        return $this->db->query(
            "SELECT DISTINCT
                m_partner.*
            FROM m_partner
            LEFT JOIN t_pos on t_pos.partner_id = m_partner.id
            LEFT JOIN t_pembayaran_piutang tpp on tpp.invoice_no = t_pos.invoice_no
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
                tpp.invoice_no,
                tpp.created_date

            FROM m_partner
            LEFT JOIN t_pos on t_pos.partner_id = m_partner.id
            LEFT JOIN t_pembayaran_piutang tpp on tpp.invoice_no = t_pos.invoice_no
            WHERE m_partner.id = $customer_id AND tpp.flag = 0"
        );
    }

    function get_piutang_data($tpp_id)
    {
        $result = $this->db->query(
            "SELECT
                DATE(tpp.created_date) as invoice_date,
                tpp.total_bill as sisa_tagihan,
                tpp.invoice_no,
                t_pos.payment_total as total_tagihan,
                tpp.id

            FROM t_pembayaran_piutang tpp
            LEFT JOIN t_pos on tpp.invoice_no = t_pos.invoice_no

            WHERE tpp.id = $tpp_id"
        )->row();
        $result->invoice_date = longdate_indo(date($result->invoice_date));
        $result->sisa_tagihan = str_replace(',', '', $result->sisa_tagihan);
        $result->sisa_tagihan_str = "Rp " . number_format($result->sisa_tagihan, 2, ',', '.');
        $result->total_tagihan = str_replace(',', '', $result->total_tagihan);
        $result->total_tagihan_str = "Rp " . number_format($result->total_tagihan, 2, ',', '.');
        return $result;
    }

    function update_entry_piutang($tpp_id, $data)
    {
        $this->db->update("t_pembayaran_piutang", $data, array(
            "id" => $tpp_id
        ));
    }
}
