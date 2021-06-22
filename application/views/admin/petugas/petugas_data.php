
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('_partials/head.php');?>
  <style>
  
  .toolbar {
    float:left;
}
  </style>
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
                                            <div class="bd-highligh"> <a href="<?=site_url('admin/Petugas/viewAddPetugas')?>"><button type="submit" class="btn btn-success ">Tambah Data</button></a> </div>
                                           
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="card-box table-responsive">
                                                <table class="table table-striped jambo_table bulk_action" id="datatableParam" style="width: 100%;" role="grid">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Nama Petugas</th>
                                                            <th class="column-title">Username</th>
                                                            <th class="column-title">Password</th>
                                                            <th class="column-title">Status</th>
                                                            <th class="column-title " style="width: 276px;"><span class="">Action</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                            $i = 1;
                                                            foreach($dataPetugas as $rowPetugas){?>
                                                            <tr role="row" class="odd">
                                                                <td class="a-center "><?=$i++?></td>
                                                                <td class=" "><?=$rowPetugas->petugasNama?></td>
                                                                <td class=" "><?=$rowPetugas->petugasUser?></td>
                                                                <td class=" "><?=$rowPetugas->petugasPass?></td>
                                                                <?php if($rowPetugas->petugasLevel == 1){?>
                                                                    <td class=" ">Admin</td>
                                                                <?php }else if($rowPetugas->petugasLevel == 2){ ?>
                                                                    <td class=" ">Petugas Pendaftaran</td>
                                                                <?php }else if($rowPetugas->petugasLevel == 3){ ?>
                                                                    <td class=" ">Petugas Laboratorium</td>
                                                                <?php }else if($rowPetugas->petugasLevel == 4){ ?>
                                                                    <td class=" ">Manager Mutu</td>
                                                                <?php } ?>
                                                                <td class=" ">
                                                                    <a href="<?= base_url('admin/Petugas/viewEditPetugas/'.$rowPetugas->petugasID)?>"><button class="btn btn-primary btn-sm" id="btn-edit">Edit</button></a>  
                                                                    <button class="btn btn-danger btn-sm" id="btn-delete" value="<?=$rowPetugas->petugasID?>">Delete</button>
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
            url  : "<?php echo base_url('admin/Petugas/deletPetugas')?>",
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
