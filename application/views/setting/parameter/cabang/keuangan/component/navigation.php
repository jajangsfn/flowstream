<div class="card gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <div class="row">
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/master") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/master") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon2-analytics <?= stripos(current_url(), "/keuangan/master") ? "text-primary" : "text-danger" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/master") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Master
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/akuntansi") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/akuntansi") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon2-pie-chart-2 <?= stripos(current_url(), "/keuangan/akuntansi") ? "text-primary" : "text-warning" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/akuntansi") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Akuntansi
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/kode_rekening") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/kode_rekening") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon2-box-1 <?= stripos(current_url(), "/keuangan/kode_rekening") ? "text-primary" : "text-success" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/kode_rekening") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Kode Rekening
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/neraca_saldo_akhir") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/neraca_saldo_akhir") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon-statistics <?= stripos(current_url(), "/keuangan/neraca_saldo_akhir") ? "text-primary" : "text-info" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/neraca_saldo_akhir") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Neraca Saldo Akhir
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/ikhtisar_saldo") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/ikhtisar_saldo") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon-graph <?= stripos(current_url(), "/keuangan/ikhtisar_saldo") ? "text-primary" : "text-danger" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/ikhtisar_saldo") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Ikhtisar Saldo
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/saldo_kode_rekening") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/saldo_kode_rekening") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon-more-v5 <?= stripos(current_url(), "/keuangan/saldo_kode_rekening") ? "text-primary" : "text-success" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/saldo_kode_rekening") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Kode Rekening Saldo
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/nomor_pajak") ?>" class="col-lg-2 col-md-3 col-sm-4 col-6 gutter-b">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/nomor_pajak") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon-clock-2 <?= stripos(current_url(), "/keuangan/nomor_pajak") ? "text-primary" : "text-success" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-nowrap font-weight-bold <?= stripos(current_url(), "/keuangan/nomor_pajak") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Nomor Pajak
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
        </div>
    </div>
    <!--end::Body-->
</div>