<script>
    $(document).ready(() => {
        $("#partner_type_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/partner_type_branch/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'type',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'description',
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        return `
                        <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit(
                            '${row.id}',
                            '${row.type}',
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
        type,
        description
    ) {
        $("#id_edit").val(id);
        $("#type_edit").val(type);
        $("#description_edit").val(description != "null" ? description : "");

        $("#edit_modal").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>