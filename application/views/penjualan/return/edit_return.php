 <?=$this->session->flashdata('msg');?>
 <!--begin::Card-->
<div class="card card-custom">
  <div class="card-header flex-wrap">
        <div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
          <div class="d-flex align-items-center flex-wrap mr-1">
          <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline mr-5">
            <!--begin::Page Title-->
              <h5 class="text-dark font-weight-bold my-2 mr-5">Edit Data Retur Penjualan</h5>
            </div>
            <!--end::Page Heading-->
          </div>
          <!--end::Info-->
          <!--begin::Toolbar-->
          <div class="d-flex align-items-center">
          <!--begin::Daterange-->
            <div class="btn btn-light-primary btn-sm font-weight-bold " id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="" data-placement="left">
              <span class="font-weight-bold" id="kt_dashboard_daterangepicker_date"><?=$tgl_indo?></span>
            </div>
          <!--end::Daterange-->

          </div>
          <!--end::Toolbar-->
    </div>
  </div>
        <!-- end card header -->
     <div class="card-body">
        <form method="post" action="<?=base_url()?>index.php/penjualan/save_return" id="form_return">
          <!-- <input type="hidden" name="tgl_po" class="form-control col-md-3" readonly value="<?=date('Y-m-d')?>"> -->
          <input type="hidden" name="id" class="form-control col-md-3" id="return_id" readonly value="<?=($master) ? $master[0]->id : ""?>">

          <div class="row mb-5">
            <div class="col-md-1"></div>
            <div class="col-form-label col-md-2 text-right">Customer</div>
            <div class="col-md-3">
              <select name="supplier" id="supplier_id" class="form-control selectpicker" data-live-search="true" required="">
                  <option value="" selected>Pilih Customer</option>
                  <?php
                    foreach ($customer as $key => $val) {
                      if ($master && ($master[0]->partner_id == $val->id)) {
                      ?>
                      <option value="<?=$val->id?>" selected><?=$val->name?></option>
                  <?php }else { ?>
                      <option value="<?=$val->id?>"><?=$val->name?></option>
                  <?php }
                    }
                  ?>
              </select>
            </div>
            <div class="col-md-2 text-right">
              <label class="col-form-label">Nomor Retur</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="return_no" class="form-control" readonly value="<?=($master) ? $master[0]->return_no: $return_no ?>">
            </div>

          </div>


          <div class="row mb-3">
            <div class="col-md-1"></div>
            <div class="col-md-2 text-right col-form-label">
                <label>Nomor Nota</label>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-3">
                      <input type="text" name="nro" id="nro" class="form-control" placeholder="No Invoice. . ." aria-label="" aria-describedby="basic-addon1" value="<?=($master) ? $master[0]->reference_no : ""?>">
                    <div class="input-group-prepend">
                       <button class="btn btn-info" type="button" onclick="search_pos_order()">search</button>
                     </div>
                 </div>
            </div>

            <div class="col-md-2 text-right col-form-label">
              <label>Tanggal Transaksi</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="tgl_trx" class="form-control" readonly value="<?=($master) ? $master[0]->transaction_date : date('Y-m-d')?>">
            </div>

          </div>

          <div class="row mb-3">
            <div class="col-md-1"></div>
            <div class="col-md-2 text-right col-form-label">
              <label>Deskripsi</label>
            </div>
            <div class="col-md-3">
              <textarea name="deskripsi" class="form-control" required placeholder="Deskripsi. . . "><?=($master) ? $master[0]->description : ""?></textarea>
            </div>

            <div class="col-md-2 text-right col-form-label">
              <label>Nomor Referensi</label>
            </div>
            <div class="col-md-3">
              <input type="text" name="no_ref" class="form-control" id="no_ref" required autocomplete="off" value="<?=($master) ? $master[0]->reference_no : ""?>">
            </div>
          </div>
          <!-- form chart -->
          <hr>
           <div class="row mb-3">
            <!-- <div class="col-md-1"></div> -->
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th width="250">Kode Barang</th>
                    <th width="250">Nama Barang</th>
                    <th width="250">Gudang</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                        <select name="goods_list" id="goods_list" class="form-control selectpicker" data-live-search="true" onchange="get_goods_detail()">
                          <option value="">Pilih Barang</option>
                        </select>
                    </td>
                    <td>
                      <input type="hidden" name="id_barang" id="id_barang">
                      <input type="hidden" name="kode_barang" id="kode_barang">
                      <input type="hidden" name="qty_awal" id="qty_receive" class="form-control" min="1" value="1">
                      <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang . . ." readonly="">
                    </td>
                     <td>
                      <select name="warehouse_id" id="warehouse_id" class="form-control selectpicker" data-live-search="true">
                        <option value="">Pilih Gudang</option>
                        <?php
                          foreach ($warehouse as $key => $val) { ?>
                            <option value="<?=$val->id?>"><?=$val->name?></option>
                          <?php }
                          ?>
                      </select>
                    </td>
                    <td>
                      <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
                    </td>
                     <td>
                      <input type="number" name="harga_barang" id="harga_barang" class="form-control" min="1" value="1" readonly>
                    </td>
                    <td>
                      <input type="number" name="diskon_barang" id="diskon_barang" class="form-control" min="1" value="1" readonly>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm" onclick="add_to_chart()">Tambah</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end row -->


          <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-condensed table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Barang/PLU</th>
                    <th>Nama Barang</th>
                    <th>Gudang</th>
                    <th>Harga</th>
                    <th>Quantity Order (PC)</th>
                    <th>Diskon</th>
                    <th>Total</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody id="goods_return_table">
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="9" class="text-center">
                      <button type='button' class="btn btn-light-success btn-md" id="btn_save_return">
                        <span class="fa fa-save"></span>
                        Save
                      </button>
                      <a href="<?=base_url()?>index.php/pembelian/return" class="btn btn-light-danger btn-md">
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
