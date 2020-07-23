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
            case "CASH":
                $("#nama_bank_cell").fadeOut();
                $("#jumlah_bayar_cell").removeClass("col-lg-4").addClass("col-lg-6");
                $("#payment_method_cell").removeClass("col-lg-4").addClass("col-lg-6");
                break;
            default:
                $("#nama_bank_cell").fadeIn();
                $("#jumlah_bayar_cell").removeClass("col-lg-6").addClass("col-lg-4");
                $("#payment_method_cell").removeClass("col-lg-6").addClass("col-lg-4");
                break;
        }
    }
</script>