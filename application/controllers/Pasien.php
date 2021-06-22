<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['Pasien_m', 'Pemeriksaan_m']);
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data['dataPasien'] = $this->Pasien_m->getAll()->result();
		$this->load->view('pasien/pasien_data', $data);
	}

	

	public function pasienBaru(){
		$this->load->view('pasien/pasien_add');
	}

	public function addPasien(){
		$response = array();
        $this->form_validation->set_rules('noRMPasien', 'NO RM Pasien', 'required|callback_check_noRMPasien');
        $this->form_validation->set_rules('noIDentitasPasien', 'NO IDentitas Pasien', 'required');
        $this->form_validation->set_rules('namaLengkapPasien', 'Nama Lengkap Pasien', 'required');
		$this->form_validation->set_rules('emailPasien', 'Email Pasien', 'required');
		
        $this->form_validation->set_rules('tempatLahirPasien', 'tempat Lahir Pasien', 'required');
		$this->form_validation->set_rules('tglLahirPasien', 'Tgl Lahir Pasien', 'required');
		$this->form_validation->set_rules('umurPasien', 'Umur Pasien', 'required');
		
		
		$this->form_validation->set_rules('alamatPasien', 'Alamat Pasien', 'required');
        
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	       => 'error',
                'noRMPasien' 		   => form_error('noRMPasien'),
                'noIDentitasPasien'    => form_error('noIDentitasPasien'),
                'namaLengkapPasien'       => form_error('namaLengkapPasien'),
				'emailPasien'       => form_error('emailPasien'),
                'tempatLahirPasien'            => form_error('tempatLahirPasien'),
				'tglLahirPasien'            => form_error('tglLahirPasien'),
				'umurPasien'            => form_error('umurPasien'),
                'alamatPasien'          => form_error('alamatPasien'),
            );
		} 
		else{
			$post = $this->input->post(null, TRUE);

			if($post['status'] == 1){
				$postStatus = 'Umum';
			}else if($post['status'] == 2){
				$postStatus = 'BPJS';
			}else if($post['status'] == 3){
				$postStatus = 'AKSES';
			}else if($post['status'] == 4){
				$postStatus = 'KIS';
			}else if($post['status'] == 5){
				$postStatus = 'DLL';
			}

			$parse = array(
				'noRMPasien' 		=> $post['noRMPasien'],
				'noIDentitasPasien' => $post['noIDentitasPasien'],
				'namaLengkapPasien' => $post['namaLengkapPasien'],
				'emailPasien'		=> $post['emailPasien'],
				'tempatLahirPasien' => $post['tempatLahirPasien'],
				'tglLahirPasien' 	=>  $post['tglLahirPasien'],
				'umurPasien'		=>  $post['umurPasien'],
				'jkPasien' 			=> $post['jkPasien'],
				'status' 			=> $postStatus,
				'alamatPasien' 	=> $post['alamatPasien'],
			);
			// var_dump($parse);
			$this->Pasien_m->addPasien($parse);
			if($this->db->affected_rows() > 0){
				$response = array(
					'status' 	=> 'success',
				);
			}
				
		}
		echo json_encode($response);
		
	}

	public function check_noRMPasien(){
		$post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_pasien WHERE pasienNoRM = '$post[noRMPasien]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('check_noRMPasien', '{field} ini sudah di pakai, silahkan ganti');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

	public function pasienUpdate($id){
		$data['dataPasien'] = $this->Pasien_m->getByID($id)->row();
		$this->load->view('pasien/pasien_edit', $data);
	}

	public function updatePasien(){
		$response = array();
        $this->form_validation->set_rules('noRMPasien', 'NO RM Pasien', 'required|callback_check_update_noRMPasien');
        $this->form_validation->set_rules('noIDentitasPasien', 'NO IDentitas Pasien', 'required');
        $this->form_validation->set_rules('namaLengkapPasien', 'Nama Lengkap Pasien', 'required');
		$this->form_validation->set_rules('emailPasien', 'Email Pasien', 'required');
        $this->form_validation->set_rules('tempatLahirPasien', 'tempat Lahir Pasien', 'required');
		$this->form_validation->set_rules('tglLahirPasien', 'Tgl Lahir Pasien', 'required');
		$this->form_validation->set_rules('umurPasien', 'Umur Pasien', 'required');
		
		
		$this->form_validation->set_rules('alamatPasien', 'Alamat Pasien', 'required');
        
        $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
 
        if($this->form_validation->run() == FALSE){
			$response = array(
                'status' 	       => 'error',
                'noRMPasien' 		   => form_error('noRMPasien'),
                'noIDentitasPasien'    => form_error('noIDentitasPasien'),
                'namaLengkapPasien'       => form_error('namaLengkapPasien'),
				'emailPasien'       => form_error('emailPasien'),
                'tempatLahirPasien'            => form_error('tempatLahirPasien'),
				'tglLahirPasien'            => form_error('tglLahirPasien'),
				'umurPasien'            => form_error('umurPasien'),
                'alamatPasien'          => form_error('alamatPasien'),
            );
		} 
		else{
			$post = $this->input->post(null, TRUE);

			if($post['status'] == 1){
				$postStatus = 'Umum';
			}else if($post['status'] == 2){
				$postStatus = 'BPJS';
			}else if($post['status'] == 3){
				$postStatus = 'ASKES';
			}else if($post['status'] == 4){
				$postStatus = 'KIS';
			}else if($post['status'] == 5){
				$postStatus = 'DLL';
			}

			$parse = array(
				'idpasien' 			=> $post['idpasien'],
				'noRMPasien' 		=> $post['noRMPasien'],
				'noIDentitasPasien' => $post['noIDentitasPasien'],
				'namaLengkapPasien' => $post['namaLengkapPasien'],
				'emailPasien'		=> $post['emailPasien'],
				'tempatLahirPasien' => $post['tempatLahirPasien'],
				'tglLahirPasien' 	=> $post['tglLahirPasien'],
				'umurPasien'		=> $post['umurPasien'],
				'jkPasien' 			=> $post['jkPasien'],
				'status' 			=> $postStatus,
				'alamatPasien' 		=> $post['alamatPasien'],
			);
			// var_dump($parse);
			$this->Pasien_m->updatePasien($parse);
			if($this->db->affected_rows() > 0){
				$response = array(
					'status' 	=> 'success',
				);
			}
				
		}
		echo json_encode($response);
		
	}

	public function check_update_noRMPasien(){
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_pasien WHERE pasienNoRM = '$post[noRMPasien]' AND pasienID != '$post[idpasien]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('check_update_noRMPasien', '{field} ini sudah di pakai, silahkan ganti');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }



	///////////////////////////////////////////////////////////////////////////////

	public function pasienViewDetail($id){
		$data['dataDetailPasien'] = $this->Pemeriksaan_m->getByPasienID($id)->result();
		// echo json_encode($data);
		$this->load->view('pasien/pasien_detail', $data);
	}

}
