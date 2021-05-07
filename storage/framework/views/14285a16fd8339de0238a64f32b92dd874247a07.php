
<?php $__env->startSection('title'); ?>
ABP-system | Rencana Kebutuhan Barang
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <style>
   
  thead tr th,tbody tr td{
    text-align: center;
  }  
 </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="right_col" role="main">
 <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report <small>Rencana Kebutuhan Barang </small></h2>


                       <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <br>
                    <div class="col-sm-12">
                    <!--date range-->
                    <form class="form-horizontal form-label-left col-xs-12" style="margin: 0px!important;" action="" method="get">
                      <div class="col-md-6">
                      <div class="form-group" >
                        <label class="control-label col-md-2 col-xs-12" for="USER">User </label>
                        <div class="col-md-4 ">
                          <select type="text" id="USER" name="USER" data-live-search="true" class="form-control select-status">
                            <option value="">--Pilih--</option>
                            <option value="KABAG">KABAG</option>
                            <option value="KTT">KTT</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group" >
                        <label class="control-label col-md-2 col-xs-12" for="ktt">STATUS </label>
                        <div class="col-md-4 ">
                          <select type="text" id="STATUS" name="STATUS" data-live-search="true" class="form-control select-status">
                            <option value="">--Pilih--</option>
                            <option value="1">Approve</option>
                            <option value="0">Pending</option>
                            <option value="cancel">Cancel</option>
                          </select>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <div class="col-sm-12 " style="margin: 0px!important;">
                          <div class="row">
                          <div class="input-group" style="margin: 0px!important;">
                            <label class="input-group-addon" for="startDate">Start</label>
                            <input type="text" class="form-control input-sm datepicker" id="startDate" name="startDate" value="<?php echo e(isset($_GET['startDate']) ? $_GET['startDate'] : date('d F Y')); ?>">
                            <label class="input-group-addon" style="margin-right: 0px!important;">End
                            </label>
                            <input type="text" class="form-control input-sm datepicker" id="endDate" name="endDate" value="<?php echo e(isset($_GET['endtDate']) ? $_GET['endtDate'] : date('d F Y')); ?>">
                            <span class="input-group-btn" style="margin-right: 0px!important; ">
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-right: 0px!important; ">Submit</button>
                            </span>
                            <span class="input-group-btn" style="margin-right: 0px!important;">
                              <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Costume Date
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu pull-right">
                                <li><a href="?startDate=<?php echo e(urlencode(date('d F Y',strtotime('-1day')))); ?>&endDate=<?php echo e(urlencode(date('d F Y'))); ?>">One Day</a></li>
                                <li><a href="?startDate=<?php echo e(urlencode(date('d F Y',strtotime('-1week')))); ?>&endDate=<?php echo e(urlencode(date('d F Y'))); ?>">One Week</a></li>
                                <li><a href="?startDate=<?php echo e(urlencode(date('d F Y',strtotime('-1month')))); ?>&endDate=<?php echo e(urlencode(date('d F Y'))); ?>">One Month</a></li>
                                <li><a href="?startDate=<?php echo e(urlencode(date('d F Y',strtotime('-1year')))); ?>&endDate=<?php echo e(urlencode(date('d F Y'))); ?>">One Year</a></li>
                              </ul>
                            </span>
                          </div>
                          </div>
                        </div>
                      </div>
                      </div>
                    </form>
                    </div>
                    <!--date range-->
<div class="col-sm-12">
                    <div class="">
                      <table id="datatables" class="table table-striped  table-bordered bulk_action table-responsive" style="">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Nomor Rkb </th>
                            <th class="column-title">Department - Section </th>
                            <th class="column-title">Tanggal Rkb </th>
                            <th class="column-title">Ka. Bag. </th>
                            <th class="column-title">KTT </th>
                            <th class="column-title">Part Name </th>
                            <th class="column-title">Part Number </th>
                            <th class="column-title">Quantity</th>
                            <th class="column-title">Remarks</th>
                            <th class="column-title">Cancel Remark </th>
                            <th class="column-title">Status</th>
                            <th class="column-title">NPO</th>
                            <th class="bulk-actions" colspan="5">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>

