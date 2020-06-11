<script>
    $(document).ready(() => {
        $("#production_detail_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
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
                if ($("#production_detail_table").DataTable().row().data() !== undefined) {
                    $("tbody td:first-child").each(function(index, elem) {
                        $(elem).text(index + 1).addClass("text-center");
                    })
                }
            },
        })

        $('.select2').select2({
            width: '100%'
        });
    })
</script>