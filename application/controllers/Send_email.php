<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model(['ParamPemeriksaan_m', 'BidangPemeriksaan_m', 'Pasien_m', 'Pemeriksaan_m', 'Sample_m', 'Satuan_m']);
		$this->load->library('Pdf');
    }
	public function send(){
        $id = $this->input->post('id');
		$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getID($id)->row();
		$data['dataPemeriksaanCetak'] = $this->Pemeriksaan_m->getCetakID($id)->row();  
		$data['dataPesanInterpretasi'] = $this->Pemeriksaan_m->getInterpretasiID($id)->result(); 
		$data['dataPesanSaran'] = $this->Pemeriksaan_m->getSaranID($id)->result(); 
		$data['dataPemeriksaanDetail'] = $this->Pemeriksaan_m->getDetailID($id)->result();
		$data['dataSatuan'] = $this->Satuan_m->getAll()->result();
		$data['dataBidang'] = $this->BidangPemeriksaan_m->getAll()->result();
		// $data['dataSample'] = $this->Sample_m->getAll()->result();

        $x1 = $this->pdf($id, $data);

        if($x1 != FALSE){
            $config = [
                'mailtype'      => 'text',
                'charset'       => 'iso-8859-1',
                'protocol'      => 'smtp',
                'smtp_host'     => 'smtp.gmail.com',
                'smtp_user'     => 'babellaboratory018@gmail.com',
                'smtp_pass'     => 'ABcd1234',
                'smtp_crypto'   => 'ssl',
                'smtp_port'     => 465,
                'crlf'          => "\r\n",
                'newline'       => "\r\n"
            ];
    
            
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from('no-reply@xname.com', 'xname');
            $datax = $data['dataPemeriksaan']->pasienEmail;
            $this->email->to($datax);
            
            $url = base_url('/upload/hasil_lab_'.$id.'.pdf');
            $this->email->attach($url);
            $this->email->subject('welcome subject');
            $this->email->message('welcome message');
            if($this->email->send()){
                $response = array(
                    'status' 	=> 'success',
                );
            }else{
                $response = array(
                    'status' 	=> 'gagal',
                );
            }
    
           

        }else{
            $response = array(
                'status' 	=> 'gagal',
            );
        }
        echo json_encode($response);   

        
        
	}

    public function pdf($id, $data){
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Daftar Produk');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(38);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 9);
        
        $html=' <div style="border-top: 1px solid black; "></div>
        <table cellspacing="1"  cellpadding="2" style="border: 1px solid black; ">
            <tr>
                <td width="15%">No LAB</td>
                <td width="37%">'.$data['dataPemeriksaan']->pemeriksaanID.'</td>
                <td width="25%">Dokter</td>
                <td width="23%">'.$data['dataPemeriksaan']->pemeriksaanDokter.'</td> 
            </tr>
            <tr>
                <td>No RM</td>
                <td>'.$data['dataPemeriksaan']->pasienNoRM.'</td>
                <td>Asal Unit</td>
                <td>'.$data['dataPemeriksaan']->pemeriksaanUnitPengirim.'</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>'.$data['dataPemeriksaan']->pasienNamaLengkap.'</td>
                <td>Tanggal Penerima Sample</td>
                <td>'.$data['dataPemeriksaan']->tgl_penerimaanSample.'</td>
            </tr>
            <tr>
                <td>J Kelamin</td>
                <td>'.$data['dataPemeriksaan']->pasienJK.'</td>
                <td>Tanggal Pemeriksaan Sample</td>
                <td>'.$data['dataPemeriksaan']->tgl_pemeriksaanSample.'</td>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td>'.$data['dataPemeriksaan']->pasienTglLahir.'</td>
                <td>Tanggal Penerimaan Hasil</td>
                <td>'.$data['dataPemeriksaan']->tgl_penerimaanHasil.'</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>'.$data['dataPemeriksaan']->pasienUmur.'</td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>'.$data['dataPemeriksaan']->pasienAlamat.'</td>
                <td> </td>
                <td> </td>
            </tr>
        </table> ';
           
    $html.='<div style="text-align: center;"><h3>HASIL LABORATORIUM</h3></div>
                <table cellspacing="1"  cellpadding="2">
                    <tr bgcolor="#666666">
                        <td align="center">PEMERIKSAAN</td>
                        <td align="center">HASIL</td>
                        <td align="center">Keterangan</td>
                        <td align="center">NILAI RUJUKAN</td>
                        <td align="center">SATUAN</td>
                        <td align="center">METODE</td>
                    </tr>';
       
              foreach($data['dataPemeriksaanDetail'] as $rowPemeriksaanDetail){ 
                $html.='<tr >
                <td align="center">'.$rowPemeriksaanDetail->paramNama.'</td> 
                <td align="center">'.$rowPemeriksaanDetail->dHasil.'</td> 
                <td align="center">'.$rowPemeriksaanDetail->dKeterangan.'</td> 
                <td align="center">'.$rowPemeriksaanDetail->paramNilaiRujukan.'</td>';   
                foreach($data['dataSatuan'] as $rowSatuan){ 
                if($rowPemeriksaanDetail->satuan_ID == $rowSatuan->satuanID){
                    if($rowSatuan->satuanNama == 'kosong'){
                        $html.='<td align="center"> </td>';
                    }else {
                        $html.='<td align="center">'.$rowSatuan->satuanNama.'</td>';
                    }
                }
            }
                foreach($data['dataBidang'] as $rowBidang){ 
                    if($rowPemeriksaanDetail->bidang_ID == $rowBidang->bidangID){
                        $html.='<td align="center">'.$rowBidang->bidangNama.'</td>';
                    }
                }
                $html.= '</tr> ';
        }
        
          
        $html.='</table>  <div style="border-top: 1px solid black; "></div>';
        $html.='<p><b>Catatan :</b> <br>'.$data['dataPemeriksaan']->pemeriksaanKet.'</p><br>';

        $html.='<p><b>Interpretasi : </b><br>';
        $i = 1;
        foreach($data['dataPesanInterpretasi'] as $rowPesanInterpretasi){
            $html.=$i++.'. '. $rowPesanInterpretasi->Interpretasi .'  <br>';
        }
        $html.='</p> ';

        $html.='<p><b>Saran : </b><br>';
        $i = 1;
        foreach($data['dataPesanSaran'] as $rowPesanSaran){
            $html.=$i++.'. '. $rowPesanSaran->Saran .'  <br>';
        }
        $html.='</p>';
     
        // $html.='</ul></li>';

        $html.=  '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  
        
        <table cellspacing="1"  cellpadding="2">
            <tr >
                <td width="50%" align="center"> </td>
                <td width="50%" align="center">Yogyakarta '.date('d M Y').' </td>
            </tr>
            <tr >
                <td width="50%" height="50px" align="center">Dokter Penganggung Jawab</td>
                <td width="50%" align="center">Pemeriksa</td>
            </tr>
            <tr>
                <td width="50%" height="10%" align="center"><img src="'.base_url('./upload/upload_tandatangan/'.$data['dataPemeriksaanCetak']->dokterTandaTangan).'"  width="100"></td>
                <td width="50%" height="10%" align="center"><img src="'.base_url('./upload/upload_tandatangan/'.$data['dataPemeriksaanCetak']->petugasTandaTangan).'"  width="100"></td>
            </tr>
            <tr >
                <td width="50%" align="center">'.$data['dataPemeriksaanCetak']->dokterNama.'</td>
                <td width="50%" align="center">'.$data['dataPemeriksaanCetak']->petugasNama.'</td>
            </tr>
        </table> ';
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        // $data = $pdf->Output(FCPATH.'/upload_pdf/hasil_lab_'.$id.'.pdf', 'F');
        $filePath = FCPATH.'/upload/hasil_lab_'.$id.'.pdf';
        try{
            $pdf->Output($filePath, 'F');
        } catch(Exception $ex){
            return false;
        }

        return file_exists($filePath);
    }

	// public function belumPemeriksaan(){
	// 	$status ="Belum Pemeriksaan";
	// 	$data['dataPemeriksaan'] = $this->Pemeriksaan_m->getByStatusID($status)->result();
	// 	$this->load->view('pemeriksaan/pemeriksaan_data', $data);
	// }


	
}