<?php if(count($rkb)>0): ?>
<?php $__currentLoopData = $rkb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="even pointer" >
                            <td class=" "  style="text-align: left!important;"><?php echo e($value->no_rkb); ?>

                              <?php if(!($value->cancel_section=="KABAG" || $value->cancel_section=="KTT" || $value->cancel_section==null)): ?>
                              <label class="label label-danger" style="float: right!important;cursor: pointer;cursor: hand;" data-toggle="tooltip" title="Remarks : <?php echo e($value->remark_cancel); ?>">Cancel By <?php echo e($value->cancel_user); ?> </label>
                              <?php endif; ?>
                            </td>
                            <td class=" "><?php echo e($value->dept); ?> - <?php echo e($value->det_sect); ?></td>
                            <td class=" ">
                              <?php echo e(date("d F Y",strtotime($value->tgl_order))); ?> 
                            </td>
                            <td class=" ">

<?php if($value->cancel_by==null): ?>
                              <?php if($value->disetujui==0): ?>
                              <?php if($_SESSION['section']=="KABAG"): ?>

                              <?php if($value->cancel_user==null): ?>
                              <label class="label label-warning">Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KABAG"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_user==null): ?>
                              <label class="label label-warning">Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KABAG"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php elseif($value->disetujui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s ,d F Y",strtotime($value->tgl_disetujui))); ?></label>
                              <?php 
                              $user_app = Illuminate\Support\Facades\DB::table("user_approve")->where([
                                          ["no_rkb",$value->no_rkb],
                                          ["desk","Disetujui"]
                                          ])
                                          ->leftjoin("user_login","user_login.username","user_approve.username")
                                          ->first();
                               ?>
                              <?php if($user_app->level=="PLT"): ?>
                              <br>
                              <label class="label label-default"><?php echo e($user_app->nama_lengkap); ?></label>
                              <?php endif; ?>
                              <?php elseif($value->disetujui==2): ?>
                              Cancel
                              <?php endif; ?>
                              <?php endif; ?>
                            </td>
                            <td class=" ">
                            
<?php if($value->cancel_by==null): ?>
                              <?php if($value->diketahui==0): ?>
                              <?php if($_SESSION['section']=="KTT"): ?>
                              <?php if($value->cancel_user==null): ?>
                              <a  no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="approve_rkb" class="btn btn-success btn-xs" <?php if(!$value->disetujui>0){?> href="#" onclick="return false;" disabled="disabled" <?php }else{?> href="<?php echo e(asset('/approve/rkb/ktt/'.bin2hex($value->no_rkb))); ?>" <?php } ?>  >Approve Rkb</a>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KTT"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_user==null): ?>
                              <label class="label label-warning"> Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KTT"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php elseif($value->diketahui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s ,d F Y",strtotime($value->tgl_diketahui))); ?></label>
                              <?php 
                              $user_app = Illuminate\Support\Facades\DB::table("user_approve")->where([
                                          ["no_rkb",$value->no_rkb],
                                          ["desk","Diketahui"]
                                          ])
                                          ->leftjoin("user_login","user_login.username","user_approve.username")
                                          ->first();
                               ?>
                              <?php if($user_app->level=="PLT"): ?>
                              <br>
                              <label class="label label-default"><?php echo e($user_app->nama_lengkap); ?></label>
                              <?php endif; ?>
                              <?php elseif($value->diketahui==2): ?>
                              Cancel
                              <?php endif; ?>
                              
                              <?php endif; ?>

                            </td>

                            <td><?php echo e($value->part_name); ?></td>
                            <td><?php echo e($value->part_number); ?></td>
                            <td><?php echo e($value->quantity); ?> <?php echo e($value->satuan); ?></td>
                            <td><?php echo e($value->remarks); ?></td>
                            <td>
                              <?php echo e($value->remark_cancel); ?>

                            </td>
                            <td>
