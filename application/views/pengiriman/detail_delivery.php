<div class="row">
	<div class="col-md-12">
		<?=$this->session->flashdata('msg');?>
		<div class="card card-custom">
		    <div class="card-body">
		      		<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No Pengiriman</label>
						<label class="col-form-label m-0">:</label>
						<label class="col-form-label col-md-2 text-right font-weight-bold"><?=$delivery_data['detail'][0]->delivery_no?></label>

						<label class="col-form-label col-md-3 text-right">Tgl Pengiriman</label>
						<label class="col-form-label m-0">:</label>
						<label class="col-form-label col-md-2 font-weight-bold"><?=date('Y-m-d', strtotime($delivery_data['detail'][0]->delivery_date))?></label>
					</div>

					<div class="row ml-30 mb-4">
						<label class="col-form-label col-md-2 text-right">No PO</label>
						<label class="col-form-label m-0">:</label>
						<label class="col-form-label col-md-2 text-right font-weight-bold"><?=$delivery_data['detail'][0]->invoice_no?></label>

						<label class="col-form-label col-md-3 text-right">No Mobil</label>
						 <label class="col-form-label m-0">:</label>
                         <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->car_number?></label>
					</div>

					<div class="row ml-30 mb-4">
 						<label class="col-form-label col-md-2 text-right">Nama Pelanggan</label>
						 <label class="col-form-label m-0">:</label>
                         <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->name?></label>

						 <label class="col-form-label col-md-3 text-right">Keterangan</label>
						<label class="col-form-label m-0">:</label>
                        <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->order_desc?></label>
                    </div>

                    <div class="row ml-30 mb-4">
                        <label class="col-form-label col-md-2 text-right">Alamat Pengiriman</label>
						<label class="col-form-label m-0">:</label>
                        <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->address?></label>
                    </div>
                    
					<hr>
					<div class="row ml-30 mb-4">
						<h4>Status Pengiriman</h4><br>
					</div>
					<hr>
					<div class="row ml-30 mb-4">
 						<label class="col-form-label col-md-2 text-right">Status</label>
						 <label class="col-form-label m-0">:</label>
						 <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->receive_status == null ? 
																					 "<div class='badge badge-info'>sedang dikirim</div>" : ($delivery_data['detail'][0]->receive_status == 1 ? 
																					 "<div class='badge badge-success'>sudah sampai</div>" : 
																					 "<div class='badge badge-danger'>pending</div>")?></label>

                         <label class="col-form-label col-md-3 text-right">Penerima</label>
						 <label class="col-form-label m-0">:</label>
                         <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->receive_name?></label>
                    </div>

					<div class="row ml-30 mb-4">
                        <label class="col-form-label col-md-2 text-right">Tgl Terima</label>
						<label class="col-form-label m-0">:</label>
                        <label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->receive_date?></label>

                        <label class="col-form-label col-md-3 text-right">Catatan Pengiriman</label>
						<label class="col-form-label m-0">:</label>
						<label class="col-form-label col-md-2 font-weight-bold"><?=$delivery_data['detail'][0]->notes?></label>
                    </div>

					<hr>
					<div class="row ml-30 mb-4">
						<h4>Daftar Barang</h4><br>
					</div>
					<div class="row">                        
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered table-condensed table-striped">
								<thead>
									<tr>
										<th width="1">No</th>
										<th>No. Invoice</th>
										<th>Kode Barang/PLU</th>
										<th>Nama Barang</th>
										<th>Quantity(PCS)</th>
									</tr>
								</thead>
								<tbody id="good_list">
								<?php
									if (!is_null($delivery_data['goods'])) {
										$i = 1;
										foreach($delivery_data['goods'] as $key => $row) { ?>
											<tr id="id_<?=$key?>">
												<td><?=$i?></td>
												<td width="250"><?=$row['invoice_no']?></td>
												<td width="250"><?=$row['plu_code']?></td>
												<td><?=$row['brand_description']?></td>
												<td width="100"><?=$row['qty']?></td>
											</tr>
										<?php 
											$i++;
										}
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
					</div>
					<!--end::Toolbar-->
				</div>
		    </div>
		    <div class="card-body">
				<table class="table table-bordered table-condensed table-striped mt-2">
					<thead>
						<tr>
							<th width="1">No</th>
							<th>Nama</th>
							<th>Tugas</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if (!is_null($delivery_data['pegawai'])) {
							$i = 1;
						foreach($delivery_data['pegawai'] as $key => $row) { ?>
							<tr id="pegawai_id_<?=$key?>">
								<td><?=$i?></td>
								<td><?=$row['employee_name']?></td>
								<td><?=$row['job_description']?></td>
							</tr>
							<?php $i++;}
					}?>
					</tbody>
					</table>
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
								<th>Jenis Biaya</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody id="table_biaya">
						<?php 
							if (!is_null($delivery_data['biaya'])) {
								$i = 1;
								foreach($delivery_data['biaya'] as $key => $row) { ?>
									<tr id="biaya_id_<?=$key?>">
										<td><?=$i;?></td>
										<td><?=$row['description']?></td>
										<td><?=$row['charge']?></td>
									</tr>
						  <?php $i++;
						  		}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>

