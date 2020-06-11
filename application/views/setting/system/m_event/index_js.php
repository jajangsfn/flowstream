<script>
    var state = false;
    var numtest = 0;
    $(document).ready(() => {
        $("#m_event_table").DataTable({
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
                if ($("#m_event_table").DataTable().row().data() !== undefined) {
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