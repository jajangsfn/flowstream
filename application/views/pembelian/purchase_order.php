<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                List Pembelian
            </h3>
        </div>
         <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?= base_url()?>index.php/pembelian/add_purchase" class="btn btn-primary font-weight-bolder">
              <i class="la la-plus"></i> Tambah
            </a>
        </div>
    </div>
     <div class="card-body">
     	 <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
            <thead>
                <tr>
                	<th>No</th>
                	<th>No Purchase Order</th>
                	<th>No Referensi</th>
                	<th>Supplier</th>
                	<th>Tanggal PO</th>
                	<th>Keterangan</th>
                	<th>Total</th>
                	<th>Status</th>
                	<th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                        <tr>
                          <td>1</td>
                          <td>2019100001</td>
                          <td>2019100001</td>
                          <td>PT. A</td>
                          <td>2019-10-01</td>
                          <td>Minta Dikirim Hari ini</td>
                          <td>650.000</td>
                          <td>Draft</td>
                          <td style="text-align: center;">
                            <a href="#" class="btn btn-warning btn-xs" ><i class="fa fa-edit" title="Edit"></i></a>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-calendar" title="Approve"></i></a>
                          </td>
                        </tr>  
                        <tr>
                          <td>2</td>
                          <td>2019100002</td>
                          <td>2019100002</td>
                          <td>PT. B</td>
                          <td>2019-10-01</td>
                          <td>Minta Dikirim Hari ini</td>
                          <td>650.000</td>
                          <td>Draft</td>
                          <td style="text-align: center;">
                            <a href="#" class="btn btn-warning btn-xs" ><i class="fa fa-edit" title="Edit"></i></a>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-calendar" title="Approve"></i></a>
                          </td>
                        </tr> 
                        <tr>
                          <td>3</td>
                          <td>2019100003</td>
                          <td>2019100003</td>
                          <td>PT. C</td>
                          <td>2019-10-01</td>
                          <td>Minta Dikirim Hari ini</td>
                          <td>650.000</td>
                          <td>Approved</td>
                          <td style="text-align: center;">
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                          </td>
                        </tr> 
                        <tr>
                          <td>4</td>
                          <td>2019100004</td>
                          <td>2019100004</td>
                          <td>PT. D</td>
                          <td>2019-10-02</td>
                          <td>Minta Dikirim Hari ini</td>
                          <td>650.000</td>
                          <td>Approved</td>
                          <td style="text-align: center;">
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                          </td>
                        </tr>  
                        <tr>
                          <td>5</td>
                          <td>2019100005</td>
                          <td>2019100005</td>
                          <td>PT. E</td>
                          <td>2019-10-02</td>
                          <td>Minta Dikirim Hari ini</td>
                          <td>650.000</td>
                          <td>Draft</td>
                          <td style="text-align: center;">
                            <a href="#" class="btn btn-warning btn-xs" ><i class="fa fa-edit" title="Edit"></i></a>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-calendar" title="Approve"></i></a>
                          </td>
                        </tr> 
            </tbody>
        </table>

     </div>
</div>


