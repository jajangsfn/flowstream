<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title m-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-label font-weight-bolder text-dark m-0">Informasi Cabang</h5>
                            <button class="btn btn-light-primary" onclick="edit(
                                            '<?= $data_branch->id ?>',
                                            '<?= $data_branch->logo ?>',
                                            '<?= $data_branch->name ?>',
                                            '<?= $data_branch->code ?>',
                                            '<?= $data_branch->owner ?>',
                                            '<?= $data_branch->address ?>',
                                            '<?= $data_branch->npwp ?>',
                                            '<?= $data_branch->tax_status ?>',
                                        )"><i class="fa la-pen"></i> Edit</button>
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
                                <span class="text-muted"><?= $data_branch->tax_status == 1 ? "Kena Pajak" : "Tidak Kena Pajak" ?></span>
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
                                        <span class="flaticon-price-tag"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Kode Rekening</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="#" class="navi-link py-4" onclick="change_type_price()">
                                    <span class="navi-icon mr-2">
                                        <span class="fa fa-dollar-sign"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Jenis Harga</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2 d-none">
                                <a href="<?= current_url() ?>/tutup_buku" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Tutup Buku</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2 d-none">
                                <a href="<?= current_url() ?>/mata_uang" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Mata Uang</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2 d-none">
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
            <div class="col-md-6">
                <div class="card mt-8">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <h5 class="card-label font-weight-bolder text-dark m-0">Master Employee</h5>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/employee" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-users-1"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Employee</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/employee_level" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Level</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/reference/employee_position" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Position</span>
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
                                        <span class="flaticon2-user-1"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Tipe Partner</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/map" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-graph-2"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Map Harga</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="<?= current_url() ?>/unit" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon2-layers-2"></span>
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
                                <a href="<?= current_url() ?>/reference/delivery_receive_status" class="navi-link py-4">
                                    <span class="navi-icon mr-2">
                                        <span class="flaticon-refresh"></span>
                                    </span>
                                    <span class="navi-text font-size-lg">Delivery Receive Status</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2 d-none">
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


<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/edit_cabang") ?>" method="POST" class="modal-content" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-5">
                    <div class="w-100 text-center">
                        <div class="image-input image-input-empty image-input-outline" id="logo_edit" style="background-image: url(<?= base_url("assets/media/users/blank.png") ?>)">
                            <div class="image-input-wrapper" id="logo_placement_edit"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Logo Cabang</span>
                    </div>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Masukan Nama Cabang",
                        "type" => "text",
                        "label" => "Nama:",
                        "id" => "name_edit",

                        "required" => true,
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "code",
                        "required" => true,
                        "placeholder" => "Masukan Kode Cabang",
                        "type" => "text",
                        "label" => "Kode Cabang:",
                        "id" => "code_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-7">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "owner",
                        "required" => true,
                        "placeholder" => "Masukan Pemilik Cabang",
                        "type" => "text",
                        "label" => "Pemilik:",
                        "id" => "owner_edit",

                        "required" => true,
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address",
                        "required" => true,
                        "placeholder" => "Masukan Alamat Cabang",
                        "type" => "textarea",
                        "label" => "Alamat:",
                        "id" => "address_edit",

                        "required" => true,
                    ), true); ?>
                    <div class="row">
                        <div class="col">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "npwp",
                                "required" => true,
                                "placeholder" => "Masukan NPWP",
                                "type" => "text",
                                "label" => "NPWP:",
                                "id" => "npwp_edit",

                                "required" => true,
                            ), true); ?>
                        </div>
                        <div class="col">
                            <div class="form-group w-100">
                                <label class="required">Status Pajak</label>
                                <select class="form-control select2" name="tax_status" data-width="100%" id="tax_edit" required>
                                    <option value="0">Tidak Kena Pajak</option>
                                    <option value="1">Kena Pajak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>


<!-- change type price -->
<!-- Modal -->
<div class="modal fade" id="change_type_price" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form class="modal-content" method="post" action="<?=base_url()?>index.php/setting/update_type_price">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Jenis Harga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_branch" value="<?=$data_branch->id?>"/>
        <?php
        foreach($type_price as $key => $row) {?>
           <input type="radio" name="type_price" value="<?=$row->id?>" <?=$row->flag == 1 ? 'checked' :'';?>> <?=$row->detail_data?>
         <?php }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>