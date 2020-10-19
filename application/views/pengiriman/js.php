<script>
$(function() {
    arr_pegawai = [];
    arr_biaya   = [];

    $("#btn_confirm_delivery").click(function() {
                
        if ($("#good_list tr").length <=0) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi nama produk!",
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
            
        }else if ($("#table_pegawai tr").length <=0) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi data pegawai",
				    "error"
				    );	
                    return;
        }else if ($("#table_biaya tr").length <=0) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi data biaya",
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
            console.log(parse);
            
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
                                +"<td><input type='hidden' name='pos_id[]' value='"+val.id+"'/>"
                                +"<input type='hidden' name='invoice_no[]' value='"+val.invoice_no+"'/>"+val.invoice_no+"</td>"
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

function get_delivery_detail(id) {
    $.ajax({
        url : "<?=base_url()?>index.php/pengiriman/get_delivery_detail",
        type:"post",
        data: "id="+id,
        datatype:"json",
        success:function(msg) {
            parse = JSON.parse(msg);
            $("#id").val(id);
            $("#delivery_no").html(parse.detail[0].delivery_no);
            $("#delivery_date").html(parse.detail[0].delivery_date);
            $("#invoice_no").html(parse.detail[0].invoice_no);
            $("#employee_name").html(parse.detail[0].employee_name);
            $("#partner_name").html(parse.detail[0].name);
            $("#car_number").html(parse.detail[0].car_number);
            $("#address_partner").html(parse.detail[0].address_partner);
            $("#charge").html("Rp. "+numeral(parse.detail[0].charge).format('0,0'));

            //data barang
            $("#data_barang").html('');
            var temp_barang = "";
            var idx = 1;
            $.each(parse.goods, function(id, data) {
                temp_barang+="<tr>";
                temp_barang+="<td>"+(idx)+"</td>";
                temp_barang+="<td>"+data.invoice_no+"</td>";
                temp_barang+="<td>"+data.plu_code+"</td>";
                temp_barang+="<td>"+data.brand_description+"</td>";
                temp_barang+="<td>"+numeral(data.qty).format('0,0')+"</td>";
                temp_barang+="</tr>";
                idx++;
            });
            $("#data_barang").append(temp_barang);



            //data pegawai
            $("#data_pegawai").html('');
            var temp_pegawai = "";
            var idx = 1;
            $.each(parse.pegawai, function(id, data) {
                temp_pegawai+="<tr>";
                temp_pegawai+="<td>"+(idx)+"</td>";
                temp_pegawai+="<td>"+data.employee_name+"</td>";
                temp_pegawai+="<td>"+data.job_description+"</td>";
                temp_pegawai+="</tr>";
                idx++;
            });
            $("#data_pegawai").append(temp_pegawai);

            //data biaya
            $("#data_biaya").html('');
            var temp_biaya = "";
            var temp_arr_biaya = [];
            $.each(parse.biaya, function(id, data) {
                var temp = {};
                temp.id = data.description;
                temp.description = data.description;
                temp.charge = data.charge;

                if (temp_arr_biaya.length > 0) {
                    $.each(temp_arr_biaya, function(idx, row) {
                        if (temp.description != row.description) 
                        {
                            temp_arr_biaya.push(temp);
                        }
                    });
                }else {
                    temp_arr_biaya.push(temp);
                }
            });
            var idx = 1;
            $.each(temp_arr_biaya, function(id,row){
                temp_biaya+="<tr>";
                temp_biaya+="<td>"+(idx)+"</td>";
                temp_biaya+="<td>"+row.description+"</td>";
                temp_biaya+="<td> Rp. "+numeral(row.charge).format('0,0')+"</td>";
                temp_biaya+="</tr>";
                idx++;
            });
            
            $("#data_biaya").append(temp_biaya);
        }
    });
    $("#delivery_detail").modal('show');
}


function update_delivery_status() {
    delivery_status= $("#status").val();
    receive_date   = $("#receive_date").val();
    receive_name   = $("#receive_name").val();
    notes          = $("#notes").val();


    if ( delivery_status == 1) {
        if ( !receive_date ) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi tanggal terima",
				    "error"
				    );	
                    return;
        }

        if ( !receive_name ) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi penerima",
				    "error"
				    );	
                    return;
        }

        if ( receive_date && receive_name ) {
            $("#delivery_status_form").submit();
        } 

    }else if ( delivery_status == 2 ) {
        if ( !notes ) {
            Swal.fire(
				    "Error!",
				    "Silahkan isi catatan pengiriman",
				    "error"
				    );	
                    return;
        }else {
            $("#delivery_status_form").submit();
        }
    } else {
        Swal.fire(
				    "Error!",
				    "Silahkan pilih status pengiriman",
				    "error"
				    );	
                    return;
    }
}



