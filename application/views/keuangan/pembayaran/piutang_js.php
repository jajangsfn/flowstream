<script>
    $(document).ready(() => {
        if (
            $("#main_customer_selector").val()
        ) {
            window.location.reload();
        }
    })

    function change_customer(e) {
        $("#invoice_cell").fadeOut();
        $(".after_invoice_cell").fadeOut();

        // generate daftar invoice yang belum lunas
        $.ajax({
            url: "<?= base_url("/index.php/api/get_uncomplete_invoice/") ?>" + $(e).val(),
            success: function(result) {
                $("#invoice_list").empty();

                for (let i = 0; i < result.data.length; i++) {
                    $("#invoice_list").append(
                        `
                            <tr>
                                <td>${i + 1}</td>
                                <td>
                                    <a href="<?= base_url("/index.php/penjualan/pos/view/") ?>${result.data[i].pos_id}">
                                        ${result.data[i].invoice_no}
                                    </a>
                                </td>
                                <td>
                                    ${result.data[i].created_date}
                                </td>
                                <td>
                                    <button type="button" onclick="init_bayar(${result.data[i].id})" class="btn btn-icon btn-sm btn-light-info" data-toggle="tooltip" data-placement="top" title="Pembayaran">
                                        <i class="flaticon2-graph-1"></i>
                                    </button>
                                </td>
                            </tr>
                        `
                    )
                }

                $("#invoice_cell").fadeIn();
            },
            error: function(err) {
                console.log(err.responseText);
            }
        })
    }

    function init_bayar(tpp_id) {
        $.ajax({
            url: "<?= base_url("/index.php/api/get_piutang_data/") ?>" + tpp_id,
            success: function(result) {
                console.log(result.data);
                $("#invoice_date").text(": " + result.data.invoice_date)
                $("#invoice_no").text(": " + result.data.invoice_no)
                $("#total_tagihan_str").text(": " + result.data.total_tagihan_str)
                $("#sisa_tagihan_str").text(": " + result.data.sisa_tagihan_str)
                $("#new_payment").attr("max", result.data.sisa_tagihan);
                $("#new_payment").val(result.data.sisa_tagihan);
                $("#tpp_id").val(result.data.id);
                $("#tpp_modal").modal("show");
            },
            error: function(err) {
                console.log(err.responseText);
                alert("terjadi kesalahan");
            }
        });
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