<script>
    $(document).ready(function() {
        $(".rupiah").each(function() {
            $(this).text(
                numeral($(this).text()).format('0,[.]00')
            );
        })
    })
</script>
