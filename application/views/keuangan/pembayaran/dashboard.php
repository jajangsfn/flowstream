<!-- start report chart -->
<div class="row">

    <div class="col-6">
        <!--begin::Callout-->
        <a href="<?= base_url("/index.php/keuangan/pembayaran/daftar_transaksi") ?>">
            <div class="card card-custom wave wave-animate-fast wave-success mb-8 gutter-b">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="flaticon2-shopping-cart icon-4x text-success"></i>
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <a href="<?= base_url("/index.php/keuangan/pembayaran/daftar_transaksi") ?>" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3"><?= $statistik_pembayaran['total_transaksi'] ?></a>
                            <div class="text-dark font-size-h3">Total transaksi</div>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </a>
        <!--end::Callout-->
    </div>
    <div class="col-6">
        <!--begin::Callout-->
        <a href="<?= base_url("/index.php/keuangan/pembayaran/daftar_transaksi") ?>">
            <div class="card card-custom wave wave-animate-fast wave-success mb-8 gutter-b">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="flaticon2-shopping-cart icon-4x text-success"></i>
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <a href="<?= base_url("/index.php/keuangan/pembayaran/daftar_transaksi") ?>" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3"><?= $statistik_pembayaran['total_transaksi_lunas'] ?></a>
                            <div class="text-dark font-size-h3">Total transaksi lunas</div>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </a>
        <!--end::Callout-->
    </div>

    <div class="col-lg-4 col-md-4">
        <!--begin::Callout-->
        <a href="<?= base_url("/index.php/keuangan/pembayaran/piutang") ?>">
            <div class="card card-custom wave wave-animate-slow wave-primary mb-8 gutter-b">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-primary svg-icon-4x">
                                <i class="flaticon2-hourglass-1 icon-4x text-primary"></i>
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <a href="<?= base_url("/index.php/keuangan/pembayaran/piutang") ?>" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3"><?= $statistik_pembayaran['total_transaksi_dengan_piutang'] ?></a>
                            <div class="text-dark font-size-h3">Transaksi memiliki Piutang</div>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </a>
        <!--end::Callout-->
    </div>
    <div class="col-lg-4 col-md-4">
        <!--begin::Callout-->
        <a href="<?= base_url("/index.php/keuangan/pembayaran/piutang") ?>">
            <div class="card card-custom wave wave-animate-slow wave-warning mb-8 gutter-b">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-warning svg-icon-4x">
                                <i class="flaticon2-list-2 icon-4x text-warning"></i>
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <a href="<?= base_url("/index.php/keuangan/pembayaran/piutang") ?>" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3"><?= number_format($statistik_pembayaran['total_bill_piutang'], 0, ',', '.') ?></a>
                            <div class="text-dark font-size-h3">Total nominal bill piutang</div>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </a>
        <!--end::Callout-->
    </div>
    <div class="col-lg-4 col-md-4">
        <!--begin::Callout-->
        <a href="<?= base_url("/index.php/keuangan/registrasi/register_jurnal") ?>">
            <div class="card card-custom wave wave-animate-fast wave-info mb-8 gutter-b">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="flaticon2-shopping-cart icon-4x text-info"></i>
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <a href="<?= base_url("/index.php/keuangan/registrasi/register_jurnal") ?>" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3"><?= $statistik_pembayaran['total_unregistered_jurnal'] ?></a>
                            <div class="text-dark font-size-h3">Jurnal membutuhkan register</div>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </a>
        <!--end::Callout-->
    </div>
</div>
<!-- end report chart -->