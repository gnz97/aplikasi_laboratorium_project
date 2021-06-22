<?php

Class Fungsi {
    protected $ci;
    var $pengirim;
    var $subbidangID;

    function __construct(){
        $this->ci =& get_instance();
    }

    // function pengelola_login(){
    //     $this->ci->load->model('Pengelola_m');
    //     $pengelola_id = $this->ci->session->userdata('pengelolaID');
    //     $pengelola_data = $this->ci->Pengelola_m->get($pengelola_id)->row();
    //     return $pengelola_data;
    // }

    function petugas_login(){
        $this->ci->load->model('Petugas_m');
        $petugas_id = $this->ci->session->userdata('petugasID');
        $petugas_data = $this->ci->Petugas_m->getID($petugas_id)->row();
        return $petugas_data;
    }

    // function client_login(){
    //     $this->ci->load->model('Client_m');
    //     $client_id = $this->ci->session->userdata('clientID');
    //     $client_data = $this->ci->Client_m->get($client_id)->row();
    //     return $client_data;
    // }


}