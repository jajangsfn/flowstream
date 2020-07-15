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


	function print_po($type = 1,$data) {
		// echo json_encode($data);exit;
		// type 1 = pembelian
		// type 2 = penjualan

		if ($type == 1) {

			$pdf = new FPDF("L","cm","A4");
			$pdf->SetMargins(0.8,1,1);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			// judul
			$pdf->Cell(30,1,'Bukti Purchase Order',0,1,'C');

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(4,0.7,"Printed On : ".date("d/m/Y"),0,0,'C');
			$pdf->ln(1);

			// header
			$pdf->SetFont('Arial','B',11);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(15, 1, 'Rincian Supplier', 1, 0, 'L',true);
			$pdf->Cell(13, 1, 'Rincian PO', 1, 0, 'L',true);
			$pdf->ln(1);

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(236, 240, 241);
			$pdf->SetTextColor(0,0,0);

			$pdf->Cell(3, 1, 'Supplier', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(11.8, 1, $data[0]->partner_name, 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'No PO', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->purchase_order_no, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(3, 1, 'Salesman', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(11.8, 1, $data[0]->salesman_name, 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'Tgl PO', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->created_date, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(5, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'No Referensi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->reference_no, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(5, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'Deskripsi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->description, 0, 0, 'L',true);

			$pdf->ln(2);

			
			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			

			
			$pdf->Cell(1, 0.8, 'No', 1, 0, 'C',1);
			$pdf->Cell(5, 0.8, 'Kode Barang', 1, 0, 'C',1);
			$pdf->Cell(9, 0.8, 'Nama Barang', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Harga', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Qty', 1, 0, 'C',1);
			$pdf->Cell(2, 0.8, 'Diskon (%)', 1, 0, 'C',1);
			$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C',1);
			$pdf->SetFont('Arial','',9);
			$pdf->SetTextColor(0,0,0);

			$grant_total = 0;
			if ($data) {
				foreach ($data as $key => $val) {
					$sku_code = ($val->sku_code) ? $val->sku_code : "Kosong";
					$total = ($val->goods_price * $val->goods_qty) - ( ($val->goods_price * $val->goods_qty) * $val->goods_discount /100);
					$grant_total+=$total;
					$pdf->Cell(1,0.8,($key+1),1,0,'C');
					$pdf->Cell(5,0.8,($sku_code),1,0,'C');
					$pdf->Cell(9,0.8,($val->goods_name),1,0,'L');
					$pdf->Cell(3.5,0.8,number_format($val->goods_price),1,0,'R');
					$pdf->Cell(3.5,0.8,number_format($val->goods_qty),1,0,'R');
					$pdf->Cell(2,0.8,( ($val->goods_discount) ? $val->goods_discount :"0" ),1,0,'C');
					$pdf->Cell(4, 0.8, number_format(floor($total)), 1, 1, 'R');
					// $pdf->ln(1);
				}
			}

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(24,0.8,"Grant Total",1,0,'R',1);
			$pdf->Cell(4, 0.8, number_format(floor($grant_total)), 1, 1, 'R',1);


			$pdf->output();
		}

	}



	function print_receive($type = 1,$data) {
		// echo json_encode($data);
		// if ($type == 1) {

			$pdf = new FPDF("L","cm","A4");
			$pdf->SetMargins(0.8,1,1);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			// judul
			$pdf->Cell(30,1,'Bukti Penerimaan Barang',0,1,'C');

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(4,0.7,"Printed On : ".date("d/m/Y"),0,0,'C');
			$pdf->ln(1);

			// header
			$pdf->SetFont('Arial','B',11);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(15, 1, 'Rincian Supplier', 1, 0, 'L',true);
			$pdf->Cell(13, 1, 'Rincian Penerimaan Barang', 1, 0, 'L',true);
			$pdf->ln(1);

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(236, 240, 241);
			$pdf->SetTextColor(0,0,0);

			$pdf->Cell(3, 1, 'Supplier', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(11.8, 1, $data[0]->supplier_name, 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'No PO', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->receiving_no, 0, 0, 'L',true);
			$pdf->ln(1);

			$pdf->Cell(5, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);


			$pdf->Cell(3, 1, 'Tgl PO', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->created_date, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(5, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'No Referensi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->reference_no, 0, 0, 'L',true);

			$pdf->ln(1);
			$pdf->Cell(5, 1, '', 0, 0, 'L',true);
			$pdf->Cell(0.2, 1, '', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, '', 0, 0, 'L',true);

			$pdf->Cell(3, 1, 'Deskripsi', array(1,1,0,0), 0, 'L',true);
			$pdf->Cell(0.2, 1, ':', 0, 0, 'L',true);
			$pdf->Cell(9.8, 1, $data[0]->description, 0, 0, 'L',true);

			$pdf->ln(2);

			
			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			

			
			$pdf->Cell(1, 0.8, 'No', 1, 0, 'C',1);
			$pdf->Cell(5, 0.8, 'Kode Barang', 1, 0, 'C',1);
			$pdf->Cell(9, 0.8, 'Nama Barang', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Harga', 1, 0, 'C',1);
			$pdf->Cell(3.5, 0.8, 'Qty', 1, 0, 'C',1);
			$pdf->Cell(2, 0.8, 'Diskon (%)', 1, 0, 'C',1);
			$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C',1);
			$pdf->SetFont('Arial','',9);
			$pdf->SetTextColor(0,0,0);

			$grant_total = 0;
			if ($data) {
				foreach ($data as $key => $val) {
					$sku_code = ($val->sku_code) ? $val->sku_code : "Kosong";
					$total = ($val->price * $val->quantity) - ( ($val->price * $val->quantity) * $val->discount /100);
					$grant_total+=$total;
					$pdf->Cell(1,0.8,($key+1),1,0,'C');
					$pdf->Cell(5,0.8,($sku_code),1,0,'C');
					$pdf->Cell(9,0.8,($val->goods_name),1,0,'L');
					$pdf->Cell(3.5,0.8,number_format($val->price),1,0,'R');
					$pdf->Cell(3.5,0.8,number_format($val->quantity),1,0,'R');
					$pdf->Cell(2,0.8,( ($val->discount) ? $val->discount :"0" ),1,0,'C');
					$pdf->Cell(4, 0.8, number_format(floor($total)), 1, 1, 'R');
					// $pdf->ln(1);
				}
			}

			$pdf->SetFont('Arial','B',9);
			$pdf->setFillColor(155,89,182);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(24,0.8,"Grant Total",1,0,'R',1);
			$pdf->Cell(4, 0.8, number_format(floor($grant_total)), 1, 1, 'R',1);


			$pdf->output();
		// }
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

}