<script>
    $(document).ready(() => {
        $("#tax_no_table").DataTable({
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
            ajax: "<?= base_url("/index.php/api/get_tax_no_branch/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: "start_tax"
                },
                {
                    data: "end_tax"
                },
                {
                    data: "sequence"
                },
                {
                    data: "years"
                },
                {
                    data: "flag",
                    render: function(data) {
                        return data == 1 ? "aktif" : "nonaktif"
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
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit_param_tax_no(
                                '${row.id}',
                                '${row.start_tax}',
                                '${row.end_tax}',
                                '${row.sequence}',
                                '${row.years}'
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
</script>

<script>
    function edit_param_tax_no(
        id,
        start_tax,
        end_tax,
        sequence,
        years
    ) {
        $("#id_edit").val(id)
        $("#start_tax_edit").val(start_tax);
        $("#end_tax_edit").val(end_tax);
        $("#sequence_edit").val(sequence);
        $("#years_edit").val(years);
        $("#edit_param_tax_no").modal('show');
    }
</script>