 <?=$this->session->flashdata('msg');?>
 <!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Receiving
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?=base_url()?>index.php/inventori/add_receiving"> 
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
                	<th>No Receiving</th>
                	<th>No Referensi</th>
                	<th>Supplier</th>
                	<th>Tanggal Receiving</th>
                	<th>Keterangan</th>
                	<th>Total</th>
                	<th>Status</th>
                	<th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($receive as $key => $val) { ?>
                    <tr>
                        <td><?=($key+1)?></td>
                        <td class="text-center"><?=$val->receiving_no?></td>
                        <td class="text-center"><?=$val->reference_no?></td>
                        <td><?=$val->supplier_name?></td>
                        <td class="text-center"><?=$val->created_date?></td>
                        <td><?=$val->description?></td>
                        <td class="text-right"><?=number_format($val->sum_trx)?></td>
                        <td><?=$val->flag_receive == 1 ? "<div class='badge badge-info'>Draft</div>" : "<div class='badge badge-success'>Approved</div>";?></td>
                        <td style="text-align: center;">
                            <?php
                              if ($val->flag_receive == 1) {
                            ?>
                              <a href="<?=base_url()?>index.php/inventori/edit_receiving/<?=$val->receiving_id?>" class="btn btn-light-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa la-edit" title="Edit"></i></a>
                            <?php }?>
                              <button type="button" class="btn btn-light-info btn-sm" data-toggle="tooltip" data-placement="top" title="Print" onclick="print_receive(<?=$val->receiving_id?>)"> 
                                  <i class="fa la-print" title="Print"></i>
                              </button>
                            <?php
                              if ($val->flag_receive == 1) {
                            ?>
                                <button type="button" class="btn btn-light-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approved" onclick="approve_receive(<?=$val->receiving_id?>)">
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