<!--begin::Card-->
<?php $this->load->view("setting/parameter/cabang/keuangan/component/navigation"); ?>
<!--end::Card-->

<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 col-12">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        Daftar Kelompok Akun Neraca Saldo Akhir
                    </h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_parameter_neraca_saldo_akhir">
                        <i class="la la-plus"></i>Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="parameter_neraca_saldo_akhir_table">
                    <thead>
                        <tr>
                            <th width="1">No</th>
                            <th>Kelompok Akun</th>
                            <th>Nama Akun</th>
                            <th width="1">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <div class="col-lg-2"></div>
</div>

<div class="modal fade" id="tambah_parameter_neraca_saldo_akhir" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= base_url("/index.php/api/add_parameter_neraca_saldo_akhir") ?>">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <h3 class="card-header border-0 text-center">
                    Tambah Parameter Neraca Saldo Akhir
                </h3>
                <div class="card-body">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "acc_code",
                        "title" => "Kode Akun",

                        "list" => $accounts,
                        "identifier" => "acc_code",
                        "showable" => "acc_code_name",

                        "manage_url" => base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/kode_rekening"),
                        "object_name" => "kode akun",

                        "selected" => false,
                        "required" => true
                    ), true); ?>
                </div>
                <div class="card-footer border-0 text-center">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>