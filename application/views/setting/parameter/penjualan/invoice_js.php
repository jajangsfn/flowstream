<script>
function get_invoice_format() {
    $.ajax({
        url: "<?=base_url()?>index.php/setting/get_invoice_format",
        type:"get",
        datatype:"json",
        success: function(data){
            
            var parse = JSON.parse(data);
            $("#btn_submit").html('Simpan');
            if (parse.length > 0) {
                $("#id").val(parse[0].id);

                if (parse[0].flag == 1) {
                    $("#enabled").prop("checked", true);
                }else {
                    $("#enabled").prop("checked", false);
                }

                $("#invoice_code").val(parse[0].invoice_code);
                
                $("#btn_submit").html('Update');
            }
            
            $("#invoice_format_modal").modal('show');
            enable_disable();
        }
    });
}

function enable_disable() {
    if ($("#enabled").prop("checked") == true) {
        $("#invoice_code").prop("disabled", false);
    }else {
        $("#invoice_code").prop("disabled", true);
    }
}

function save_invoice_format() {

    if ($("#enabled").prop("checked") == true) {

        if ($("#invoice_code").val() == "") {
  
            Swal.fire(
				        "Gagal!",
				        "Silahkan isi Kode Faktur!",
				        "error"
				    );
            return;
        }   
    }

    $("#invoice_form").submit();
}
</script>