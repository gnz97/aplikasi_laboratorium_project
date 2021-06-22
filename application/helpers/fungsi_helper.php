<?php

// Superadmin/Pengelola

// function check_already_login_pengelola(){
//     $ci =& get_instance();
//     $user_session = $ci->session->userdata('pengelolaID');
//     if($user_session){
//         redirect('superadmin/dashboard');
//     }
// }

// function check_not_login_pengelola(){
//     $ci =& get_instance();
//     $user_session = $ci->session->userdata('pengelolaID');
//     if(!$user_session){
//         redirect('pengguna/auth/login');
//     }
// }



//Petugas

function check_already_login_petugas(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('petugasID');
    if($user_session){
        // echo "Masuk";
        redirect('Dashboard');
    }
}

function check_not_petugas(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('petugasID');
    if(!$user_session){
        redirect('Auth/login');
    }
}

function check_admin(){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->pengguna_login()->penggunaIDHakAkses != 1){
        redirect('index');
    }

}



function check_pengguna_page($idPage){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    $data = $ci->fungsi->hakAkses()->hakAksesPageRules;
    $zx = unserialize($data);
    if(!in_array($idPage, $zx)){
         redirect('index');
       
    } else{
       
    }
}



//Client



function check_already_login_client(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('clientID');
    if($user_session){
        // echo "Masuk";
        redirect('Client/clientDashboard');
    }
}



function check_not_login_client(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('clientID');
    if(!$user_session){
        redirect('clientAuth/login');
    }
}

function check_biodata_client(){
    $ci =& get_instance();
    $ci->load->model('client_m');
    $user_session = $ci->session->userdata('clientID');
    $data = $ci->client_m->checkkBiodata($user_session)->row();

    if($data){
        redirect('Client/clientBiodata');
    }

    // echo json_encode($data);
}





