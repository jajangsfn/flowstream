<?php

class T_jurnal_model extends CI_Model
{

    function insert($data)
    {
        $this->db->insert("t_jurnal", $data);
    }

    function insert_detail($data)
    {
        $this->db->insert("t_jurnal_detail", $data);
    }

    function delete($where)
    {
        $this->db->update("t_jurnal", array("flag" => 99), $where);
    }

    function delete_detail($where)
    {
        $this->db->delete("t_jurnal_detail", $where);
    }

    function update($where, $data)
    {
        $this->db->update("t_jurnal", $data, $where);
    }

    function get($where)
    {
        $this->db->select("*");
        $this->db->from("t_jurnal");
        $this->db->where($where);
        return $this->db->get();
    }

    function get_next_jurnal_no($branch_id)
    {
        $this->db->select("jurnal_no");
        $this->db->from("t_jurnal");

        // 6 digit id branch
        $nomor_jurnal = sprintf("%06d", $branch_id);

        // 2 digit transaction code: TODO: konfirmasi 51
        $nomor_jurnal .= "51";

        // 4 digit year
        $nomor_jurnal .= date("Y");

        // 2 digit month
        $nomor_jurnal .= date("m");


        // 6 digit transaction incremental

        $where['jurnal_no like'] = "$nomor_jurnal%";
        $this->db->where($where);
        $this->db->order_by("jurnal_no desc");
        $this->db->limit(1);

        $q_result = $this->db->get();
        if ($q_result->num_rows()) {
            $curr_jurnal_no = $q_result->row()->jurnal_no;
            $curr_jurnal_no = intval($curr_jurnal_no);
            $curr_jurnal_no++;

            $curr_jurnal_no = sprintf('%020d', $curr_jurnal_no);
        } else {
            $curr_jurnal_no = $nomor_jurnal . "000001";
        }
        return $curr_jurnal_no;
    }

    function insert_detail_piutang($branch_id, $data)
    {
        // lihat account code untuk debit piutang
        if ($data['credit'] == 0) {
            $data['acc_code'] = $this->db->get_where(
                "m_journal_mapping",
                array(
                    "JOURNAL_CD" => "POS",
                    "SEQ_LINE" => 1,
                    "BRANCH_ID" => $branch_id
                )
            )->row()->ACCOUNT_CODE;
        } else {
            $data['acc_code'] = $this->db->get_where(
                "m_journal_mapping",
                array(
                    "JOURNAL_CD" => "POS",
                    "SEQ_LINE" => 2,
                    "BRANCH_ID" => $branch_id
                )
            )->row()->ACCOUNT_CODE;
        }

        $this->insert_detail($data);
    }

    function insert_detail_kas($branch_id, $data)
    {
        if ($data['credit'] == 0) {
            $queried =  $this->db->get_where(
                "m_journal_mapping",
                array(
                    "JOURNAL_CD" => "KAS",
                    "SEQ_LINE" => 1,
                    "BRANCH_ID" => $branch_id
                )
            );
        } else {
            $queried =  $this->db->get_where(
                "m_journal_mapping",
                array(
                    "JOURNAL_CD" => "KAS",
                    "SEQ_LINE" => 2,
                    "BRANCH_ID" => $branch_id
                )
            );
        }
        if ($queried->num_rows()) {
            $data['acc_code'] = $queried->row()->ACCOUNT_CODE;
        } else {
            $data['acc_code'] = $this->db->get_where(
                "m_account_code",
                array(
                    "LOWER(acc_name)" => "kas",
                    "branch_id" => $branch_id
                )
            )->row()->acc_code;
        }

        $this->insert_detail($data);
    }

    public function get_unregistered_jurnal($where)
    {
        return $this->db->query(
            "SELECT 
                t_jurnal.jurnal_no, 
                t_jurnal.invoice_no, 
                t_jurnal.jurnal_date, 
                tpp.payment,
                case
                    when tpp.id = null
                    then 'Pembayaran Hutang'
                    else 'Pembayaran Piutang'
                end as tipe,
                t_pos.id as pos_id
            
            FROM 
                t_jurnal

            LEFT JOIN t_pos ON t_pos.invoice_no = t_jurnal.invoice_no
            LEFT JOIN t_pembayaran_piutang tpp ON tpp.jurnal_no = t_jurnal.jurnal_no AND tpp.flag = 1

            WHERE
                t_jurnal.registered_flag = 'N'
            "
        );
    }

