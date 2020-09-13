<script>
    $(document).ready(() => {
        $("#full_users_list").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/flowstream_api/users/get_all_users") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'branch_name'
                },
                {
                    data: 'user_id'
                },
                {
                    data: 'role_code'
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        return "";
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