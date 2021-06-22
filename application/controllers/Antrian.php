<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {
	function __construct(){
        parent::__construct();
		// check_not_petugas();
        $this->load->model(['Antrian_m']);

        $data1 = $this->Antrian_m->getIDByDesc()->row();
        $data2 =$this->Antrian_m->getAll()->row();
        
        if($data1 != null){
            $antrian = date('Y-m-d H:i', strtotime($data2->tgl_antrian));
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i");
            if($antrian < $time){
                $this->Antrian_m->tuncent();
            }
        }
		
        
    }

	public function index(){
        $data['rowMenunggu'] = $this->Antrian_m->getMenunggu()->row();
        $data['rowAntrian1'] = $this->Antrian_m->getIDByDesc()->row();
        // echo json_encode($data);
		$this->load->view('antrian/antrian', $data);
	}

	

	public function addAntrian(){
		$post = $this->input->post(null, TRUE);
        $parse = array(
            'antrianNO' 		=> $post['antrianNO'],
            
        );
        // var_dump($parse);
        $this->Antrian_m->addAntrian($parse);
        
        if($this->db->affected_rows() > 0){
            $this->Antrian_m->addAntrianDetail($parse);
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
	}

    public function getAntrian(){
        $data['rowAntrian'] = $this->Antrian_m->getAntrian()->row();
        $data['dataAntrian'] = $this->Antrian_m->getAntrian()->result();
        // echo json_encode($data);
		$this->load->view('antrian/antrian_panggil', $data);
	}

    public function setPanggil(){
        $post = $this->input->post('antrianID');

        $this->Antrian_m->setPanggil($post);
        if($this->db->affected_rows() > 0){
            $response = array(
                'status' 	=> 'success',
            );
        }
        echo json_encode($response);
		// $this->load->view('antrian/antrian', $data);
	}

	
}
