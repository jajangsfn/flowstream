<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url("/index.php/api/get_invoice_number/$data_or->branch_id") ?>",
            success: function(result) {
                $("#nomor_faktur_text").text(result.data);
                $("#nomor_faktur_input").val(result.data);
                $("#nomor_transaksi").val(result.data);
            },
            error: function(rs) {
                console.log(rs.responseText);
            }
        });

        $('.select2').select2({
            width: "100%"
        });
    })

    function change_payment_method() {
        switch ($("#payment_method").val()) {
            case "TRANSFER":
                $("#nama_bank_cell").fadeIn();
                $("#jumlah_bayar_cell").removeClass("col-lg-6").addClass("col-lg-4");
                $("#payment_method_cell").removeClass("col-lg-6").addClass("col-lg-4");
                break;
            default:
                $("#nama_bank_cell").fadeOut();
                $("#jumlah_bayar_cell").removeClass("col-lg-4").addClass("col-lg-6");
                $("#payment_method_cell").removeClass("col-lg-4").addClass("col-lg-6");
                break;
        }
    }

    function hitung_ulang() {
        var total = 0;
        $("table#daftar_barang_order tbody tr").each(function(e) {
            const goods_id = $(this).attr("id");
            const jumlah_baru = Number($(`#jumlah_${goods_id}`).val());
            const harga = Number(
                $(`tr#${goods_id} td[data-info=price]`).text()
            );
            total += (harga * jumlah_baru);
        });
        $("#total_harga_order").text(total);
        $("#tax_price").text(10 * total / 100);
        $("#total_harga_order_tax").text(110 * total / 100);
        $("#total_pembayaran").val(110 * total / 100);
    }

    function delete_baris(goods_id) {
        if ($("table#daftar_barang_order tbody tr").length == 1) {
            Swal.fire({
                title: "Tidak dapat mengosongkan order request",
                text: "Item terakhir pada order request tidak dapat dihapus",
                icon: "info",
            })
        } else {
            $(`table#daftar_barang_order tbody tr#${goods_id}`).remove();
            nomor_ulang();
            hitung_ulang();
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
