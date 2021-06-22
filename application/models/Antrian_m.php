<?php

class Antrian_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_antrian');
        $query = $this->db->get();
        return $query;
    }

    public function getIDByDesc(){
        $this->db->select('*');
        $this->db->from('tb_antrian');
        $this->db->order_by('antrianID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function tuncent(){
        $this->db->from('tb_antrian');
        $this->db->truncate();

    }

    public function getID($id){
        $this->db->from('tb_antrian');
        $this->db->where('antrianID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function addAntrian($post){
        $params = array(     
            'antrianNO' => $post['antrianNO'],
        );
        $query = $this->db->insert('tb_antrian', $params);
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


    ///////////////////////////////////////////////////

    public function getAllAntrianDetail(){
        $this->db->select('*');
        $this->db->from('tb_antrian_detail');
        $query = $this->db->get();
        return $query;
    }

    // public function getAntrian(){
    //     $this->db->from('tb_antrian_detail');
    //     $this->db->where('detail_antrianStatus', 'menunggu');
    //     $this->db->order_by('detail_antrianID ASC', 'detail_antrainTgl ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function getMenunggu(){
        $this->db->select('COUNT(detail_antrianStatus) as total');
        $this->db->from('tb_antrian_detail');
        $this->db->where('detail_antrianStatus', 'menunggu');
        // $this->db->order_by('detail_antrianID ASC', 'detail_antrainTgl ASC');
        $this->db->group_by('detail_antrianStatus', 'menunggu');
        $query = $this->db->get();
        return $query;
    }

    public function getIDByDescAntrianDetail(){
        $this->db->select('*');
        $this->db->from('tb_antrian_detail');
        $this->db->order_by('antrianID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAntrian(){
        $this->db->from('tb_antrian_detail');
        $this->db->where('detail_antrianStatus', 'menunggu');
        $this->db->order_by('detail_antrianID ASC', 'detail_antrainTgl ASC');
        $query = $this->db->get();
        return $query;
    }



    public function setPanggil($id){
        $params = array(     
            'detail_antrianStatus' => 'terpanggil',
        );
        $this->db->where('detail_antrianID', $id);
        $query = $this->db->update('tb_antrian_detail', $params);
        return $query;
    }

    public function addAntrianDetail($post){
        $params = array(     
            'detail_antrianNo' => $post['antrianNO'],
            'detail_antrianStatus' => 'menunggu',
        );
        $query = $this->db->insert('tb_antrian_detail', $params);
        return $query;
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