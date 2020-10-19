<script>
    $(document).ready(() => {
        $("#akun_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            iDisplayLength: 50,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                },
                {
                    targets: -1,
                    orderable: false,
                },
            ],
            ajax: "<?= base_url("/index.php/api/account_code_cabang/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'acc_code'
                },
                {
                    data: "acc_name"
                },
                {
                    data: "group_code"
                },
                {
                    data: "upr_acc_code"
                },
                {
                    data: "master_type"
                },
                {
                    data: "inv_required",
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return `<span class="text-success">Ya</span>`;
                        } else {
                            return `<span class="text-muted">Tidak</span>`;
                        }
                    }
                },
                {
                    data: "is_active",
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return `<span class="text-success">Active</span>`;
                        } else {
                            return `<span class="text-muted">Not Active</span>`;
                        }
                    }
                },
                {
                    data: "id",
                    className: "text-center",
                    createdCell: function(td) {
                        $(td).attr("nowrap", "nowrap");
                    },
                    render: function(data, type, row, meta) {
                        return `
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit_trigger(
                                '${row.id}',
                                '${row.acc_code}',
                                '${row.acc_name}',
                                '${row.group_code}',
                                '${row.upr_acc_code}',
                                '${row.master_type}',
                                '${row.is_active}',
                                '${row.inv_required}'
                                )">
                                <i class="flaticon2-pen"></i>
                            </button>
                        `
                    }
                }
            ]
        })

        $('.select2').select2({
            width: '100%'
        });
    })

    function edit_trigger(
        id,
        acc_code,
        acc_name,
        group_code,
        upr_acc_code,
        master_type,
        is_active,
        inv_required
    ) {
        $("#id_edit").val(id)
        $("#acc_code_edit").val(acc_code)
        $("#acc_name_edit").val(acc_name)
        $("#group_code_edit").val(group_code)
        $("#upr_acc_code_edit").val(upr_acc_code != "null" ? upr_acc_code : "")
        $("#master_type_edit").val(master_type != "null" ? master_type : "")
        if (is_active == 1) {
            $("#is_active_edit").attr("checked", "checked");
        } else {
            $("#is_active_edit").removeAttr("checked");
        }
        if (inv_required == 1) {
            $("#inv_required_edit").attr("checked", "checked");
        } else {
            $("#inv_required_edit").removeAttr("checked");
        }

        $('.select2').trigger('change');
        $("#edit_modal").modal('show');
    }
</script>