
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
							<div class="x_panel">  
								<div class="x_content ">
									<br>
									<form  id="formAdd" data-parsley-validate="" class="form-horizontal form-label-left d-flex justify-content-center" novalidate="" >			
										<div class="col-md-10 ">
											<div class="x_panel ">
												<div class="x_title">
													<h2 class="align-center">Tambah Parameter</h2>
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Nama Parameter</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="paramNama" class="form-control" >
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Bidang Parameter</label>
														<div class="col-md-9 col-sm-9 ">
															<select class="form-control bidangC" name="paramBidang">
                                                            <?php
                                                            foreach($dataBidang as $rowBidang){?>
																<option value="<?=$rowBidang->bidangID?>"><?=$rowBidang->bidangNama?></option>
																
                                                            <?php } ?>
															</select>
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Status Parameter</label>
														<div class="col-md-9 col-sm-9 ">
															<select class="form-control" name="paramStatus">
																<option value="umum">UMUM</option>
                                                                <option value="laki-laki">LAKI-LAKI</option>
                                                                <option value="perempuan">PEREMPUAN</option>
															</select>
														</div>
													</div>	
                                                    
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Nilai Rujukan</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" id="nr" name="paramNR" class="form-control" >
															
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Satuan</label>
														<div class="col-md-9 col-sm-9 ">
															<select class="form-control" id="satuanC" name="paramSatuan">
                                                            <?php
                                                            foreach($dataSatuan as $rowSatuan){?>
																<option value="<?=$rowSatuan->satuanID?>"><?=$rowSatuan->satuanNama?></option>
																
                                                            <?php } ?>
															</select>
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Harga</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="paramHarga" class="form-control"placeholder="Rp." >
														</div>
													</div>	
													
													<div class="ln_solid"></div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9  offset-md-3">
															<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
															<a href="<?=site_url('admin/ParamPemeriksaan')?>" class="btn btn-primary">Cancel</a>
															<button type="reset" class="btn btn-primary">Reset</button>
															<input type="submit" id="add" class="btn btn-success" value="Submit">
															<!-- <button type="submit" class="btn btn-success">Submit</button> -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
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

	<script>

$(document).ready(function(){
	$("select.bidangC").change(function(){
        var selectedCountry = $(this).children("option:selected").val();
		if(selectedCountry == 3){
			$('#nr').val("Non Reaktif");
			// $('#nr').prop( "disabled", true );
			// $('#satuanC').prop( "disabled", true );
		}
        // alert("You have selected the country - " + selectedCountry);
    });

    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('admin/ParamPemeriksaan/addParam')?>",
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
                        window.location.assign("<?php echo base_url();?>admin/ParamPemeriksaan");
                    });
                
                }else{
                    // $('.gejalaCode_error').html(data.gejalaCode);
                    // $('.gejalaNama_error').html(data.gejalaNama);
                } 
            }
        });
    return false;
    });

});

</script>
   
  </body>
</html>
