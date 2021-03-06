<!---MODAL DETAIL-->
<?php if(isset($detail_rkb)=="OPEN"): ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e($no_rkb); ?></h4>
      </div>
      <div class="modal-body">
<div class="row">
  <div class="col-lg-12">
    <?php $__currentLoopData = $rkb_det; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$cek = Illuminate\Support\Facades\DB::table('e_rkb_cancel')
->where([
['no_rkb',$v->no_rkb],
['part_name',$v->part_name]
])
->first();
?>
<?php 
if($cek==null)
{
$color = "#08A32F";
}else{
$color = "#930C00";
}
 ?>
    <div class="col-lg-12  col-xs-12">
      <div class="row" style="border: solid thin <?php echo $color;?>;margin-right: 2px;margin-left: 2px;margin-bottom: 10px;">
        <div class="col-lg-6 col-xs-12 ">
          <label class="col-lg-3 col-xs-12 row">Part Name</label>
          <div class="col-lg-9 col-xs-12">
            <p><?php echo e($v->part_name); ?></p>
          </div>
        </div>
        <div class="col-lg-6 col-xs-12 ">
          <label class="col-lg-3 col-xs-12 row">Part Number</label>
          <div class="col-lg-9 col-xs-12">
            <p><?php echo e(isset($v->part_number) ? $v->part_number : "-"); ?></p>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 ">
          <label class="col-lg-3 col-xs-12 row">Quantity</label>
          <div class="col-lg-9 col-xs-12">
            <div class="col-xs-12 row">
            <?php 
           $koma = explode(".",$v->quantity);
             ?>
            <?php if(isset($koma[1])): ?>
            <p><?php echo e(number_format($v->quantity,1)); ?> <?php echo e($v->satuan); ?></p>
            <?php else: ?>
            <p><?php echo e(number_format($v->quantity)); ?> <?php echo e($v->satuan); ?></p>
            <?php endif; ?>
            </div>

          </div>
        </div>
        <div class="col-lg-6 col-xs-12 ">
          <label class="col-lg-3 col-xs-12 row">Remarks</label>
          <div class="col-lg-9 col-xs-12">
            <p><?php echo e(isset($v->remarks) ? $v->remarks : "-"); ?></p>
          </div>
        </div>

        <?php
        $noPO = Illuminate\Support\Facades\DB::table('e_rkb_po')->where([
                                                                  ["no_rkb",$no_rkb],
                                                                  ["item",$v->item]
                                                                ])->first();
        ?>
        <?php if(isset($noPO)): ?>
        <div class="col-lg-12 col-xs-12 btn-success" style="font-weight: bolder;">
          <div class="row">
          <div class="col-lg-2 col-xs-12">Nomor PO</div>
          <div class="col-lg-9 col-xs-12">
            <?php echo e($noPO?$noPO->no_po:""); ?>

          </div>
          <div class="col-lg-2 col-xs-12">Remark</div>
          <div class="col-lg-9 col-xs-12">
            <?php echo e($noPO?$noPO->keterangan:""); ?>

          </div>
        </div>
        </div>
        <?php endif; ?>

        <?php if($cek!=null): ?>

<?php 
  $cancel_by = Illuminate\Support\Facades\DB::table('user_login')
              ->where("username",$cek->cancel_by)
              ->first();
 ?>
        <div class="col-lg-12 col-xs-12 bg-danger">
          <label class="col-lg-3 col-xs-12">Item Cancel Remark</label>
          <div class="col-lg-9 col-xs-12">
          <p>
            Item Cancel By <?php echo e(strtoupper($cancel_by->nama_lengkap)); ?>

            <br> 
            Remark : <?php echo e($cek->remarks); ?>

          </p>
        </div>
        </div>
        <?php else: ?>
<?php 
$approve = Illuminate\Support\Facades\DB::table('e_rkb_approve')
      ->where("no_rkb",$v->no_rkb)
      ->first();

$data=0;
$count_pic = Illuminate\Support\Facades\DB::table('e_rkb_pictures')
->where([
["no_rkb",$v->no_rkb],
["part_name",$v->part_name]
])->count();

