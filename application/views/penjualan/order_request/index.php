<div class="row">
    <div class="col-lg-3 d-lg-block d-none">
        <div class="card card-custom gutter-b sticky-top" style="top: 100px">
            <div class="card-header py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Daftar Barang</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Klik untuk menambahkan ke Order Request </span>
                </h3>
            </div>
            <div class="card-body daftar_barang_container">
                <div class="scroll scroll-pull ps ps--active-y" data-scroll="true" data-wheel-propagation="true" style="max-height: 50vh; height: 100%; overflow: hidden;">
                    <?php foreach ($goods as $good) : ?>
                        <div class="d-flex align-items-center justify-content-between mb-5" data-toggle="tooltip" data-original-title="ID: <?= $good->id ?>" data-placement="right">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center mr-2">
                                <!--begin::Title-->
                                <div>
                                    <span class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder"><?= $good->brand_description ?></span>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Label-->
                            <button type="button" data-toggle="modal" data-target="#tambah_baru_<?= $good->id ?>" class="btn btn-white text-primary"><i class="fa text-primary fa-angle-right p-0"></i></button>
                            <!--end::Label-->
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">Order Request No #9999999</div>
                <div class="card-toolbar d-unset d-lg-none">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#daftarBarang">
                        Pilih Barang
                    </button>
                </div>
            </div>
            <form class="card-body" action="<?= current_url() ?>" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select id="pilih_customer" class="select2" onchange="change_customer(this)">
                                <option label="Label"></option>
                                <?php foreach ($customers as $customer) : ?>
                                    <option value="<?= $customer->id ?>"><?= $customer->name ?> (<?= $customer->branch ?>)</option>
                                <?php endforeach ?>
                            </select>
                            <a class="form-text text-info" href="<?= base_url("/index.php/setting/master/customer") ?>">
                                (manage customer)
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-end">
                            <!--begin::Daterange-->
                            <span class="p-2 rounded text-primary bg-light-primary font-weight-bold">
                                <h6 class="font-weight-bold m-0">Senin, 19 Juni 2020</h6>
                            </span>
                            <!--end::Daterange-->
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table table-separate table-head-custom table-checkable" id="daftar_barang_order">
                    <thead>
                        <tr class="text-left">
                            <th class="text-center" nowrap width="1">No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th class="text-center"><span class="mr-3">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <h5 class="text-right font-weight-bold">
                    Total <span id="total_harga_order">0</span>
                </h5>
            </form>
            <div class="card-footer text-right">
                <input type="Submit" class="btn btn-primary" />
            </div>
        </div>
    </div>
</div>