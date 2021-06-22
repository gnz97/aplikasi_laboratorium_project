
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
                                            <div class="flex-grow-1 bd-highlight"><h2>PARAMETER PEMERIKSAAN</h2></div>
                                           
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                        <div class="card-box table-responsive">
                                                <table class="table table-striped jambo_table bulk_action" id="datatableParam" style="width: 100%;" role="grid">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">No RM</th>
                                                            <th class="column-title">Nama Pasien</th>
                                                            <th class="column-title">Status</th>
                                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 3|| $this->fungsi->petugas_login()->petugasLevel == 4){?>
                                                            <th class="column-title " style="width: 276px;"><span class="">Action</span></th>
                                                        <?php }  ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                            $i = 1;
                                                            foreach($dataDetailPasien as $rowDetailPasien){?>
                                                            <tr role="row" class="odd">
                                                                <td class="a-center "><?=$i++?></td>
                                                                <td class=" "><?=$rowDetailPasien->pasienNoRM?></td>
                                                                <td class=" "><?=$rowDetailPasien->pasienNamaLengkap?></td>
                                                                <td class=" ">
                                                                    <?php if($rowDetailPasien->pemeriksaanStatus == 'Belum Pemeriksaan'){?>
                                                                        <button class="btn btn-danger btn-sm"><?=$rowDetailPasien->pemeriksaanStatus?></button> 
                                                                    <?php }else if($rowDetailPasien->pemeriksaanStatus == 'Proses Pemeriksaan'){ ?>
                                                                        <button class="btn btn-primary btn-sm"><?=$rowDetailPasien->pemeriksaanStatus?></button> 
                                                                    <?php }else if($rowDetailPasien->pemeriksaanStatus == 'Selesai Pemeriksaan'){?>
                                                                        <button class="btn btn-success btn-sm"><?=$rowDetailPasien->pemeriksaanStatus?></button> 
                                                                        <?php }?>

                                                                        
                                                                </td>
                                                                <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 3|| $this->fungsi->petugas_login()->petugasLevel == 4){?>
                                                                
                                                                <td class=" ">
                                                                    <a href="<?= base_url('Pemeriksaan/pemeriksaanProses/'.$rowDetailPasien->pemeriksaanID)?>"><button class="btn btn-primary btn-sm" id="btn-edit">Pemeriksaan</button></a>  
                                                                </td>
                                                            <?php } ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
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
$(document).ready(function() {
    $('#datatableParam').DataTable();

} );
</script>
   
  </body>
</html>
