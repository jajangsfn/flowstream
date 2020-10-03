<?php if (count($customers) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card gutter-b">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <select class="select2" data-width="3500px" onchange="change_customer(this)" id="main_customer_selector">
                        <option label="" value="" selected disabled>Pilih Customer</option>
                        <?php foreach ($customers as $customer) : ?>
                            <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
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
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoice_list">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="lead font-weight-bold">
                                        Full Total
                                    </td>
                                    <td id="full_total_cell" class="lead font-weight-bold text-primary">

                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="card">
        <div class="card-body text-center">
            <h5 class="text-success">
                Belum Terdapat Piutang untuk Dibayar
            </h5>
            <a class="btn btn-primary" href="<?= base_url("/index.php/keuangan/pembayaran/piutang/histori") ?>">
                Histori pembayaran piutang
            </a>
        </div>
    </div>
<?php endif ?>

<div class="modal fade" id="tpp_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="<?= base_url("/index.php/api/pembayaran_piutang") ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran Piutang</h5>
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