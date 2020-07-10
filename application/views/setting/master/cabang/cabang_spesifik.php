<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">
                    <h3 class="card-label font-weight-bolder text-dark m-0">Informasi Cabang</h3>
                </div>
            </div>
            <div class="card-body pt-4">
                <!--begin::User-->
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-100 mr-5 align-self-start align-self-xxl-center">
                        <div class="symbol-label" style="background-image:url('<?= base_url("/attachment/$data_branch->logo") ?>')"></div>
                    </div>
                    <div>
                        <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?= $data_branch->name ?></a>
                        <div class="text-muted"><?= $data_branch->code ?></div>
                    </div>
                </div>
                <!--end::User-->
                <!--begin::Contact-->
                <div class="py-9">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Pemilik:</span>
                        <a href="#" class="text-muted text-hover-primary"><?= $data_branch->owner ?></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Alamat:</span>
                        <span class="text-muted"><?= $data_branch->address ?></span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Status Pajak:</span>
                        <span class="text-muted"><?= $data_branch->tax_status ?></span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold mr-2">NPWP:</span>
                        <span class="text-muted"><?= $data_branch->npwp ?></span>
                    </div>
                </div>
                <!--end::Contact-->
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">
                    <h3 class="card-label font-weight-bolder text-dark m-0">Master Cabang</h3>
                </div>
            </div>
            <div class="card-body pt-4">
                <!--begin::Nav-->
                <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                    <div class="navi-item mb-2">
                        <a href="<?= current_url() ?>/barang" class="navi-link py-4">
                            <span class="navi-icon mr-2">
                                <span class="flaticon2-box"></span>
                            </span>
                            <span class="navi-text font-size-lg">Barang</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="<?= current_url() ?>/supplier" class="navi-link py-4">
                            <span class="navi-icon mr-2">
                                <span class="flaticon2-open-box"></span>
                            </span>
                            <span class="navi-text font-size-lg">Supplier</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="<?= current_url() ?>/customer" class="navi-link py-4">
                            <span class="navi-icon mr-2">
                                <span class="flaticon2-user"></span>
                            </span>
                            <span class="navi-text font-size-lg">Customer</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="<?= current_url() ?>/gudang" class="navi-link py-4">
                            <span class="navi-icon mr-2">
                                <span class="flaticon-tool"></span>
                            </span>
                            <span class="navi-text font-size-lg">Gudang</span>
                        </a>
                    </div>
                </div>
                <!--end::Nav-->
            </div>
        </div>
    </div>
</div>