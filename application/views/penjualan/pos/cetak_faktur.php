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
                        <th nowrap>Jumlah Order</th>
                        <th nowrap>Jumlah Tersedia</th>
                        <th nowrap>Jumlah Akhir</th>
                        <th nowrap>Satuan</th>
                        <th style="min-width: 100px">Harga</th>
                        <th class="text-center">Aksi</th>
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
                                <input type="hidden" name="barang[<?= $detail->goods_id ?>][goods_name]" value="<?= $detail->brand_name ?> - <?= $detail->brand_description ?>">
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <?= $detail->quantity ?>
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <?= $detail->ratio_flag == 1 ? $detail->converted_quantity * $detail->last_quantity : $detail->quantity  ?>
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <input type="number" name="barang[<?= $detail->goods_id ?>][quantity]" class="form-control text-center" id="jumlah_<?= $detail->goods_id ?>" value="<?php if ($detail->ratio_flag == 1) {
                                                                                                                                                                                        echo min($detail->quantity, $detail->converted_quantity * $detail->last_quantity);
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo min($detail->quantity, $detail->last_quantity);
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>" min="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>" max="<?php if ($detail->ratio_flag == 1) {
                                                                                                                                                                                                                                                                            echo $detail->converted_quantity * $detail->last_quantity;
                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                            echo $detail->last_quantity;
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                        ?>" onchange="hitung_ulang(<?= $detail->goods_id ?>)" step="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>">
                            </td>
                            <td>
                                <?= $detail->ratio_flag == 1 ? "PC" : $detail->unit_name ?>
                            </td>
                            <td style="width: 100px;" class="text-right" data-info="price">
                                <input type="hidden" name="barang[<?= $detail->goods_id ?>][price]" value="<?= $detail->price ?>">
                                <?= $detail->price ?>
                            </td>
                            <td style="width: 80px;" class="text-center d-none">
                                <?= $detail->discount == 0 ? "-" : $detail->discount . "%" ?>
                                <input type="hidden" name="barang[<?= $detail->goods_id ?>][discount]" value="<?= $detail->discount ?>">
                                <?php if ($detail->discount_code) : ?>
                                    <input type="hidden" name="barang[<?= $detail->goods_id ?>][discount_code]" value="<?= $detail->discount_code ?>">
                                <?php endif ?>
                            </td>
                            <td class="text-right rupiah d-none">
                                <?= $detail->quantity * $detail->price * (1 - $detail->discount / 100) ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-icon btn-light btn-hover-primary btn-sm" type="button" onclick="delete_baris(<?= $detail->goods_id ?>)">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="text-right">
            <p class="text-right m-0">
                Subtotal
                <span id="total_harga_order">
                    <?php
                    $subtotal = 0;
                    foreach ($data_or->details as $detail) {
                        $subtotal += ($detail->quantity * $detail->price * (1 - $detail->discount / 100));
                    }
                    echo $subtotal;
                    ?>
                </span>
            </p>
            <p class="text-right m-0">
                Pajak <span id="tax_price">
                    <?= 10 * $subtotal / 100 ?>
                </span>
            </p>
            <h5 class="text-right font-weight-bold">
                Total <span id="total_harga_order_tax">
                    <?= 110 * $subtotal / 100 ?>
                </span>
            </h5>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="button" class="btn btn-danger" onclick="confirm_pembatalan()"> Batalkan </button>
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nomor_transaksi">Nomor Transaksi</label>
                                <input type="text" class="form-control" id="nomor_transaksi" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="total_pembayaran">Total Pembayaran</label>
                                <input type="text" name="payment_total" class="form-control" id="total_pembayaran" readonly value="<?= 110 * $subtotal / 100 ?>" />
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
                            <div class="form-group">
                                <label for="payment_paid">Pembayaran</label>
                                <input type="number" name="payment_paid" class="form-control" id="payment_paid" min="0" />
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
                    <button type="submit" class="btn btn-primary font-weight-bold">Simpan dan Cetak</button>
                </div>
            </div>
        </div>
    </div>
</form>
