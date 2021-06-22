
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
													<h2 class="align-center">Edit Petugas</h2>
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Petugas Nama</label>
														<div class="col-md-9 col-sm-9 ">
															<input type="hidden" id="petugasID" name="petugasID" class="form-control" value="<?=$rowPetugas->petugasID?>">
                                                            <input type="text" id="petugasNama" name="petugasNama" class="form-control" value="<?=$rowPetugas->petugasNama?>">
                                                            
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">User</label>
														<div class="col-md-9 col-sm-9 ">
															
                                                            <input type="text" id="petugasUser" name="petugasUser" class="form-control" value="<?=$rowPetugas->petugasUser?>">
                                                            
														</div>
													</div>	
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Pass</label>
														<div class="col-md-9 col-sm-9 ">
															
                                                            <input type="password" id="petugasPass" name="petugasPass" class="form-control" value="<?=$rowPetugas->petugasPass?>">
                                                            
														</div>
													</div>

                                                    <?php if($rowPetugas->petugasLevel == 3){?>
                                                    
                                                    <div class="form-group row ">
														<label class="control-label col-md-3 col-sm-3 ">Tanda Tangan</label>
														<div class="col-md-9 col-sm-9 ">
                                                            <span>Hanya Di Isi Oleh Petugas Laboratorium</span>
                                                            <input type="file" id="petugasTandaTangan" name="petugasTandaTangan" class="form-control">
                                                            <input type="text" id="petugasTandaTangan_old" name="petugasTandaTangan_old" class="form-control" value="<?=$rowPetugas->petugasTandaTangan?>" readonly>
														</div>
													</div>
                                                <?php }else{ ?>
                                                    
                                                           
                                                            <input hidden type="file" id="petugasTandaTangan" name="petugasTandaTangan" class="form-control">
                                                            <input hidden type="text" id="petugasTandaTangan_old" name="petugasTandaTangan_old" class="form-control" value="<?=$rowPetugas->petugasTandaTangan?>">
                                                       
                                                <?php } ?>

                                                    <div class="form-group row">
														<label class="control-label col-md-3 col-sm-3 ">Level</label>
														<div class="col-md-9 col-sm-9 ">
                                                            <select class="form-control" id="petugasLevel" name="petugasLevel">
																<option value="1" <?=$rowPetugas->petugasLevel == '1' ? 'selected' : ''?>>Admin</option>
                                                                <option value="2" <?=$rowPetugas->petugasLevel == '2' ? 'selected' : ''?>>Petugas Pendaftaran</option>
																<option value="3" <?=$rowPetugas->petugasLevel == '3' ? 'selected' : ''?>>Petugas Laboratorium</option>
                                                                <option value="4" <?=$rowPetugas->petugasLevel == '4' ? 'selected' : ''?>>Manager Mutu</option>
															</select>
														</div>
													</div>
													
													<div class="ln_solid"></div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9  offset-md-3">
                                                            <a href="<?=site_url('admin/Petugas')?>" class="btn btn-primary">Cancel</a>
															<!-- <button type="button" class="btn btn-primary">Cancel</button> -->
															<button type="reset" class="btn btn-primary">Reset</button>
															<input type="submit" id="edit" class="btn btn-success" value="Submit">
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

    // $('#edit').on('click', function(){
    //     $.ajax({
    //         type : "POST",
    //         url  :"<?php echo base_url('admin/Petugas/editPetugas')?>",
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
    //                     window.location.assign("<?php echo base_url();?>admin/Petugas/");
    //                 });
                
    //             }else{
    //                 // $('.gejalaCode_error').html(data.gejalaCode);
    //                 // $('.gejalaNama_error').html(data.gejalaNama);
    //             } 
    //         }
    //     });
    // return false;
    // });


    $('#edit').on('click', function(e){
        console.log("add");
        // $('.projectFile_error').empty();  
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('petugasID', $("#petugasID").val());
        myformData.append('petugasNama', $("#petugasNama").val());
        myformData.append('petugasUser', $("#petugasUser").val());
        myformData.append('petugasPass', $("#petugasPass").val());
        myformData.append('petugasLevel', $("#petugasLevel").val());

        myformData.append('petugasTandaTangan_old', $("#petugasTandaTangan_old").val());
        myformData.append('petugasTandaTangan', $('#petugasTandaTangan')[0].files[0]);
        console.log(myformData);
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('admin/Petugas/editPetugas')?>",
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
                        window.location.assign("<?php echo base_url();?>admin/Petugas/");
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
