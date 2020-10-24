<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Penyiapan Barang</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a class="btn btn-primary font-weight-bolder" href="<?= base_url("/index.php/penjualan/add_order_request") ?>">
                <i class="la la-plus"></i>Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="order_request_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Order</th>
                    <th>Customer</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-center">OR</th>
                    <th class="text-center">CS</th>
                    <th class="text-center">Faktur</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_order_request") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Penyiapan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus penyiapan barang</p>
                <small class="m-0 text-info">Seluruh data yang terkait dengan penyiapan barang ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>