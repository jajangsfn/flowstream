<script> 
    $(document).ready(() => {
        $("#pos_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/pos") ?>",
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
                    }
                },
                {
                    data: 'invoice_no',
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap')
                    }
                },
                {
                    data: 'partner_name'
                },
                {
                    data: 'created_date'
                },
                {
                    data: 'flag',
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return `<span class="text-info">Selesai</span>`
                        } else if (data == 3) {
                            return `<span class="text-warning">Retur / Pembetulan</span>`
                        } else if (data == 10) {
                            return `<span class="text-success">Faktur Pajak Telah Dicetak</span>`
                        }
                        return `-`;
                    },
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        var extbutton = `<a class="btn btn-icon btn-sm btn-light-success" onclick="confirm_cetak_pajak(${data})" data-toggle="tooltip" title="cetak faktur pajak">
                            <i class="fa la-print"></i>
                        </a>`

                        if (row.flag == 10) {
                            extbutton = ""
                        }

                        return `
                        <a class="btn btn-icon btn-sm btn-light-info" onclick="confirm_cetak(${data})" data-toggle="tooltip" title="cetak ulang" target="_blank">
                            <i class="fa la-print"></i>
                        </a>
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

    function confirm_cetak(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak ulang faktur transaksi ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                window.open(`<?= base_url("/index.php/penjualan/print_pos/") ?>${id}`, "_blank");
            }
        })
    }

    function confirm_cetak_pajak(id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Anda akan mencetak faktur pajak transaksi ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Cetak!"
        }).then(function(result) {
            if (result.value) {
                Swal.fire("Belum Terimplementasi");
            }
        })
    }
</script>