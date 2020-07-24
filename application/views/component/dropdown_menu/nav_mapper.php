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
            $this->lang->line('menu_dashboard'),
            "la-tachometer-alt",
            null
        )
    );
} else if (stripos(current_url(), "/index.php/penjualan")) {
    $nav = array(
        new NavItem(
            "/index.php/penjualan/home",
            null,
            "/index.php/penjualan/home",
            "Penjualan",
            null,
            null
        ),
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
            "/index.php/penjualan/return",
            null,
            "/index.php/penjualan/return",
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
            "/index.php/pembelian/return",
            null,
            "/index.php/pembelian/return",
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
                            null
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/pembelian/laporan/pembelian/bulanan",
                            "Laporan Bulanan",
                            null,
                            null
                        )
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
                            "/index.php/pembelian/laporan/retur/harian",
                            "Laporan Harian",
                            null,
                            null
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/pembelian/laporan/retur/bulanan",
                            "Laporan Bulanan",
                            null,
                            null
                        )
                    )
                )
            )
        )
    );
} else if (stripos(current_url(), "/index.php/inventori")) {
    $nav = array(
        new NavItem(
            null,
            null,
            "/index.php/inventori/receiving",
            "Receiving",
            null,
            null
        ),
        new NavItem(
            null,
            null,
            "/index.php/inventori/gudang",
            "Gudang",
            null,
            null
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
                            null
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/inventori/laporan/receiving/bulanan",
                            "Laporan Bulanan",
                            null,
                            null
                        )
                    )
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
                            null
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/inventori/laporan/gudang/bulanan",
                            "Laporan Bulanan",
                            null,
                            null
                        )
                    )
                )
            )
        )
    );
} else if (stripos(current_url(), "/index.php/keuangan") && !stripos(current_url(), "/index.php/setting")) {
    $nav = array(
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
                )
            )
        ),
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
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/registrasi/list_jurnal",
                    "List Jurnal",
                    null,
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/registrasi/cetak_ulang_jurnal",
                    "Cetak Ulang Jurnal",
                    null,
                    null
                )
            )
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
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/tutup_buku/status",
                    "Status Tutup Buku",
                    null,
                    null
                )
            )
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
                    "Ikhtisar",
                    null,
                    array(
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/ikhtisar/buku_besar",
                            "Ikhtisar Buku Besar",
                            null,
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/ikhtisar/pajak",
                            "Ikhtisar Pajak",
                            null,
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/ikhtisar/pendapatan",
                            "Ikhtisar Pendapatan",
                            null,
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/ikhtisar/pembelian",
                            "Ikhtisar Pembelian",
                            null,
                            array()
                        )
                    )
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
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/aging/hutang",
                            "Aging Hutang",
                            null,
                            array()
                        )
                    )
                ),
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
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/harian/mutasi_jurnal_harian",
                            "Mutasi Jurnal Harian",
                            null,
                            array()
                        )
                    )
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
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/bulanan/faktur_pajak_harian",
                            "Faktur Pajak Harian",
                            null,
                            array()
                        ),
                        new NavItem(
                            null,
                            null,
                            "/index.php/keuangan/report/bulanan/laba_rugi",
                            "Laba Rugi",
                            null,
                            array()
                        )
                    )
                )
            )
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
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/koreksi/koreksi_kantor_pusat",
                    "Koreksi Kantor Pusat (KKP)",
                    null,
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/koreksi/koreksi_akuntan_publik",
                    "Koreksi Akuntan Publik (KAP)",
                    null,
                    null
                )
            )
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
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/jurnal_kas_keluar",
                    "Jurnal Kas Keluar (JKK)",
                    null,
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/jurnal_rupa_rupa",
                    "Jurnal Rupa-rupa (JRR)",
                    null,
                    null
                ),
                new NavItem(
                    null,
                    null,
                    "/index.php/keuangan/jurnal/antar_buku_bantu",
                    "Antar Buku Bantu (ABB)",
                    null,
                    null
                )
            )
        )
    );
} else if (stripos(current_url(), "/index.php/setting")) {
    $nav = array();
    if ($this->session->role_code == "ROLE_SUPER_ADMIN") {
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
                        null
                    ),
                    new NavItem(
                        null,
                        null,
                        "/index.php/setting/user/role_management",
                        "User Role",
                        null,
                        null
                    )
                )
            )
        );
    }
    array_push(
        $nav,
        new NavItem(
            "/master",
            null,
            "/index.php/setting/master/cabang",
            "Master",
            null,
            null
        ),
        new NavItem(
            "/parameter",
            null,
            "/index.php/setting/parameter/cabang",
            "Parameter",
            null,
            null
        )
    );
}

if (isset($nav)) {
    foreach ($nav as $navitem) {
        echo $this->load->view("component/dropdown_menu/nav_item", array("nav_data" => $navitem), true);
    }
}
