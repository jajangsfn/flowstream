<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Point of Sales</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a class="btn btn-primary font-weight-bolder" href="<?= base_url("/index.php/penjualan/pos/add") ?>">
                <i class="la la-plus"></i>Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="pos_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Order</th>
                    <th>Nomor Faktur</th>
                    <th>Customer</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->