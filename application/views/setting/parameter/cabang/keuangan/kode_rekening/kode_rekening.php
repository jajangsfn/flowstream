<!--begin::Card-->
<?php $this->load->view("setting/parameter/cabang/keuangan/component/navigation"); ?>
<!--end::Card-->

<div class="card">
    <div class="card-body">
        <table class="table table-separate table-head-custom table-checkable" id="parameter_kode_rekening_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jurnal</th>
                    <th>Tipe Jurnal</th>
                    <th>Sequence Line</th>
                    <th>Kode Akun</th>
                    <th>Ubah</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="edit_param_kode_rekening" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Parameter Kode Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="modal-body" action="<?= base_url("/index.php/api/edit_parameter_kode_rekening") ?>" method="POST">
                <input type="hidden" name="id" id="id_param_kode_rekening_edit">

                <table class="table table-borderless">
                    <tr class="py-2">
                        <td class="mr-3 w-25">Kode Jurnal</td>
                        <td class="w-75">
                            : <span id="JOURNAL_CD_edit"></span>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Tipe Jurnal</td>
                        <td class="w-75">
                            : <span id="JOURNAL_TYPE_edit"></span>
                        </td>
                    </tr>
                    <tr class="pt-2">
                        <td class="mr-3 w-25">Sequence Line</td>
                        <td class="w-75">
                            : <span id="SEQ_LINE_edit"></span>
                        </td>
                    </tr>
                </table>
                <div class="p-3">
                    <hr>
                </div>
                <?= $this->load->view("component/input/flowstream_select", array(
                    "name" => "ACCOUNT_CODE",
                    "title" => "Kode Akun",

                    "list" => $accounts,
                    "identifier" => "acc_code",
                    "showable" => "acc_name",

                    "id" => "ACCOUNT_CODE_edit",

                    "manage_url" => base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/kode_rekening"),
                    "object_name" => "kode akun",

                    "selected" => false,
                ), true); ?>
                <div class="text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>