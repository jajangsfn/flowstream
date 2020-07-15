<div class="row">
    <div class="col-lg-3 d-none" id="daftar_barang_col_lg">
        <div class="card card-custom gutter-b sticky-top" style="top: 100px">
            <div class="card-header py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Daftar Barang</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Klik untuk menambahkan ke Order Request </span>
                </h3>
            </div>
            <div class="card-body daftar_barang_container pt-0">
                <input type="text" class="form-control my-4" placeholder="Cari Barang" onkeyup="suggester_me(this)" />
                <div class="scroll scroll-pull ps ps--active-y goods_placement" data-scroll="true" data-wheel-propagation="true" style="max-height: 50vh; height: 100%; overflow: hidden;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" id="order_request_col">
        <form class="card card-custom gutter-b" action="<?= base_url("/index.php/api/kirim_order_request") ?>" method="POST">
            <div class="card-header">
                <div class="card-title">Order Request <span id="or_no" class="d-none ml-2">No #</span></div>
                <div class="card-toolbar d-none" id="pilih_barang_modal_toggle">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#daftarBarang">
                        Pilih Barang
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="hidden" name="branch_id" id="branch_id_afterselect">
                            <input type="hidden" name="partner_name" id="partner_name_afterselect">
                            <input type="hidden" name="order_no" id="order_no_afterselect">
                            <select id="pilih_customer" class="select2" onchange="change_customer(this)" name="partner_id">
                                <option label="Label"></option>
                                <?php foreach ($customers as $customer) : ?>
                                    <option value="<?= $customer->id ?>"><?= $customer->name ?> (<?= $customer->branch ?>)</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-end">
                            <!--begin::Daterange-->
                            <span class="p-2 rounded text-primary bg-light-primary font-weight-bold">
                                <h6 class="font-weight-bold m-0"><?= longdate_indo(date('Y-m-d')) ?></h6>
                            </span>
                            <!--end::Daterange-->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description_field">Deskripsi</label>
                    <textarea class="form-control" id="description_field" name="description" rows="3" placeholder="Masukan catatan order"></textarea>
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
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <label class="checkbox">
                        <input type="checkbox" checked="checked" onchange="toggleshow()" /> Tampilkan Deskripsi Barang
                        <span></span>
                    </label>
                    <h5 class="text-right font-weight-bold">
                        Total <span id="total_harga_order">0</span>
                    </h5>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary" disabled> Cetak </button>
            </div>
        </form>
    </div>
</div>