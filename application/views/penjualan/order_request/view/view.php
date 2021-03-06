<div class="card card-custom gutter-b">
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
                        <th nowrap>Jumlah</th>
                        <th nowrap>Unit</th>
                        <th style="min-width: 100px">Harga</th>
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
                                <?= $detail->brand_name ?> - <?= $detail->brand_description ?> (<?= $detail->sku_code ?>)
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <?= $detail->quantity ?>
                            </td>
                            <td>
                                <?= $detail->ratio_flag == 1 ? "pcs" : $detail->unit_initial ?>
                            </td>
                            <td style="width: 100px;" class="text-right rupiah">
                                <?= $detail->price ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <p class="text-right m-0">
                Subtotal <span id="total_harga_order">
                    <?php
                    $i = 0;
                    foreach ($data_or->details as $detail) {
                        $i += $detail->total;
                    }
                    echo $i;
                    ?>
                </span>
            </p>
            <p class="text-right m-0">
                Pajak <span id="tax_price">
                    <?= 10 * $i / 100 ?>
                </span>
            </p>
            <h5 class="text-right font-weight-bold">
                Total <span id="total_harga_order_tax">
                    <?= 110 * $i / 100 ?>
                </span>
            </h5>
        </div>
    </div>
</div>