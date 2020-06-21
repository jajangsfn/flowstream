<script>
    $(document).ready(() => {
        $("#m_branch_table").DataTable({
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
                if ($("#m_branch_table").DataTable().row().data() !== undefined) {
                    $("tbody td:first-child").each(function(index, elem) {
                        $(elem).text(index + 1);
                    })
                }
            },
        })

        var logo = new KTImageInput('logo');

        logo.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil diubah !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        logo.on('change', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil diubah !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        logo.on('remove', function(imageInput) {
            swal.fire({
                title: 'Logo berhasil dihapus !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        <?php for ($i = 0; $i < count($m_branch); $i++) { ?>
            var logo = new KTImageInput("logo_edit_<?= $i ?>");
            logo.on('cancel', function(imageInput) {
                swal.fire({
                    title: 'Logo berhasil diubah !',
                    type: 'success',
                    buttonsStyling: false,
                    confirmButtonText: 'Ok!',
                    confirmButtonClass: 'btn btn-primary font-weight-bold'
                });
            });

            logo.on('change', function(imageInput) {
                swal.fire({
                    title: 'Logo berhasil diubah !',
                    type: 'success',
                    buttonsStyling: false,
                    confirmButtonText: 'Ok!',
                    confirmButtonClass: 'btn btn-primary font-weight-bold'
                });
            });

            logo.on('remove', function(imageInput) {
                swal.fire({
                    title: 'Logo berhasil dihapus !',
                    type: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Ok!',
                    confirmButtonClass: 'btn btn-primary font-weight-bold'
                });
            });
        <?php } ?>
    })
</script>