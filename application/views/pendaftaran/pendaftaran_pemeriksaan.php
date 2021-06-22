<?php
    $xjk = '';
?>
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
                    <form id="formAdd" class="form-horizontal form-label-left px-5">
                        <div class="clearfix"></div>
                        <div class="row" style="display: block;">
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>PASIEN PEMERIKSAAN</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">NO RM</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" id="noRM" name="noRM" class="form-control" placeholder="Search">
                                                <span class="noRM_error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">NAMA LENGKAP</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text"  name="namaPasien" id="namaPasien" class="form-control" >
                                                <span class="namaPasien_error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">No Identitas</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text"  name="pasienNoIdentitas" id="pasienNoIdentitas" class="form-control" >
                                                <span class="pasienNoIdentitas_error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">Jenis Kelamin</label>
                                            <div class="col-md-9 col-sm-9 ">
                                            <input type="text"  name="pasienJK" id="pasienJK" class="form-control" >
                                            <span class="pasienJK_error text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- //////////////////////////////////////////// -->
                                <div id="container"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9  offset-md-3">
                                        <!-- <button type="button" class="btn btn-primary">Cancel</button> -->
                                        <a href="<?=site_url('Pendaftaran')?>" class="btn btn-primary">Cancel</a>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button type="submit" id="add" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view('_partials/footer.php');?>
        <!-- /footer content -->
    </div>
    </div>
    <?php $this->load->view('_partials/js.php');?>

<script type="text/javascript">
    $(document).ready(function(){  

        $('#noRM').autocomplete({
            source: "<?php echo site_url('Pendaftaran/getPendaftaranDataPasien');?>",
            select: function(event, ui){
                $('[name="noRM"]').val(ui.item.label);
                $('[name="namaPasien"]').val(ui.item.namaPasien);
                $('[name="pasienNoIdentitas"]').val(ui.item.pasienNoIdentitas);
                $('[name="pasienJK"]').val(ui.item.pasienJK);
                $('#pasienJK1').val(ui.item.pasienJK);

                var id = ui.item.pasienID;
                console.log(id);

                if(id != null){
                    $.ajax({
                        url:"<?php echo base_url('Pendaftaran/getViewData_pemeriksaan');?>",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            $('#container').html(data);
                        }
                    });
                }
            }
        });

        $('#add').on('click', function(){
            $.ajax({
                type : "POST",
                url  :"<?php echo base_url('Pendaftaran/addPendaftaran')?>",
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
                            window.location.assign("<?php echo base_url();?>Pendaftaran");
                        });
                    }else{
                        $('.noRM_error').html(data.noRM);
                        $('.namaPasien_error').html(data.namaPasien);
                        $('.pasienNoIdentitas_error').html(data.pasienNoIdentitas);
                        $('.pasienJK_error').html(data.pasienJK);
                        $('.dokter_error').html(data.dokter);
                        $('.unitPengirim_error').html(data.unitPengirim);
                        $('.checkSingle_error').html(data.checkSingle);
                    } 
                }
            });
        return false;
        });
 
    });
</script>


</body>
</html>
