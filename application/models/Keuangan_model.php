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

    // TODO: panggil fungsi ini setelah buat entry pembelian baru
    function entry_tagihan_hutang_baru($invoice_no, $bill)
    {
        $this->db->insert("t_pembayaran_hutang", array(
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

    // TODO: Uncomplete tpp to tph
    function get_supplier_with_hutang()
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
            LEFT JOIN t_pembayaran_hutang tph on tph.invoice_no = t_pos.invoice_no
            WHERE $where AND tph.flag = 0
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

    // TODO: Uncomplete tpp to tph
    function get_invoice_supplier_with_hutang($customer_id)
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

    // TODO: Uncomplete tpp to tph
    function get_hutang_data($tph_id)
    {
        $result = $this->db->query(
            "SELECT
                DATE(tph.created_date) as invoice_date,
                tph.total_bill as sisa_tagihan,
                tph.invoice_no,
                t_pos.payment_total as total_tagihan,
                tph.id

            FROM t_pembayaran_hutang tph
            LEFT JOIN t_pos on tph.invoice_no = t_pos.invoice_no

            WHERE tph.id = $tph_id"
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

    function update_entry_hutang($tph_id, $data)
    {
        $this->db->update("t_pembayaran_hutang", $data, array(
            "id" => $tph_id
        ));
    }

    public function get_neraca_saldo($periode = '2020-07')
    {
        return $this->db->query("SELECT 
                                    t1.jurnal_no,SUBSTR(t1.jurnal_date,1,7)jurnal_date,
                                    t2.acc_code,t3.acc_name,
                                    t4.saldo_akhir saldo_bln_lalu,
                                    t2.debit,t2.credit, 
                                    sum(t2.debit) total_debit,
                                    sum(t2.credit) total_credit ,
                                    t3.position
                                    FROM 
                                    t_jurnal t1 
                                    JOIN t_jurnal_detail t2 ON t2.jurnal_no=t1.jurnal_no
                                    JOIN m_account_code t3 ON SUBSTR(t3.acc_code,1,8)=TRIM(t2.acc_code)
                                    LEFT JOIN t_neraca_saldo_akhir t4 ON SUBSTR(t4.acc_code,1,8)=TRIM(t2.acc_code)
                                    WHERE SUBSTR(t1.jurnal_date,1,7) ='$periode'
                                    GROUP BY t1.jurnal_date,t2.acc_code");
    }
        
    function get_parameter_neraca_saldo_akhir($branch_id)
    {
        return $this->db->query(
            "SELECT 
                m_parameter_neraca_saldo.*,
                m_account_code.acc_name
                
            FROM m_parameter_neraca_saldo
            LEFT JOIN m_account_code on m_account_code.acc_code = m_parameter_neraca_saldo.acc_code
            WHERE m_parameter_neraca_saldo.branch_id = $branch_id AND m_account_code.branch_id = $branch_id
            "
        );
    }

    function add_parameter_neraca_saldo_akhir($branch_id, $acc_code)
    {
        $user = $this->session->userdata("id");

        $this->db->query(
            "INSERT INTO `m_parameter_neraca_saldo`
                (`id`, `branch_id`, `acc_code`, `created_date`, `created_by`, `flag`) 
            VALUES 
                (null, '$branch_id', '$acc_code', current_timestamp(), '$user', '1')"
        );
    }

    function delete_parameter_neraca_saldo_akhir($id)
    {
        $this->db->query(
            "DELETE FROM `m_parameter_neraca_saldo` WHERE id = $id"
        );
    }

    function get_parameter_ikhtisar_saldo($branch_id)
    {
        return $this->db->query(
            "SELECT 
                m_parameter_ikhtisar_saldo.*,
                m_account_code.acc_name
                
            FROM m_parameter_ikhtisar_saldo
            LEFT JOIN m_account_code on m_account_code.acc_code = m_parameter_ikhtisar_saldo.acc_code
            WHERE m_parameter_ikhtisar_saldo.branch_id = $branch_id AND m_account_code.branch_id = $branch_id
            "
        );
    }

    function add_parameter_ikhtisar_saldo($branch_id, $acc_code)
    {
        $user = $this->session->userdata("id");

        $this->db->query(
            "INSERT INTO `m_parameter_ikhtisar_saldo`
                (`id`, `branch_id`, `acc_code`, `created_date`, `created_by`, `flag`) 
            VALUES 
                (null, '$branch_id', '$acc_code', current_timestamp(), '$user', '1')"
        );
    }

    function delete_parameter_ikhtisar_saldo($id)
    {
        $this->db->query(
            "DELETE FROM `m_parameter_ikhtisar_saldo` WHERE id = $id"
        );
    }

    function get_parameter_kode_rekening_saldo($branch_id)
    {
        return $this->db->query(
            "SELECT 
                m_parameter_kode_rekening_saldo.*,
                m_account_code.acc_name
                
            FROM m_parameter_kode_rekening_saldo
            LEFT JOIN m_account_code on m_account_code.acc_code = m_parameter_kode_rekening_saldo.acc_code
            WHERE m_parameter_kode_rekening_saldo.branch_id = $branch_id AND m_account_code.branch_id = $branch_id
            "
        );
    }

    function add_parameter_kode_rekening_saldo($branch_id, $acc_code)
    {
        $user = $this->session->userdata("id");

        $this->db->query(
            "INSERT INTO `m_parameter_kode_rekening_saldo`
                (`id`, `branch_id`, `acc_code`, `created_date`, `created_by`, `flag`) 
            VALUES 
                (null, '$branch_id', '$acc_code', current_timestamp(), '$user', '1')"
        );
    }

    function delete_parameter_kode_rekening_saldo($id)
    {
        $this->db->query(
            "DELETE FROM `m_parameter_kode_rekening_saldo` WHERE id = $id"
        );
    }
}
