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
                    data: 'branch_name',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
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
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        var confirm_button = "";
                        if (row.flag == 1) {
                            confirm_button = `
                            <a type="button" class="btn btn-icon btn-sm btn-light-info" data-toggle="tooltip" title="confirm" href="#">
                                <i class="flaticon2-checkmark"></i>
                            </a>
                        `;
                        }
                        return `
                        <a class="btn btn-icon btn-sm btn-light-success" href="#" data-toggle="tooltip" title="edit">
                            <i class="flaticon2-pen"></i>
                        </a>
                        ${confirm_button}
                        <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="delete_trigger(
                            '${row.id}',
                        )">
                            <i class="flaticon2-trash"></i>
                        </button>
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
            ]
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