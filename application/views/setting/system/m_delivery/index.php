<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar M_delivery</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_delivery">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_delivery_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Branch</th>
                    <th>Name</th>
                    <th>No Rekening</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_delivery); $i++) {
                    $focus = $m_delivery[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->branch_name ?></td>
                        <td nowrap="nowrap"><?= $focus->name ?></td>
                        <td><?= $focus->rekening_no ?></td>
                        <td><?= $focus->description ?></td>
                        <td nowrap="nowrap">
                            <?= $this->load->view("component/icon_button/edit", array("id" => $focus->id), true); ?>
                            <?= $this->load->view("component/icon_button/delete", array("id" => $focus->id), true); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_m_delivery" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Delivery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group w-100">
                    <label>Branch:</label>
                    <select class="form-control select2" name="branch_id">
                        <option value="" disabled selected>Choose Branch</option>
                        <?php foreach ($m_branch as $option) { ?>
                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                        <?php } ?>
                    </select>
                    <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                        <div class="my-2">
                            (Manage Branch)
                        </div>
                    </a>
                </div>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukan Nama Delivery" required />
                </div>
                <div class="form-group">
                    <label>No Rekening:</label>
                    <input type="text" name="rekening_no" class="form-control" placeholder="Masukan Nomor Rekening" required />
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Masukan Deskripsi Delivery" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($m_delivery); $i++) {
    $focus = $m_delivery[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group w-100">
                        <label>Branch:</label>
                        <select class="form-control select2" name="branch_id">
                            <?php $found = false; ?>
                            <?php foreach ($m_branch as $option) { ?>
                                <?php if ($focus->branch_id == $option->id) { ?>
                                    <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                    <?php $found = true; ?>
                                <?php } else { ?>
                                    <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                <?php } ?>
                            <?php } ?>
                            <?php if (!$found) { ?>
                                <option value="<?= $focus->branch_id ?>" selected><?= $focus->branch ?> <span>(Deleted)</span></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                            <div class="my-2">
                                (Manage Branch)
                            </div>
                        </a>
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukan Nama Delivery" required value="<?= $focus->name ?>" />
                    </div>
                    <div class="form-group">
                        <label>No Rekening:</label>
                        <input type="text" name="rekening_no" class="form-control" placeholder="Masukan Nomor Rekening" required value="<?= $focus->rekening_no ?>" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Masukan Deskripsi Delivery" rows="3" required><?= $focus->description ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus delivery <?= $focus->name ?></p>
                    <small class="m-0 text-info">Seluruh data yang menggunakan delivery ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>