$count_pen = Illuminate\Support\Facades\DB::table('e_rkb_penawaran')
->where([
["no_rkb",$v->no_rkb],
["part_name",$v->part_name]
])->count();

 ?>
        <div class="col-lg-12 col-xs-12 bg-info text-center" style="padding-top: 5.5px;">
<div class="col-xs-6">
  <div class="row text-left">
    <label class="control-label" >User Due Date : <?php echo e(date("d F Y",strtotime($v->due_date))); ?></label>
  </div>
</div>
<div class="col-xs-6">
  <div class=" text-left">
    <!--<label class="control-label">Logistic Due Date : </label>-->
  </div>
</div>
<?php if($approve->diketahui==0 || $count_pic>0 || $count_pen>0): ?>
          <div class="col-lg-6 col-xs-6">
<?php if($count_pic>0): ?>
<?php  $data = 1;  ?>
<a href="" class="btn btn-xs btn-primary" no_rkb="<?php echo e($v->no_rkb); ?>" part_name="<?php echo e($v->part_name); ?>" <?php if(isset($_POST['parent_eq'])){ ?> parent_eq="<?php echo e($_POST['parent_eq']); ?>" <?php } ?> id="pictures_btn"><b>Attachment</b> <i class="fa fa-file-o"></i></a>
            <br>
<?php endif; ?>
<?php if($count_pen>0): ?>
<?php  $data = 1;  ?>
<a href="#" class="btn btn-xs btn-default" no_rkb="<?php echo e($v->no_rkb); ?>" part_name="<?php echo e($v->part_name); ?>" id="penawaran_btn">Penawaran <i class="fa fa-file-o"></i></a>
            <br>
<?php endif; ?>
          </div>
          <div class="col-lg-6 col-xs-6">
