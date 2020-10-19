<form method="post" id="form_delivery" action="<?=base_url()?>index.php/pengiriman/save_delivery">
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
				  	<input type="hidden" name="id" value="<?=!is_null($id) ? $id : '';?>"/>

		      		<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No Pengiriman</label>
						<input type="text" name="delivery_no" class="col-md-3 form-control" readonly value="<?=!is_null($delivery_data['detail']) ? $delivery_data['detail'][0]->delivery_no: $delivery_no;?>">
						<label class="col-form-label col-md-3 text-right">Tgl Pengiriman</label>
						<input type="date" name="delivery_date" class="col-md-3 form-control" value="<?=!is_null($delivery_data['detail']) ? date('Y-m-d', strtotime($delivery_data['detail'][0]->delivery_date)) : date('Y-m-d')?>">
					</div>

					<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No PO</label>
						<select name="po_no_list" id="po_no_list" class="col-md-3 form-control selectpicker" data-live-search="true" onchange="get_po_no_detail()">
						    <option value="">Pilih No PO</option>
							<?php
							foreach($po_no_list as $key => $row) { ?>
								<option value="<?=$row->invoice_no?>"><?=$row->invoice_no?></option>
							<?php }
							?>
                        </select>

						<label class="col-form-label col-md-3 text-right">No Mobil</label>
                         <input type="text" name="car_number" id="car_number" class="col-md-3 form-control" value="<?=!is_null($delivery_data['detail'])? $delivery_data['detail'][0]->car_number: "";?>" required>
					</div>

					<div class="row ml-30 mb-4">
 						<label class="col-form-label col-md-2 text-right">Tujuan</label>
                         <input type="text" name="customer_name" id="customer_name" class="col-md-3 form-control" readonly value="<?=!is_null($delivery_data['detail'])? $delivery_data['detail'][0]->name: "";?>">

						 <label class="col-form-label col-md-3 text-right">Keterangan</label>
                        <textarea name="description" class="form-control col-md-3"><?=!is_null($delivery_data['detail']) ? $delivery_data['detail'][0]->description : null;?></textarea>
                    </div>

                    <div class="row ml-30 mb-4">
                        <label class="col-form-label col-md-2 text-right">Alamat Pengiriman</label>
                        <textarea name="customer_address" id="customer_address" class="form-control col-md-3"><?=!is_null($delivery_data['detail'])? $delivery_data['detail'][0]->address: "";?>
						</textarea>
                    </div>
					<hr>
					<div class="row">
                        <div class="col-md-1"></div>
						<div class="col-md-10 table-responsive">
							<table class="table table-bordered table-condensed table-striped">
								<thead>
									<tr>
										<th width="1">No</th>
										<th>No PO</th>
										<th>Kode Barang/PLU</th>
										<th>Nama Barang</th>
										<th>Quantity(PCS)</th>
										<th width="10">#</th>
									</tr>
								</thead>
								<tbody id="good_list">
									<?php
									if (!is_null($delivery_data['goods'])) {
										foreach($delivery_data['goods'] as $key => $row) { ?>
											<tr id="id_<?=$key?>">
												<td><?=$key+1?></td>
												<td width="250"><?=$row['invoice_no']?></td>
												<td width="250"><?=$row['plu_code']?></td>
												<td><?=$row['brand_description']?></td>
												<td width="100">
													<input type='hidden' name='order_detail_id[]' value='<?=$row['id']?>'/>
													<input type='hidden' name='good_id[]' value='<?=$row['goods_id']?>'/>
													<input type='number' name='qty[]' class='form-control' value='<?=$row['qty']?>' min='1' required/></td>
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
						</div>
					</div>
		    </div>
		</div>
	</div>
	<div class="col-md-12 mt-5">
		<div class="card card-custom">
			<div class="card-header flex-wrap">
				<div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<!--begin::Info-->
					<div class="d-flex align-items-center flex-wrap mr-1">
						<!--begin::Page Heading-->
						<div class="d-flex align-items-baseline mr-5">
						<!--begin::Page Title-->
							<h5 class="text-dark font-weight-bold my-2 mr-5">Data Pegawai</h5>
						</div>
						<!--end::Page Heading-->
					</div>
					<!--end::Info-->
					<!--begin::Toolbar-->
					<div class="d-flex align-items-center">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalPegawai">
							<span class="fas fa-plus"></span>
							Pegawai
						</button>
					</div>
					<!--end::Toolbar-->
				</div>
		    </div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped mt-2">
						<thead>
							<tr>
								<th width="1">No</th>
								<th>Nama</th>
								<th>Tugas</th>
								<th width="1"></th>
							</tr>
						</thead>
						<tbody id="table_pegawai">
							<?php 
							if (!is_null($delivery_data['pegawai'])) {
								foreach($delivery_data['pegawai'] as $key => $row) { ?>
									<tr id="pegawai_id_<?=$key?>">
										<td><?=($key+1)?></td>
										<td>
											<input type='hidden' name='team_id[]' value='<?=$row['team_id']?>'/>
											<input type='hidden' name='id_pegawai[]' value='<?=$row['employee_id']?>'/>
											<input type='hidden' name='pegawai[]' value='<?=$row['employee_name']?>'/>
											<?=$row['employee_name']?></td>
										<td><input type='text' name='tugas_pegawai[]' class='form-control' value='<?=$row['job_description']?>'/></td>
										<td>
											<button type='button' class='btn btn-xs btn-danger' onclick='delete_pegawai(<?=$key?>)'>
												<span class='fa fa-trash'></span>
											</button>
										</td>
									</tr>
							<?php }
							}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mt-5">
		<div class="card card-custom">
			<div class="card-header flex-wrap">
				<div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<!--begin::Info-->
					<div class="d-flex align-items-center flex-wrap mr-1">
						<!--begin::Page Heading-->
						<div class="d-flex align-items-baseline mr-5">
						<!--begin::Page Title-->
							<h5 class="text-dark font-weight-bold my-2 mr-5">Data Biaya</h5>
						</div>
						<!--end::Page Heading-->
					</div>
					<!--end::Info-->
					<!--begin::Toolbar-->
					<div class="d-flex align-items-center">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalBiaya">
							<span class="fas fa-plus"></span>
							Biaya
						</button>
					</div>
					<!--end::Toolbar-->
				</div>
		    </div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped mt-2">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenis Biaya</th>
								<th>Jumlah</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="table_biaya">
						<?php 
							if (!is_null($delivery_data['biaya'])) {
								foreach($delivery_data['biaya'] as $key => $row) { ?>
									<tr id="biaya_id_<?=$key?>">
										<td><?=($key+1)?></td>
										<td><input type='text' name='biaya[]' class='form-control' value='<?=$row['description']?>'/></td>
										<td><input type='number' name='jumlah[]' class='form-control' value='<?=$row['charge']?>' min="1000"/></td>
										<td><button type='button' class='btn btn-danger btn-sm' onclick='delete_biaya(<?=$key?>)'><span class='fas fa-trash'></span></button></td>";
									</tr>
						  <?php }
							}
							?>
						</tbody>
					</table>
				</div>
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
	</div>
</div>
</form>

<!-- modal pegawai -->
<div class="modal fade bd-example-modal-lg modalPegawai" tabindex="-1" role="dialog" aria-labelledby="modalPegawai" aria-hidden="true" id="modalPegawai">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
		<div class="modal-header">
			<h4>Form Data Pegawai</h4>
		</div>
		<div class="modal-body">

			<div class="form-group row">
				<label for="pegawai" class="col-2 form-col-label">Pegawai</label>
				<label class="m-1">:</label>
				<select name="pegawai" class="form-control select2 col-8" id="pegawai">
					<option value="">Pilih Pegawai</option>
					<?php
					foreach($employee_data as $key => $row) { ?>
						<option value="<?=$row->id."_".$row->name?>"> <?=$row->name?></option>
				<?php }?>
				</select>
			</div>

			<div class="form-group row">
				<label for="tugas" class="col-2 form-col-label">Tugas</label>
				<label class="m-1">:</label>
				<textarea name="tugas" class="form-control col-8" id="tugas"></textarea>
			</div>
			<div class="text-center">
				<button type="button" class="btn btn-primary" onclick="add_pegawai()">
					Tambahkan
				</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Tutup
				</button>
			</div>
		</div>
    </div>
  </div>
</div>

<!-- modal biaya -->
<div class="modal fade bd-example-modal-lg modalBiaya" tabindex="-1" role="dialog" aria-labelledby="modalBiaya" aria-hidden="true" id="modalBiaya">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
		<div class="modal-header">
			<h4>Form Data Biaya</h4>
		</div>
		<div class="modal-body">

			<div class="form-group row">
				<label for="biaya" class="col-3 form-col-label">Nama Biaya</label>
				<label class="m-1">:</label>
				<input type="text" name="biaya" class="form-control col-6" id="biaya"/>
			</div>

			<div class="form-group row">
				<label for="jumlah" class="col-3 form-col-label">Jumlah</label>
				<label class="m-1">:</label>
				<input type="number" name="jumlah" class="form-control col-6" id="jumlah" min="1000"/>
			</div>
			<div class="text-center">
				<button type="button" class="btn btn-primary" onclick="add_biaya()">
					Tambahkan
				</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Tutup
				</button>
			</div>
		</div>
    </div>
  </div>
</div>
