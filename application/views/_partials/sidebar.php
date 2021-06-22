    <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                
                <a href="<?=site_url('Dashboard')?>" class="site_title"><img src="<?= base_url()?>assets/images/logo1.png" alt="..."><span>LABORATORY</span></a>
            </div>
            

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="profile_pic">
                <img src="<?= base_url()?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
              
                <h2> <span><?=$this->fungsi->petugas_login()->petugasNama?></span></h2>
                </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                    <!-- Home -->
                    <li><a href="<?= base_url('Dashboard')?>"><i class="fa fa-home"></i> Home </a></li>
                    <!-- /Home -->


                    <!-- Antrian -->
                    <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 2 || $this->fungsi->petugas_login()->petugasLevel == 4){?>
                        <li><a href="<?= base_url('Antrian/getAntrian')?>"><i class="fa fa-home"></i> Antrian </a></li>
                    <?php } ?>
                    <!-- /Antrian -->
                   
                    <!-- Pendaftaran -->
                    <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 2){?>
                        <li><a href="<?= base_url('Pendaftaran')?>"><i class="fa fa-home"></i> Pendaftaran </a></li>
                    <?php } ?>
                    <!-- /Pendaftaran -->

                    <!-- Pemeriksaan -->
                    <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 2 || $this->fungsi->petugas_login()->petugasLevel == 3 || $this->fungsi->petugas_login()->petugasLevel == 4){?>
                    <!-- <li><a href="<?= base_url('Pemeriksaan')?>"><i class="fa fa-home"></i> Pemeriksaan </a></li> -->
                    <li class=""><a><i class="fa fa-desktop"></i> Pemeriksaan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display: none;">
                        <li><a href="<?= base_url('Pemeriksaan')?>">Semua Pemeriksaan</a></li>
                        <li><a href="<?= base_url('Pemeriksaan/belumPemeriksaan')?>">Belum Pemeriksaan</a></li>
                        <li><a href="<?= base_url('Pemeriksaan/prosesPemeriksaan')?>">Proses Pemeriksaan</a></li>
                        <li><a href="<?= base_url('Pemeriksaan/hasilPemeriksaan')?>">Hasil Pemeriksaan</a></li>
                    </ul>
                    </li>
                    <?php } ?>
                    <!-- /Pemeriksaan -->

                    <!-- Data Pemeriksaan -->
                     <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                        <li class=""><a><i class="fa fa-desktop"></i> Data Pemeriksaan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none;">
                        <li><a href="<?= base_url('admin/BidangPemeriksaan')?>"><i class="fa fa-home"></i> Bidang Pemeriksaan </a></li>
                        <li><a href="<?= base_url('admin/ParamPemeriksaan')?>"><i class="fa fa-home"></i> Parameter Pemeriksaan </a></li>
                        <li><a href="<?= base_url('admin/Satuan')?>"><i class="fa fa-home"></i> Satuan Parameter </a></li>
                        <li><a href="<?= base_url('admin/Sample')?>"><i class="fa fa-home"></i> Sample</a></li>
                        </ul>
                        </li>
                    <?php } ?>
                    <!-- /Data Pemeriksaan -->

                    <!-- Data Pasien -->
                    <?php if($this->fungsi->petugas_login()->petugasLevel == 1 || $this->fungsi->petugas_login()->petugasLevel == 2){?>
                        <li><a href="<?= base_url('Pasien')?>"><i class="fa fa-home"></i> Data Pasien </a></li>   
                    <?php } ?>
                    <!-- /Data Pasien -->

                    <!-- Data Petugas -->
                    <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                    <li><a href="<?= base_url('admin/Petugas')?>"><i class="fa fa-home"></i> Data Petugas </a></li>   
                    <?php } ?>
                    <!-- /Data Petugas -->

                    <!-- Data Dokter -->
                    <?php if($this->fungsi->petugas_login()->petugasLevel == 1){?>
                    <li><a href="<?= base_url('admin/Dokter')?>"><i class="fa fa-home"></i> Data Dokter </a></li>   
                    <?php } ?>
                    <!-- /Data Dokter -->
                    
                </ul>
                </div>
            </div>
            <!-- /sidebar menu -->


            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings" readonly>
                <span class="glyphicon glyphicon-cog" aria-hidden="true" ></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true" onclick="openFullscreen();"></span>
                
                </a>
                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="" href="login.html" data-original-title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>

            </div>
        </div>


        