<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('_partials/head.php');?>
  
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <?php $this->load->view('_partials/sidebar.php');?>
        <!-- top navigation -->
        <?php $this->load->view('_partials/navbar.php');?>
        <!-- /top navigation -->
        <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="clearfix"></div>
                    <div class="row" style="display: block;">
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 col-sm-12">
                            <?php if($dataPemeriksaan->pemeriksaanStatus == 'Selesai Pemeriksaan'){?>
                                <a href="<?= base_url('Print1/cetak/'.$dataPemeriksaan->pemeriksaanID)?>" class="bd-highligh float-right mr-5"><button class="btn btn-primary" id="btn-edit">Cetak PDF</button></a>  
                                <button  id="kirim_email" data="<?=$dataPemeriksaan->pemeriksaanID?>" class="bd-highligh float-right mr-2 btn btn-primary">Kirim PDF</button> 
                                <div class="spinner-border text-primary bd-highligh float-right mr-2" role="status" id="loaderDiv" style="display: none">
                                    <span class="sr-only">Loading...</span>
                                </div> 
                            <?php } ?>
                            <form id="formAdd" class="form-horizontal form-label-left px-5">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>PEMERIKSAAN</h2>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <input type="hidden" id="pemeriksaanIDX" class="form-control" value="<?=$dataPemeriksaan->pemeriksaanID?>">  
                                        <input type="hidden" name="pemeriksaanID" class="form-control" value="<?=$dataPemeriksaan->pemeriksaanID?>">   
                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3 ">STATUS</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <?php if($dataPemeriksaan->pemeriksaanStatus == 'Belum Pemeriksaan'){?>
                                                    <div class="btn btn-danger"><?=$dataPemeriksaan->pemeriksaanStatus?></div> 
                                                <?php }else if($dataPemeriksaan->pemeriksaanStatus == 'Proses Pemeriksaan'){ ?>
                                                    <div class="btn btn-primary "><?=$dataPemeriksaan->pemeriksaanStatus?></div> 
                                                <?php }else if($dataPemeriksaan->pemeriksaanStatus == 'Selesai Pemeriksaan'){?>
                                                    <div class="btn btn-success "><?=$dataPemeriksaan->pemeriksaanStatus?></div> 
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">NO RM</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" class="form-control" value="<?=$dataPemeriksaan->pasienNoRM?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">NAMA LENGKAP</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" class="form-control" value="<?=$dataPemeriksaan->pasienNamaLengkap?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>PARAMETER PEMERIKSAAN</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                         
                                            <div class="form-group row ">
                                                <label class="control-label col-md-3 col-sm-3 ">Dokter Penangung Jawab</label>
                                                <div class="col-md-9 col-sm-8 ">
                                                    <select class="form-control" name="dokterPJ" required>
                                                    <option>Pilih</option>
                                                    <?php
                                                    foreach($dataDokter as $rowDokter){
                                                        if($dataPemeriksaan->pemeriksaanDokterPJ_ID != null) {
                                                    ?>
                                                    <option value="<?=$rowDokter->dokterID?>" <?=$dataPemeriksaan->pemeriksaanDokterPJ_ID == $rowDokter->dokterID ? 'selected' : ''?>><?=$rowDokter->dokterNama?></option>                                                                 
                                                    <?php }else{ ?>
                                                        <option value="<?=$rowDokter->dokterID?>"><?=$rowDokter->dokterNama?></option>
                                                    <?php }}?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php 
                                                $sampleArray = array();
                                                foreach($dataPemeriksaanSample as $rowPemeriksaanSample){
                                                  $sampleArray[] =  $rowPemeriksaanSample->sample_ID;
                                                  $sampleID[] =  $rowPemeriksaanSample->samplePemeriksaanID;
                                                    }
                                            ?>                                           
                                            <div class="form-group row ">
                                                <label class="control-label col-md-3 col-sm-3 ">Jenis Sample</label>
                                                <div class="col-md-9 col-sm-8 ">
                                                <?php foreach($dataSample as $rowSample){?>
                                              
                                                
                                                   <div class="checkbox">
                                                        <label class="">
                                                            

                                                            <?php if(in_array($rowSample->sampleID, $sampleArray)){ ?>
                                                                
                                                                <input type="checkbox" name="jenisSample1[]" id="jenisSample1" data="" <?= in_array($rowSample->sampleID, $sampleArray) ? 'checked' : ''?>  data-id="<?=$rowSample->sampleID?>" value="<?=$rowSample->sampleID?>" class="case jenisSampleCheck" ><span style="font-size: 15px;">  <?=$rowSample->sampleNama ?></span> 
                                                             
                                                            
                                                             <?php }else{ ?>
                                                                <input type="checkbox" name="jenisSample[]" id="jenisSample1" data=""  data-id="<?=$rowSample->sampleID?>" value="<?=$rowSample->sampleID?>" class="case jenisSampleCheck" > <span style="font-size: 15px;">  <?=$rowSample->sampleNama ?></span>
                                                                <!-- <div class="icheckbox_flat-green" style="position: relative;">
                                                            
                                                                    <input type="checkbox" name="jenisSample1[]" value="<?=$rowSample->sampleID?>" class="flat"  onclick="myFunction()" style="position: absolute; opacity: 0;">
                                                                    
                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                    
                                                                </div> -->
                                                                
                                                             <?php } ?>
                                                       
                                                        
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>

                                            <div class="form-group row ">
                                                    <label class="control-label col-md-3 col-sm-3 ">Waktu Penerimaan Sample</label>
                                                <?php if($dataPemeriksaan->tgl_penerimaanSample != null){?>
                                                    <div class="col-md-5 col-sm-4">
                                                        <input name="wDPenerimaanSample" class="date-picker form-control"  value="<?=date('Y-m-d', strtotime($dataPemeriksaan->tgl_penerimaanSample));?>" readonly>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class='input-group date datetimepicker3' >
                                                            <input type='text' name="wTPenerimaanSample" class="date-picker form-control" value="<?=date('H:i:s', strtotime($dataPemeriksaan->tgl_penerimaanSample));?>" readonly/>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="col-md-5 col-sm-4">
                                                        <input name="wDPenerimaanSample" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"  onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" required>
                                                        <input type="hidden" name="petugasPemeriksaan" class="date-picker form-control"  value="<?=$this->fungsi->petugas_login()->petugasID?>" readonly>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class='input-group date datetimepicker3' >
                                                            <input type='text' name="wTPenerimaanSample" class="form-control" placeholder="JJ:MM:DD" required/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group row ">
                                                <label class="control-label col-md-3 col-sm-3 ">Waktu Pemeriksaan Sample</label>
                                                <?php if($dataPemeriksaan->tgl_penerimaanSample == null){?>
                                                    <div class="col-md-5 col-sm-4">
                                                        <input name="wDPemeriksaanSample" class="date-picker form-control" placeholder="dd-mm-yyyy"  readonly>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class='input-group date datetimepicker3'>
                                                            <input type='text' name="wTPemeriksaanSample" class="form-control" placeholder="JJ:MM:DD" readonly/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <?php if($dataPemeriksaan->tgl_pemeriksaanSample != null){?>
                                                    <div class="col-md-5 col-sm-4">
                                                        <input name="wDPemeriksaanSample" class="date-picker form-control" value="<?=date('Y-m-d', strtotime($dataPemeriksaan->tgl_pemeriksaanSample));?>" readonly>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class='input-group date datetimepicker3' >
                                                            <input type='text' name="wTPemeriksaanSample" class="date-picker form-control" value="<?=date('H:i:s', strtotime($dataPemeriksaan->tgl_pemeriksaanSample));?>" readonly/>
                                                        </div>
                                                    </div>
                                                    <?php }else{ ?>
                                                    <div class="col-md-5 col-sm-4">
                                                        <input name="wDPemeriksaanSample" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"  onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" required>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class='input-group date datetimepicker3'>
                                                            <input type='text' name="wTPemeriksaanSample" class="form-control" placeholder="JJ:MM:DD" required/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>	
                                            <div class="form-group row ">
                                                <label class="control-label col-md-3 col-sm-3 ">Waktu Penerimaan Hasil</label>
                                                <?php if($dataPemeriksaan->tgl_pemeriksaanSample == null ){?>
                                                    <div class="col-md-5 col-sm-4">
                                                        <input name="wDPenerimaanHasil" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"  onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" readonly>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class='input-group date datetimepicker3'>
                                                            <input type='text' name="wTPenerimaanHasil" class="form-control" placeholder="JJ:MM:DD" readonly/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <?php if($dataPemeriksaan->tgl_penerimaanHasil != null){?>
                                                        <div class="col-md-5 col-sm-4">
                                                            <input name="wDPenerimaanHasil" class="date-picker form-control" value="<?=date('Y-m-d', strtotime($dataPemeriksaan->tgl_penerimaanHasil));?>" readonly >
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <div class='input-group date datetimepicker3' >
                                                                <input type='text' name="wTPenerimaanHasil" class="date-picker form-control" value="<?=date('H:i:s', strtotime($dataPemeriksaan->tgl_penerimaanHasil));?>" readonly/>
                                                            </div>
                                                        </div>
                                                    <?php }else{ ?>
                                                        <div class="col-md-5 col-sm-4">
                                                            <input name="wDPenerimaanHasil" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"  onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" required>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <div class='input-group date datetimepicker3'>
                                                                <input type='text' name="wTPenerimaanHasil" class="form-control" placeholder="JJ:MM:DD" required/>
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>	
                                            <!-- /////////////////////////////////////////// -->
                                            <div class="form-group row">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="table-responsive" id="krtDesc">
                                                        <table class="table table-striped jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                <th>#</th>
                                                                <th class="column-title" style="display: table-cell;">Nama Pemeriksaan </th>
                                                                <th class="column-title" style="display: table-cell;">Nilai Rujukan </th>
                                                                <th class="column-title" style="display: table-cell;">Satuan</th>
                                                                <th class="column-title" style="display: table-cell;">Hasil </th>
                                                                <th class="column-title" style="display: table-cell;">Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $i = 1;
                                                                foreach($dataPemeriksaanDetail as $rowDetail){?>
                                                                    <tr class="even pointer">
                                                                        <td class="a-center ">
                                                                            <div class="checkbox">
                                                                                <label class="control-label"><?=$i++?></label>
                                                                                <input type="hidden" name="detailPemeriksaanID[]" class="form-control" value="<?=$rowDetail->dPemeriksaanID?>">
                                                                            </div>
                                                                        </td>
                                                                        <td class=" ">
                                                                            <span style="font-size:16px;"><?=$rowDetail->paramNama?> </span>    
                                                                        </td>
                                                                        <td class=" "> <?=$rowDetail->paramNilaiRujukan?> </td>
                                                                        <?php foreach($dataSatuan as $rowSatuan){ ?>
                                                                            <?php if($rowSatuan->satuanID == $rowDetail->satuan_ID){ ?>
                                                                                <?php if($rowSatuan->satuanNama == 'kosong'){?>
                                                                                    <td class=" "> -- </td>
                                                                                <?php }else{ ?>
                                                                                    <td class=" "> <?=$rowSatuan->satuanNama?> </td>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        <?php } ?>

                                                                        <td class=" ">  
                                                                            <?php if($rowDetail->dHasil != null){ ?>
                                                                                    <?php if($rowDetail->paramNilaiRujukan == 'Non Reaktif'){ ?>
                                                                                        <select class="form-control" name="hasilPemeriksaan[]" required>
                                                                                            <option value="Reaktif" <?=$rowDetail->dHasil == 'Reaktif' ? 'selected' : ''?>>Reaktif</option>
                                                                                            <option value="Non Reaktif" <?=$rowDetail->dHasil == 'Non Reaktif' ? 'selected' : ''?>>Non Reaktif</option>
                                                                                        </select>
                                                                                    <?php }else{ ?>
                                                                                        <input type="text" name="hasilPemeriksaan[]" class="form-control" value="<?=$rowDetail->dHasil?>" required> 
                                                                                    <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <?php if($dataPemeriksaan->tgl_pemeriksaanSample != null){ ?>
                                                                                    <?php if($rowDetail->paramNilaiRujukan == 'Non Reaktif'){ ?>
                                                                                        <select class="form-control" name="hasilPemeriksaan[]" required>
                                                                                            <option value="Reaktif">Reaktif</option>
                                                                                            <option value="Non Reaktif">Non Reaktif</option>
                                                                                        </select>
                                                                                    <?php }else{ ?>
                                                                                        <input type="text" name="hasilPemeriksaan[]" class="form-control" required>
                                                                                    <?php } ?>
                                                                                <?php }else{ ?>
                                                                                        <input type="text" name="hasilPemeriksaan[]" class="form-control" readonly>
                                                                                    <?php } ?>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td class=" ">  
                                                                            <?php if($rowDetail->dKeterangan != null){ ?>
                                                                                <select class="form-control" name="ketPemeriksaan[]" required>
                                                                                    <option>Pilih</option>     
                                                                                    <option value="Normal" <?=$rowDetail->dKeterangan == 'Normal' ? 'selected' : ''?>>Normal</option>        
                                                                                    <option value="Tidak Normal" <?=$rowDetail->dKeterangan == 'Tidak Normal' ? 'selected' : ''?>>Tidak Normal</option>                                        
                                                                                </select>
                                                                            <?php }else{  ?>
                                                                                <?php if($dataPemeriksaan->tgl_pemeriksaanSample != null){ ?>
                                                                                <select class="form-control" name="ketPemeriksaan[]" required>
                                                                                    <option>pilih</option>
                                                                                    <option value="Normal">Normal</option>
                                                                                    <option value="Tidak Normal">Tidak Normal</option>
                                                                                </select>
                                                                                <?php }else{ ?>
                                                                                    <select class="form-control" name="ketPemeriksaan[]" readonly>
                                                                                    <option>pilih</option>
                                                                                    <option value="Normal">Normal</option>
                                                                                    <option value="Tidak Normal">Tidak Normal</option>
                                                                                </select>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                            <?php } ?>                   
                                                            </tbody>
                                                        </table>
                                                    </div>                
                                                </div>
                                            </div>
                                            <!-- /////////////////////////////////////////// -->
                                            <?php if($dataPemeriksaan->tgl_pemeriksaanSample != null){ ?>
                                                <?php if($dataPemeriksaan->pemeriksaanKet != null){?>
                                                    <div class="form-group row ">
                                                        <label class="control-label col-md-3 col-sm-3 ">Catatan</label>
                                                        <div class="col-md-9 col-sm-8 ">
                                                            <textarea id="message" required="required" class="form-control" name="pemeriksaanCat" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=$dataPemeriksaan->pemeriksaanKet?></textarea>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="form-group row ">
                                                        <label class="control-label col-md-3 col-sm-3 ">Catatan</label>
                                                        <div class="col-md-9 col-sm-8 ">
                                                            <textarea id="message" required="required" class="form-control" name="pemeriksaanCat" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <div class="form-group row ">
                                                    <label class="control-label col-md-3 col-sm-3 ">Catatan</label>
                                                    <div class="col-md-9 col-sm-8 ">
                                                        <textarea id="message" disabled class="form-control" name="pemeriksaanCat" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <hr>
                                            <!-- ///////////////////////////////Interpretasi///////////////////////////////////// -->
                                            <?php if($dataPemeriksaan->tgl_pemeriksaanSample != null){ ?>
                                                <div class="form-group row ">
                                                    <label class="control-label col-md-3 col-sm-3 ">Interpretasi</label>
                                                    <div class="col-md-9 col-sm-8 ">
                                                <?php foreach($dataInterpretasi as $rowInterpretasi){ 
                                                        if($rowInterpretasi != null){?>
                                                            <input type="hidden" id="messageInterpretasixID" name="messageInterpretasixID[]" value="<?=$rowInterpretasi->InterpretasiID?>">
                                                            <div class="input-group">
                                                                <textarea class="form-control" name="messageInterpretasix[]"  aria-label="With textarea"><?=$rowInterpretasi->Interpretasi?></textarea>
                                                                <div class="input-group-prepend">
                                                                    <button id="dellInterpretasix" data="<?=$rowInterpretasi->InterpretasiID?>" type="button" class="input-group-text  btn-danger delInterpretasix">Hapus</button>
                                                                </div>
                                                            </div>
                                                        <?php } else{ ?>
                                                            <textarea  required="required" class="form-control" name="messageInterpretasi[]" placeholder="Masukan Interpretasi " data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                                            <br>
                                                        <?php } ?>
                                                <?php } ?>
                                                        <div id="messageInterpretasi">
                                                            <div id="messageInterpretasi1"></div>      
                                                        </div>
                                                        <button id="addInterpretasi" type="button"  class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Interpretasi</button>
                                                        <button id="delInterpretasi" type="button"  class="btn btn-success btn-sm" ><i class="fa fa-minus"></i> Interpretasi</button>
                                                    </div>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="form-group row ">
                                                    <label class="control-label col-md-3 col-sm-3 ">Interpretasi</label>
                                                    <div class="col-md-9 col-sm-8 ">
                                                    <textarea id="message" disabled class="form-control" name="messageInterpretasi" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <!-- ////////////////////////////////////////////////////////////// -->
                                            <hr>
                                            <!-- ////////////////////////////////SARAN//////////////////////////////////// -->
                                            <?php if($dataPemeriksaan->tgl_pemeriksaanSample != null){ ?>
                                                <div class="form-group row ">
                                                    <label class="control-label col-md-3 col-sm-3 ">Saran</label>
                                                    <div class="col-md-9 col-sm-8 ">
                                                <?php foreach($dataSaran as $rowSaran){ 
                                                        if($rowSaran != null){?>
                                                            <input type="hidden" id="messageSaranxID" name="messageSaranxID[]" value="<?=$rowSaran->SaranID?>">
                                                            <div class="input-group">
                                                                <textarea class="form-control" name="messageSaranx[]"  aria-label="With textarea"><?=$rowSaran->Saran?></textarea>
                                                                <div class="input-group-prepend">
                                                                    <button id="dellSaranx" data="<?=$rowSaran->SaranID?>" type="button" class="input-group-text  btn-danger delSaranx">Hapus</button>
                                                                </div>
                                                            </div>
                                                        <?php } else{ ?>
                                                            <textarea  required="required" class="form-control" name="messageInterpretasi[]" placeholder="Masukan Saran " data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                                            <br>
                                                        <?php } ?>
                                                <?php } ?>
                                                        <div id="messageSaran">
                                                            <div id="messageSaran1"></div>      
                                                        </div>
                                                        <button id="addSaran" type="button"  class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Saran</button>
                                                        <button id="delSaran" type="button"  class="btn btn-success btn-sm" ><i class="fa fa-minus"></i> Saran</button>
                                                    </div>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="form-group row ">
                                                    <label class="control-label col-md-3 col-sm-3 ">Saran</label>
                                                    <div class="col-md-9 col-sm-8 ">
                                                    <textarea id="message" disabled class="form-control" name="messageSaran" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                                <!-- ////////////////////////////////////////////////////////////// -->
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-9 col-sm-9  offset-md-3">
                                                    <!-- <button type="button" class="btn btn-primary">Cancel</button> -->
                                                    <a href="<?=site_url('Pemeriksaan')?>" class="btn btn-primary">Cancel</a>
                                                    <?php if($this->fungsi->petugas_login()->petugasLevel == 3){?>
                                                    <button type="reset" class="btn btn-primary">Reset</button>
                                                    <button type="submit" class="btn btn-success" id="add" >Submit</button>
                                                <?php } ?>
                                                </div>
                                            </div>
                                    </div><!--x_content --> 
                                </div> <!--xpanel -->      
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view('_partials/footer.php');?>
        <!-- /footer content -->
      </div>
    </div>
    <?php $this->load->view('_partials/js.php');?>
     <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 3){?>

<script type="text/javascript">
    $(document).ready(function() {
        var idx = $('#pemeriksaanIDX').val();
        $(function () {
            $('.datetimepicker3').datetimepicker({
                format: 'HH:mm:00'
            });
        });
          
        $('#addInterpretasi').on('click', function(){
            $('#messageInterpretasi').children("div[id=messageInterpretasi1]:last").append('<div id="messageInterpretasi2"><textarea  required="required" class="form-control" name="messageInterpretasi[]" placeholder="Masukan Interpretasi" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea><br></div> ');
        });

        $('#delInterpretasi').on('click', function(){
            $('#messageInterpretasi1').children("div[id=messageInterpretasi2]:last").remove();
        });

        $('#addSaran').on('click', function(){
            
            $('#messageSaran').children("div[id=messageSaran1]:last").append('<div id="messageSaran2"> <textarea  required="required" class="form-control" name="messageSaran[]" placeholder="Masukan Saran " data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea><br></div> ');
        });

        $('#delSaran').on('click', function(){
            $('#messageSaran1').children("div[id=messageSaran2]:last").remove();
        });
   


        $('.delInterpretasix').on('click', function(){
            var id=$(this).attr("data");
            console.log(id);
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
                
            if (result.isConfirmed) {
                $.ajax({
                type : "POST",
                url  : "<?php echo base_url('Pemeriksaan/deletInterpretasi/')?>",
                dataType : "JSON",
                data : {id: id},
                success: function(data){
                    console.log('success');
                    if(data.status == 'success'){
                        swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        ).then(function(){
                            location.reload();
                        });  
                    }
                                
                }     
            });
            return false;
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })

            // $('#modalHapus').modal('show');
            // $('[name="deletepenggunaID"]').val(id);
        });


        $('.delSaranx').on('click', function(){
            var id=$(this).attr("data");
            console.log(id);
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
                
            if (result.isConfirmed) {
                $.ajax({
                type : "POST",
                url  : "<?php echo base_url('Pemeriksaan/deletSaran/')?>",
                dataType : "JSON",
                data : {id: id},
                success: function(data){
                    console.log('success');
                    if(data.status == 'success'){
                        swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        ).then(function(){
                            location.reload();
                        });  
                    }
                                
                }     
            });
            return false;
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })

            // $('#modalHapus').modal('show');
            // $('[name="deletepenggunaID"]').val(id);
        });

        $('#add').on('click', function(){
          
            $.ajax({
                type : "POST",
                url  :"<?php echo base_url('Pemeriksaan/pemeriksaanProses_penerimaan')?>",
                dataType : "JSON",
                data : $('#formAdd').serialize(),
                success: function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        console.log("sukses");
                    
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Di Tambahkan!',
                        
                        }).then(function() {
                            window.location.assign("<?php echo base_url();?>Pemeriksaan/pemeriksaanProses/"+idx);
                        });
                    
                    }else{
                        // $('.gejalaCode_error').html(data.gejalaCode);
                        // $('.gejalaNama_error').html(data.gejalaNama);
                    } 
                }
            });
            return false;
        });

        $('#kirim_email').on('click', function(){
            var id=$(this).attr("data");
            
            $.ajax({
                type : "POST",
                url  :"<?php echo base_url('Send_email/send/')?>",
                dataType : "JSON",
                data : {id: id},
                beforeSend: function() {
                    // $("#loaderDiv").show();
                    document.getElementById("loaderDiv").style.display = 'block';
                },
                success: function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        console.log("sukses");
                    
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Di Tambahkan!',
                        
                        }).then(function() {
                            window.location.assign("<?php echo base_url();?>Pemeriksaan/pemeriksaanProses/"+idx);
                        });
                    
                    }else{
                        // $('.gejalaCode_error').html(data.gejalaCode);
                        // $('.gejalaNama_error').html(data.gejalaNama);
                    } 
                }
            });
            return false;
        });

        
        $('.jenisSampleCheck').change(function() {
            var pemeriksaanID = $('#pemeriksaanIDX').val();
            var jenisSampleID = $(this).val();
            // console.log(pemeriksaanID);
            // console.log(jenisSampleID);

            $.ajax({
                type : "POST",
                url  :"<?php echo base_url('Pemeriksaan/deletSample/')?>",
                dataType : "JSON",
                data : {pemeriksaanID: pemeriksaanID, jenisSampleID:jenisSampleID},
                success: function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        console.log("sukses");
                    
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Di Tambahkan!',
                        
                        }).then(function() {
                            window.location.assign("<?php echo base_url();?>Pemeriksaan/pemeriksaanProses/"+idx);
                        });
                    
                    }else{
                        // $('.gejalaCode_error').html(data.gejalaCode);
                        // $('.gejalaNama_error').html(data.gejalaNama);
                    } 
                }
            });
            return false;
            // console.log(z);
            // console.log("hello");
        })

        

        // $('.myCheckbox').prop('checked', false);

        // $('#jenisSampleCheck').prop(function(){
        //     $('input[type=checkbox]').prop('checked');
        //         console.log("Uncheck");
        //     }
            

        // });

});

</script>
 <?php } ?>

 <script>
     
 $('#kirim_email').on('click', function(){
            var id=$(this).attr("data");
            
            $.ajax({
                type : "POST",
                url  :"<?php echo base_url('Send_email/send/')?>",
                dataType : "JSON",
                data : {id: id},
                beforeSend: function() {
                    // $("#loaderDiv").show();
                    document.getElementById("loaderDiv").style.display = 'block';
                },
                success: function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        console.log("sukses");
                    
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Di Tambahkan!',
                        
                        }).then(function() {
                            window.location.assign("<?php echo base_url();?>Pemeriksaan/pemeriksaanProses/"+idx);
                        });
                    
                    }else{
                        // $('.gejalaCode_error').html(data.gejalaCode);
                        // $('.gejalaNama_error').html(data.gejalaNama);
                    } 
                }
            });
            return false;
        });

 </script>
   
</body>
</html>
