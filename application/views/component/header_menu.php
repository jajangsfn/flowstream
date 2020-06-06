<!--begin::Header Menu Wrapper-->
<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <div class="container">
        <!--begin::Header Menu-->
        <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default header-menu-root-arrow">
            <!--begin::Header Nav-->
            <ul class="menu-nav">
                <li class="menu-item <?= stripos(current_url(), "/dashboard") ? "menu-item-here" : "" ?> menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="<?= base_url() ?>" class="menu-link">
                        <span class="menu-text">
                            <i class="fa la-tachometer-alt mr-3"></i>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel <?= stripos(current_url(), "/penjualan") ? "menu-item-here" : "" ?>" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Penjualan</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <?php
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/penjualan/order_request"),
                                "title" => "Order Request"
                            ));
                            ?>
                            <?php
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/penjualan/pos"),
                                "title" => "Point of Sales (POS)"
                            ));
                            ?>
                            <?php
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/penjualan/retur"),
                                "title" => "Retur Penjualan"
                            ));
                            ?>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Laporan</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Laporan Penjualan</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/penjualan/laporan/penjualan/harian"),
                                                        "title" => "Laporan Harian"
                                                    ));
                                                    ?>
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/penjualan/laporan/penjualan/bulanan"),
                                                        "title" => "Laporan Bulanan"
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Laporan Retur</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/penjualan/laporan/retur/harian"),
                                                        "title" => "Laporan Harian"
                                                    ));
                                                    ?>
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/penjualan/laporan/retur/bulanan"),
                                                        "title" => "Laporan Bulanan"
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel <?= stripos(current_url(), "/pembelian") ? "menu-item-here" : "" ?>" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Pembelian</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <?php
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/pembelian/purchase_order"),
                                "title" => "Purchase Order",
                            ));
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/pembelian/retur"),
                                "title" => "Retur Pembelian",
                            ));
                            ?>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Laporan</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Laporan Pembelian</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/pembelian/laporan/pembelian/harian"),
                                                        "title" => "Laporan Harian"
                                                    ));
                                                    ?>
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/pembelian/laporan/pembelian/bulanan"),
                                                        "title" => "Laporan Bulanan"
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Laporan Retur</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/pembelian/laporan/retur/harian"),
                                                        "title" => "Laporan Harian"
                                                    ));
                                                    ?>
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/pembelian/laporan/retur/bulanan"),
                                                        "title" => "Laporan Bulanan"
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel <?= stripos(current_url(), "/inventory") ? "menu-item-here" : "" ?>" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Inventory</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <?php
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/inventory/receiving"),
                                "title" => "Receiving",
                            ));
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url("/index.php/inventory/gudang"),
                                "title" => "Gudang",
                            ));
                            ?>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Laporan</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Laporan Receiving</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/inventory/laporan/receiving/harian"),
                                                        "title" => "Laporan Harian",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/inventory/laporan/receiving/bulanan"),
                                                        "title" => "Laporan Bulanan",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Laporan Gudang</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/inventory/laporan/gudang/harian"),
                                                        "title" => "Laporan Harian",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/inventory/laporan/gudang/bulanan"),
                                                        "title" => "Laporan Bulanan",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel <?= stripos(current_url(), "/keuangan") && !stripos(current_url(), "/setting") ? "menu-item-here" : "" ?>" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Keuangan</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Registrasi</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/registrasi/register_jurnal"),
                                            "title" => "Register Jurnal",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/registrasi/list_jurnal"),
                                            "title" => "List Jurnal",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/registrasi/cetak_ulang_jurnal"),
                                            "title" => "Cetak Ulang Jurnal",
                                        ));
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Pembayaran</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/pembayaran/piutang"),
                                            "title" => "Pembayaran Piutang",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/pembayaran/hutang"),
                                            "title" => "Pembayaran Hutang",
                                        ));
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Jurnal</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/jurnal/jurnal_kas_masuk"),
                                            "title" => "Jurnal Kas Masuk (JKM)",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/jurnal/jurnal_kas_keluar"),
                                            "title" => "Jurnal Kas Keluar (JKK)",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/jurnal/jurnal_rupa_rupa"),
                                            "title" => "Jurnal Rupa-rupa (JRR)",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/jurnal/antar_buku_bantu"),
                                            "title" => "Antar Buku Bantu (ABB)",
                                        ));
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Koreksi</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/koreksi/koreksi_kantor_cabang"),
                                            "title" => "Koreksi Kantor Cabang (KKC)",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/koreksi/koreksi_kantor_pusat"),
                                            "title" => "Koreksi Kantor Pusat (KKP)",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/koreksi/koreksi_akuntan_publik"),
                                            "title" => "Koreksi Akuntan Publik (KAP)",
                                        ));
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Tutup Buku</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/tutup_buku/bulanan"),
                                            "title" => "Tutup Buku Bulanan",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/keuangan/tutup_buku/status"),
                                            "title" => "Status Tutup Buku",
                                        ));
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Report</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Report Harian</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/harian/mutasi_harian_kas_bank"),
                                                        "title" => "Mutasi Harian Kas Bank",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/harian/mutasi_jurnal_harian"),
                                                        "title" => "Mutasi Jurnal Harian",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Report Bulanan</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/bulanan/neraca_saldo"),
                                                        "title" => "Neraca Saldo",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/bulanan/faktur_pajak_harian"),
                                                        "title" => "Faktur Pajak Harian",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/bulanan/laba_rugi"),
                                                        "title" => "Laba Rugi",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Ikhtisar</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/ikhtisar/buku_besar"),
                                                        "title" => "Ikhtisar Buku Besar",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/ikhtisar/pajak"),
                                                        "title" => "Ikhtisar Pajak",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/ikhtisar/pendapatan"),
                                                        "title" => "Ikhtisar Pendapatan",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/ikhtisar/pembelian"),
                                                        "title" => "Ikhtisar Pembelian",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Aging</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/aging/piutang"),
                                                        "title" => "Aging Piutang",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/keuangan/report/aging/hutang"),
                                                        "title" => "Aging Hutang",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel <?= stripos(current_url(), "/setting") ? "menu-item-here" : "" ?>" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Setting dan Konfigurasi</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">User</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/user/user_management"),
                                            "title" => "User Management",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/user/role_management"),
                                            "title" => "User Role",
                                        ));
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Master</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/master/barang"),
                                            "title" => "Master Barang",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/master/supplier"),
                                            "title" => "Master Supplier",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/master/customer"),
                                            "title" => "Master Customer",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/master/gudang"),
                                            "title" => "Master Gudang",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/master/discount"),
                                            "title" => "Master Discount",
                                        ));
                                        ?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Master Keuangan</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/kode_rekening"),
                                                        "title" => "Kode Rekening",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/kode_jenis_biaya"),
                                                        "title" => "Kode Jenis Biaya",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/mata_uang"),
                                                        "title" => "Mata Uang",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/sumber_dana"),
                                                        "title" => "Sumber Dana",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/tipe_jurnal"),
                                                        "title" => "Tipe Jurnal",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/pembagian_laba_rugi"),
                                                        "title" => "Pembagian Laba Rugi",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/ikhtisar_kode_rekening"),
                                                        "title" => "Ikhtisar Kode Rekening",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/aging_kode_rekening"),
                                                        "title" => "Aging Kode Rekening",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/kelompok_rekening"),
                                                        "title" => "Kelompok Rekening",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/master/keuangan/kelompok_jenis_biaya"),
                                                        "title" => "Kelompok Jenis Biaya",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Parameter</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                    <ul class="menu-subnav">
                                        <?php
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/parameter/pembelian"),
                                            "title" => "Parameter Pembelian",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/parameter/penjualan"),
                                            "title" => "Parameter Penjualan",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/parameter/barang"),
                                            "title" => "Parameter Barang",
                                        ));
                                        $this->load->view("component/dropdown_menu/level_end", array(
                                            "dot" => true,
                                            "url" => base_url("/index.php/setting/parameter/inventori"),
                                            "title" => "Parameter Inventori",
                                        ));
                                        ?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="menu-text">Parameter Keuangan</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <?php
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/parameter/keuangan/master"),
                                                        "title" => "Parameter Master",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/parameter/keuangan/akuntansi"),
                                                        "title" => "Parameter Akuntansi",
                                                    ));
                                                    $this->load->view("component/dropdown_menu/level_end", array(
                                                        "dot" => true,
                                                        "url" => base_url("/index.php/setting/parameter/keuangan/kode_rekening"),
                                                        "title" => "Parameter Kode Rekening",
                                                    ));
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!--end::Header Nav-->
        </div>
        <!--end::Header Menu-->
    </div>
</div>
<!--end::Header Menu Wrapper-->