<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar Salesman</h3>
                </div>
                <div class="card-toolbar">
                    <!-- Button trigger modal-->
                    <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_salesman">
                        <i class="la la-plus"></i>Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="salesman_table">
                    <thead>
                        <tr>
                            <th class="text-center" width="1">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nomor Telepon</th>
                            <th class="text-center" style="max-width: 200px;">Mapping Barang</th>
                            <th class="text-center" style="max-width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_salesman as $key => $sman) : ?>
                            <tr>
                                <td class="text-center"><?= $key + 1 ?></td>
                                <td><?= $sman->name ?></td>
                                <td class="text-center"><?= $sman->phone ?></td>
                                <td class="text-center">
                                    <a class="btn btn-light-primary" type="button" href="<?= base_url("/index.php/setting/master/cabang/$data_branch->id/supplier/$data_supplier->id/salesman/$sman->id") ?>">
                                        <i class="fa fa-box"></i> Mapping Barang
                                    </a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit(<?= $sman->id ?>, '<?= $sman->name ?>', '<?= $sman->phone ?>')">
                                        <i class="flaticon2-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="delete_trigger(<?= $sman->id ?>)">
                                        <i class="flaticon2-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>


<div class="modal fade" id="tambah_salesman" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= base_url("/index.php/api/add_salesman") ?>" method="POST" class="modal-content">
            <input type="hidden" name="partner_id" value="<?= $data_supplier->id ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Salesman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Nama Salesman",
                        "label" => "Nama Salesman",
                        "help" => "Masukan Nama Salesman",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "phone",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Nomor Telepon",
                        "label" => "Nomor Telepon",
                        "help" => "Masukan Nomor Telepon Salesman",

                        "value" => false
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_salesman" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/edit_salesman") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Salesman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "type" => "text",
                        "required" => true,

                        "id" => "name_edit",

                        "placeholder" => "Nama Salesman",
                        "label" => "Nama Salesman",
                        "help" => "Masukan Nama Salesman",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "phone",
                        "type" => "text",
                        "required" => true,

                        "id" => "phone_edit",

                        "placeholder" => "Nomor Telepon",
                        "label" => "Nomor Telepon",
                        "help" => "Masukan Nomor Telepon Salesman",

                        "value" => false
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_salesman") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Salesman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus data salesman ini</p>
                <small class="m-0 text-info">Seluruh data yang terkait dengan salesman ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>