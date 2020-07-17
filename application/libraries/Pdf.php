<?php

/**
 * 
 */
class pdf 
{ 
	
	function __construct()
	{
		include_once APPPATH .'/third_party/fpdf/fpdf.php';
	}


	function param_paper($type = 1)
	{
		// 1 pembelian
		// 2 penjualan tes
		$param_paper = array(1 => array(
									"po_in"=> array(
										1 => array("paper"=>"A4",
												   "view" => "P",
												   "type_size" => "cm",
												   "title_paper" => array( "title" => 'Bukti Purchase Order',
																			"width" => 20,
																			"height" => 0.5,
																			"align" => 'C'),
												   "title_position_y" => 0.5,
												   "space" => 1.7,
												   "header"=> array(
												   					0 => array("position_x" => 0.2,
												  								"position_y" => 0.7,
												   								"name" => 0.2,
												   								"pad" => 0.2,
												   								"val" => 3,
												   								"title" => 'Supplier',
												   								"align" => 'L',
												   								"index" => "partner_name"),
																	1 => array("position_x" => 0.2,
												  								"position_y" => 1.2,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'Salesman',
												   								"align" => 'L',
												   								"index" => 'salesman_name'),
												   					2 => array("position_x" => 0.2,
												   								"position_y" => 1.7,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'No PO',
												   								"align" => 'L',
												   								"index" => "purchase_order_no"),
												   					3 => array("position_x" => 0.2,
												   								"position_y" => 2.3,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'Tgl PO',
												   								"align" => 'L',
												   								"index" => "purchase_order_date"),
																),
												   "body_position_y" => 3.2,
												   "body_position_x" => 0.3,
												   "body_ln" => 0.6,
												   "body_start_y" => 0.6,
												   "body_start_x" => 0.3,
												   "body" => array(0 => array( "title"=> "No",
												   								"width"=>0.6,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					1 => array( "title"=> "Nama Barang",
												   								"width"=>9,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					2 => array( "title"=> "Harga Satuan",
												   								"width"=>3.5,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
												   					3 => array( "title"=> "Qty (Pcs)",
												   								"width"=>3.5,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
												   					4 => array( "title"=> "Jumlah",
												   								"width"=>3.5,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
																	),
												   "footer" => array("footer_ln" => 0.7,
												   					"signature" => array("title" => "Disahkan Oleh :",
																						  "width" => 4,
																						  "height" => 0.8,
																						  "align"=>'L',
																						  "position_x" => 0.3,
																						), 
												   					"total" => array("title" => "Jumlah Rp.",
														   							"width" => 4,
														   							"height" => 0.8,
														   							"align"=>'R',
														   							"position_x" => 15),
														   			"summary" => array("title" => "",
														   								"width" => 3.5,
														   								"height" => 0.8,
														   								"align"=>'R',
														   								"position_x" => 17),
																	),

														), //end size a4
								2 => array("paper"=> array(215,139),
										   "view" => "L",
										   "type_size" => "mm",
										   "title_paper" => array( "title" => 'Bukti Purchase Order',
																	"width" => 200,
																	"height" => 1,
																	"align" => 'C'),
										   "title_position_y" => 5,
										   "space" => 18,
										   "header"=> array(
										   					0 => array("position_x" => 1,
														   				"position_y" => 10,
														   				"name" => 15,
														   				"pad" => 1.7,
														   				"val" => 11.8,
														   				"title" => 'Supplier',
														   				"align" => 'L',
														   				"index" => "partner_name"),
														   	1 => array("position_x" => 0.8,
														   				"position_y" => 15,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Salesman',
														   				"align" => 'L',
														   				"index" => 'salesman_name'),
														   	2 => array("position_x" => 0.8,
														   				"position_y" => 20,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'No PO',
														   				"align" => 'L',
														   				"index" => "purchase_order_no"),
														   	3 => array("position_x" => 0.8,
														   				"position_y" => 25,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Tgl PO',
														   				"align" => 'L',
														   				"index" => "purchase_order_date"),
																		),
											"body_position_y" => 28,
											"body_position_x" => 3,
											"body_ln" => 5,
											"body_start_y" => 5,
											"body_start_x" => 3,
											"body" => array(0 => array( "title"=> "No",
														   				"width"=>7,
														   				"height"=>5,
														   				"align"=>'L',
														   			  ),
														   	1 => array( "title"=> "Nama Barang",
														   				"width"=>83,
														   				"height"=>5,
														   				"align"=>'L',
														   			  ),
														   	2 => array( "title"=> "Harga Satuan",
														   				"width"=>35,
														   				"height"=>5,
														   				"align"=>'R',
														   			  ),
														   	3 => array( "title"=> "Qty (Pcs)",
														   				"width"=>35,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
														   	4 => array( "title"=> "Jumlah",
														   				"width"=>50,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
																			),
											"footer" => array(
														  	"footer_ln" => 0.1,
														  	"signature" => array("title" => "Disahkan Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 3,
																			),
														   	"total" => array("title" => "Jumlah Rp.",
														   				"width" => 160.2,
														   				"height" => 5,
														   				"align"=>'R',
														   				"position_x" => 2.8),
														   	"summary" => array("title" => "",
														   							"width" => 50,
														   							"height" => 5,
														   							"align"=>'R',
														   							"position_x" => 163),
																			),

										), //end size B5
									), //end po
						"receive_in"=> array(
										1 => array("paper"=>"A4",
												   "view" => "P",
												   "type_size" => "cm",
												   "title_paper" => array( "title" => 'Bukti Terima Barang',
																			"width" => 20,
																			"height" => 0.5,
																			"align" => 'C'
																		),
												   "title_position_y" => 0.5,
												   "space" => 1.8,
												   "header"=> array(
												   					0 => array("position_x" => 0.2,
												  								"position_y" => 0.7,
												   								"name" => 0.2,
												   								"pad" => 0.2,
												   								"val" => 3,
												   								"title" => 'Supplier',
												   								"align" => 'L',
												   								"index" => "partner_name"),
												   					2 => array("position_x" => 0.2,
												   								"position_y" => 1.2,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'No PO',
												   								"align" => 'L',
												   								"index" => "receiving_no"),
												   					3 => array("position_x" => 0.2,
												   								"position_y" => 1.7,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'Tgl Terima',
												   								"align" => 'L',
												   								"index" => "created_date"),
																),
												   "body_position_y" => 2.6,
												   "body_position_x" => 0.3,
												   "body_ln" => 0.6,
												   "body_start_y" => 0.6,
												   "body_start_x" => 0.3,
												   "body" => array(
												   					0 => array( "title"=> "No",
												   								"width"=>0.6,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					1 => array( "title"=> "Kode Barang",
												   								"width"=>3,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					2 => array( "title"=> "Nama Barang",
												   								"width"=>6.3,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					3 => array( "title"=> "Harga Satuan",
												   								"width"=>2.5,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
												   					4 => array( "title"=> "Qty (Pcs)",
												   								"width"=>2,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
												   					5 => array( "title"=> "Disc",
												   								"width"=>2.5,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
												   					6 => array( "title"=> "Jumlah",
												   								"width"=>3.5,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
																	),
												   				
												   "footer" => array("footer_ln" => 0.01,
												   					"signature" => array("title" => "Disahkan Oleh :",
																						  "width" => 4,
																						  "height" => 0.8,
																						  "align"=>'L',
																						  "position_x" => 0.3,

																						), 
												   					"total" => array("title" => "Jumlah Rp.",
														   							"width" => 16.9,
														   							"height" => 0.4,
														   							"align"=>'R',
														   							"position_x" => 0.3),
														   			"summary" => array("title" => "",
														   								"width" => 3.5,
														   								"height" => 0.4,
														   								"align"=>'R',
														   								"position_x" => 17.2),
																	),

														), //end size a4
								2 => array("paper"=> array(215,139),
										   "view" => "L",
										   "type_size" => "mm",
										   "title_paper" => array( "title" => 'Bukti Terima Barang',
																	"width" => 200,
																	"height" => 1,
																	"align" => 'C'),
										   "title_position_y" => 5,
										   "space" => 22,
										   "header"=> array(
										   					0 => array("position_x" => 1,
														   				"position_y" => 10,
														   				"name" => 15,
														   				"pad" => 1.7,
														   				"val" => 11.8,
														   				"title" => 'Supplier',
														   				"align" => 'L',
														   				"index" => "partner_name"
														   			),
														   	1 => array("position_x" => 0.8,
														   				"position_y" => 15,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'No Receive',
														   				"align" => 'L',
														   				"index" => "receiving_no"
														   			),
														   	3 => array("position_x" => 0.8,
														   				"position_y" => 20,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Tgl Terima',
														   				"align" => 'L',
														   				"index" => "created_date"),
																		),
											"body_position_y" => 25,
											"body_position_x" => 3,
											"body_ln" => 5,
											"body_start_y" => 5,
											"body_start_x" => 3,
											"body" => array(0 => array( "title"=> "No",
														   				"width"=>7,
														   				"height"=>5,
														   				"align"=>'L',
														   			  ),
															1 => array( "title"=> "Kode Barang",
														   				"width"=>35,
														   				"height"=>5,
														   				"align"=>'L',
														   			),

														   	2 => array( "title"=> "Nama Barang",
														   				"width"=> 70,
														   				"height"=>5,
														   				"align"=>'L',
														   			  ),
														   	3 => array( "title"=> "Harga Satuan",
														   				"width"=>25,
														   				"height"=>5,
														   				"align"=>'R',
														   			  ),
														   	4 => array( "title"=> "Qty (Pcs)",
														   				"width"=>25,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
														   	5 => array( "title"=> "Disc",
														   				"width"=>15,
														   				"height"=>5,
														   				"align"=>'R',
														   			),

														   	6 => array( "title"=> "Jumlah",
														   				"width"=>33,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
															),
											"footer" => array(
														  	"footer_ln" => 0.2,
														  	"signature" => array("title" => "Disahkan Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 3,
																			),
														   	"total" => array("title" => "Jumlah Rp.",
															   				"width" => 177,
															   				"height" => 5,
															   				"align"=>'R',
															   				"position_x" => 3
															   				),
														   	"summary" => array("title" => "",
														   					   "width" => 33,
														   					   "height" => 5,
														   						"align"=>'R',
														   						"position_x" => 180),
														),

										), //end size B5
									), //end recive
						"warehouse_in"=> array(
										1 => array("paper"=>"A4",
												   "view" => "P",
												   "type_size" => "cm",
												   "title_paper" => array( "title" => 'Bukti Penempatan Barang',
																			"width" => 20,
																			"height" => 0.5,
																			"align" => 'C'
																		),
												   "title_position_y" => 0.5,
												   "space" => 1.8,
												   "header"=> array(
												   					0 => array("position_x" => 0.2,
												   								"position_y" => 1.2,
												   							"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'No Transaksi',
												   								"align" => 'L',
												   								"index" => "receiving_no"),
												   					1 => array("position_x" => 0.2,
												   								"position_y" => 1.7,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'Tgl Transaksi',
												   								"align" => 'L',
												   								"index" => "created_date"),
												   					2 => array("position_x" => 0.2,
												   								"position_y" => 1.7,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'Gudang Awal',
												   								"align" => 'L',
												   								"index" => "created_date"),
												   					3 => array("position_x" => 0.2,
												   								"position_y" => 1.7,
												   								"name" => 2,
												   								"pad" => 0.2,
												   								"val" => 11.8,
												   								"title" => 'Gudang Tujuan',
												   								"align" => 'L',
												   								"index" => "created_date"),
																),
												   "body_position_y" => 2.6,
												   "body_position_x" => 0.3,
												   "body_ln" => 0.6,
												   "body_start_y" => 0.6,
												   "body_start_x" => 0.3,
												   "body" => array(
												   					0 => array( "title"=> "No",
												   								"width"=>0.6,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					1 => array( "title"=> "Kode Barang",
												   								"width"=>3,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					2 => array( "title"=> "Nama Barang",
												   								"width"=>6.3,
												   								"height"=>0.6,
												   								"align"=>'L',
												   							),
												   					4 => array( "title"=> "Qty (Pcs)",
												   								"width"=>2,
												   								"height"=>0.6,
												   								"align"=>'R',
												   							),
												   				),
												   				
												   "footer" => array("footer_ln" => 0.01,
												   					"signature" => array("title" => "Disahkan Oleh :",
																						  "width" => 4,
																						  "height" => 0.8,
																						  "align"=>'L',
																						  "position_x" => 0.3,

																						), 
												   					"total" => array("title" => "Jumlah (Pcs)",
														   							"width" => 16.9,
														   							"height" => 0.4,
														   							"align"=>'R',
														   							"position_x" => 0.3),
														   			"summary" => array("title" => "",
														   								"width" => 3.5,
														   								"height" => 0.4,
														   								"align"=>'R',
														   								"position_x" => 17.2),
																	),

														), //end size a4
								2 => array("paper"=> array(215,139),
										   "view" => "L",
										   "type_size" => "mm",
										   "title_paper" => array( "title" => 'Bukti Terima Barang',
																	"width" => 200,
																	"height" => 1,
																	"align" => 'C'),
										   "title_position_y" => 5,
										   "space" => 22,
										   "header"=> array(
										   					0 => array("position_x" => 1,
														   				"position_y" => 10,
														   				"name" => 15,
														   				"pad" => 1.7,
														   				"val" => 11.8,
														   				"title" => 'No Transaksi',
														   				"align" => 'L',
														   				"index" => "partner_name"
														   			),
														   	1 => array("position_x" => 0.8,
														   				"position_y" => 15,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'No Receive',
														   				"align" => 'L',
														   				"index" => "receiving_no"
														   			),
														   	3 => array("position_x" => 0.8,
														   				"position_y" => 20,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Tgl Terima',
														   				"align" => 'L',
														   				"index" => "created_date"),
																		),
											"body_position_y" => 25,
											"body_position_x" => 3,
											"body_ln" => 5,
											"body_start_y" => 5,
											"body_start_x" => 3,
											"body" => array(0 => array( "title"=> "No",
														   				"width"=>7,
														   				"height"=>5,
														   				"align"=>'L',
														   			  ),
															1 => array( "title"=> "Kode Barang",
														   				"width"=>35,
														   				"height"=>5,
														   				"align"=>'L',
														   			),

														   	2 => array( "title"=> "Nama Barang",
														   				"width"=> 70,
														   				"height"=>5,
														   				"align"=>'L',
														   			  ),
														   	3 => array( "title"=> "Harga Satuan",
														   				"width"=>25,
														   				"height"=>5,
														   				"align"=>'R',
														   			  ),
														   	4 => array( "title"=> "Qty (Pcs)",
														   				"width"=>25,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
														   	5 => array( "title"=> "Disc",
														   				"width"=>15,
														   				"height"=>5,
														   				"align"=>'R',
														   			),

														   	6 => array( "title"=> "Jumlah",
														   				"width"=>33,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
															),
											"footer" => array(
														  	"footer_ln" => 0.2,
														  	"signature" => array("title" => "Disahkan Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 3,
																			),
														   	"total" => array("title" => "Jumlah Rp.",
															   				"width" => 177,
															   				"height" => 5,
															   				"align"=>'R',
															   				"position_x" => 3
															   				),
														   	"summary" => array("title" => "",
														   					   "width" => 33,
														   					   "height" => 5,
														   						"align"=>'R',
														   						"position_x" => 180),
														),

										), //end size B5
									), //end recive
						),
					2 => array());


		return $param_paper[$type];
	}


	// type 1 pembelian
	// type 2 penjualan
	function dynamic_print($type = 1,$type_print = "po_in", $data) {

		// get paper 
		$paper_reference = $this->param_paper($type);
		// echo json_encode();
		// count data
		$count_data = count($data);

		// if data > 10 then use A4 paper
		// else use B4 paper
		$use_paper = 1;
		if ( $count_data <= 10 ) {
			$use_paper = 2;
		}
		// echo $count_data." ".$use_paper;exit;
		// echo json_encode($paper_reference[$type_print][$use_paper]);exit;
		// initilization paper
		$pdf = new FPDF($paper_reference[$type_print][$use_paper]['view'], 
						$paper_reference[$type_print][$use_paper]['type_size'], 
						$paper_reference[$type_print][$use_paper]['paper']);

		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',13);

		// set position to top
		$pdf->SetY($paper_reference[$type_print][$use_paper]['title_position_y']);


		// set tile header
		$pdf->Cell($paper_reference[$type_print][$use_paper]['title_paper']['width'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['height'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['title'],0,1,
					$paper_reference[$type_print][$use_paper]['title_paper']['align']);
		
		// set header 
		$pdf->SetFont('Arial','B',10);
		// if ( $type_print == 'po_in') {

			foreach ($paper_reference[$type_print][$use_paper]['header'] as $key => $value) {
				$pdf->SetY($value['position_y']);
				$pdf->SetX($value['position_x']);

				$pdf->Cell($value['name'], 1,
				 		   $value['title'],0,0,
				 		   $value['align']);

				$pdf->SetY($value['position_y']);
				// $sum = 1.7;
				$pdf->SetX($value['position_x']+$paper_reference[$type_print][$use_paper]['space']);

				$pdf->Cell($value['pad'], 1,
				 		   ':',0,0,
				 		   $value['align']);

				$pdf->Cell($value['val'], 1,
				 		   $data[0][$value['index']],0,0,
				 		   $value['align']);
				$pdf->ln(0.8);	
			}

		// }


		// set body title
		$pdf->ln(0.8);	
		$pdf->SetY($paper_reference[$type_print][$use_paper]['body_position_y']);
		$pdf->SetX($paper_reference[$type_print][$use_paper]['body_position_x']);
		$pdf->SetFont('Arial','B',9);
		foreach ($paper_reference[$type_print][$use_paper]['body'] as $key => $value) {
			$pdf->Cell($value['width'], $value['height'], $value['title'],1,0,'C');	
		}

		$pdf->ln($paper_reference[$type_print][$use_paper]['body_start_y']);	
		// $pdf->ln(0.);
	
		$pdf->SetFont('Arial','',8);

		$grant_total = 0;
		if ($type_print == 'po_in'){
			foreach ($data as $key => $val) {
				$total = $val['goods_price'] * $val['goods_qty'];
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),1,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['goods_name'],1,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   number_format($val['goods_price']),1,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['goods_qty']),1,0,
						   $paper_reference[$type_print][$use_paper]['body'][3]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($total),1,0,
						   $paper_reference[$type_print][$use_paper]['body'][4]['align']);	

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
			}
		}

		if ($type_print == 'receive_in'){
			foreach ($data as $key => $val) {
				$total = ($val['price'] * $val['receive_qty']) - (($val['price'] * $val['receive_qty']) * $val['discount'] /100 );
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),1,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['plu_code'],1,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['goods_name'],1,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['price']),1,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['receive_qty']),1,0,
						   $paper_reference[$type_print][$use_paper]['body'][4]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   number_format($val['discount']),1,0,
						   $paper_reference[$type_print][$use_paper]['body'][5]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][6]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][6]['height'], 
						   number_format($total),1,0,
						   $paper_reference[$type_print][$use_paper]['body'][6]['align']);	

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
			}
		}

		// set signature
		$pdf->SetFont('Arial','',9);		
		$pdf->ln($paper_reference[$type_print][$use_paper]['footer']['footer_ln']);
		// total
		$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total']['position_x']);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total']['width'], 
				   $paper_reference[$type_print][$use_paper]['footer']['total']['height'], 
				   $paper_reference[$type_print][$use_paper]['footer']['total']['title'],1,0,
				   $paper_reference[$type_print][$use_paper]['footer']['total']['align']);

		$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['summary']['position_x']);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['summary']['width'], 
				   $paper_reference[$type_print][$use_paper]['footer']['summary']['height'], 
				   number_format($grant_total),1,1,
				   $paper_reference[$type_print][$use_paper]['footer']['summary']['align']);
		// disahkan
		$pdf->ln($paper_reference[$type_print][$use_paper]['footer']['footer_ln']*40);
		$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['signature']['position_x']);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['signature']['width'], 
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['height'], 
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['title'],0,0,
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['align']);	


		$pdf->output('i',$type_print.'-'.date('Y-m-d'));
		// echo json_encode();
	}

	// function print_po($type = 1,$data) {
	// 	// echo json_encode($data);exit;
	// 	// type 1 = pembelian
	// 	// type 2 = penjualan

	// 	if ($type == 1) {

	// 		$pdf = new FPDF("L","cm","A4");
	// 		$pdf->SetMargins(0.8,1,1);
	// 		$pdf->AliasNbPages();
	// 		$pdf->AddPage();
	// 		$pdf->SetFont('Arial','B',16);
	// 		// judul
	// 		$pdf->Cell(30,1,'Bukti Purchase Order',0,1,'C');

	// 		$pdf->SetFont('Arial','B',10);
	// 		$pdf->Cell(4,0.7,"Printed On : ".date("d/m/Y"),0,0,'C');
	// 		$pdf->ln(1);

	// 		// header
	// 		$pdf->SetFont('Arial','B',11);
	// 		$pdf->setFillColor(155,89,182);
	// 		$pdf->SetTextColor(255,255,255);
	// 		$pdf->Cell(15, 1, 'Rincian Supplier', 1, 0, 'L',true);
	// 		$pdf->Cell(13, 1, 'Rincian PO', 1, 0, 'L',true);
	// 		$pdf->ln(1);

	// 		$pdf->SetFont('Arial','B',9);
	// 		$pdf->setFillColor(236, 240, 241);
	// 		$pdf->SetTextColor(0,0,0);

	// 		$pdf->Cell(3, 1, 'Supplier', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(11.8, 1, $data[0]->partner_name, 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'No PO', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->purchase_order_no, 0, 0, 'L',true);

	// 		$pdf->ln(1);
	// 		$pdf->Cell(3, 1, 'Salesman', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(11.8, 1, $data[0]->salesman_name, 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'Tgl PO', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->created_date, 0, 0, 'L',true);

	// 		$pdf->ln(1);
	// 		$pdf->Cell(5, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'No Referensi', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->reference_no, 0, 0, 'L',true);

	// 		$pdf->ln(1);
	// 		$pdf->Cell(5, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'Deskripsi', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->description, 0, 0, 'L',true);

	// 		$pdf->ln(2);

			
	// 		$pdf->SetFont('Arial','B',9);
	// 		$pdf->setFillColor(155,89,182);
	// 		$pdf->SetTextColor(255,255,255);
			

			
	// 		$pdf->Cell(1, 0.8, 'No', 1, 0, 'C',1);
	// 		$pdf->Cell(5, 0.8, 'Kode Barang', 1, 0, 'C',1);
	// 		$pdf->Cell(9, 0.8, 'Nama Barang', 1, 0, 'C',1);
	// 		$pdf->Cell(3.5, 0.8, 'Harga', 1, 0, 'C',1);
	// 		$pdf->Cell(3.5, 0.8, 'Qty', 1, 0, 'C',1);
	// 		$pdf->Cell(2, 0.8, 'Diskon (%)', 1, 0, 'C',1);
	// 		$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C',1);
	// 		$pdf->SetFont('Arial','',9);
	// 		$pdf->SetTextColor(0,0,0);

	// 		$grant_total = 0;
	// 		if ($data) {
	// 			foreach ($data as $key => $val) {
	// 				$sku_code = ($val->sku_code) ? $val->sku_code : "Kosong";
	// 				$total = ($val->goods_price * $val->goods_qty) - ( ($val->goods_price * $val->goods_qty) * $val->goods_discount /100);
	// 				$grant_total+=$total;
	// 				$pdf->Cell(1,0.8,($key+1),1,0,'C');
	// 				$pdf->Cell(5,0.8,($sku_code),1,0,'C');
	// 				$pdf->Cell(9,0.8,($val->goods_name),1,0,'L');
	// 				$pdf->Cell(3.5,0.8,number_format($val->goods_price),1,0,'R');
	// 				$pdf->Cell(3.5,0.8,number_format($val->goods_qty),1,0,'R');
	// 				$pdf->Cell(2,0.8,( ($val->goods_discount) ? $val->goods_discount :"0" ),1,0,'C');
	// 				$pdf->Cell(4, 0.8, number_format(floor($total)), 1, 1, 'R');
	// 				// $pdf->ln(1);
	// 			}
	// 		}

	// 		$pdf->SetFont('Arial','B',9);
	// 		$pdf->setFillColor(155,89,182);
	// 		$pdf->SetTextColor(255,255,255);
	// 		$pdf->Cell(24,0.8,"Grant Total",1,0,'R',1);
	// 		$pdf->Cell(4, 0.8, number_format(floor($grant_total)), 1, 1, 'R',1);


	// 		$pdf->output();
	// 	}

	// }



	// function print_receive($type = 1,$data) {
	// 	// echo json_encode($data);
	// 	// if ($type == 1) {

	// 		$pdf = new FPDF("L","cm","A4");
	// 		$pdf->SetMargins(0.8,1,1);
	// 		$pdf->AliasNbPages();
	// 		$pdf->AddPage();
	// 		$pdf->SetFont('Arial','B',16);
	// 		// judul
	// 		$pdf->Cell(30,1,'Bukti Penerimaan Barang',0,1,'C');

	// 		$pdf->SetFont('Arial','B',10);
	// 		$pdf->Cell(4,0.7,"Printed On : ".date("d/m/Y"),0,0,'C');
	// 		$pdf->ln(1);

	// 		// header
	// 		$pdf->SetFont('Arial','B',11);
	// 		$pdf->setFillColor(155,89,182);
	// 		$pdf->SetTextColor(255,255,255);
	// 		$pdf->Cell(15, 1, 'Rincian Supplier', 1, 0, 'L',true);
	// 		$pdf->Cell(13, 1, 'Rincian Penerimaan Barang', 1, 0, 'L',true);
	// 		$pdf->ln(1);

	// 		$pdf->SetFont('Arial','B',9);
	// 		$pdf->setFillColor(236, 240, 241);
	// 		$pdf->SetTextColor(0,0,0);

	// 		$pdf->Cell(3, 1, 'Supplier', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(11.8, 1, $data[0]->supplier_name, 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'No PO', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->receiving_no, 0, 0, 'L',true);
	// 		$pdf->ln(1);

	// 		$pdf->Cell(5, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);


	// 		$pdf->Cell(3, 1, 'Tgl PO', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->created_date, 0, 0, 'L',true);

	// 		$pdf->ln(1);
	// 		$pdf->Cell(5, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'No Referensi', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->reference_no, 0, 0, 'L',true);

	// 		$pdf->ln(1);
	// 		$pdf->Cell(5, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

	// 		$pdf->Cell(3, 1, 'Deskripsi', array(1,1,0,0), 0, 'L',true);
	// 		$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
	// 		$pdf->Cell(9.8, 1, $data[0]->description, 0, 0, 'L',true);

	// 		$pdf->ln(2);

			
	// 		$pdf->SetFont('Arial','B',9);
	// 		$pdf->setFillColor(155,89,182);
	// 		$pdf->SetTextColor(255,255,255);
			

			
	// 		$pdf->Cell(1, 0.8, 'No', 1, 0, 'C',1);
	// 		$pdf->Cell(5, 0.8, 'Kode Barang', 1, 0, 'C',1);
	// 		$pdf->Cell(9, 0.8, 'Nama Barang', 1, 0, 'C',1);
	// 		$pdf->Cell(3.5, 0.8, 'Harga', 1, 0, 'C',1);
	// 		$pdf->Cell(3.5, 0.8, 'Qty', 1, 0, 'C',1);
	// 		$pdf->Cell(2, 0.8, 'Diskon (%)', 1, 0, 'C',1);
	// 		$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C',1);
	// 		$pdf->SetFont('Arial','',9);
	// 		$pdf->SetTextColor(0,0,0);

	// 		$grant_total = 0;
	// 		if ($data) {
	// 			foreach ($data as $key => $val) {
	// 				$sku_code = ($val->sku_code) ? $val->sku_code : "Kosong";
	// 				$total = ($val->price * $val->quantity) - ( ($val->price * $val->quantity) * $val->discount /100);
	// 				$grant_total+=$total;
	// 				$pdf->Cell(1,0.8,($key+1),1,0,'C');
	// 				$pdf->Cell(5,0.8,($sku_code),1,0,'C');
	// 				$pdf->Cell(9,0.8,($val->goods_name),1,0,'L');
	// 				$pdf->Cell(3.5,0.8,number_format($val->price),1,0,'R');
	// 				$pdf->Cell(3.5,0.8,number_format($val->quantity),1,0,'R');
	// 				$pdf->Cell(2,0.8,( ($val->discount) ? $val->discount :"0" ),1,0,'C');
	// 				$pdf->Cell(4, 0.8, number_format(floor($total)), 1, 1, 'R');
	// 				// $pdf->ln(1);
	// 			}
	// 		}

	// 		$pdf->SetFont('Arial','B',9);
	// 		$pdf->setFillColor(155,89,182);
	// 		$pdf->SetTextColor(255,255,255);
	// 		$pdf->Cell(24,0.8,"Grant Total",1,0,'R',1);
	// 		$pdf->Cell(4, 0.8, number_format(floor($grant_total)), 1, 1, 'R',1);


	// 		$pdf->output();
	// 	// }
	// }


	function print_warehouse($type = 1,$data) {
		// echo json_encode($data);
		// if ($type == 1) {

			$pdf = new FPDF("P","cm","A4");
			$pdf->SetMargins(0.8,1,1);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			// judul
			$pdf->Cell(22,1,'Bukti Pemindahan Barang',0,1,'C');

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(4,0.7,"Printed On : ".date("d/m/Y"),0,0,'C');
			$pdf->ln(1);

			// header
			$pdf->SetFont('Arial','B',11);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(19.4, 1, 'Rincian Pemindahan', 1, 0, 'L',true);
			$pdf->ln(1);

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(236, 240, 241);
			$pdf->SetTextColor(0,0,0);

			$pdf->Cell(4, 1, 'No. Transaksi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(15.2, 1, $data[0]->physical_warehouse_no, 0, 0, 'L',true);
			$pdf->ln(1);

			$pdf->Cell(4, 1, 'No. Referensi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(15.2, 1, $data[0]->reference_no, 0, 0, 'L',true);
			$pdf->ln(1);

			$pdf->Cell(4, 1, 'Gudang Sebelumnya', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(15.2, 1, $data[0]->previous_warehouse_name, 0, 0, 'L',true);
			$pdf->ln(1);

			$pdf->Cell(4, 1, 'Gudang Saat Ini', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(15.2, 1, $data[0]->actual_warehouse_name, 0, 0, 'L',true);
			$pdf->ln(1);

			$pdf->Cell(4, 1, 'Tanggal Transaksi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(15.2, 1, date('Y-m-d', strtotime($data[0]->created_date) ), 0, 0, 'L',true);
			$pdf->ln(1);			

			$pdf->Cell(4, 1, 'Deskripsi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(15.2, 1, $data[0]->desc_detail, 0, 0, 'L',true);
			$pdf->ln(2);

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			

			$pdf->SetMargins(0.8,10,1);
			$pdf->Cell(1, 0.8, 'No', 1, 0, 'C',1);
			$pdf->Cell(5, 0.8, 'Kode Barang', 1, 0, 'C',1);
			$pdf->Cell(9, 0.8, 'Nama Barang', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Qty', 1, 1, 'C',1);

			$pdf->SetFont('Arial','',9);
			$pdf->SetTextColor(0,0,0);

			if ($data) {
				foreach ($data as $key => $val) {
					$sku_code = ($val->sku_code) ? $val->sku_code : "Kosong";
					$pdf->Cell(1,0.8,($key+1),1,0,'C');
					$pdf->Cell(5,0.8,($sku_code),1,0,'C');
					$pdf->Cell(9,0.8,($val->brand_description),1,0,'L');
					$pdf->Cell(3.5,0.8,number_format($val->total_item),1,1,'R');
					// $pdf->ln(1);
				}
			}

			$pdf->output();
	}

	function print_return($type = 1,$data) {
		// echo json_encode($data);
		// if ($type == 1) {

			$pdf = new FPDF("L","cm",array(20,25));
			$pdf->SetMargins(0.8,1,1);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			// judul
			$pdf->Cell(24,1,'Bukti Retur Barang',0,1,'C');

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(4,0.7,"Printed On : ".date("d/m/Y"),0,0,'C');
			$pdf->ln(1);

			// header
			$pdf->SetFont('Arial','B',11);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(12, 1, 'Rincian Supplier', 1, 0, 'L',true);
			$pdf->Cell(11.4, 1, 'Rincian Retur', 1, 0, 'L',true);
			$pdf->ln(1);

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(236, 240, 241);
			$pdf->SetTextColor(0,0,0);

			$pdf->Cell(3, 1, 'Supplier', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(8.8, 1, $data[0]->supplier_name, 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'No Retur', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(8.2, 1, $data[0]->return_no, 0, 0, 'L',true);
			$pdf->ln(1);

			$pdf->Cell(3, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(8.8, 1, '', 0, 0, 'L',true);


			$pdf->Cell(3, 1, 'Tgl Retur', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(8.2, 1, $data[0]->return_date, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(3, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(8.8, 1, '', 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'No Referensi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(8.2, 1, $data[0]->reference_no, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(3, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(8.8, 1, '', 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'Deskripsi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(8.2, 1, $data[0]->description, 0, 0, 'L',true);

			$pdf->ln(2);

			
			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			
			$pdf->Cell(1, 0.8, 'No', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Kode Barang', 1, 0, 'C',1);
			$pdf->Cell(8, 0.8, 'Nama Barang', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Harga', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Qty', 1, 0, 'C',1);
			$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C',1);
			$pdf->SetFont('Arial','',9);
			$pdf->SetTextColor(0,0,0);

			$grant_total = 0;
			if ($data) {
				foreach ($data as $key => $val) {
					$sku_code = ($val->sku_code) ? $val->sku_code : "Kosong";
					$total = ($val->price * $val->quantity);
					$grant_total+=$total;
					$pdf->Cell(1,0.8,($key+1),1,0,'C');
					$pdf->Cell(3.5,0.8,($sku_code),1,0,'C');
					$pdf->Cell(8,0.8,($val->goods_name),1,0,'L');
					$pdf->Cell(3.5,0.8,number_format($val->price),1,0,'R');
					$pdf->Cell(3.5,0.8,number_format($val->quantity),1,0,'R');
					// $pdf->Cell(2,0.8,( ($val->discount) ? $val->discount :"0" ),1,0,'C');
					$pdf->Cell(4, 0.8, number_format(floor($total)), 1, 1, 'R');
				}
			}

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(19.5,0.8,"Grant Total",1,0,'R',1);
			$pdf->Cell(4, 0.8, number_format(floor($grant_total)), 1, 1, 'R',1);


			$pdf->output();
		// }
	}

	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

}