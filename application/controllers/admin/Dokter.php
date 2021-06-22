<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_petugas();
        $this->load->model(['Dokter_m']);
        $this->load->library('form_validation');
    }

	public function index(){
        $data['datadokter'] = $this->Dokter_m->getAll()->result();
		$this->load->view('admin/dokter/dokter_data', $data);
	}

	

	public function pasienBaru(){
		$this->load->view('pasien/pasien_add');
	}

	public function viewAdddokter(){
		$this->load->view('admin/dokter/dokter_add');
	}

	public function adddokter(){
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
				$post = $this->input->post(null, TRUE);
			// 	$parse = array(
			// 	 	'dokterNama' 		=> $post['dokterNama'],
            //         'dokterJk' 		=> $post['dokterJk'],
            //         'dokterTandaTangan' 		=> $post['dokterTandaTangan'],
                    
			// 	);
			// 	$this->Dokter_m->adddokter($parse);
			// 	if($this->db->affected_rows() > 0){
			// 		$response = array(
			// 			'status' 	=> 'success',
			// 		);
			// 	}
			// // }
			// echo json_encode($response);




            ///////////////////////////////////////
            if (!empty($_FILES["dokterTandaTangan"]["name"])) {
                $file = $this->uploadImage();
                if($file['status'] == true){
                    if($file['name'] != null){
                        $dokterTandaTangan = $file['name']; 
                    } 
                } else{
                    $response = array(
                        'status' 	    => 'error-upload',
                        'quoFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                    );
                }
            } else {
                $dokterTandaTangan  = $post['foto_old'];
            }
            
           
                
                /////////////Create ID////////////

                $parse = array(
                    'dokterNama' 		=> $post['dokterNama'],
                   'dokterJk' 		=> $post['dokterJk'],
                   'dokterTandaTangan' 		=> $dokterTandaTangan,
                   
               );

               $this->Dokter_m->adddokter($parse);
                if($this->db->affected_rows()>0){ 
                    $response = array(
                        'status' 	    => 'success',
                    );
                }
           
            echo json_encode($response);
            /////////////////////////////////////
	}

	public function viewEditdokter($id){
        $data['rowdokter'] = $this->Dokter_m->getID($id)->row();
        // echo json_encode($data);
        $this->load->view('admin/dokter/dokter_edit', $data);
    }

	public function editdokter(){
       
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
            if (!empty($_FILES["dokterTandaTangan"]["name"])) {
                $file = $this->uploadImage();
                if($file['status'] == true){
                    if($file['name'] != null){
                        $dokterTandaTangan = $file['name']; 
                    } 
                } else{
                    $response = array(
                        'status' 	    => 'error-upload',
                        'quoFile'       => 'tidak Bisa Upload File, Silahkan Di cek Kembali Filenya'
                    );
                }
            } else {
                $dokterTandaTangan  = $post['dokterTandaTangan_old'];
            }
            
           
                
                /////////////Create ID////////////

                $parse = array(
                    'dokterID' 		=> $post['dokterID'],
                    'dokterNama' 		=> $post['dokterNama'],
                   'dokterJk' 		=> $post['dokterJk'],
                   'dokterTandaTangan' 		=> $dokterTandaTangan,
                   
               );

            
            $this->Dokter_m->editdokter($parse);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'status' 	=> 'success',
                );
            }
            
        // }
        
        echo json_encode($response);
    }


	public function deletdokter(){
        $id = $this->input->post('id');
        $this->Dokter_m->deletdokter($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }



    //Upload Document Client Project
    public function uploadImage(){
        $config['upload_path']     = './upload/upload_tandatangan/';
        $config['allowed_types']   = 'gif|jpg|png|jpeg';
        $config['max_size']        = 1000;
        $config['max_width']       = 1024;
        $config['max_height']      = 768;
        $config['file_name']       = 'tandatangan-'.date('ymd').'-'.substr(md5(rand()),0,10);

        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if(isset($_FILES['dokterTandaTangan']['name']) != null){
            if($this->upload->do_upload('dokterTandaTangan')){
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
