<link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" type="text/css" />

<body onload="window.print()">
	<div class="container">
		<div class="text-center">
			<h1>Cetak Laporan Penjualan <?= $type == 1 || $type == 3 ? "Harian per tanggal ".date('d M Y') : "Bulanan"?></h1>
			<h3><?=$type== 2 ? "Dari tanggal ".$from." sampai tanggal ".$to : ""?></h3>
		</div>
			<div class="row mt-10">
				<div class="col-lg-2">
						
				</div>
				<div class="col-lg-8">

					<?php
					if( $type == 3 ) { ?>
					<table class="table table-bordered table-condensed">
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
									<th>Total</th>
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
				</div>
			</div>
		<?php }

			if ( $type == 1) { ?>

				<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Customer</th>
									<th>No Nota</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$total = 0;
								foreach ($master as $key => $val) { 
									$total+=$val->total;?>
									<tr>
										<td class="text-center" nowrap><?=date('Y-m-d', strtotime($val->created_date) )?></td>
										<td nowrap><?=$val->partner_name?></td>
										<td><?=$val->invoice_no?></td>									
										<td class="text-right"><?=number_format( ceil($val->total) )?></td>

									</tr>
								<?php }
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3" class="text-right">
										<b>Grant Total</b>
									</td>
									<td class="text-right">
										<?=number_format($total);?>
									</td>
								</tr>
							</tfoot>
						</table>
				</div>
			</div>

			<?php }

			if ($type == 2){ ?>
			<div class="row">
				<div class="col-lg-2">
						
				</div>
				<div class="col-lg-8">
					<div class="row">
						<div class="col-md-6">
							<div class="jumbotron">
								<h2>Total Penjualan <?=$total_trans?></h2>
							</div>
						</div>
						<div class="col-md-6">
							<div class="jumbotron">
								<h2>Total Pendapatan Rp.<?= number_format($total_sum) ?></h2>
							</div>
						</div>
					</div>
					<table class="table table-bordered table-condensed">
						<thead>
							<tr>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Jumlah Transaksi</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total = 0;
							foreach ($master as $key => $val) { 
								$total+=$val->total;
								?>
								<tr>
									<td><?=date('Y-m-d', strtotime($val->updated_date))?></td>
									<td width="200"><?=$val->total_trans?></td>										
									<td class="text-right"><?=number_format( $val->total )?></td>
								</tr>
								<?php }
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2" class="text-right">Grant Total</td>
									<td class="text-right" width="200">Rp. <?=number_format($total) ?></td>
								</tr>
							</tfoot>
						</table>
				</div>
			</div>
		<?php }
		?>
	</div>
</body>
<script>
	$(document). ready( function() {
		window.onload = window.print();
	});
</script>