<?php if(($_SESSION['section'])=="KTT" || ($_SESSION['section'])=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
<div class="pull-right">
  <button class="btn btn-xs btn-primary" name="tanyakan_item" id="tanyakan_item" part_name="<?php echo e($v->part_name); ?>"  <?php if(isset($_POST['parent_eq'])){ ?> parent_eq="<?php echo e($_POST['parent_eq']); ?>" <?php } ?> >Tanyakan! </button>
</div>
<?php if($approve->cancel_user==''): ?>
<?php  $data = 1;
$count_Cancel = Illuminate\Support\Facades\DB::table('e_rkb_cancel')
->where([
["no_rkb",$v->no_rkb]
])->count();
 ?>
<?php if(($count_Cancel)<(count($rkb_det)-1)): ?>
<?php 
  $approve = Illuminate\Support\Facades\DB::table('e_rkb_approve')
              ->where("no_rkb",$v->no_rkb)
              ->first();
 ?>
<?php if($_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
<?php if($approve->disetujui == 0): ?>
<a href="#" class="btn btn-xs btn-danger" id="Cancel_item" no_rkb="<?php echo e($v->no_rkb); ?>" part_name="<?php echo e($v->part_name); ?>" >Cancel</a>
<?php endif; ?>
<?php endif; ?>
<?php if($_SESSION['section']=="KTT"): ?>
<?php if($approve->diketahui == 0): ?>
<a href="#" class="btn btn-xs btn-danger" id="Cancel_item" no_rkb="<?php echo e($v->no_rkb); ?>" part_name="<?php echo e($v->part_name); ?>" >Cancel</a>
<?php endif; ?>
<?php endif; ?>
            <br>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>


        </div>

<?php endif; ?>



<?php if(!($_SESSION['section']=="KTT" || $_SESSION['section']=="KABAG" || $_SESSION['section']=="PURCHASING" || $_SESSION['section']=="SECTION_HEAD")): ?>
<?php if($approve->cancel_section==''): ?>
<a href="#" no_rkb="<?php echo e(bin2hex($v->no_rkb)); ?>" part_name="<?php echo e(bin2hex($v->part_name)); ?>" target="_blank" id="upload_file" class="btn btn-xs btn-default pull-right" <?php if(isset($_POST['parent_eq'])) { ?> parent_eq="<?php echo e($_POST['parent_eq']); ?>" <?php } ?>>Upload File</a>
<?php endif; ?>
<?php endif; ?>

        </div>
        <?php endif; ?>
<!---OK-->
    <?php  
    $cancel_item = Illuminate\Support\Facades\DB::table('e_rkb_cancel')
                    ->where([
                            ["no_rkb",$v->no_rkb],
                            ["part_name",$v->part_name]
                            ])->first();
    $item_status = Illuminate\Support\Facades\DB::table('item_status')
                    ->where([
                            ["no_rkb",$v->no_rkb],
                            ["part_name",$v->part_name],
                            ["part_number",$v->part_number],
                            ["void",0]
                            ])->sum("quantity");
     ?>
<?php if(!$cancel_item): ?>
    <?php if($item_status<=$v->quantity && $item_status != 0): ?>
    <?php
    $status = Illuminate\Support\Facades\DB::table('item_status')
                    ->where([
                            ["no_rkb",$v->no_rkb],
                            ["part_name",$v->part_name],
                            ["part_number",$v->part_number],
                            ["void",0]
                            ])->first();
                            ?>
<div class="col-lg-12 col-xs-12" style="border-top: 1px solid #000;padding-top: 5px;padding-bottom: 5px;">
  <div class="col-lg-12 col-xs-12">
    <b>Status Barang</b> : <?php echo e($item_status); ?> <?php echo e($v->satuan); ?> Sudah Datang | 
    <a href="<?php echo e(url('/stock.in')); ?>?no_rkb=<?php echo e(bin2hex($status->no_rkb)); ?>&item=<?php echo e(bin2hex($v->item)); ?>" style="color:red;" target="_blank">Check Barang Disini!</a>
  </div>
</div>
   <?php endif; ?>
<?php endif; ?>
<!--OK-->
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>      	

<?php 
  $app = Illuminate\Support\Facades\DB::table('e_rkb_approve')
              ->join("user_login","user_login.username","e_rkb_approve.cancel_user")
              ->select("user_login.*","e_rkb_approve.*")
              ->where("no_rkb",$no_rkb)
              ->first();
 ?>
<?php if(isset($app)): ?>
<?php if($app->cancel_user!=null): ?>
<div class="container" style="background-color:#AD1805;color: white;padding-top: 15px;padding-bottom:20px;"> 
<div class="col-md-6 col-xs-12">
  <div class="col-lg-12 col-xs-12 row"><h4>User Cancel</h4></div>
  <div class="col-lg-12 col-xs-12 row"><?php echo e($app->nama_lengkap); ?></div>
</div>
<div class="col-md-6 col-xs-12">
  <div class="col-lg-12 col-xs-12 row"><h4>Cancel Remarks</h4></div>
  <div class="col-lg-12 col-xs-12 row"><?php echo e($app->remark_cancel); ?></div>
</div>
</div>
<?php endif; ?>
<?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- Datatables -->
    <script src="<?php echo e(asset('/vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script>
        $("#datatable_new").dataTable({"searching": false});
        $("a[id=Cancel_item]").on("click",function(){
          eq = $("a[id=Cancel_item]").index(this);

          no_rkb = $("a[id=Cancel_item]").eq(eq).attr("no_rkb");
          part_name = $("a[id=Cancel_item]").eq(eq).attr("part_name");
          $.ajax({
            type:"POST",
            url:"/rkb/cancel/item/setRemarks",
            data:{no_rkb:no_rkb,part_name:part_name},
            beforeSend:function(){
              $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
            },
            success:function(result){
              $("#konten_modal").html(result).fadeIn();
            }
          });
        });
        $("a[id=penawaran_btn]").click(function(){
            eq = $("a[id=penawaran_btn]").index(this);
            no_rkb = $("a[id=penawaran_btn]").eq(eq).attr("no_rkb");
            part_name = $("a[id=penawaran_btn]").eq(eq).attr("part_name");
            $.ajax({
              type:"POST",
              url:"<?php echo e(url('/rkb/detail/files')); ?>",
              data:{no_rkb:no_rkb,part_name:part_name},
              beforeSend:function(){
                $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
              },
              success:function(result){
                $("#konten_modal").html(result).fadeIn();
              }
            });
        });

        $("a[id=pictures_btn]").click(function(){
            eq = $("a[id=pictures_btn]").index(this);
            no_rkb = $("a[id=pictures_btn]").eq(eq).attr("no_rkb");
            part_name = $("a[id=pictures_btn]").eq(eq).attr("part_name");
            parent_eq = $("a[id=pictures_btn]").eq(eq).attr("parent_eq");
            $.ajax({
              type:"POST",
              url:"<?php echo e(url('/rkb/detail/pictures')); ?>",
              data:{no_rkb:no_rkb,part_name:part_name,parent_eq:parent_eq},
              beforeSend:function(){
                $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
              },
              success:function(result){
                $("#konten_modal").html(result).fadeIn();
              }
            });
            return false;
        });


        $("a[id=upload_file]").click(function(){
            eq = $("a[id=upload_file]").index(this);
            no_rkb = $("a[id=upload_file]").eq(eq).attr("no_rkb");
            part_name = $("a[id=upload_file]").eq(eq).attr("part_name");
            parent_eq = $("a[id=upload_file]").eq(eq).attr("parent_eq");
            $.ajax({
              type:"POST",
              url:"<?php echo e(url('/v3/rkb/upload/')); ?>",
              data:{no_rkb:no_rkb,part_name:part_name,parent_eq:parent_eq},
              beforeSend:function(){
                $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
              },
              success:function(result){
                $("#konten_modal").html(result).fadeIn();
              }
            });
            return false;
        });

    function tanyakan_item() {
    
      if( typeof ($.fn.slideToggle) === 'undefined'){ return; }
      console.log('init_compose');
      $('button[id=tanyakan_item]').click(function(){
        $('.compose').slideToggle();
        return false;
      });
      
    
    };

        
tanyakan_item();

      $("button[id=tanyakan_item]").click(function() {
        eq = $("button[id=tanyakan_item]").index(this);
        parent_eq = $("button[id=tanyakan_item]").eq(eq).attr("parent_eq");
        part_name = $("button[id=tanyakan_item]").eq(eq).attr("part_name");
        userTo = $("input[id=userTo]").eq(parent_eq).val();
        usernameTo = $("input[id=usernameTo]").eq(parent_eq).val();
        norkb_to = $("input[id=norkb_to]").eq(parent_eq).val();
        
        $("#tree").val("parent");
        $("#user_to").val(userTo);
        $("#username_to").val(usernameTo);    
        $("#part_name").val(part_name);    
        $("#no_rkb").val(norkb_to);    
      
      });

    </script>
<?php endif; ?>
<!---MODAL DETAIL-->
<?php if(isset($setRemarks)): ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e($no_rkb); ?></h4>
      </div>

<form id="form_cancel" action="#" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
      <div class="modal-body">


<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_rkb">No RKB <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-9 col-xs-12">
<input type="text" id="id_rkb" required="required" disabled="disabled" name="no_rkb" class="form-control col-md-4 col-xs-3" value="<?php echo e($no_rkb); ?>">
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_rkb">Part Name <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-9 col-xs-12">
<input type="text" id="id_rkb" required="required" disabled="disabled" name="no_rkb" class="form-control col-md-4 col-xs-3" value="<?php echo e($part_name); ?>">
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_rkb">Cancel Remark <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-9 col-xs-12">
  <textarea class="form-control col-md-4 col-xs-3" id="remarks" name="remarks"  required="required"></textarea>
</div>
</div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Submit</button>
        <button class="btn btn-primary" type="reset">Reset</button>
        <button type="button" class="btn btn-danger" id="cancelRemarks" data-id="<?php echo e($no_rkb); ?>">Cancel</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
</form>
    </div>

<script>

  $("form[id=form_cancel]").submit(function(){
    remarks = $("#remarks").val();
    
    $.ajax({
      type:"POST",
      url:"<?php echo e(url('/rkb/cancel/item/')); ?>",
      data:{no_rkb:"<?php echo e($no_rkb); ?>",part_name:"<?php echo e($part_name); ?>",remarks:remarks},
      beforeSend:function(){
            //$("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
      },
      success:function(result){
        $("button[id=cancelRemarks]").click();
      }
    });
    
    return false;
  });
  $("button[id=cancelRemarks]").on("click",function(){
      eq = $("button[id=cancelRemarks]").index(this);
      data_id = $("button[id=cancelRemarks]").eq(eq).attr("data-id");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/rkb/detail.py')); ?>",
        data:{no_rkb:data_id},
        beforeSend:function(){
            $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
        },
        success:function(result){
          $("div[id=konten_modal]").html(result).fadeIn();
        }
      });
  });
