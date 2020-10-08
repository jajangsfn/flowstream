<script>
$(function() {

    $("#btn_confirm_delivery").click(function() {
                
        if ($("#good_list tr").length <=0) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi nama produk!",
				    "error"
				    );	
                    return;
        }else if (!$("#employee_id").val()) {
            Swal.fire(
				    "Error!",
				    "Silahkan pilih pengirim",
				    "error"
				    );	
                    return;
            
        }else if (!$("#car_number").val()) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi no plat mobil",
				    "error"
				    );	
                    return;
            
        }else{
            $("#form_delivery").submit();
        }
    })
})

function get_po_no_detail() {
    po_no = $("#po_no_list").val();
    
    $.ajax({
        url : "<?=base_url()?>index.php/pengiriman/get_po_no",
        type:"post",
        data: "po_no="+po_no,
        datatype:"json",
        success:function(msg) {
            parse = JSON.parse(msg);
            $("#good_list").html('');
            if (parse.length > 0) {
                $("#customer_name").val(parse[0].name);
                $("#customer_address").val(parse[0].address);

                show_good_list(parse);
            }
        }
    });
}

function show_good_list(data) {

    $.each(data, function(id,val) {
        $("#good_list").append("<tr id='id_"+id+"'>"
                               +"<td>"+(id+1)+"</td>"    
                                +"<td>"+(val.plu_code)+"</td>"
                                +"<td>"+(val.brand_description)+"</td>"    
                                +"<input type='hidden' name='good_id[]' value='"+val.goods_id_pos+"'/>"
                                +"<td><input type='number' name='qty[]' value='"+(val.sisa)+"' min='1' max='"+(val.sisa)+"' class='form-control' required/></td>"
                                +"<td><button type='button' class='btn btn-xs btn-danger' onclick='delete_good("+id+")'><span class='fa fa-trash'></span></button></td>"
                            +"</tr>");    
    });
}

function delete_good(id){
    $("#id_"+id).remove();
}

function update_delivery(id) {
    $("#delivery_detail").modal('show');
}

</script>