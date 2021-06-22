
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('_partials/head.php');?>
  </head>

  <body>
    <div class="container body">
      <div class="main_container">
      
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
									<form  id="formAdd" data-parsley-validate="" class="form-horizontal form-label-left d-flex justify-content-center" novalidate="" action="<?php echo base_url();?>Antrian/addAntrian"  method="POST">			
										<div class="col-md-8 ">
											<div class="x_panel ">
												<div class="x_title">
													<!-- <h2 class="align-center">Tambah Sample</h2> -->
													<div class="clearfix"></div>
												</div>
												<div class="x_content d-flex justify-content-center">
                                                    <div class="card text-white  bg-primary mb-4" style="max-width: 18rem; text-align:center">
                                                        <div class="card-header">Ambil Antrian</div>
                                                        <div class="card-body ">
                                                            <!-- <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;">A001</h1> -->
                                                            <?php if($rowAntrian1 == null){?>
                                                                <input type="hidden" name="antrianNO" class="card-title d-flex justify-content-center" style="font-size: 50px;" value="A001">
                                                                <h1 class="card-title d-flex justify-content-center" style="font-size: 60px;">A001</h1>
                                                                <?php }else{ 
                                                                    $antrianNo = $rowAntrian1->antrianNO;
                                                                    $urut   = substr($antrianNo, 1, 3);
                                                                    $tambah = (int) $urut + 1;
                                                                    if(strlen($tambah) == 1){
                                                                        $format = "A00".$tambah;
                                                                        echo $format;
                                                                    } 
                                                                    elseif(strlen($tambah) == 2){
                                                                        $format = "A0".$tambah;
                                                                        echo $format;
                                                                    }
                                                                    else{
                                                                        $format = "A".$tambah;
                                                                        echo $format;
                                                                    }
                                                                    echo $tambah;
                                                                    ?>
                                                                <input type="hidden" name="antrianNO" class="card-title d-flex justify-content-center" style="font-size: 50px;" value="<?=$format?>">
                                                                <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;"><?=$format?></h1>
                                                                <?php } ?>
                                                            
                                                        </div>
                                                        <div class="card-footer">
                                                            <input name="submit" class="btn btn-primary px-5" type="submit" value="Ambil">
                                                            <!-- <button class="btn btn-primary px-5"></button> -->
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
        
        <!-- /footer content -->
      </div>
    </div>
    <?php $this->load->view('_partials/js.php');?>

	<script>

$(document).ready(function(){

    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('admin/Sample/addSample')?>",
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
                        window.location.assign("<?php echo base_url();?>admin/Sample");
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
