<?php

	

	function generate_po_no()
	{
		
		$CI =& get_instance();
		$CI->load->model(array("Purchase_order_model" => "po"));

		$po_no_db = ($CI->po->get_po_no()->row()) ? $CI->po->get_po_no()->row()->purchase_order_no : null;

		$po_no    = date('Ym')."00001";

		if ($po_no_db)
		{
			$po_year  = substr($po_no_db, 0,4);
			$po_month = substr($po_no_db, 4,2);

			if ( date('Y') == $po_year) {
				
				if ( date('m') == $po_month) {
					$po_no = $po_no_db+1;
				} else {
					$po_no = substr($po_no_db, 0,4).date('m')."00001";
				}
			} else {
				$po_no = date('Ym')."00001";
			}

		}

		return $po_no;
		


	}


	function generate_po_receive_no()
	{
		
		$CI =& get_instance();
		$CI->load->model(array("Receiving_model" => "rm"));

		$po_no_db = ($CI->rm->get_receive_no()->row()) ? $CI->rm->get_receive_no()->row()->receiving_no : null;

		$po_no    = date('Ym')."00001";

		if ($po_no_db)
		{
			$po_year  = substr($po_no_db, 0,4);
			$po_month = substr($po_no_db, 4,2);

			if ( date('Y') == $po_year) {
				
				if ( date('m') == $po_month) {
					$po_no = $po_no_db+1;
				} else {
					$po_no = substr($po_no_db, 0,4).date('m')."00001";
				}
			} else {
				$po_no = date('Ym')."00001";
			}

		}

		return $po_no;

	}


	function generate_ws_no()
	{
		
		$CI =& get_instance();
		$CI->load->model(array("Warehouse_model" => "ws"));

		$po_no_db = ($CI->ws->get_ws_no()->row()) ? $CI->ws->get_ws_no()->row()->physical_warehouse_no : null;

		$po_no    = date('Ym')."00001";

		if ($po_no_db)
		{
			$po_year  = substr($po_no_db, 0,4);
			$po_month = substr($po_no_db, 4,2);

			if ( date('Y') == $po_year) {
				
				if ( date('m') == $po_month) {
					$po_no = $po_no_db+1;
				} else {
					$po_no = substr($po_no_db, 0,4).date('m')."00001";
				}
			} else {
				$po_no = date('Ym')."00001";
			}

		}

		return $po_no;
		


	}
?>