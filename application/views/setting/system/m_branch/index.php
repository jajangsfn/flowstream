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

<div class="modal fade" id="tambah_m_branch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "name",
                    "required" => true,
                    "placeholder" => "Enter Nama Branch",
                    "type" => "text",
                    "label" => "Name:",

                    "required" => true,
                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "owner",
                    "required" => true,
                    "placeholder" => "Enter Owner",
                    "type" => "text",
                    "label" => "Owner:",

                    "required" => true,
                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "address",
                    "required" => true,
                    "placeholder" => "Enter Address",
                    "type" => "textarea",
                    "label" => "Address:",

                    "required" => true,
                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "npwp",
                    "required" => true,
                    "placeholder" => "Enter NPWP",
                    "type" => "text",
                    "label" => "NPWP:",

                    "required" => true,
                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "tax_status",
                    "required" => true,
                    "placeholder" => "Enter Tax Status",
                    "type" => "number",
                    "label" => "Tax Status:",

                    "required" => true,
                    "value" => false
                ), true); ?>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
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
                    <h5 class="modal-title">Edit Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Enter Nama Branch",
                        "type" => "text",
                        "label" => "Name:",

                        "required" => true,
                        "value" => $focus->name
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "owner",
                        "required" => true,
                        "placeholder" => "Enter Owner",
                        "type" => "text",
                        "label" => "Owner:",

                        "required" => true,
                        "value" => $focus->owner
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address",
                        "required" => true,
                        "placeholder" => "Enter Address",
                        "type" => "textarea",
                        "label" => "Address:",

                        "required" => true,
                        "value" => $focus->address
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "npwp",
                        "required" => true,
                        "placeholder" => "Enter NPWP",
                        "type" => "text",
                        "label" => "NPWP:",

                        "required" => true,
                        "value" => $focus->npwp
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "tax_status",
                        "required" => true,
                        "placeholder" => "Enter Tax Status",
                        "type" => "number",
                        "label" => "Tax Status:",

                        "required" => true,
                        "value" => $focus->tax_status
                    ), true); ?>
                </div>
                <div class="modal-footer">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                </div>
            </form>
        </div>
    </div>
    <?= $this->load->view("component/modal/delete", array(
        "id" => $focus->id,
        "object_name" => "Branch",
        "detail" => "anda akan menghapus branch $focus->name",
        "subdetail" => "Seluruh data yang terkait dengan branch ini tidak akan ikut terhapus"
    ), true); ?>
<?php } ?>