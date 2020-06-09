<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar M_branch</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_branch">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_branch_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Address</th>
                    <th>NPWP</th>
                    <th>Tax Status</th>
                    <th>Online Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_branch); $i++) {
                    $focus = $m_branch[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->name ?></td>
                        <td><?= $focus->owner ?></td>
                        <td><?= $focus->address ?></td>
                        <td><?= $focus->npwp ?></td>
                        <td><?= $focus->tax_status ?></td>
                        <td><?= $focus->online_status ?></td>
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

<div class="modal fade" id="tambah_m_branch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Nama Branch" required />
                </div>
                <div class="form-group">
                    <label>Owner:</label>
                    <input type="text" name="owner" class="form-control" placeholder="Enter Owner" required />
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>NPWP:</label>
                    <input type="text" name="npwp" class="form-control" placeholder="Enter NPWP" required />
                </div>
                <div class="form-group">
                    <label>Tax Status:</label>
                    <input type="number" name="tax_status" class="form-control" placeholder="Enter Tax Status" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($m_branch); $i++) {
    $focus = $m_branch[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Nama Unit" required value="<?= $focus->name ?>" />
                    </div>
                    <div class="form-group">
                        <label>Owner:</label>
                        <input type="text" name="owner" class="form-control" placeholder="Enter Owner" required value="<?= $focus->owner ?>" />
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="3"><?= $focus->address ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>NPWP:</label>
                        <input type="text" name="npwp" class="form-control" placeholder="Enter NPWP" required value="<?= $focus->npwp ?>" />
                    </div>
                    <div class="form-group">
                        <label>Tax Status:</label>
                        <input type="number" name="tax_status" class="form-control" placeholder="Enter Tax Status" required value="<?= $focus->tax_status ?>" />
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus branch <?= $focus->name ?></p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan branch ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>