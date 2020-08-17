<script>
	var chart_goods = []; 
	$(document).ready( function() {

		get_data_from_db();
		get_all_goods_supplier();
		$("#btn_save_return").click(function(){

			Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) { 

		        if (result.value) {

		        	if ( !$("#supplier_id").val() ) {
		        		Swal.fire("Info", "Silahkan pilih supplier!","error");
		        		
		        	}else if (!$("#nro").val() && !$("#no_ref").val() ) {
		        		Swal.fire("Info", "Silahkan isi nomor referensi!","error");
		        	}else if ($("#nro").val() || $("#no_ref").val() ){
		        		$("#form_return").submit();   
		        	}
		         	
		        }
		    });
		});

		$("#goods_id_bar").keyup(function(){
			var goods = this.value;
			var id_supplier = $("#supplier_id").val();
			var goods_list = "";
			// clear goods 
			$("#goods_list_bar").html('');


			if(id_supplier){ 

				$.get("<?=base_url()?>index.php/pembelian/get_goods_json/",
					{"goods":goods,"id_supplier":id_supplier})
				.done(function(data){
					const goods_arr = JSON.parse(data);
					
					
					$.each(goods_arr,function(id,val){
						goods_list+='<li class="navi-item nav-click" onclick="show_goods_detail('+val.id+')">';
				        goods_list+='<span class="navi-link">';
				        goods_list+='<div class="navi-text">';
				        goods_list+='<span class="nav-val d-none">'+val.id+'</span>';
				        goods_list+='<span class="d-block font-weight-bold">'+val.brand_description+'</span>';
				        goods_list+='<span class="text-muted">'+val.sku_code+'</span>';
				        goods_list+='</div>';
				        goods_list+='<span class="navi-arrow fa-2x"></span>';
				        goods_list+='</span></li>';
					});

					$("#goods_list_bar").html(goods_list);
				});
			}
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
					// reset all goods
					chart_goods = [];
					if ( parse.length > 0 ) {
						
						$.each( parse, function(id, val) {
							var save_goods = {};
							save_goods.id = val.goods_id;
							save_goods.code = val.barcode;
							save_goods.name = val.goods_name;
							save_goods.price= parseInt(val.price);
							save_goods.qty  = parseInt(val.quantity);
							save_goods.qty_receive = parseInt(val.qty_receive);
							save_goods.discount  = 0;
							save_goods.ws_id = 1;
							save_goods.ws_name= 'Receiving';

							if (chart_goods.length > 0) {
								var same = false;
								$.each(chart_goods,function(id,val){
									if (val.id == save_goods.id && val.ws_id == save_goods.ws_id)
									{				
										val.qty+=save_goods.qty;
										val.ws_id = save_goods.ws_id;
										val.ws_name = save_goods.ws_name;
										same = true;
										
									}
								});
									if (!same){
										chart_goods.push(save_goods);
									}
							}else {
								chart_goods.push(save_goods);
							}

						});
						show_chart_goods();
						clear_goods_chart();

					}else {
						Swal.fire("Info", "Data tidak ditemukan!", "error");
					}
			});
		}

	}

	function get_goods_detail()
	{
		
		var supplier_id = $("#supplier_id").val();
		var goods_id      = $("#goods_list").val();

		$.get("<?=base_url()?>index.php/pembelian/get_goods_json/4",
				{"id_supplier":supplier_id,"goods_id":goods_id})
		.done( function (data) {
			
			var goods_detail = jQuery.parseJSON(data);	

			$("#kode_barang").val(goods_detail[0].barcode);
			$("#id_barang").val(goods_detail[0].id);
			$("#nama_barang").val(goods_detail[0].brand_description);
			$("#quantity").val(1);
			$("#qty_receive").val(0);
			$("#harga_barang").val(goods_detail[0].hpp);

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

			var same = false;
			
			$.each(chart_goods,function(id,val){
				if (val.id == goods_id && val.ws_id == goods_warehouse_id)
				{				
					val.qty+=goods_qty;
					val.ws_id = goods_warehouse_id;
					val.ws_name = goods_warehouse_name;
					same = true;
					
				}
			});
				if (!same){
					chart_goods.push(save_goods);
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
				total = total > 0 ?  numeral(total).format('0,0[.]00')  : 0;
				price = numeral(val.price).format('0,0[.]00');
				rows+="<tr id='"+id+"'>";
				rows+="<td>"+(id+1)+"</td>";
				rows+="<td class='goods_code_chart'>";
				rows+="<input type='hidden' name='goods_id_chart[]' id='goods_id_chart_"+id+"' value='"+val.id+"'>";
				rows+="<input type='hidden' name='goods_qty_receive_chart[]' id='goods_qty_receive_chart_"+id+"' value='"+val.qty_receive+"'>";
				rows+="<input type='hidden' name='goods_code_chart[]' id='goods_code_chart' value='"+val.code+"'>"+val.code+"</td>";
				
				rows+= "<td>"+val.name+"'</td>";
				rows+="<td><input type='hidden' name='goods_ws_id_chart[]' id='goods_ws_id_chart_"+id+"' value='"+val.ws_id+"'>"+val.ws_name+"</td>";
				rows+="<td class='goods_price_chart'>";
				rows+="<input type='number' name='goods_price_chart[]' class='form-control' id='goods_price_chart_"+id+"' value='"+val.price+"' min='0' style='width:50%' onchange='sum_total_goods("+id+")'></td>";
				rows+="<td><input type='number' name='goods_qty_chart[]' class='form-control' id='goods_qty_chart_"+id+"' value='"+val.qty+"' min='0' style='width:50%' onchange='sum_total_goods("+id+")'></td>";
				rows+="<td class='text-right'>"+total+"</td>";
				rows+="<td><button type='button' class='btn btn-xs btn-danger' onclick='delete_goods_from_chart("+id+")'><span class='fa fa-trash'></span></button></td>";
				rows+="</tr>";	
			});

			$("#grant_total").html( numeral(grant_total).format('0,0[.]00'))
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

           		// set new value to chart_goods array
				new_input.id = goods_id_chart;
				new_input.qty = goods_qty_chart;
				new_input.qty_receive = goods_qty_receive_chart;
				new_input.price = goods_price_chart;


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


	function get_all_goods_supplier()
	{

		var supplier_id = $("#supplier_id").val();

		$.get("<?=base_url()?>index.php/pembelian/get_goods_json/3",
				{"id_supplier": supplier_id}) 
		.done(function( result){

			var parse = jQuery.parseJSON(result);
			var goods_list = "";
			if (parse.length > 0) {
				
				$("#goods_list").html('<option value="">Pilih Kode Barang</option>');
				
				$.each(parse, function(id, val) {
					
						goods_list+='<li class="navi-item nav-click" onclick="show_goods_detail('+val.id+')">';
				        goods_list+='<span class="navi-link">';
				        goods_list+='<div class="navi-text">';
				        goods_list+='<span class="nav-val d-none">'+val.id+'</span>';
				        goods_list+='<span class="d-block font-weight-bold">'+val.brand_description+'</span>';
				        goods_list+='<span class="text-muted">'+val.sku_code+'</span>';
				        goods_list+='</div>';
				        goods_list+='<span class="navi-arrow fa-2x"></span>';
				        goods_list+='</span></li>';
				});

				$("#goods_list_bar").append(goods_list);
			}
				$("#goods_list_bar").selectpicker('refresh');
			

			
		});

	 	get_all_po();
	}

	function get_all_po()
	{
		var supplier_id = $("#supplier_id").val();
		var receiving_no = "<?=isset($master) ? $master[0]->reference_no : ''?>";
		$.get("<?=base_url()?>index.php/pembelian/get_all_po",
				{"supplier_id": supplier_id})
		.done(function( result){

			var parse = jQuery.parseJSON(result);console.log(parse);
			var po = "";
			$("#nro").html('<option value="">Data No PO Kosong</option>');
			if (parse.length > 0) {

				$("#nro").html('<option value="">Pilih No PO</option>');

				$.each(parse, function(id, val) {
					// mencegah null
					if (val.receiving_no) {
						if ( receiving_no  && receiving_no == val.receiving_no){
							po+="<option value='"+val.receiving_no+"' selected>"+val.receiving_no+"</option>";
						}else {
							po+="<option value='"+val.receiving_no+"'>"+val.receiving_no+"</option>";	
						}
						
					}
				});
			}

			$("#nro").append(po);
			$("#nro").selectpicker('refresh');
		});	
	}

	function show_goods_detail(id_brg)
	{		

		$.get("<?=base_url()?>index.php/pembelian/get_goods_json/2",
			{"id_goods":id_brg})
		.done(function(data){
			const goods_arr = JSON.parse(data);
 
			$.each(goods_arr,function(id,val){
				var code = (val.sku_code) ? val.sku_code : 'Kosong';
				$("#id_barang_bar").val(val.id);
				$("#kode_barang_bar").html(code);
				$("#nama_barang_bar").html(val.brand_description);
				$("#harga_barang_bar").html(val.hpp);
			});
		});
		// show modal
		$("#tambahBrgKeChart").modal('show');
	}


	function add_to_chart_bar()
	{
		var goods_id = $("#id_barang_bar").val();
		var goods_name = $("#nama_barang_bar").html();
		var goods_code = $("#kode_barang_bar").html();
		var goods_price = parseInt( $("#harga_barang_bar").html() );
		var goods_qty  = parseInt( $("#quantity_bar").val() );
		var goods_qty_receive  = parseInt( $("#quantity_bar").val() );
		var goods_warehouse_id = 1;
		var goods_warehouse_name= "Receiving";
		
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

			var same = false;
			
			$.each(chart_goods,function(id,val){
				if (val.id == goods_id && val.ws_id == goods_warehouse_id)
				{				
					val.qty+=goods_qty;
					val.ws_id = goods_warehouse_id;
					val.ws_name = goods_warehouse_name;
					same = true;
					
				}
			});
				if (!same){
					chart_goods.push(save_goods);
				}

			show_chart_goods();
			$("#tambahBrgKeChart").modal('hide');
		}else {
			Swal.fire("Info", "Silahkan pilih barang!", "error");
		}
	}
</script>