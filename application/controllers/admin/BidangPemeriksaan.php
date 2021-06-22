<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BidangPemeriksaan extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['BidangPemeriksaan_m']);
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data['bidangData'] = $this->BidangPemeriksaan_m->getAll()->result();
		$this->load->view('admin/bidangPemeriksaan/bidangPemeriksaan_data', $data);
	}

	public function viewAddBidangPemeriksaan(){
		$this->load->view('admin/bidangPemeriksaan/bidangPemeriksaan_add');
	}

	public function addBidangPemeriksaan(){
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
				 	'bidangNama' 		=> $post['bidangNama'],
				);
				$this->BidangPemeriksaan_m->addBidangPemeriksaan($parse);
				if($this->db->affected_rows() > 0){
					$response = array(
						'status' 	=> 'success',
					);
				}
			// }
			echo json_encode($response);
	}

	public function viewEditBidangPemeriksaan($id){
        $data['bidangData'] = $this->BidangPemeriksaan_m->getID($id)->row();
        // echo json_encode($data);
        $this->load->view('admin/bidangPemeriksaan/bidangPemeriksaan_edit', $data);
    }

	public function editBidangPemeriksaan(){
       
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
            $this->BidangPemeriksaan_m->editBidangPemeriksaan($post);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'status' 	=> 'success',
                );
            }
            
        // }
        
        echo json_encode($response);
    }


	public function deletBidangPemeriksaan(){
        $id = $this->input->post('id');
        $this->BidangPemeriksaan_m->delBidangPemeriksaan($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }

	
}
