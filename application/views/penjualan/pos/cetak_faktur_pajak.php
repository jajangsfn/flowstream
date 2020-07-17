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
        <button type="submit" class="btn btn-primary"> Simpan </button>
    </div>
</form>