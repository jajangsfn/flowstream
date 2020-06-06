<script>
    $(document).ready(() => {
        $("#master_barang_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers'
        })

        $('.select2').select2({
            width: 'resolve'
        });
    })
</script>
<?php if ($this->session->flashdata("error")) { ?>
    <script>
        Swal.fire("Error!", "<?= $this->session->flashdata("error") ?>", "error");
    </script>
<?php } ?>