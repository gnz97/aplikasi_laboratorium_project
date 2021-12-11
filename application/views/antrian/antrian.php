
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('_partials/head.php');?>
  <style>
      .image-background {
  height: 90vh;
  /* min-height: 500px; */
  background-image: url("<?= base_url('assets/images/bg_antrain3.jpg')?>");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
  </style>
  </head>

  <body class="bg-light image-background">
      <!-- <div >
          <img class="bg-antrian" src="<?= base_url('assets/images/medical-1.jpg')?>" alt="">
      </div> -->
    <div class="mt-5" >
      <div class="mt-5">
      
        <!-- /top navigation -->
        <!-- page content -->
        <form  id="formAdd" data-parsley-validate="" class=" mt-5 form-horizontal form-label-left d-flex justify-content-center" novalidate="" >			
            <div class="" >
                            <div class="card text-white  bg-primary mb-4" style="max-width: 38rem; text-align:center">
                                <div class="card-header">Ambil Antrian</div>
                                <div class="card-body ">
                                    <!-- <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;">A001</h1> -->
                                    <?php if($rowAntrian1 == null){?>
                                        <input type="hidden" name="antrianNO" class="card-title d-flex justify-content-center" style="font-size: 50px;" value="A001">
                                        <h1 class="card-title d-flex justify-content-center" style="font-size: 60px;">A001</h1>
                                        <?php if($rowMenunggu != null){?>
                                        <p>Menunggu : <?=$rowMenunggu->total?></p>
                                        <?php }else{ ?>
                                            <p>Menunggu : 0 </p>
                                            <?php } ?>
                                        <?php }else{ 
                                            $antrianNo = $rowAntrian1->antrianNO;
                                            $urut   = substr($antrianNo, 1, 3);
                                            $tambah = (int) $urut + 1;
                                            if(strlen($tambah) == 1){
                                                $format = "A00".$tambah;
                                                // echo $format;
                                            } 
                                            elseif(strlen($tambah) == 2){
                                                $format = "A0".$tambah;
                                                // echo $format;
                                            }
                                            else{
                                                $format = "A".$tambah;
                                                // echo $format;
                                            }
                                            // echo $tambah;
                                            ?>
                                        <input type="hidden" name="antrianNO" class="card-title d-flex justify-content-center" style="font-size: 50px;" value="<?=$format?>">
                                        <h1 class="card-title d-flex justify-content-center" style="font-size: 50px;"><?=$format?></h1>
                                        <p>Menunggu : <?=$rowMenunggu->total?> </p>
                                        <?php } ?>
                                    
                                </div>
                                <div class="card-footer">
                                    <!-- <input name="add" class="btn btn-info px-5" type="submit" value="Ambil"> -->
                                    <button class="btn btn-info px-5" id="add">Ambil</button>
                                    <!-- <button class="btn btn-primary px-5"></button> -->
                                </div>
                            </div>
                </div>
               
            </form>
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
            url  :"<?php echo base_url('Antrian/addAntrian')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(data){
                console.log(data);
                if(data.status == 'success'){
                    console.log("sukses");
                
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Antrian Berhasil Di Tambahkan!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>Antrian");
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
