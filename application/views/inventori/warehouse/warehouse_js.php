<script>
	var goods_list = [];
	$(document).ready( function() {
		show_goods_from_db();
		search_receive_order();
		$("#btn_save_ws").click(function(){

			if ($("#prev_ws").val() === "") {
				alert('Silahkan pilih gudang awal!');
			}else if ($("#act_ws").val() === "") {
				alert('Silahkan pilih gudang tujuan!');
			}else if ($("#ref_no").val() === "") {
				alert('Silahkan isi no referensi!');
			}else {
				if (goods_list.length > 0) {
					if (confirm("Anda Yakin ingin menyimpan transaksi ini?") ) {
						$("#form_ws").submit();
					}
				}else {
					alert('Data barang masih kosong!');
				}
				
			}
		});
	});
</script>
<script>
	
	function search_goods() {
		var search = $("#kode_barang").val();

		if ( search ) {

			$.get("<?=base_url()?>index.php/inventori/get_goods",
					{"kode_barang":search})
			.done( function(data) {

				var parse = jQuery.parseJSON(data);
				
				if ( parse.length ) {
					$.each(parse, function(id, val) {
						$("#id_barang").val(val.id);
						$("#nama_barang").val(val.brand_description);
					});
				}else {
					Swal.fire("Info", "Barang tidak ditemukan!", "error");
				}
			});
		}
		
	}

	function add_to_chart() {

		var id_barang = $("#id_barang").val();
		var nama_barang = $("#nama_barang").val();
		var kode_barang = $("#kode_barang").val();
		var qty_barang  = parseInt( $("#quantity").val() );

		var input = {};


		if ( id_barang ) {
			input.id_barang 	= id_barang;
			input.kode_barang 	= kode_barang;
			input.nama_barang 	= nama_barang;
			input.qty_barang  	= qty_barang;


			if ( goods_list.length > 0) {

				// check same goods
				var same = false;

				$.each(goods_list, function(id, val) {

					if (val.id_barang == id_barang) {

						same = true;
						val.qty_barang+=qty_barang;
					} 
				});
				
				if (!same) {

					goods_list.push(input);
				}

			}else {

				goods_list.push(input);
			}


			show_goods_list();
			clear_search();

		} else  {

			Swal.fire("Info", "Silahkan Isi Data Barang!", "error");
		}
	}

	function show_goods_list() {

		var text = "";

		if ( goods_list.length > 0 ) {

			$.each(goods_list, function(id, val) {

				text+="<tr>";
				text+="<td>"+(id+1)+"</td>";
				text+="<td>"+val.kode_barang+"</td>";
				text+="<td>";
				text+="<input type='hidden' name='id_barang[]' value='"+val.id_barang+"'>";
				// text+="<input type='hidden' name='qty_barang[]' value='"+val.qty_barang+"'>";
				text+=val.nama_barang+"</td>";
				text+="<td width=150><input type='number' name='qty_barang[]' value="+val.qty_barang+" required class='form-control'></td>";
				text+="<td><button class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button></td>";
				text+="</tr>";

			});

			$("#goods_ws_list").html(text);
		}
	}

	function clear_search()
	{
		$("#id_barang").val('');
		$("#nama_barang").val('');
		$("#kode_barang").val('');
		$("#quantity").val(1);
		$("#goods_list").val("");
		$("#goods_list").selectpicker('');
	}


	function approve_warehouse(ws_id)
	{
		    Swal.fire({
		        title: "Anda yakin ingin memproses transaksi ini?",
		        text: "Data yg telah diproses tidak dapat diubah!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) { 
		        if (result.value) {

		        	 $.get("<?=base_url()?>index.php/inventori/approve_warehouse/",
		        	 	{"ws_id":ws_id})
		        	 .done(function(msg){
		        	 	// console.log(msg);
		        	 	if (msg) {
		        	 		Swal.fire(
				                "Tersimpan!",
				                "Barang berhasil disimpan",
				                "success"
				            )
				            window.location.href = "<?=base_url()?>index.php/inventori/gudang";
		        	 	}
		        	 });
		            
		        }
		    });
	}

	function print_warehouse(ws_id)
	{
		Swal.fire({
		        title: "Anda yakin ingin mencetak transaksi ini?",
		        text: "",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonText: "Proses"
		    }).then(function(result) {
		        if (result.value) {
		        	window.open("<?=base_url()?>index.php/inventori/print_warehouse/"+ws_id);
		        }
		    });
	}

	function show_goods_from_db()
	{
		var data = '<?=isset($warehouse) ?  json_encode($warehouse) : "";?>';
		var parse = (data) ? jQuery.parseJSON(data) : null;


		if (parse && parse.length > 0) {

			$.each(parse, function(id, val) {
				
				var input = {};

				input.id_barang 	= val.goods_id;
				input.kode_barang 	= val.sku_code;
				input.nama_barang 	= val.brand_description;
				input.qty_barang  	= parseInt(val.total_item);

				goods_list.push(input);

			});
		}

		show_goods_list();
	}


	function search_receive_order() 
	{
		var receive_no = jQuery.trim($("#nro").val());
		var text 	   = "";

		if (receive_no) {
			$.get("<?=base_url()?>index.php/inventori/get_ws_goods",
						{"receive_no":receive_no})
				.done( function(data) {
 
					var parse = jQuery.parseJSON(data); 
					console.log(parse);

					if ( parse.length > 0 ) {

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

		});
	}
</script>