<?php 
  
if($value->cancel_by!=null){
  echo "Cancel By ".strtoupper($value->cancel_by)."\n Remarks : ".$value->cancel_remarks;
}else{
  echo $value->status;
} 
 ?>

                            </td>
                            <td>
                              <?php echo e($value->no_po); ?>

                            </td>
                          </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php else: ?>
            <tr class="odd pointer">
                            <td class="a-center" align="center"  colspan="11">
                              Not have recored yet!
                            </td>
                         </tr>
<?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>


</div></div></div></div></div>
<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
<div id="konten_modal"></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
<script type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>

<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(session('success')): ?>
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Success',
          text: "<?php echo e(session('success')); ?>",
          type: 'success',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<script>
  $(".select-status").selectpicker();
  $("select[id='USER']").change(function(){
    if($("select[id='USER']").val()==""){
      $("select[id='STATUS']").removeAttr("required");
    }else{
      $("select[id='STATUS']").attr("required","required");
    }
  });
  $(".datepicker").datepicker({ dateFormat: 'dd MM yy' });
  $("#datatables").dataTable({
    "order": [[ 0, "desc" ]],
     dom: "Blfrtip", 
     buttons: [
     {
          extend: 'collection',
          text: 'Export',
          className: "btn-sm btn-export",
             buttons: [
             {
               extend: "csv",
             },
             {
               extend: "excel"
             }
           ]
       }
    ],
    "searching": true,
    "paging": false,
    "sort": false
  });
  //$(".btn-export").css("margin-bottom","15px");

//$(".dt-buttons").after("<div class=\"col-xs-6 pull-right\" style=\"padding-right:0px!important;\"><div id=\"group_print\" class=\"row \"></div></div>");

//$("#group_print").append("<div class=\"col-xs-6 \"><div id=\"reportrange\" style=\"background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc\"><i class=\"glyphicon glyphicon-calendar fa fa-calendar\"></i><span>December 30, 2014 - January 28, 2015</span> <b class=\"caret\"></b></div></div>");
//$("#group_print").append("<div class=\"col-xs-6  \"><button class=\"btn btn-sm btn-success pull-right\" onclick=\"window.open('/rkbPrint','_blank','top=200,left=250','width=500,height=500')\">Print</button></div>");


  //$(".dt-buttons").after("<div id=\"reportrange\" style=\"width:100px;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc\"><i class=\"glyphicon glyphicon-calendar fa fa-calendar\"></i><span>December 30, 2014 - January 28, 2015</span> <b class=\"caret\"></b></div>");

  
  //$(".btn-export").css("position","absolute");
</script>
<?php if(isset($_GET['startDate']) && isset($_GET['endDate'])): ?>

<script>
  var url = document.location.href;
  var res = url.split("?");
  startDate = "<?php echo e(urlencode($_GET['startDate'])); ?>";
  endDate = "<?php echo e(urlencode($_GET['endDate'])); ?>";
 $(".dt-buttons").after("<button class=\"btn-print btn btn-sm btn-success pull-right\" onclick=\"window.open('/logistic/printRkb?"+res[1]+"','_blank','top=0,left=0,width=1,height=1,toolbar=no,scrollbars=no,resizable=no,titlebar=no,location=no,fullscreen=no,menubar=no,status=no')\">Print</button>");
</script>
<?php else: ?>
<script>
 $(".dt-buttons").after("<button class=\"btn-print btn btn-sm btn-success pull-right\" onclick=\"window.open('/logistic/printRkb','_blank','top=0,left=0,width=1,height=1,toolbar=no,scrollbars=no,resizable=no,titlebar=no,location=no,fullscreen=no,menubar=no,status=no')\">Print</button>");
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>