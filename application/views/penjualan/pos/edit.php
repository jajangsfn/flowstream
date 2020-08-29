<div class="row">
    <div class="col-lg-3" id="daftar_barang_col_lg">
        <div class="card card-custom gutter-b sticky-top" style="top: 100px">
            <div class="card-header py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Daftar Barang</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Klik untuk menambahkan ke keranjang belanja </span>
                </h3>
            </div>
            <div class="card-body daftar_barang_container pt-0">
                <input type="text" class="form-control my-4" placeholder="Cari Barang" onkeyup="suggester_me(event, this)" />
                <div class="scroll scroll-pull ps ps--active-y goods_placement" data-scroll="true" data-wheel-propagation="true" style="max-height: 50vh; height: 100%; overflow: hidden;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9" id="order_request_col">
        <form id="pos_form" class="card card-custom gutter-b" action="<?= base_url("/index.php/api/edit_pos") ?>" method="POST">
            <input type="hidden" name="id" value="<?= $data_pos->id ?>">
            <div class="card-header">
                <div class="card-title">Point of Sales - <span id="pos_no" class="ml-2">Order No #<?= $data_pos->order_no ?></span></div>
                <div class="card-toolbar d-none" id="pilih_barang_modal_toggle">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#daftarBarang">
                        Pilih Barang
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <small>Customer</small>
                            <p class="lead font-weight-bold"><?= $data_pos->partner_name ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-end">
                            <!--begin::Daterange-->
                            <span class="p-2 rounded text-primary bg-light-primary font-weight-bold">
                                <h6 class="font-weight-bold m-0"><?= longdate_indo(date('Y-m-d', strtotime($data_pos->pos_date ? $data_pos->pos_date : $data_pos->created_date))) ?></h6>
                            </span>
                            <!--end::Daterange-->
                        </div>
                    </div>
                </div>
                <?php if ($data_pos->salesman_name) : ?>
                    <div>
                        <small>Salesman</small>
                        <p class="lead"><?= $data_pos->salesman_name ?></p>
                    </div>
                <?php endif ?>
                <div id="inv_no_container">
                    <small>Nomor Faktur</small>
                    <p class="lead" id="inv_no"><?= $data_pos->invoice_no ?></p>
                </div>
                <div class="form-group">
                    <label for="description_field">Deskripsi</label>
                    <textarea class="form-control" id="description_field" name="description" rows="3" placeholder="Masukan catatan order"><?= $data_pos->description ?></textarea>
                </div>
                <hr>
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
                                <th class="text-center"><span class="mr-3">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_pos->details as $index => $detail) : ?>
                                <tr id="<?= $detail->goods_id ?>">
                                    <td class="text-center font-weight-bold"><?= $index + 1 ?></td>
                                    <td>
                                        <div><?= $detail->barcode ?></div>
                                        <input type="hidden" name="barang[<?= $detail->goods_id ?>][goods_id]" value="<?= $detail->goods_id ?>">
                                    </td>
                                    <td>
                                        <div class="font-weight-bold"><?= substr($detail->goods_name, 0, strpos($detail->goods_name, " "))  ?></div>
                                        <div class="brand_description_show"><?= substr($detail->goods_name, strpos($detail->goods_name, " ") + 1)  ?></div>
                                        <input type="hidden" name="barang[<?= $detail->goods_id ?>][goods_name]" value="<?= $detail->goods_name ?>">
                                    </td>
                                    <td style="width: 90px;">
                                        <input type="number" class="form-control text-center" id="jumlah_<?= $detail->goods_id ?>" name="barang[<?= $detail->goods_id ?>][quantity]" value="<?= $detail->quantity ?>" min="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>" step="<?= $detail->ratio_flag == 1 ? $detail->converted_quantity : 1 ?>" onchange="hitung_ulang(<?= $detail->goods_id ?>)">
                                    </td>
                                    <td>
                                        <?= $detail->ratio_flag == 1 ? "Pieces" : $detail->unit_name ?>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right rupiah" name="barang[<?= $detail->goods_id ?>][price]" id="harga_<?= $detail->goods_id ?>" value="<?= $detail->price ?>" min="1" onchange="hitung_ulang(<?= $detail->goods_id ?>)">
                                    </td>
                                    <td style="width: 90px">
                                        <input type="number" class="form-control text-center" style="width: 100%;" name="barang[<?= $detail->goods_id ?>][discount]" id="diskon_<?= $detail->goods_id ?>" value="<?= $detail->discount ?>" min="0" max="100" onchange="hitung_ulang(<?= $detail->goods_id ?>)">
                                    </td>
                                    <td class="late_numeral text-right rupiah" id="total_harga_<?= $detail->goods_id ?>">
                                        <?= $detail->price * $detail->quantity * (100 - $detail->discount) / 100 ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="mr-3 btn btn-icon btn-light btn-hover-primary btn-sm" type="button" onclick="delete_baris(<?= $detail->goods_id ?>)">
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
                <div class="d-flex justify-content-between align-items-center">
                    <label class="checkbox">
                        <input type="checkbox" checked="checked" onchange="toggleshow()" /> Tampilkan Deskripsi Barang
                        <span></span>
                    </label>
                    <div class="text-right">
                        <p class="text-right m-0">
                            Subtotal <span id="total_harga_order" class="late_numeral">
                                <?php $toret = 0; ?>
                                <?php foreach ($data_pos->details as $detail) : ?>
                                    <?php $toret += ($detail->price * $detail->quantity * (100 - $detail->discount) / 100) ?>
                                <?php endforeach; ?>
                                <?php echo $toret ?>
                            </span>
                        </p>
                        <p class="text-right m-0">
                            Pajak <span id="tax_price" class="late_numeral">
                                <?php $taxret = 10 * $toret / 100 ?>
                                <?= $taxret; ?>
                            </span>
                        </p>
                        <h5 class="text-right font-weight-bold">
                            Total <span id="total_harga_order_tax" class="late_numeral">
                                <?= $taxret + $toret ?>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" id="submitButton" onclick="confirm_pos_submit()" class="btn btn-primary"> Simpan Perubahan </button>
            </div>
        </form>
    </div>
</div>
