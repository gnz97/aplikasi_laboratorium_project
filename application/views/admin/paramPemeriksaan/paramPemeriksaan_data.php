
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
                                            <div class="bd-highligh"> <a href="<?=site_url('admin/ParamPemeriksaan/viewAddParam')?>"><button type="submit" class="btn btn-success ">Tambah Data</button></a> </div>
                                           
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="card-box table-responsive">
                                                <table class="table table-striped jambo_table bulk_action" id="datatableParam" style="width: 100%;" role="grid">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Parameter Nama</th>
                                                            <th class="column-title">Bidang</th>
                                                            <th class="column-title">Status</th>
                                                            <th class="column-title">Nilai Rujukan</th>
                                                            <th class="column-title">Satuan</th>
                                                            <th class="column-title">Harga</th>
                                                            <th class="column-title"><span class="nobr">Action</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $i = 1;
                                                            foreach($paramData as $rowParam){?>
                                                            <tr role="row" class="odd">
                                                                <td class="a-center "><?=$i++?></td>
                                                                <td class=" "><?=$rowParam->paramNama?></td>
                                                                <td class=" "><?=$rowParam->bidangNama?></td>
                                                                <td class=" "><?=$rowParam->paramStatus?></td>
                                                                <td class=" "><?=$rowParam->paramNilaiRujukan?></td>
                                                                <td class=" "><?=$rowParam->satuanNama?></td>
                                                                <td class=" ">Rp.<?=$rowParam->paramHarga?></td>
                                                                <td class=" ">
                                                                    <a href="<?= base_url('admin/ParamPemeriksaan/viewEditParam/'.$rowParam->paramID)?>"><button class="btn btn-primary btn-sm" id="btn-edit">Edit</button></a>  
                                                                    <button class="btn btn-danger btn-sm" id="btn-delete" value="<?=$rowParam->paramID?>">Delete</button>
                                                                </td>
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

    $('#datatableParam').on('click','#btn-delete',function(){
        var id=$(this).attr('value');
        console.log(id);
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
            
        if (result.isConfirmed) {
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('admin/ParamPemeriksaan/deletParam')?>",
            dataType : "JSON",
            data : {id: id},
            success: function(data){
                console.log('success');
                if(data.status == 'success'){
                    swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    ).then(function(){
                        location.reload();
                    });  
                }
                               
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus+ " Data Masih Digunakan");
            }     
        });
        return false;
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
            )
        }
        })

        // $('#modalHapus').modal('show');
        // $('[name="deletepenggunaID"]').val(id);
    });
} );
</script>
   
  </body>
</html>
