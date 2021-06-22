<?php

class Pemeriksaan_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_pemeriksaan');
        $this->db->join('tb_pasien', 'tb_pasien.pasienID = tb_pemeriksaan.pemeriksaan_pasienID');
        $this->db->order_by('pemeriksaanID', 'DESC');
        // $this->db->join('tb_param_satuan', 'tb_param_satuan.satuanID = tb_param_pemeriksaan.satuan_ID');
        $query = $this->db->get();
        return $query;
    }

    public function getID($id){
        $this->db->from('tb_pemeriksaan');
        $this->db->where('pemeriksaanID', $id);
        $this->db->join('tb_pasien', 'tb_pasien.pasienID = tb_pemeriksaan.pemeriksaan_pasienID');
        // $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_pemeriksaan.pemeriksaan_PetugasID');
        $query = $this->db->get();
        return $query;
    }

    public function getCountPemeriksaan(){
        $this->db->select('COUNT(pemeriksaanID) as total');
        $this->db->from('tb_pemeriksaan');
        $query = $this->db->get();
        return $query;
    }

    public function getCetakID($id){
        $this->db->from('tb_pemeriksaan');
        $this->db->where('pemeriksaanID', $id);
        $this->db->join('tb_pasien', 'tb_pasien.pasienID = tb_pemeriksaan.pemeriksaan_pasienID');
        $this->db->join('tb_petugas', 'tb_petugas.petugasID = tb_pemeriksaan.pemeriksaan_PetugasID');
        $this->db->join('tb_dokter', 'tb_dokter.dokterID = tb_pemeriksaan.pemeriksaanDokterPJ_ID');
        $query = $this->db->get();
        return $query;
    }


    

    public function getByStatusID($id){
        $this->db->from('tb_pemeriksaan');
        $this->db->where('pemeriksaanStatus', $id);
        $this->db->join('tb_pasien', 'tb_pasien.pasienID = tb_pemeriksaan.pemeriksaan_pasienID');
        $this->db->order_by('pemeriksaanID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getByPasienID($id){
        $this->db->from('tb_pemeriksaan');
        $this->db->where('pemeriksaan_pasienID', $id);
        $this->db->join('tb_pasien', 'tb_pasien.pasienID = tb_pemeriksaan.pemeriksaan_pasienID');
        $this->db->order_by('pemeriksaanID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////
  
    public function addPemeriksaan($post){
        $params = array(
            'pemeriksaan_pasienID'      => $post['pasienID'],
            'pemeriksaanDokter'         => $post['dokter'],
            'pemeriksaanUnitPengirim'   => $post['unitPengirim'],
            'pemeriksaanStatus'         => $post['pemeriksaanStatus'],
            'tgl_pendaftaran'           => $post['tgl_pendaftaran'],
  
        );     
        $query = $this->db->insert('tb_pemeriksaan', $params);
        $insert_id =  $this->db->insert_id();
        return $insert_id;
        // return $query; 
    }

    public function updatePemeriksaan($post){
        $params = array();
        $params['pemeriksaanDokterPJ_ID'] = $post['pemeriksaanDokterPJ'];
        // $params['pemeriksaan_sampleID'] = $post['pemeriksaanSample'];
        $params['pemeriksaanStatus'] = $post['pemeriksaanStatus'];
        // $params['pemeriksaanKet'] = $post['pemeriksaanKet'];
        
        if($post['petugasPemeriksaan'] != "DataKosong"){
            $params['pemeriksaan_PetugasID'] = $post['petugasPemeriksaan'];
        }
        
        if($post['pemeriksaanCat'] != "DataKosong"){
        $params['pemeriksaanKet'] = $post['pemeriksaanCat'];
        }
        
        if($post['tgl_penerimaanSample'] != "DataKosong"){
            $params['tgl_penerimaanSample'] = $post['tgl_penerimaanSample'];
        }
       
        if($post['tgl_pemeriksaanSample'] != "DataKosong"){
            $params['tgl_pemeriksaanSample'] = $post['tgl_pemeriksaanSample'];
        }

        if($post['tgl_penerimaanHasil'] != "DataKosong"){
            $params['tgl_penerimaanHasil'] = $post['tgl_penerimaanHasil'];
        }
      
        $this->db->where('pemeriksaanID', $post['pemeriksaanID']);
        $query = $this->db->update('tb_pemeriksaan', $params);
        return $query;
    }

    

//////////////////////////////////////////////////////////////////////////////////////////////////////
  

/////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getDetailID($id){
        $this->db->from('tb_pemeriksaan_detail');
        $this->db->where('pemeriksaan_ID', $id);
        $this->db->join('tb_pemeriksaan', 'tb_pemeriksaan.pemeriksaanID = tb_pemeriksaan_detail.pemeriksaan_ID');
        $this->db->join('tb_param_pemeriksaan', 'tb_param_pemeriksaan.paramID = tb_pemeriksaan_detail.pemeriksaanParameter_ID');
       
        $query = $this->db->get();
        return $query;
    }


  
    public function addPemeriksaanDetail($post){
        $params = array(     
            'pemeriksaan_ID'       => $post['pemeriksaan_ID'],
            'pemeriksaanParameter_ID'  => $post['check'],
        );
        $query = $this->db->insert('tb_pemeriksaan_detail', $params);
        return $query; 
    }

    public function updatePemeriksaanDetail($post){
        $params = array();
        if($post['hasil'] != "DataKosong"){
            $params['dHasil'] = $post['hasil'];
        }
        if($post['ket'] != "DataKosong" && $post['ket'] != "pilih"){
            $params['dKeterangan'] = $post['ket'];
        }
      

        $this->db->where('dPemeriksaanID', $post['dpID']);
        $query = $this->db->update('tb_pemeriksaan_detail', $params);
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

    //Interpretasi Pesan
    
    public function getInterpretasiID($id){
        $this->db->from('tb_pemeriksaan_interpretasi');
        $this->db->where('interpretasiPemeriksaan_ID', $id);
        $this->db->order_by('InterpretasiID', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function addInterpretasi($post){
        $params = array(     
            'interpretasiPemeriksaan_ID'       => $post['pemeriksaanID'],
            'Interpretasi'  => $post['messageInterpretasi'],
        );
        $query = $this->db->insert('tb_pemeriksaan_interpretasi', $params);
        return $query; 
    }

    public function updateInterpretasi($post){
        $params = array();
       
            $params['Interpretasi'] = $post['messageInterpretasi'];

        $this->db->where('InterpretasiID', $post['pemeriksaanID']);
        $query = $this->db->update('tb_pemeriksaan_interpretasi', $params);
        return $query;
    }

    public function delInterpretasi($id){
        $this->db->where('InterpretasiID', $id);
        $this->db->delete('tb_pemeriksaan_interpretasi');
    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////

    //Saran Pesan
    
    public function getSaranID($id){
        $this->db->from('tb_pemeriksaan_saran');
        $this->db->where('saranPemeriksaan_ID', $id);
        $this->db->order_by('saranPemeriksaan_ID', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function addSaran($post){
        $params = array(     
            'saranPemeriksaan_ID'       => $post['pemeriksaanID'],
            'Saran'  => $post['messageSaran'],
        );
        $query = $this->db->insert('tb_pemeriksaan_saran', $params);
        return $query; 
    }

    public function updateSaran($post){
        $params = array();
       
            $params['Saran'] = $post['messageSaran'];

        $this->db->where('SaranID', $post['pemeriksaanID']);
        $query = $this->db->update('tb_pemeriksaan_saran', $params);
        return $query;
    }

    public function delSaran($id){
        $this->db->where('SaranID', $id);
        $this->db->delete('tb_pemeriksaan_saran');
    }

    ////////////////////////////////////////////////////////////////////////////


     //////////////////////////////////////////////////////////////////////////////////////////////////////

    //Sample Pesan
    
    public function getSampleID($id){
        $this->db->from('tb_pemeriksaan_sample');
        $this->db->where('pemeriksaanSample_ID', $id);
        $this->db->join('tb_pemeriksaan', 'tb_pemeriksaan.pemeriksaanID = tb_pemeriksaan_sample.pemeriksaanSample_ID');
        $this->db->join('tb_sample', 'tb_sample.sampleID = tb_pemeriksaan_sample.sample_ID');
        $query = $this->db->get();
        return $query;
    }


    public function addSample($post){
        $params = array();
        if($post['jenisSample'] != "DataKosong"){
            $params['pemeriksaanSample_ID'] = $post['pemeriksaanID'];
            $params['sample_ID'] = $post['jenisSample'];
        }
       
        // $params = array(     
        //     'pemeriksaanSample_ID'       => $post['pemeriksaanID'],
        //     'sample_ID'  => $post['jenisSample'],
        // );
        $query = $this->db->insert('tb_pemeriksaan_sample', $params);
        return $query; 
    }

    public function updateSample($post){
        $params = array();
       
        $params = array(     
            'pemeriksaanSample_ID'       => $post['pemeriksaanSample_ID'],
            'sample_ID'  => $post['sample_ID'],
        );

        $this->db->where('samplePemeriksaanID', $post['samplePemeriksaanID']);
        $query = $this->db->update('tb_pemeriksaan_sample', $params);
        return $query;
    }

    public function delSample($post){
        // $params = array();
       
      
        //     'pemeriksaanSample_ID'       => $post['pemeriksaanSample_ID'],
        //     'sample_ID'  => $post['sample_ID'],
            // $this->db->where('name', $name);
        $this->db->where('pemeriksaanSample_ID', $post['pemeriksaanID']);
        $this->db->where('sample_ID', $post['jenisSampleID']);
        $this->db->delete('tb_pemeriksaan_sample');
    }

    ////////////////////////////////////////////////////////////////////////////



    

}



?>