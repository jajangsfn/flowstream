<?php if (count($customers) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card gutter-b">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <select class="select2" data-width="3500px" onchange="change_customer(this)">
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
                                    <th>No</th>
                                    <th>Invoice No</th>
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
        <div class="col-md-6 after_invoice_cell" style="display: none;">
            <div class="card" style="min-height: 175px">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <table id="detail_table">

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 after_invoice_cell" style="display: none;">
            <div class="card" style="min-height: 175px">
                <form class="card-body d-flex justify-content-center align-items-center flex-column" action="<?= base_url("/index.php/api/pembayaran_piutang") ?>" method="POST">
                    <input type="hidden" name="invoice_no" id="invoice_no_input">
                    <div class="form-group w-100">
                        <label for="new_payment" class="required">Tambahkan Pembayaran</label>
                        <input type="number" name="new_payment" id="new_payment" class="form-control" min="0" step="0.01" required />
                    </div>
                    <button type="submit" class="btn btn-primary mt-1">
                        Bayar
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="card">
        <div class="card-body text-center">
            <h5 class="text-success m-0">
                Belum Terdapat Piutang untuk Dibayar
            </h5>
        </div>
    </div>
<?php endif ?>

<div class="modal fade" id="tpp_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran Piutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            
            </div>
        </div>
    </div>
</div>