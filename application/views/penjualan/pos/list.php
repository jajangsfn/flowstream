<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Point of Sales</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a class="btn btn-primary font-weight-bolder" href="<?= base_url("/index.php/penjualan/pos/add") ?>">
                <i class="la la-plus"></i>Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="pos_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Order</th>
                    <th>Nomor Faktur</th>
                    <th>Customer</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->


<!-- Modal-->
<div class="modal fade" id="payment_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <form class="modal-content" action="<?= base_url("/index.php/api/bayar_pos") ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="pos_id_bayar">
                <div class="row">
                    <div class="col-lg-4" id="no_transaksi_cell">
                        <div class="form-group">
                            <label for="nomor_transaksi">Nomor Transaksi</label>
                            <input type="text" class="form-control" id="nomor_transaksi" readonly />
                        </div>
                    </div>
                    <div class="col-lg-4" id="salesman_cell">
                        <div class="form-group">
                            <label for="salesman_input">Salesman</label>
                            <input type="text" class="form-control" id="salesman_input" readonly />
                        </div>
                    </div>
                    <div class="col-lg-4" id="payment_total_cell">
                        <div class="form-group">
                            <label for="total_pembayaran">Total Pembayaran</label>
                            <input type="text" name="payment_total" class="form-control" id="total_pembayaran" readonly />
                        </div>
                    </div>
                    <div class="col-lg-6" id="payment_method_cell">
                        <div class="form-group w-100">
                            <label class="required">Metode Pembayaran</label>
                            <br>
                            <select class="form-control select2" name="payment_method" id="payment_method" data-width="100%" required onchange="change_payment_method()">
                                <?php foreach ($payment_methods as $option) { ?>
                                    <option value="<?= $option->detail_data ?>"><?= $option->detail_data ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4" id="nama_bank_cell" style="display: none;">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "bank",
                            "title" => "Pilih Bank",

                            "list" => $banks,
                            "identifier" => "detail_data",
                            "showable" => "detail_data",

                            "id" => "select_bank",

                            "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/bank"),
                            "object_name" => "bank",

                            "selected" => false,
                        ), true); ?>
                    </div>
                    <div class="col-lg-6" id="jumlah_bayar_cell">
                        <div class="form-group">
                            <label for="payment_paid">Pembayaran</label>
                            <input type="number" name="payment_paid" class="form-control" id="payment_paid" value="0" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "payment_description",
                            "placeholder" => "Masukan keterangan pembayaran",
                            "type" => "textarea",
                            "label" => "Keterangan Pembayaran",

                            "required" => false
                        ), true); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
            </div>
        </form>
    </div>
</div>
