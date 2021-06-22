<?php

class Pasien_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_pasien');
        $query = $this->db->get();
        return $query;
    }

    public function getByID($id){
        $this->db->select('*');
        $this->db->from('tb_pasien');
        $this->db->where('pasienID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getLike($noRM){
        $this->db->like('pasienNoRM', $noRM, 'BOTH');
        $this->db->order_by('pasienID', 'asc');
        $this->db->limit(5);
        $this->db->from('tb_pasien');
        $query = $this->db->get();
        return $query;
    }

    public function getCountPasien(){
        $this->db->select('COUNT(pasienID) as total');
        $this->db->from('tb_pasien');
        $query = $this->db->get();
        return $query;
    }

    public function addPasien($post){
        $params = array(     
            'pasienNoRM' => $post['noRMPasien'],
            'pasienNoIdentitas' => $post['noIDentitasPasien'],
            'pasienNamaLengkap' => $post['namaLengkapPasien'],
            'pasienEmail'       => $post['emailPasien'],
            'pasienTempatLahir' => $post['tempatLahirPasien'],
            'pasienTglLahir' => $post['tglLahirPasien'],
            'pasienUmur'  => $post['umurPasien'],
            'pasienJK' => $post['jkPasien'],
            'pasienStatus' => $post['status'],
            'pasienAlamat' => $post['alamatPasien'],
        );
        $query = $this->db->insert('tb_pasien', $params);
        return $query;
    }

    public function updatePasien($post){
        $params = array(     
            'pasienNoRM' => $post['noRMPasien'],
            'pasienNoIdentitas' => $post['noIDentitasPasien'],
            'pasienNamaLengkap' => $post['namaLengkapPasien'],
            'pasienEmail'       => $post['emailPasien'],
            'pasienTempatLahir' => $post['tempatLahirPasien'],
            'pasienTglLahir' => $post['tglLahirPasien'],
            'pasienUmur'  => $post['umurPasien'],
            'pasienJK' => $post['jkPasien'],
            'pasienStatus' => $post['status'],
            'pasienAlamat' => $post['alamatPasien'],
        );
        $this->db->where('pasienID', $post['idpasien']);
        $query = $this->db->update('tb_pasien', $params);
        return $query;
    }

    public function delPasien($id){
        $this->db->where('pasienID', $id);
        $this->db->delete('tb_pasien');
    }

    

    

}



?>