<?php




            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Daftar Produk');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(38);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage();
            $i=0;
            $pdf->SetFont('helvetica', '', 9);
            // $img_file = K_PATH_IMAGES.'aa.jpg';
		    // $pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
            // $pdf->Ln(5);
            // $pdf->Cell(47, 0, 'ATCTC', 0, 0, 'C');
            // $pdf->Cell(47, 0, 'ATCTC', 0, 0, 'C');
            // $pdf->Cell(47, 0, 'ASS', 0, 1, 'C');
            // $pdf->Cell(47, 0, 'ASS', 0, 1, 'C');
            
            $html='
            <div style="border-top: 1px solid black; "></div>
          
            <table cellspacing="1"  cellpadding="2" style="border: 1px solid black; ">
                <tr >
                    <td width="15%">No LAB/No RM</td>
                    <td width="37%">'.$dataPemeriksaan->pemeriksaanID.'/'.$dataPemeriksaan->pasienNoRM.'</td>
                    <td width="25%">Dokter</td>
                    <td width="23%">'.$dataPemeriksaan->pemeriksaanDokter.'</td> 
                </tr>
                <tr >
                    <td>No Identitas</td>
                    <td>'.$dataPemeriksaan->pasienNoIdentitas.'</td>
                    <td>Asal Unit</td>
                    <td>'.$dataPemeriksaan->pemeriksaanUnitPengirim.'</td>
                </tr>
                <tr >
                    <td>Nama</td>
                    <td>'.$dataPemeriksaan->pasienNamaLengkap.'</td>
                    <td>Tanggal Penerima Sample</td>
                    <td>'.$dataPemeriksaan->tgl_penerimaanSample.'</td>
                </tr>
                <tr >
                    <td>J Kelamin</td>
                    <td>'.$dataPemeriksaan->pasienJK.'</td>
                    <td>Tanggal Pemeriksaan Sample</td>
                    <td>'.$dataPemeriksaan->tgl_pemeriksaanSample.'</td>
                </tr>
                <tr >
                    <td>Tgl Lahir</td>
                    <td>'.$dataPemeriksaan->pasienTglLahir.'</td>
                    <td>Tanggal Penerimaan Hasil</td>
                    <td>'.$dataPemeriksaan->tgl_penerimaanHasil.'</td>
                </tr>
                <tr b>
                    <td>Umur</td>
                    <td>'.$dataPemeriksaan->pasienUmur.'</td>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr >
                    <td>Alamat</td>
                    <td>'.$dataPemeriksaan->pasienAlamat.'</td>
                    <td> </td>
                    <td> </td>
                </tr>
            </table> ';
               
        $html.='
      
        <div style="text-align: center;"><h3>HASIL LABORATORIUM</h3></div>
                    
                    <table cellspacing="1"  cellpadding="2">
                        <tr bgcolor="#666666">
                            <td align="center">PEMERIKSAAN</td>
                            <td align="center">HASIL</td>
                            <td align="center">Keterangan</td>
                            <td align="center">NILAI RUJUKAN</td>
                            <td align="center">SATUAN</td>
                            <td align="center">METODE</td>
                        </tr>';
           
                  foreach($dataPemeriksaanDetail as $rowPemeriksaanDetail){ 
                    $html.='<tr >
                    <td align="center">'.$rowPemeriksaanDetail->paramNama.'</td> 
                    <td align="center">'.$rowPemeriksaanDetail->dHasil.'</td> 
                    <td align="center">'.$rowPemeriksaanDetail->dKeterangan.'</td> 
                    <td align="center">'.$rowPemeriksaanDetail->paramNilaiRujukan.'</td>';   
                    foreach($dataSatuan as $rowSatuan){ 
                    if($rowPemeriksaanDetail->satuan_ID == $rowSatuan->satuanID){
                        if($rowSatuan->satuanNama == 'kosong'){
                            $html.='<td align="center"> </td>';
                        }else {
                            $html.='<td align="center">'.$rowSatuan->satuanNama.'</td>';
                        }
                    }
                }
                    foreach($dataBidang as $rowBidang){ 
                        if($rowPemeriksaanDetail->bidang_ID == $rowBidang->bidangID){
                            $html.='<td align="center">'.$rowBidang->bidangNama.'</td>';
                        }
                    }
                    $html.= '</tr> ';
            }
            
              
            $html.='</table>  <div style="border-top: 1px solid black; "></div>';
            $html.='<p><b>Catatan :</b> <br>'.$dataPemeriksaan->pemeriksaanKet.'</p><br>';

            $html.='<p><b>Interpretasi : </b><br>';
            $i = 1;
            foreach($dataPesanInterpretasi as $rowPesanInterpretasi){
                $html.=$i++.'. '. $rowPesanInterpretasi->Interpretasi .'  <br>';
            }
            $html.='</p> ';

            $html.='<p><b>Saran : </b><br>';
            $i = 1;
            foreach($dataPesanSaran as $rowPesanSaran){
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
                <tr >
                <td width="50%" height="10%" align="center"><img src="'.base_url('./upload/upload_tandatangan/'.$dataPemeriksaanCetak->dokterTandaTangan).'"  width="100"></td>
                    <td width="50%" height="10%" align="center"><img src="'.base_url('./upload/upload_tandatangan/'.$dataPemeriksaanCetak->petugasTandaTangan).'"  width="100"></td>
                </tr>
                <tr >
                    <td width="50%" align="center">'.$dataPemeriksaanCetak->dokterNama.'</td>
                    <td width="50%" align="center">'.$dataPemeriksaanCetak->petugasNama.'</td>
                </tr>
            </table> ';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('daftar_produk.pdf', 'I');
?>