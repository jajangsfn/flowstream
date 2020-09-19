<script>
	var chart_goods = [];
	$(document).ready( function(){
		
		$("#btn_confirm_receiving").click(function() {
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
		var supplier_id_temp= $("#supplier_id_temp").val();
		
		var supplier_id 	= $("#supplier_id").val();
		
			$.get("<?=base_url()?>index.php/inventori/get_po_list/1",
				{"supplier_id":supplier_id})
			.done(function(data){
				 
				var po_list = jQuery.parseJSON(data);
				var po_text = ""; 
				
				$("#po_no_list").html('<option value="">PO Kosong</option>');

				if (po_list.length > 0) {

					$("#po_no_list").html('<option value="">Pilih No PO</option>');

					$.each(po_list,function(id,val) {
						po_text+="<option value='"+val.id+"'>"+val.purchase_order_no+"</option>";
					});

					$("#po_no_list").append(po_text);
					$("#po_no_list").selectpicker('refresh');
					
				}else {

					Swal.fire("Info", "Data No PO tidak ditemukan!", "error");
					
				}

				$("#po_no_list").selectpicker('refresh');
				
			});

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
		// get_goods_per_supplier();
	}

	function get_goods_list()
	{
		
		var po_id       = $("#po_no_list").val();
			
			$.get("<?=base_url()?>index.php/inventori/get_po_list/2",
				{"po_id":po_id})
			.done(function(data){

				var goods_list = jQuery.parseJSON(data);
				var goods_text = "";

				$("#goods_list").html('<option value="">Barang Kosong</option>');

				if ( goods_list.length > 0) {
						
					$("#goods_list").html('<option value="">Pilih Kode Barang</option>');
					$.each(goods_list, function(id, val) {
						var save_input = {};

						save_input.po_detail_id 	= po_id;
						save_input.goods_code 		= val.barcode;
						save_input.goods_id 		= val.goods_id;
						save_input.goods_name 		= val.goods_name;
						save_input.goods_qty_sisa 	= parseInt(val.sisa);
						save_input.goods_qty  		= parseInt(val.sisa);
						save_input.goods_price  	= val.goods_price;
						save_input.goods_discount 	= val.goods_discount;
						chart_goods.push(save_input);


						// add to kode barang
						goods_text+="<option value='"+val.goods_id+"'>"+val.barcode+"</option>";
					});
					// add barang ke dropdown
					$("#goods_list").append(goods_text);
					$("#goods_list").selectpicker('refresh');
					// loop goods
					show_goods_to_chart();

				}else {
					Swal.fire("Info", "Data Barang tidak ditemukan!", "error");
					$("#goods_list").selectpicker('refresh');
				}

				

			});
		
		if (po_id_temp) {
			if( po_id_temp!=po_id) {
				$("#receive_list").html('');
				chart_goods = [];
				$("#po_id_temp").val(po_id);
			}
		}else {
			$("#po_id_temp").val(po_id);
		}

		// clear_goods_chart();
			
	}

	function get_goods_detail()
	{
		var po_id    = $("#po_no_list").val();
		var goods_id = $("#goods_list").val();
		
		$.get("<?=base_url()?>index.php/inventori/get_po_list/3",
				{"po_id":po_id,"goods_id":goods_id})
		.done( function (data) {
			 
			var goods_detail = jQuery.parseJSON(data);
			
			$("#goods_code").val(goods_detail[0].barcode);
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
		
			// check same product
			var same = false;
			$.each(chart_goods,function(id,val){
				if (val.goods_id == goods_id)
				{
					
					val.goods_qty+=goods_qty;	
					val.goods_price = goods_price;
					same = true;
					
				}
			});

			if (!same){

				chart_goods.push(save_input);
			}

		
		
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

				goods_chart+="<tr id='"+id+"'>";
				goods_chart+="<input type='hidden' name='po_detail_id[]' id='po_detail_id_"+id+"' value='"+val.po_detail_id+"'>";
				goods_chart+="<input type='hidden' name='goods_id[]' id='goods_id_"+id+"' value='"+val.goods_id+"'>";
				goods_chart+="<td>"+(id+1)+"</td>";
				goods_chart+="<td>"+val.goods_code+"</td>";
				goods_chart+="<td>"+val.goods_name+"</td>";
				goods_chart+="<td><input type='number' name='goods_price[]' id='goods_price_"+id+"' value='" +val.goods_price+"' class='form-control' onchange='sum_total("+id+")' style='width:50%'></td>";
				goods_chart+="<td><input type='number' name='goods_qty[]' value='"+val.goods_qty+"' min='1' class='form-control' style='width:50%' id='goods_qty_"+id+"' onchange='sum_total("+id+")'></td>";
				goods_chart+="<td><input type='number' name='goods_discount[]' id='goods_discount_"+id+"' class='form-control' value='"+val.goods_discount+"' style='width:50%' onchange='sum_total("+id+")'></td>";
				goods_chart+="<td id='total_"+id+"'>"+numeral(total).format('0,[.]00')+"</td>";
				goods_chart+="<td><button type='button' class='btn btn-light-danger' onclick='delete_goods_from_chart("+id+")'><span class='fa la-trash'></span></button></td>";
				goods_chart+="</tr>";
			});

			$("#receive_list").append(goods_chart);
			$("#grant_total").html(numeral(grant_total).format('0,[.]00'));
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
		// $("#goods_list").html('<option value="">Barang Kosong</option>');
		// $("#goods_list").selectpicker('refresh');
		$("#goods_code").val('');
		$("#goods_id").val('');
		$("#goods_name").val('');
		$("#goods_discount").val(0);
		$("#goods_qty_order").val(0);
		$("#goods_qty").val(1);
		$("#goods_price").val('');	
		$("#goods_discount").val(0);
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
		        	 	// console.log(msg);return;
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
					$("#goods_list").selectpicker('refresh');
				}
				$("#goods_list").selectpicker('refresh');



				


			});
	}


	function sum_total(id)
	{
		// var price = $("tr #"+id).find("input #goods_price_id_"+id).val();
		// alert(id+' '+price);
		
		$("tr#"+id).each(function() {
			var goods_id_chart = $(this).find('#goods_id_'+id).val();
			var goods_qty_chart = ($(this).find('td #goods_qty_'+id).val() ) ? parseInt( $(this).find('td #goods_qty_'+id).val() ) : 0;
			var goods_price_chart = ($(this).find('#goods_price_'+id).val()) ? parseInt( $(this).find('#goods_price_'+id).val() ) : 0;
			var goods_discount_chart =  $(this).find('#goods_discount_'+id).val()!= "" ? parseInt( $(this).find('#goods_discount_'+id).val() )  : 0;

			// set new value to chart_goods array
			var new_input = {};
			new_input.id = goods_id_chart;
			new_input.qty = goods_qty_chart;
			new_input.price = goods_price_chart;
			new_input.discount = goods_discount_chart;

			console.log(new_input);
			set_new_value(id,new_input);
		});

		show_goods_to_chart();
	}

	function set_new_value(id,new_input)
	{
		$.each(chart_goods,function(idx,val){
			if (idx == id)
			{
				val.id =new_input.id;
				val.goods_qty =new_input.qty;
				val.goods_price =new_input.price;
				val.goods_discount =new_input.discount;
			}
		});
	}


	function change_price_method()
	{
		$("#price_method").val( $("#price_method_dropdown").val());
	}


</script>