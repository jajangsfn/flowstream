<?php

/**
 * 
 */
class pdf 
{ 
	
	function __construct()
	{
		include_once APPPATH .'/third_party/fpdf/fpdf.php';
		date_default_timezone_set('Asia/Jakarta');
	}


	function param_paper($type = 1)
	{

		$param_header = array(
							1 => array(
										"title" => array(
							 				"width" => 2,
								 			"height" => 1,
								 			"position_x" => 2.5,
											"position_y" => 0.8
										),
										 "address" => array(
										 	 "width" => 3,
										 	 "height" =>1,
										 	 "position_x" => 2.5,
											 "position_y" => 1.4
										),
										"image" => array(
											"x"=>0.3,
											"y"=>0.5,
											"w"=>2,
											"h"=>2
											),
								),
							 2 => array(
							 			"title" => array(
							 				"width" => 30,
								 			"height" => 3.5,
								 			"position_x" => 25,
											"position_y" => 10
										),
										"address" => array(
											"width" => 30,
							 				"height" => 3.5,
							 				"position_x" => 25,
											"position_y" => 15,
										),
										"image" => array(
											"x"=>3,
											"y"=>4,
											"w"=>20,
											"h"=>20
											), 										
									  ),
							);
		// 1 pembelian
		// 2 penjualan tes
		// 3 keuangan
		$param_paper = array(
						1 => array(
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
														  								"position_y" => 2.3,
														   								"name" => 0.2,
														   								"pad" => 0.2,
														   								"val" => 3,
														   								"title" => 'Supplier',
														   								"align" => 'L',
														   								"index" => "partner_name"),
																			1 => array("position_x" => 0.2,
														  								"position_y" => 2.7,
														   								"name" => 2,
														   								"pad" => 0.2,
														   								"val" => 11.8,
														   								"title" => 'Salesman',
														   								"align" => 'L',
														   								"index" => 'salesman_name'),
														   					2 => array("position_x" => 0.2,
														   								"position_y" => 3.2,
														   								"name" => 2,
														   								"pad" => 0.2,
														   								"val" => 11.8,
														   								"title" => 'No PO',
														   								"align" => 'L',
														   								"index" => "purchase_order_no"),
														   					3 => array("position_x" => 0.2,
														   								"position_y" => 3.6,
														   								"name" => 2,
														   								"pad" => 0.2,
														   								"val" => 11.8,
														   								"title" => 'Tgl PO',
														   								"align" => 'L',
														   								"index" => "purchase_order_date"),
																		),
														   "body_position_y" => 4.5,
														   "body_position_x" => 0.3,
														   "body_ln" => 0.4,
														   "body_start_y" => 0.4,
														   "body_start_x" => 0.3,
												   "body" => array(0 => array( "title"=> "No",
												   								"width"=>0.6,
												   								"height"=>0.4,
												   								"align"=>'C',
												   							),
												   					1 => array( "title"=> "Kode Barang",
												   								"width"=>4,
												   								"height"=>0.4,
												   								"align"=>'L',
												   							),
												   					2 => array( "title"=> "Nama Barang",
												   								"width"=>7,
												   								"height"=>0.4,
												   								"align"=>'L',
												   							),
												   					3 => array( "title"=> "Harga Satuan",
												   								"width"=>2.5,
												   								"height"=>0.4,
												   								"align"=>'R',
												   							),
												   					4 => array( "title"=> "Qty (Pcs)",
												   								"width"=>2.5,
												   								"height"=>0.4,
												   								"align"=>'R',
												   							),
												   					5 => array( "title"=> "Jumlah",
												   								"width"=>3.5,
												   								"height"=>0.4,
												   								"align"=>'R',
												   							),
																	),
												   "footer" => array("footer_ln" => 0,
												   					"signature" => array("title" => "Disiapkan Oleh :",
																						  "width" => 4,
																						  "height" => 0.8,
																						  "align"=>'L',
																						  "position_x" => 0.3,
																						), 
												   					"approved_by" => array("title" => "Disahkan Oleh :",
																						  "width" => 3,
																						  "height" => 0.8,
																						  "align"=>'L',
																						  "position_x" => 5,
																						), 
												   					"total" => array("title" => "Total Rp.",
														   							"width" => 16.6,
														   							"height" => 0.6,
														   							"align"=>'R',
														   							"position_x" => 0.3),
														   			"summary" => array("title" => "",
														   								"width" => 3.5,
														   								"height" => 0.6,
														   								"align"=>'R',
														   								"position_x" => 16.9),

														   			"terbilang" => array("title" => "Terbilang",
														   							"width" => 16.6,
														   							"height" => 0.6,
														   							"align"=>'L',
														   							"position_x" => 0.3),
																	),

														), //end size a4
							 		2 => array(
											"paper"=> "a5",
										   "view" => "L",
										   "type_size" => "mm",
										   "title_paper" => array( "title" => 'Bukti Purchase Order',
																	"width" => 200,
																	"height" => 1,
																	"align" => 'C'),
										   "title_position_y" => 5,
										   "space" => 16,
										   "header"=> array(
										   					0 => array("position_x" => 0.8,
														   				"position_y" => 26,
														   				"name" => 15,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Supplier',
														   				"align" => 'L',
														   				"index" => "partner_name"),
														   	1 => array("position_x" => 0.8,
														   				"position_y" => 30,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Salesman',
														   				"align" => 'L',
														   				"index" => 'salesman_name'),
														   	2 => array("position_x" => 0.8,
														   				"position_y" => 34,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'No PO',
														   				"align" => 'L',
														   				"index" => "purchase_order_no"),
														   	3 => array("position_x" => 0.8,
														   				"position_y" => 38,
														   				"name" => 18,
														   				"pad" => 1.6,
														   				"val" => 11.8,
														   				"title" => 'Tgl PO',
														   				"align" => 'L',
														   				"index" => "purchase_order_date"),
																		),
											"body_position_y" => 43,
											"body_position_x" => 3,
											"body_ln" => 4,
											"body_start_y" => 5,
											"body_start_x" => 3,
											"body" => array(0 => array( "title"=> "No",
														   				"width"=>7,
														   				"height"=>5,
														   				"align"=>'C',
														   			  ),
															1 => array( "title"=> "Kode Barang",
														   				"width"=>23,
														   				"height"=>5,
														   				"align"=>'L',
														   			),
														   	2 => array( "title"=> "Nama Barang",
														   				"width"=>93,
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
														   	5 => array( "title"=> "Jumlah",
														   				"width"=>30,
														   				"height"=>5,
														   				"align"=>'R',
														   			),
																			),
											"footer" => array(
														  	"footer_ln" => 0.9,
														  	"signature" => array("title" => "Disiapkan Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 3,
																			),
														  	"approved_by" => array("title" => "Disahkan Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 50,
																			),
														   	"total" => array("title" => "Total Rp.",
														   				"width" => 173.3,
														   				"height" => 5,
														   				"align"=>'R',
														   				"position_x" => 3),
														   	"summary" => array("title" => "",
														   							"width" => 30,
														   							"height" => 5,
														   							"align"=>'R',
														   							"position_x" => 176),
														   	"terbilang" => array("title" => "Terbilang",
														   							"width" => 173.3,
														   							"height" => 5,
														   							"align"=>'L',
														   							"position_x" => 3.1),
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
													  								"position_y" => 2.3,
													   								"name" => 0.2,
													   								"pad" => 0.2,
													   								"val" => 3,
													   								"title" => 'Supplier',
													   								"align" => 'L',
													   								"index" => "partner_name"),
													   					2 => array("position_x" => 0.2,
													   								"position_y" => 2.9,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No PO',
													   								"align" => 'L',
													   								"index" => "receiving_no"),
													   					3 => array("position_x" => 0.2,
													   								"position_y" => 3.4,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Terima',
													   								"align" => 'L',
													   								"index" => "created_date"),
																	),
													   "body_position_y" => 4.1,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>6.3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Harga Satuan",
													   								"width"=>2.5,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					4 => array( "title"=> "Qty (Pcs)",
													   								"width"=>2,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					5 => array( "title"=> "Disc",
													   								"width"=>2.5,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					6 => array( "title"=> "Jumlah",
													   								"width"=>3.5,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
																		),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disiapkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.2,
																							  "align"=>'L',
																							  "position_x" => 0.3,

																							), 
													   					"approved_by" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.2,
																							  "align"=>'L',
																							  "position_x" => 5,

																							), 
													   					"total" => array("title" => "Total Rp.",
															   							"width" => 16.9,
															   							"height" => 0.4,
															   							"align"=>'R',
															   							"position_x" => 0.3),
															   			"summary" => array("title" => "",
															   								"width" => 3.5,
															   								"height" => 0.4,
															   								"align"=>'R',
															   								"position_x" => 17.2),

															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
												2 => array(
												"paper"=> "a5",
											   "view" => "L",
											   "type_size" => "mm",
											   "title_paper" => array( "title" => 'Bukti Terima Barang',
																		"width" => 200,
																		"height" => 1,
																		"align" => 'C'),
											   "title_position_y" => 5,
											   "space" => 22,
											   "header"=> array(
											   					0 => array("position_x" => 1.5,
															   				"position_y" => 27,
															   				"name" => 15,
															   				"pad" => 1.7,
															   				"val" => 11.8,
															   				"title" => 'Supplier',
															   				"align" => 'L',
															   				"index" => "partner_name"
															   			),
															   	1 => array("position_x" => 1.5,
															   				"position_y" => 32,
															   				"name" => 18,
															   				"pad" => 1.6,
															   				"val" => 11.8,
															   				"title" => 'No Receive',
															   				"align" => 'L',
															   				"index" => "receiving_no"
															   			),
															   	3 => array("position_x" => 1.5,
															   				"position_y" => 37,
															   				"name" => 18,
															   				"pad" => 1.6,
															   				"val" => 11.8,
															   				"title" => 'Tgl Terima',
															   				"align" => 'L',
															   				"index" => "created_date"),
																			),
												"body_position_y" => 40,
												"body_position_x" => 3,
												"body_ln" => 4,
												"body_start_y" => 5,
												"body_start_x" => 3,
												"body" => array(0 => array( "title"=> "No",
															   				"width"=>7,
															   				"height"=>5,
															   				"align"=>'C',
															   			  ),
																1 => array( "title"=> "Kode Barang",
															   				"width"=>30,
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
															  	"footer_ln" => 0.9,
															  	"signature" => array("title" => "Disiapkan Oleh :",
																					"width" => 4,
																					"height" => 0.8,
																					"align"=>'L',
																					"position_x" => 3,
																				),
															  	"approved_by" => array("title" => "Disahkan Oleh :",
																					"width" => 4,
																					"height" => 0.8,
																					"align"=>'L',
																					"position_x" => 50,
																				),
															   	"total" => array("title" => "Jumlah Rp.",
																   				"width" => 172,
																   				"height" => 5,
																   				"align"=>'R',
																   				"position_x" => 3
																   				),
															   	"summary" => array("title" => "",
															   					   "width" => 33,
															   					   "height" => 5,
															   						"align"=>'R',
															   						"position_x" => 175),
															   	"terbilang" => array("title" => "Terbilang",
															   						 "width" => 173.3,
															   						 "height" => 5,
															   						 "align"=>'L',
															   						 "position_x" => 3.1),
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
													   "space" => 2.5,
													   "header"=> array(
													   					0 => array("position_x" => 0.2,
													   								"position_y" => 2.3,
													   								"name" => 10,
													   								"pad" => 0.3,
													   								"val" => 11.8,
													   								"title" => 'No Transaksi',
													   								"align" => 'L',
													   								"index" => "physical_warehouse_no"),
													   					1 => array("position_x" => 0.2,
													   								"position_y" => 2.7,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Transaksi',
													   								"align" => 'L',
													   								"index" => "created_date"),
													   					2 => array("position_x" => 0.2,
													   								"position_y" => 3.1,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Gudang',
													   								"align" => 'L',
													   								"index" => "actual_warehouse_name"),
																	),
													   "body_position_y" => 3.9,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>4,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>12.3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Qty (Pcs)",
													   								"width"=>3.5,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   				),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disiapkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,

																							), 
													   					"approved_by" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 5,

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
															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
											2 => array("paper"=> "a5",
											   "view" => "L",
											   "type_size" => "mm",
											   "title_paper" => array( "title" => 'Bukti Penempatan Barang',
																		"width" => 200,
																		"height" => 1,
																		"align" => 'C'),
											   "title_position_y" => 5,
											   "space" => 22,
											   "header"=> array(
											   					0 => array("position_x" => 1.5,
															   				"position_y" => 26,
															   				"name" => 15,
															   				"pad" => 1.7,
															   				"val" => 11.8,
															   				"title" => 'No Transaksi',
															   				"align" => 'L',
															   				"index" => "physical_warehouse_no"
															   			),
															   	1 => array("position_x" => 1.5,
															   				"position_y" => 30,
															   				"name" => 18,
															   				"pad" => 1.6,
															   				"val" => 11.8,
															   				"title" => 'Tgl Transaksi',
															   				"align" => 'L',
															   				"index" => "created_date"
															   			),
															   	2 => array("position_x" => 1.5,
															   				"position_y" => 34,
															   				"name" => 18,
															   				"pad" => 1.6,
															   				"val" => 11.8,
															   				"title" => 'Gudang',
															   				"align" => 'L',
															   				"index" => "actual_warehouse_name"),
																			),
												"body_position_y" => 38,
												"body_position_x" => 3,
												"body_ln" => 4,
												"body_start_y" => 5,
												"body_start_x" => 3,
												"body" => array(0 => array( "title"=> "No",
															   				"width"=>7,
															   				"height"=>5,
															   				"align"=>'C',
															   			  ),
																1 => array( "title"=> "Kode Barang",
															   				"width"=>35,
															   				"height"=>5,
															   				"align"=>'L',
															   			),

															   	2 => array( "title"=> "Nama Barang",
															   				"width"=> 130,
															   				"height"=>5,
															   				"align"=>'L',
															   			  ),
															   	3 => array( "title"=> "Qty (Pcs)",
															   				"width"=>33,
															   				"height"=>5,
															   				"align"=>'R',
															   			),

																),
												"footer" => array(
															  	"footer_ln" => 0.9,
															  	"signature" => array("title" => "Disiapkan Oleh :",
																					"width" => 4,
																					"height" => 0.8,
																					"align"=>'L',
																					"position_x" => 3,
																				),
															  	"approved_by" => array("title" => "Disahkan Oleh :",
																					"width" => 4,
																					"height" => 0.8,
																					"align"=>'L',
																					"position_x" => 50,
																				),
															   	"total" => array("title" => "Jumlah (Pcs)",
																   				"width" => 172,
																   				"height" => 5,
																   				"align"=>'R',
																   				"position_x" => 3
																   				),
															   	"summary" => array("title" => "",
															   					   "width" => 33,
															   					   "height" => 5,
															   						"align"=>'R',
															   						"position_x" => 175),
															   	"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
															),

											), //end size B5
										), //end warehouse
							    "return_in"=> array(
											1 => array("paper"=>"A4",
													   "view" => "P",
													   "type_size" => "cm",
													   "title_paper" => array( "title" => 'Nota Retur Pembelian',
																				"width" => 20,
																				"height" => 0.5,
																				"align" => 'C'
																			),
													   "title_position_y" => 0.5,
													   "space" => 2.5,
													   "header"=> array(
													   					0 => array("position_x" => 0.2,
													   								"position_y" => 2.3,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Retur',
													   								"align" => 'L',
													   								"index" => "return_no"),

													   					1 => array("position_x" => 0.2,
													   								"position_y" => 2.7,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Referensi',
													   								"align" => 'L',
													   								"index" => "reference_no"),
													   					2 => array("position_x" => 0.2,
													   								"position_y" => 3.1,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Supplier',
													   								"align" => 'L',
													   								"index" => "supplier_name"),

													   					3 => array("position_x" => 0.2,
													   								"position_y" => 3.5,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Retur',
													   								"align" => 'L',
													   								"index" => "return_date_convert"),
													   				),
													   "body_position_y" => 4.3,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>3.3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>8,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Gudang",
													   								"width"=>2.5,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					4 => array( "title"=> "Harga",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					5 => array( "title"=> "Qty (Pcs)",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					6 => array( "title"=> "Total",
													   								"width"=>2.4,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   				),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,
																							),
																		"approved_by" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 5,
																							), 
													   					"total" => array("title" => "Grant Total Rp.",
															   							"width" => 18,
															   							"height" => 0.4,
															   							"align"=>'R',
															   							"position_x" => 0.3),
															   			"summary" => array("title" => "",
															   								"width" => 2.4,
															   								"height" => 0.4,
															   								"align"=>'R',
															   								"position_x" => 18.3),
															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
											2 => array("paper"=> "a5",
													   "view" => "L",
													   "type_size" => "mm",
													   "title_paper" => array( "title" => 'Nota Retur Pembelian',
																				"width" => 200,
																				"height" => 1,
																				"align" => 'C'),
													   "title_position_y" => 5,
													   "space" => 22,
													   "header"=> array(
													   					0 => array("position_x" => 1.5,
																	   				"position_y" => 26,
																	   				"name" => 15,
																	   				"pad" => 1.7,
																	   				"val" => 11.8,
																	   				"title" => 'No Retur',
																	   				"align" => 'L',
																	   				"index" => "return_no"
																	   			),
																	   	1 => array("position_x" => 1.5,
																	   				"position_y" => 30,
																	   				"name" => 18,
																	   				"pad" => 1.6,
																	   				"val" => 11.8,
																	   				"title" => 'No Referensi',
																	   				"align" => 'L',
																	   				"index" => "reference_no"
																	   			),
																	   	2 => array("position_x" => 1.5,
																	   				"position_y" => 34,
																	   				"name" => 18,
																	   				"pad" => 1.6,
																	   				"val" => 11.8,
																	   				"title" => 'Supplier',
																	   				"align" => 'L',
																	   				"index" => "supplier_name"),
													   					3 => array("position_x" => 1.5,
																	   				"position_y" => 38,
																	   				"name" => 18,
																	   				"pad" => 1.6,
																	   				"val" => 11.8,
																	   				"title" => 'Tgl Retur',
																	   				"align" => 'L',
																	   				"index" => "return_date_convert"
																	   			),
																		),
														"body_position_y" => 42,
														"body_position_x" => 3,
														"body_ln" => 4,
														"body_start_y" => 5,
														"body_start_x" => 3,
														"body" => array(0 => array( "title"=> "No",
																	   				"width"=>7,
																	   				"height"=>5,
																	   				"align"=>'C',
																	   			  ),
																		1 => array( "title"=> "Kode Barang",
																	   				"width"=>30,
																	   				"height"=>5,
																	   				"align"=>'L',
																	   			),

																	   	2 => array( "title"=> "Nama Barang",
																	   				"width"=> 70,
																	   				"height"=>5,
																	   				"align"=>'L',
																	   			  ),
																	   	3 => array( "title"=> "Gudang",
																	   				"width"=>28,
																	   				"height"=>5,
																	   				"align"=>'C',
																	   			),
																	   	4 => array( "title"=> "Harga",
																	   				"width"=>25,
																	   				"height"=>5,
																	   				"align"=>'R',
																	   			),
																	   	5 => array( "title"=> "Qty (Pcs)",
																	   				"width"=>20,
																	   				"height"=>5,
																	   				"align"=>'R',
																	   			),
																	   	6 => array( "title"=> "Total",
																	   				"width"=>25,
																	   				"height"=>5,
																	   				"align"=>'R',
																	   			),

																		),
														"footer" => array(
																	  	"footer_ln" => 0.9,
																	  	"signature" => array("title" => "Disiapkan Oleh :",
																							"width" => 4,
																							"height" => 0.8,
																							"align"=>'L',
																							"position_x" => 3,
																						),
																	  	"approved_by" => array("title" => "Disahkan Oleh :",
																							"width" => 4,
																							"height" => 0.8,
																							"align"=>'L',
																							"position_x" => 50,
																						),
																	   	"total" => array("title" => "Grant Total",
																		   				"width" => 180,
																		   				"height" => 4,
																		   				"align"=>'R',
																		   				"position_x" => 3
																		   				),
																	   	"summary" => array("title" => "",
																	   					   "width" => 25,
																	   					   "height" => 4,
																	   						"align"=>'R',
																	   						"position_x" => 183),
																	   	"terbilang" => array("title" => "Terbilang",
																	   						"width" => 16.6,
																	   						"height" => 0.6,
																	   						"align"=>'L',
																	   						"position_x" => 1.5),
																	),

													), //end size B5
												), //end return

							   ),
						2 => array("return_out"=> 
											array(
												1 => array("paper"=>"A4",
													   "view" => "P",
													   "type_size" => "cm",
													   "title_paper" => array( "title" => 'Nota Retur Penjualan',
																				"width" => 20,
																				"height" => 0.5,
																				"align" => 'C'
																			),
													   "title_position_y" => 0.5,
													   "space" => 2.5,
													   "header"=> array(
													   					0 => array("position_x" => 0.2,
													   								"position_y" => 2.3,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Retur',
													   								"align" => 'L',
													   								"index" => "return_no"),

													   					1 => array("position_x" => 0.2,
													   								"position_y" => 2.7,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Referensi',
													   								"align" => 'L',
													   								"index" => "reference_no"),
													   					2 => array("position_x" => 0.2,
													   								"position_y" => 3.1,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Supplier',
													   								"align" => 'L',
													   								"index" => "customer"),

													   					3 => array("position_x" => 0.2,
													   								"position_y" => 3.6,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Retur',
													   								"align" => 'L',
													   								"index" => "return_date_convert"),
													   				),
													   "body_position_y" => 4.5,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>3.3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>6,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Gudang",
													   								"width"=>2.5,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					4 => array( "title"=> "Harga",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					5 => array( "title"=> "Qty (Pcs)",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					6 => array( "title"=> "Disc",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					7 => array( "title"=> "Total",
													   								"width"=>2.7,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   				),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disiapkan Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 0.3,
																			),
														  				"approved_by" => array("title" => "Disetujui Oleh :",
																				"width" => 4,
																				"height" => 0.8,
																				"align"=>'L',
																				"position_x" => 5,
																			),
													   					"total" => array("title" => "Grant Total Rp.",
															   							"width" => 17.8,
															   							"height" => 0.4,
															   							"align"=>'R',
															   							"position_x" => 0.3),
															   			"summary" => array("title" => "",
															   								"width" => 2.7,
															   								"height" => 0.4,
															   								"align"=>'R',
															   								"position_x" => 18.1),
															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
												2 => array("paper"=> "a5",
														   "view" => "L",
														   "type_size" => "mm",
														   "title_paper" => array( "title" => 'Nota Retur Penjualan',
																					"width" => 200,
																					"height" => 1,
																					"align" => 'C'),
														   "title_position_y" => 5,
														   "space" => 22,
														   "header"=> array(
														   					0 => array("position_x" => 1.5,
																		   				"position_y" => 26,
																		   				"name" => 15,
																		   				"pad" => 1.7,
																		   				"val" => 11.8,
																		   				"title" => 'No Retur',
																		   				"align" => 'L',
																		   				"index" => "return_no"
																		   			),
																		   	1 => array("position_x" => 1.5,
																		   				"position_y" => 30,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'No Referensi',
																		   				"align" => 'L',
																		   				"index" => "reference_no"
																		   			),
																		   	2 => array("position_x" => 1.5,
																		   				"position_y" => 34,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Customer',
																		   				"align" => 'L',
																		   				"index" => "customer"),
														   					3 => array("position_x" => 1.5,
																		   				"position_y" => 38,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Tgl Retur',
																		   				"align" => 'L',
																		   				"index" => "return_date_convert"
																		   			),
																			),
															"body_position_y" => 42,
															"body_position_x" => 3,
															"body_ln" => 4,
															"body_start_y" => 5,
															"body_start_x" => 3,
															"body" => array(0 => array( "title"=> "No",
																		   				"width"=>7,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			  ),
																			1 => array( "title"=> "Kode Barang",
																		   				"width"=>25,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			),

																		   	2 => array( "title"=> "Nama Barang",
																		   				"width"=> 60,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			  ),
																		   	3 => array( "title"=> "Gudang",
																		   				"width"=>28,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			),
																		   	4 => array( "title"=> "Harga",
																		   				"width"=>25,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),
																		   	5 => array( "title"=> "Qty (Pcs)",
																		   				"width"=>20,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),
																		   	6 => array( "title"=> "Disc",
																		   				"width"=>20,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),
																		   	7 => array( "title"=> "Total",
																		   				"width"=>20,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),

																			),
															"footer" => array(
																		  	"footer_ln" => 0.9,
																		  	"signature" => array("title" => "Disiapkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 3,
																							),
																		  	"approved_by" => array("title" => "Disahkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 50,
																							),
																		   	"total" => array("title" => "Grant Total",
																			   				"width" => 185,
																			   				"height" => 4,
																			   				"align"=>'R',
																			   				"position_x" => 3
																			   				),
																		   	"summary" => array("title" => "",
																		   					   "width" => 20,
																		   					   "height" => 4,
																		   						"align"=>'R',
																		   						"position_x" => 188),
																		   	"terbilang" => array("title" => "Terbilang",
																		   						"width" => 16.6,
																		   						"height" => 0.6,
																		   						"align"=>'L',
																		   						"position_x" => 1.5),
																		),

														), //end size B5
													), //end return
									"order_request_out"=> array(
												1 => array("paper"=>"A4",
													   "view" => "P",
													   "type_size" => "cm",
													   "title_paper" => array( "title" => 'Bukti Order Request',
																				"width" => 20,
																				"height" => 0.5,
																				"align" => 'C'
																			),
													   "title_position_y" => 0.5,
													   "space" => 2.5,
													   "header"=> array(
													   					0 => array("position_x" => 0.2,
													   								"position_y" => 2.3,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Order',
													   								"align" => 'L',
													   								"index" => "order_no"),

													   					1 => array("position_x" => 0.2,
													   								"position_y" => 2.7,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Customer',
													   								"align" => 'L',
													   								"index" => "partner_name"),

													   					2 => array("position_x" => 0.2,
													   								"position_y" => 3.1,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Order',
													   								"align" => 'L',
													   								"index" => "order_date"),
													   				),
													   "body_position_y" => 4.1,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>4.3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>8,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Satuan",
													   								"width"=>2,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					4 => array( "title"=> "Jumlah Order",
													   								"width"=>2.3,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					5 => array( "title"=> "Jumlah Tersedia",
													   								"width"=>2.5,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   				),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disetujui Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,

																							),
																		"approved_by" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 5,

																							),  
													   					"total" => array("title" => "Grant Total Rp.",
															   							"width" => 17.8,
															   							"height" => 0.4,
															   							"align"=>'R',
															   							"position_x" => 0.3),
															   			"summary" => array("title" => "",
															   								"width" => 2.7,
															   								"height" => 0.4,
															   								"align"=>'R',
															   								"position_x" => 18.1),
															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
												2 => array("paper"=> "a5",
														   "view" => "L",
														   "type_size" => "mm",
														   "title_paper" => array( "title" => 'Bukti Order Request',
																					"width" => 200,
																					"height" => 1,
																					"align" => 'C'),
														   "title_position_y" => 5,
														   "space" => 22,
														   "header"=> array(
														   					0 => array("position_x" => 1.5,
																		   				"position_y" => 27,
																		   				"name" => 15,
																		   				"pad" => 1.7,
																		   				"val" => 11.8,
																		   				"title" => 'No Order',
																		   				"align" => 'L',
																		   				"index" => "order_no"
																		   			),
																		   	1 => array("position_x" => 1.5,
																		   				"position_y" => 31,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Customer',
																		   				"align" => 'L',
																		   				"index" => "partner_name"),
														   					2 => array("position_x" => 1.5,
																		   				"position_y" => 36,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Tgl Order',
																		   				"align" => 'L',
																		   				"index" => "order_date"
																		   			),
																			),
															"body_position_y" => 41,
															"body_position_x" => 3,
															"body_ln" => 4,
															"body_start_y" => 5,
															"body_start_x" => 3,
															"body" => array(0 => array( "title"=> "No",
																		   				"width"=>7,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			  ),
																			1 => array( "title"=> "Kode Barang",
																		   				"width"=>40,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			),

																		   	2 => array( "title"=> "Nama Barang",
																		   				"width"=>80,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			  ),																	   	
																		   3 => array( "title"=> "Satuan",
																		   				"width"=>20,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			),
																		   4 => array( "title"=> "Jumlah Order",
																		   				"width"=>25,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),
																		   5 => array( "title"=> "Jumlah Tersedia",
																		   				"width"=>25,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),

																			),
															"footer" => array(
																		  	"footer_ln" => 0.9,
																		  	"signature" => array("title" => "Disiapkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 3,
																							),
																		  	"approved_by" => array("title" => "Disahkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 50,
																							),
																		   	"total" => array("title" => "Grant Total",
																			   				"width" => 197,
																			   				"height" => 4,
																			   				"align"=>'R',
																			   				"position_x" => 3
																			   				),
																		   	"summary" => array("title" => "",
																		   					   "width" => 21,
																		   					   "height" => 4,
																		   						"align"=>'R',
																		   						"position_x" => 188),
																		   	"terbilang" => array("title" => "Terbilang",
																		   						"width" => 16.6,
																		   						"height" => 0.6,
																		   						"align"=>'L',
																		   						"position_x" => 1.5),
																		),

														), //end size B5
													), //end return
									"order_request_out_fix"=> array(
												1 => array("paper"=>"A4",
													   "view" => "P",
													   "type_size" => "cm",
													   "title_paper" => array( "title" => 'Bukti Order Request',
																				"width" => 20,
																				"height" => 0.5,
																				"align" => 'C'
																			),
													   "title_position_y" => 0.5,
													   "space" => 2.5,
													   "header"=> array(
													   					0 => array("position_x" => 0.2,
													   								"position_y" => 1.9,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Order',
													   								"align" => 'L',
													   								"index" => "order_no"),

													   					1 => array("position_x" => 0.2,
													   								"position_y" => 2.3,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Customer',
													   								"align" => 'L',
													   								"index" => "partner_name"),

													   					2 => array("position_x" => 0.2,
													   								"position_y" => 2.7,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Order',
													   								"align" => 'L',
													   								"index" => "order_date"),
													   				),
													   "body_position_y" => 3.7,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>3.3,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>10,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Satuan",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					4 => array( "title"=> "Jumlah Order",
													   								"width"=>4,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   				),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disetujui Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,

																							),
																		"approved_by" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 50,

																							),  
													   					"total" => array("title" => "Grant Total Rp.",
															   							"width" => 15,
															   							"height" => 0.4,
															   							"align"=>'R',
															   							"position_x" => 0.3),
															   			"summary" => array("title" => "",
															   								"width" => 2.7,
															   								"height" => 0.4,
															   								"align"=>'R',
															   								"position_x" => 18.1),
															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
												2 => array("paper"=> "a5",
														   "view" => "L",
														   "type_size" => "mm",
														   "title_paper" => array( "title" => 'Bukti Order Request',
																					"width" => 200,
																					"height" => 1,
																					"align" => 'C'),
														   "title_position_y" => 5,
														   "space" => 22,
														   "header"=> array(
														   					0 => array("position_x" => 1.5,
																		   				"position_y" => 26,
																		   				"name" => 15,
																		   				"pad" => 1.7,
																		   				"val" => 11.8,
																		   				"title" => 'No Order',
																		   				"align" => 'L',
																		   				"index" => "order_no"
																		   			),
																		   	1 => array("position_x" => 1.5,
																		   				"position_y" => 30,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Customer',
																		   				"align" => 'L',
																		   				"index" => "partner_name"),
														   					2 => array("position_x" => 1.5,
																		   				"position_y" => 34,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Tgl Order',
																		   				"align" => 'L',
																		   				"index" => "order_date"
																		   			),
																			),
															"body_position_y" => 38,
															"body_position_x" => 3,
															"body_ln" => 4,
															"body_start_y" => 5,
															"body_start_x" => 3,
															"body" => array(0 => array( "title"=> "No",
																		   				"width"=>7,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			  ),
																			1 => array( "title"=> "Kode Barang",
																		   				"width"=>40,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			),

																		   	2 => array( "title"=> "Nama Barang",
																		   				"width"=> 100,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			  ),																	   	
																		   3 => array( "title"=> "Satuan",
																		   				"width"=>20,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			),
																		   4 => array( "title"=> "Jumlah Order",
																		   				"width"=>25,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),
																			),
															"footer" => array(
																		  	"footer_ln" => 0.9,
																		  	"signature" => array("title" => "Disiapkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 3,
																							),
																		  	"approved_by" => array("title" => "Disahkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 50,
																							),
																		   	"total" => array("title" => "Grant Total",
																			   				"width" => 192,
																			   				"height" => 4,
																			   				"align"=>'R',
																			   				"position_x" => 3
																			   				),
																		   	"summary" => array("title" => "",
																		   					   "width" => 21,
																		   					   "height" => 4,
																		   						"align"=>'R',
																		   						"position_x" => 188),
																		   	"terbilang" => array("title" => "Terbilang",
																		   						"width" => 16.6,
																		   						"height" => 0.6,
																		   						"align"=>'L',
																		   						"position_x" => 1.5),
																		),

														), //end size B5
													), //end return
									"checksheet_out"=> array(
												1 => array("paper"=>"A4",
													   "view" => "P",
													   "type_size" => "cm",
													   "title_paper" => array( "title" => 'Checksheet Order',
																				"width" => 20,
																				"height" => 0.5,
																				"align" => 'C'
																			),
													   "title_position_y" => 0.5,
													   "space" => 2.5,
													   "header"=> array(
													   					0 => array("position_x" => 0.2,
													   								"position_y" => 2.3,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'No Order',
													   								"align" => 'L',
													   								"index" => "order_no"),

													   					1 => array("position_x" => 0.2,
													   								"position_y" => 2.7,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Customer',
													   								"align" => 'L',
													   								"index" => "partner_name"),

													   					2 => array("position_x" => 0.2,
													   								"position_y" => 3.1,
													   								"name" => 2,
													   								"pad" => 0.2,
													   								"val" => 11.8,
													   								"title" => 'Tgl Order',
													   								"align" => 'L',
													   								"index" => "order_date"),
													   				),
													   "body_position_y" => 4,
													   "body_position_x" => 0.3,
													   "body_ln" => 0.4,
													   "body_start_y" => 0.5,
													   "body_start_x" => 0.3,
													   "body" => array(
													   					0 => array( "title"=> "No",
													   								"width"=>0.6,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					1 => array( "title"=> "Kode Barang",
													   								"width"=>3.6,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					2 => array( "title"=> "Nama Barang",
													   								"width"=>9,
													   								"height"=>0.5,
													   								"align"=>'L',
													   							),
													   					3 => array( "title"=> "Satuan",
													   								"width"=>1.8,
													   								"height"=>0.5,
													   								"align"=>'C',
													   							),
													   					4 => array( "title"=> "Jumlah Order",
													   								"width"=>2.5,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   					5 => array( "title"=> "Jumlah Tersedia",
													   								"width"=>2.6,
													   								"height"=>0.5,
													   								"align"=>'R',
													   							),
													   				),
													   				
													   "footer" => array("footer_ln" => 0.09,
													   					"signature" => array("title" => "Disiapkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,

																							), 
													   					"approved_by" => array("title" => "Disahkan Oleh :",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 4.5,

																							), 
													   					"total" => array("title" => "Grant Total Rp.",
															   							"width" => 17.8,
															   							"height" => 0.4,
															   							"align"=>'R',
															   							"position_x" => 0.3),
															   			"summary" => array("title" => "",
															   								"width" => 2.7,
															   								"height" => 0.4,
															   								"align"=>'R',
															   								"position_x" => 18.1),
															   			"terbilang" => array("title" => "Terbilang",
															   							"width" => 16.6,
															   							"height" => 0.6,
															   							"align"=>'L',
															   							"position_x" => 0.3),
																		),

															), //end size a4
												2 => array("paper"=> "a5",
														   "view" => "L",
														   "type_size" => "mm",
														   "title_paper" => array( "title" => 'Checksheet Order',
																					"width" => 200,
																					"height" => 1,
																					"align" => 'C'),
														   "title_position_y" => 5,
														   "space" => 22,
														   "header"=> array(
														   					0 => array("position_x" => 1.5,
																		   				"position_y" => 26,
																		   				"name" => 15,
																		   				"pad" => 1.7,
																		   				"val" => 11.8,
																		   				"title" => 'No Order',
																		   				"align" => 'L',
																		   				"index" => "order_no"
																		   			),
																		   	1 => array("position_x" => 1.5,
																		   				"position_y" => 30,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Customer',
																		   				"align" => 'L',
																		   				"index" => "partner_name"),
														   					2 => array("position_x" => 1.5,
																		   				"position_y" => 34,
																		   				"name" => 18,
																		   				"pad" => 1.6,
																		   				"val" => 11.8,
																		   				"title" => 'Tgl Order',
																		   				"align" => 'L',
																		   				"index" => "order_date"
																		   			),
																			),
															"body_position_y" => 38,
															"body_position_x" => 3,
															"body_ln" => 4,
															"body_start_y" => 5,
															"body_start_x" => 3,
															"body" => array(0 => array( "title"=> "No",
																		   				"width"=>7,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			  ),
																			1 => array( "title"=> "Kode Barang",
																		   				"width"=>40,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			),

																		   	2 => array( "title"=> "Nama Barang",
																		   				"width"=> 80,
																		   				"height"=>5,
																		   				"align"=>'L',
																		   			  ),																	   	
																		   3 => array( "title"=> "Satuan",
																		   				"width"=>25,
																		   				"height"=>5,
																		   				"align"=>'C',
																		   			),
																		   4 => array( "title"=> "Jumlah Order",
																		   				"width"=>27,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),
																		   	5 => array( "title"=> "Jumlah Tersedia",
																		   				"width"=>26,
																		   				"height"=>5,
																		   				"align"=>'R',
																		   			),

																			),
															"footer" => array(
																		  	"footer_ln" => 0.9,
																		  	"signature" => array("title" => "Disiapkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 3,
																							),
																		  	"approved_by" => array("title" => "Disahkan Oleh :",
																								"width" => 4,
																								"height" => 0.8,
																								"align"=>'L',
																								"position_x" => 50,
																							),
																		   	"total" => array("title" => "Grant Total",
																			   				"width" => 205,
																			   				"height" => 4,
																			   				"align"=>'R',
																			   				"position_x" => 3
																			   				),
																		   	"summary" => array("title" => "",
																		   					   "width" => 23,
																		   					   "height" => 4,
																		   						"align"=>'R',
																		   						"position_x" => 188),
																		   	"terbilang" => array("title" => "Terbilang",
																		   						"width" => 16.6,
																		   						"height" => 0.6,
																		   						"align"=>'L',
																		   						"position_x" => 1.5),
																		),

														), //end size B5
													), //end return
									"pos_out"=> array(
														1 => array("paper"=>"A4",
															   "view" => "P",
															   "type_size" => "cm",
															   "title_paper" => array( "title" => 'Bukti Point Of Sales',
																						"width" => 20,
																						"height" => 0.5,
																						"align" => 'C'
																					),
															   "title_position_y" => 0.5,
															   "space" => 2.5,
															   "header"=> array(
															   					0 => array("position_x" => 0.2,
															   								"position_y" => 2.3,
															   								"name" => 2,
															   								"pad" => 0.2,
															   								"val" => 11.8,
															   								"title" => 'No Faktur',
															   								"align" => 'L',
															   								"index" => "invoice_no"),
															   					1 => array("position_x" => 0.2,
															   								"position_y" => 2.7,
															   								"name" => 2,
															   								"pad" => 0.2,
															   								"val" => 11.8,
															   								"title" => 'No Order',
															   								"align" => 'L',
															   								"index" => "order_no"),

															   					2 => array("position_x" => 0.2,
															   								"position_y" => 3.1,
															   								"name" => 2,
															   								"pad" => 0.2,
															   								"val" => 11.8,
															   								"title" => 'Customer',
															   								"align" => 'L',
															   								"index" => "partner_name"),

															   					3 => array("position_x" => 14,
															   								"position_y" => 2.3,
															   								"name" => 2,
															   								"pad" => 0.2,
															   								"val" => 11.8,
															   								"title" => 'Tgl Faktur',
															   								"align" => 'L',
																							"index" => "updated_date"
																							),
																				4 => array("position_x" => 14,
															   								"position_y" => 2.7,
															   								"name" => 2,
															   								"pad" => 0.2,
															   								"val" => 11.8,
															   								"title" => 'No. Faktur Pajak',
															   								"align" => 'L',
															   								"index" => "nomor_faktur_pajak"),
															   				),
															   "body_position_y" => 4,
															   "body_position_x" => 0.3,
															   "body_ln" => 0.4,
															   "body_start_y" => 0.5,
															   "body_start_x" => 0.3,
															   "body" => array(
															   					0 => array( "title"=> "No",
															   								"width"=>0.6,
															   								"height"=>0.5,
															   								"align"=>'C',
															   							),
															   					1 => array( "title"=> "Kode Barang",
															   								"width"=>3,
															   								"height"=>0.5,
															   								"align"=>'L',
															   							),
															   					2 => array( "title"=> "Nama Barang",
															   								"width"=>6.5,
															   								"height"=>0.5,
															   								"align"=>'L',
															   							),
															   					3 => array( "title"=> "Satuan",
															   								"width"=>1.8,
															   								"height"=>0.5,
															   								"align"=>'C',
															   							),
															   					4 => array( "title"=> "Qty",
															   								"width"=>2,
															   								"height"=>0.5,
															   								"align"=>'R',
																						   ),
																				5 => array( "title"=> "Harga",
																						   "width"=>2,
																						   "height"=>0.5,
																						   "align"=>'R',
																					   ),
																				6 => array( "title"=> "PPN",
																					   "width"=>1.5,
																					   "height"=>0.5,
																					   "align"=>'C',
																				),
																				7 => array( "title"=> "Disc",
																					   "width"=>1.5,
																					   "height"=>0.5,
																					   "align"=>'C',
																				),
																				8 => array( "title"=> "Sub Total",
																						   "width"=>3,
																						   "height"=>0.5,
																						   "align"=>'R',
																					   ),


															   				),
															   				
															   "footer" => array("footer_ln" => 0.09,
															   					"signature" => array("title" => "Diterima Oleh :",
																									  "width" => 4,
																									  "height" => 0.8,
																									  "align"=>'L',
																									  "position_x" => 1.0,

																									), 
															   					"approved_by" => array("title" => "Supplier",
																									  "width" => 4,
																									  "height" => 0.8,
																									  "align"=>'L',
																									  "position_x" => 8,

																									), 
															   					"total" => array("title" => "Grant Total",
																	   							"width" => 17.4,
																	   							"height" => 0.4,
																	   							"align"=>'R',
																	   							"position_x" => 0.3),
																	   			"summary" => array("title" => "",
																	   								"width" => 3,
																	   								"height" => 0.4,
																	   								"align"=>'R',
																	   								"position_x" => 17.7),
																	   			"terbilang" => array("title" => "Terbilang",
																	   							"width" => 16.6,
																	   							"height" => 0.6,
																	   							"align"=>'L',
																	   							"position_x" => 0.3),
																				),

																	), //end size a4
														2 => array("paper"=> "A5",
																   "view" => "L",
																   "type_size" => "mm",
																   "title_paper" => array( "title" => 'Bukti Point Of Sales',
																							"width" => 200,
																							"height" => 1,
																							"align" => 'C'),
																   "title_position_y" => 5,
																   "space" => 25,
																   "header"=> array(
																   					0 => array("position_x" => 1.5,
																				   				"position_y" => 27,
																				   				"name" => 15,
																				   				"pad" => 1.7,
																				   				"val" => 11.8,
																				   				"title" => 'No Faktur',
																				   				"align" => 'L',
																				   				"index" => "invoice_no"
																				   			),
																   					1 => array("position_x" => 1.5,
																				   				"position_y" => 31,
																				   				"name" => 15,
																				   				"pad" => 1.7,
																				   				"val" => 11.8,
																				   				"title" => 'No Order',
																				   				"align" => 'L',
																				   				"index" => "order_no"
																				   			),
																				   	2 => array("position_x" => 1.5,
																				   				"position_y" => 35,
																				   				"name" => 18,
																				   				"pad" => 1.6,
																				   				"val" => 11.8,
																				   				"title" => 'Kepada',
																				   				"align" => 'L',
																				   				"index" => "partner_name"),
																   					3 => array("position_x" => 145,
																				   				"position_y" => 31,
																				   				"name" => 20,
																				   				"pad" => 1.6,
																				   				"val" => 10.8,
																				   				"title" => 'Tgl Faktur',
																				   				"align" => 'L',
																				   				"index" => "updated_date"
																							   ),
																					4 => array("position_x" => 145,
																							   "position_y" => 27,
																							   "name" => 20,
																							   "pad" => 1.6,
																							   "val" => 10.8,
																							   "title" => 'No. Faktur Pajak',
																							   "align" => 'L',
																							   "index" => "nomor_faktur_pajak"
																						   ),
																					),
																	"body_position_y" => 40,
																	"body_position_x" => 3,
																	"body_ln" => 4,
																	"body_start_y" => 5,
																	"body_start_x" => 3,
																	"body" => array(0 => array( "title"=> "No",
																				   				"width"=>7,
																				   				"height"=>5,
																				   				"align"=>'C',
																				   			  ),
																					1 => array( "title"=> "Kode Barang",
																				   				"width"=>28,
																				   				"height"=>5,
																				   				"align"=>'L',
																				   			),

																				   	2 => array( "title"=> "Nama Barang",
																				   				"width"=> 66,
																				   				"height"=>5,
																				   				"align"=>'L',
																				   			  ),					   	
																				    3 => array( "title"=> "Satuan",
																				   				"width"=>15,
																				   				"height"=>5,
																				   				"align"=>'C',
																				   			),
																				    4 => array( "title"=> "Qty",
																				   				"width"=>15,
																				   				"height"=>5,
																				   				"align"=>'R',
																							   ),
																					5 => array( "title"=> "Harga",
																							   "width"=>20,
																							   "height"=>5,
																							   "align"=>'R',
																						   ),
																					6 => array( "title"=> "PPN",
																						   "width"=>15,
																						   "height"=>5,
																						   "align"=>'R',
																					   ),
																					7 => array( "title"=> "Disc",
																						   "width"=>15,
																						   "height"=>5,
																						   "align"=>'R',
																					   ),
																					8 => array( "title"=> "Sub Total",
																					   "width"=>25,
																					   "height"=>5,
																					   "align"=>'R',
																				       ),
																					),
																	"footer" => array(
																				  	"footer_ln" => 0.9,
																				  	"signature" => array("title" => "Diterima Oleh :",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 10,
																									),
																				  	"approved_by" => array("title" => "Supplier",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 65,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 181,
																					   				"height" => 4,
																					   				"align"=>'R',
																					   				"position_x" => 3
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 25,
																				   					   "height" => 4,
																				   						"align"=>'R',
																				   						"position_x" => 184),
																				   	"terbilang" => array("title" => "Terbilang",
																				   						"width" => 16.6,
																				   						"height" => 0.6,
																				   						"align"=>'L',
																				   						"position_x" => 1.5),
																				),

														), //end size B5
													), //end return
									"daily_sales_out" => 
												array( 1 => array("paper"=>"A4",
															   "view" => "P",
															   "type_size" => "cm",
															   "title_paper" => 
															   		array( 
															   			"title" => 'Laporan Penjualan Harian',
																		"width" => 20,
																		"height" => 0.3,
																		"align" => 'C'
																		),
															    "title_position_y" => 0.5,
															    "space" => 0.2,
															    "header"=> array(),
																"body_position_y" => 3,
																"body_position_x" => 0.5,
																"body_ln" => 0.5,
																"body_start_y" => 0.5,
																"body_start_x" => 0.5,
																"body" => array(0 => array( "title"=> "Tanggal",
																				   				"width"=>4,
																				   				"height"=>0.5,
																				   				"align"=>'L',
																				   			  ),
																				1 => array( "title"=> "Customer",
																				   				"width"=>6,
																				   				"height"=>0.5,
																				   				"align"=>'L',
																				   			),
																			   	2 => array( "title"=> "No. Nota",
																			   				"width"=> 6,
																			   				"height"=>0.5,
																			   				"align"=>'C',
																			   			  ),															  
																				3 => array( "title"=> "Total",
																							"width"=>4,
																							"height"=>0.5,
																				   			"align"=>'R',
																				   			),
																				),
																	"footer" => array(
																				  	"footer_ln" => 0.01,
																				  	"signature" => array("title" => "",
																										"width" => 4,
																										"height" => 0.3,
																										"align"=>'L',
																										"position_x" => 0.3,
																									),
																				  	"approved_by" => array("title" => "",
																										"width" => 4,
																										"height" => 0.3,
																										"align"=>'L',
																										"position_x" => 5,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 16,
																					   				"height" => 0.5,
																					   				"align"=>'R',
																					   				"position_x" => 0.5,
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 4,
																				   					   "height" => 0.5,
																				   						"align"=>'R',
																				   						"position_x" => 16.5),
																				   	"terbilang" => array("title" => "",
																				   						"width" => 16.6,
																				   						"height" => 0.7,
																				   						"align"=>'L',
																				   						"position_x" => 0.5),
																				),
															),
													   2 => array("paper"=> "a5",
																   "view" => "L",
																   "type_size" => "mm",
																   "title_paper" => array( "title" => 'Laporan Penjualan Harian',
																							"width" => 200,
																							"height" => 1,
																							"align" => 'C'),
																   "title_position_y" => 6,
																   "space" => 22,
																   "header"=> array(),
																	"body_position_y" => 27,
																	"body_position_x" => 7,
																	"body_ln" => 4,
																	"body_start_y" => 5,
																	"body_start_x" => 7,
																	"body" => array(0 => array( "title"=> "Tanggal",
																				   				"width"=>40,
																				   				"height"=>5,
																				   				"align"=>'L',
																				   			  ),
																					1 => array( "title"=> "Customer",
																				   				"width"=>70,
																				   				"height"=>5,
																				   				"align"=>'L',
																				   			),

																				   	2 => array( "title"=> "No. Nota",
																				   				"width"=> 50,
																				   				"height"=>5,
																				   				"align"=>'C',
																				   			  ),																	   	
																				    3 => array( "title"=> "Total",
																				   				"width"=>35,
																				   				"height"=>5,
																				   				"align"=>'R',
																				   			),

																					),
																	"footer" => array(
																				  	"footer_ln" => 0.9,
																				  	"signature" => array("title" => "",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 7,
																									),
																				  	"approved_by" => array("title" => "",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 50,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 160,
																					   				"height" => 4,
																					   				"align"=>'R',
																					   				"position_x" => 7
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 35,
																				   					   "height" => 4,
																				   						"align"=>'R',
																				   						"position_x" =>167),
																				   	"terbilang" => array("title" => "Terbilang",
																				   						"width" => 16.6,
																				   						"height" => 0.6,
																				   						"align"=>'L',
																				   						"position_x" => 7),
																				),

														), //end size B5
													),
									"daily_sales_out_full" => 
												array( 
													1 => array("paper"=>"A4",
															   "view" => "P",
															   "type_size" => "cm",
															   "title_paper" => 
															   		array( 
															   			"title" => 'Laporan Penjualan Harian',
																		"width" => 20,
																		"height" => 0.3,
																		"align" => 'C'
																		),
															   "title_position_y" => 0.5,
															   "space" => 2,
															   "header"=> array(
															   					0 => array("position_x" => 0.3,
															   								"position_y" => 2.3,
															   								"name" => 6,
															   								"pad" => 0.2,
															   								"val" => 1.8,
															   								"title" => 'No Faktur',
															   								"align" => 'L',
															   								"index" => "invoice_no"),
															   					1 => array("position_x" => 0.3,
															   								"position_y" => 2.7,
															   								"name" => 10,
															   								"pad" => 0.2,
															   								"val" => 1.8,
															   								"title" => 'Tgl',
															   								"align" => 'L',
															   								"index" => "updated_date"),

															   					2 => array("position_x" => 0.3,
															   								"position_y" => 3.1,
															   								"name" => 2,
															   								"pad" => 0.2,
															   								"val" => 11.8,
															   								"title" => 'Customer',
															   								"align" => 'L',
															   								"index" => "partner_name"),
															   				),
																"body_position_y" => 3.9,
																"body_position_x" => 0.5,
																"body_ln" => 0.4,
																"body_start_y" => 0.5,
																"body_start_x" => 0.5,
																"body" => array(
																				0 => array( "title"=> "Kode SKU",
																							"width"=>4,
																							"height"=>0.5,
																				   			"align"=>'L',
																				   			),
																				1 => array( "title"=> "Nama Barang",
																							"width"=>6.5,
																							"height"=>0.5,
																				   			"align"=>'L',
																				   			),
																				2 => array( "title"=> "Harga",
																							"width"=>2.5,
																							"height"=>0.5,
																				   			"align"=>'R',
																				   			),
																				3 => array( "title"=> "Qty",
																							"width"=>2.5,
																							"height"=>0.5,
																				   			"align"=>'R',
																				  			),
																				4 => array( "title"=> "Disc (%)",
																							"width"=>1.5,
																							"height"=>0.5,
																				   			"align"=>'C',
																				   			),
																				5 => array( "title"=> "Total",
																							"width"=>3,
																							"height"=>0.5,
																				   			"align"=>'R',
																				   			),
																				),
																	"footer" => array(
																				  	"footer_ln" => 0.1,
																				  	"signature" => array("title" => "",
																										"width" => 4,
																										"height" => 0.3,
																										"align"=>'L',
																										"position_x" => 0.5,
																									),
																				  	"approved_by" => array("title" => "",
																										"width" => 4,
																										"height" => 0.3,
																										"align"=>'L',
																										"position_x" => 5,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 17,
																					   				"height" => 0.5,
																					   				"align"=>'R',
																					   				"position_x" => 0.5,
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 3,
																				   					   "height" => 0.5,
																				   						"align"=>'R',
																				   						"position_x" => 17.5),
																				   	"terbilang" => array("title" => "Terbilang",
																				   						"width" => 16.6,
																				   						"height" => 0.7,
																				   						"align"=>'L',
																				   						"position_x" => 0.5),
																				),
															),
													   2 => array("paper"=> "a5",
																   "view" => "L",
																   "type_size" => "mm",
																   "title_paper" => array( "title" => 'Laporan Penjualan Harian',
																							"width" => 200,
																							"height" => 1,
																							"align" => 'C'),
																   "title_position_y" => 5,
																   "space" => 22,
																   "header"=> array(
															   					0 => array("position_x" => 5.4,
															   								"position_y" => 27,
															   								"name" => 6,
															   								"pad" => 2,
															   								"val" => 1.8,
															   								"title" => 'No Faktur',
															   								"align" => 'L',
															   								"index" => "invoice_no"),
															   					1 => array("position_x" => 5.4,
															   								"position_y" => 31,
															   								"name" => 10,
															   								"pad" => 2,
															   								"val" => 1.8,
															   								"title" => 'Tgl',
															   								"align" => 'L',
															   								"index" => "updated_date"),

															   					2 => array("position_x" => 5.4,
															   								"position_y" => 35,
															   								"name" => 2,
															   								"pad" => 2,
															   								"val" => 11.8,
															   								"title" => 'Customer',
															   								"align" => 'L',
															   								"index" => "partner_name"),
															   				),
																	"body_position_y" => 39,
																	"body_position_x" => 7,
																	"body_ln" => 4.5,
																	"body_start_y" => 5.5,
																	"body_start_x" => 7,
																	"body" => array(
																				0 => array( "title"=> "Kode SKU",
																							"width"=>40,
																							"height"=>5.5,
																				   			"align"=>'L',
																				   			),
																				1 => array( "title"=> "Nama Barang",
																							"width"=>70.5,
																							"height"=>5.5,
																				   			"align"=>'L',
																				   			),
																				2 => array( "title"=> "Harga",
																							"width"=>20.5,
																							"height"=>5.5,
																				   			"align"=>'R',
																				   			),
																				3 => array( "title"=> "Qty",
																							"width"=>20.5,
																							"height"=>5.5,
																				   			"align"=>'R',
																				  			),
																				4 => array( "title"=> "Disc (%)",
																							"width"=>20.5,
																							"height"=>5.5,
																				   			"align"=>'C',
																				   			),
																				5 => array( "title"=> "Total",
																						"width"=>25,
																							"height"=>5.5,
																				   			"align"=>'R',
																				   			),
																				),
																	"footer" => array(
																				  	"footer_ln" => 0.9,
																				  	"signature" => array("title" => "",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 10,
																									),
																				  	"approved_by" => array("title" => "",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 50,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 172.1,
																					   				"height" => 4,
																					   				"align"=>'R',
																					   				"position_x" => 7
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 25,
																				   					   "height" => 4,
																				   						"align"=>'R',
																				   						"position_x" =>179),
																				   	"terbilang" => array("title" => "Terbilang",
																				   						"width" => 16.6,
																				   						"height" => 0.6,
																				   						"align"=>'L',
																				   						"position_x" => 7),
																				),

														), //end size B5
													),
									"monthly_sales_out" => array( 
													1 => array("paper"=>"A4",
															   "view" => "P",
															   "type_size" => "cm",
															   "title_paper" => 
															   		array( 
															   			"title" => 'Laporan Penjualan Bulanan',
																		"width" => 20,
																		"height" => 0.3,
																		"align" => 'C'
																		),
															    "title_position_y" => 0.5,
															    "space" => 0.3,
															    "header"=> array(),
																"body_position_y" => 3,
																"body_position_x" => 2,
																"body_ln" => 0.4,
																"body_start_y" => 0.7,
																"body_start_x" => 2,
																"body" => array(0 => array( "title"=> "Tanggal",
																				   				"width"=>7,
																				   				"height"=>0.7,
																				   				"align"=>'L',
																				   			  ),
																				1 => array( "title"=> "Jumlah Transaksi",
																				   				"width"=>3,
																				   				"height"=>0.7,
																				   				"align"=>'C',
																				   			),
																				2 => array( "title"=> "Total",
																							"width"=>7,
																							"height"=>0.7,
																				   			"align"=>'R',
																				   			),
																				),
																	"footer" => array(
																				  	"footer_ln" => 0.3,
																				  	"signature" => array("title" => "",
																										"width" => 4,
																										"height" => 0.3,
																										"align"=>'L',
																										"position_x" => 3,
																									),
																				  	"approved_by" => array("title" => "",
																										"width" => 4,
																										"height" => 0.3,
																										"align"=>'L',
																										"position_x" => 50,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 10,
																					   				"height" => 0.5,
																					   				"align"=>'R',
																					   				"position_x" => 2,
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 7,
																				   					   "height" => 0.5,
																				   						"align"=>'R',
																				   						"position_x" => 12),
																				   	"terbilang" => array("title" => "Terbilang",
																				   						"width" => 16.6,
																				   						"height" => 0.3,
																				   						"align"=>'L',
																				   						"position_x" => 2),
																				),
															),
													   2 => array("paper"=> "a5",
																   "view" => "L",
																   "type_size" => "mm",
																   "title_paper" => array( "title" => 'Laporan Penjualan Bulanan',
																							"width" => 200,
																							"height" => 1,
																							"align" => 'C'),
																   "title_position_y" => 5,
																   "space" => 22,
																   "header"=> array(),
																	"body_position_y" => 27,
																	"body_position_x" => 10,
																	"body_ln" => 4,
																	"body_start_y" => 5,
																	"body_start_x" => 10,
																	"body" => array(0 => array( "title"=> "Tanggal",
																				   				"width"=>70,
																				   				"height"=>5,
																				   				"align"=>'L',
																				   			  ),
																					1 => array( "title"=> "Jumlah Transaksi",
																				   				"width"=>50,
																				   				"height"=>5,
																				   				"align"=>'C',
																				   			),

																				    2 => array( "title"=> "Total",
																				   				"width"=>70,
																				   				"height"=>5,
																				   				"align"=>'R',
																				   			),

																					),
																	"footer" => array(
																				  	"footer_ln" => 0.9,
																				  	"signature" => array("title" => "",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 10,
																									),
																				  	"approved_by" => array("title" => "",
																										"width" => 4,
																										"height" => 0.8,
																										"align"=>'L',
																										"position_x" => 50,
																									),
																				   	"total" => array("title" => "Grant Total",
																					   				"width" => 120,
																					   				"height" => 4,
																					   				"align"=>'R',
																					   				"position_x" => 10
																					   				),
																				   	"summary" => array("title" => "",
																				   					   "width" => 70,
																				   					   "height" => 4,
																				   						"align"=>'R',
																				   						"position_x" =>130),
																				   	"terbilang" => array("title" => "Terbilang",
																				   						"width" => 16.6,
																				   						"height" => 0.6,
																				   						"align"=>'L',
																				   						"position_x" => 10),
																				),

														), //end size B5
													),
								),
						3 => array(
									"neraca_saldo"=> array(
										 1 => array("paper"=>"A4",
																   "view" => "P",
																   "type_size" => "cm",
																   "title_paper" => array( "title" => 'Neraca Saldo',
																							"width" => 20,
																							"height" => 0.5,
																							"align" => 'C'),
																   "title_position_y" => 0.5,
																   "space" => 1.7,
																   "header"=> array(
																				   0 => array("position_x" => 0.2,
																							  "position_y" => 2.3,
																							   "name" => 0.2,
																							   "pad" => 0.2,
																							   "val" => 3,
																							   "title" => 'Hal',
																							   "align" => 'L',
																							   "index" => "page"),
																					1 => array("position_x" => 0.2,
																							   "position_y" => 2.7,
																								"name" => 2,
																								"pad" => 0.2,
																								"val" => 11.8,
																								"title" => 'Periode',
																								"align" => 'L',
																								"index" => 'periode'),
																					2 => array("position_x" => 15.9,
																							  "position_y" => 2.3,
																							   "name" => 2,
																							   "pad" => 0.2,
																							   "val" => 11.8,
																							   "title" => 'Tanggal',
																							   "align" => 'L',
																							   "index" => 'date'),
																				    3=> array("position_x" => 15.9,
																							   "position_y" => 2.7,
																							   "name" => 2,
																							   "pad" => 0.2,
																							   "val" => 11.8,
																							   "title" => 'Waktu',
																							   "align" => 'L',
																							   "index" => "time"),
																			),
															   "body_position_y" => 3.8,
															   "body_position_x" => 0.3,
															   "body_ln" => 0.4,
															   "body_start_y" => 0.4,
															   "body_start_x" => 0.3,
													   "body" => array(0 => array( "title"=> "No",
																					   "width"=>0.6,
																					   "height"=>0.4,
																					   "align"=>'C',
																				   ),
																		   1 => array( "title"=> "Kode",
																					   "width"=>3,
																					   "height"=>0.4,
																					   "align"=>'L',
																				   ),
																		   2 => array( "title"=> "Nama Rekening",
																					   "width"=>5,
																					   "height"=>0.4,
																					   "align"=>'L',
																				   ),
																		   3 => array( "title"=> "Saldo Bulan Lalu",
																					   "width"=>2.8,
																					   "height"=>0.4,
																					   "align"=>'R',
																				   ),
																		   4 => array( "title"=> "Debit",
																					   "width"=>2.5,
																					   "height"=>0.4,
																					   "align"=>'R',
																				   ),
																		   5 => array( "title"=> "Kredit",
																					   "width"=>2.5,
																					   "height"=>0.4,
																					   "align"=>'R',
																				   ),
																		   6 => array( "title"=> "Saldo Bulan Ini",
																				   		"width"=>2.8,
																				   		"height"=>0.4,
																				   		"align"=>'R',
																			   ),
																		),
													   "footer" => array("footer_ln" => 0,
																		   "signature" => array("title" => "",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,
																							), 
																		   "approved_by" => array("title" => "",
																							  "width" => 3,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 5,
																							), 
																		   "total" => array("title" => "Jumlah",
																						   "width" => 8.4,
																						   "height" => 0.6,
																						   "align"=>'R',
																						   "position_x" => 0.3
																						),
																		   "summary" => array("title" => "",
																							   "width" => 3.5,
																							   "height" => 0.6,
																							   "align"=>'R',
																							   "position_x" => 16.9
																							),
																			"total_saldo_debit" => array(
																							"title" => "",
																							"width" => 2.5,
																							"height" => 0.6,
																							"align"=>'R',
																							"position_x" => 11.7
																						),
																			"total_saldo_credit" => array(
																							"title" => "",
																							"width" => 2.5,
																							"height" => 0.6,
																							"align"=>'R',
																							"position_x" => 14.2),
																			"total_saldo_bulan_ini" => array(
																							"title" => "",
																							"width" => 2.8,
																							"height" => 0.6,
																							"align"=>'R',
																							"position_x" => 8.9
																						),
																			"total_saldo_bulan_lalu" => array(
																							"title" => "",
																							"width" => 2.8,
																							"height" => 0.6,
																							"align"=>'R',
																							"position_x" => 16.7
																						),
																		   "terbilang" => array("title" => "Terbilang",
																						   "width" => 16.6,
																						   "height" => 0.6,
																						   "align"=>'L',
																						   "position_x" => 0.3),
																		),
	
															), //end size a4
										 2 => array(
											   "paper"=> "a5",
											   "view" => "L",
											   "type_size" => "mm",
											   "title_paper" => array( "title" => 'Neraca Saldo',
																		"width" => 200,
																		"height" => 1,
																		"align" => 'C'),
											   "title_position_y" => 5,
											   "space" => 16,
											   "header"=> array(
																   0 => array("position_x" => 0.8,
																			   "position_y" => 26,
																			   "name" => 15,
																			   "pad" => 1.6,
																			   "val" => 11.8,
																			   "title" => 'Hal',
																			   "align" => 'L',
																			   "index" => "page"
																			),
																   1 => array("position_x" => 0.8,
																			   "position_y" => 30,
																			   "name" => 18,
																			   "pad" => 1.6,
																			   "val" => 11.8,
																			   "title" => 'Periode',
																			   "align" => 'L',
																			   "index" => "periode"
																			),
																	2 => array("position_x" => 158.8,
																				"position_y" => 26,
																				"name" => 18,
																				"pad" => 1.6,
																				"val" => 11.8,
																				"title" => 'Tanggal',
																				"align" => 'L',
																				"index" => "date"
																		 ),
																   3 => array("position_x" => 158.8,
																			   "position_y" => 30,
																			   "name" => 18,
																			   "pad" => 1.6,
																			   "val" => 11.8,
																			   "title" => 'Waktu',
																			   "align" => 'L',
																			   "index" => "time"
																			),
																),
												"body_position_y" => 35,
												"body_position_x" => 1,
												"body_ln" => 4,
												"body_start_y" => 5,
												"body_start_x" => 1,
												"body" => array(0 => array( "title"=> "No",
																			   "width"=>7,
																			   "height"=>5,
																			   "align"=>'C',
																			 ),
																1 => array( "title"=> "Kode",
																			   "width"=>23,
																			   "height"=>5,
																			   "align"=>'L',
																		   ),
																   2 => array( "title"=> "Nama Rekening",
																			   "width"=>53,
																			   "height"=>5,
																			   "align"=>'L',
																			 ),
																   3 => array( "title"=> "Saldo Bulan Lalu",
																			   "width"=>30,
																			   "height"=>5,
																			   "align"=>'R',
																			 ),
																   4 => array( "title"=> "Debit",
																			   "width"=>25,
																			   "height"=>5,
																			   "align"=>'R',
																		   ),
																   5 => array( "title"=> "Kredit",
																			   "width"=>25,
																			   "height"=>5,
																			   "align"=>'R',
																		   ),
																   6 => array( "title"=> "Saldo Bulan Ini",
																		   		"width"=>30,
																		   		"height"=>5,
																		   		"align"=>'R',
																			   ),
																),
												"footer" => array(
																  "footer_ln" => 0.9,
																  "signature" => array("title" => "",
																					"width" => 4,
																					"height" => 0.8,
																					"align"=>'L',
																					"position_x" => 1,
																				),
																  "approved_by" => array("title" => "",
																					"width" => 4,
																					"height" => 0.8,
																					"align"=>'L',
																					"position_x" => 50,
																				),
																   "total" => array("title" => "Jumlah",
																			   "width" => 83,
																			   "height" => 10,
																			   "align"=>'R',
																			   "position_x" => 1
																			),
																	"total_saldo_bulan_lalu" => 
																			array("title" => "",
																			   "width" => 30,
																			   "height" => 5,
																			   "align"=>'R',
																			   "position_x" => 84
																			 ),
																	"total_saldo_debit" => 
																			   	array("title" => "",
																					  "width" => 25,
																					  "height" => 5,
																					  "align"=>'R',
																					  "position_x" => 114
																					),
																	"total_saldo_credit" => 
																				array("title" => "",
																					  "width" => 25,
																					  "height" => 5,
																					  "align"=>'R',
																					  "position_x" => 139),
																	"total_saldo_bulan_ini" => 
																				array("title" => "",
																					  "width" => 30,
																					  "height" => 5,
																					  "align"=>'R',
																					  "position_x" => 164
																					),
																   "terbilang" => array("title" => "Terbilang",
																						   "width" => 173.3,
																						   "height" => 5,
																						   "align"=>'L',
																						   "position_x" => 3.1),
																),
	
											), //end size B5
										), //end po
									"delivery" => array(
												1 => array("paper"=>"A4",
																   "view" => "P",
																   "type_size" => "cm",
																   "title_paper" => array( "title" => 'Bukti Kirim',
																							"width" => 20,
																							"height" => 0.5,
																							"align" => 'C'),
																   "title_position_y" => 0.5,
																   "space" => 2.4,
																   "header"=> array(
																				   0 => array("position_x" => 0.2,
																							  "position_y" => 2.3,
																							   "name" => 0.2,
																							   "pad" => 0.2,
																							   "val" => 3,
																							   "title" => 'NO. Pengiriman',
																							   "align" => 'L',
																							   "index" => "delivery_no"),
																					1 => array("position_x" => 0.2,
																							   "position_y" => 2.7,
																								"name" => 2,
																								"pad" => 0.2,
																								"val" => 11.8,
																								"title" => 'No. PO',
																								"align" => 'L',
																								"index" => 'invoice_no'),
																					2 => array("position_x" => 0.2,
																							  "position_y" => 3.1,
																							   "name" => 2,
																							   "pad" => 0.2,
																							   "val" => 11.8,
																							   "title" => 'Tujuan',
																							   "align" => 'L',
																							   "index" => 'name'),
																				    3=> array("position_x" => 0.2,
																							   "position_y" => 3.5,
																							   "name" => 2,
																							   "pad" => 0.2,
																							   "val" => 11.8,
																							   "title" => 'Alamat',
																							   "align" => 'L',
																							   "index" => "address_partner"),
																					4=> array("position_x" => 16.2,
																							   "position_y" => 2.3,
																							   "name" => 2,
																							   "pad" => 0.2,
																							   "val" => 11.8,
																							   "title" => 'Tgl Kirim',
																							   "align" => 'L',
																							   "index" => "delivery_date"),
																					5=> array("position_x" => 16.2,
																							   "position_y" => 2.7,
																							   "name" => 2,
																							   "pad" => 0.2,
																							   "val" => 11.8,
																							   "title" => 'No. Mobil',
																							   "align" => 'L',
																							   "index" => "car_number"),
																			),
															   "body_position_y" => 4.3,
															   "body_position_x" => 0.3,
															   "body_ln" => 0.4,
															   "body_start_y" => 0.4,
															   "body_start_x" => 0.3,
													   "body" => array(0 => array( "title"=> "No",
																					   "width"=>0.6,
																					   "height"=>0.4,
																					   "align"=>'C',
																				   ),
																		   1 => array( "title"=> "Kode",
																					   "width"=>5,
																					   "height"=>0.4,
																					   "align"=>'L',
																				   ),
																		   2 => array( "title"=> "Nama Barang",
																					   "width"=>12,
																					   "height"=>0.4,
																					   "align"=>'L',
																				   ),
																		   3 => array( "title"=> "Qty(Pcs)",
																					   "width"=>2.8,
																					   "height"=>0.4,
																					   "align"=>'R',
																				   ),
																		),
													   "footer" => array("footer_ln" => 0,
																		   "signature" => array("title" => "",
																							  "width" => 4,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 0.3,
																							), 
																		   "approved_by" => array("title" => "",
																							  "width" => 3,
																							  "height" => 0.8,
																							  "align"=>'L',
																							  "position_x" => 5,
																							), 
																		   "total" => array("title" => "Jumlah",
																						   "width" => 8.4,
																						   "height" => 0.6,
																						   "align"=>'R',
																						   "position_x" => 0.3
																						),
																		   "summary" => array("title" => "",
																							   "width" => 3.5,
																							   "height" => 0.6,
																							   "align"=>'R',
																							   "position_x" => 16.9
																							),
																		   "terbilang" => array("title" => "Terbilang",
																						   "width" => 16.6,
																						   "height" => 0.6,
																						   "align"=>'L',
																						   "position_x" => 0.3),
																		),
	
															), //end size a4
											2 => array(
													"paper"=> "a5",
													"view" => "L",
													"type_size" => "mm",
													"title_paper" => array( "title" => 'Bukti Kirim',
																			"width" => 200,
																			"height" => 1,
																			"align" => 'C'),
													"title_position_y" => 5,
													"space" => 26,
													"header"=> array(
																		0 => array("position_x" => 3.8,
																					"position_y" => 26,
																					"name" => 15,
																					"pad" => 1.6,
																					"val" => 11.8,
																					"title" => 'No. Pengiriman',
																					"align" => 'L',
																					"index" => "delivery_no"
																				),
																		1 => array("position_x" => 3.8,
																					"position_y" => 30,
																					"name" => 18,
																					"pad" => 1.6,
																					"val" => 11.8,
																					"title" => 'No. PO',
																					"align" => 'L',
																					"index" => "invoice_no"
																				),
																		2 => array("position_x" => 3.8,
																					"position_y" => 34,
																					"name" => 18,
																					"pad" => 1.6,
																					"val" => 11.8,
																					"title" => 'Tujuan',
																					"align" => 'L',
																					"index" => "name"
																			),
																		3 => array("position_x" => 3.8,
																					"position_y" => 38,
																					"name" => 18,
																					"pad" => 1.6,
																					"val" => 11.8,
																					"title" => 'Alamat',
																					"align" => 'L',
																					"index" => "address_partner"
																				),
																		4 => array("position_x" => 150.8,
																				"position_y" => 26,
																				"name" => 18,
																				"pad" => 1.8,
																				"val" => 11.8,
																				"title" => 'Tgl Kirim',
																				"align" => 'L',
																				"index" => "delivery_date"
																			),
																		5 => array("position_x" => 150.8,
																			"position_y" => 30,
																			"name" => 18,
																			"pad" => 1.6,
																			"val" => 11.8,
																			"title" => 'No. Mobil',
																			"align" => 'L',
																			"index" => "car_number"
																		),
																	),
													"body_position_y" => 43,
													"body_position_x" => 3.8,
													"body_ln" => 4,
													"body_start_y" => 5,
													"body_start_x" => 3.8,
													"body" => array(0 => array( "title"=> "No",
																					"width"=>7,
																					"height"=>5,
																					"align"=>'C',
																				),
																	1 => array( "title"=> "Kode",
																					"width"=>35,
																					"height"=>5,
																					"align"=>'L',
																				),
																		2 => array( "title"=> "Nama Barang",
																					"width"=>125,
																					"height"=>5,
																					"align"=>'L',
																				),
																		3 => array( "title"=> "Qty(Pcs)",
																					"width"=>30,
																					"height"=>5,
																					"align"=>'R',
																				),
																	),
													"footer" => array(
															   "footer_ln" => 0.9,
															   "signature" => array("title" => "",
																				 "width" => 4,
																				 "height" => 0.8,
																				 "align"=>'L',
																				 "position_x" => 1,
																			 ),
															   "approved_by" => array("title" => "",
																				 "width" => 4,
																				 "height" => 0.8,
																				 "align"=>'L',
																				 "position_x" => 50,
																			 ),
																"total" => array("title" => "Jumlah",
																			"width" => 83,
																			"height" => 10,
																			"align"=>'R',
																			"position_x" => 1
																		 ),
																"terbilang" => array("title" => "Terbilang",
																						"width" => 173.3,
																						"height" => 5,
																						"align"=>'L',
																						"position_x" => 3.1),
															 ),
 
										 ), //end size B5
									),
								   ),
					
					);


		
		
					return array( 	'setting_header' => $param_header,
						'setting_paper'=>$param_paper[$type]
					);
	}


	// type 1 pembelian
	// type 2 penjualan
	// type 3 keuangan
	function dynamic_print($type = 1,$type_print = "po_in", $data) {
		// get paper 
		$setting_paper   = $this->param_paper($type);
		$paper_reference = $setting_paper['setting_paper'];
		$header_reference= $setting_paper['setting_header']; 
		// echo json_encode($data);exit;
		
		// count data
		$count_data = count($data);

		// if data > 10 then use A4 paper
		// else use B4 paper
		$use_paper = 1;
		if ( $count_data <= 10 ) {
			$use_paper = 2;
		}
		
		// initilization paper
		$pdf = new FPDF($paper_reference[$type_print][$use_paper]['view'], 
						$paper_reference[$type_print][$use_paper]['type_size'], 
						$paper_reference[$type_print][$use_paper]['paper']);

		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',13);


		
		// set position to top
		$pdf->SetY($paper_reference[$type_print][$use_paper]['title_position_y']);
		// image
		$pdf->Image(base_url()."assets/img/logoBW.png",
					$header_reference[$use_paper]['image']['x'],
					$header_reference[$use_paper]['image']['y'],
					$header_reference[$use_paper]['image']['w'],
					$header_reference[$use_paper]['image']['h']);
		// set tile header
		$pdf->Cell($paper_reference[$type_print][$use_paper]['title_paper']['width'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['height'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['title'],0,1,
					$paper_reference[$type_print][$use_paper]['title_paper']['align']);
		
		// set branch name
		$pdf->SetFont('Arial','B',13);
		// get userdata
		$CI =& get_instance();
		$branch_name 	= ($CI->session->userdata('branch_name')) ? $CI->session->userdata('branch_name') : "PD. Parahyangan Djaya";
		$branch_address = ($CI->session->userdata('branch_address')) ? $CI->session->userdata('branch_address') : "Jl Terusan Kiaracondong";
		
		$pdf->SetY($header_reference[$use_paper]['title']['position_y']);
		$pdf->SetX($header_reference[$use_paper]['title']['position_x']);
		$pdf->Cell($header_reference[$use_paper]['title']['width'], 
					$header_reference[$use_paper]['title']['height'], 
					$branch_name,0,1,'L');

		// set branch address
		$pdf->SetFont('Arial','',10);
		$pdf->SetY($header_reference[$use_paper]['address']['position_y']);
		$pdf->SetX($header_reference[$use_paper]['address']['position_x']);
		$pdf->Cell($header_reference[$use_paper]['address']['width'], 
					$header_reference[$use_paper]['address']['height'], 
					$branch_address,0,1,'L');		
		// set header 
		$pdf->SetFont('Arial','B',9);
			foreach ($paper_reference[$type_print][$use_paper]['header'] as $key => $value) {
				$pdf->SetY($value['position_y']);
				$pdf->SetX($value['position_x']);

				$pdf->Cell($value['name'], 1,
				 		   $value['title'],0,0,
				 		   $value['align']);

				$pdf->SetY($value['position_y']);
				$pdf->SetX($value['position_x']+$paper_reference[$type_print][$use_paper]['space']);

				$pdf->Cell($value['pad'], 1,
				 		   ':',0,0,
				 		   $value['align']);
 
				$pdf->Cell($value['val'], 1,
				 		   $data[0][$value['index']],0,0,
				 		   $value['align']);
				$pdf->ln(0.7);	
			}


		// set body title
		$pdf->ln(0.8);	
		$pdf->SetY($paper_reference[$type_print][$use_paper]['body_position_y']);
		$pdf->SetX($paper_reference[$type_print][$use_paper]['body_position_x']);
		$pdf->SetFont('Arial','B',9);
		foreach ($paper_reference[$type_print][$use_paper]['body'] as $key => $value) {
			$pdf->Cell($value['width'], $value['height'], $value['title'],1,0,'C');	
		}

		$pdf->ln($paper_reference[$type_print][$use_paper]['body_start_y']);	
	
		$pdf->SetFont('Arial','',8);

		$grant_total = 0;

		$total_row = count( $data );
		// PO
		if ($type_print == 'po_in'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}
				

				$total = $val['goods_price'] * $val['goods_qty'] - (($val['goods_price'] * $val['goods_qty'] * $val['goods_discount']) /100);
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['barcode'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['goods_name']. " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['goods_price']),$border,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['goods_qty']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][4]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   number_format($total),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][5]['align']);	

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}

			}
		}

		// ORDER REQUEST
		if (in_array($type_print, array("order_request_out", "order_request_out_fix", "checksheet_out"))){
			$show_tersedia = ($type_print == 'checksheet_out' ) ? true : false;
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}


				$total = $val['price'] * $val['quantity'] - ( ($val['price'] * $val['quantity'] * $val['discount']) / 100);
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['barcode'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['brand_description'] . " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   $val['unit_initial'],$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][3]['align']);

				
				// if not yet checksheet process
				if (in_array($type_print, array("order_request_out", "checksheet_out"))) {
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['quantity']),$border,0,$paper_reference[$type_print][$use_paper]['body'][4]['align']);

					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   !empty($val['checksheet_qty']) ? number_format(intval($val['checksheet_qty'])) : ''
						   ,$border,0,$paper_reference[$type_print][$use_paper]['body'][5]['align']);
						   
				}else if ($type_print == "order_request_out_fix") {
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format(intval($val['checksheet_qty'])),$border,0,$paper_reference[$type_print][$use_paper]['body'][4]['align']);
					
					
				}
				

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}

			}
		}

		if ($type_print == 'receive_in'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}


				$total = ($val['price'] * $val['receive_qty']) - (($val['price'] * $val['receive_qty']) * $val['discount'] /100 );
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['barcode'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['goods_name'] . " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['price']),$border,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['receive_qty']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][4]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   number_format($val['discount']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][5]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][6]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][6]['height'], 
						   number_format($total),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][6]['align']);	

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}
			}
		}

		// warehouse
		if ($type_print == 'warehouse_in'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}

				$total = $val['total_item'];
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['barcode'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['brand_description'] . " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['total_item']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][3]['align']);	

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}
			}
		}


		// retur
		if ($type_print == 'return_in' || $type_print == 'return_out'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}

				$total = $val['total'];
				if ($type_print == 'return_out') {
					$total = $val['total'] - (($val['total'] * $val['discount'])/100);
				}
				
				$grant_total+=$total;

				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['barcode'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['goods_name'] . " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   $val['warehouse_name'],$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][3]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['price']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][4]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   number_format($val['quantity']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][5]['align']);
				if ($type_print == "return_out") {
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][6]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][6]['height'], 
						   number_format($val['discount']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][6]['align']);


					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][7]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][7]['height'], 
						   number_format($total),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][7]['align']);
				}else {
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][6]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][6]['height'], 
						   number_format($total),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][6]['align']);
				}

				

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}
			}
		}

		// POS
		if ($type_print == 'pos_out'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				} else {
					$border = 'L,R';
				}
				

				$total = $val['price'] * $val['quantity'] - ( ($val['price'] * $val['quantity'] * $val['discount']) / 100) + ( $val['ppn'] * $val['quantity']);
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['barcode'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['brand_description'] . " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   $val['unit_initial'],$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][3]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['quantity']),$border,0,$paper_reference[$type_print][$use_paper]['body'][4]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   number_format($val['price']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][5]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][6]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][6]['height'], 
						   number_format($val['ppn']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][6]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][7]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][7]['height'], 
						   number_format($val['discount']),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][7]['align']);	

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][8]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][8]['height'], 
						   number_format($total),$border,0,
						   $paper_reference[$type_print][$use_paper]['body'][8]['align']);	

				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}
			}
		}

		// daily sales
		if (in_array($type_print, array("daily_sales_out","daily_sales_out_full"))){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}
				

				$total = $val['total'];
				$grant_total+=$total;

				if ($type_print == "daily_sales_out"){
					$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
								$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
								date('Y-m-d', strtotime($val['created_date'])),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
					
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
							   $val['partner_name'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	

					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
							   $val['invoice_no'],$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
					
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
							   number_format($val['total']),$border,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);
					$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
				}

				if ($type_print == "daily_sales_out_full"){

					$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
								$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
								$val['sku_code'],$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
					
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
							   $val['brand_description'] . " (".$val['sku_code'] . ")",$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	

					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
							   number_format($val['price']),$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);	
					
					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
							   number_format($val['quantity']),$border,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);

					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
							   number_format($val['discount']),$border,0,$paper_reference[$type_print][$use_paper]['body'][4]['align']);

					$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
							   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
							   number_format($val['total']),$border,0,$paper_reference[$type_print][$use_paper]['body'][5]['align']);


					$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);
				}

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}

			}
		}

		// monthly sales
		if ($type_print == 'monthly_sales_out'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}
				

				$total = $val['total'];
				$grant_total+=$total;
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							date('Y-m-d', strtotime($val['created_date'])),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['total_trans'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   number_format($val['total']),$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);
				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}

			}
		}

		// neraca saldo
		if ($type_print == 'neraca_saldo'){
			$total_saldo_debit = 0;
            $total_saldo_credit= 0;
			$total_saldo_bulan_lalu = 0;
			$total_saldo_bulan_lalu_d = 0;
			$total_saldo_bulan_lalu_c = 0;
			$total_saldo_bulan_ini = 0;
			$total_saldo_bulan_ini_d = 0;
			$total_saldo_bulan_ini_c = 0;
			$grant_total = 0;
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}

                $position    = (is_null($val['position']) || $val['position'] == 'D') ? 'D' : 'K';
                $saldo_akhir = $position == 'D' ? 
                                            ($val['saldo_bulan_lalu'] + $val['total_debit'] - $val['total_credit'])
                                            :($val['saldo_bulan_lalu'] + $val['total_credit'] - $val['total_debit']);
                $total_saldo_debit+= $val['total_debit'];
				$total_saldo_credit+= $val['total_credit'];
				
				//saldo bulan lalu
				$total_saldo_bulan_lalu+=$val['saldo_bulan_lalu'];
				//jika posisinya debit maka jumlahkan saldo bulan lalu bertipe debit
				//jika posisinya credit maka jumlahkan saldo bulan lalu bertipe credit
				$total_saldo_bulan_lalu_d+= $position == 'D' ? $val['saldo_bulan_lalu'] : 0;
				$total_saldo_bulan_lalu_c+= $position == 'K' ? $val['saldo_bulan_lalu'] : 0;
				  
				//saldo bulan ini
				$total_saldo_bulan_ini+=$saldo_akhir;
				//jika posisinya debit maka jumlahkan saldo bulan ini bertipe debit
				//jika posisinya credit maka jumlahkan saldo bulan ini bertipe credit
				$total_saldo_bulan_ini_d+= $position == 'D' ? $saldo_akhir : 0;
				$total_saldo_bulan_ini_c+= $position == 'K' ? $saldo_akhir : 0;

				$grant_total = $total_saldo_bulan_ini;
				

				
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							($key+1),$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['acc_code'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['acc_name'],$border,0,$paper_reference[$type_print][$use_paper]['body'][2]['align']);

				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['saldo_bulan_lalu']) ." ".$position,$border,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);
				
			   	$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][4]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][4]['height'], 
						   number_format($val['total_debit']),$border,0,$paper_reference[$type_print][$use_paper]['body'][4]['align']);
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][5]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][5]['height'], 
						   number_format($val['total_credit']),$border,0,$paper_reference[$type_print][$use_paper]['body'][5]['align']);
				
			    $pdf->Cell($paper_reference[$type_print][$use_paper]['body'][6]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][6]['height'], 
						   number_format($saldo_akhir) . " ".$position,$border,0,$paper_reference[$type_print][$use_paper]['body'][6]['align']);	
			
				
				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}

			}
		}

		// delivery
		if ($type_print == 'delivery'){
			foreach ($data as $key => $val) {

				// if first row then set border top left and right
				// if last row then set border bottom left right
				// else set border to 0
				if ( $key == 0)
				{
					$border = 'L,R,T';
				} else if ( ($key+1) == $total_row) {
					$border ='L,B,R';
				}else {
					$border = 'L,R';
				}
				if ( count($data) == 1) {
					$border = 1;
				}
			
				$pdf->SetX($paper_reference[$type_print][$use_paper]['body_start_x']);
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][0]['width'], 
							$paper_reference[$type_print][$use_paper]['body'][0]['height'], 
							$key+1,$border,0,$paper_reference[$type_print][$use_paper]['body'][0]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][1]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][1]['height'], 
						   $val['plu_code'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][2]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][2]['height'], 
						   $val['brand_description'],$border,0,$paper_reference[$type_print][$use_paper]['body'][1]['align']);	
				
				$pdf->Cell($paper_reference[$type_print][$use_paper]['body'][3]['width'], 
						   $paper_reference[$type_print][$use_paper]['body'][3]['height'], 
						   number_format($val['qty']),$border,0,$paper_reference[$type_print][$use_paper]['body'][3]['align']);
				$pdf->ln($paper_reference[$type_print][$use_paper]['body_ln']);

				// set margin bottom
				// jika data / row lebih dari atau sama dengan 10
				if ( ($key+1) >= 10) {
					$pdf->SetAutoPageBreak(true,0);
				}

			}
		}

		// set signature
		$pdf->SetFont('Arial','',8);		
		$pdf->ln($paper_reference[$type_print][$use_paper]['footer']['footer_ln']);
		// total

		if (!in_array($type_print, array("order_request_out", 
										"order_request_out",
										"order_request_out_fix", 
										"checksheet_out",
										"neraca_saldo",
										"delivery"))) {
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
	
		}else if (in_array($type_print, array("neraca_saldo"))) {
			$pdf->SetFont('Arial','B',9);	
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total']['position_x']);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total']['width'], 
					   $paper_reference[$type_print][$use_paper]['footer']['total']['height'], 
					   $paper_reference[$type_print][$use_paper]['footer']['total']['title'],'',0,
					   $paper_reference[$type_print][$use_paper]['footer']['total']['align']);
			
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['position_x']);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['width'], 
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['height'], 
						number_format($total_saldo_bulan_lalu_d) ." D",0,0,
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['align']);

			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_debit']['position_x']);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total_saldo_debit']['width'], 
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_debit']['height'], 
						number_format($total_saldo_debit),0,0,
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_debit']['align']);
			
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_credit']['position_x']);
						$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total_saldo_credit']['width'], 
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_credit']['height'], 
						number_format($total_saldo_credit),0,0,
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_credit']['align']);
			
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['position_x']);
						$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['width'], 
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['height'], 
						number_format($total_saldo_bulan_ini_d) ." D",0,1,
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['align']);
			
			
			//line ke 2
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total']['position_x']);
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['position_x']);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['width'], 
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['height'], 
						number_format($total_saldo_bulan_lalu_c) ." K",0,0,
						$paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_lalu']['align']);
			
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_credit']['position_x']);
			
		   
		    $pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['position_x']);
					   $pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['width'], 
					   $paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['height'], 
					   number_format($total_saldo_bulan_ini_c) ." K",0,1,
					   $paper_reference[$type_print][$use_paper]['footer']['total_saldo_bulan_ini']['align']);

		}else {
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['total']['position_x']);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['total']['width'], 
					   $paper_reference[$type_print][$use_paper]['footer']['total']['height'], 
					   '','T',0,
					   $paper_reference[$type_print][$use_paper]['footer']['total']['align']);
		}

		// terbilang
		if (!in_array($type_print, array("warehouse_in", 
										"order_request_out", 
										"order_request_out_fix", 
										"checksheet_out",
										"neraca_saldo",
										"delivery"))) {
			$pdf->ln($paper_reference[$type_print][$use_paper]['footer']['footer_ln'] * 3);
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['terbilang']['position_x']);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['terbilang']['width'], 
					   $paper_reference[$type_print][$use_paper]['footer']['terbilang']['height'], 
					   "TERBILANG : ".ucwords($this->terbilang(ceil($grant_total))),0,1,
					   $paper_reference[$type_print][$use_paper]['footer']['terbilang']['align']);
		}
		// disahkan
		$pdf->ln($paper_reference[$type_print][$use_paper]['footer']['footer_ln'] * 10);
		$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['signature']['position_x']);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['signature']['width'], 
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['height'], 
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['title'],0,0,
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['align']);

		// disetujui
		$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['approved_by']['position_x']);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['approved_by']['width'], 
				   $paper_reference[$type_print][$use_paper]['footer']['approved_by']['height'], 
				   $paper_reference[$type_print][$use_paper]['footer']['approved_by']['title'],0,0,
				   $paper_reference[$type_print][$use_paper]['footer']['approved_by']['align']);
				   
		
		//khusus pos

		if (in_array($type_print, array("pos_out"))) {
			//A4
			if ($use_paper == 1) {
				$space_tambahan = 20;
				$posisi_tambahan_atas = 0.5;
				$posisi_tambahan_bawah = 0.5;
			//A5
			} else {
				$space_tambahan = 17;
				$posisi_tambahan_atas = 4;
				$posisi_tambahan_bawah = 8;
			}
			
			$pdf->ln($paper_reference[$type_print][$use_paper]['footer']['footer_ln'] * $space_tambahan);
			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['signature']['position_x'] - $posisi_tambahan_atas);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['signature']['width'], 
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['height'], 
				   '(................................)',0,0,
				   $paper_reference[$type_print][$use_paper]['footer']['signature']['align']);
			

			$pdf->SetX($paper_reference[$type_print][$use_paper]['footer']['approved_by']['position_x'] - $posisi_tambahan_bawah);
			$pdf->Cell($paper_reference[$type_print][$use_paper]['footer']['approved_by']['width'], 
					$paper_reference[$type_print][$use_paper]['footer']['approved_by']['height'], 
					'(...............................)',0,0,
					$paper_reference[$type_print][$use_paper]['footer']['approved_by']['align']);
		}



		$pdf->output('i',$type_print.'-'.date('Y-m-d'));
		
	}


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
		// $nilai = abs($nilai);
		$nilai = ($nilai);
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
			$hasil = trim($this->penyebut($nilai))." rupiah";
		}     		
		return $hasil;
	}


	function print_neraca_saldo($type,$type_print,$data)
	{
		// get paper 
		$setting_paper   = $this->param_paper($type=2);
		$paper_reference = $setting_paper['setting_paper'];
		$header_reference= $setting_paper['setting_header']; 
		
		
		// count data
		$count_data = count($data);

		// if data > 10 then use A4 paper
		// else use B4 paper
		$use_paper = 1;
		if ( $count_data <= 10 ) {
			$use_paper = 2;
		}
		
		// initilization paper
		$pdf = new FPDF($paper_reference[$type_print][$use_paper]['view'], 
						$paper_reference[$type_print][$use_paper]['type_size'], 
						$paper_reference[$type_print][$use_paper]['paper']);

		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',13);

		// set position to top
		$pdf->SetY($paper_reference[$type_print][$use_paper]['title_position_y']+3);

		// set tile header
		$pdf->Cell($paper_reference[$type_print][$use_paper]['title_paper']['width'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['height'], 
					'NERACA SALDO',0,1,
					$paper_reference[$type_print][$use_paper]['title_paper']['align']);
		
		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['title_paper']['width'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['height']+10, 
					'PERIODE '. $data[0]->jurnal_date,0,1,
					$paper_reference[$type_print][$use_paper]['title_paper']['align']);

		$pdf->SetFont('Arial','B',8);
		$pdf->SetX(80);
		$pdf->Cell(10, 
					$paper_reference[$type_print][$use_paper]['title_paper']['height']+10, 
					'Hal ',0,1,
					$paper_reference[$type_print][$use_paper]['title_paper']['align']);
		$pdf->SetX(90);
		$pdf->Cell($paper_reference[$type_print][$use_paper]['title_paper']['width'], 
					$paper_reference[$type_print][$use_paper]['title_paper']['height']+10, 
					':',0,1,
					$paper_reference[$type_print][$use_paper]['title_paper']['align']);
		// set branch name
		$pdf->SetFont('Arial','B',13);
		// get userdata
		$CI =& get_instance();
		
		$pdf->SetY($header_reference[$use_paper]['title']['position_y']);
		$pdf->SetX($header_reference[$use_paper]['title']['position_x']);
		$pdf->Cell($header_reference[$use_paper]['title']['width'], 
					$header_reference[$use_paper]['title']['height'], 
					$CI->session->userdata('branch_name'),0,1,'L');

		// set branch address
		$pdf->SetFont('Arial','',10);
		$pdf->SetY($header_reference[$use_paper]['address']['position_y']);
		$pdf->SetX($header_reference[$use_paper]['address']['position_x']);
		$pdf->Cell($header_reference[$use_paper]['address']['width'], 
					$header_reference[$use_paper]['address']['height'], 
					$CI->session->userdata('branch_address'),0,1,'L');

		//set title
		$pdf->Cell(10, 2,'No',1,0,'C');	

		$pdf->output('i',$type_print.'-'.date('Y-m-d'));
	}

}