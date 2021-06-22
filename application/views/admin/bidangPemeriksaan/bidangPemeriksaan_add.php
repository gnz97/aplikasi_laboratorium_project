
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
													<h2 class="align-center">Tambah Bidang Pemeriksaan</h2>
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Bidang</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="text" name="bidangNama" class="form-control">
														</div>
													</div>	
													
													<div class="ln_solid"></div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9  offset-md-3">
															<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
                                                            <a href="<?=site_url('admin/BidangPemeriksaan')?>" class="btn btn-primary">Cancel</a>
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
            url  :"<?php echo base_url('admin/BidangPemeriksaan/addBidangPemeriksaan')?>",
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
                        window.location.assign("<?php echo base_url();?>admin/BidangPemeriksaan");
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
