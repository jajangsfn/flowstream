<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <h5 class="card-label font-weight-bolder text-dark m-0">Informasi Cabang</h5>
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
                                <span class="text-muted"><?= $data_branch->owner ?></span>
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
            <div class="col-md-6">
                <div class="card mt-8">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <h5 class="card-label font-weight-bolder text-dark m-0">Master Keuangan</h5>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/kode_rekening" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Kode Rekening</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/tutup_buku" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Tutup Buku</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/mata_uang" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Mata Uang</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/tipe_jurnal" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Tipe Jurnal</span>
                                </a>
                            </div>
                        </div>
                        <!--end::Nav-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <h5 class="card-label font-weight-bolder text-dark m-0">Master Cabang</h5>
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
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/partner_type" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Tipe Partner</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/map" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Map Harga</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/unit" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Unit Barang</span>
                                </a>
                            </div>
                        </div>
                        <!--end::Nav-->
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <h5 class="card-label font-weight-bolder text-dark m-0">Data Referensi Cabang</h5>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/goods_division" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Goods Division</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/goods_sub_division" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Goods Sub Division</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/goods_category" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Goods Category</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/goods_sub_category" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Goods Sub Category</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/goods_package" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Goods Package</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/goods_color" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Goods Color</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/employee_level" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Employee Level</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/employee_position" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Employee Position</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/delivery_receive_status" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Delivery Receive Status</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/activation_status" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Activation Status</span>
                                </a>
                            </div>
                        </div>
                        <!--end::Nav-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>