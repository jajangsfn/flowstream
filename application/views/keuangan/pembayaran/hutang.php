<?php if (count($suppliers) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card gutter-b">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <select class="select2" data-width="3500px" onchange="change_supplier(this)">
                        <option label="" value="" selected disabled>Pilih Customer</option>
                        <?php foreach ($suppliers as $supplier) : ?>
                            <option value="<?= $supplier->id ?>"><?= $supplier->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="invoice_cell" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="1">No</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoice_list">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="card">
        <div class="card-body text-center">
            <h5 class="text-success m-0">
                Belum Terdapat Hutang untuk Dibayar
            </h5>
        </div>
    </div>
<?php endif ?>

<div class="modal fade" id="tpp_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="<?= base_url("/index.php/api/pembayaran_hutang") ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran Hutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Tanggal Invoice</td>
                        <td id="invoice_date" class="pl-5"></td>
                    </tr>
                    <tr>
                        <td>Nomor Invoice</td>
                        <td id="invoice_no" class="pl-5"></td>
                    </tr>
                    <tr>
                        <td>Total Tagihan</td>
                        <td id="total_tagihan_str" class="pl-5"></td>
                    </tr>
                    <tr>
                        <td>Sisa Tagihan</td>
                        <td id="sisa_tagihan_str" class="pl-5"></td>
                    </tr>
                </table>
                <hr>
                <input type="hidden" name="id" id="tpp_id">
                <div class="form-group w-100">
                    <label for="new_payment">Tambahkan Pembayaran</label>
                    <input type="number" name="payment" id="new_payment" class="form-control" min="0" step="0.01" required />
                </div>
            </div>
            <div class="modal-footer p-2 d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary mt-1">
                    Bayar
                </button>
            </div>
        </form>
    </div>
</div>