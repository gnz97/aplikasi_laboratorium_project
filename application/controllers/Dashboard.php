<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
		$this->load->model(['Pasien_m', 'Pemeriksaan_m', 'ParamPemeriksaan_m', 'BidangPemeriksaan_m']);
    }

	public function index(){
		$data['dataPasien'] = $this->Pasien_m->getCountPasien()->row();
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getCountPemeriksaan()->row();
		$data['dataParamPemeriksaan'] = $this->ParamPemeriksaan_m->getCountParamPemeriksaan()->row();
		$data['dataBidangPemeriksaa'] = $this->BidangPemeriksaan_m->getCountBidangPemeriksaan()->row();
		
		// echo json_encode($data);
		$this->load->view('template', $data);
	}
}
