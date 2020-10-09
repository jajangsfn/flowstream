<?=$this->session->flashdata('msg');?>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Pengiriman
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?=base_url()?>index.php/Pengiriman/add_delivery"> 
                <button type="button" class="btn btn-primary font-weight-bolder">
                  <i class="la la-plus"></i> Tambah
                </button>
            </a>
        </div>
    </div>
     <div class="card-body">
     	 <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
            <thead>
                <tr>
                	<th>No</th>
                	<th>No Pengiriman</th>
                	<th>No PO</th>
                	<th>Pelanggan</th>
                	<th>Tgl Kirim</th>
                	<th>Pengirim</th>
                	<th>No Mobil</th>
                	<th>Status</th>
                	<th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($delivery_data as $key => $row) { ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><a href='<?=base_url()?>index.php/pengiriman/detail_delivery/<?=$row->order_id?>'>
                                <?=$row->delivery_no?>
                            </a>
                        </td>
                        <td><?=$row->invoice_no?></td>
                        <td><?=$row->name?></td>
                        <td><?=$row->delivery_date?></td>
                        <td><?=$row->employee_name?></td>
                        <td><?=$row->car_number?></td>
                        <td><?=$row->receive_status == null ? "<div class='badge badge-info'>sedang dikirim</div>" : ($row->receive_status == 1 ? "<div class='badge badge-success'>sudah sampai</div>" : "<div class='badge badge-danger'>pending</div>")?></td>
                        <td>
                            <button type="button" class="btn btn-light-info btn-sm" onclick="update_delivery(<?=$row->id?>)">
                                <i class="fa la-check"></i>
                            </button>
                            <a href="<?=base_url()?>index.php/pengiriman/add_delivery/<?=$row->id?>">
                                <button type="button" class="btn btn-light-warning btn-sm">
                                <i class="fa la-pen"></i>
                                </button>
                            </a>
                        </td>
                        
                    </tr>
                <?php }
            ?>
            </tbody>
        </table>

     </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="delivery_detail">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
         <label class="col-2">No. Pengiriman</label>
         <label class="col-1">:</label>
         <label class="col-3" id="delivery_no">293indask</label>

         <label class="col-2">Tgl Pengiriman</label>
         <label class="col-1">:</label>
         <label class="col-3" id="delivery_date">293indask</label>
        </div>
        
        <div class="row mb-2">
         <label class="col-2">No. PO</label>
         <label class="col-1">:</label>
         <label class="col-3" id="invoice_no">293indask</label>

         <label class="col-2">Pengirim</label>
         <label class="col-1">:</label>
         <label class="col-3" id="employee_id">Maman</label>
        </div>
        
        <div class="row mb-2">
         <label class="col-2">Tujuan</label>
         <label class="col-1">:</label>
         <label class="col-3" id="partner_name">PT. Jaya Abadi</label>

         <label class="col-2">No.Mobil</label>
         <label class="col-1">:</label>
         <label class="col-3" id="car_number">D 82398 Db</label>
        </div>

        <div class="row mb-2">
         <label class="col-2">Alamat</label>
         <label class="col-1">:</label>
         <label class="col-3" id="addrss">Jalan Kenangan</label>

         <label class="col-2">Biaya Kirim</label>
         <label class="col-1">:</label>
         <label class="col-3" id="charge">Rp. 20.000</label>
        </div>

        <div class="row mb-2">
         <label class="col-2">Status</label>
         <label class="col-1">:</label>
         <select name='status' class="form-control col-3">
            <option value="">Pilih Status</option>
            <option value="1">Terkirim</option>
            <option value="2">Pending</option>
         </select>

         <label class="col-2">Penerima</label>
         <label class="col-1">:</label>
         <input type="text" class="form-control col-3" name="receive_name"/>
        </div>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
