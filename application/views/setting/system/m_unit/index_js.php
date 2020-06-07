<script>
    var state = false;
    var numtest = 0;
    $(document).ready(() => {
        $("#m_unit_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            columnDefs: [{
                    responsivePriority: 2,
                    targets: -1
                },
                {
                    targets: -1,
                    orderable: false,
                },
                {
                    targets: 0,
                    orderable: false,
                },
            ],
            "drawCallback": function(settings) {
                if ($("tbody td:first-child").length > 1) {
                    $("tbody td:first-child").each(function(index, elem) {
                        $(elem).text(index + 1);
                    })
                }
            },
        })

    })
</script>