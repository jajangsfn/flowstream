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
                    data: 'flag'
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        return `
                        <a class="btn btn-icon btn-sm btn-light-info" href="#" data-toggle="tooltip" title="cetak ulang">
                            <i class="fa la-print"></i>
                        </a>
                        <a class="btn btn-icon btn-sm btn-light-success" href="#" data-toggle="tooltip" title="cetak faktur pajak">
                            <i class="fa la-print"></i>
                        </a>
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
</script>