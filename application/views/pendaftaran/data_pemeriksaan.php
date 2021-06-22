<script>
    function checkAll(){
        var sum = 0;
        var pc1 = [];
        var pc2 = [];
        var selected = new Array();
        var z;
        var x;
        var y = new Array();
        var zx;
        
        $(".checkedAll").each(function(){
            if($(this).prop("checked") == true){
            x = $(this).attr('value');
            $('.checkSingle'+x).prop('checked', true); 
            } 
        });
    
        $(".checkSinglex").each(function(){
            if($(this).prop("checked") == true){
                y.push($(this).attr('data-harga'));  
            } 
        })
        for (var i = 0; i < y.length; i++) {
            xx = parseInt(y[i]);
            sum += xx;
        }
        $('#harga').val("Rp."+sum);
    }

  
    function check(){
        var pc = [];
        var pc1 = [];
        var pc2 = [];
        var selected = new Array();
        var y = new Array();
        var y1 = new Array();
        var z;
        var x;
        var zx;
        var x;
        var sum = 0;
        var xy;
        var xy1;
        

        $(".checkSinglex").each(function(){
            if($(this).prop("checked") == true){
                z = $(this).attr('data-bidang');
                xy = $(this).attr('data-total');
                xy1 = $(this).attr('data-z');
                // console.log("Data Bidang klik"+z);
                // console.log("Value"+xy);
                // console.log("Data bidang z"+xy1);
                y.push(Number(decodeURI(z)));   
                // console.log(y);
                const counter = (`${y.join()},`.match(new RegExp(`${xy1}\\,`, 'g')) || []).length;
                for(var i = 0; i < y.length; i++){
                    if(xy1 == y[i]){
                        if(xy == counter){
                            console.log("Data Full");
                            $('.chacked-data'+xy1).prop("checked", true);
                            y1.push(Number(decodeURI($(this).attr('data-harga'))));   
                        }else{
                            $('.chacked-data'+xy1).prop("checked", false);
                            y1.push(Number(decodeURI($(this).attr('data-harga'))));   
                        } 
                    }
                }
            }     
        });

        pc2 = $.unique(y1);
        for(var i = 0; i < pc2.length; i++){
            sum += pc2[i];
        }
        $('#harga').val("Rp."+sum);
                
    }
</script>


<div class="x_panel">                                      
    <div class="x_title">
        <h2>PARAMETER PEMERIKSAAN</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <input type="hidden" name="pendaftaranNew" class="form-control" value="Belum Pemeriksaan">
        <input type="hidden" name="pasienID" class="form-control" value="<?=$pasienData->pasienID?>">
        <input type="hidden" name="dokter" class="form-control" value="<?=$pasienData->pasienJK?>">
        <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Dokter</label>
            <div class="col-md-9 col-sm-9 ">
                <input type="text" name="dokter" class="form-control" >
                <span class="dokter_error text-danger"></span>
            </div>
        </div>
        <div class="form-group row ">
            <label class="control-label col-md-3 col-sm-3 ">Unit Pengirim</label>
            <div class="col-md-9 col-sm-9 ">
                <input type="text" name="unitPengirim" class="form-control" >
                <span class="unitPengirim_error text-danger"></span>
            </div>
        </div>                                          
        <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Paket Pemeriksaan</label>
            <div class="col-md-9 col-sm-9 ">
                <span class="checkSingle_error text-danger"></span>
                <?php   foreach($bidangData as $rowBidang){
                            foreach($dataCount as $rowCount){
                                if($rowCount->bidang_ID == $rowBidang->bidangID){ ?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><?=$rowBidang->bidangNama?></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a data-toggle="collapse" id="myCollapsible" href="#collapseExample<?=$rowBidang->bidangID?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-chevron-down" id="datac"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style="display: block;">
                                    <div class="collapse" id="collapseExample<?=$rowBidang->bidangID?>" data="<?=$rowBidang->bidangID?>"> 
                                        <table class="table table-striped jambo_table bulk_action" id="mytable">
                                            <thead>
                                                <tr class="headings">
                                                <th> <input type="checkbox" name="checkedAll[]" id="checkedAll" data-bidangAll="check<?=$rowBidang->bidangID?>" onclick="checkAll()" value="<?=$rowBidang->bidangID?>" class="chacked-data<?=$rowBidang->bidangID?> checkedAll" ></th>
                                                <th class="column-title" style="display: table-cell;">Nama Pemeriksaan </th>
                                                <th class="column-title" style="display: table-cell;">Status </th>
                                                <th class="column-title" style="display: table-cell;">Nilai Rujukan </th>
                                                <th class="column-title" style="display: table-cell;">Satuan </th>
                                                <th class="column-title" style="display: table-cell;">Harga </th>
                                                </tr>
                                            </thead>
                                            <tbody id="xtable">
                                            <?php foreach($dataParam as $rowParam){
                                                if($pasienData->pasienJK == $rowParam->paramStatus || $rowParam->paramStatus == 'umum'){
                                                    if($rowParam->bidang_ID == $rowBidang->bidangID ){ ?>
                                                    <input type="hidden" class="total"  name="total"   value="<?=$rowCount->total?>">
                                                    <tr class="even pointer row-select">
                                                        <td class="a-center ">
                                                            <input type="checkbox" name="checkSingle[]" id="checkSingle" data-z="<?=$rowCount->bidang_ID?>" data-total="<?=$rowCount->total?>" data-harga="<?=$rowParam->paramHarga?>" data-id="<?=$rowParam->paramNama?>" data-bidang="<?=$rowParam->bidangID?>"  onclick="check()" value="<?=$rowParam->paramID?>" class="case checkSinglex checkSingle<?=$rowParam->bidangID?>" >
                                                        </td>
                                                        <td class="">
                                                            <span style="font-size:16px;"><?=$rowParam->paramNama?></span>
                                                        </td>
                                                        <td class="">
                                                            <span style="font-size:16px;"><?=$rowParam->paramStatus?></span>
                                                        </td>
                                                        <td class=" ">
                                                            <span style="font-size:16px;"><?=$rowParam->paramNilaiRujukan?></span>
                                                        </td>
                                                        <td class=" ">
                                                            <span style="font-size:16px;"><?=$rowParam->satuanNama?></span>
                                                        </td>
                                                        <td class="from-a">
                                                            <span style="font-size:16px;"><?=$rowParam->paramHarga?></span>
                                                        </td>
                                                    </tr>
                                            <?php }}} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                <?php  } } } ?>
            </div>
        </div>                                               
        <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Harga </label>
            <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="harga" disabled="disabled" placeholder="Rp. ">
            </div>
        </div>
        <div class="ln_solid"></div> 
    </div>                                        
</div>