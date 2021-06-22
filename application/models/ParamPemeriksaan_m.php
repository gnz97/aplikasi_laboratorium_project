<?php

class ParamPemeriksaan_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_param_pemeriksaan');
        $this->db->join('tb_bidang_pemeriksaan', 'tb_bidang_pemeriksaan.bidangID = tb_param_pemeriksaan.bidang_ID');
        $this->db->join('tb_param_satuan', 'tb_param_satuan.satuanID = tb_param_pemeriksaan.satuan_ID');
        $query = $this->db->get();
        return $query;
    }

    public function getID($id){
        $this->db->from('tb_param_pemeriksaan');
        $this->db->where('paramID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getCountParamPemeriksaan(){
        $this->db->select('COUNT(paramID) as total');
        $this->db->from('tb_param_pemeriksaan');
        $query = $this->db->get();
        return $query;
    }

    public function getByJkGroupBidangID($jk){
        
        $this->db->select('paramNama, bidang_ID,COUNT(bidang_ID) as total');
        $this->db->from('tb_param_pemeriksaan');
        $this->db->where('paramStatus', $jk);
        $this->db->or_where('paramStatus', 'umum');
        $this->db->group_by('bidang_ID');
        // $this->db->order_by('total', 'desc'); 
        $query = $this->db->get();
        return $query;
    }

    public function getAllByBidangID($id){
        $this->db->from('tb_param_pemeriksaan');
        $this->db->where('bidang_ID', $id);
        $this->db->join('tb_bidang_pemeriksaan', 'tb_bidang_pemeriksaan.bidangID = tb_param_pemeriksaan.bidang_ID');
        $this->db->join('tb_param_satuan', 'tb_param_satuan.satuanID = tb_param_pemeriksaan.satuan_ID');
        $query = $this->db->get();
        return $query;
    }

    public function addParamPemeriksaan($post){
        $params = array(     
            'paramNama' 		=> $post['paramNama'],
            'bidang_ID' 		=> $post['paramBidang'],
            'paramStatus' 		=> $post['paramStatus'],
            'paramNilaiRujukan' => $post['paramNR'],
            'satuan_ID' 		=> $post['paramSatuan'],
            'paramHarga' 		=> $post['paramHarga'],
        );
        $query = $this->db->insert('tb_param_pemeriksaan', $params);
        return $query;
    }

    public function editParamPemeriksaan($post){
        $params = array(     
            'paramNama' 		=> $post['paramNama'],
            'bidang_ID' 		=> $post['paramBidang'],
            'paramStatus' 		=> $post['paramStatus'],
            'paramNilaiRujukan' => $post['paramNR'],
            'satuan_ID' 		=> $post['paramSatuan'],
            'paramHarga' 		=> $post['paramHarga'],
        );
        $this->db->where('paramID', $post['paramID']);
        $query = $this->db->update('tb_param_pemeriksaan',$params);
        return $query;
    }

    public function delParamPemeriksaan($id){
        $this->db->where('paramID', $id);
        $this->db->delete('tb_param_pemeriksaan');
    }

    // public function getSubPaketByPaketID($id){
    //     $this->db->select('*');
    //     $this->db->from('tb_paketsub');
    //     $this->db->where('paketID', $id);
    //     $query = $this->db->get();
    //     return $query;
    // }

    

    // public function getByID($id){
    //     $this->db->select('*');
    //     $this->db->from('tb_pasien');
    //     $this->db->where('pasienID', $id);
    //     $query = $this->db->get();
    //     return $query;
    // }

    

    // public function addPasien($post){
    //     $params = array(     
    //         'pasienNoRM' => $post['noRMPasien'],
    //         'pasienNoIdentitas' => $post['noIDentitasPasien'],
    //         'pasienNamaLengkap' => $post['namaLengkapPasien'],
    //         'pasienTempatLahir' => $post['tempatLahirPasien'],
    //         'pasienTglLahir' => $post['tglLahirPasien'],
    //         'pasienJK' => $post['jkPasien'],
    //         'pasienStatus' => $post['status'],
    //         'pasienAlamat' => $post['alamatPasien'],
    //     );
    //     $query = $this->db->insert('tb_pasien', $params);
    //     return $query;
    // }

    // public function updatePasien($post){
    //     $params = array(     
    //         'pasienNo' => $post['nopasien'],
    //         'pasienNama' => $post['namapasien'],
    //         'pasienKategori' => $post['kategoripasien'],
    //     );
    //     $this->db->where('pasienID', $post['idpasien']);
    //     $query = $this->db->update('tb_pasien', $params);
    //     return $query;
    // }

    // public function delPasien($id){
    //     $this->db->where('pasienID', $id);
    //     $this->db->delete('tb_pasien');
    // }

    

    

}



?>