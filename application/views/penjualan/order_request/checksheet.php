<form id="checksheet_form" class="card card-custom gutter-b" action="<?= base_url("/index.php/api/save_checksheet/$data_or->id") ?>" method="POST">
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
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <?= $detail->quantity ?>
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <input type="number" name="barang[<?= $detail->goods_id ?>][available_quantity]" class="form-control text-center" value="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity * $detail->last_quantity : $detail->last_quantity  ?>" step="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>">
                            </td>
                            <td style="width: 70px;" class="text-center">
                                <input type="number" name="barang[<?= $detail->goods_id ?>][quantity]" class="form-control text-center" id="jumlah_<?= $detail->goods_id ?>" value="<?php if ($detail->ratio_flag == 1) {
                                                                                                                                                                                        echo min($detail->checksheet_qty ? $detail->checksheet_qty : $detail->quantity, $detail->converted_quantity * $detail->last_quantity);
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo min($detail->checksheet_qty ? $detail->checksheet_qty : $detail->quantity, $detail->last_quantity);
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>" min="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 0 ?>" onchange="hitung_ulang(<?= $detail->goods_id ?>)" step="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>">
                            </td>
                            <td>
                                <?= $detail->ratio_flag == 1 ? "PCS" : $detail->unit_initial ?>
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
    </div>

    <div class="card-footer text-right">
        <button type="button" class="btn btn-danger" onclick="confirm_pembatalan()"> Batalkan </button>
        <button class="btn btn-primary" type="submit"> Simpan </button>
    </div>
</form>
