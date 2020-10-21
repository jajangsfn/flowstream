<?php

class Purchase_order_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("t_purchase_order", $where);
    }

    function get_all()
    {
        return $this->db->query(
            "SELECT 
            po.*,
            branch.name as branch_name, 
            salesman.name as salesman_name

            FROM purchase_order as po
            LEFT JOIN m_branch as branch on branch.id = po.branch_id
            LEFT JOIN m_salesman as salesman on salesman.id = po.salesman_id

            WHERE po.flag <> 99 
            "
        );
    }

    function insert($data)
    {
        $this->db->insert("t_purchase_order", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("t_purchase_order", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        return $this->update($where, array("flag" => 99));
    }

    function get_po_no()
    {
        $branch_id  = ($this->session->userdata('branch_id')) ? $this->session->userdata('branch_id')  : 1;

        $this->db->select_max('purchase_order_no');
        $this->db->where("branch_id", $branch_id);
        return $this->db->get("t_purchase_order");
    }

    function get_all_trx($where = null, $group_by = null)
    {
        
        // $this->db->select("tab4.id partner_id,tab4.name partner_name,tab1.*,
                                        
        //                 floor(  sum(
        //                                 (tab2.price* tab2.quantity) -  
        //                              (
        //                                 (tab2.price * tab2.quantity) * (ifnull(tab2.discount, 0)/100)
        //                               )
        //                             )
        //                     ) sum_trx
        //                     ,tab2.goods_id,tab5.barcode,tab5.brand_description goods_name,tab2.price goods_price,sum( `tab2`.`quantity`) goods_qty,ifnull(tab2.discount,0) goods_discount,tab5.plu_code,tab5.sku_code,tab6.name branch_name,
        //                     tab3.name salesman_name, tab2.id purchase_order_detail_id,tab5.sku_code,tab5.brand_name
        //                     ");
        // $this->db->from("t_purchase_order tab1");
        // $this->db->join("t_purchase_order_detail tab2", "tab2.purchase_order_id=tab1.id ");
        // $this->db->join("m_partner_salesman tab3", "tab3.id=tab1.salesman_id");
        // $this->db->join("m_partner tab4", "tab4.id=tab3.partner_id");
        // $this->db->join("m_goods tab5", "tab5.id=tab2.goods_id");
        // $this->db->join("m_branch tab6", "tab6.id=tab4.branch_id");
        // $this->db->where("tab2.flag<>99");

        $this->db->select("tab4.id partner_id,tab4.name partner_name,tab1.*,
                                        
                        floor(  sum(
                                        (tab2.price* tab2.quantity) -  
                                     (
                                        (tab2.price * tab2.quantity) * (ifnull(tab2.discount, 0)/100)
                                      )
                                    )
                            ) sum_trx
                            ,tab2.goods_id,tab5.barcode,tab5.brand_description goods_name,tab2.price goods_price,sum( `tab2`.`quantity`) goods_qty,ifnull(tab2.discount,0) goods_discount,tab5.plu_code,tab5.sku_code,tab6.name branch_name,tab3.name salesman_name, tab2.id purchase_order_detail_id,
                                ( sum(tab2.quantity) - ifnull(tab7.diterima, 0) )sisa,tab7.receiving_no,
                                tab5.sku_code,tab5.brand_name
                            ");
        $this->db->from("t_purchase_order tab1");
        $this->db->join("t_purchase_order_detail tab2", "tab2.purchase_order_id=tab1.id ");
        $this->db->join("m_partner_salesman tab3", "tab3.id=tab1.salesman_id");
        $this->db->join("m_partner tab4", "tab4.id=tab3.partner_id");
        $this->db->join("m_goods tab5", "tab5.id=tab2.goods_id");
        $this->db->join("m_branch tab6", "tab6.id=tab4.branch_id");
        $this->db->join("(SELECT tab1.purchase_order_id,tab2.*,sum(quantity) diterima,tab1.receiving_no 
                            FROM t_receiving tab1 
                            JOIN t_receiving_detail tab2 ON tab2.receiving_id=tab1.id
                            WHERE tab1.flag=2
                            GROUP BY tab1.id,tab1.purchase_order_id,tab2.goods_id) tab7", "tab7.purchase_order_id=tab1.id", "left");
        $this->db->where("tab2.flag<>99");
        if ($where) {
            $this->db->where($where);
        }



        if ($group_by) {
            $this->db->group_by($group_by);
        }

        $this->db->order_by("tab1.id desc,tab2.id");


        return $this->db->get();
    }


    function approve_po($where)
    {
        // Update 3 Oktober: masukan ke jurnal dan buat tagihan hutang

        // Preparation: ambil informasi PO, PO detail, dan load jurnal model
        // $this->load->model("T_jurnal_model", "jurnal");
        // $this->load->model("Keuangan_model", "keumod");
        $po = $this->db->get_where("t_purchase_order", $where)->row();
        $po->details = $this->db->query(
            "SELECT t_purchase_order_detail.*, m_goods.rekening_no
            FROM t_purchase_order_detail
            LEFT JOIN m_goods ON m_goods.id = t_purchase_order_detail.goods_id
            WHERE purchase_order_id = '$po->id'
            "
        )->result();

        // Step1: masukan ke jurnal

        // 1a. buat nomor jurnal
        // $jurnal_no_awal = $this->jurnal->get_next_jurnal_no($po->branch_id);

        // // 1b. buat detail jurnal untuk tiap barang
        // $dpp = 0;
        // foreach ($po->details as $po_detail) {
        //     $po_detail->total = ($po_detail->price * $po_detail->quantity * (100 - $po_detail->discount) / 100);
        //     $dpp += $po_detail->total;
        //     // buat detail jurnal untuk tiap barang
        //     $this->jurnal->insert_detail(
        //         array(
        //             "jurnal_no" => $jurnal_no_awal,
        //             "acc_code" => $po_detail->rekening_no,
        //             "invoice_no" => $po->purchase_order_no,
        //             "debit" => 0,
        //             "credit" => $po_detail->total,
        //         )
        //     );
        // }

        // 1c. buat detail jurnal untuk hutang
        // $this->jurnal->insert_detail_hutang(
        //     $po->branch_id,
        //     array(
        //         "jurnal_no" => $jurnal_no_awal,
        //         "invoice_no" => $po->purchase_order_no,
        //         "debit" => $dpp,
        //         "credit" => 0,
        //     )
        // );

        // 1d. buat jurnal
        // buat jurnal awal // TODO: infokan kalau nomor pajak sudah habis
        // $this->jurnal->insert(
        //     array(
        //         "jurnal_no" => $jurnal_no_awal,
        //         "branch_id" => $po->branch_id,
        //         "invoice_no" => $po->purchase_order_no,
        //         "jurnal_date" => date("Y-m-d"), // TODO: cek status tutup buku
        //         "kurs" => 1,
        //         "flag" => 1,
        //         "username" => $this->session->username,
        //         "created_date" => date("Y-m-d H:i:s"),
        //         "registered_flag" => "Y",
        //         "cara_penerimaan" => "CASH", // TODO: default cash, undefault?
        //         "dpp_ditanggung" => $dpp,
        //     )
        // ); 

        // 2. entry tagihan hutang
        // $this->keumod->entry_tagihan_hutang_baru($po->purchase_order_no, $dpp);

        $data['flag'] = 2;
        $this->db->where($where);
        return $this->db->update("t_purchase_order", $data);
    }

    function get_salesman($supplier_id)
    {
        $this->db->where("partner_id", $supplier_id);
        return $this->db->get("m_partner_salesman");
    }

    function get_all_po($supplier_id)
    {
        $this->db->select("tab1.*");
        $this->db->from("t_purchase_order tab1");
        $this->db->join("m_salesman tab2", "tab2.id = tab1.salesman_id");

        $this->db->where("tab2.partner_id", $supplier_id);

        return $this->db->get();
    }
}
