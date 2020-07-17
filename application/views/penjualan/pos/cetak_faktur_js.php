<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url("/index.php/api/get_invoice_number/$data_or->branch_id") ?>",
            success: function(result) {
                $("#nomor_faktur_text").text(result.data);
                $("#nomor_faktur_input").val(result.data);
            },
            error: function (rs) {
                console.log(rs.responseText);
            }
        });
    })
</script>