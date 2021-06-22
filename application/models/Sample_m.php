<?php

class Sample_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from(' tb_sample');
        $query = $this->db->get();
        return $query;
    }

    public function getID($id){
        $this->db->from('tb_sample');
        $this->db->where('sampleID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function addSample($post){
        $params = array(     
            'sampleNama' => $post['sampleNama'],
        );
        $query = $this->db->insert('tb_sample', $params);
        return $query;
    }

    public function editSample($post){
        $params = array(     
            'sampleNama' => $post['sampleNama'],
        );
        $this->db->where('sampleID', $post['sampleID']);
        $query = $this->db->update('tb_sample',$params);
        return $query;
    }

    public function delSample($id){
        $this->db->where('sampleID', $id);
        $this->db->delete('tb_sample');
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