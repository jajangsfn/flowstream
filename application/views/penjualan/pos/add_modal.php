<div class="modal fade" id="daftarBarang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Cari Barang" onkeyup="suggester_me(event, this)" />
                <div class="scroll scroll-pull goods_placement" data-scroll="true" data-height="400">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan ke troli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr class="py-2">
                        <td class="mr-3 w-25">Nama</td>
                        <td class="w-75">
                            <span id="nama_barang_tambah"></span>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Deskripsi</td>
                        <td class="w-75">
                            <span id="desk_barang_tambah"></span>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Kode Barang</td>
                        <td class="w-75">
                            <span id="barcode_barang_tambah"></span>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Harga Barang</td>
                        <td class="w-75">
                            <span id="harga_barang_tambah"></span>
                        </td>
                    </tr>
                    <tr class="py-2">
                        <td class="mr-3 w-25">Jumlah</td>
                        <td class="w-75">
                            <input type="number" id="jumlah_tambah_baru" class="form-control" value="1" min="1">
                        </td>
                    </tr>
                </table>
                <div class="text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="tombol_tambah_baru" onclick="tambah_barang(this)">
                        Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>