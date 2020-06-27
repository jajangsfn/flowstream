<div class="row">
	<!-- card for search product list -->
	<div class="col-md-4">
		<div class="card card-custom w-100">

		     <div class="card-body">
		     	<!-- search input -->
				 <?= $this->load->view("component/input/flowstream_input", array(
                      "name" => "name",
                      "type" => "text",
                      "required" => true,
                      "placeholder" => "Isi Nama Barang",
                      "label" => "Search",
                      "help" => "",
                      "value" => false,
                      "autocomplete"=>"off",
                        ), true); ?>	
                <hr>
                <ul class="list-group">

				  <li class="list-group-item d-flex justify-content-between align-items-center" onclick="add_to_chart()">
				    <span class="h6">Gayung<br><br>112829</span>
				    <span class="badge badge-primary badge-pill">
				    	<span class="fa fa-arrow-right"></span>
				    </span>
				  </li>

				  <li class="list-group-item d-flex justify-content-between align-items-center" onclick="add_to_chart()">
				    <span class="h6">Gayung<br><br>112829</span>
				    <span class="badge badge-primary badge-pill">
				    	<span class="fa fa-arrow-right"></span>
				    </span>
				  </li>

				  <li class="list-group-item d-flex justify-content-between align-items-center" onclick="add_to_chart()">
				    <span class="h6">Gayung<br><br>112829</span>
				    <span class="badge badge-primary badge-pill">
				    	<span class="fa fa-arrow-right"></span>
				    </span>
				  </li>
				  
				</ul>

		     </div>
		 </div>
	</div>

	<div class="col-md-8">
		<div class="card card-custom">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title text-center">
		            <h3 class="card-label">
		                Add Purchase Order
		            </h3>
		        </div>
		    </div>

			<div class="card-body">

				<div class="row">
					<label class="col-md-2">PO. NO</label>
					<label class="col-md-2">XXX.XXXXXX</label>

					<label class="col-md-4"></label>

					<label class="col-md-2">INV. NO</label>
					<label class="col-md-2">XXX.XXXXXX</label>
				</div>

				<div class="row">
					<label class="col-md-2">CUSTOMER</label>
					<div class="col-md-3">
                        <div class="form-group w-100">
	                        <select name="customer" class="form-control select2">
	                        	<option value="" selected>Pilih Customer</option>
	                        	<option value="" selected>Pilih Customer</option>
	                        	<option value="" selected>Pilih Customer</option>
	                        	<option value="" selected>Pilih Customer</option>
	                        </select>
	                    </div>
					</div>
					<label class="col-md-3"></label>
					<label class="col-md-2">TAX. NO</label>
					<label class="col-md-2">XXX.XXXXXX</label>
				</div>

				<div class="row">
					<div class="col-md-8"></div>
					<label class="col-md-4">
						<?=date('Y-m-d')?>
					</label>
				</div>
				<hr>
				<div class="row p-6">
					<div class="col-md-10 text-right h3">
						Total
					</div>
					<div class="col-md-2 h3">
						750. 000
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Barang/PLU</th>
								<th>Nama Barang</th>
								<th>Harga</th>
								<th>Quantity Order (PCS)</th>
								<th>Discount</th>
								<th>Jumlah</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<tr>
		                        <td>1</td>
		                        <td>2019100001</td>
		                        <td>Gayung</td>
		                        <td>20.000</td>
		                        <td align="center">50</td>
		                        <td align="center">10</td>
		                        <td align="Right">900.000</td>
		                        <td style="text-align: center;">
		                          <a class="btn btn-warning btn-xs"><i class="fa fa-trash" title="Edit"></i></a>
		                        </td>
		                      </tr>
		                      <tr>
		                        <td>2</td>
		                        <td>2019100001</td>
		                        <td>Ember</td>
		                        <td>20.000</td>
		                        <td align="center">50</td>
		                        <td align="center">10</td>
		                        <td align="Right">900.000</td>
		                        <td style="text-align: center;">
		                          <a class="btn btn-warning btn-xs"><i class="fa fa-trash" title="Edit"></i></a>
		                        </td>
		                      </tr>
		                      <tr>
		                        <td>3</td>
		                        <td>2019100002</td>
		                        <td>Tempat Sampah</td>
		                        <td>20.000</td>
		                        <td align="center">50</td>
		                        <td align="center">10</td>
		                        <td align="Right">900.000</td>
		                        <td style="text-align: center;">
		                          <a class="btn btn-warning btn-xs"><i class="fa fa-trash" title="Edit"></i></a>
		                        </td>
		                      </tr>
		                      <tr>
		                        <td>4</td>
		                        <td>2019100003</td>
		                        <td>Mangkok</td>
		                        <td>20.000</td>
		                        <td align="center">50</td>
		                        <td align="center">10</td>
		                        <td align="Right">900.000</td>
		                        <td style="text-align: center;">
		                          <a class="btn btn-warning btn-xs"><i class="fa fa-trash" title="Edit"></i></a>
		                        </td>
		                      </tr>
		                      <tr>
		                        <td>5</td>
		                        <td>2019100004</td>
		                        <td>Sendok</td>
		                        <td>20.000</td>
		                        <td align="center">50</td>
		                        <td align="center">10</td>
		                        <td align="Right">900.000</td>
		                        <td style="text-align: center;">
		                          <a class="btn btn-warning btn-xs"><i class="fa fa-trash" title="Edit"></i></a>
		                        </td>
		                      </tr>
		                      <tr>
		                        <td>6</td>
		                        <td>2019100005</td>
		                        <td>Tong</td>
		                        <td>20.000</td>
		                        <td align="center">50</td>
		                        <td align="center">10</td>
		                        <td align="Right">900.000</td>
		                        <td style="text-align: center;">
		                          <a class="btn btn-warning btn-xs"><i class="fa fa-trash" title="Edit"></i></a>
		                        </td>
		                      </tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="tambahBrgKeChart" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= current_url() ?>">
                <div class="card-header">
                    Tambah ke Troli
                </div>
                <div class="card-body">
                	<div class="row">
                		<div class="col-md-4">Nama Barang</div>
                		<div class="col-md-8">Gayung</div>
                	</div>

                	<div class="row mt-10">
                		<div class="col-md-4">Qty</div>
	                	<div class="col-md-8">
	                		<input type="number" name="qty_chart" class="form-control" placeholder="Isi Qty Barang" value="1">
	                	</div>
                	</div>
                	
                	

                </div>
                <div class="card-footer">
                    <!-- <?= $this->load->view("component/button/submit", "", true); ?> -->
                    <button type="submit" class="btn btn-primary mr-2">Add to Chart</button>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>