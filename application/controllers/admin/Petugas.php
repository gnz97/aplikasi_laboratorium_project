<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Petugas_m']);
        $this->load->library('form_validation');
    }

	public function index(){
        $data['dataPetugas'] = $this->Petugas_m->getAll()->result();
		$this->load->view('admin/petugas/petugas_data', $data);
	}

	

	public function pasienBaru(){
		$this->load->view('pasien/pasien_add');
	}

	public function viewAddPetugas(){
		$this->load->view('admin/petugas/petugas_add');
	}

	public function addPetugas(){
		// $response = array();
			// $this->form_validation->set_rules('gejalaCode', 'Gejala Code', 'required|is_unique[tb_gejala.gejalaCode]');
			// $this->form_validation->set_rules('gejalaNama', 'Gejala Nama', 'required');
			// $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
			// $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
			// if($this->form_validation->run() == FALSE){
			// 	$response = array(
			// 		'status' 	    => 'error',
			// 		'gejalaCode' 		=> form_error('gejalaCode'),
			// 		'gejalaNama' 		=> form_error('gejalaNama'),
			// 	);
			// }
			// else{


                if (!empty($_FILES["petugasTandaTangan"]["name"])) {
                    $file = $this->uploadImage();
                    if($file['status'] == true){
                        if($file['name'] != null){
                            $petugasTandaTangan = $file['name']; 
                        } 
                    } else{
                        $response = array(
                            'status' 	    => 'error-upload',
                            'quoFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                        );
                    }
                } else {
                    $petugasTandaTangan  = "DataKosong";
                }

				$post = $this->input->post(null, TRUE);
				$parse = array(
				 	'petugasNama' 		=> $post['petugasNama'],
                    'petugasUser' 		=> $post['petugasUser'],
                    'petugasPass' 		=> $post['petugasPass'],
                    'petugasLevel' 		=> $post['petugasLevel'],
                    'petugasTandaTangan' => $petugasTandaTangan,
				);
				$this->Petugas_m->addPetugas($parse);
				if($this->db->affected_rows() > 0){
					$response = array(
						'status' 	=> 'success',
					);
				}
			// }
			echo json_encode($response);
	}

	public function viewEditPetugas($id){
        $data['rowPetugas'] = $this->Petugas_m->getID($id)->row();
        // echo json_encode($data);
        $this->load->view('admin/petugas/petugas_edit', $data);
    }

	public function editPetugas(){
       
        // $response = array();
        // $this->form_validation->set_rules('gejalaCode', 'Gejala Code', 'required|callback_gejalaCode_check');
        // $this->form_validation->set_rules('gejalaNama', 'Gejala Nama', 'required');
        // $this->form_validation->set_message('required', '%s masih Kososng, atau belum di pilih Silahkan Di isi');
        // $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
        // if($this->form_validation->run() == FALSE){
		// 	$response = array(
        //         'status' 	    => 'error',
        //         'gejalaCode' 		=> form_error('gejalaCode'),
        //         'gejalaNama' 		=> form_error('gejalaNama'),
        //     );
        // }
        // else{
            
            $post = $this->input->post(null, TRUE);

            if($post['petugasLevel'] == 3){
                if (!empty($_FILES["petugasTandaTangan"]["name"])) {
                    $file = $this->uploadImage();
                    if($file['status'] == true){
                        if($file['name'] != null){
                            $petugasTandaTangan = $file['name']; 
                        } 
                    } else{
                        $response = array(
                            'status' 	    => 'error-upload',
                            'quoFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                        );
                    }
                } else {
                    $petugasTandaTangan  = $post['petugasTandaTangan_old'];
                }
            }else{
                $petugasTandaTangan  = "DataKosong";
            }
            
            $parse = array(
               'petugasID'=>  $post['petugasID'],
                'petugasNama' 		=> $post['petugasNama'],
               'petugasUser' 		=> $post['petugasUser'],
               'petugasPass' 		=> $post['petugasPass'],
               'petugasLevel' 		=> $post['petugasLevel'],
               'petugasTandaTangan' => $petugasTandaTangan,
           );

            $this->Petugas_m->editPetugas($parse);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'status' 	=> 'success',
                );
            }
            
        // }
        
        echo json_encode($response);
    }


	public function deletPetugas(){
        $id = $this->input->post('id');
        $this->Petugas_m->deletPetugas($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }


    public function uploadImage(){
        $config['upload_path']     = './upload/upload_tandatangan/';
        $config['allowed_types']   = 'gif|jpg|png|jpeg';
        $config['max_size']        = 1000;
        $config['max_width']       = 1024;
        $config['max_height']      = 768;
        $config['file_name']       = 'tandatanganPetugas-'.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if(isset($_FILES['petugasTandaTangan']['name']) != null){
            if($this->upload->do_upload('petugasTandaTangan')){
                $file_name = $this->upload->data('file_name');
                $data['name'] = $file_name;
                $data['status'] = TRUE;
                return $data;
            } else {
                $data['status'] = FALSE;
                $data['error'] = "data tidak masuk";
                return $data;
            }
        }else{
            $data['status'] = TRUE;
            $data['name'] = null;
            return $data;
        }     
    }
}
