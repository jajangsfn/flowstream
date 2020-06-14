<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Kode Rekening</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_rekening_code">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_rekening_code_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Rekening No</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_rekening_code); $i++) {
                    $focus = $m_rekening_code[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->rekening_no ?></td>
                        <td><?= $focus->name ?></td>
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

<div class="modal fade" id="tambah_m_rekening_code" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rekening Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "rekening_no",
                    "required" => true,
                    "placeholder" => "Masukan Nomor Rekening",
                    "type" => "number",
                    "label" => "Rekening No:",

                    "required" => true,
                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "name",
                    "required" => true,
                    "placeholder" => "Masukan Nama",
                    "type" => "text",
                    "label" => "Name:",

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

<?php for ($i = 0; $i < count($m_rekening_code); $i++) {
    $focus = $m_rekening_code[$i]; ?>
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
                        "name" => "rekening_no",
                        "required" => true,
                        "placeholder" => "Masukan Nomor Rekening",
                        "type" => "number",
                        "label" => "Rekening No:",

                        "required" => true,
                        "value" => $focus->rekening_no
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Masukan Nama",
                        "type" => "text",
                        "label" => "Name:",

                        "required" => true,
                        "value" => $focus->name
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
        "object_name" => "Rekening",
        "detail" => "anda akan menghapus rekening $focus->rekening_no",
        "subdetail" => "Seluruh data yang terkait dengan nomor rekenings ini tidak akan ikut terhapus"
    ), true); ?>
<?php } ?>