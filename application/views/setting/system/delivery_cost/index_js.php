<script>
    $(document).ready(() => {
        $("#delivery_cost_table").DataTable({
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
                if ($("#delivery_cost_table").DataTable().row().data() !== undefined) {
                    $("tbody td:first-child").each(function(index, elem) {
                        $(elem).text(index + 1);
                    })
                }
            },
        })

        $('.select2').select2({
            width: '100%'
        });
    })
</script>