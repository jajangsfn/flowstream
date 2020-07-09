<div class="row">
	<div class="col-md-12">
		<?=$this->session->flashdata('msg');?>
		<div class="card card-custom">
		    <div class="card-body">
		      	<form method="post" id="form_receiving" action="<?=base_url()?>index.php/inventori/receiving">
		      		<input type="hidden" name="supplier_id_temp" id="supplier_id_temp">
		      		<input type="hidden" name="po_id_temp" id="po_id_temp">
		      		<div class="row ml-30">
						<div class="col-md-1"></div>
						<label class="col-form-label col-md-1 text-right">Supplier</label>
						<div class="form-group col-md-3">
		                    <div class="w-100">
			                   <select name="supplier" id="supplier_id" class="form-control selectpicker" data-live-search="true" onchange="get_po_list()">
			                      	<option value="" selected>Pilih Supplier</option>
			                       	<?php
			                      	foreach ($supplier as $key => $val) { ?>
			                       		<option value="<?=$val->id?>"><?=$val->name?></option>
			                       	<?php } ?>
			                    </select>
			                </div>
						</div>
						<label class="col-form-label col-md-3 text-right">No Purchase Receive</label>
						<input type="text" name="purchase_receive_no" class="form-control col-md-3" readonly value="<?=$po_no?>">
					</div>

					<div class="row ml-30 mb-8">
						<label class="col-form-label col-md-2 text-right">No Purchase Order</label>
						<div class="col-md-3">

							<select name="po_no_list" id="po_no_list" class="form-control selectpicker" data-live-search="true" onchange="get_goods_list()">
								<option value="">Pilih No Purchase Order</option>
							</select>

						</div>
						
						<label class="col-form-label col-md-3 text-right">Tanggal Receive</label>
						<input type="text" name="tgl_receive" class="col-md-3 form-control" value="<?=date('Y-m-d')?>" readonly>
						
					</div>

					<div class="row ml-30">
						<div class="col-md-1"></div>
						<label class="col-form-label col-md-1 text-right">Gudang</label>
						<div class="form-group col-md-3">
		                    <div class="w-100">
			                   <select name="ws" id="ws_id" class="form-control selectpicker" data-live-search="true" required="">
			                      	<option value="" selected>Pilih Gudang</option>
			                       	<?php
			                      	foreach ($warehouse as $key => $val) { ?>
			                       		<option value="<?=$val->id?>"><?=$val->name?></option>
			                       	<?php } ?>
			                    </select>
			                </div>
						</div>

						<label class="col-form-label col-md-3 text-right">No Referensi</label>
						<input type="text" name="reference_no" class="col-md-3 form-control" value="<?=$po_no?>">
						
					</div>

					<div class="row ml-30">
						<!-- <div class="col-md-1"></div> -->
						<label class="col-form-label col-md-2 text-right">Deskripsi</label>
						<div class="col-md-3">
							<textarea name="description" id="description" class="form-control"></textarea>	
						</div>

					</div>
					<hr>

					<div class="row mt-1">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<table class="table table-condensed">
								<thead>
									<tr>
										<th width="200">Kode Barang</th>
										<th width="350">Nama Barang</th>
										<th width="150">Quantity</th>
										<th width="150">Harga</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>
											<select name="goods_list" id="goods_list" class="form-control selectpicker" data-live-search="true" onchange="get_goods_detail()">
												<option value="">Pilih Kode Barang</option>
											</select>
										</td>
										<td>
											<input type="text" name="goods_name" id="goods_name" class="form-control" readonly placeholder="Nama Barang">
										</td>
										<td>
											<input type="hidden" name="goods_code" id="goods_code" class="form-control" value="0">
											<input type="hidden" name="goods_id" id="goods_id" class="form-control" value="0">
											<input type="hidden" name="goods_discount" id="goods_discount" class="form-control" value="0">

											<input type="hidden" name="goods_qty_sisa" id="goods_qty_sisa" class="form-control" min="1" value="1">
											<input type="number" name="goods_qty" id="goods_qty" class="form-control" min="1" value="1">
										</td>
										<td>
											<input type="text" name="goods_price" id="goods_price" class="form-control" readonly>
										</td>
										<td>
											<button type="button" id="btn_add" class="btn btn-light-primary" onclick="add_to_chart()">
												<span class="fa la-check"></span> Tambah
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<hr>
					<div class="row mt-1">
						<div class="col-md-10 text-right">
							<p class="h4">Total</p>
						</div>
						<div class="col-md-2 text-left">
							<p class="h5" id="grant_total"></p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-condensed table-striped">
								<thead>
									<tr>
										<th width="1">No</th>
										<th>Kode Barang/PLU</th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Quantity Receive(PCS)</th>
										<th>Discount</th>
										<th>Jumlah</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody id="receive_list"></tbody>
							</table>

							<div class="text-center">
								<button type="button" class="btn btn-light-success btn-md" id="btn_save_receiving">
									<span class="fa la-save"></span> Save
								</button>

								<a href="<?=base_url()?>index.php/inventori/receiving" class="btn btn-light-danger btn-md">
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
