 <?=$this->session->flashdata('msg');?>
 <!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Transaksi
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?=base_url()?>index.php/inventori/add_warehouse"> 
                <button type="button" class="btn btn-primary font-weight-bolder">
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
                    	<th>No Transaksi</th>
                    	<th>No Referensi</th>
                    	<th>Nama Gudang</th>
                    	<th>Tanggal Transaksi</th>
                    	<th>Keterangan</th>
                    	<th>Total Item</th>
                    	<th>Status</th>
                    	<th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($warehouse as $key => $val) { ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$val->physical_warehouse_no?></td>
                            <td><?=$val->reference_no?></td>
                            <td><?=$val->actual_warehouse_name?></td>
                            <td><?=$val->created_date?></td>
                            <td><?=$val->desc_detail?></td>
                            <td><?=$val->total_item?></td>
                            <td><?php
                                if ($val->flag == 1) {
                                    echo "<div class='badge badge-info'>Draft</div>";
                                }else {
                                    echo "<div class='badge badge-success'>Approved</div>";
                                }
                            ?></td>
                            <td>
                                 <?php
                                  if ($val->flag == 1) {
                                ?>
                                  <a href="<?=base_url()?>index.php/inventori/edit_warehouse/<?=$val->id?>" class="btn btn-light-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa la-edit" title="Edit"></i></a>
                                <?php }?>
                                  <button type="button" class="btn btn-light-info btn-sm" data-toggle="tooltip" data-placement="top" title="Print" onclick="print_warehouse(<?=$val->id?>)"> 
                                      <i class="fa la-print" title="Print"></i>
                                  </button>
                                <?php
                                  if ($val->flag == 1) {
                                ?>
                                    <button type="button" class="btn btn-light-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approved" onclick="approve_warehouse(<?=$val->id?>)">
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
</div>