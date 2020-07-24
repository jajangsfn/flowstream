<script>
    $(document).ready(() => {
        $("#order_request_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/order_request") ?>",
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
                        return `
                        ${ext_button}
                        <a class="btn btn-icon btn-sm btn-light-info" data-toggle="tooltip" title="cetak ulang" href="<?= base_url("/index.php/penjualan/print_order_request/") ?>${data}" target="_blank">
                            <i class="fa la-print"></i>
                        </a>
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

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>