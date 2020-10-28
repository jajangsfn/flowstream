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
                        <th class="text-center" style="max-width: 100px;">Availability</th>
                        <th class="text-center">Urutan</th>
                        <th nowrap style="min-width: 100px;">Kode Barang</th>
                        <th nowrap>Nama Barang</th>
                        <th nowrap>Jumlah Order</th>
                        <th nowrap>Jumlah Tersedia</th>
                        <th nowrap>Unit</th>
                    </tr>
                </thead>
                <tbody id='checksheet_tablebody'>
                    <?php $unavailable_details = array(); ?>
                    <?php foreach ($data_or->details as $key => $detail) : ?>
                        <?php if ($detail->available == 1 || is_null($detail->available)) : ?>
                            <tr id="<?= $detail->goods_id ?>">
                                <td class="text-center font-weight-bold"></td>
                                <td class="text-center">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="barang[<?= $detail->goods_id ?>][available]" <?= is_null($detail->available) || $detail->available == 1 ? "checked='checked'" : "" ?> />
                                        <span></span>
                                        <p class="mb-2 invisible">.</p>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex w-100 justify-content-center align-items-center">
                                        <input type="number" name="barang[<?= $detail->goods_id ?>][order_placement]" style="max-width: 100px" class="form-control text-center" value="<?= $detail->order_placement ? $detail->order_placement : $key + 1 ?>" min="1">
                                    </div>
                                </td>
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
                                    <input type="number" name="barang[<?= $detail->goods_id ?>][quantity]" class="form-control text-center" value="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity * $detail->quantity : $detail->quantity  ?>" min="0" step="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>">
                                </td>
                                <td>
                                    <?= $detail->ratio_flag == 1 ? "pcs" : $detail->unit_initial ?>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php array_push($unavailable_details, $detail) ?>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <?php if (count($unavailable_details) > 0) : ?>
            <div class="text-center">
                <button class="btn btn-primary" type="button" data-toggle="modal" id="unavailable_button" data-target="#unavailable_checksheet">
                    Tambah Barang
                </button>
            </div>
        <?php endif; ?>
    </div>

    <div class="card-footer text-right">
        <button type="button" class="btn btn-danger" onclick="confirm_pembatalan()"> Batalkan </button>
        <button class="btn btn-primary" type="submit"> Simpan </button>
    </div>
</form>

<div class="modal fade" id="unavailable_checksheet" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table id="unavailable_table" class="table table-condensed">
                    <thead>
                        <tr>
                            <th nowrap>Barcode</th>
                            <th nowrap>Barang</th>
                            <th nowrap>Jumlah Order</th>
                            <th nowrap class="text-center">Action</th>
                        </tr>
                    </thead>
                    <?php foreach ($unavailable_details as $key => $detail) : ?>
                        <tr id="unavailable_<?= $key ?>">
                            <td>
                                <div><?= $detail->barcode ?></div>
                            </td>
                            <td>
                                <?= $detail->brand_name ?> - <?= $detail->brand_description ?> (<?= $detail->sku_code ?>)
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <?= $detail->quantity ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary" type="button" onclick="tambahkan_unavailable(
                                    '<?= $detail->goods_id ?>',
                                    '<?= $detail->barcode ?>',
                                    '<?= $detail->brand_name ?>',
                                    '<?= $detail->brand_description ?>',
                                    '<?= $detail->sku_code ?>',
                                    '<?= $detail->quantity ?>',
                                    '<?= $detail->ratio_flag ?>',
                                    '<?= $detail->converted_quantity ?>',
                                    '<?= $detail->quantity ?>',
                                    '<?= $detail->unit_initial ?>',
                                    '<?= $detail->order_placement ?>',
                                    'unavailable_<?= $key ?>'
                                )">
                                    Tambahkan
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>