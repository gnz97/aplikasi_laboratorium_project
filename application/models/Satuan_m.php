<?php

class Satuan_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from(' tb_param_satuan ');
        $query = $this->db->get();
        return $query;
    }

    public function getID($id){
        $this->db->from('tb_param_satuan');
        $this->db->where('satuanID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function addSatuan($post){
        $params = array(     
            'satuanNama' => $post['satuanNama'],
        );
        $query = $this->db->insert('tb_param_satuan', $params);
        return $query;
    }

    public function editSatuan($post){
        $params = array(     
            'satuanNama' => $post['satuanNama'],
        );
        $this->db->where('satuanID', $post['satuanID']);
        $query = $this->db->update('tb_param_satuan',$params);
        return $query;
    }

    public function delSatuan($id){
        $this->db->where('satuanID', $id);
        $this->db->delete('tb_param_satuan');
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