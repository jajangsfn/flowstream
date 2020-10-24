<?php

	

	function generate_po_no($type = 1)
	{
		
		$CI =& get_instance();
		$CI->load->model(
						array(
								"Purchase_order_model" => "po",
								"Warehouse_model" => "ws",
								"Receiving_model" => "rm",
								"Return_model" => "return",
								"T_pos_return_model" => "pos_return", 
								"T_delivery_model" => "delivery",
							)
						); 
		// array for transaction code
		$arr_trx_code = array(
							1 => 21,
							2 => 31,
							3 => 32,
							4 => 62,
							5 => 61,
							6 => 71);

		// get branch code from session
		$branch_code = str_pad($CI->session->userdata('branch_id'), 6, '0', STR_PAD_LEFT); 
		// get trx code from transcation code array
		$trx_code    = $arr_trx_code[$type];

		// initialize max trx no
		$trx_no_db = null;

		// get max trx no from db
		if ( $type == 1) {
			$trx_no_db = ($CI->po->get_po_no()->row()) ? substr( $CI->po->get_po_no()->row()->purchase_order_no , 8) : null;	
		} else if ( $type == 2) {
			$trx_no_db = ($CI->rm->get_receive_no()->row()) ? substr( $CI->rm->get_receive_no()->row()->receiving_no, 8) : null;	
		} else if ( $type == 3) {
			$trx_no_db = ($CI->ws->get_ws_no()->row()) ? substr( $CI->ws->get_ws_no()->row()->physical_warehouse_no, 8) : null;
		} else if ( $type == 4) {
			$trx_no_db = ($CI->return->get_return_no()->row()) ? substr( $CI->return->get_return_no()->row()->return_no, 8) : null;
		} else if ( $type == 5) {
			$trx_no_db = ($CI->pos_return->get_return_no()->row()) ? substr( $CI->pos_return->get_return_no()->row()->return_no, 8) : null;
		} else if ( $type == 6) {
			$trx_no_db = ($CI->delivery->get_delivery_no()->row()) ? substr( $CI->delivery->get_delivery_no()->row()->delivery_no, 8) : null;
		}
		
		// initialize trx no
		$trx_no    = $branch_code . $trx_code . date('Ym')."000001";

		// if trx no exist in db
		if ($trx_no_db)
		{
			// get year
			$trx_year  = substr($trx_no_db, 0,4);
			// get month
			$trx_month = substr($trx_no_db, 4,2);

			// if year same with trx year from db
			if ( date('Y') == $trx_year) {
				// if month now is same with trx month from db
				if ( date('m') == $trx_month) {
					// increment trx no
					$trx_no = $branch_code . $trx_code . ($trx_no_db+1);
				} else {
					// initialize new trx no
					// with combine branch code trx code  
					$trx_no = $branch_code . $trx_code . substr($trx_no_db, 0,4).date('m')."000001";
				}
				
			} else {
				// initialize new trx no
				$trx_no = $branch_code . $trx_code . date('Ym')."000001";
			}

		}

		return $trx_no;

	}

	function get_invoice_format($invoice_no)
	{
		$CI 		=& get_instance();
		$new_format = "";		
		// get branch code from session
		$branch_id 	= $CI->session->userdata('branch_id'); 
		// get param
		$param 		= $CI->db->query("SELECT * FROM m_parameter_nomor_faktur WHERE branch_id=".$branch_id);

		if ($param->num_rows() > 0) {

			if (!is_null($param->row()->flag)) {
				$invoice_code = $param->row()->invoice_code;
				$new_format   = substr($invoice_no,8,4)."/".$invoice_code."/".substr($invoice_no,12,2)."/".substr($invoice_no,14);
			}else {
				$new_format   = $invoice_no;	
			}
			
		}else {
			$new_format   = $invoice_no;
		}

		return $new_format;

	}

?>