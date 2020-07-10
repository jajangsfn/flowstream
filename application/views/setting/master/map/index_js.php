<script>
    $(document).ready(() => {
        const datatabler = $("#map_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/map") ?>",
            createdRow: function(row, data, dataIndex) {
                $(row).attr('data-id', data.id);
            },
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'partner_type',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap').addClass("text-center").attr("data-content", "partner_type")
                    }
                },
                {
                    data: 'price_index',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap').addClass("text-center").attr("data-content", "price_index")
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
                            '${row.price_index}',
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

        $("#add_modal").submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "<?= base_url("/index.php/api/add_map") ?>",
                data: {
                    "partner_type": $("#partner_type_add").val(),
                    "price_index": $("#price_index_add").val()
                },
                success: function(response) {
                    // hide modal
                    $("#add_modal").modal("hide");

                    // info
                    Swal.fire("Success!", response.message, "success");

                    // append row
                    const id = $("#id_edit").val();
                    datatabler.row.add({
                        "id": response.id,
                        "partner_type": $("#partner_type_add").val(),
                        "price_index": $("#price_index_add").val()
                    }).draw();
                },
                error: function(error) {
                    console.log(error.responseText);
                }
            })
        })

        $("#edit_modal").submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "<?= base_url("/index.php/api/edit_map") ?>",
                data: {
                    "id": $("#id_edit").val(),
                    "partner_type": $("#partner_type_edit").val(),
                    "price_index": $("#price_index_edit").val()
                },
                success: function(response) {
                    // hide modal
                    $("#edit_modal").modal("hide");

                    // info
                    Swal.fire("Success!", response.message, "success");

                    // update row
                    const id = $("#id_edit").val();
                    $(`tr[data-id=${id}]`).find(`td[data-content=partner_type]`).first().text($("#partner_type_edit").val())
                    $(`tr[data-id=${id}]`).find(`td[data-content=price_index]`).first().text($("#price_index_edit").val())
                },
                error: function(error) {
                    console.log(error.responseText);
                }
            })
        })

        $("#delete_modal").submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "<?= base_url("/index.php/api/delete_map") ?>",
                data: {
                    "id": $("#id_delete").val()
                },
                success: function(response) {
                    // hide modal
                    $("#delete_modal").modal("hide");

                    // info
                    Swal.fire("Success!", response.message, "success");

                    // delete row
                    const id = $("#id_delete").val();
                    $(`tr[data-id=${id}]`).fadeOut();
                }
            })
        })
    })

    function edit(
        id,
        partner_type,
        price_index,
    ) {
        $("#id_edit").val(id);
        $("#partner_type_edit").val(partner_type);
        $("#price_index_edit").val(price_index);

        $("#edit_modal").modal("show");
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }
</script>