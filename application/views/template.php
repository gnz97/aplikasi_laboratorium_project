
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
                        <div class="page-title">
                            
                            <div class="title_right">
                                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                                    <div class="input-group">
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                
                        <div class="row" style="display: block;">
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Dashboard</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                    <div class="row">
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 1 ||$this->fungsi->petugas_login()->petugasLevel == 2 || $this->fungsi->petugas_login()->petugasLevel == 3 || $this->fungsi->petugas_login()->petugasLevel == 4){?>
                                            <a href="<?=base_url('Pemeriksaan')?>">
                                            <?php } ?>
                                                <div class="tile-stats">
                                                <div class="icon"><i class="fa fa-check-square-o"></i>
                                                </div>
                                                <div class="count"><?=$dataPemeriksaan->total?></div>

                                                <h3>Data Pemeriksaan</h3>
                                                <!-- <p></p> -->
                                                </div>
                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 3){?> 
                                            </a>
                                            <?php } ?>
                                        </div>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                                            <a href="<?=base_url('admin/BidangPemeriksaan')?>">
                                            <?php } ?>
                                                <div class="tile-stats">
                                                <div class="icon"><i class="fa fa-check-square-o"></i>
                                                </div>
                                                <div class="count"><?=$dataBidangPemeriksaa->total?></div>

                                                <h3>Bidang Pemeriksaan</h3>
                                                <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                                                </div>
                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                                            </a>
                                        <?php } ?>
                                        </div>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                                            <a href="<?=base_url('admin/ParamPemeriksaan')?>">
                                            <?php } ?>
                                                <div class="tile-stats">
                                                <div class="icon"><i class="fa fa-check-square-o"></i>
                                                </div>
                                                <div class="count"><?=$dataParamPemeriksaan->total?></div>

                                                <h3>Data Parameter</h3>
                                                <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                                                </div>
                                                <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                                            </a>
                                        <?php } ?>
                                        </div>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                            <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 2){?>
                                            <a href="<?=base_url('Pasien')?>">
                                            <?php } ?>
                                                <div class="tile-stats">
                                                <div class="icon"><i class="fa fa-check-square-o"></i>
                                                </div>
                                                <div class="count"><?=$dataPasien->total?></div>

                                                <h3>Data Pasien</h3>
                                                <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
                                                </div>
                                                 <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 2){?>
                                            </a>
                                        <?php } ?>
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
