<script>
    $(document).ready(() => {
        $("#m_warehouse_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/gudang_branch/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'code',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'name',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'address'
                },
                {
                    data: 'length'
                },
                {
                    data: 'width',
                },
                {
                    data: 'capacity',
                },
                {
                    data: 'description'
                },
                {
                    data: 'created_date'
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        return `
                        <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit(
                            '${row.id}',
                            '${row.code}',
                            '${row.name}',
                            '${row.address}',
                            '${row.length}',
                            '${row.width}',
                            '${row.capacity}',
                            '${row.description}'
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
        code,
        name,
        address,
        length,
        width,
        capacity,
        description,
    ) {
        $("#id_edit").val(id);
        $("#code_edit").val(code);
        $("#name_edit").val(name);
        $("#address_edit").val(address);
        $("#length_edit").val(length);
        $("#width_edit").val(width);
        $("#capacity_edit").val(capacity);
        $("#description_edit").val(description);

        $('.select2').trigger('change');
        $("#edit_modal").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>