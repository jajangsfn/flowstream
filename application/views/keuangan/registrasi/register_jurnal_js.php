<script>
    $(document).ready(() => {
        $("#unregistered_jurnal_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/get_unregistered_jurnal/" . $this->session->userdata("branch_id")) ?>",
            columns: [{
                    data: 'jurnal_no',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'jurnal_no'
                },
                {
                    data: 'invoice_no',
                    render: function(data, type, row) {
                        return `
                        <a href="<?= base_url("/index.php/penjualan/pos/view/") ?>${row.pos_id}">
                            ${data}
                        </a>
                        `
                    }
                },
                {
                    data: 'tipe'
                },
                {
                    data: 'payment'
                },
                {
                    data: 'jurnal_date'
                },
                {
                    data: 'jurnal_no',
                    createdCell: function(td) {
                        return $(td).addClass("text-center");
                    },
                    render: function(data) {
                        return `
                            <button onclick="register_jurnal(${data})" type="button" class="btn btn-primary">
                                Register
                            </button>
                        `
                    }
                }
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
        });
    });

    function register_jurnal(jurnal_no) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan register jurnal ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Register!"
        }).then(function(result) {
            if (result.value) {
                window.location.href = `<?= base_url("/index.php/api/register_jurnal/") ?>${jurnal_no}`;
            }
        })
    }
</script>