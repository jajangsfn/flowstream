<?php

class Keuangan_model extends CI_Model
{
    function entry_tagihan_piutang_baru($invoice_no, $bill)
    {
        $this->db->insert("t_pembayaran_piutang", array(
            "invoice_no" => $invoice_no,
            "total_bill" => $bill,
            "created_by" => $this->session->userdata("id"),
            "flag" => 0
        ));
    }

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

    function get_supplier_with_hutang()
    {
        $where = "1";
        if ($this->session->role_code != "ROLE_SUPER_ADMIN") {
            $where = "t_purchase_order.branch_id = " . $this->session->branch_id;
        }
        return $this->db->query(
            "SELECT DISTINCT
                m_partner.*
            FROM m_partner
            LEFT JOIN m_partner_salesman mps on mps.partner_id = m_partner.id
            LEFT JOIN t_purchase_order on t_purchase_order.salesman_id = mps.id
            LEFT JOIN t_pembayaran_hutang tph on tph.invoice_no = t_purchase_order.purchase_order_no
            WHERE $where AND tph.flag = 0
            "
        );
    }

    function get_invoice_customer_with_piutang($supplier_id)
    {
        return $this->db->query(
            "SELECT 
                tpp.id,
                t_pos.id as pos_id,
                tpp.invoice_no,
                tpp.created_date,
                tpp.total_bill as total_tagihan

            FROM m_partner
            LEFT JOIN t_pos on t_pos.partner_id = m_partner.id
            LEFT JOIN t_pembayaran_piutang tpp on tpp.invoice_no = t_pos.invoice_no
            WHERE m_partner.id = $supplier_id AND tpp.flag = 0"
        );
    }

    function get_invoice_supplier_with_hutang($supplier_id)
    {
        return $this->db->query(
            "SELECT 
                tph.id,
                t_purchase_order.id as po_id,
                tph.invoice_no,
                tph.created_date,
                tph.total_bill as total_tagihan

            FROM m_partner
            LEFT JOIN m_partner_salesman mps on mps.partner_id = m_partner.id
            LEFT JOIN t_purchase_order on t_purchase_order.salesman_id = mps.id
            LEFT JOIN t_pembayaran_hutang tph on tph.invoice_no = t_purchase_order.purchase_order_no
            WHERE m_partner.id = $supplier_id AND tph.flag = 0"
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
                tpp.id,
                m_partner.name as partner_name

            FROM t_pembayaran_piutang tpp
            LEFT JOIN t_pos on tpp.invoice_no = t_pos.invoice_no
            LEFT JOIN m_partner on m_partner.id = t_pos.partner_id

            WHERE tpp.id = $tpp_id"
        )->row();
        $result->invoice_date = longdate_indo(date($result->invoice_date));
        $result->sisa_tagihan = str_replace(',', '', $result->sisa_tagihan);
        $result->sisa_tagihan_str = "Rp " . number_format($result->sisa_tagihan, 2, ',', '.');
        $result->total_tagihan = str_replace(',', '', $result->total_tagihan);
        $result->total_tagihan_str = "Rp " . number_format($result->total_tagihan, 2, ',', '.');
        return $result;
    }

