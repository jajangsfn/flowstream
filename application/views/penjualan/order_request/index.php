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
                                    <span class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder"><?= $good->name ?></span>
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
                        <tr id="29">
                            <td class="text-center font-weight-bold">1</td>
                            <td>1 <input type="hidden" name="29" value="29"></td>
                            <td>Barang Legal</td>
                            <td class="text-center">
                                <input type="number" class="form-control text-center" style="width: 70px;" id="jumlah_29" name="jumlah_29" value="1" min="1" onchange="ubah_jumlah('29')">
                            </td>
                            <td>Pcs</td>
                            <td class="text-right rupiah" nowrap id="harga_29">10000</td>
                            <td class="text-center" id="diskon_29">10%</td>
                            <td class="text-right rupiah" id="total_harga_29">9000</td>
                            <td class="text-center">
                                <button type="button" class="mr-3 btn btn-icon btn-light btn-hover-primary btn-sm" onclick="delete_baris('29')">
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
                    </tbody>
                </table>
                <h5 class="text-right font-weight-bold">
                    Total <span id="total_harga_order">9000</span>
                </h5>
            </form>
            <div class="card-footer text-right">
                <input type="Submit" class="btn btn-primary" />
            </div>
        </div>
    </div>
</div>