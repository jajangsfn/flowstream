<script>
    $(document).ready(() => {
        $("#pos_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/pos/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'order_no',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'invoice_no',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    },
                    render: function(data, type, row) {
                        return `
                        <a href="<?= base_url("/index.php/penjualan/pos/view/") ?>${row.id}" data-toggle="tooltip" title="Lihat Faktur">
                            ${data}
                        </a>
                        `;
                    }
                },
                {
                    data: 'partner_name'
                },
                {
                    data: 'created_date'
                },
                {
                    data: 'flag',
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return `<span class="text-primary">Menunggu Pembayaran</span>`
                        } else if (data == 2) {
                            return `<span class="text-info">Menunggu Cetak Faktur Pajak</span>`
                        } else if (data == 3) {
                            return `<span class="text-warning">Retur / Pembetulan</span>`
                        } else if (data == 10) {
                            return `<span class="text-success">Selesai</span>`
                        }
                        return `-`;
                    },
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {

                        var edit_button = `
                        <a class="btn btn-icon btn-sm btn-light-primary" href="<?= base_url("/index.php/penjualan/pos/edit/") ?>${data}" data-toggle="tooltip" title="Edit">
                            <i class="fa la-pen"></i>
                        </a>
                        `
                        var extbutton = `
                        <a class="btn btn-icon btn-sm btn-light-success" onclick="confirm_cetak_pajak(${data})" data-toggle="tooltip" title="cetak faktur pajak">
                            <i class="fa la-print"></i>
                        </a>
                        `

                        var bayarbutton = `
                        <a class="btn btn-icon btn-sm btn-light-success" onclick="bayar(${data})" data-toggle="tooltip" title="Pembayaran">
                            <i class="flaticon-interface-9"></i>
                        </a>
                        `

                        if (row.flag != 1) {
                            bayarbutton = "";
                        }

                        if (row.flag == 10) {
                            extbutton = "";
                            edit_button = "";
                        }

                        return `
                        ${bayarbutton}
                        ${edit_button}
                        <a class="btn btn-icon btn-sm btn-light-info" onclick="confirm_cetak(${data})" data-toggle="tooltip" title="cetak ulang" target="_blank">
                            <i class="fa la-print"></i>
                        </a>
                        ${extbutton}
                        `;
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap').addClass("text-center")
                    },
                    sortable: false
                },

            ],

            columnDefs: [{
                targets: -1,
                responsivePriority: 2,
                orderable: false,
            }, ],

            "drawCallback": function(settings) {
                $("*[data-toggle=tooltip]").tooltip()
            },
        })

        $('.select2').select2({
            width: '100%'
        });
    })

    function confirm_cetak(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak ulang faktur transaksi ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                window.open(`<?= base_url("/index.php/penjualan/print_pos/") ?>${id}`, "_blank");
            }
        })
    }

    function confirm_cetak_pajak(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak faktur pajak transaksi ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                Swal.fire("Belum Terimplementasi");
            }
        })
    }

    function bayar(id) {
        $.ajax({
            url: "<?= base_url("/index.php/api/fetch_pos/") ?>" + id,
            success: function(response) {
                const fokus = response.data;
                $("#pos_id_bayar").val(fokus.id)
                $("#nomor_transaksi").val(fokus.order_no)
                if (fokus.salesman_name) {
                    $("#salesman_input").val(fokus.salesman_name)
                    $("#no_transaksi_cell").addClass("col-lg-4").removeClass("col-lg-6");
                    $("#salesman_cell").fadeIn();
                    $("#payment_total_cell").addClass("col-lg-4").removeClass("col-lg-6");
                } else {
                    $("#no_transaksi_cell").removeClass("col-lg-4").addClass("col-lg-6");
                    $("#salesman_cell").fadeOut();
                    $("#payment_total_cell").removeClass("col-lg-4").addClass("col-lg-6");
                }
                $("#total_pembayaran").val(fokus.payment_total)
                $("#payment_modal").modal("show")
            },
            error: function(resp) {
                console.log(resp.responseText)
            }
        })
    }

    function change_payment_method() {
        if ($("#payment_method").val() == "TRANSFER") {
            $("#nama_bank_cell").fadeIn();
            $("#payment_method_cell").removeClass("col-lg-6").addClass("col-lg-4");
            $("#jumlah_bayar_cell").removeClass("col-lg-6").addClass("col-lg-4");
            $("#select_bank").attr('required', "required")
        } else {
            $("#select_bank").removeAttr('required')
        }
    }
</script>
