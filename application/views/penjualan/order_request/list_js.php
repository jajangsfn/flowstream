<script>
    $(document).ready(() => {
        $("#order_request_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/order_request/") ?><?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "" : "/" . $this->session->branch_id ?>",
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
                    data: 'partner_name'
                },
                {
                    data: 'order_date'
                },
                {
                    data: "flag",
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return "<span class='text-info'>New Order</span>";
                        } else if (data == 2) {
                            return "<span class='text-success'>Complete</span>";
                        }
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap').addClass("text-center")
                    },
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        var container = $(document.createElement("div"));
                        var ext_button = "";
                        if (row.flag == 1) {
                            ext_button = `
                            <a class="btn btn-icon btn-sm btn-light-success" href="<?= base_url("/index.php/penjualan/edit_order_request/") ?>${data}" data-toggle="tooltip" title="edit">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <a class="btn btn-icon btn-sm btn-light-primary" data-toggle="tooltip" data-placement="top" title="cetak faktur" href="<?= base_url("/index.php/penjualan/pos/cetak_faktur/") ?>${data}">
                                <i class="flaticon2-checkmark"></i>
                            </a>
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="delete_trigger(
                            '${row.id}',
                            )" data-toggle="tooltip" title="hapus">
                                <i class="flaticon2-trash"></i>
                            </button>
                        `;
                        } else {
                            ext_button = `
                            <a class="btn btn-icon btn-sm btn-light-success" href="<?= base_url("/index.php/penjualan/order_request/view/") ?>${data}" data-toggle="tooltip" title="view">
                                <i class="flaticon-eye"></i>
                            </a>
                            `
                        }
                        container.append(
                            ext_button,
                            $(document.createElement("div"))
                            .addClass("btn btn-icon btn-sm btn-light-info")
                            .attr("data-toggle", "tooltip")
                            .attr("title", "cetak ulang")
                            .attr("onclick", `confirm_cetak(${data})`)
                            .append(
                                $(document.createElement("i")).addClass("fa la-print")
                            )
                        )
                        return container.html();
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
                },
                {
                    targets: 0,
                    orderable: false,
                },
            ],

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
            text: "Anda akan mencetak ulang order request ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                window.open(`<?= base_url("/index.php/penjualan/print_order_request/") ?>${id}`, "_blank");
            }
        })
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>