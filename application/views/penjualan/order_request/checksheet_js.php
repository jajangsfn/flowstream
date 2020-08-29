<script>
    function delete_baris(goods_id) {
        if ($("table#daftar_barang_order tbody tr").length == 1) {
            Swal.fire({
                title: "Tidak dapat mengosongkan order request",
                text: "Item terakhir pada order request tidak dapat dihapus",
                icon: "info",
            })
        } else {
            $(`table#daftar_barang_order tbody tr#${goods_id}`).remove();
            $("#checksheet_form").append(
                `<input type="hidden" name="barang[${goods_id}][deleted]" value="1">`
            )
            nomor_ulang();
        }
    }

    function nomor_ulang() {
        var counter = 1;
        $("table#daftar_barang_order tbody tr td:first-child").each(function(e) {
            $(this).text(counter++);
        });
    }

    function confirm_pembatalan() {
        Swal.fire({
            title: "Anda yakin?",
            text: "Segala perubahan pada checksheet ini tidak akan tersimpan",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Batalkan Checksheet",
            confirmButtonClass: "btn btn-info",
            cancelButtonText: "Tutup",
            cancelButtonClass: "btn btn-warning"
        }).then(function(result) {
            if (result.value) {
                window.location.href = `<?= base_url("/index.php/penjualan/order_request") ?>`;
            }
        })
    }
</script>
