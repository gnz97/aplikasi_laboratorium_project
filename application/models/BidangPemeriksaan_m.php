<?php

class BidangPemeriksaan_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_bidang_pemeriksaan');
        $query = $this->db->get();
        return $query;
    }

    public function getID($id){
        $this->db->from('tb_bidang_pemeriksaan');
        $this->db->where('bidangID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getCountBidangPemeriksaan(){
        $this->db->select('COUNT(bidangID) as total');
        $this->db->from('tb_bidang_pemeriksaan');
        $query = $this->db->get();
        return $query;
    }

    public function addBidangPemeriksaan($post){
        $params = array(     
            'bidangNama' => $post['bidangNama'],
        );
        $query = $this->db->insert('tb_bidang_pemeriksaan', $params);
        return $query;
    }

    public function editBidangPemeriksaan($post){
        $params = array(     
            'bidangNama' => $post['bidangNama'],
        );
        $this->db->where('bidangID', $post['bidangID']);
        $query = $this->db->update('tb_bidang_pemeriksaan',$params);
        return $query;
    }

    public function delBidangPemeriksaan($id){
        $this->db->where('bidangID', $id);
        $this->db->delete('tb_bidang_pemeriksaan');
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