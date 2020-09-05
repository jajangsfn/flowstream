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
        $this->db->query(
            "UPDATE t_jurnal SET registered_flag = 'Y' WHERE jurnal_no = $jurnal_no"
        );
    }
}
