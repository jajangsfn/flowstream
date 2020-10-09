<div class="row">
	<div class="col-md-12">
		<?=$this->session->flashdata('msg');?>
		<div class="card card-custom">
			<div class="card-header flex-wrap">
				<div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<!--begin::Info-->
					<div class="d-flex align-items-center flex-wrap mr-1">
					<!--begin::Page Heading-->
						<div class="d-flex align-items-baseline mr-5">
						<!--begin::Page Title-->
							<!-- <h5 class="text-dark font-weight-bold my-2 mr-5">Tambah Pengiriman</h5> -->
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
		      	<form method="post" id="form_delivery" action="<?=base_url()?>index.php/pengiriman/save_delivery">
				  	<input type="hidden" name="id" value="<?=!is_null($id) ? $id : '';?>"/>

		      		<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No Pengiriman</label>
						<input type="text" name="delivery_no" class="col-md-3 form-control" readonly value="<?=!is_null($delivery_data) ? $delivery_data[0]->delivery_no: $delivery_no;?>">
						<label class="col-form-label col-md-3 text-right">Tgl Pengiriman</label>
						<input type="date" name="delivery_date" class="col-md-3 form-control" value="<?=!is_null($delivery_data) ? date('Y-m-d', strtotime($delivery_data[0]->delivery_date)) : date('Y-m-d')?>">
					</div>

					<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No PO</label>
						<select name="po_no_list" id="po_no_list" class="col-md-3 form-control selectpicker" data-live-search="true" onchange="get_po_no_detail()">
						    <option value="">Pilih No PO</option>
							<?php
							foreach($po_no_list as $key => $row) { ?>
								<option value="<?=$row->invoice_no?>" <?=!is_null($delivery_data) && $delivery_data[0]->invoice_no == $row->invoice_no  ? "selected": "";?>><?=$row->invoice_no?></option>
							<?php }
							?>
                        </select>
                        
                        <label class="col-form-label col-md-3 text-right">Pengirim</label>
                        <select name="employee_id" id="employee_id" class="col-md-3 form-control selectpicker" data-live-search="true" required>
                            <option value="">Pilih Pengirim</option>
                            <?php
                                foreach($employee_data as $key => $row) { ?>
                                    <option value="<?=$row->id?>" <?=!is_null($delivery_data) && $delivery_data[0]->employee_id == $row->id  ? "selected": "";?>> <?=$row->name?></option>
                                <?php }
                            ?>
                        </select>

					</div>

					<div class="row ml-30 mb-4">
 						<label class="col-form-label col-md-2 text-right">Tujuan</label>
                         <input type="text" name="customer_name" id="customer_name" class="col-md-3 form-control" readonly value="<?=!is_null($delivery_data)? $delivery_data[0]->name: "";?>">

                         <label class="col-form-label col-md-3 text-right">No Mobil</label>
                         <input type="text" name="car_number" id="car_number" class="col-md-3 form-control" value="<?=!is_null($delivery_data)? $delivery_data[0]->car_number: "";?>" required>
                    </div>

                    <div class="row ml-30 mb-4">
                        <label class="col-form-label col-md-2 text-right">Alamat Pengiriman</label>
                        <textarea name="customer_address" id="customer_address" class="form-control col-md-3" readonly><?=!is_null($delivery_data)? $delivery_data[0]->address: "";?>
						</textarea>

                        <label class="col-form-label col-md-3 text-right">Biaya Kirim</label>
						<input type="number" name="charged" class="col-md-3 form-control" min="1" required value="<?=!is_null($delivery_data) ? $delivery_data[0]->charge : 1;?>"/>
                    </div>
                    
                    <div class="row ml-30 mb-1">
                        <label class="col-form-label col-md-2 text-right">Keterangan</label>
                        <textarea name="description" class="form-control col-md-3"><?=!is_null($delivery_data) ? $delivery_data[0]->description : null;?></textarea>
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
										<th width="10">#</th>
									</tr>
								</thead>
								<tbody id="good_list">
									<?php
									if (!is_null($delivery_data)) {
										foreach($delivery_data as $key => $row) { ?>
											<tr id="id_<?=$key?>">
												<td><?=$key+1?></td>
												<td width="250"><?=$row->plu_code?></td>
												<td><?=$row->brand_description?></td>
												<td width="100">
													<input type='hidden' name='good_id[]' value='<?=$row->goods_id?>'/>
													<input type='number' name='qty[]' class='form-control' value='<?=$row->qty?>' min='1' required/></td>
												<td>
													<button type='button' class='btn btn-xs btn-danger' onclick='delete_good(<?=$key?>)'>
														<span class='fa fa-trash'></span>
													</button>
												</td>
											</tr>
										<?php }
									}
									?>
								</tbody>
							</table>

							<div class="text-center">
								<button type="button" class="btn btn-light-success btn-md" id="btn_confirm_delivery"> 
									<span class="fa la-save"></span> Save
								</button>

								<a href="<?=base_url()?>index.php/pengiriman" class="btn btn-light-danger btn-md">
									<span class="fa la-arrow-left"></span> Cancel
								</a>
							</div>
						</div>
					</div>
		        </form>

		    </div>
		</div>
	</div>
</div>

