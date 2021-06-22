<?php

class StatusPemeriksaan_m extends CI_Model{

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_status_pemeriksaan');
        $query = $this->db->get();
        return $query;
    }

    public function getByID($id){
        $this->db->select('*');
        $this->db->from('tb_status_pemeriksaan');
        $this->db->where('statusPemeriksaanID', $id);
        $query = $this->db->get();
        return $query;
    }

  

    public function addStatus($post){
        $params = array(     
            'statusPemeriksaanNama' => $post['statusNama'],
        );
        $query = $this->db->insert('tb_status_pemeriksaan', $params);
        return $query;
    }

    public function updateStatus($post){
        $params = array(     
            'statusPemeriksaanNama' => $post['statusNama'],

        );
        $this->db->where('statusPemeriksaanID', $post['statusID']);
        $query = $this->db->update('tb_status_pemeriksaan', $params);
        return $query;
    }

    public function delStatus($id){
        $this->db->where('statusPemeriksaanID', $id);
        $this->db->delete('tb_status_pemeriksaan');
    }

    

    

}



?>