</script>
<?php endif; ?>


<?php if(isset($itemFiles)): ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e($no_rkb); ?></h4>
      </div>
      <div class="modal-body">
            <div class="clearfix"></div>
        <div class="container-fluid"> 
    <div class="row">
<div class="col-lg-12 profile_details" style="padding: 0px!important;margin:0px!important;width: 100%!important;">
  <div class="well profile_view col-lg-12">
    <div class="col-sm-12">
      <h4 class="brief"><i><?php echo e($part_name); ?></i></h4>
      <div class="left col-xs-12">
        <h2>File Penawaran</h2>
      </div>
      <div class="right col-xs-12 text-center">
<?php $__currentLoopData = $penawaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
 $imgExt =  explode('.',$v->file);
 $Ext = end($imgExt);
 ?>
<?php if($Ext=="jpg"||$Ext=="png"||$Ext=="gif"||$Ext=="jpeg"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.bin2hex($v->file))); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <img src="<?php echo e(url('/rkb/detail/files/penawaran/view-'.bin2hex($v->file))); ?>" style="width: 45px;height: 40px;" class="img-responsive">
          </div>
        </a>
        </div>
<?php elseif($Ext=="ppt"||$Ext=="pptx"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-powerpoint-o fa-3x"></i>
          </div>
          </a>
        </div>      
<?php elseif($Ext=="zip"||$Ext=="rar"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-archive-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="xls"||$Ext=="xlsx"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-excel-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="doc"||$Ext=="docx"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-word-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="pdf"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.bin2hex($v->file))); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-pdf-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php else: ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-o fa-3x"></i>
          </div>
        </a>
        </div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" id="back" data-id="<?php echo e($no_rkb); ?>">Back</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <script>
      $("button[id=back]").on("click",function(){
        data_id = $("button[id=back]").attr("data-id");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/rkb/detail.py')); ?>",
        data:{no_rkb:data_id},
        beforeSend:function(){
            $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
        },
        success:function(result){
          $("div[id=konten_modal]").html(result).fadeIn();
        }
      });
      });
    </script>
