<script>
    $(document).ready(() => {
        $("#parameter_kode_rekening_table").DataTable({
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
            ajax: "<?= base_url("/index.php/api/get_parameter_kode_rekening/$data_branch->id") ?>",
            columns: [{
                    data: 'ID',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: "JOURNAL_CD"
                },
                {
                    data: "JOURNAL_TYPE"
                },
                {
                    data: "SEQ_LINE"
                },
                {
                    data: "ACCOUNT_CODE",
                    render: function(data, type, row, meta) {
                        return `${data} - ${row.acc_name}`
                    }
                },
                {
                    data: "ID",
                    className: "text-center",
                    createdCell: function(td) {
                        $(td).attr("nowrap", "nowrap");
                    },
                    render: function(data, type, row, meta) {
                        return `
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit_param_kode_rekening(
                                '${row.ID}',
                                '${row.JOURNAL_CD}',
                                '${row.JOURNAL_TYPE}',
                                '${row.SEQ_LINE}',
                                '${row.ACCOUNT_CODE}'
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
    function edit_param_kode_rekening(
        id,
        JOURNAL_CD,
        JOURNAL_TYPE,
        SEQ_LINE,
        ACCOUNT_CODE
    ) {
        $("#id_param_kode_rekening_edit").val(id)
        $("#JOURNAL_CD_edit").text(JOURNAL_CD);
        $("#JOURNAL_TYPE_edit").text(JOURNAL_TYPE);
        $("#SEQ_LINE_edit").text(SEQ_LINE);
        $("#ACCOUNT_CODE_edit").val(ACCOUNT_CODE);

        $('.select2').trigger('change');
        $("#edit_param_kode_rekening").modal('show');
    }
</script>