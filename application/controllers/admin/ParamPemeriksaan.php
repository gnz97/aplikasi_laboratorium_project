<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParamPemeriksaan extends CI_Controller {

	function __construct(){
        parent::__construct();
		check_not_petugas();
        $this->load->model(['ParamPemeriksaan_m', 'BidangPemeriksaan_m', 'Satuan_m']);
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data['paramData'] = $this->ParamPemeriksaan_m->getAll()->result();
		$this->load->view('admin/paramPemeriksaan/paramPemeriksaan_data', $data);
	}

	public function viewAddParam(){
		$data['dataBidang'] = $this->BidangPemeriksaan_m->getAll()->result();
		$data['dataSatuan'] = $this->Satuan_m->getAll()->result();
		$this->load->view('admin/paramPemeriksaan/paramPemeriksaan_add', $data);
	}

	public function addParam(){
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
				 	'paramNama' 		=> $post['paramNama'],
					'paramBidang' 		=> $post['paramBidang'],
					'paramStatus' 		=> $post['paramStatus'],
					'paramNR' 			=> $post['paramNR'],
					'paramSatuan' 		=> $post['paramSatuan'],
					'paramHarga' 		=> $post['paramHarga'],


				);
				$this->ParamPemeriksaan_m->addParamPemeriksaan($parse);
				if($this->db->affected_rows() > 0){
					$response = array(
						'status' 	=> 'success',
					);
				}
			// }
			echo json_encode($response);
	}


	public function viewEditParam($id){
        $data['dataParam'] = $this->ParamPemeriksaan_m->getID($id)->row();
		$data['dataBidang'] = $this->BidangPemeriksaan_m->getAll()->result();
		$data['dataSatuan'] = $this->Satuan_m->getAll()->result();
        // echo json_encode($data);
        $this->load->view('admin/paramPemeriksaan/paramPemeriksaan_edit', $data);
    }

	public function editParam(){
       
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
            $this->ParamPemeriksaan_m->editParamPemeriksaan($post);
            if($this->db->affected_rows() > 0){
                $response = array(
                    'status' 	=> 'success',
                );
            }
            
        // }
        
        echo json_encode($response);
    }


	public function deletParam(){
        $id = $this->input->post('id');
        $this->ParamPemeriksaan_m->delParamPemeriksaan($id);

        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
    }

	
}
