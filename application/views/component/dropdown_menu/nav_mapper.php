<?php
class NavItem
{
    public $identifier;
    public $unidentifier;
    public $url;
    public $title;
    public $icon;
    public $links;

    function __construct($identifier, $unidentifier, $url, $title, $icon, $links)
    {
        $this->identifier = $identifier;
        $this->unidentifier = $unidentifier;
        $this->url = $url;
        $this->title = $title;
        $this->icon = $icon;
        $this->links = $links;
    }
}

if (stripos(current_url(), "/index.php/dashboard")) {
    $nav = array(
        new NavItem(
            "/dashboard",
            null,
            "/index.php/dashboard",
            "Dashboard",
            "la-tachometer-alt",
            null
        ),
        new NavItem(
            "/penjualan",
            null,
            "/index.php/penjualan",
            "Penjualan",
            null,
            null
        ),
        new NavItem(
            "/pembelian",
            null,
            "/index.php/pembelian",
            "Pembelian",
            null,
            null
        ),
        new NavItem(
            "/inventori",
            null,
            "/index.php/inventori",
            "Inventori",
            null,
            null
        ),
        new NavItem(
            "/keuangan",
            null,
            "/index.php/keuangan",
            "Keuangan",
            null,
            null
        ),
        new NavItem(
            "/setting",
            null,
            "/index.php/setting",
            "Setting dan Konfigurasi",
            null,
            null
        ),
    );
} else if (stripos(current_url(), "/index.php/penjualan")) {
    $nav = array(
        new NavItem(
            "/index.php/penjualan/order_request",
            null,
            "/index.php/penjualan/order_request",
            "Order Request",
            null,
            null
        ),
        new NavItem(
            "/index.php/penjualan/pos",
            null,
            "/index.php/penjualan/pos",
            "Point of Sales (POS)",
            null,
            null
        ),
        new NavItem(
            "/index.php/penjualan/retur",
            null,
            "/index.php/penjualan/retur",
            "Retur Penjualan",
            null,
            null
        ),
        new NavItem(
            "/index.php/penjualan/laporan",
            null,
            null,
            "Laporan",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    null,
                    "Laporan Penjualan",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/penjualan/laporan/penjualan/harian",
                            "Laporan Harian",
                            null,
                            null
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/penjualan/laporan/penjualan/bulanan",
                            "Laporan Bulanan",
                            null,
                            null
                        ),
                    )
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Laporan Retur",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/penjualan/laporan/retur/harian",
                            "Laporan Harian",
                            null,
                            null
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/penjualan/laporan/retur/bulanan",
                            "Laporan Bulanan",
                            null,
                            null
                        ),
                    )
                )
            )
        )
    );
} else if (stripos(current_url(), "/index.php/pembelian")) {
    $nav = array(
        new NavItem(
            "/index.php/pembelian/purchase_order",
            null,
            "/index.php/pembelian/purchase_order",
            "Purchase Order",
            null,
            null
        ),
        new NavItem(
            "/index.php/pembelian/retur",
            null,
            "/index.php/pembelian/retur",
            "Retur Pembelian",
            null,
            null
        ),
        new NavItem(
            "/index.php/pembelian/laporan",
            null,
            null,
            "Laporan",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    null,
                    "Laporan Pembelian",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/pembelian/laporan/pembelian/harian",
                            "Laporan Harian",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/pembelian/laporan/pembelian/bulanan",
                            "Laporan Bulanan",
                            null,
                            null,
                        ),
                    ),
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Laporan Retur",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/pembelian/laporan/retur/harian",
                            "Laporan Harian",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/pembelian/laporan/retur/bulanan",
                            "Laporan Bulanan",
                            null,
                            null,
                        ),
                    ),
                ),

            )
        ),
    );
} else if (stripos(current_url(), "/index.php/inventori")) {
    $nav = array(
        new NavItem(
            null,
            null,
            "/index.php/inventori/receiving",
            "Receiving",
            null,
            null,
        ),
        new NavItem(
            null,
            null,
            "/index.php/inventori/gudang",
            "Gudang",
            null,
            null,
        ),
        new NavItem(
            null,
            null,
            null,
            "Laporan",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    null,
                    "Laporan Receiving",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/inventori/laporan/receiving/harian",
                            "Laporan Harian",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/inventori/laporan/receiving/bulanan",
                            "Laporan Bulanan",
                            null,
                            null,
                        ),
                    ),
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Laporan Gudang",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/inventori/laporan/gudang/harian",
                            "Laporan Harian",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/inventori/laporan/gudang/bulanan",
                            "Laporan Bulanan",
                            null,
                            null,
                        ),
                    ),
                ),
            ),
        ),
    );
} else if (stripos(current_url(), "/index.php/keuangan") && !stripos(current_url(), "/index.php/setting")) {
    $nav = array(
        new NavItem(
            null,
            null,
            null,
            "Registrasi",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/registrasi/register_jurnal",
                    "Register Jurnal",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/registrasi/list_jurnal",
                    "List Jurnal",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/registrasi/cetak_ulang_jurnal",
                    "Cetak Ulang Jurnal",
                    null,
                    null,
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Pembayaran",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/pembayaran/piutang",
                    "Pembayaran Piutang",
                    null,
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/pembayaran/hutang",
                    "Pembayaran Hutang",
                    null,
                    null
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Jurnal",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/jurnal_kas_masuk",
                    "Jurnal Kas Masuk (JKM)",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/jurnal_kas_keluar",
                    "Jurnal Kas Keluar (JKK)",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/jurnal_rupa_rupa",
                    "Jurnal Rupa-rupa (JRR)",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/antar_buku_bantu",
                    "Antar Buku Bantu (ABB)",
                    null,
                    null,
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Koreksi",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/koreksi/koreksi_kantor_cabang",
                    "Koreksi Kantor Cabang (KKC)",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/koreksi/koreksi_kantor_pusat",
                    "Koreksi Kantor Pusat (KKP)",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/koreksi/koreksi_akuntan_publik",
                    "Koreksi Akuntan Publik (KAP)",
                    null,
                    null,
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Tutup Buku",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/tutup_buku/bulanan",
                    "Tutup Buku Bulanan",
                    null,
                    array(),
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/tutup_buku/status",
                    "Status Tutup Buku",
                    null,
                    array(),
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Report",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    null,
                    "Report Harian",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/harian/mutasi_harian_kas_bank",
                            "Mutasi Harian Kas Bank",
                            null,
                            array(),
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/harian/mutasi_jurnal_harian",
                            "Mutasi Jurnal Harian",
                            null,
                            array(),
                        ),
                    ),
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Report Bulanan",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/bulanan/neraca_saldo",
                            "Neraca Saldo",
                            null,
                            array(),
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/bulanan/faktur_pajak_harian",
                            "Faktur Pajak Harian",
                            null,
                            array(),
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/bulanan/laba_rugi",
                            "Laba Rugi",
                            null,
                            array(),
                        ),
                    ),
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Ikhtisar",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/report/ikhtisar/buku_besar",
                    "Ikhtisar Buku Besar",
                    null,
                    array(),
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/report/ikhtisar/pajak",
                    "Ikhtisar Pajak",
                    null,
                    array(),
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/report/ikhtisar/pendapatan",
                    "Ikhtisar Pendapatan",
                    null,
                    array(),
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/report/ikhtisar/pembelian",
                    "Ikhtisar Pembelian",
                    null,
                    array(),
                ),
            ),
        ),
        new NavItem(
            null,
            null,
            null,
            "Aging",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/report/aging/piutang",
                    "Aging Piutang",
                    null,
                    array(),
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/report/aging/hutang",
                    "Aging Hutang",
                    null,
                    array(),
                ),
            ),
        ),
    );
} else if (stripos(current_url(), "/index.php/setting")) {
    $nav = array(
        new NavItem(
            "/user",
            null,
            null,
            "User",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/user/user_management",
                    "User Management",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/user/role_management",
                    "User Role",
                    null,
                    null,
                ),
            ),
        ),
        new NavItem(
            "/master",
            null,
            null,
            "Master",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/master/barang",
                    "Master Barang",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/master/supplier",
                    "Master Supplier",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/master/customer",
                    "Master Customer",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/master/gudang",
                    "Master Gudang",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/master/discount",
                    "Master Discount",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Master Keuangan",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/kode_rekening",
                            "Kode Rekening",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/kode_jenis_biaya",
                            "Kode Jenis Biaya",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/mata_uang",
                            "Mata Uang",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/sumber_dana",
                            "Sumber Dana",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/tipe_jurnal",
                            "Tipe Jurnal",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/pembagian_laba_rugi",
                            "Pembagian Laba Rugi",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/ikhtisar_kode_rekening",
                            "Ikhtisar Kode Rekening",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/aging_kode_rekening",
                            "Aging Kode Rekening",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/kelompok_rekening",
                            "Kelompok Rekening",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/master/keuangan/kelompok_jenis_biaya",
                            "Kelompok Jenis Biaya",
                            null,
                            null,
                        ),
                    ),
                ),
            ),
        ),
        new NavItem(
            "/parameter",
            null,
            null,
            "Parameter",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/parameter/pembelian",
                    "Parameter Pembelian",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/parameter/penjualan",
                    "Parameter Penjualan",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/parameter/barang",
                    "Parameter Barang",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/setting/parameter/inventori",
                    "Parameter Inventori",
                    null,
                    null,
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Parameter Keuangan",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/parameter/keuangan/master",
                            "Parameter Master",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/parameter/keuangan/akuntansi",
                            "Parameter Akuntansi",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/parameter/keuangan/kode_rekening",
                            "Parameter Kode Rekening",
                            null,
                            null,
                        )
                    ),
                ),
            ),
        ),
        new NavItem(
            "/system",
            null,
            null,
            "System",
            null,
            array(
                new NavItem(
                    null,
                    null,
                    null,
                    "Group S",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/s_reference",
                            "s_reference",
                            null,
                            null,
                        ),
                    ),
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Group M",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_unit",
                            "m_unit",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_branch",
                            "m_branch",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_master",
                            "m_master",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_partner",
                            "m_partner",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_salesman",
                            "m_salesman",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_salesman_map",
                            "m_salesman_map",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_event",
                            "m_event",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_promo",
                            "m_promo",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_delivery",
                            "m_delivery",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/m_map",
                            "m_map",
                            null,
                            null,
                        ),
                    ),
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Group Ol",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/ol_connection",
                            "ol_connection",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/ol_group",
                            "ol_group",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/ol_group_detail",
                            "ol_group_detail",
                            null,
                            null,
                        ),
                    ),
                ),
                new NavItem(
                    null,
                    null,
                    null,
                    "Ungrouped",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/production",
                            "production",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/production_detail",
                            "production_detail",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/delivery_order",
                            "delivery_order",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/delivery_team",
                            "delivery_team",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/delivery_cost",
                            "delivery_cost",
                            null,
                            null,
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/setting/system/purchase_order_parameter",
                            "purchase_order_parameter",
                            null,
                            null,
                        ),
                    ),
                ),
            )
        )
    );
}

if (isset($nav)) {
    foreach ($nav as $navitem) {
        echo $this->load->view("component/dropdown_menu/nav_item", array("nav_data" => $navitem), true);
    }
}