<?php endif; ?>

<?php if(isset($replace_file)): ?>

<?php 
 $imgExt =  explode('.',$file->file);
 $Ext = end($imgExt);
 ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ganti File</h4>
      </div>
      <div class="modal-body">
<div class="row">
<?php if($Ext=="jpg"||$Ext=="png"||$Ext=="gif"||$Ext=="jpeg"): ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <img src="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" style="width:100%;height: 100%;" class="img-responsive">
          </div>
        </a>
        </div>
<?php elseif($Ext=="ppt"||$Ext=="pptx"): ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <i class="fa fa-file-powerpoint-o fa-3x" style="font-size: 80px!important;"></i>
          </div>
          </a>
        </div>      
<?php elseif($Ext=="zip"||$Ext=="rar"): ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <i class="fa fa-file-archive-o fa-3x" style="font-size: 80px!important;"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="xls"||$Ext=="xlsx"): ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <i class="fa fa-file-excel-o fa-3x" style="font-size: 80px!important;"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="doc"||$Ext=="docx"): ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <i class="fa fa-file-word-o fa-3x" style="font-size: 80px!important;"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="pdf"): ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <i class="fa fa-file-pdf-o fa-5x" style="font-size: 80px!important;"></i>
          </div>
        </a>
        </div>
<?php else: ?>
        <div class="col-xs-2">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$file->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 100px;padding: 5px;text-align: center;margin-bottom: 0px;">
            <i class="fa fa-file-o fa-5x" style="font-size: 80px!important;"></i>
          </div>
        </a>
        </div>
