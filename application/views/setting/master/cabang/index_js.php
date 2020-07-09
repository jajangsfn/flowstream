<script>
    $(document).ready(() => {
        $("#m_branch_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/cabang") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'logo',
                    render: function(data) {
                        return `<img src="<?= base_url("/attachment") ?>/${data}" height="50px" width="50px" class="rounded-circle">`
                    },
                    sortable: false
                },
                {
                    data: 'name',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'owner'
                },
                {
                    data: 'address'
                },
                {
                    data: 'npwp'
                },
                {
                    data: 'tax_status',
                },
                {
                    data: 'online_status',
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
                            '${row.logo}',
                            '${row.name}',
                            '${row.owner}',
                            '${row.address}',
                            '${row.npwp}',
                            '${row.tax_status}',
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

        var logo = new KTImageInput('logo');

        logo.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil diubah !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        logo.on('change', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil diubah !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        logo.on('remove', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil dihapus !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        var logo = new KTImageInput("logo_edit");
        logo.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil diubah !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        logo.on('change', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil diubah !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        logo.on('remove', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil dihapus !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
    })

    function edit(
        id,
        logo,
        name,
        owner,
        address,
        npwp,
        tax_status,
    ) {
        $("#id_edit").val(id);
        $("#logo_placement_edit").removeAttr("style");
        $("#logo_placement_edit").attr("style", `background-image: url(<?= base_url("attachment/") ?>${logo})`);
        $("#name_edit").val(name);
        $("#owner_edit").val(owner);
        $("#address_edit").val(address);
        $("#npwp_edit").val(npwp);
        $("#tax_edit").val(tax_status);

        $("#edit_modal").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>