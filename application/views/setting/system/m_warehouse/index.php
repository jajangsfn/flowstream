<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar M_Warehouse</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_warehouse">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_warehouse_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Branch</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Length</th>
                    <th>Width</th>
                    <th>Capacity</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_warehouse); $i++) {
                    $focus = $m_warehouse[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->branch_name ?></td>
                        <td nowrap><?= $focus->code ?></td>
                        <td nowrap><?= $focus->name ?></td>
                        <td><?= $focus->address ?></td>
                        <td><?= $focus->length ?></td>
                        <td><?= $focus->width ?></td>
                        <td><?= $focus->capacity ?></td>
                        <td><?= $focus->description ?></td>
                        <td><?= $focus->created_date ?></td>
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

<div class="modal fade" id="tambah_m_warehouse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Warehouse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <div class="form-group w-100">
                        <label>Branch:</label>
                        <select class="form-control select2" name="branch_id">
                            <option value="" selected disabled>Choose Branch</option>
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Code:</label>
                        <input type="text" name="code" class="form-control" placeholder="Enter Code" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Length:</label>
                        <input type="number" name="length" class="form-control" placeholder="Enter Length" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Width:</label>
                        <input type="number" name="width" class="form-control" placeholder="Enter Width" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Capacity:</label>
                        <input type="number" name="capacity" class="form-control" placeholder="Enter Capacity" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($m_warehouse); $i++) {
    $focus = $m_warehouse[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
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
                                    <option value="<?= $focus->branch_id ?>" selected><?= $focus->branch_name ?> <span>(Deleted)</span></option>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                                <div class="my-2">
                                    (Manage Branch)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Code:</label>
                            <input type="text" name="code" class="form-control" placeholder="Enter Code" required value="<?= $focus->code ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required value="<?= $focus->name ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address_<?= $focus->id ?>">Address:</label>
                            <textarea class="form-control" id="address_<?= $focus->id ?>" name="address" placeholder="Enter Address" rows="3"><?= $focus->address ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Length:</label>
                            <input type="number" name="length" class="form-control" placeholder="Enter Length" required value="<?= $focus->length ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Width:</label>
                            <input type="number" name="width" class="form-control" placeholder="Enter Width" required value="<?= $focus->width ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Capacity:</label>
                            <input type="number" name="capacity" class="form-control" placeholder="Enter Capacity" required value="<?= $focus->capacity ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_<?= $focus->id ?>">Description:</label>
                            <textarea class="form-control" id="description_<?= $focus->id ?>" name="description" placeholder="Enter description" rows="3"><?= $focus->description ?></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus data warehouse <?= $focus->name ?></p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan warehouse ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>