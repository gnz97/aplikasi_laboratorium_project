<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan1 extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['ParamPemeriksaan_m', 'BidangPemeriksaan_m', 'Pasien_m', 'Pemeriksaan_m', 'Sample_m', 'Satuan_m']);
        $this->load->library('form_validation');
    }
	public function index(){
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getAll()->result();
		$this->load->view('pemeriksaan/pemeriksaan_data', $data);
	}

	public function belumPemeriksaan(){
		$status ="Belum Pemeriksaan";
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getByStatusID($status)->result();
		$this->load->view('pemeriksaan/pemeriksaan_data', $data);
	}

	public function prosesPemeriksaan(){
		$status ="Proses Pemeriksaan";
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getByStatusID($status)->result();
		$this->load->view('pemeriksaan/pemeriksaan_data', $data);
	}

	public function hasilPemeriksaan(){
		$status ="Selesai Pemeriksaan";
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getByStatusID($status)->result();
		$this->load->view('pemeriksaan/pemeriksaan_data', $data);
	}

	public function pemeriksaanProses($id)
	{
		
		// $get = $this->input->get($id);
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getID($id)->row();
		$data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		$data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		$data['dataSatuan'] = $this->Satuan_m->getAll()->result();
		$data['dataSample'] = $this->Sample_m->getAll()->result();
		// echo json_encode($data);
		$this->load->view('pemeriksaan/pemeriksaan', $data);
	}

	public function pemeriksaanProses_penerimaan(){
		$post = $this->input->post(null, TRUE);
		$params = array();
		$params['pemeriksaanID'] = $post['pemeriksaanID'];
		$params['pemeriksaanDokterPJ'] = $post['dokterPJ'];
		$params['pemeriksaanSample'] = $post['jenisSample'];
		
		if($post['wDPenerimaanSample'] != null && $post['wTPenerimaanSample'] != null){
			$params['pemeriksaanStatus'] = 'Proses Pemeriksaan';
			$params['tgl_penerimaanSample'] = $post['wDPenerimaanSample']." ".$post['wTPenerimaanSample'];
		}else{
			$params['pemeriksaanStatus'] = 'Belum Pemeriksaan';
			$params['tgl_penerimaanSample'] = "DataKosong";
		}
		
		if($post['wDPemeriksaanSample'] != null && $post['wTPemeriksaanSample'] != null){
			$params['pemeriksaanStatus'] = 'Proses Pemeriksaan';
			$params['tgl_pemeriksaanSample'] = $post['wDPemeriksaanSample']." ".$post['wTPemeriksaanSample'];
		}else{
			$params['tgl_pemeriksaanSample'] = "DataKosong";
		}
		if($post['wDPenerimaanHasil'] != null && $post['wTPenerimaanHasil'] != null){
			$params['pemeriksaanStatus'] = 'Selesai Pemeriksaan';
			$params['tgl_penerimaanHasil'] = $post['wDPenerimaanHasil']." ".$post['wTPenerimaanHasil'];
		}else{
			$params['tgl_penerimaanHasil'] = "DataKosong";
		}
		$data = array();
		if($post['hasilPemeriksaan'] != null){
			for($i = 0; $i<count($post['detailPemeriksaanID']); $i++){
				
					$data = array(
						'dpID' => $post['detailPemeriksaanID'][$i],
						'hasil' => $post['hasilPemeriksaan'][$i],
						'ket' => $post['ketPemeriksaan'][$i],
					);
					
						
					$this->Pemeriksaan_m->updatePemeriksaanDetail($data);
				}
				

		}else{
			for($i = 0; $i<count($post['detailPemeriksaanID']); $i++){
				$datax = "DataKosong";
				$data[] =  array(
					'dpID' => $post['detailPemeriksaanID'][$i],
					'hasil' =>  $datax ,
					'ket' =>  $datax,
				);
				
				$this->Pemeriksaan_m->updatePemeriksaanDetail($data);	

			}
				
		}
	
        echo json_encode($data);
					// if($this->db->affected_rows()>0){
					// 	$response[] = array(
					// 		'status' 	    => 'success',
					// 	);
					// }
			
					
		
		
		// foreach($post['detailPemeriksaanID'] as $row){
		// 	$params1['data'] = array(
		// 		'dpID' => $post['detailPemeriksaanID'],
		// 		'hasil' => $post['hasilPemeriksaan'],
		// 		'ket' => $post['ketPemeriksaan']
		// 	);
		// }

	
		// $params['dpID'] = $post['detailPemeriksaanID'];
		// $params['hasil'] = $post['hasilPemeriksaan'];
		// $params['ket'] = $post['ketPemeriksaan'];
		

		

		$this->Pemeriksaan_m->updatePemeriksaan($params);
		if($this->db->affected_rows()>0){
			$response = array(
				'status' 	    => 'success',
			);
		}
	
		// $get = $this->input->get($id);
		
	}

	public function pemeriksaanPasien(){
		$this->load->view('pemeriksaan/pemeriksaan');
	}
}
