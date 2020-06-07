<script>
    $(document).ready(() => {
        $("#master_barang_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
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
            ]
        })

        $('.select2').select2({
            width: '100%'
        });
    })
</script>