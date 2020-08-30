<script>
    $(document).ready(() => {
        $("#order_request_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/order_request/") ?><?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "" : "/" . $this->session->branch_id ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'order_no',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    },
                    render: function(data, type, row) {
                        return `
                        <a href="<?= base_url("/index.php/penjualan/order_request/view/") ?>${row.id}">
                            ${data}
                        </a>
                        `
                    }
                },
                {
                    data: 'partner_name'
                },
                {
                    data: 'order_date'
                },
                {
                    data: "flag",
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return "<span class='text-info'>New Order</span>";
                        } else if (data == 10) {
                            return "<span class='text-info'>Menunggu Cetak Faktur</span>";
                        } else if (data == 2) {
                            return "<span class='text-success'>Complete</span>";
                        }
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap').addClass("text-center")
                    },
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        var ext_button = "";

                        const editOrderRequest = `<a class="btn btn-icon btn-sm btn-light-success" href="<?= base_url("/index.php/penjualan/edit_order_request/") ?>${data}" data-toggle="tooltip" title="Edit">
                                <i class="flaticon2-edit"></i>
                            </a>`

                        const checksheet = `
                            <a class="btn btn-icon btn-sm btn-light-primary" data-toggle="tooltip" data-placement="top" title="Check Sheet" href="<?= base_url("/index.php/penjualan/order_request/checksheet/") ?>${data}">
                                <i class="flaticon2-checkmark"></i>
                            </a>
                        `

                        const cetakFaktur = `
                            <button onclick="confirm_cetak_faktur(${data})" class="btn btn-icon btn-sm btn-light-info" data-toggle="tooltip" data-placement="top" title="Cetak Faktur">
                                <i class="flaticon2-graph-1"></i>
                            </button>
                        `

                        const deleteTrigger = `
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="delete_trigger(
                            '${row.id}',
                            )" data-toggle="tooltip" title="Hapus">
                                <i class="flaticon2-trash"></i>
                            </button>
                        `

                        const cetakChecksheet = 
                        `
                            <div 
                                class="btn btn-icon btn-sm btn-light-success" 
                                data-toggle="tooltip" 
                                title="Cetak Checksheet"
                                onclick="confirm_cetak_checksheet(${data})"
                            >
                                <i class="fa la-print"></i>
                            </div>
                        `

                        const cetakUlang = 
                        `
                            <div 
                                class="btn btn-icon btn-sm btn-light-info" 
                                data-toggle="tooltip" 
                                title="Cetak Order"
                                onclick="confirm_cetak(${data})"
                            >
                                <i class="fa la-print"></i>
                            </div>
                        `

                        if (row.flag == 1) {
                            ext_button = editOrderRequest + checksheet + cetakUlang + deleteTrigger;
                        } else if (row.flag == 10) {
                            ext_button = checksheet + cetakChecksheet + cetakUlang + cetakFaktur + deleteTrigger;
                        } else if (row.flag == 2) {
                            ext_button = cetakChecksheet + cetakUlang;
                        }

                        return ext_button;
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
            }],

            "drawCallback": function(settings) {
                $("*[data-toggle=tooltip]").tooltip()
            },
        })

        $('.select2').select2({
            width: '100%'
        });

    })

    function confirm_cetak(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak ulang order request ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                window.open(`<?= base_url("/index.php/penjualan/print_order_request/") ?>${id}`, "_blank");
            }
        })
    }

    function confirm_cetak_checksheet(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak checksheet untuk order ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                window.open(`<?= base_url("/index.php/penjualan/print_order_request/") ?>${id}/2`, "_blank");
            }
        })
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal("show");
    }

    function confirm_cetak_faktur(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak faktur order request ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                window.location.href = `<?= base_url("/index.php/api/convert_to_pos/") ?>${id}`;
            }
        })
    }
</script>