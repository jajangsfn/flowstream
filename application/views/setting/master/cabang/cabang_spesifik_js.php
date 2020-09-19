<script>
    function edit(
        id,
        logo,
        name,
        code,
        owner,
        address,
        npwp,
        tax_status,
    ) {
        $("#id_edit").val(id);
        $("#logo_placement_edit").removeAttr("style");
        $("#logo_placement_edit").attr("style", `background-image: url(<?= base_url("attachment/") ?>${logo})`);
        $("#code_edit").val(code);
        $("#name_edit").val(name);
        $("#owner_edit").val(owner);
        $("#address_edit").val(address);
        $("#npwp_edit").val(npwp);
        $("#tax_edit").val(tax_status);

        $(".select2").trigger("change");
        $("#edit_modal").modal("show");
    }

    var logo = new KTImageInput("logo_edit");
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

    function change_type_price() {
        $("#change_type_price").modal('show');
    }
</script>