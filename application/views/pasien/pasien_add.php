
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
										<div class="col-md-8 ">
											<div class="x_panel ">
												<div class="x_title">
													<h2 class="align-center">PENDAFTARAN PASIEN BARU</h2>
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">No RM</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="noRMPasien" class="form-control" >
															<span class="noRMPasien_error text-danger"></span>
														</div>
													</div>	
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">No Identitas</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="noIDentitasPasien" class="form-control" >
															<span class="noIDentitasPasien_error text-danger"></span>
														</div>
													</div>
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Nama Lengkap</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="namaLengkapPasien" class="form-control" >
															<span class="namaLengkapPasien_error text-danger"></span>
														</div>
													</div>
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Email</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="emailPasien" class="form-control" >
															<span class="emailPasien_error text-danger"></span>
														</div>
													</div>
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Tempat/tanggal Lahir</label>
														<div class="col-md-5 col-sm-3 ">
															<input type="text" name="tempatLahirPasien" class="form-control" >
															<span class="tempatLahirPasien_error text-danger"></span>
														</div>
														<div class="col-md-4 col-sm-3 ">
															<input name="tglLahirPasien" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
															<span class="tglLahirPasien_error text-danger"></span>
														</div>
													</div>	
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Umur</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="umurPasien" class="form-control" >
															<span class="umurPasien_error text-danger"></span>
														</div>
													</div>
													<div class="form-group row">
														<label class="control-label col-md-3 col-sm-3 ">Jenis Kelamin</label>
														<div class="col-md-9 col-sm-9 ">
															<select class="form-control" name="jkPasien">
																<option value="laki-laki">Laki-Laki</option>
																<option value="perempuan">Perempuan</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="control-label col-md-3 col-sm-3 ">Alamat <span class="required">*</span>
														</label>
														<div class="col-md-9 col-sm-9 ">
															<textarea class="form-control" name="alamatPasien" rows="3" ></textarea>
															<span class="alamatPasien_error text-danger"></span>
														</div>
													</div>
													
													<div class="form-group row">
														<label class="control-label col-md-3 col-sm-3 ">status</label>
														<div class="col-md-9 col-sm-9 ">
															<select class="form-control" name="status">
																<option value="1">Umum</option>
																<option value="2">BPJS</option>
																<option value="3">ASKES</option>
																<option value="4">KIS</option>
																<option value="5">DLL</option>
															</select>
														</div>
													</div>
													<div class="ln_solid"></div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9  offset-md-3">
															<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
															<a href="<?=site_url('Pasien')?>" class="btn btn-primary">Cancel</a>
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

    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('Pasien/addPasien')?>",
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
                        window.location.assign("<?php echo base_url();?>Pendaftaran");
                    });
                
                }else{
                    $('.noRMPasien_error').html(data.noRMPasien);
					$('.noIDentitasPasien_error').html(data.noIDentitasPasien);
					$('.namaLengkapPasien_error').html(data.namaLengkapPasien);
					$('.emailPasien_error').html(data.emailPasien);
					
					$('.tempatLahirPasien_error').html(data.tempatLahirPasien);
					$('.tglLahirPasien_error').html(data.tglLahirPasien);
					$('.umurPasien_error').html(data.umurPasien);
					$('.alamatPasien_error').html(data.alamatPasien);
                } 
            }
        });
    return false;
    });

});

</script>
   
  </body>
</html>
