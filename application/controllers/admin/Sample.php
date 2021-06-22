<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['Sample_m']);
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data['sampleData'] = $this->Sample_m->getAll()->result();
		$this->load->view('admin/sample/sample_data', $data);
	}

	public function viewAddSample(){
		$this->load->view('admin/sample/sample_add');
	}

	public function addSample(){
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
				 	'sampleNama' 		=> $post['sampleNama'],
				);
				$this->Sample_m->addSample($parse);
				if($this->db->affected_rows() > 0){
					$response = array(
						'status' 	=> 'success',
					);
				}
			// }
			echo json_encode($response);
	}

	public function viewEditSample($id){
        $data['row'] = $this->Sample_m->getID($id)->row();
        // echo json_encode($data);
        $this->load->view('admin/sample/sample_edit', $data);
    }

	public function editSample(){
       
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
            $this->Sample_m->editSample($post);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'status' 	=> 'success',
                );
            }
            
        // }
        
        echo json_encode($response);
    }


	public function deletSample(){
        $id = $this->input->post('id');
        $this->Sample_m->delSample($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }

	
}
