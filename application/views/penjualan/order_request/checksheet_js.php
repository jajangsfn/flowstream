<script>
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