function add_pegawai() {
    var pegawai      = $("#pegawai").val();
    var tugas        = $("#tugas").val();
    var temp_pegawai = {};

    if (!pegawai) {
        Swal.fire(
				    "Error!",
				    "Silahkan pilih nama pegawai",
				    "error"
				    );	
    }

    if (!tugas) {
        Swal.fire(
				    "Error!",
				    "Silahkan isi tugas",
				    "error"
				    );	
    }

    if (pegawai && tugas) {

        var pegawai_id   = pegawai.split('_')[0];
        var pegawai_nama = pegawai.split('_')[1];

        temp_pegawai.id   = pegawai_id;
        temp_pegawai.nama = pegawai_nama;
        temp_pegawai.tugas= tugas;
        arr_pegawai.push(temp_pegawai);
        show_pegawai();
        clear_pegawai();
        $("#modalPegawai").modal('hide');
    }

}

function clear_pegawai() {
    $("#pegawai").val(0);
    $("#pegawai").select2();
    $("#tugas").val('');

}

function show_pegawai() {
    var table = $("#table_pegawai");
    var temp_table = "";
    if (arr_pegawai) {
        $(table).html('');
        $.each(arr_pegawai,function(id,data) {
            temp_table+="<tr id='pegawai_id_'"+id+">";
            temp_table+="<td>"+(id+1)+"</td>";
            temp_table+="<td><input type='hidden' name='id_pegawai[]' value='"+data.id+"'/>";
            temp_table+="<input type='hidden' name='nama_pegawai[]' value='"+data.nama+"'/>"+data.nama+"</td>";        
            temp_table+="<td><input type='text' class='form-control' name='tugas_pegawai[]' value='"+data.tugas+"'/></td>";
            temp_table+="<td><button type='button' class='btn btn-danger btn-sm' onclick='delete_pegawai("+id+")'><span class='fas fa-trash'></span></button></td>";
            temp_table+="</tr>";
        });
    }

    $(table).append(temp_table);
}

function delete_pegawai(id) {
    $("#pegawai_id_"+id).remove();
}


function add_biaya() {
    var biaya        = $("#biaya").val();
    var jumlah       = $("#jumlah").val();
    var temp_biaya = {};

    if (!biaya) {
        Swal.fire(
				    "Error!",
				    "Silahkan isi nama biaya",
				    "error"
				    );	
    }

    if (!jumlah) {
        Swal.fire(
				    "Error!",
				    "Silahkan isi nominal jumlah biaya",
				    "error"
				    );	
    }

    if (biaya && jumlah) {

        temp_biaya.biaya  = biaya;
        temp_biaya.jumlah = jumlah;
        arr_biaya.push(temp_biaya);

        show_biaya();
        clear_biaya();
        $("#modalBiaya").modal('hide');
    }

}

function clear_biaya() {
    $("#biaya").val('');
    $("#jumlah").val('');
}

function show_biaya() {
    var table = $("#table_biaya").html('');
    var temp_table = "";
    if (arr_biaya) {
        $.each(arr_biaya,function(id,data) {
            temp_table+="<tr id='biaya_id_'"+id+">";
            temp_table+="<td>"+(id+1)+"</td>";
            temp_table+="<td><input type='text' name='biaya[]' class='form-control' value='"+data.biaya+"'/></td>";
            temp_table+="<td><input type='number' name='jumlah[]' class='form-control' value='"+data.jumlah+"'/></td>";        
            temp_table+="<td><button type='button' class='btn btn-danger btn-sm' onclick='delete_biaya("+id+")'><span class='fas fa-trash'></span></button></td>";
            temp_table+="</tr>";
        });
    }

    $(table).append(temp_table);
}

function delete_biaya(id) {

    $("#biaya_id_"+id).remove();
}

</script>