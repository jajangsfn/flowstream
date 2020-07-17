<script>
    $("form").submit(function(e) {
        e.preventDefault();
        if ($("#new_password").val() == $("#verify_password").val()) {
            $("form").unbind().submit();
        } else {
            Swal.fire("Error!", "Konfirmasi password tidak sesuai", "error");
        }
    })
</script>