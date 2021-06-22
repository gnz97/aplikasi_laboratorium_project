
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('_partials/head.php');?>
  </head>

  <body class="bg-light">
    <div class="mt-5" >
      <div class="mt-5">
      
        <!-- /top navigation -->
        <!-- page content -->
        <div   data-parsley-validate="" class="form-horizontal form-label-left d-flex justify-content-center" novalidate="" >			
            <div class="" >
                            <div class="card text-white  bg-primary mb-4" style="max-width: 19rem; text-align:center">
                                <div class="card-header">Panggil Antrian</div>
                                <div class="card-body ">
                                    <!-- <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;">A001</h1> -->
                                    <!-- <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;">A001</h1> -->
                                    <?php if($rowAntrian == null){?>
                                                              
                                                              <h1 class="card-title d-flex justify-content-center align-center">Tidak Ada Antrian</h1>
                                                              <?php }else{ 
                                                                  $antrianNo = $rowAntrian->detail_antrianNo;
                                                                 
                                                                  ?>
                                                                  
                                                              <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;"><?=$antrianNo?></h1>
                                                              <?php } ?>
                                    
                                </div>
                                <div class="card-footer">
                                <?php if($rowAntrian != null){?>
                                <a href="<?= base_url('Antrian/setPanggil/'.$rowAntrian->detail_antrianID)?>"><button class="btn btn-info px-5" id="btn-edit">Panggil</button></a>  
                                <?php } ?>
                                    <!-- <button class="btn btn-primary px-5"></button> -->
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
