<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['Satuan_m']);
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data['satuanData'] = $this->Satuan_m->getAll()->result();
		$this->load->view('admin/satuan/satuan_data', $data);
	}

	public function viewAddSatuan(){
		$this->load->view('admin/satuan/satuan_add');
	}

	public function addSatuan(){
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
				$parse = array(
				 	'satuanNama' 		=> $post['satuanNama'],
				);
				$this->Satuan_m->addSatuan($parse);
				if($this->db->affected_rows() > 0){
					$response = array(
						'status' 	=> 'success',
					);
				}
			// }
			echo json_encode($response);
	}

	public function viewEditSatuan($id){
        $data['row'] = $this->Satuan_m->getID($id)->row();
        // echo json_encode($data);
        $this->load->view('admin/satuan/satuan_edit', $data);
    }

	public function editSatuan(){
       
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
            $this->Satuan_m->editSatuan($post);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'status' 	=> 'success',
                );
            }
            
        // }
        
        echo json_encode($response);
    }


	public function deletSatuan(){
        $id = $this->input->post('id');
        $this->Satuan_m->delSatuan($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }

	
}