<?php endif; ?>  
<div class="col-md-10">
<form action="<?php echo e(url('/form_rkb/img-reupload-'.$file->file)); ?>" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">File<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-4 col-xs-3">
  <div  class="form-control-static col-md-4 col-xs-3" >
  <input type="file" id="file" required="required" name="file">
</div>
</div>
</div>


<div class="form-group">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<button type="submit" class="btn btn-success">Submit</button>
</div>
</div>

</form>
</div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div>
<?php endif; ?>

<?php if(isset($rkb_cancel)): ?>

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Cancel <?php echo e($header->no_rkb); ?></h4>
  </div>

<form action="<?php echo e(asset('/rkb/cancel-rkb.submit')); ?>" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
  <div class="modal-body">

<?php echo e(csrf_field()); ?>


<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_rkb">No RKB <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-9 col-xs-12">
  <input type="text" name="no_rkb" id="no_rkb" class="form-control col-md-4 col-xs-3" value="<?php echo e($header->no_rkb); ?>" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="remarks">Cancel Remarks <span class="required">*</span>
</label>
<div class="col-md-8 col-sm-9 col-xs-12">
<textarea type="text" name="remarks" id="remarks" class="form-control col-md-4 col-xs-3" required></textarea>
</div>
</div>

</div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-success">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
  </div>
</div>

</form>
<?php endif; ?>



<?php if(isset($itemPICTURES)): ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e($no_rkb); ?></h4>
      </div>
      <div class="modal-body">
            <div class="clearfix"></div>
        <div class="container-fluid"> 
    <div class="row">
<div class="col-lg-12 profile_details" style="padding: 0px!important;margin:0px!important;width: 100%!important;">
  <div class="well profile_view col-lg-12">
    <div class="col-sm-12">
      <h4 class="brief"><i><?php echo e($part_name); ?></i></h4>
      <div class="left col-xs-12">
        <h2>Attachment</h2>
      </div>
      <div class="right col-xs-12 text-center">
<?php $__currentLoopData = $penawaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
 $imgExt =  explode('.',$v->file);
 $Ext = end($imgExt);
 ?>
<?php if($Ext=="jpg"||$Ext=="png"||$Ext=="gif"||$Ext=="jpeg"): ?>
        <div class="col-lg-3 col-xs-12 col-md-6">
          <a href="<?php echo e(url('/rkb/detail/files/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail">
            <div class="image">
              <img style="width: 100%; height: 100%; display: block;size: cover;" src="<?php echo e(url('/rkb/detail/files/view-'.$v->file)); ?>" alt="image" />
            </div>

            <div class="caption">
              <p>Image <?php echo e($k+1); ?></p>
              <p>Part Name <?php echo e($v->part_name); ?></p>
            </div>
          </div>          
          </a>
        </div>
<?php elseif($Ext=="ppt"||$Ext=="pptx"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-powerpoint-o fa-3x"></i>
          </div>
          </a>
        </div>      
<?php elseif($Ext=="zip"||$Ext=="rar"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-archive-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="xls"||$Ext=="xlsx"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-excel-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="doc"||$Ext=="docx"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-word-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php elseif($Ext=="pdf"): ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-pdf-o fa-3x"></i>
          </div>
        </a>
        </div>

<?php else: ?>
        <div class="col-xs-1">
          <a href="<?php echo e(url('/rkb/detail/files/penawaran/view-'.$v->file)); ?>" target="_blank">
          <div class="thumbnail" style="height: 50px;">
            <i class="fa fa-file-o fa-3x"></i>
          </div>
        </a>
        </div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" id="back" data-id="<?php echo e($no_rkb); ?>">Back</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <script>
      $("button[id=back]").on("click",function(){
        data_id = $("button[id=back]").attr("data-id");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/rkb/detail.py')); ?>",
        data:{no_rkb:data_id,parent_eq:"<?php echo e($parent_eq); ?>"},
        beforeSend:function(){
            $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i>").hide();
        },
        success:function(result){
          $("div[id=konten_modal]").html(result).fadeIn();
        }
      });
      });
    </script>
<?php endif; ?>