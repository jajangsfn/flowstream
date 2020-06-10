<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar M_Salesman_Map</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_salesman_map">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_salesman_map_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Salesman</th>
                    <th>Goods</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_salesman_map); $i++) {
                    $focus = $m_salesman_map[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->salesman_name ?></td>
                        <td nowrap><?= $focus->goods_name ?></td>
                        <td nowrap="nowrap">
                            <!-- Button trigger modal-->
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" data-toggle="modal" data-target="#edit_<?= $focus->id ?>">
                                <i class="flaticon2-pen"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" data-toggle="modal" data-target="#delete_<?= $focus->id ?>">
                                <i class="flaticon2-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_m_salesman_map" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Salesman Map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-12">
                    <div class="form-group w-100">
                        <label>Salesman:</label>
                        <select class="form-control select2" name="salesman_id" required>
                            <?php foreach ($m_salesman as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/m_salesman") ?>">
                            <div class="my-2">
                                (Manage Salesman)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group w-100">
                        <label>Goods:</label>
                        <select class="form-control select2" name="goods_id" required>
                            <?php foreach ($m_goods as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/master/barang") ?>">
                            <div class="my-2">
                                (Manage Goods)
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($m_salesman_map); $i++) {
    $focus = $m_salesman_map[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Salesman Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group w-100">
                            <label>Salesman:</label>
                            <select class="form-control select2" name="salesman_id" required>
                                <?php $found = false; ?>
                                <?php foreach ($m_salesman as $option) { ?>
                                    <?php if ($focus->salesman_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->salesman_id ?>" selected><?= $focus->salesman_name ?> <span>(Deleted)</span></option>
                                    <?php $found = false; ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_salesman") ?>">
                                <div class="my-2">
                                    (Manage Salesman)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group w-100">
                            <label>Goods:</label>
                            <select class="form-control select2" name="goods_id" required>
                                <?php $found = false; ?>
                                <?php foreach ($m_goods as $option) { ?>
                                    <?php if ($focus->goods_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->goods_id ?>" selected><?= $focus->goods_name ?> <span>(Deleted)</span></option>
                                    <?php $found = false; ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/master/barang") ?>">
                                <div class="my-2">
                                    (Manage Goods)
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Partner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus salesman map <?= $focus->salesman_name ?> => <?= $focus->goods_name ?></p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan mapping ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>