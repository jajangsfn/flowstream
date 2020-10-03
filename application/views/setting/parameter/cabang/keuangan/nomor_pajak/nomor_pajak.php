<!--begin::Card-->
<?php $this->load->view("setting/parameter/cabang/keuangan/component/navigation"); ?>
<!--end::Card-->

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="card-title mb-0">
                <h3 class="card-label mb-0">
                    Daftar Nomor Pajak
                </h3>
            </div>
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#add_param_tax_no">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
        <table class="table table-separate table-head-custom table-checkable" id="tax_no_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Urutan Awal</th>
                    <th>Urutan Akhir</th>
                    <th>Sequence</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Ubah</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="add_param_tax_no" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah nomor rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="modal-body" action="<?= base_url("/index.php/api/add_tax_no/$data_branch->id") ?>" method="POST">
                <table class="table table-borderless">
                    <tr class="py-2">
                        <td class="mr-3 w-25">Nomor awal</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" class="form-control w-100" name="start_tax"></input>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Nomor akhir</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" class="form-control w-100" name="end_tax"></input>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Tahun</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" class="form-control w-100" name="years"></input>
                        </td>
                    </tr>
                </table>
                <div class="text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_param_tax_no" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Parameter Kode Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="modal-body" action="<?= base_url("/index.php/api/edit_tax_no") ?>" method="POST">
                <input type="hidden" name="id" id="id_edit">

                <table class="table table-borderless">
                    <tr class="py-2">
                        <td class="mr-3 w-25">Nomor awal</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" id="start_tax_edit" class="form-control w-100" name="start_tax"></input>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Nomor akhir</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" id="end_tax_edit" class="form-control w-100" name="end_tax"></input>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Sequence</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" id="sequence_edit" class="form-control w-100" name="sequence"></input>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Tahun</td>
                        <td>
                            :
                        </td>
                        <td class="w-75">
                            <input type="number" id="years_edit" class="form-control w-100" name="years"></input>
                        </td>
                    </tr>
                </table>
                <div class="text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>