<div class="card gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <div class="d-flex justify-content-around">
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/master") ?>">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/master") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon2-analytics <?= stripos(current_url(), "/keuangan/master") ? "text-primary" : "text-danger" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="font-weight-bold <?= stripos(current_url(), "/keuangan/master") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Master
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/akuntansi") ?>">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/akuntansi") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon2-pie-chart-2 <?= stripos(current_url(), "/keuangan/akuntansi") ? "text-primary" : "text-warning" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="font-weight-bold <?= stripos(current_url(), "/keuangan/akuntansi") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Akuntansi
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </a>
            <!--end::Section-->
            <!--begin::Section-->
            <a href="<?= base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/kode_rekening") ?>">
                <div class="card card-custom <?= stripos(current_url(), "/keuangan/kode_rekening") ? "bg-light-primary" : "" ?>">
                    <div class="d-flex align-items-center flex-column card-body">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45 symbol-light">
                            <i class="flaticon2-box-1 <?= stripos(current_url(), "/keuangan/kode_rekening") ? "text-primary" : "text-success" ?> fa-2x"></i>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="font-weight-bold <?= stripos(current_url(), "/keuangan/kode_rekening") ? "text-primary" : "text-dark-75 text-hover-primary" ?> font-size-lg">
                            Kode Rekening
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