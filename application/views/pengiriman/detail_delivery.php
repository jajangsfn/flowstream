<div class="row">
	<div class="col-md-12">
		<?=$this->session->flashdata('msg');?>
		<div class="card card-custom">
		    <div class="card-body">
		      	<form method="post" id="form_delivery" action="<?=base_url()?>index.php/pengiriman/save_delivery">
		      		<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No Pengiriman</label>
						<label class="col-form-label col-md-2 text-right font-weight-bold"><?=$delivery_data[0]->delivery_no?></label>

						<label class="col-form-label col-md-3 text-right">Tgl Pengiriman</label>
						<label class="col-form-label col-md-2 font-weight-bold"><?=date('Y-m-d', strtotime($delivery_data[0]->delivery_date))?></label>
					</div>

					<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No PO</label>
						<label class="col-form-label col-md-2 text-right font-weight-bold"><?=$delivery_data[0]->invoice_no?></label>
                        
                        <label class="col-form-label col-md-3 text-right">Pengirim</label>
                        <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data[0]->employee_name?></label>

					</div>

					<div class="row ml-30 mb-4">
 						<label class="col-form-label col-md-2 text-right">Nama Pelanggan</label>
                         <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data[0]->name?></label>

                         <label class="col-form-label col-md-3 text-right">No Mobil</label>
                         <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data[0]->car_number?></label>
                    </div>

                    <div class="row ml-30 mb-4">
                        <label class="col-form-label col-md-2 text-right">Alamat Pengiriman</label>
                        <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data[0]->address?></label>

                        <label class="col-form-label col-md-3 text-right">Biaya Kirim</label>
						<label class="col-form-label col-md-2 font-weight-bold">Rp. <?=number_format($delivery_data[0]->charge)?></label>
                    </div>
                    
                    <div class="row ml-30 mb-1">
                        <label class="col-form-label col-md-2 text-right">Keterangan</label>
                        <label class="col-form-label col-md-2 text-right font-weight-bold"><?=$delivery_data[0]->description?></label>
                    </div>
					<hr>
					<div class="row">
                        <div class="col-md-1"></div>
						<div class="col-md-10 table-responsive">
							<table class="table table-bordered table-condensed table-striped">
								<thead>
									<tr>
										<th width="1">No</th>
										<th>Kode Barang/PLU</th>
										<th>Nama Barang</th>
										<th>Quantity(PCS)</th>
									</tr>
								</thead>
								<tbody id="good_list">
                                    <?php
                                    foreach($delivery_data as $key => $row) { ?>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td><?=$row->plu_code?></td>
                                            <td><?=$row->brand_description?></td>
                                            <td><?=$row->qty?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
							</table>
						</div>
					</div>
		        </form>

		    </div>
		</div>
	</div>
</div>

