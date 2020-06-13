<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar delivery_team</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_delivery_team">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="delivery_team_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Delivery Order</th>
                    <th>User</th>
                    <th>Job Description</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($delivery_team); $i++) {
                    $focus = $delivery_team[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->delivery_no ?></td>
                        <td nowrap><?= $focus->user_id ?></td>
                        <td><?= $focus->job_description ?></td>
                        <td><?= $focus->description ?></td>
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

<div class="modal fade" id="tambah_delivery_team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Delivery Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Delivery Order:</label>
                        <select class="form-control select2" name="delivery_order_id">
                            <option value="" selected disabled>Choose Delivery Order</option>
                            <?php foreach ($delivery_order as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->delivery_no ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/delivery_order") ?>">
                            <div class="my-2">
                                (Manage Delivery Order)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>User:</label>
                        <select class="form-control select2" name="user_id">
                            <option value="1" selected>(Not Implemented)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="job_description">Job Description:</label>
                        <textarea class="form-control" id="job_description" name="job_description" placeholder="Masukan Deskripsi Pekerjaan" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Masukan Deskripsi" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($delivery_team); $i++) {
    $focus = $delivery_team[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Delivery Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Delivery Order:</label>
                            <select class="form-control select2" name="delivery_order_id">
                                <?php $found = false; ?>
                                <?php foreach ($delivery_order as $option) { ?>
                                    <?php if ($focus->delivery_order_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->delivery_no ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->delivery_no ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->delivery_order_id ?>" selected><?= $focus->delivery_no ?> <span>(Deleted)</span></option>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/delivery_order") ?>">
                                <div class="my-2">
                                    (Manage Delivery Order)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>User:</label>
                            <select class="form-control select2" name="user_id">
                                <option value="1" selected>(Not Implemented)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "label" => "Job Description:",
                            "name" => "job_description",
                            "type" => "textarea",
                            "placeholder" => "Masukan Deskripsi Pekerjaan",
                            "value" => $focus->job_description
                        ), true); ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "label" => "Description:",
                            "name" => "description",
                            "type" => "textarea",
                            "placeholder" => "Masukan Deskripsi",
                            "value" => $focus->description
                        ), true); ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Delivery Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus data delivery team ini</p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan delivery team ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>