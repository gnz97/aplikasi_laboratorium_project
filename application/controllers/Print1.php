<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print1 extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model(['ParamPemeriksaan_m', 'BidangPemeriksaan_m', 'Pasien_m', 'Pemeriksaan_m', 'Sample_m', 'Satuan_m']);
		$this->load->library('Pdf');
    }
	public function cetak($id){
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getID($id)->row();
		$data['dataPemeriksaanCetak'] = $this->Pemeriksaan_m->getCetakID($id)->row();  
		$data['dataPesanInterpretasi'] = $this->Pemeriksaan_m->getInterpretasiID($id)->result(); 
		$data['dataPesanSaran'] = $this->Pemeriksaan_m->getSaranID($id)->result(); 
		$data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		// $data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		$data['dataSatuan'] = $this->Satuan_m->getAll()->result();
		$data['dataBidang'] = $this->BidangPemeriksaan_m->getAll()->result();
		$data['dataSample'] = $this->Sample_m->getAll()->result();
		// $this->pdf->Footer($id);
		$this->load->view('pemeriksaan/pemeriksaan_cetak', $data);
		// echo json_encode($data);
	}

	// public function belumPemeriksaan(){
	// 	$status ="Belum Pemeriksaan";
	// 	$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getByStatusID($status)->result();
	// 	$this->load->view('pemeriksaan/pemeriksaan_data', $data);
	// }


	
}
