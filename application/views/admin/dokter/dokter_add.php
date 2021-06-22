
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
													<h2 class="align-center">Tambah dokter</h2>
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Nama</label>
														<div class="col-md-9 col-sm-9 ">
                                                            <input type="text" id="dokterNama" name="dokterNama" class="form-control" value="">
                                                            
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">dokterJk</label>
														<div class="col-md-9 col-sm-9 ">
                                                            <input type="text" id="dokterJk" name="dokterJk" class="form-control" value="">
                                                            
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">dokterTandaTangan</label>
														<div class="col-md-9 col-sm-9 ">
                                                            <input type="file" id="dokterTandaTangan" name="dokterTandaTangan" class="form-control" value="">
                                                            
														</div>
													</div>	
                                                    
                                                    
                                                    
													
													<div class="ln_solid"></div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9  offset-md-3">
                                                            <a href="<?=site_url('admin/dokter')?>" class="btn btn-primary">Cancel</a>
															<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
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

    // $('#add').on('click', function(){
    //     $.ajax({
    //         type : "POST",
    //         url  :"<?php echo base_url('admin/dokter/adddokter')?>",
    //         dataType : "JSON",
    //         data : $('#formAdd').serialize(),
    //         success: function(data){
    //             console.log(data);
    //             if(data.status == 'success'){
    //                 console.log("sukses");
                
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Berhasil',
    //                     text: 'Data Berhasil Di Tambahkan!',
                    
    //                 }).then(function() {
    //                     window.location.assign("<?php echo base_url();?>admin/dokter/");
    //                 });
                
    //             }else{
    //                 // $('.gejalaCode_error').html(data.gejalaCode);
    //                 // $('.gejalaNama_error').html(data.gejalaNama);
    //             } 
    //         }
    //     });
    // return false;
    // });


    $('#add').on('click', function(e){
        console.log("add");
        // $('.projectFile_error').empty();  
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('dokterNama', $("#dokterNama").val());
        myformData.append('dokterJk', $("#dokterJk").val());
        myformData.append('dokterTandaTangan', $('#dokterTandaTangan')[0].files[0]);
        console.log(myformData);
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('admin/Dokter/adddokter')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    // $('.projectFile_error').html("");
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'File Berhasil Di Simpan!',
                        text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>admin/dokter/");
                    });
                    

                 } 
                //else{
                //     console.log(response);
                //     $('.projectFile_error').html(response.projectFile);
                // }   
            }
        });
        return false;
    });


});

</script>
   
  </body>
</html>
