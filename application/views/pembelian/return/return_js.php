<script>
	var chart_goods = [];
	$(document).ready( function() {

		get_data_from_db();
		$("#btn_save_return").click(function(){

			Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) { 

		        if (result.value) {

		        	if ( $("#no_ref").val() ) {
		        		$("#form_return").submit();   
		        	}else {
		        		Swal.fire("Info", "Silahkan isi nomor referensi!","error");
		        	}
		         	
		        }
		    });
		});


	});
</script>
<script>
	
	function search_receive_order() 
	{
		var supplier_id = $("#supplier_id").val();
		var receive_no = jQuery.trim($("#nro").val());		
		var text 	   = "";

		if (!supplier_id) {
			Swal.fire("Info","silahkan pilih supplier!","error");
		}else if (!receive_no) {
			Swal.fire("Info","silahkan isi nomor nota!","error");
		}else {
		
			$.get("<?=base_url()?>index.php/pembelian/get_receive_goods",
						{"receive_no":receive_no,"supplier_id":supplier_id})
				.done( function(data) {
 
					var parse = jQuery.parseJSON(data); 

					$("#warehouse_id").val('');

					if ( parse.length > 0 ) {
						// set arehouse_id
						$("#warehouse_id").val( parse[0].warehouse_id);
						$("#goods_list").html('<option value="">Pilih Barang</option>');

						$.each( parse, function(id, val) {
							text+="<option value='"+val.goods_id+"'>"+val.sku_code+"</option>";
						});

						$("#goods_list").append(text);
						$("#goods_list").selectpicker('refresh');
					}else {
						$("#goods_list").html('<option value="">Barang tidak ditemukan</option>');
						$("#goods_list").selectpicker('refresh');
						Swal.fire("Info", "Data tidak ditemukan!", "error");
					}
			});
		}

	}

	function get_goods_detail()
	{
		var receive_no    = $("#nro").val();
		var goods_id      = $("#goods_list").val();
		 
		$.get("<?=base_url()?>index.php/inventori/get_ws_goods_detail",
				{"receive_no":receive_no,"goods_id":goods_id})
		.done( function (data) {
			
			var goods_detail = jQuery.parseJSON(data);			

			$("#kode_barang").val(goods_detail[0].sku_code);
			$("#id_barang").val(goods_detail[0].goods_id);
			$("#nama_barang").val(goods_detail[0].goods_name);
			$("#quantity").val(goods_detail[0].receive_qty);
			$("#qty_receive").val(goods_detail[0].receive_qty);
			$("#harga_barang").val(goods_detail[0].price);

		});
	}

	function add_to_chart()
	{
		var goods_id = $("#id_barang").val();
		var goods_name = $("#nama_barang").val();
		var goods_code = $("#kode_barang").val();
		var goods_price = parseInt( $("#harga_barang").val() );
		var goods_qty  = parseInt( $("#quantity").val() );
		var goods_qty_receive  = parseInt( $("#qty_receive").val() );
		var goods_warehouse_id = $("#warehouse_id").val();
		var goods_warehouse_name= $("#warehouse_id option:selected").text();
		// console.log(goods_warehouse_id.split('_'));
		// alert(goods_warehouse_name);
		if ( goods_id ) {
			var save_goods = {};
			save_goods.id = goods_id;
			save_goods.code = goods_code;
			save_goods.name = goods_name;
			save_goods.price= goods_price;
			save_goods.qty  = goods_qty;
			save_goods.qty_receive = goods_qty_receive;
			save_goods.discount  = 0;
			save_goods.ws_id = goods_warehouse_id;
			save_goods.ws_name= goods_warehouse_name;

			if ( goods_qty > goods_qty_receive)
			{
				Swal.fire("Info", "Jumlah retur melebihi jumlah penerimaan!", "error");			
			} else {

				var same = false;
				console.log(save_goods);
				$.each(chart_goods,function(id,val){
					if (val.id == goods_id)
					{
						var goods_sum = (val.qty + goods_qty);
						if ( goods_sum > val.qty_receive  ) {
							Swal.fire("Info", "Jumlah retur melebihi jumlah penerimaan!", "error");
						}else {
							val.qty+=goods_qty;
							val.ws_id = goods_warehouse_id;
							val.ws_name = goods_warehouse_name;
						}


						same = true;
						
					}
				});

				if (!same){
					chart_goods.push(save_goods);
				}

			}
			
			show_chart_goods();
			set_zero_qty();
			clear_goods_chart();
		}else {
			Swal.fire("Info", "Silahkan pilih barang!", "error");
		}

	}


	function show_chart_goods()
	{
		var rows = "";
		var total = 0;
		grant_total = 0;

		$("#goods_return_table").html('');

		if (chart_goods.length > 0 ){

			$.each(chart_goods,function(id,val){
				
				total = (val.price * val.qty);
				grant_total+=total;
				total = total > 0 ?  (total/1000).toFixed(3)  : 0;
				rows+="<tr id='"+id+"'>";
				rows+="<td>"+(id+1)+"</td>";
				rows+="<td class='goods_code_chart'>";
				rows+="<input type='hidden' name='goods_id_chart[]' id='goods_id_chart_"+id+"' value='"+val.id+"'>";
				rows+="<input type='hidden' name='goods_qty_receive_chart[]' id='goods_qty_receive_chart_"+id+"' value='"+val.qty_receive+"'>";
				rows+="<input type='hidden' name='goods_code_chart[]' id='goods_code_chart' value='"+val.code+"'>"+val.code+"</td>";
				
				rows+= "<td>"+val.name+"'</td>";
				rows+="<td><input type='hidden' name='goods_ws_id_chart[]' id='goods_ws_id_chart_"+id+"' value='"+val.ws_id+"'>"+val.ws_name+"</td>";
				rows+="<td class='goods_price_chart'>";
				rows+="<input type='hidden' name='goods_price_chart[]' class='form-control w-50' id='goods_price_chart_"+id+"' value='"+val.price+"'>"+val.price+"</td>";
				rows+="<td><input type='number' name='goods_qty_chart[]' class='form-control' id='goods_qty_chart_"+id+"' value='"+val.qty+"' onchange='sum_total_goods("+id+")'></td>";
				rows+="<td class='text-right'>"+total+"</td>";
				rows+="<td><button type='button' class='btn btn-xs btn-danger' onclick='delete_goods_from_chart("+id+")'><span class='fa fa-trash'></span></button></td>";
				rows+="</tr>";	
			});

			$("#btn_save_return").prop('disabled',false);
		}else {
			rows+="<tr><td colspan='9' class='text-center'>Data Kosong</td></tr>";
			$("#btn_save_return").prop('disabled',true);
		}

		$("#goods_return_table").append(rows);
		
	}

	function sum_total_goods(id)
	{
		
		$("tr#"+id).each(function(){
			var new_input = {};

			var goods_id_chart 				= $(this).find('td #goods_id_chart_'+id).val();
			var goods_qty_chart 			= ($(this).find('td #goods_qty_chart_'+id).val() ) ? 
											  parseInt( $(this).find('td #goods_qty_chart_'+id).val() ) : 0;

			var goods_qty_receive_chart 	= ($(this).find('td #goods_qty_receive_chart_'+id).val() ) ? 
											  parseInt( $(this).find('td #goods_qty_receive_chart_'+id).val() ) : 0;
			var goods_price_chart 			= ($(this).find('td #goods_price_chart_'+id).val()) ? 
											  parseInt( $(this).find('td #goods_price_chart_'+id).val() ) : 0;

           // check if qty more then qty receive
           if (goods_qty_chart > goods_qty_receive_chart)
           {
           	// change border to red
           	 // $(this).find('#goods_qty_chart_'+id).css({"border-color": "#C1E0FF", 
             // "border-width":"1px", 
             // "border-style":"solid"});

           	 Swal.fire("Info", "Jumlah retur melebihi jumlah penerimaan!", "error");
           	  new_input.id = goods_id_chart;
			  new_input.qty = goods_qty_receive_chart;
			  new_input.qty_receive = goods_qty_receive_chart;
			  new_input.price = goods_price_chart;
           }else {
           		// set new value to chart_goods array
				new_input.id = goods_id_chart;
				new_input.qty = goods_qty_chart;
				new_input.qty_receive = goods_qty_receive_chart;
				new_input.price = goods_price_chart;

           }

			set_new_value(id,new_input);

		});
		
		// loop all goods 
		show_chart_goods();
	}


	function set_new_value(id,new_input)
	{
		$.each(chart_goods,function(idx,val){
			if (idx == id)
			{
				val.id 			= new_input.id;
				val.qty 		= new_input.qty;
				val.qty_receive  = new_input.qty_receive;
				val.price 		= new_input.price;
			}
		});
	}

	function set_zero_qty()
	{
		$("#goods_qty").val(1);
	}

	function delete_goods_from_chart(id)
	{		
		Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) { 

		        if (result.value) {

		        	chart_goods.splice(id,1);
					show_chart_goods();
		        }
		    });
	}

	function clear_goods_chart()
	{
		$("#goods_list").val("");
		$("#goods_list").selectpicker('refresh');

		$("#kode_barang").val('');
		$("#id_barang").val('');
		$("#nama_barang").val('');
		$("#qty_receive").val(0);
		$("#quantity").val(1);
		$("#harga_barang").val('');	
		$("#warehouse_id").val('1');
		$("#warehouse_id").selectpicker('refresh');
		// $("#goods_discount").val(0);
	}

	function approve_return(return_id)
	{
		    Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "Data yg telah diproses tidak dapat diubah!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {

		        	 $.get("<?=base_url()?>index.php/pembelian/approve_return/",
		        	 	{"return_id":return_id})
		        	 .done(function(msg){
		        	 	// console.log(msg);
		        	 	if (msg) {
		        	 		Swal.fire(
				                "Tersimpan!",
				                "Transaksi berhasil disetujui",
				                "success"
				            )
				            window.location.href = "<?=base_url()?>index.php/pembelian/return";
		        	 	}
		        	 });
		            
		        }
		    });
	}

	function print_return(return_id)
	{
		Swal.fire({
		        title: "Anda yakin ingin mencetak transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {
		        	window.open("<?=base_url()?>index.php/pembelian/print_return/"+return_id);
		        }
		    });
	}


	function get_data_from_db()
	{
		var data = '<?=isset($master) ? json_encode($master) : ''?>';
		var parse = (data) ? jQuery.parseJSON(data) : [];
		

		var same = false;
		if (parse.length > 0) {
			if (chart_goods) {

				$.each(parse, function(id, val) {

					var save_goods = {};
					save_goods.id = val.goods_id;
					save_goods.code = val.sku_code;
					save_goods.name = val.goods_name;
					save_goods.price= val.price;
					save_goods.qty  = parseInt(val.quantity);
					save_goods.qty_receive = val.qty_receive;
					save_goods.ws_id   = val.warehouse_id;
					save_goods.ws_name = val.warehouse_name;
					chart_goods.push(save_goods);
				});

				show_chart_goods();
				
			}
		}

	}
</script>