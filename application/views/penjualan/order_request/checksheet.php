<form id="checksheet_form" class="card card-custom gutter-b" action="<?= base_url("/index.php/api/save_checksheet/$data_or->id") ?>" method="POST">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Checksheet - Penyiapan Barang</div>
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
                        <th nowrap>Unit</th>
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
                            <td style="width: 70px;" class="text-center">
                                <input type="number" name="barang[<?= $detail->goods_id ?>][quantity]" class="form-control text-center" value="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity * $detail->last_quantity : $detail->last_quantity  ?>" min="0" step="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>">
                            </td>
                            <td>
                                <?= $detail->ratio_flag == 1 ? "pcs" : $detail->unit_initial ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="button" class="btn btn-danger" onclick="confirm_pembatalan()"> Batalkan </button>
        <button class="btn btn-primary" type="submit"> Simpan </button>
    </div>
</form>