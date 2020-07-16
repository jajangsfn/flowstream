<script>
    $(document).ready(() => {
        $("#m_map_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/m_map_branch/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'partner_type',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'price_index',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        return `
                        <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit(
                            '${row.id}',
                            '${row.partner_type}',
                            '${row.price_index}'
                        )">
                            <i class="flaticon2-pen"></i>
                        </button>
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

    function edit(
        id,
        partner_type,
        price_index
    ) {
        $("#id_edit").val(id);
        $("#partner_type_edit").text(partner_type);
        $("#price_index_edit").val(price_index);

        $("#edit_modal").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>