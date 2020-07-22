<script>
	var chart_goods = [];
	$(document).ready( function(){

		get_chart_goods_from_db();	
		get_po_list();
		get_goods_list();
			
		show_goods_to_chart();		
		

		$("#btn_save_receiving").click(function(){
			
			Swal.fire({
		        title: "Anda Yakin ingin menyimpan transaksi ini?",
		        text: "Data yg telah diproses tidak dapat diubah!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) { 
		        if (result.value) {
		            $("#form_receiving").submit();
		        }
		    });
		});
		
	});
	
</script>
<script>
	
	function get_po_list()
	{
		var supplier_id_temp= <?=isset($master[0]) ? $master[0]->partner_id : "";?>;
		
		var supplier_id 	= $("#supplier_id").val();
		var po_list_id  	= <?=isset($master[0]) ?  $master[0]->purchase_order_id : ""?>;

			$.get("<?=base_url()?>index.php/inventori/get_po_list/1",
				{"supplier_id":supplier_id})
			.done(function(data){
				
				var po_list = jQuery.parseJSON(data);
				var po_text = "";
				
				$("#po_no_list").html('<option value="">Pilih No PO</option>');

				if (po_list.length > 0) {

					$.each(po_list,function(id,val) {
						
						if (po_list_id == val.id) {
							po_text+="<option value='"+val.id+"' selected>"+val.purchase_order_no+"</option>";
						}else {
							po_text+="<option value='"+val.id+"'>"+val.purchase_order_no+"</option>";
						}
					});

					$("#po_no_list").append(po_text);
					$("#po_no_list").selectpicker('refresh');
					
				}else {

					Swal.fire("Info", "Data No PO tidak ditemukan!", "error");
					// jika no po tidak ditemukan
					// set supplier ke awal
					$("#supplier_id").val(supplier_id_temp);
					$("#supplier_id").selectpicker('refresh');
					
				}	
			});

			// jika supplier berbeda clear data di tabe
			if (supplier_id_temp) {
				if(supplier_id_temp!=supplier_id) {
					$("#receive_list").html('');
					chart_goods = [];
					$("#supplier_id_temp").val(supplier_id);
				}
			}else {
				$("#supplier_id_temp").val(supplier_id);
			}
		

		clear_goods_chart();
	}
	// function get_po_list()
	// {
	// 	var supplier_id_temp= <?=isset($master[0]) ? $master[0]->partner_id : "";?>;
		
	// 	var supplier_id 	= $("#supplier_id").val();
		
	// 		$.get("<?=base_url()?>index.php/inventori/get_po_list/1",
	// 			{"supplier_id":supplier_id})
	// 		.done(function(data){
				
	// 			var po_list = jQuery.parseJSON(data);
	// 			var po_text = ""; 
				
	// 			$("#po_no_list").html('<option value="">PO Kosong</option>');

	// 			if (po_list.length > 0) {

	// 				$("#po_no_list").html('<option value="">Pilih No PO</option>');

	// 				$.each(po_list,function(id,val) {
	// 					po_text+="<option value='"+val.id+"'>"+val.purchase_order_no+"</option>";
	// 				});

	// 				$("#po_no_list").append(po_text);
	// 				$("#po_no_list").selectpicker('refresh');
					
	// 			}else {

	// 				Swal.fire("Info", "Data No PO tidak ditemukan!", "error");
					
	// 			}

	// 			$("#po_no_list").selectpicker('refresh');
				
	// 		});

	// 		if (supplier_id_temp) {
	// 			if(supplier_id_temp!=supplier_id) {
	// 				$("#receive_list").html('');
	// 				chart_goods = [];
	// 				$("#supplier_id_temp").val(supplier_id);
	// 			}
	// 		}else {
	// 			$("#supplier_id_temp").val(supplier_id);
	// 		}
		
	// 	clear_goods_chart();
	// 	get_goods_per_supplier();
	// }

	function get_goods_list()
	{
		var po_id_temp  = '<?=isset($master) ?  $master[0]->purchase_order_id : "";?>';
		var po_id_change= $("#po_no_list").val();
		var po_id       = (po_id_change) && (po_id_change!= po_id_temp) ? po_id_change : po_id_temp;
		
		if (po_id!="") {
			$.get("<?=base_url()?>index.php/inventori/get_po_list/2",
				{"po_id":po_id})
			.done(function(data){

				var goods_list = jQuery.parseJSON(data);
				var goods_text = "";

				$("#goods_list").html('<option value="">Pilih Kode Barang</option>');

				if ( goods_list.length > 0) {

					$.each(goods_list, function(id, val) {
						goods_text+="<option value='"+val.goods_id+"'>"+val.sku_code+"</option>";
					});

					$("#goods_list").append(goods_text);

				}else {
					Swal.fire("Info", "Data Barang tidak ditemukan!", "error");
				}

				$("#goods_list").selectpicker('refresh');

			});
		}

		if (po_id_temp) {
			if( po_id_temp!=po_id) {
				$("#receive_list").html('');
				chart_goods = [];
				$("#po_id_temp").val(po_id);
			}
		}else {
			$("#po_id_temp").val(po_id);
		}


		clear_goods_chart();
			
	}

	function get_goods_detail()
	{
		var po_id    = $("#po_no_list").val();
		var goods_id = $("#goods_list").val();

		 
		$.get("<?=base_url()?>index.php/inventori/get_po_list/3",
				{"po_id":po_id,"goods_id":goods_id})
		.done( function (data) {
			
			var goods_detail = jQuery.parseJSON(data);
			$("#goods_code").val(goods_detail[0].sku_code);
			$("#goods_id").val(goods_detail[0].goods_id);
			$("#goods_name").val(goods_detail[0].goods_name);
			$("#goods_qty_sisa").val(goods_detail[0].sisa);
			$("#goods_price").val(goods_detail[0].goods_price);
			$("#goods_discount").val(goods_detail[0].goods_discount);

		});
	}


	function add_to_chart()
	{

		var po_detail_id    = $("#goods_list").val();
		var goods_code      = $("#goods_code").val();
		var goods_id        = $("#goods_id").val();	
		var goods_name      = $("#goods_name").val();
		var goods_qty_sisa  = parseInt( $("#goods_qty_sisa").val() );
		var goods_qty 	    = parseInt( $("#goods_qty").val() );
		var goods_price 	= parseInt( $("#goods_price").val() );
		var goods_discount  = parseInt( $("#goods_discount").val() );
		
		var save_input = {};

		save_input.po_detail_id 	= po_detail_id;
		save_input.goods_code 		= goods_code;
		save_input.goods_id 		= goods_id;
		save_input.goods_name 		= goods_name;
		save_input.goods_qty_sisa 	= goods_qty_sisa;
		save_input.goods_qty  		= goods_qty;
		save_input.goods_price  	= goods_price;
		save_input.goods_discount 	= goods_discount;

		// if (goods_qty > goods_qty_sisa)
		// {
		// 	show_alert("Gagal","Maaf jumlah Barang melebihi jumlah sisa!","error");
		// } else {
			// check same product
			var same = false;
			$.each(chart_goods,function(id,val){;
				if (val.goods_id == goods_id)
				{
					var goods_sum = val.goods_qty + goods_qty;

					// if ( goods_qty_sisa < goods_sum ) {

					// 	show_alert("Danger","Maaf Jumlah Receive lebih dari jumlah pesan!","error");

					// }else {
						val.goods_qty+=goods_qty;	
					// }
					same = true;
					
				}
			});

			if (!same){

				chart_goods.push(save_input);
			}
		// }
		
		clear_goods_chart();
		show_goods_to_chart();
		
	}

	function show_goods_to_chart()
	{
		$("#btn_save").prop('disabled',true);

		$("#receive_list").html('');
		var goods_chart = "";
		var grant_total = 0;
		if ( chart_goods.length > 0) {

			

			$.each(chart_goods, function(id, val){

				if (val.goods_discount) {
					total = (val.goods_qty * val.goods_price) - ( (val.goods_qty * val.goods_price) * val.goods_discount / 100);
				}else {
					total = (val.goods_qty * val.goods_price);
				}
				
				grant_total+=total;

				goods_chart+="<tr>";
				goods_chart+="<input type='hidden' name='po_detail_id[]' value='"+val.po_detail_id+"'>";
				goods_chart+="<input type='hidden' name='goods_id[]' value='"+val.goods_id+"'>";
				goods_chart+="<input type='hidden' name='goods_discount[]' value='"+val.goods_discount+"'>";
				goods_chart+="<input type='hidden' name='goods_price[]' value='"+val.goods_price+"'>";
				goods_chart+="<td>"+(id+1)+"</td>";
				goods_chart+="<td>"+val.goods_code+"</td>";
				goods_chart+="<td>"+val.goods_name+"</td>";
				goods_chart+="<td>"+numeral(val.goods_price).format('0,[.]00')+"</td>";
				goods_chart+="<td><input type='number' name='goods_qty[]' value='"+val.goods_qty+"' min='1' class='form-control' style='width:30%'></td>";
				goods_chart+="<td>"+val.goods_discount+"</td>";
				goods_chart+="<td>"+numeral(total).format('0,[.]00')+"</td>";
				goods_chart+="<td><button type='button' class='btn btn-light-danger' onclick='delete_goods_from_chart("+id+")'><span class='fa la-trash'></span></button></td>";
				goods_chart+="</tr>";
			});

			$("#receive_list").append(goods_chart);
			$("#grant_total").val(grant_total);
			$("#btn_save").prop('disabled',false);


		} else {
			$("#receive_list").html('<tr><td colspan="9" class="text-center">Data Kosong</td></tr>');
		}
	}

	function delete_goods_from_chart(id)
	{
		chart_goods.splice(id,1);
		show_goods_to_chart();
	}

	function clear_goods_chart()
	{
		$("#goods_list").val("");
		$("#goods_list").selectpicker('refresh');
		$("#goods_code").val('');
		$("#goods_id").val('');
		$("#goods_name").val('');
		$("#goods_discount").val(0);
		$("#goods_qty_order").val(0);
		$("#goods_qty").val(1);
		$("#goods_price").val('');	
		$("#goods_discount").val(0);
	}

	function get_chart_goods_from_db()
	{
		var json = <?=isset($master) ? json_encode($master) : "";?>;
		console.log(json);
		var data = (json!="") ? json : [];
		if (data.length > 0){
			$.each(data,function(id,val){
				var code = (val.sku_code) ? val.sku_code : 'Kosong';
				var save_input = {};
				save_input.po_detail_id 	= val.purchase_order_id;
				save_input.goods_id			= val.goods_id;
				save_input.goods_code 		= code;
				save_input.goods_name 		= val.goods_name;
				save_input.goods_price 		= parseInt(val.price);
				save_input.goods_qty_order 	= val.qty_order;
				save_input.goods_qty  		= parseInt(val.quantity);
				save_input.goods_discount 	= (val.discount) ? val.discount : 0;
				chart_goods.push(save_input);
				
			});
		}

		show_goods_to_chart();
	}


	function show_alert(type_msg='info',msg='',type_alert='error')
	{
		Swal.fire(type_msg, msg, type_alert);
	}

	function approve_receive(rv_id)
	{
		    Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "Data yg telah diproses tidak dapat diubah!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {

		        	 $.get("<?=base_url()?>index.php/inventori/approve_receive/",
		        	 	{"rv_id":rv_id})
		        	 .done(function(msg){

		        	 	if (msg) {
		        	 		Swal.fire(
				                "Tersimpan!",
				                "Penerimaan barang berhasil disetujui",
				                "success"
				            )
				            window.location.href = "<?=base_url()?>index.php/inventori/receiving";
		        	 	}
		        	 });
		            
		        }
		    });
	}

	function print_receive(rv_id)
	{
		Swal.fire({
		        title: "Anda yakin ingin mencetak transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {
		        	window.open("<?=base_url()?>index.php/inventori/print_receive/"+rv_id);
		        }
		    });
	}

	function get_goods_per_supplier()
	{
		var supplier_id = $("#supplier_id").val();

		$.get("<?=base_url()?>index.php/inventori/get_po_list/4",
				{"supplier_id":supplier_id})
			.done(function(data){
				
				var goods_list = jQuery.parseJSON(data);
				var goods_text = ""; 

				$("#goods_list").html('<option value="">Barang Kosong</option>');

				if ( goods_list.length > 0 ){
					
					$("#goods_list").html('<option value="">Pilih Kode Barang</option>');
					$.each(goods_list, function(id, val) {
						goods_text+="<option value='"+val.goods_id+"'>"+val.sku_code+"</option>";
					});
					
					$("#goods_list").append(goods_text);
					$("#goods_list").selectpicker('referesh');
				}
				$("#goods_list").selectpicker('refresh');



				


			});
	}


</script>