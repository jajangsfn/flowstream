<script>
    $(document).ready(() => {
        $("#parameter_ikhtisar_saldo_table").DataTable({
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
            ajax: "<?= base_url("/index.php/api/parameter_ikhtisar_saldo_cabang/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'acc_code',
                    render: function(data, type, row, meta) {
                        return `<div class="font-weight-bold">${data}</div>`
                    }
                },
                {
                    data: "acc_name"
                },
                {
                    data: "id",
                    className: "text-center",
                    createdCell: function(td) {
                        $(td).attr("nowrap", "nowrap");
                    },
                    render: function(data, type, row, meta) {
                        return `
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="konfirmasi_hapus(${row.id})">
                                <i class="flaticon2-trash"></i>
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

    function konfirmasi_hapus(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan menghapus parameter neraca saldo akhir ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!"
        }).then(function(result) {
            if (result.value) {
                window.location.href = `<?= base_url("/index.php/api/delete_parameter_ikhtisar_saldo/") ?>${id}`;
            }
        })
    }
</script>