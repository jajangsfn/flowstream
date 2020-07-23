<div class="row">
    <div class="col-lg-3 d-none" id="daftar_barang_col_lg">
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
    <div class="col-lg-12" id="order_request_col">
        <form class="card card-custom gutter-b" action="<?= base_url("/index.php/api/kirim_pos") ?>" method="POST">
            <div class="card-header">
                <div class="card-title">Point of Sales <span id="pos_no" class="ml-2" style="display: none;">No #</span></div>
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
                            <input type="hidden" name="invoice_no" id="inv_no_afterselect">
                            <select id="pilih_customer" class="select2" onchange="change_customer(this)" name="partner_id">
                                <option label="Label"></option>
                                <?php foreach ($customers as $customer) : ?>
                                    <option value="<?= $customer->id ?>"><?= $customer->name ?> (<?= $customer->branch ?>)</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group" id="user_salesman_id_cell" style="display: none;">
                            <small>Pilih Salesman</small>
                            <select id="pilih_salesman" name="user_salesman_id" onchange="salesman_changed()">
                                <option label="Label"></option>
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
                <div class="form-group" id="inv_no_container" style="display: none;">
                    <small>Nomor Faktur</small>
                    <p class="lead" id="inv_no"></p>
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
                <button type="button" id="payment-button" data-toggle="modal" data-target="#payment_modal" class="btn btn-primary" disabled> Lanjutkan ke Pembayaran </button>
            </div>

            <!-- Modal-->
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
                                        <input type="text" class="form-control" id="salesman_input" readonly />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran</label>
                                        <input type="text" name="payment_total" class="form-control" id="total_pembayaran" readonly />
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
    </div>
</div>