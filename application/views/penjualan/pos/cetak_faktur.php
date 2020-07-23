<form class="card card-custom gutter-b" action="<?= base_url("/index.php/api/convert_to_pos/$data_or->id") ?>" method="POST">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Order Request</div>
        <!--begin::Daterange-->
        <span class="p-2 rounded text-primary bg-light-primary font-weight-bold">
            <h6 class="font-weight-bold m-0"><?= longdate_indo(date('Y-m-d', strtotime($data_or->order_date))) ?></h6>
        </span>
        <!--end::Daterange-->
    </div>
    <div class="card-body">
        <small>Customer</small>
        <p class="lead"><?= $data_or->partner_name ?></p>
        <small>Salesman</small>
        <p class="lead"><?= $data_or->user_salesman_name ?></p>
        <small>Nomor Order</small>
        <p class="lead"><?= $data_or->order_no ?></p>
        <small>Nomor Faktur</small>
        <p class="lead" id="nomor_faktur_text"></p>
        <input type="hidden" name="invoice_no" id="nomor_faktur_input">
        <hr>
        <?php if ($data_or->description) : ?>
            <small>Deskripsi</small>
            <p class="lead"><?= $data_or->description ?></p>
            <hr>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-separate table-head-custom table-checkable" id="daftar_barang_order" style="font-size: 1rem !important;">
                <thead>
                    <tr class="text-left">
                        <th class="text-center" nowrap width="1">No</th>
                        <th nowrap style="min-width: 100px;">Kode Barang</th>
                        <th nowrap>Nama Barang</th>
                        <th nowrap>Jumlah</th>
                        <th nowrap>Satuan</th>
                        <th style="min-width: 100px">Harga</th>
                        <th>Diskon</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_or->details as $key => $detail) : ?>
                        <tr id="<?= $detail->goods_id ?>">
                            <td class="text-center font-weight-bold"><?= $key + 1 ?></td>
                            <td>
                                <div><?= $detail->barcode ?></div>
                            </td>
                            <td>
                                <?= $detail->brand_name ?> - <?= $detail->brand_description ?>
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <?= $detail->quantity ?>
                            </td>
                            <td>
                                <?= $detail->unit_name ?>
                            </td>
                            <td style="width: 100px;" class="text-right">
                                <?= $detail->price ?>
                            </td>
                            <td style="width: 80px;" class="text-center">
                                <?= $detail->discount == 0 ? "-" : $detail->discount . "%" ?>
                            </td>
                            <td class="text-right rupiah">
                                <?= $detail->total ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <h5 class="text-right font-weight-bold">
            Total <span id="total_harga_order">
                <?php
                $i = 0;
                foreach ($data_or->details as $detail) {
                    $i += $detail->total;
                }
                echo $i;
                ?>
            </span>
        </h5>
    </div>
    <div class="card-footer text-right">
        <button type="button" data-toggle="modal" data-target="#payment_modal" class="btn btn-primary"> Lanjutkan ke Pembayaran </button>
    </div>

    <div class="modal fade" id="payment_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nomor_transaksi">Nomor Transaksi</label>
                                <input type="text" class="form-control" id="nomor_transaksi" readonly />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="salesman_input">Salesman</label>
                                <input type="text" class="form-control" id="salesman_input" readonly value="<?= $data_or->user_salesman_name ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="total_pembayaran">Total Pembayaran</label>
                                <input type="text" name="payment_total" class="form-control" id="total_pembayaran" readonly value="<?= $i ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6" id="payment_method_cell">
                            <div class="form-group w-100">
                                <label class="required">Pilih metode pembayaran</label>
                                <select class="form-control select2" name="payment_method" id="payment_method" required onchange="change_payment_method()">
                                    <?php foreach ($payment_methods as $option) { ?>
                                        <?php if ($option->detail_data == "CASH") : ?>
                                            <option value="<?= $option->detail_data ?>" selected><?= $option->detail_data ?></option>
                                        <?php else : ?>
                                            <option value="<?= $option->detail_data ?>"><?= $option->detail_data ?></option>
                                        <?php endif ?>
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

                                "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/bank"),
                                "object_name" => "bank",

                                "selected" => false,
                            ), true); ?>
                        </div>
                        <div class="col-lg-6" id="jumlah_bayar_cell">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "payment_paid",
                                "placeholder" => "Masukan jumlah bayar",
                                "type" => "text",
                                "label" => "Jumlah Bayar",

                                "required" => true
                            ), true); ?>
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
                    <button type="submit" class="btn btn-primary font-weight-bold">Simpan dan Cetak</button>
                </div>
            </div>
        </div>
    </div>
</form>