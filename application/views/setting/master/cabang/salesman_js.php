<script>
    $(document).ready(() => {
        $("#salesman_table").DataTable({
            responsive: true,
            ordering: false,
            paging_type: 'full_numbers'
        })

        $('.select2').select2({
            width: '100%'
        });
    })

    function edit(
        id,
        name,
        phone,
    ) {
        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#phone_edit").val(phone);

        $("#edit_salesman").modal('show');
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal('show');
    }
</script>