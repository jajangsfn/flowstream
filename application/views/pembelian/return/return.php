 <?=$this->session->flashdata('msg');?>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Retur Pembelian
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?=base_url()?>index.php/Pembelian/add_return"> 
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
                  <th>No Retur</th>
                  <th>Supplier</th>
                  <th>Tanggal Retur</th>
                  <th>Keterangan</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($return as $key => $val) { ?>
                  <tr>
                    <td><?=$key+1?></td>
                    <td><?=$val->return_no?></td>
                    <td><?=$val->supplier_name?></td>
                    <td><?=date('Y-m-d', strtotime($val->return_date))?></td>
                    <td><?=$val->description?></td>
                    <td><?=number_format($val->total)?></td>
                    <td><?= $val->flag == 1 ? "<div class='badge badge-info'>Draft</div>" : "<div class='badge badge-success'>Approved</div>";?></td>
                    <td>
                     <?php
                      if ($val->flag == 1) {
                      ?>
                        <a href="<?=base_url()?>index.php/Pembelian/edit_return/<?=$val->id?>" class="btn btn-light-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa la-edit" title="Edit"></i></a>
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


