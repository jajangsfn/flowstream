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

    // TODO: Konfirmasi JOURNAL_CD = P untuk Purchase
    function insert_detail_hutang($branch_id, $data)
    {
        // lihat account code untuk credit hutang
        if ($data['credit'] == 0) {
            $data['acc_code'] = $this->db->get_where(
                "m_journal_mapping",
                array(
                    "JOURNAL_CD" => "P",
                    "SEQ_LINE" => 1,
                    "BRANCH_ID" => $branch_id
                )
            )->row()->ACCOUNT_CODE;
        } else {
            $data['acc_code'] = $this->db->get_where(
                "m_journal_mapping",
                array(
                    "JOURNAL_CD" => "P",
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

        // IMPORTANT: Check t_monthly_report_status, jika untuk bulan ini sudah ada, infokan "periode sudah ditutup"
        $query_t_monthly_report_status = $this->db->query(
            "SELECT * FROM t_monthly_report_status WHERE periode = LAST_DAY('$periode-01')"
        );

        if ($query_t_monthly_report_status->num_rows() > 0) {
            $toreturn['message'] = $query_t_monthly_report_status->row();
        }

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

        // Untuk jurnal yang belum diregister
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

        // periode untuk tabel
        $periode_data_bulan_ini = $periode_array[1] . "-" . $periode_array[0];

        // Entry t_neraca_saldo_akhir
        $this->db->query(
            "INSERT 
                INTO `t_neraca_saldo_akhir`
                
                (`id`, `acc_code`, `periode`, `saldo_bln_lalu`, `debit`, `credit`, `saldo_akhir`, `pos`, `f`, `created_date`, `branch_id`, `updated_date`) 
            
                    SELECT 
                        null as id,
                        LEFT(t_jurnal_detail.acc_code, 3) as acc_code,
                        '$periode_data_bulan_ini' as periode,
                        CASE
                            when t_neraca_saldo_akhir.saldo_akhir is null
                            then 0
                            else t_neraca_saldo_akhir.saldo_akhir
                        END as saldo_bln_lalu,
                        SUM(t_jurnal_detail.debit) as debit,
                        SUM(t_jurnal_detail.credit) as credit,
                        CASE
                            when m_account_code.position = 'K'
                            then 
                                CASE
                                    when t_neraca_saldo_akhir.saldo_akhir is null
                                    then SUM(t_jurnal_detail.credit) - SUM(t_jurnal_detail.debit)
                                    else t_neraca_saldo_akhir.saldo_akhir + SUM(t_jurnal_detail.credit) - SUM(t_jurnal_detail.debit)
                                END
                            else 
                                CASE
                                    when t_neraca_saldo_akhir.saldo_akhir is null
                                    then SUM(t_jurnal_detail.debit) - SUM(t_jurnal_detail.credit)
                                    else t_neraca_saldo_akhir.saldo_akhir + SUM(t_jurnal_detail.debit) - SUM(t_jurnal_detail.credit)
                                END
                        END as saldo_akhir,
                        m_account_code.position as pos,
                        null as f,
                        current_timestamp() as created_date,
                        '$branch_id' as branch_id,
                        null as updated_date
                    FROM t_jurnal_detail

                    LEFT JOIN t_jurnal on t_jurnal.jurnal_no = t_jurnal_detail.jurnal_no
                    LEFT JOIN m_account_code on m_account_code.acc_code = LEFT(t_jurnal_detail.acc_code, 3)
                    LEFT JOIN t_neraca_saldo_akhir on t_neraca_saldo_akhir.acc_code = LEFT(t_jurnal_detail.acc_code, 3)

                    WHERE 
                        t_jurnal.jurnal_date like '$periode-%'
                        AND t_jurnal.branch_id = $branch_id
                        AND t_jurnal.registered_flag = 'Y'
                        AND t_jurnal.flag <> 10
                        AND (t_neraca_saldo_akhir.periode = '$periode_data_bulan_lalu' OR t_neraca_saldo_akhir.periode is null)
                        AND (t_neraca_saldo_akhir.branch_id = $branch_id OR t_neraca_saldo_akhir.branch_id is null)

                    GROUP BY LEFT(t_jurnal_detail.acc_code, 3)
                    ORDER BY LEFT(t_jurnal_detail.acc_code, 3) asc
            "
        );

        // Entry t_ikhtisar_saldo
        $this->db->query(
            "INSERT 
                INTO `t_ikhtisar_saldo`
                
                (`id`, `acc_code`, `periode`, `saldo_bln_lalu`, `debit`, `credit`, `saldo_akhir`, `pos`, `f`, `created_date`, `branch_id`, `updated_date`) 
            
                    SELECT 
                        null as id,
                        LEFT(t_jurnal_detail.acc_code, 6) as acc_code,
                        '$periode_data_bulan_ini' as periode,
                        CASE
                            when t_ikhtisar_saldo.saldo_akhir is null
                            then 0
                            else t_ikhtisar_saldo.saldo_akhir
                        END as saldo_bln_lalu,
                        SUM(t_jurnal_detail.debit) as debit,
                        SUM(t_jurnal_detail.credit) as credit,
                        CASE
                            when m_account_code.position = 'K'
                            then 
                                CASE
                                    when t_ikhtisar_saldo.saldo_akhir is null
                                    then SUM(t_jurnal_detail.credit) - SUM(t_jurnal_detail.debit)
                                    else t_ikhtisar_saldo.saldo_akhir + SUM(t_jurnal_detail.credit) - SUM(t_jurnal_detail.debit)
                                END
                            else 
                                CASE
                                    when t_ikhtisar_saldo.saldo_akhir is null
                                    then SUM(t_jurnal_detail.debit) - SUM(t_jurnal_detail.credit)
                                    else t_ikhtisar_saldo.saldo_akhir + SUM(t_jurnal_detail.debit) - SUM(t_jurnal_detail.credit)
                                END
                        END as saldo_akhir,
                        m_account_code.position as pos,
                        null as f,
                        current_timestamp() as created_date,
                        '$branch_id' as branch_id,
                        null as updated_date
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
                        AND (t_ikhtisar_saldo.branch_id = $branch_id OR t_ikhtisar_saldo.branch_id is null)

                    GROUP BY LEFT(t_jurnal_detail.acc_code, 6)
                    ORDER BY LEFT(t_jurnal_detail.acc_code, 6) asc
            "
        );

        // Entry t_kode_rekening_saldo
        $this->db->query(
            "INSERT 
                INTO `t_kode_rekening_saldo`
                
                (`id`, `acc_code`, `periode`, `saldo_bln_lalu`, `debit`, `credit`, `saldo_akhir`, `pos`, `f`, `created_date`, `branch_id`, `updated_date`) 
            
                    SELECT 
                        null as id,
                        t_jurnal_detail.acc_code,
                        '$periode_data_bulan_ini' as periode,
                        CASE
                            when t_kode_rekening_saldo.saldo_akhir is null
                            then 0
                            else t_kode_rekening_saldo.saldo_akhir
                        END as saldo_bln_lalu,
                        SUM(t_jurnal_detail.debit) as debit,
                        SUM(t_jurnal_detail.credit) as credit,
                        CASE
                            when m_account_code.position = 'K'
                            then 
                                CASE
                                    when t_kode_rekening_saldo.saldo_akhir is null
                                    then SUM(t_jurnal_detail.credit) - SUM(t_jurnal_detail.debit)
                                    else t_kode_rekening_saldo.saldo_akhir + SUM(t_jurnal_detail.credit) - SUM(t_jurnal_detail.debit)
                                END
                            else 
                                CASE
                                    when t_kode_rekening_saldo.saldo_akhir is null
                                    then SUM(t_jurnal_detail.debit) - SUM(t_jurnal_detail.credit)
                                    else t_kode_rekening_saldo.saldo_akhir + SUM(t_jurnal_detail.debit) - SUM(t_jurnal_detail.credit)
                                END
                        END as saldo_akhir,
                        m_account_code.position as pos,
                        null as f,
                        current_timestamp() as created_date,
                        '$branch_id' as branch_id,
                        null as updated_date
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
                        AND (t_kode_rekening_saldo.branch_id = $branch_id OR t_kode_rekening_saldo.branch_id is null)

                    GROUP BY t_jurnal_detail.acc_code
                    ORDER BY t_jurnal_detail.acc_code asc
            "
        );


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
    }
}
