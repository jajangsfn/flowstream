<div class="d-flex justify-content-center align-items-center h-100">
    <div class="row w-75">
        <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
            <a href="<?= base_url("/index.php/dashboard") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                <i class="flaticon2-graphic display-3"></i>
            </a>
            <h3 class="mt-2">
                Dashboard
            </h3>
        </div>
        <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
            <a href="<?= base_url("/index.php/penjualan/home") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                <i class="flaticon2-shopping-cart-1  display-3"></i>
            </a>
            <h3 class="mt-2">
                Penjualan
            </h3>
        </div>
        <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
            <a href="<?= base_url("/index.php/pembelian/purchase_order") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                <i class="flaticon2-lorry  display-3"></i>
            </a>
            <h3 class="mt-2">
                Pembelian
            </h3>
        </div>
        <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
            <a href="<?= base_url("/index.php/inventori/receiving") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                <i class="flaticon2-open-box  display-3"></i>
            </a>
            <h3 class="mt-2">
                Inventori
            </h3>
        </div>
        <?php if ($this->session->role_code == "ROLE_SUPER_ADMIN") : ?>
            <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
                <a href="<?= base_url("/index.php/produksi") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                    <i class="flaticon2-sort-down display-3"></i>
                </a>
                <h3 class="mt-2">
                    Produksi
                </h3>
            </div>
            <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
                <a href="<?= base_url("/index.php/pengiriman") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                    <i class="flaticon2-delivery-truck display-3"></i>
                </a>
                <h3 class="mt-2">
                    Pengiriman
                </h3>
            </div>
        <?php endif ?>
        <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
            <a href="<?= base_url("/index.php/keuangan/pembayaran/dashboard") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                <i class="flaticon-analytics  display-3"></i>
            </a>
            <h3 class="mt-2">
                Keuangan
            </h3>
        </div>
        <div class="<?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "col-md-3 col-lg-3" : "col-md-4 col-lg-4"; ?> col-sm-6 p-5 text-center">
            <a href="<?= base_url("/index.php/setting") ?>" class="btn btn-shadow btn-icon btn-circle btn-primary display-2">
                <i class="flaticon2-gear  display-3"></i>
            </a>
            <h3 class="mt-2">
                Setting dan Konfigurasi
            </h3>
        </div>
    </div>
</div>