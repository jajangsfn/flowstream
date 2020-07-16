<script>
    var state = false;
    var numtest = 0;
    $(document).ready(() => {
        $("#m_delivery_table").DataTable({
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
            ]
        })
        $('.select2').select2({
            width: '100%'
        });
    })
</script>