    public function register($jurnal_no)
    {
        $user = $this->session->userdata("id");
        $this->db->query(
            "UPDATE t_jurnal 
            SET registered_flag = 'Y', 
                registered_date = NOW(),
                registered_user = $user
            WHERE jurnal_no = $jurnal_no"
        );
    }

    public function get_earliest_year_for_branch_id($branch_id)
    {
        return $this->db->query(
            "SELECT
                YEAR(jurnal_date) as earliest_year
            FROM t_jurnal
            WHERE branch_id = $branch_id
            ORDER BY jurnal_date asc
            LIMIT 1"
        );
    }

    public function preview_tutup_buku($branch_id, $periode)
    {
        // Periode = YYYY-MM
        $periode_array = explode("-", $periode);

        // periode array 0 = tahun
        // periode array 1 = bulan

        // Jika bulan januari, periode sebelumnya adalah tahun sebelumnya, bulan akhir
        if (intval($periode_array[1]) == 1) {
            $periode_data_bulan_lalu = "12-" . (intval($periode_array[0]) - 1);
        } else {
            $periode_data_bulan_lalu = (intval($periode_array[1]) - 1) . "-" . $periode_array[0];
        }

        // TODO: cek t_neraca_saldo_akhir
        // TODO: cek t_ikhtisar_saldo
        // TODO: cek t_kode_rekenin_saldo
        // TODO: cek m_parameter_neraca_saldo
        // TODO: cek m_parameter_ikhtisar_saldo
        // TODO: cek m_parameter_kode_rekenin_saldo

        // Get semua jurnal detail, kelompokan berdasarkan kode rekening, sum debit dan kredit, where periode dan branch
        $kode_rekening_saldo_bulan = $this->db->query(
            "SELECT 
                t_jurnal_detail.acc_code,
                m_account_code.acc_name,
                t_kode_rekening_saldo.saldo_akhir as saldo_bulan_lalu,
                SUM(t_jurnal_detail.debit) as debit,
                SUM(t_jurnal_detail.credit) as credit,
                m_account_code.position as sum_position

            FROM t_jurnal_detail

            LEFT JOIN t_jurnal on t_jurnal.jurnal_no = t_jurnal_detail.jurnal_no
            LEFT JOIN m_account_code on m_account_code.acc_code = t_jurnal_detail.acc_code
            LEFT JOIN t_kode_rekening_saldo on t_kode_rekening_saldo.acc_code = t_jurnal_detail.acc_code

            WHERE 
                t_jurnal.jurnal_date like '$periode-%'
                AND t_jurnal.branch_id = $branch_id
                AND t_jurnal.registered_flag = 'Y'
                AND t_jurnal.flag <> 10
                AND (t_kode_rekening_saldo.periode = '$periode_data_bulan_lalu' OR t_kode_rekening_saldo.periode is null)
                AND (t_kode_rekening_saldo.branch_id = '$branch_id' OR t_kode_rekening_saldo.branch_id is null)

            GROUP BY t_jurnal_detail.acc_code
            ORDER BY t_jurnal_detail.acc_code asc
            "
        );

        $toreturn["kode_rekening_saldo"] = $kode_rekening_saldo_bulan->result();

        // Get semua jurnal detail, kelompokan berdasarkan 6 digit awal kode rekening, sum debit dan kredit, where periode dan branch
        $ikhtisar_saldo_bulan = $this->db->query(
            "SELECT 
                LEFT(t_jurnal_detail.acc_code, 6) as acc_code_ikhtisar,
                m_account_code.acc_name,
                t_ikhtisar_saldo.saldo_akhir as saldo_bulan_lalu,
                SUM(t_jurnal_detail.debit) as debit,
                SUM(t_jurnal_detail.credit) as credit,
                m_account_code.position as sum_position

            FROM t_jurnal_detail

            LEFT JOIN t_jurnal on t_jurnal.jurnal_no = t_jurnal_detail.jurnal_no
            LEFT JOIN m_account_code on m_account_code.acc_code = LEFT(t_jurnal_detail.acc_code, 6)
            LEFT JOIN t_ikhtisar_saldo on t_ikhtisar_saldo.acc_code = LEFT(t_jurnal_detail.acc_code, 6)

            WHERE 
                t_jurnal.jurnal_date like '$periode-%'
                AND t_jurnal.branch_id = $branch_id
                AND t_jurnal.registered_flag = 'Y'
                AND t_jurnal.flag <> 10
                AND (t_ikhtisar_saldo.periode = '$periode_data_bulan_lalu' OR t_ikhtisar_saldo.periode is null)
                AND (t_ikhtisar_saldo.branch_id = '$branch_id' OR t_ikhtisar_saldo.branch_id is null)

            GROUP BY acc_code_ikhtisar
            ORDER BY acc_code_ikhtisar asc
            "
        );

        $toreturn["ikhtisar_saldo"] = $ikhtisar_saldo_bulan->result();

        // Get semua jurnal detail, kelompokan berdasarkan 3 digit awal kode rekening, sum debit dan kredit, where periode dan branch
        $neraca_saldo_bulan = $this->db->query(
            "SELECT 
                LEFT(t_jurnal_detail.acc_code, 3) as acc_code_neraca,
                m_account_code.acc_name,
                t_neraca_saldo_akhir.saldo_akhir as saldo_bulan_lalu,
                SUM(t_jurnal_detail.debit) as debit,
                SUM(t_jurnal_detail.credit) as credit,
                m_account_code.position as sum_position

            FROM t_jurnal_detail

            LEFT JOIN t_jurnal on t_jurnal.jurnal_no = t_jurnal_detail.jurnal_no
            LEFT JOIN m_account_code on m_account_code.acc_code = LEFT(t_jurnal_detail.acc_code, 3)
            LEFT JOIN t_neraca_saldo_akhir on t_neraca_saldo_akhir.acc_code = LEFT(t_jurnal_detail.acc_code, 3)

            WHERE 
                t_jurnal.jurnal_date like '$periode-%'
                AND t_jurnal.branch_id = $branch_id
                AND t_jurnal.registered_flag = 'Y'
                AND t_jurnal.flag <> 10
                AND ( t_neraca_saldo_akhir.periode = '$periode_data_bulan_lalu' OR t_neraca_saldo_akhir.periode is null ) 
                AND ( t_neraca_saldo_akhir.branch_id = '$branch_id' OR t_neraca_saldo_akhir.branch_id is null ) 

            GROUP BY acc_code_neraca
            ORDER BY acc_code_neraca asc
            "
        );

        $toreturn["neraca_saldo"] = $neraca_saldo_bulan->result();


        $unregistered_jurnal = $this->db->query(
            "SELECT 
                t_jurnal.jurnal_no, 
                t_jurnal.invoice_no, 
                t_jurnal.jurnal_date, 
                tpp.payment,
                case
                    when tpp.id = null
                    then 'Pembayaran Hutang'
                    else 'Pembayaran Piutang'
                end as tipe,
                t_pos.id as pos_id
            
            FROM 
                t_jurnal

            LEFT JOIN t_pos ON t_pos.invoice_no = t_jurnal.invoice_no
            LEFT JOIN t_pembayaran_piutang tpp ON tpp.jurnal_no = t_jurnal.jurnal_no AND tpp.flag = 1

            WHERE
                t_jurnal.registered_flag = 'N'
                AND t_jurnal.jurnal_date like '$periode-%'
                AND t_jurnal.branch_id = $branch_id
                AND t_jurnal.flag <> 10
            "
        );

        $toreturn["unregistered_jurnal"] = $unregistered_jurnal->result();

        return $toreturn;
    }

    public function tutup_buku($branch_id, $periode)
    {
        // Update semua jurnal statusnya jadi sudah ditutup (flag = 10)
        $this->db->query(
            "UPDATE t_jurnal
            SET flag = 10 
            WHERE
                t_jurnal.registered_flag = 'Y'
                AND t_jurnal.jurnal_date like '$periode-%'
                AND t_jurnal.branch_id = $branch_id
            "
        );

        // Entry untuk t_monthly_report_status
        $user = $this->session->userdata("id");
        $this->db->query(
            "INSERT INTO `t_monthly_report_status` 
            (`id`, `branch_id`, `periode`, `ready_to_generate`, `created_date`, `created_by`) 
            VALUES 
            (NULL, '$branch_id', LAST_DAY('$periode-01'), NULL, current_timestamp(), '$user')
            "
        );

        // TODO: Masukkan ke t_neraca_saldo_akhir
        // TODO: Masukkan ke t_ikhtisar_saldo
        // TODO: Masukkan ke t_kode_rekenin_saldo
    }
}
