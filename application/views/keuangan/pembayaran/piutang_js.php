<script>
    function change_customer(e) {
        $("#invoice_cell").fadeOut();
        $(".after_invoice_cell").fadeOut();

        // generate daftar invoice yang belum lunas
        $.ajax({
            url: "<?= base_url("/index.php/api/get_uncomplete_invoice/") ?>" + $(e).val(),
            success: function(result) {
                console.log(result.data);
                $("#invoices").empty();
                $("#invoices").append(
                    `<option label="" value="" selected disabled>Pilih Invoice</option>`
                )
                for (let i = 0; i < result.data.length; i++) {
                    $("#invoices").append(
                        `<option value="${result.data[i].id}">${result.data[i].invoice_no}</option>`
                    )
                }

                $("#invoice_cell").fadeIn();
            },
            error: function(err) {
                console.log(err.responseText);
            }
        })
    }

    function select_invoice_number(e) {
        $(".after_invoice_cell").fadeOut();

        // tampilkan informasi transaksi
        $.ajax({
            url: "<?= base_url("/index.php/api/get_invoice_data/") ?>" + $(e).val(),
            success: function(result) {
                console.log(result.data);
                $(".after_invoice_cell").fadeIn();
                $("#detail_table").empty();
                $("#detail_table").append(
                    $(document.createElement("tr")).append(
                        $(document.createElement("td")).addClass("font-weight-bold pr-20").text("Tanggal Transaksi"),
                        $(document.createElement("td")).text(result.data.pos_date),
                    )
                )
                $("#detail_table").append(
                    $(document.createElement("tr")).append(
                        $(document.createElement("td")).addClass("font-weight-bold pr-20").text("Metode Pembayaran"),
                        $(document.createElement("td")).text(result.data.payment_method),
                    )
                )
                if (result.data.payment_method == "TRANSFER") {
                    $("#detail_table").append(
                        $(document.createElement("tr")).append(
                            $(document.createElement("td")).addClass("font-weight-bold pr-20").text("Bank"),
                            $(document.createElement("td")).text(result.data.bank),
                        )
                    )
                }
                $("#detail_table").append(
                    $(document.createElement("tr")).append(
                        $(document.createElement("td")).addClass("font-weight-bold pr-20").text("Total Harga"),
                        $(document.createElement("td")).text(result.data.payment_total_str),
                    )
                );

                $("#detail_table").append(
                    $(document.createElement("tr")).append(
                        $(document.createElement("td")).addClass("font-weight-bold pr-20").text("Terbayar"),
                        $(document.createElement("td")).text(result.data.terbayar_str),
                    )
                );

                $("#detail_table").append(
                    $(document.createElement("tr")).append(
                        $(document.createElement("td")).addClass("font-weight-bold pr-20").text("Sisa Tagihan"),
                        $(document.createElement("td")).text(result.data.tagihan_str),
                    )
                );

                $("#new_payment").attr("max", result.data.tagihan)

                $("#invoice_no_input").val(result.data.invoice_no);

            },
            error: function(err) {
                console.log(err.responseText);
            }
        })
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        const ye = new Intl.DateTimeFormat('en', {
            year: 'numeric'
        }).format(d)
        const mo = new Intl.DateTimeFormat('en', {
            month: 'short'
        }).format(d)
        const da = new Intl.DateTimeFormat('en', {
            day: '2-digit'
        }).format(d)

        return `${da} ${mo} ${ye}`;
    }
</script>