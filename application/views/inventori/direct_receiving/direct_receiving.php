<div class="row">
    <!-- card for search product list -->
    <div class="col-md-3">
        <div class="card card-custom w-100" style="overflow: hidden;position: relative;">

            <div class="card-body">
                <!-- search input -->
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "goods",
                    "type" => "text",
                    "id" => "goods_id",
                    "required" => true,
                    "placeholder" => "Isi Nama Barang",
                    "label" => "Search",
                    "help" => "",
                    "value" => false,
                    "autocomplete" => "off",
                ), true); ?>
                <hr>
                <ul class="navi navi-hover navi-active" id="goods_list" style="overflow: scroll;height: 400px">
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?= $this->session->flashdata('msg'); ?>
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-2 mr-5">Tambah Direct Receiving</h5>
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <!--begin::Daterange-->
                        <a href="#" class="btn btn-light-primary btn-sm font-weight-bold " id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="" data-placement="left" data-original-title="Select dashboard daterange">
                            <span class="font-weight-bold" id="kt_dashboard_daterangepicker_date"><?= $tgl_indo ?></span>
                        </a>
                        <!--end::Daterange-->

                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <!-- end card header -->

            <div class="card-body">
                <form method="post" action="<?= base_url() ?>index.php/services/v1/inventori/save_direct_receiving" id="form_purchase">
                    <input type="hidden" name="salesman_id" id="salesman_id">
                    <input type="hidden" name="branch_id" id="branch_id">
                    <input type="hidden" name="branch_name" id="branch_name">
                    <input type="hidden" name="partner_name" id="partner_name">
                    <input type="hidden" name="tgl_po" class="form-control col-md-3" readonly value="<?= date('Y-m-d') ?>">
                    <div class="row mb-5">
                        <label class="col-form-label col-md-2">Supplier</label>
                        <select name="supplier" id="supplier_id" class="col-md-3 form-control selectpicker" data-live-search="true" onchange="show_supplier_detail()">
                            <option value="" selected>Pilih Supplier</option>
                            <?php
                            foreach ($supplier as $key => $val) { ?>
                                <option value="<?= $val->id ?>"><?= $val->name ?></option>
                            <?php }
                            ?>
                        </select>

                        <label class="col-form-label col-md-3 text-right">No Purchase Order</label>
                        <input type="text" name="purchase_order_no" class="form-control col-md-3" readonly value="<?= $po_no ?>">
                    </div>

                    <div class="row mb-5">
                        <label class="col-form-label col-md-2">Salesman</label>
                        <select name="salesman" id="partner_salesman" class="col-md-3 form-control selectpicker" data-live-search="true" required="" onchange="show_goods_per_salesman()">
                        </select>
                        <div class="col-md-1"></div>
                        <label class="col-form-label col-md-2 text-right">No Referensi</label>
                        <input type="text" name="reference_no" class="col-md-3 form-control" value="<?= $po_no ?>">
                    </div>

                    <div class="row mb-5">
                        <label class="col-form-label col-md-2">Tanggal Penerimaan</label>
                        <input type="date" name="receive_date" class="form-control col-md-3" value="<?= date("Y-m-d") ?>" required>
                        <div class="col-md-1"></div>
                        <label class="col-form-label col-md-2 text-right">No Receive</label>
                        <input type="text" name="purchase_receive_no" class="form-control col-md-3" readonly value="<?= $purchase_receive_no ?>">
                    </div>

                    <div class="row mb-5">
                        <!-- <div class="col-md-1"></div> -->
                        <label class="col-form-label col-md-2">Deskripsi</label>
                        <textarea name="description" class="form-control col-md-9"></textarea>
                    </div>

                    <hr>
                    <div class="row p-6">
                        <div class="col-md-10 text-right h3">
                            Total
                        </div>
                        <div class="col-md-2 h3" id="grant_total">
                            0
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang/PLU</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Quantity Order (PCS)</th>
                                    <th>Discount</th>
                                    <th>Jumlah</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="goods_chart_table">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <button type='button' class="btn btn-light-success btn-md" id="btn_save_purchase">
                                            <span class="fa fa-save"></span>
                                            Save
                                        </button>
                                        <a href="<?= base_url() ?>index.php/inventori/receiving" class="btn btn-light-danger btn-md">
                                            <span class="fa la-arrow-left"></span> Cancel
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card-custom -->
    </div>
    <!-- end col-9 -->
</div>
<!-- end row -->
<!-- </div> -->


<div class="modal fade" id="tambahBrgKeChart" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <form class="form card" method="POST" action="<?= current_url() ?>"> -->
            <div class="card-header">
                Tambah ke Troli
            </div>
            <div class="card-body">
                <input type="hidden" name="id_goods" id="id_goods">
                <div class="form-group row">
                    <div class="col-form-label col-md-3">Kode Barang</div>
                    <div class="col-form-label col-sm-1 mr-0">:</div>
                    <div class="col-form-label col-md-8" id="goods_code"></div>
                </div>
                <div class="form-group row">
                    <div class="col-form-label col-md-3">Nama Barang</div>
                    <div class="col-form-label col-sm-1 mr-0">:</div>
                    <div class="col-form-label col-md-8" id="goods_name"></div>
                </div>

                <div class="form-group row">
                    <div class="col-form-label col-md-3">Harga</div>
                    <div class="col-form-label col-sm-1">:</div>
                    <div class="col-form-label col-md-8" id="goods_price"></div>
                </div>

                <div class="form-group row">
                    <div class="col-form-label col-md-3">Qty</div>
                    <div class="col-form-label col-sm-1">:</div>
                    <div class="col-form-label col-md-8">
                        <input type="number" name="qty_chart" id="goods_qty" class="form-control" placeholder="Isi Qty Barang" value="1">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary mr-2" onclick="add_to_chart()">Add to Chart</button>
                <?= $this->load->view("component/button/close", "", true); ?>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>