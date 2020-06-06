<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Barang</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambahMasterBarangModal">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Barcode</th>
                    <th>SKU</th>
                    <th>PLU</th>
                    <th>Division</th>
                    <th>Sub-Division</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Package</th>
                    <th>Color</th>
                    <th>Unit</th>
                    <th>HPP</th>
                    <th>Quantity</th>
                    <th>Tax</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($list_barang); $i++) {
                    $barang = $list_barang[$i]; ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $barang->name ?></td>
                        <td><?= $barang->barcode ?></td>
                        <td><?= $barang->sku_code ?></td>
                        <td><?= $barang->plu_code ?></td>
                        <td><?= $barang->division ?></td>
                        <td><?= $barang->sub_division ?></td>
                        <td><?= $barang->category ?></td>
                        <td><?= $barang->sub_category ?></td>
                        <td><?= $barang->package ?></td>
                        <td><?= $barang->color ?></td>
                        <td><?= $barang->unit ?></td>
                        <td><?= $barang->hpp ?></td>
                        <td><?= $barang->quantity ?></td>
                        <td><?= $barang->tax ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<!-- Modal-->
<div class="modal fade" id="tambahMasterBarangModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= current_url() ?>">
                <div class="card-header">
                    Tambah Master Data Barang
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" placeholder="Masukan nama barang" name="name" required />
                            <span class="form-text text-muted">Masukan nama barang</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Barcode:</label>
                            <input type="number" class="form-control" placeholder="Masukan barcode" name="barcode" required />
                            <span class="form-text text-muted">Masukan angka pada barcode</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SKU Code:</label>
                            <input type="text" class="form-control" placeholder="Masukan Kode SKU" name="sku_code" required />
                            <span class="form-text text-muted">Masukan kode <em>Stock Keeping Unit</em></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>PLU Code:</label>
                            <input type="text" class="form-control" placeholder="Masukan Kode PLU" name="plu_code" required />
                            <span class="form-text text-muted">Masukan kode <em>Price Look-Up</em></span>
                        </div>
                    </div>

                    <div class="col-md-12 py-5">
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <select class="form-control select2" name="division">
                                <option value="" selected disabled>Pilih Division</option>
                                <option value="AK">Alaska</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <select class="form-control select2" name="sub_division">
                                <option value="" selected disabled>Pilih Sub Division</option>
                                <option value="AK">Alaska</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <select class="form-control select2" name="category">
                                <option value="" selected disabled>Pilih Category</option>
                                <option value="AK">Alaska</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <select class="form-control select2" name="sub_category">
                                <option value="" selected disabled>Pilih Sub Category</option>
                                <option value="AK">Alaska</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <select class="form-control select2" name="package">
                                <option value="" selected disabled>Pilih Package</option>
                                <option value="AK">Alaska</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <select class="form-control select2" name="color">
                                <option value="" selected disabled>Pilih Color</option>
                                <option value="AK">Alaska</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 py-5">
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>HPP:</label>
                            <input type="text" class="form-control" placeholder="Masukan HPP" name="hpp" />
                            <span class="form-text text-muted">Masukan HPP</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity:</label>
                            <input type="number" class="form-control" placeholder="Masukan Kuantitas" name="quantity" />
                            <span class="form-text text-muted">Masukan Quantity</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Rekening:</label>
                            <input type="text" class="form-control" placeholder="Not Implemented" readonly disabled />
                            <span class="form-text text-danger">Not Implemented</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tax:</label>
                            <input type="number" class="form-control" placeholder="Masukan Pajak" name="tax" />
                            <span class="form-text text-muted">Masukan Pajak / tax</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>