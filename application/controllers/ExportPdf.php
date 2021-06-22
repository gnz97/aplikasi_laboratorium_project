<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportPdf extends CI_Controller {
    function __construct()
    {
    parent::__construct();
     
    // add library of Pdf
    $this->load->library('Pdf');
    }

    public function index() {
        // $orders = $this->order_model->get_all();
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(115, 0, "Laporan Order - ".$tanggal, 0, 1, 'L');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Produk", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tanggal", 1, 0, 'C');
        $pdf->Cell(35, 8, "Jumlah", 1, 0, 'C');
        $pdf->Cell(50, 8, "Total", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        
        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Order - '.$tanggal.'.pdf'); 
    }
}




