<script>
    $(document).ready(() => {
        $('#create_modal_form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        $("#employee_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/employee_branch/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'name',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'employee_number',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'level_name'
                },
                {
                    data: 'position_name'
                },
                {
                    data: 'birth',
                },
                {
                    data: 'address',
                },
                {
                    data: 'phone_1',
                    render: function(data, row) {
                        var toret = "";
                        if (data) {
                            toret += `<span>${data}</span>`
                        }
                        if (row.phone_2) {
                            toret += `<span>${row.phone_2}</span>`
                        }
                        if (!toret) {
                            toret = "-";
                        }
                        return toret;
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).addClass("text-center")
                    }
                },
                {
                    data: 'join_date'
                },
                {
                    data: 'is_active',
                    render: function(data) {
                        if (data > 0) {
                            return `<span class="text-success">Aktif</span>`
                        } else {
                            return `<span class="text-danger">Nonaktif</span>`
                        }
                    }
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        var extbutton = `
                        <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="delete_trigger(
                            '${row.id}',
                        )">
                            <i class="flaticon2-cross"></i>
                        </button>
                        `;
                        if (row.is_active == 0) {
                            extbutton = `
                            <button type="button" class="btn btn-icon btn-sm btn-light-primary" onclick="active_trigger(
                                '${row.id}',
                            )">
                                <i class="flaticon2-checkmark"></i>
                            </button>
                        `;
                        }
                        return `
                        <button type="button" class="btn btn-icon btn-sm btn-light-info" data-toggle="tooltip" data-title="Reset Password" onclick="confirm_reset(
                            '${row.id}'
                        )">
                            <i class="flaticon2-time"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-sm btn-light-success" data-toggle="tooltip" data-title="Edit" onclick="edit(
                            '${row.id}',
                            '${row.name}',
                            '${row.employee_number}',
                            '${row.level_id}',
                            '${row.position_id}',
                            '${row.birth}',
                            '${row.address}',
                            '${row.phone_1}',
                            '${row.phone_2}',
                            '${row.join_date}',
                            '${row.is_active}'
                        )">
                            <i class="flaticon2-pen"></i>
                        </button>
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

    function edit(
        id,
        name,
        employee_number,
        level_id,
        position_id,
        birth,
        address,
        phone_1,
        phone_2,
        join_date,
        is_active
    ) {
        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#employee_number_edit").val(employee_number);
        $("#level_id_edit").val(level_id);
        $("#position_id_edit").val(position_id);
        $("#birth_edit").val(birth);
        $("#address_edit").val(address);
        $("#phone_1_edit").val(phone_1);
        $("#phone_2_edit").val(phone_2);
        $("#join_date_edit").val(join_date);
        $("#is_active_edit").val(is_active);

        $('.select2').trigger('change');
        $("#edit_employee").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }

    function active_trigger(id) {
        $("#id_active").val(id);

        $("#active_modal").modal("show");
    }

    function check_username(e) {
        if ($(e).val()) {
            $.ajax({
                url: "<?= base_url("/index.php/api/check_username/") ?>" + $(e).val(),
                success: function(response) {
                    if (response.data.message == "available") {
                        $("#add_modal_simpan_button").removeAttr("disabled")
                        $("#username_not_available").addClass("d-none");
                    } else {
                        $("#add_modal_simpan_button").attr("disabled", "disabled")
                        $("#username_not_available").removeClass("d-none");
                    }
                },
                error: function(err) {
                    alert("terjadi kesalahan, cek console");
                    console.log(err.responseText);
                }
            })
        } else {
            $("#add_modal_simpan_button").attr("disabled", "disabled");
        }
    }

    function confirm_reset(employee_id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mengatur ulang password untuk karyawan ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Reset!"
        }).then(function(result) {
            if (result.value) {
                window.location.href = `<?= base_url("/index.php/api/trigger_reset_password/") ?>${employee_id}`;
            }
        })
    }
</script>