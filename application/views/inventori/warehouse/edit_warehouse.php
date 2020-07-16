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
        <h5 class="text-dark font-weight-bold my-2 mr-5">Edit Data Gudang</h5>
      </div>
       <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Daterange-->
        <a href="#" class="btn btn-light-primary btn-sm font-weight-bold " id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="" data-placement="left" data-original-title="Select dashboard daterange">
          <span class="font-weight-bold" id="kt_dashboard_daterangepicker_date"><?=$tgl_indo?></span>
        </a>
     <!--end::Daterange-->        
     </div>
   <!--end::Toolbar-->
   </div>
</div>
<!-- end card header -->
     <div class="card-body">
      <form method="post" action="<?=base_url()?>index.php/inventori/gudang" id="form_ws">
        <input type="hidden" name="id" value="<?=$warehouse[0]->id?>">
     	<div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-2 text-right col-form-label">
              <label>Dari Gudang</label>
          </div>  
          <div class="col-md-3">
              <select name="prev_ws" class="form-control selectpicker" data-live-search="true" required="">
                  <option value="">Gudang Awal</option>
                  <?php
                  foreach ($prev_ws as $key => $val) { 
                    if ($warehouse[0]->previous_warehouse == $val->id ) {
                    ?>
                    <option value="<?=$val->id?>" selected><?=$val->name?></option>
                  <?php }else {
                    ?>
                    <option value="<?=$val->id?>"><?=$val->name?></option>
                  <?php
                    }
                  }
                  ?>
              </select>
          </div>
          
          <div class="col-md-2 text-right col-form-label">
              <label>No Transaksi</label>
          </div>
          <div class="col-md-3">
              <input type="text" name="trans_no" class="form-control" readonly required="" value="<?=$warehouse[0]->physical_warehouse_no?>">
          </div>

        </div>
        <!-- end row -->
        <div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-2 text-right col-form-label">
              <label>Ke Gudang</label>
          </div>  
          <div class="col-md-3">
              <select name="act_ws" class="form-control selectpicker" data-live-search="true" required="">
                  <option value="">Gudang Tujuan</option>
                   <?php
                  foreach ($act_ws as $key => $val) { 
                    if ($warehouse[0]->actual_warehouse == $val->id ) {
                    ?>
                    <option value="<?=$val->id?>" selected><?=$val->name?></option>
                  <?php }else {
                    ?>
                    <option value="<?=$val->id?>"><?=$val->name?></option>
                  <?php
                    }
                  }
                  ?>
              </select>
          </div>

           <div class="col-md-2 text-right col-form-label">
              <label>Tanggal Transaksi</label>
          </div> 
          <div class="col-md-3">
              <input type="text" name="trans_date" class="form-control" readonly value="<?=date('Y-m-d', strtotime($warehouse[0]->created_date) );?>">
          </div>
        </div>
        <!-- end row -->

       <div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-2 text-right col-form-label">
              <label>No Receive Order</label>
          </div>  
          <div class="col-md-3">
              <div class="input-group mb-3">
                    <input type="text" name="nro" id="nro" class="form-control" placeholder="No Receive Order. . ." aria-label="" aria-describedby="basic-addon1" value="<?=$warehouse[0]->reference_no?>">
                  <div class="input-group-prepend">
                     <button class="btn btn-info" type="button" onclick="search_receive_order()">search</button>
                   </div>
               </div>
          </div>

          <div class="col-md-2 text-right col-form-label">
              <label>No Referensi</label>
          </div>
          <div class="col-md-3">
              <input type="text" name="ref_no" id="ref_no" class="form-control" required="" placeholder="Isi No referensi" value="<?=$warehouse[0]->reference_no?>">
          </div>

        </div>
        <!-- end row -->
        <div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-2 text-right col-form-label">
              <label>Deskripsi</label>
          </div>  
          <div class="col-md-3">
              <textarea name="desc" class="form-control" placeholder="Deskripsi..."><?=$warehouse[0]->desc_detail?></textarea>
          </div>
        </div>
        <!-- end row -->
        <!-- end row -->
        <hr>
        <div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table class="table">
              <thead>
                <tr>
                  <th width="250">Kode Barang</th>
                  <th width="250">Nama Barang</th>
                  <th width="100">Quantity</th>
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
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang . . ." readonly="">
                  </td>
                  <td>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
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
        <div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Quantity</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody id="goods_ws_list"></tbody>
            </table>
          </div>
        </div>
        <!-- end row -->
        <div class="row mb-3">
          <div class="col-md-1"></div>
          <div class="col-md-10 text-center">
            <button type="button" class="btn btn-light-success" id="btn_save_ws">
              <span class="fa fa-save"></span>
              Save
            </button>

              <a href="<?=base_url()?>index.php/inventori/gudang" class="btn btn-light-danger btn-md">
                  <span class="fa la-arrow-left"></span> Cancel
               </a>
          </div>
        </div>
        <!-- end row -->
        </form>
    </div>
    <!-- end card body -->
</div>