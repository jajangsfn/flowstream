 <?=$this->session->flashdata('msg');?>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Retur Penjualan
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?=base_url()?>index.php/Penjualan/add_return"> 
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
                  <th class="text-center">No</th>
                  <th class="text-center">No Retur</th>
                  <th class="text-center">Customer</th>
                  <th class="text-center">Tanggal Retur</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php
              foreach ($return as $key => $val) { ?>
                <tr>
                  <td><?=($key+1)?></td>
                  <td ><?=$val->return_no?></td>
                  <td class="text-center"><?=$val->customer?></td>
                  <td class="text-center"><?=$val->return_date?></td>
                  <td><?=$val->description?></td>
                  <td class="text-right"><?=number_format($val->total)?></td>
                  <td class="text-center"><?= $val->flag == 1 ? "<div class='badge badge-info'>Draft</div>" : "<div class='badge badge-success'>Approved</div>";?></td>
                  <td>
                      <?php
                      if ($val->flag == 1) {
                      ?>
                        <a href="<?=base_url()?>index.php/Penjualan/edit_return/<?=$val->id?>" class="btn btn-light-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa la-edit" title="Edit"></i></a>
                      <?php }?>
                        <button type="button" class="btn btn-light-info btn-sm" data-toggle="tooltip" data-placement="top" title="Print" onclick="print_return(<?=$val->id?>)"> 
                            <i class="fa la-print" title="Print"></i>
                        </button>
                      <?php
                        if ($val->flag == 1) {
                      ?>
                          <button type="button" class="btn btn-light-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approved" onclick="approve_return(<?=$val->id?>)">
                            <i class="fa la-check" title="Approve"></i>
                          </button>
                        <?php }?>
                    </td>
                </tr>
              <?php }
              ?>
            </tbody>
        </table>

     </div>
</div>


