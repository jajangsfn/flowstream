<div class="container py-8">
	<!-- start report chart -->
	<div class="row">
		<div class="col-lg-6">
			<!--begin::Callout-->
			<div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
				<div class="card-body">
					<div class="d-flex align-items-center p-5">
						<!--begin::Icon-->
						<div class="mr-6">
							
							<span class="svg-icon svg-icon-primary svg-icon-4x">
								<i class="la la-cart-arrow-down icon-4x text-primary"></i>
							</span>
						</div>
						<!--end::Icon-->
						<!--begin::Content-->
						<div class="d-flex flex-column">
							<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3"><?=$total_trans?></a>
								<div class="text-dark font-size-h3">Total Penjualan</div>
						</div>
						<!--end::Content-->
					</div>
				</div>
			</div>
		<!--end::Callout-->
		</div>
		<div class="col-md-6">
		<!--begin::Callout-->
		<div class="card card-custom wave wave-animate-slow wave-danger mb-8 mb-lg-0">
			<div class="card-body">
				<div class="d-flex align-items-center p-5">
					<!--begin::Icon-->
					<div class="mr-6">
						<span class="svg-icon svg-icon-danger svg-icon-4x">
							<i class="la la-chart-bar icon-4x text-danger"></i>
						</span>
					</div>
					<!--end::Icon-->
					<!--begin::Content-->
					<div class="d-flex flex-column">
						<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h1 mb-3">Rp. <?=number_format( $total_sum) ?></a>
						<div class="text-dark font-size-h3">Total Pendapatan</div>
					</div>
														<!--end::Content-->
					</div>
				</div>
			</div>
		<!--end::Callout-->
		</div>
	</div>
	<!-- end report chart -->

	<!-- begin table -->
	<div class="row mt-5">
		<!-- search -->
		<div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					<form method="get" action="<?=base_url()?>index.php/penjualan/laporan/penjualan/bulanan">
					<div class="row">
						<div class="col-lg-8">
							<table class="table">
								<thead>
									<tr>
										<th>Dari Tanggal</th>
										<th>Sampai Tanggal</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="date" name="from" class="form-control" id="from" required placeholder="Silahkan masukkan kata kunci" value="<?=$from?>" autocomplete="off">
										</td>
										<td>
											<input type="date" name="to" class="form-control" id="to" required placeholder="Sampai tanggal" value="<?=$to?>" autocomplete="off">
										</td>
										<td>
											<button type="submit" class="btn btn-md btn-primary" name="search">Cari</button>
											<a href="<?=current_url()?>">
												<button type="button" class="btn btn-md btn-warning">Refresh</button>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped">
							<thead>
								<tr>
									<th colspan="3" class="text-right">
										<a href="<?=base_url()?>index.php/penjualan/print_laporan_penjualan_bulanan?from=<?=$from?>&to=<?=$to?>" target="_blank">
											<button class="btn btn-light-warning btn-sm">
												<i class="la la-file-upload"></i>
												Print
											</button>
										</a>
									</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th class="text-center">Tanggal</th>
									<th class="text-center" width="100">Jumlah Transaksi</th>
									<th class="text-center">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($master as $key => $val) { ?>
									<tr>
										<td><?=date('Y-m-d', strtotime($val->updated_date))?></td>
										<td class="text-center" width="150"><?=$val->total_trans?></td>										
										<td class="text-right"><?=number_format( $val->total )?></td>
									</tr>
								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
