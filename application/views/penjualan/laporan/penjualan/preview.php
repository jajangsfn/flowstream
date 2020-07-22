<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">

						<?php 
						if ($type == 1) {
						?>
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th colspan="13" class="text-right">
										<a href="<?=base_url()?>index.php/penjualan/print_laporan_penjualan_harian/<?=$id?>" target="_blank">
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
									<th>No Order</th>
									<th>No Faktur</th>
									<th>Customer</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Barang</th>
									<th>Kode SKU</th>
									<th>Barcode</th>
									<th>Brand</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Quantity</th>
									<th>Diskon %</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$total = 0;
								foreach ($master as $key => $val) { 
									$total+=$val->total;?>
									<tr>
										<td><?=$val->order_no?></td>
										<td><?=$val->invoice_no?></td>
										<td nowrap><?=$val->partner_name?></td>
										<td class="text-center" nowrap><?=date('Y-m-d', strtotime($val->created_date) )?></td>
										<td nowrap><?=$val->goods_id?></td>
										<td nowrap><?=$val->sku_code?></td>
										<td><?=$val->barcode?></td>
										<td><?=$val->brand_name?></td>
										<td nowrap><?=$val->brand_description?></td>
										<td><?=number_format( ceil($val->price) )?></td>
										<td><?=number_format($val->quantity)?></td>
										<td><?=number_format($val->discount)?></td>
										<td><?=number_format( ceil($val->total) )?></td>

									</tr>
								<?php }
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="12" class="text-right">
										<b>Grant Total</b>
									</td>
									<td class="text-right">
										<?=number_format($total);?>
									</td>
								</tr>
							</tfoot>
						</table>
					<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>