    function get_hutang_data($tph_id)
    {
        $result = $this->db->query(
            "SELECT
                DATE(tph.created_date) as invoice_date,
                tph.total_bill as sisa_tagihan,
                tph.invoice_no,
                tph.id

            FROM t_pembayaran_hutang tph
            LEFT JOIN t_purchase_order on tph.invoice_no = t_purchase_order.purchase_order_no

            WHERE tph.id = $tph_id"
        )->row();
        $result->invoice_date = longdate_indo(date($result->invoice_date));
        $result->sisa_tagihan = str_replace(',', '', $result->sisa_tagihan);
        $result->sisa_tagihan_str = "Rp " . number_format($result->sisa_tagihan, 2, ',', '.');
        $result->total_tagihan = $this->db->query(
            "SELECT
                SUM(tpod.quantity * tpod.price * (1 - (tpod.discount / 100))) as total_tagihan
            FROM t_purchase_order_detail tpod
            LEFT JOIN t_purchase_order on t_purchase_order.id = tpod.purchase_order_id
            LEFT JOIN t_pembayaran_hutang tph on tph.invoice_no = t_purchase_order.purchase_order_no
            WHERE tph.id = '$tph_id'
            "
        )->row()->total_tagihan;
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

    public function get_neraca_saldo($periode = '2020-07', $type = 1)
    {
        $group = $type == 1 ? "SUBSTR(TRIM(acc_code),1,5)" : "SUBSTR(TRIM(acc_code),1,8)";

        return $this->db->query("SELECT t1.jurnal_no,SUBSTR(TRIM(t3.acc_code),1,5) acc_code_header,
        t3.acc_name acc_name_header,
                                    SUBSTR(TRIM(t2.acc_code),1,8)acc_code,t3.acc_name,
                                    sum(t2.debit)debit,sum(t2.debit) total_debit,
                                    sum(t2.credit) credit ,sum(t2.credit) total_credit ,
                                    IFNULL(t5.saldo_akhir,0) saldo_bln_lalu,
                                    ifnull(t3.position,'D') position,
                                    jurnal_date 
                                FROM t_jurnal t1 
                                JOIN t_jurnal_detail t2 ON t1.jurnal_no=t2.jurnal_no
                                LEFT JOIN m_account_code t3 ON TRIM(t2.acc_code)= trim(t3.acc_code)
                                LEFT JOIN t_neraca_saldo_akhir t5 ON substr(t5.acc_code,1,3)=TRIM(t2.acc_code)
                                WHERE DATE_FORMAT(jurnal_date,'%Y-%m')='$periode'
                                GROUP BY $group");
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

    function get_all_tax_no($branch_id)
    {
        return $this->db->get_where("tax_no", array(
            "branch_id" => $branch_id
        ));
    }

    function add_tax_no($data)
    {
        $this->db->insert("tax_no", $data);
    }

    function edit_tax_no($where, $data)
    {
        $this->db->update("tax_no", $data, $where);
    }

    function get_and_use_tax_no($branch_id)
    {
        $branch_target = $this->db->get_where("m_branch", array(
            "id" => $branch_id
        ))->row();
        
        if ($branch_target->tax_status == 0) {
            return null;
        }

        $query = $this->db->get_where("tax_no", array(
            "branch_id" => $branch_id,
            "flag" => 1
        ));
        if ($query->num_rows() == 0) {
            return null;
        } else {
            $focus = $query->row();
            $newnumber = $focus->sequence + 1;
            if ($newnumber == $focus->end_tax) {
                $this->db->query(
                    "UPDATE tax_no SET flag = 0, sequence = $newnumber WHERE id = $focus->id"
                );
            } else {
                $this->db->query(
                    "UPDATE tax_no SET sequence = $newnumber WHERE id = $focus->id"
                );
            }

            // 6 digit id branch
            $nomor_tax_to_use = sprintf("%06d", $branch_id);

            $nomor_tax_to_use .= "51";

            // 4 digit year
            $nomor_tax_to_use .= date("Y");

            // 2 digit month
            $nomor_tax_to_use .= date("m");

            // 6 digit nomor transaksi
            $nomor_tax_to_use .= sprintf("%06d", $newnumber);
            return $nomor_tax_to_use;
        }
    }

    function get_next_tax_no($branch_id)
    {
        $query = $this->db->get_where("tax_no", array(
            "branch_id" => $branch_id,
            "flag" => 1
        ));
        if ($query->num_rows() == 0) {
            return null;
        } else {
            $focus = $query->row();
            $newnumber = $focus->sequence + 1;

            // 6 digit id branch
            $nomor_tax_to_use = sprintf("%06d", $branch_id);

            $nomor_tax_to_use .= "51";

            // 4 digit year
            $nomor_tax_to_use .= date("Y");

            // 2 digit month
            $nomor_tax_to_use .= date("m");

            // 6 digit nomor transaksi
            $nomor_tax_to_use .= sprintf("%06d", $newnumber);
            return $nomor_tax_to_use;
        }
    }

    function get_statistik_pembayaran()
    {
        // get branch id
        $branch_id = $this->session->userdata("branch_id");

        // get all informasi pembayaran piutang
        $query1 = $this->db->query(
            "SELECT count(tpp.id) AS total_transaksi_dengan_piutang, SUM(tpp.total_bill) AS total_bill_piutang
            FROM t_pos
            LEFT JOIN t_pembayaran_piutang tpp on tpp.invoice_no = t_pos.invoice_no
            WHERE t_pos.branch_id = $branch_id AND tpp.flag = 0"
        )->row();

        $query2 = $this->db->query(
            "SELECT 
                count(t_jurnal.jurnal_no) as total_unregistered_jurnal
            FROM 
                t_jurnal

            LEFT JOIN t_pos ON t_pos.invoice_no = t_jurnal.invoice_no
            LEFT JOIN t_pembayaran_piutang tpp ON tpp.jurnal_no = t_jurnal.jurnal_no AND tpp.flag = 1

            WHERE t_jurnal.registered_flag = 'N' AND t_pos.branch_id = $branch_id"
        )->row();

        $query3 = $this->db->query(
            "SELECT 
                count(id) AS total_transaksi
            FROM t_pos
            WHERE t_pos.branch_id = $branch_id AND t_pos.flag = 10"
        )->row();

        $query4 = $this->db->query(
            "SELECT count(invoice_no) AS total_transaksi_lunas 
            FROM (
                SELECT DISTINCT t_pos.invoice_no
                FROM t_pos
                LEFT JOIN t_pembayaran_piutang tpp on tpp.invoice_no = t_pos.invoice_no
                WHERE 
                    t_pos.branch_id = $branch_id AND 
                    t_pos.flag = 10 AND
                    (
                        t_pos.payment_paid = t_pos.payment_total OR tpp.flag <> 0
                    )
                ) c
            WHERE invoice_no NOT IN (
                SELECT invoice_no
                FROM t_pembayaran_piutang tpp
                WHERE tpp.flag = 0
            )
            "
        )->row();

        // total transaksi lunas = yang langsung lunas + yang tidak ada tpp.flag = 0 lagi


        $data = array(
            "total_transaksi_dengan_piutang" => $query1->total_transaksi_dengan_piutang,
            "total_bill_piutang" => $query1->total_bill_piutang,
            "total_unregistered_jurnal" => $query2->total_unregistered_jurnal,
            "total_transaksi" => $query3->total_transaksi,
            "total_transaksi_lunas" => $query4->total_transaksi_lunas,
        );

        return $data;
    }

    function get_histori_pembayaran_piutang()
    {

        // get branch id
        $branch_id = $this->session->userdata("branch_id");

        $query0 = $this->db->query(
            "SELECT DISTINCT 
                m_partner.name as customer_name,
                m_partner.id as partner_id
            FROM t_pembayaran_piutang tpp
            LEFT JOIN t_pos on t_pos.invoice_no = tpp.invoice_no AND t_pos.branch_id = $branch_id
            LEFT JOIN m_partner on m_partner.id = t_pos.partner_id
            WHERE tpp.flag = 1
            "
        )->result();

        $resultdata = array();

        foreach ($query0 as $outerrow) {
            $query1 = $this->db->query(
                "SELECT DISTINCT 
                    tpp.invoice_no,
                    t_pos.id as pos_id
                FROM t_pembayaran_piutang tpp
                LEFT JOIN t_pos on t_pos.invoice_no = tpp.invoice_no AND t_pos.branch_id = $branch_id 
                WHERE t_pos.partner_id = $outerrow->partner_id AND tpp.flag = 1
                "
            )->result();

            $data = array();
            foreach ($query1 as $row) {
                $row->details = $this->db->query(
                    "SELECT 
                        tpp.total_bill,
                        tpp.payment,
                        tpp.payment_date,
                        tpp.created_date,
                        tpp.flag
                    FROM t_pembayaran_piutang tpp
                    WHERE invoice_no = $row->invoice_no AND tpp.flag = 1
                    "
                )->result();
                array_push($data, $row);
            }

            $outerrow->details = $data;

            array_push($resultdata, $outerrow);
        }


        return $resultdata;
    }

    function get_histori_pembayaran_hutang()
    {

        // get branch id
        $branch_id = $this->session->userdata("branch_id");

        $query0 = $this->db->query(
            "SELECT DISTINCT 
                m_partner.name as partner_name,
                m_partner.id as partner_id
            FROM t_pembayaran_hutang tph
            LEFT JOIN t_purchase_order on t_purchase_order.purchase_order_no = tph.invoice_no AND t_purchase_order.branch_id = $branch_id 
            LEFT JOIN m_partner_salesman mps on t_purchase_order.salesman_id = mps.id
            LEFT JOIN m_partner on mps.partner_id = m_partner.id
            WHERE tph.flag = 1
            "
        )->result();

        $resultdata = array();

        foreach ($query0 as $outerrow) {
            $query1 = $this->db->query(
                "SELECT DISTINCT 
                    tph.invoice_no,
                    t_purchase_order.id as po_id
                FROM t_pembayaran_hutang tph
                LEFT JOIN t_purchase_order on t_purchase_order.purchase_order_no = tph.invoice_no AND t_purchase_order.branch_id = $branch_id 
                LEFT JOIN m_partner_salesman mps on t_purchase_order.salesman_id = mps.id
                LEFT JOIN m_partner on mps.partner_id = m_partner.id
                WHERE m_partner.id = $outerrow->partner_id AND tph.flag = 1
                "
            )->result();

            $data = array();
            foreach ($query1 as $row) {
                $row->details = $this->db->query(
                    "SELECT 
                        tph.total_bill,
                        tph.payment,
                        tph.payment_date,
                        tph.created_date,
                        tph.flag
                    FROM t_pembayaran_hutang tph
                    WHERE invoice_no = $row->invoice_no AND tph.flag = 1
                    "
                )->result();
                array_push($data, $row);
            }

            $outerrow->details = $data;
            array_push($resultdata, $outerrow);
        }
        return $resultdata;
    }

    function get_histori_pembayaran_piutang_per_client()
    {

        // get branch id
        $branch_id = $this->session->userdata("branch_id");

        $query0 = $this->db->query(
            "SELECT DISTINCT 
                t_pos.partner_id,
                mp.name as partner_name
            FROM t_pos 
            LEFT JOIN m_partner mp on mp.id = t_pos.partner_id
            LEFT JOIN t_pembayaran_piutang tpp on tpp.invoice_no = t_pos.invoice_no
            WHERE t_pos.branch_id = $branch_id AND tpp.flag = 0"
        )->result();

        $data = array();

        foreach ($query0 as $partner) {
            $partner->details = $this->db->query(
                "SELECT DISTINCT
                    tpp.invoice_no,
                    t_pos.id as pos_id,
                    tpp.total_bill
                FROM t_pembayaran_piutang tpp
                LEFT JOIN t_pos on t_pos.invoice_no = tpp.invoice_no
                WHERE 
                    t_pos.partner_id = $partner->partner_id AND
                    tpp.flag = 0
                "
            )->result();
            array_push($data, $partner);
        }

        return $data;
    }

    function get_histori_pembayaran_hutang_per_client()
    {

        // get branch id
        $branch_id = $this->session->userdata("branch_id");

        $query0 = $this->db->query(
            "SELECT 
                m_partner.id as partner_id,
                m_partner.name as partner_name

            FROM m_partner
            LEFT JOIN m_partner_salesman mps on mps.partner_id = m_partner.id
            LEFT JOIN t_purchase_order on t_purchase_order.salesman_id = mps.id
            LEFT JOIN t_pembayaran_hutang tph on tph.invoice_no = t_purchase_order.purchase_order_no
            WHERE t_purchase_order.branch_id = $branch_id AND tph.flag = 0"
        )->result();

        $data = array();

        foreach ($query0 as $partner) {
            $partner->details = $this->db->query(
                "SELECT DISTINCT
                    t_purchase_order.id as po_id,
                    tph.invoice_no,
                    tph.total_bill

                FROM m_partner
                LEFT JOIN m_partner_salesman mps on mps.partner_id = m_partner.id
                LEFT JOIN t_purchase_order on t_purchase_order.salesman_id = mps.id
                LEFT JOIN t_pembayaran_hutang tph on tph.invoice_no = t_purchase_order.purchase_order_no
                WHERE m_partner.id = $partner->partner_id AND tph.flag = 0
                "
            )->result();
            array_push($data, $partner);
        }

        return $data;
    }

    function get_acc_code_header($where)
    {
        $this->db->select("acc_code,acc_name");
        $this->db->from("m_account_code");
        $this->db->where("acc_code", $where);
        return $this->db->get();
    }
}
