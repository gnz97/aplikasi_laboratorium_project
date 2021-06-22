<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['ParamPemeriksaan_m', 'BidangPemeriksaan_m', 'Pasien_m', 'Pemeriksaan_m', 'Sample_m', 'Satuan_m', 'Dokter_m']);
        $this->load->library('form_validation');
		$this->load->library('Pdf');
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

	public function pemeriksaanProses($id){
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getID($id)->row();
		$data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		$data['dataDokter'] = $this->Dokter_m->getAll()->result();
		
		// $data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		$data['dataInterpretasi'] = $this->Pemeriksaan_m->getInterpretasiID($id)->result();
		$data['dataSaran'] = $this->Pemeriksaan_m->getSaranID($id)->result();
		$data['dataSatuan'] = $this->Satuan_m->getAll()->result();
		$data['dataSample'] = $this->Sample_m->getAll()->result();
		$data['dataPemeriksaanSample'] = $this->Pemeriksaan_m->getSampleID($id)->result();
		// echo json_encode($data);
		$this->load->view('pemeriksaan/pemeriksaan', $data);
	}

	public function pemeriksaanProses_penerimaan(){
		$post = $this->input->post(null, TRUE);
		$params = array();
		$params['pemeriksaanID'] = $post['pemeriksaanID'];
		$params['pemeriksaanDokterPJ'] = $post['dokterPJ'];
		// $params['pemeriksaanSample1'] = $post['jenisSample1'];
		// $params['pemeriksaanSample'] = $post['jenisSample1'];
		// $params['pemeriksaanKet'] = $post['pemeriksaanKet'];
		// $data = $post['jenisSample'];
		if(isset($post['jenisSample'])){
			
			if($post['jenisSample'] != null){
				for($i = 0; $i<count($post['jenisSample']); $i++){
					
					$dataxx = array(
						'pemeriksaanID' => $params['pemeriksaanID'],
						'jenisSample'   => $post['jenisSample'][$i],
					);
					
						
					$this->Pemeriksaan_m->addSample($dataxx);
					if($this->db->affected_rows()>0){
						$response = array(
							'status' 	    => 'success',
						);
					}
				}
			}else{
				for($i = 0; $i<count($post['jenisSample']); $i++){
					$datax1 = "DataKosong";
					$dataxx = array(
						'pemeriksaanID' => $datax1,
						'jenisSample'   => $datax1,
					);
					
						
					$this->Pemeriksaan_m->addSample($dataxx);
					if($this->db->affected_rows()>0){
						$response = array(
							'status' 	    => 'success',
						);
					}
				}
			}
			
		}
		// if(isset($post['jenisSample1'])){

		// 	if($post['jenisSample1'] != null){
		// 		for($i = 0; $i<count($post['jenisSample1']); $i++){
		// 			$datax1 = "DataKosong";
		// 			$dataxx = array(
		// 				'pemeriksaanID' => $datax1,
		// 				'jenisSample'   => $datax1,
		// 			);
					
						
		// 			$this->Pemeriksaan_m->addSample($dataxx);
		// 			if($this->db->affected_rows()>0){
		// 				$response = array(
		// 					'status' 	    => 'success',
		// 				);
		// 			}
		// 		}
		// 	}
		// }

		
		// for($i = 0; $i<=count($params['pemeriksaanSample1']);$i++){
		// 	$params['pemeriksaanSample'] = $params['pemeriksaanSample1'][$i];
		// }
		
		
		if(isset($post['pemeriksaanCat'])){
			$params['pemeriksaanCat'] = $post['pemeriksaanCat'];
		}else{
			$params['pemeriksaanCat'] =  "DataKosong";
		}

		if(isset($post['petugasPemeriksaan'])){
			$params['petugasPemeriksaan'] = $post['petugasPemeriksaan'];
		}else{
			$params['petugasPemeriksaan'] =  "DataKosong";
		}
		
		
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
			// $params['petugasPemeriksa'] = $post['jenisSample'];
		}else{
			$params['tgl_penerimaanHasil'] = "DataKosong";
		}

		$data = array();
		if($post['hasilPemeriksaan'] != null){
			for($i = 0; $i<count($post['detailPemeriksaanID']); $i++){
				
					$data = array(
						'dpID' 	=> $post['detailPemeriksaanID'][$i],
						'hasil' => $post['hasilPemeriksaan'][$i],
						'ket' 	=> $post['ketPemeriksaan'][$i],
					);
					
						
					$this->Pemeriksaan_m->updatePemeriksaanDetail($data);
					if($this->db->affected_rows()>0){
						$response = array(
							'status' 	    => 'success',
						);
					}
				}
				

		}else{
			for($i = 0; $i<count($post['detailPemeriksaanID']); $i++){
				$datax = "DataKosong";
				$data =  array(
					'dpID' => $post['detailPemeriksaanID'][$i],
					'hasil' =>  $datax ,
					'ket' =>  $datax,
				);
				
				$this->Pemeriksaan_m->updatePemeriksaanDetail($data);	
				if($this->db->affected_rows()>0){
					$response = array(
						'status' 	    => 'success',
					);
				}

			}
				
		}
	
			
		if($post['hasilPemeriksaan'] != null){	
			if(isset($post['messageInterpretasix'])){
				if($post['messageInterpretasix'] != null){
					for($i = 0; $i<count($post['messageInterpretasix']); $i++){
						$data11 = array(
							'pemeriksaanID' 		=> $post['messageInterpretasixID'][$i],
							'messageInterpretasi' 	=> $post['messageInterpretasix'][$i],
						);
						$this->Pemeriksaan_m->updateInterpretasi($data11);
						if($this->db->affected_rows()>0){
							$response = array(
								'status' 	    => 'success',
							);
						}
					}
				}
			}
			if(isset($post['messageInterpretasi'])){
				for($i = 0; $i<count($post['messageInterpretasi']); $i++){
				
					$data11 = array(
						'pemeriksaanID' 	=> $post['pemeriksaanID'],
						'messageInterpretasi' => $post['messageInterpretasi'][$i],
					);
					
						
					$this->Pemeriksaan_m->addInterpretasi($data11);
					if($this->db->affected_rows()>0){
						$response = array(
							'status' 	    => 'success',
						);
					}
				}
			}
			
		}

		if($post['hasilPemeriksaan'] != null){	
			if(isset($post['messageSaranx'])){
				if($post['messageSaranx'] != null){
					for($i = 0; $i<count($post['messageSaranx']); $i++){
						$data11 = array(
							'pemeriksaanID' 		=> $post['messageSaranxID'][$i],
							'messageSaran' 	=> $post['messageSaranx'][$i],
						);
						$this->Pemeriksaan_m->updateSaran($data11);
						if($this->db->affected_rows()>0){
							$response = array(
								'status' 	    => 'success',
							);
						}
					}
				}
			}
			if(isset($post['messageSaran'])){
				for($i = 0; $i<count($post['messageSaran']); $i++){
				
					$data11 = array(
						'pemeriksaanID' 	=> $post['pemeriksaanID'],
						'messageSaran' => $post['messageSaran'][$i],
					);
					
						
					$this->Pemeriksaan_m->addSaran($data11);
					if($this->db->affected_rows()>0){
						$response = array(
							'status' 	    => 'success',
						);
					}
				}
			}
			
		}
		

		

		$this->Pemeriksaan_m->updatePemeriksaan($params);
		if($this->db->affected_rows()>0){
			$response = array(
				'status' 	    => 'success',
			);
		}
		echo json_encode($response);
		// $get = $this->input->get($id);
		
	}

	public function pemeriksaanPasien(){
		$this->load->view('pemeriksaan/pemeriksaan');
	}


	public function deletInterpretasi(){
        $id = $this->input->post('id');
        $this->Pemeriksaan_m->delInterpretasi($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }


	public function deletSaran(){
        $id = $this->input->post('id');
        $this->Pemeriksaan_m->delSaran($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }

	public function deletSample(){
        $data["pemeriksaanID"] = $this->input->post('pemeriksaanID');
		$data["jenisSampleID"] = $this->input->post('jenisSampleID');
        $this->Pemeriksaan_m->delSample($data);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($jenisSampleID);
    }


	

	
}
