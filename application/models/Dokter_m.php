<?php
class Dokter_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('tb_dokter');
        if ($id != null) {
            $this->db->where('dokterID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getID($id)
    {
        $this->db->from('tb_dokter');
        $this->db->where('dokterID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_dokter');
        $query = $this->db->get();
        return $query;
    }

    

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_dokter');
        $this->db->where('dokterUser', $post['username']);
        $this->db->where('dokterPass', $post['password']);
        $query = $this->db->get();
        return $query;
    }

    public function getMax(){
        $this->db->select_max('dokterID');
        $this->db->from('tb_dokter');
        $query = $this->db->get();
        return $query;
    }

    public function adddokter($post){
        $params = array(
            'dokterNama'              => $post['dokterNama'],
            'dokterJk'            => $post['dokterJk'],
            'dokterTandaTangan'            => $post['dokterTandaTangan'],
        );
        $query = $this->db->insert('tb_dokter', $params);
        return $query;
    }

    public function editdokter($post){
        $params = array(
            'dokterNama'              => $post['dokterNama'],
            'dokterJk'            => $post['dokterJk'],
            'dokterTandaTangan'        => $post['dokterTandaTangan'],
            
        );
        $this->db->where('dokterID', $post['dokterID']);
        $query = $this->db->update('tb_dokter',$params);
    }

    public function deletdokter($id){
        $this->db->where('dokterID', $id);
        $this->db->delete('tb_dokter');
    }



}
