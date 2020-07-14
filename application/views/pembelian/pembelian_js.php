<script>
	var chart_goods = [];
	var grant_total = 0;
	$(document).ready(function(){
		
		show_supplier_detail();
		get_chart_goods_from_db();
		show_chart_goods();		

		$("#goods_id").keyup(function(){
			var goods = this.value;
			var id_supplier = $("#supplier_id").val().split("_")[0];
			var goods_list = "";
			// clear goods 
			$("#goods_list").html('');


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

					$("#goods_list").html(goods_list);
				});
			}
		});

		$("#add_to_chart").click(function(){
			var id_goods = $("#id_goods").val();

		});

		$("#btn_save_purchase").click(function(){

			if (confirm('Anda yakin ingin menyimpan transaksi ini?'))
			{
				$("#form_purchase").submit();
			}
		});

	});
</script>
<script type="text/javascript">
	function show_supplier_detail()
	{
		
			var supplier_id = $("#supplier_id").val();
			
			$("#goods_list").html('');
			if (supplier_id){
				$.get("<?=base_url()?>index.php/pembelian/get_goods_json/3",
					{"id_supplier":supplier_id})
				.done(function(data){

					if (data.length > 0){
						const goods_arr = JSON.parse(data);
						
						var goods_list = "";
							$.each(goods_arr,function(id,val){
								goods_list+='<li class="navi-item nav-click" onclick="show_goods_detail('+val.id+')">';
						        goods_list+='<span class="navi-link">';
						        goods_list+='<div class="navi-text">';
						        goods_list+='<span class="nav-val d-none">'+val.id+'</span>';
						        goods_list+='<span class="d-block font-weight-bold">'+val.brand_description+'</span>';
						        goods_list+='<span class="text-muted">'+val.sku_code+'</span>';
						        goods_list+='</div>';
						        goods_list+='<span class="navi-arrow"></span>';
						        goods_list+='</span></li>';
							});

						$("#goods_list").html(goods_list);
						$("#branch_id").val(goods_arr[0].branch_id);
						$("#branch_name").val(goods_arr[0].branch_name);
						$("#partner_name").val(goods_arr[0].partner_name);
						$("#salesman_name").val(goods_arr[0].salesman);
						$("#partner_salesman").val(goods_arr[0].salesman);
						$("#salesman_id").val(goods_arr[0].salesman_id);
					}
				});
			}
	}

	function show_goods_detail(id_brg)
	{		

		$.get("<?=base_url()?>index.php/pembelian/get_goods_json/2",
			{"id_goods":id_brg})
		.done(function(data){
			const goods_arr = JSON.parse(data);

			$.each(goods_arr,function(id,val){
				var code = (val.sku_code) ? val.sku_code : 'Kosong';
				$("#id_goods").val(val.id);
				$("#goods_code").html(code);
				$("#goods_name").html(val.brand_description);
				$("#goods_price").html(val.price_alternate);
			});
		});
		// show modal
		$("#tambahBrgKeChart").modal('show');
	}

	function add_to_chart()
	{
		var goods_id = $("#id_goods").val();
		var goods_name = $("#goods_name").html();
		var goods_code = $("#goods_code").html();
		var goods_price = parseInt( $("#goods_price").html() );
		var goods_qty  = parseInt( $("#goods_qty").val() );

		var save_goods = {};
		save_goods.id = goods_id;
		save_goods.code = goods_code;
		save_goods.name = goods_name;
		save_goods.price= goods_price;
		save_goods.qty  = goods_qty;
		save_goods.discount  = 0;

		// Build the "map"
		var same = false;
		$.each(chart_goods,function(id,val){
			if (val.id == goods_id)
			{
				val.qty+=goods_qty;
				same = true;
			}
		});

		if (!same){
			chart_goods.push(save_goods);
		}
		
		$("#tambahBrgKeChart").modal('hide');

		show_chart_goods();
		set_zero_qty();

	}


	function show_chart_goods()
	{
		var rows = "";
		var total = 0;
		grant_total = 0;

		$("#goods_chart_table").html('');

		if (chart_goods.length > 0 ){

			$.each(chart_goods,function(id,val){
				total = ((val.price * val.qty) - ((val.price * val.qty) * val.discount)/100);
				grant_total+=total;
				total = total > 0 ?  (total/1000).toFixed(3)  : 0;
				rows+="<tr id='"+id+"'>";
				rows+="<td>"+(id+1)+"</td>";
				rows+="<td class='goods_code_chart'>";
				rows+="<input type='hidden' name='goods_id_chart[]' id='goods_id_chart_"+id+"' value='"+val.id+"'>";
				rows+="<input type='hidden' name='goods_code_chart[]' id='goods_code_chart' value='"+val.code+"'>"+val.code+"</td>";
				rows+= "<td>"+val.name+"'</td>";
				rows+="<td class='goods_price_chart'>";
				rows+="<input type='hidden' name='goods_price_chart[]' class='form-control w-50' id='goods_price_chart_"+id+"' value='"+val.price+"'>"+val.price+"</td>";
				rows+="<td><input type='number' name='goods_qty_chart[]' class='form-control' id='goods_qty_chart_"+id+"' value='"+val.qty+"' onchange='sum_total_goods("+id+")'></td>";
				rows+="<td><input type='number' name='goods_discount_chart[]' class='form-control' id='goods_discount_chart_"+id+"' value='"+val.discount+"' onchange='sum_total_goods("+id+")'></td>";
				rows+="<td class='text-right'>"+total+"</td>";
				rows+="<td><button type='button' class='btn btn-xs btn-danger' onclick='delete_goods_from_chart("+id+")'><span class='fa fa-trash'></span></button></td>";
				rows+="</tr>";	
			});

			$("#btn_save_purchase").attr('disabled',false);
		}else {
			rows+="<tr><td colspan='9' class='text-center'>Data Kosong</td></tr>";
			$("#btn_save_purchase").attr('disabled',true);
		}

		// grant_total = (grant_total/1000).toFixed(3);

		$("#goods_chart_table").append(rows);
		$("#grant_total").html(grant_total);
		
	}

	function sum_total_goods(id)
	{
		
		$("tr#"+id).each(function(){
			var new_input = {};

			var goods_id_chart = $(this).find('td #goods_id_chart_'+id).val();
			var goods_qty_chart = ($(this).find('td #goods_qty_chart_'+id).val() ) ? parseInt( $(this).find('td #goods_qty_chart_'+id).val() ) : 0;
			var goods_price_chart = ($(this).find('td #goods_price_chart_'+id).val()) ? parseInt( $(this).find('td #goods_price_chart_'+id).val() ) : 0;
			var goods_discount_chart =  $(this).find('td #goods_discount_chart_'+id).val()!= "" ? parseInt( $(this).find('td #goods_discount_chart_'+id).val() )  : 0;
			
			// set new value to chart_goods array
			new_input.id = goods_id_chart;
			new_input.qty = goods_qty_chart;
			new_input.price = goods_price_chart;
			new_input.discount = goods_discount_chart;

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
				val.id =new_input.id;
				val.qty =new_input.qty;
				val.price =new_input.price;
				val.discount =new_input.discount;
			}
		});
	}

	function set_zero_qty()
	{
		$("#goods_qty").val(1);
	}

	function delete_goods_from_chart(id)
	{
		if ( confirm('Anda yakin ingin menghapus barang ini?') ){
			
			chart_goods.splice(id,1);
			show_chart_goods();
		}
	}

	function get_chart_goods_from_db()
	{
		var data = <?=isset($master) ? json_encode($master) :null;?>;
		
		if (data.length > 0){

			$.each(data,function(id,val){
				var code = (val.plu_code) ? val.plu_code : 'Kosong';
				var save_goods = {};

				save_goods.id 		= val.goods_id;
				save_goods.code 	= code;
				save_goods.name 	= val.goods_name;
				save_goods.price 	= parseInt(val.goods_price);
				save_goods.qty  	= parseInt(val.goods_qty);
				save_goods.discount = (val.goods_discount) ? val.goods_discount : 0;
				chart_goods.push(save_goods);
				
			});
		}
	}


	function approve_po(po_id)
	{
		    Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "Data yg telah diproses tidak dapat diubah!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {

		        	 $.get("<?=base_url()?>index.php/pembelian/approve_po/",
		        	 	{"po_id":po_id})
		        	 .done(function(msg){

		        	 	if (msg) {
		        	 		Swal.fire(
				                "Tersimpan!",
				                "Transaksi berhasil disetujui",
				                "success"
				            )
				            window.location.href = "<?=base_url()?>index.php/pembelian";
		        	 	}
		        	 });
		            
		        }
		    });
	}

	function print_po(po_id)
	{
		Swal.fire({
		        title: "Anda yakin ingin mencetak transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {
		        	window.open("<?=base_url()?>index.php/pembelian/print_po/"+po_id);
		        }
		    });
	}

</script>