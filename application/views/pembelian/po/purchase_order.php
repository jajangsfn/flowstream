<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Pembelian
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?=base_url()?>index.php/Pembelian/add_purchase"> 
                <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambahMasterBarangModal">
                  <i class="la la-plus"></i> Tambah
                </button>
            </a>
        </div>
    </div>
     <div class="card-body">
       <!--begin: Datatable-->
       <div class="table-responsive">
          <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
              <thead>
                  <tr>
                    <th>No</th>
                    <th>No Purchase Order</th>
                    <th>No Referensi</th>
                    <th>Supplier</th>
                    <th>Tanggal PO</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                foreach ($po_data as $key => $val) { ?>
                  <tr>
                    <td><?=($key+1)?></td>
                    <td><?=$val->purchase_order_no?></td>
                    <td><?=$val->reference_no?></td>
                    <td><?=$val->partner_name?></td>
                    <td><?=$val->created_date?></td>
                    <td><?=$val->description?></td>
                    <td><?=number_format($val->purchase_total)?></td>
                    <td><?=$val->flag == 1 ? "<div class='badge badge-info'>Draft</div>" : "<div class='badge badge-success'>Approved</div>";?></td>
                    <td>
                      <?php
                        if ($val->flag == 1) {
                      ?>
                        <a href="<?=base_url()?>index.php/Pembelian/edit_purchase/<?=$val->id?>" class="btn btn-light-warning btn-sm" title="edit">
                          <i class="fa la-edit"></i>
                        </a>
                      <?php }?>
                        <button type="button" class="btn btn-light-info btn-sm" title="Print" onclick="print_po(<?=$val->id?>)"> 
                            <i class="fa la-print"></i>
                        </button>
                      <?php
                        if ($val->flag == 1) {
                      ?>
                          <button type="button" class="btn btn-light-success btn-sm" title="Approved" onclick="approve_po(<?=$val->id?>)">
                            <i class="fa la-check" title="Approve"></i>
                          </button>
                        <?php } ?>
                     </td>
                  </tr>
                <?php }
                ?> 
              </tbody>
          </table>
       </div>

     </div>
</div>


