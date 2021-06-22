
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
                                        <div class="x_title d-flex bd-highlight" >
                                            <div class="flex-grow-1 bd-highlight"><h2>Antrian</h2></div>
                                           
                                           
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="card-box table-responsive ">

                                                    <form id="formAdd"   data-parsley-validate="" class="form-horizontal form-label-left d-flex justify-content-center" novalidate="" >			
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
                                                                        <input type="hidden" name="antrianID" value="<?=$rowAntrian->detail_antrianID?>">
                                                                    <!-- <button class="btn btn-info px-5" id="add">Panggil</button> -->
                                                                    <button type="button" id="add" class="btn btn-info px-5" data-toggle="modal" data-target="#exampleModal">Panggil</button>
                                                                    <?php } ?>
                                                                        <!-- <button class="btn btn-primary px-5"></button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                
                                                    </form>
                                                                        <div class=" d-flex justify-content-center">
                                                    <table class="table table-striped jambo_table bulk_action" id="datatableSample" style="width: 70%;" role="grid">
                                                        <thead>
                                                            <tr class="headings">
                                                                <th class="column-title" style="width:5%" >#</th>
                                                                <th class="column-title " >No Antrian</th>
                                                                <th class="column-title " >Status Antrian</th>
                                                                <th class="column-title "><span class="nobr">Tanggal</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $i = 1;
                                                                foreach($dataAntrian as $rowAntrian){?>
                                                                <tr role="row" class="odd">
                                                                    <td class="a-center "><?=$i++?></td>
                                                                    <td class=" "><?=$rowAntrian->detail_antrianNo?></td>
                                                                    <td class=" ">
                                                                        <button class="btn btn-danger btn-sm" id="btn-delete" value="<?=$rowAntrian->detail_antrianStatus?>">Menunggu</button>    
                                                                        </td>
                                                                    <td class=" "><?=$rowAntrian->detail_antrainTgl?></td>
                                                                   
                                                                </tr>
                                                            <?php } ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                
                                                    <!-- ////////////////MODAL//////////////////////// -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Pasien Antrian</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-lg-center">
                                                                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 ">
                                                                        <a href="<?=base_url('Pasien/pasienBaru')?>">
                                                                            <div class="tile-stats">
                                                                            <div class="icon"><i class="fa fa-user"></i></div>
                                                                            <div class="count">Pasien</div>
                                                                            <h3>Baru</h3>
                                                                            <p>Pendaftaran Pasien Baru</p>
                                                                            </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 ">
                                                                        <a href="<?=base_url('Pendaftaran/pendaftaranPemeriksaan')?>">
                                                                            <div class="tile-stats">
                                                                            <div class="icon"><i class="fa fa-user"></i></div>
                                                                            <div class="count">Pasien</div>
                                                                            <h3>Pemeriksaan</h3>
                                                                            <p>Pendaftaran Pasien Pemeriksaan</p>
                                                                            </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /////////////////////////////////////////////// -->
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>
                        </div>
                </div>
            </div>

            <!-- Vertically centered modal -->

        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view('_partials/footer.php');?>
        <!-- /footer content -->
      </div>
    </div>
    <?php $this->load->view('_partials/js.php');?>

    <script>
$(document).ready(function() {
    // $('#myModal').modal('show');
    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('Antrian/setPanggil/')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(data){
                console.log(data);
                if(data.status == 'success'){
                    // $('#exampleModal').modal('show');
                    $('#exampleModal').appendTo("body").modal('show');

                    // console.log("sukses");
                
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Berhasil',
                    //     text: 'Data Berhasil Di Tambahkan!',
                    
                    // }).then(function() {
                        // window.location.assign("<?php echo base_url();?>Antrian/getAntrian/");
                    // });
                
                }else{
                    // $('.gejalaCode_error').html(data.gejalaCode);
                    // $('.gejalaNama_error').html(data.gejalaNama);
                } 
            }
        });
    return false;
    });

    $('#exampleModal').on('hidden.bs.modal', function (event) {
        window.location.assign("<?php echo base_url();?>Antrian/getAntrian/");
  // do something...
    });
} );
</script>
   
  </body>
</html>
