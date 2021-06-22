<?php
class Petugas_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('tb_petugas');
        if ($id != null) {
            $this->db->where('petugasID', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getID($id)
    {
        $this->db->from('tb_petugas');
        $this->db->where('petugasID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getAll(){
        $this->db->select('*');
        $this->db->from('tb_petugas');
        $query = $this->db->get();
        return $query;
    }

    

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_petugas');
        $this->db->where('petugasUser', $post['username']);
        $this->db->where('petugasPass', $post['password']);
        $query = $this->db->get();
        return $query;
    }

    public function getMax(){
        $this->db->select_max('petugasID');
        $this->db->from('tb_petugas');
        $query = $this->db->get();
        return $query;
    }

    public function addPetugas($post){
        $params = array(
            'petugasNama'              => $post['petugasNama'],
            'petugasUser'            => $post['petugasUser'],
            'petugasPass'            => $post['petugasPass'],
            'petugasLevel'        => $post['petugasLevel'],

            
            
            
        );
        if($post['petugasTandaTangan'] != 'DataKosong'){
                $params['petugasTandaTangan'] = $post['petugasTandaTangan'];
            }
        $query = $this->db->insert('tb_petugas', $params);
        return $query;
    }

    public function editPetugas($post){
        $params = array(
            'petugasNama'              => $post['petugasNama'],
            'petugasUser'            => $post['petugasUser'],
            'petugasPass'            => $post['petugasPass'],
            'petugasLevel'        => $post['petugasLevel'],
            'petugasTandaTangan' => $post['petugasTandaTangan'],
            
            
        );
        if($post['petugasTandaTangan'] != 'DataKosong'){
                $params['petugasTandaTangan'] = $post['petugasTandaTangan'];
            }
            
        $this->db->where('petugasID', $post['petugasID']);
        $query = $this->db->update('tb_petugas',$params);
    }

    public function deletPetugas($id){
        $this->db->where('petugasID', $id);
        $this->db->delete('tb_petugas');
    }



}
