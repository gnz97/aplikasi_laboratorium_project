<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/TCPDF-main/tcpdf.php';

class Pdf extends TCPDF{
	function __construct(){
		parent::__construct();
	}

	//Page header
    public function Header() {
		
        // Logo
        $image_file = K_PATH_IMAGES.'logo2.png';
        $this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
        // Set font
		$this->Ln(5);
        $this->SetFont('helvetica', 'B', 14);
        // Title
        $this->Cell(189, 5, 'LABORATORIUM BABEL', 0, 1, 'C');
		$this->SetFont('helvetica', 'B', 14);
		$this->SetFont('helvetica', '', 9);
		$this->Cell(189, 3, 'Jl. Ngadinegaran MJ 3/62, Mantrijeran, Yogyakarta', 0, 1, 'C');
		$this->Cell(189, 3, 'Telp.(0274)374200, email: labbabel@gmail.com', 0, 1, 'C');
		// $this->Cell(189, 3, '----------------------------------------------------', 0, 1, 'C');

		// $this->SetFillColor(255, 0, 0);
        // $this->SetTextColor(255);
        // $this->SetDrawColor(128, 0, 0);
        // $this->SetLineWidth(0.3);
        // $this->SetFont('', 'B');
		// $this->Ln();
		
    }

    // Page footer
    // public function Footer() {
    //     // Position at 15 mm from bottom
    //     $this->SetY(-70);
    //     // Set font
    //     $this->SetFont('helvetica', 'B', 9);
    //     // Page number
	// 	$this->Ln(5);
	// 	$this->Cell(94, 0, 'Penanggung Jawab', 0, 0, 'C');
	// 	$this->Cell(94, 0, 'Pemeriksa', 0, 0, 'C');
	// 	$this->Ln(12);
	// 	$this->Cell(94, 0, '$id', 0, 0, 'C');
	// 	$this->Cell(94, 0, 'aeee', 0, 0, 'C');
    //     // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    // }

	
}

