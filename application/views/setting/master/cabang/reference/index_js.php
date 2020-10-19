<script>
    console.log("<?= base_url("/index.php/api/reference_branch/$data_target/$data_branch->id") ?>");
    $(document).ready(() => {
        $("#reference_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/reference_branch/$data_target/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'detail_data',
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
                            '${row.detail_data}',
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
        detail_data,
    ) {
        $("#id_edit").val(id);
        $("#detail_data_edit").val(detail_data);

        $("#edit_modal").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>