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
        employee_id,
        phone,
    ) {
        $("#id_edit").val(id);
        $("#employee_id_edit").val(employee_id);
        $("#phone_edit").val(phone);

        $(".select2").trigger("change");
        $("#edit_salesman").modal('show');
    }

    function delete_trigger(id) {
        $("#id_delete").val(id);

        $("#delete_modal").modal('show');
    }
</script>