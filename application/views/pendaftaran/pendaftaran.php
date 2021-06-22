
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('_partials/head.php');?>
  </head>

  <body class="nav-md" id="fullScreen">
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
                                            <div class="x_title">
                                                <h2>PENDAFTARAN PASIEN</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                              

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
   
  </body>
</html>
