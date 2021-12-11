<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['ParamPemeriksaan_m', 'BidangPemeriksaan_m', 'Pasien_m', 'Pemeriksaan_m']);
        $this->load->library('form_validation');
    }
	
    public function index(){
		$this->load->view('pendaftaran/pendaftaran');
	}

	public function getViewData_pemeriksaan(){
		$post = $this->input->post('id');
		$data['pasienData'] = $this->Pasien_m->getByID($post)->row();
		$data['pasienData'] = $this->Pasien_m->getByID($post)->row();
		$data['bidangData'] = $this->BidangPemeriksaan_m->getAll()->result();
		$data['dataParam'] = $this->ParamPemeriksaan_m->getAll()->result();
		$data['dataCount'] = $this->ParamPemeriksaan_m->getByJkGroupBidangID($data['pasienData']->pasienJK)->result();
		$this->load->view('pendaftaran/data_pemeriksaan', $data);
	}

	public function pendaftaranPemeriksaan(){
		$data['bidangData'] = $this->BidangPemeriksaan_m->getAll()->result();
		$data['dataParam'] = $this->ParamPemeriksaan_m->getAll()->result();
		$this->load->view('pendaftaran/pendaftaran_pemeriksaan', $data);
	}

	public function dataPasien(){
		$paket['paket'] = $this->Pasien_m->getGetAll()->result();
		// $var_dump($paket);
	}

	public function getPendaftaranDataPasien(){
		$result_array = array();
		if(isset($_GET['term'])){
			$data = $this->Pasien_m->getLike($_GET['term'])->result();
			if(count($data) > 0){
				foreach($data as $row){
					$result_array[] = [
						'label' => $row->pasienNoRM,
						'pasienID' => $row->pasienID,
						'namaPasien' => $row->pasienNamaLengkap,
						'pasienNoIdentitas' => $row->pasienNoIdentitas,
						'pasienJK' => $row->pasienJK
					]; 
					
				}
				echo json_encode($result_array);
				
			}
			
		}
		
	}

	public function getBidangParameter(){
		$id = $this->input->post('id');
		$paket['dataBidangParam'] = $this->ParamPemeriksaan_m->getAllByBidangID($id)->result();
		echo json_encode($paket);
	}

	public function addPendaftaran(){
		$response = array();
        $this->form_validation->set_rules('noRM', 'NO RM', 'required');
        $this->form_validation->set_rules('namaPasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('pasienNoIdentitas', 'No Identitas Pasien', 'required');
		$this->form_validation->set_rules('pasienJK', 'pasien Jenis Kelamin', 'required');
		$this->form_validation->set_rules('dokter', 'Dokter', 'required');
		$this->form_validation->set_rules('unitPengirim', 'Unit Pengirim', 'required');
        $this->form_validation->set_rules('checkSingle', 'check List', 'callback_check_checkSingle');

        
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	       => 'error',
                'noRM' 		   => form_error('noRM'),
				'namaPasien' 		   => form_error('namaPasien'),
                'pasienNoIdentitas'    => form_error('pasienNoIdentitas'),
                'pasienJK'       => form_error('pasienJK'),
                'dokter'            => form_error('dokter'),
				'unitPengirim'            => form_error('unitPengirim'),
				'checkSingle'            => form_error('checkSingle'),

				// 'tglLahirPasien'            => form_error('tglLahirPasien'),
                // 'alamatPasien'          => form_error('alamatPasien'),
            );
		} 
		else{

		$postPasienID   		= $this->input->post('pasienID');
		$postDokter  			= $this->input->post('dokter');
		$postUnitPengirim 		= $this->input->post('unitPengirim');
		$postHarga  			= $this->input->post('harga');
		$postCheckAll   		= $this->input->post('checkedAll');
		$postCheckSingle 		= $this->input->post('checkSingle');
		$postPendaftaranNew 	= $this->input->post('pendaftaranNew');
		
		// var_dump($post);

		// print_r($post['checkedAll']);
		$checkAll = array();
		$checkSingle = array();
	

		$params = array(
			'pasienID' 				=> $postPasienID,
			'dokter'				=> $postDokter,
			'unitPengirim' 			=> $postUnitPengirim,
			'pemeriksaanStatus' 	=> $postPendaftaranNew,
			'tgl_pendaftaran' 		=> date("Y-m-d H:i:s"),
			// 'CheckAll' 		=> $checkAll, Tidak Usah Di Pasang di pengiriman, untuk check All ambil semua pemeriksaan dengan bidang yg di pilih;
			// 'parameterPemeriksaan' 	=> $parameter, //Di bagian checkSingle maupun checkAll di masukan di sini
		);

		$id = $this->Pemeriksaan_m->addPemeriksaan($params);
		if($this->db->affected_rows()>0){ 
			$as = "Data Berhasil Dengan ID".$id;

			if($postCheckAll != null){
				foreach($postCheckAll as $row){
					$paket = $this->ParamPemeriksaan_m->getAllByBidangID($id)->result();
					foreach($paket as $rowParam){
						$params1 = array(
							'pemeriksaan_ID' 	=> $id,
							'check'				=> $rowParam->paramID,
						);
						$this->Pemeriksaan_m->addPemeriksaanDetail($params1);
						if($this->db->affected_rows()>0){
							$response = array(
								'status' 	    => 'success',
							);
						} 
					}
				}
				if($postCheckSingle != null){
					foreach($postCheckSingle as $rowSingle){
						$checkSingle = $rowSingle;
						$params1 = array(
							'pemeriksaan_ID' 	=> $id,
							'check'				=> $rowSingle,
						);
						$this->Pemeriksaan_m->addPemeriksaanDetail($params1);
						if($this->db->affected_rows()>0){
							$response = array(
								'status' 	    => 'success',
							);
						} 
						
					}
				}else{
					echo "Data kosong";
				}
			
			}else{
				if($postCheckSingle != null){
					foreach($postCheckSingle as $rowSingle){
						// $checkSingle[] = $rowSingle;
						$params1 = array(
							'pemeriksaan_ID' 	=> $id,
							'check'				=> $rowSingle,
						);
						$this->Pemeriksaan_m->addPemeriksaanDetail($params1);
						if($this->db->affected_rows()>0){
							$response = array(
								'status' 	    => 'success',
							);
						} 
					}
				}else{
					echo "Data kosong";
				}
				// echo "Data kosong";
				
			}

			
		}
		
		
	}
		echo json_encode($response);
	}

	public function check_checkSingle(){
		$post = $this->input->post(null, TRUE);
        if(!isset($post['checkSingle'])){
        
            $this->form_validation->set_message('check_checkSingle', 'Andan Belum Memilih Paket Pemeriksaan');
            return FALSE;
		}
        else{
            return TRUE;
        }
    }

    
}
