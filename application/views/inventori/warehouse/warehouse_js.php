<script>
	var goods_list = [];
	$(document).ready( function() {
		show_goods_from_db();
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
				console.log(same);
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

			$("#goods_list").html(text);
		}
	}

	function clear_search()
	{
		$("#id_barang").val('');
		$("#nama_barang").val('');
		$("#kode_barang").val('');
		$("#quantity").val(1);
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
				input.qty_barang  	= val.total_item;

				goods_list.push(input);

			});
		}

		show_goods_list();
	}
</script>