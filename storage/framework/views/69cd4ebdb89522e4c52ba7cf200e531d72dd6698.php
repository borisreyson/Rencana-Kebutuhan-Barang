
<?php $__env->startSection('title'); ?>
ABP-system | Rencana Kebutuhan Barang
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link href="<?php echo e(asset('/vendors/switchery/dist/switchery.min.css')); ?>" rel="stylesheet">
<style>
  thead tr th,tbody tr td{
    text-align: center;
  }    
  .dropdown-menu{
    box-shadow: 1px 1px 5px 5px rgba(0,0,0,0.2);
  }
  .dropdown-menu .print_prev{
    background-color: rgba(242,214,125,0.9);

    color: rgba(0,0,0,0.7);
  }
  .dropdown-menu .details{
    background-color: rgba(245,148,28,0.9);

    color: #fff;
  }
  .dropdown-menu .cancel{
    background-color: rgba(191,17,46,0.9);
    color: #fff;
  }
  .dropdown-menu .po{
    background-color: rgba(56,146,166,0.9);
    color: #fff;
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
                    <h2>Report <small>Rencana Kebutuhan Barang <?php echo e(session("success")); ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>


  <div class="row">

<div class="col-md-7">
  <div class="row">
<div class="col-md-12">
  <div class="btn-group">
  <a data-toggle="collapse" id="filter" data-parent="#accordion" href="#collapseOne" class="btn btn-info"><i class="fa fa-filter"></i> Filter</a>
<?php if(!($_SESSION['section']=="KABAG" || $_SESSION['section']=="KTT" || $_SESSION['section']=="PURCHASING" )): ?>
  <a href="<?php echo e(url('/form_rkb')); ?>" class="btn btn-default">Create New</a>
<?php endif; ?>
<?php if(isset($_GET['expired'])!=""): ?>
  <a href="<?php echo e(url('rkb')); ?>" class="btn btn-default">RKB</a>
<?php else: ?>
  <a href="<?php echo e(url('rkb?expired=notnull')); ?>" class="btn btn-danger"> RKB EXPIRED</a>
<?php endif; ?>
<?php if(isset($_GET['close_rkb'])!=""): ?>
<a href="<?php echo e(url('rkb')); ?>" class="btn btn-default">RKB</a>
<?php else: ?>
<a href="<?php echo e(url('/rkb/close?close_rkb=all')); ?>" class="btn btn-default">RKB Close</a>
<?php endif; ?>
</div>
</div>
</div>

</div>
<div class="col-md-5">
  <div class="row">
  <form action="" method="post" class="form-horizontal">
    <?php echo e(csrf_field()); ?>

      <div class="form-group">
        <label class="control-label col-md-6"> Search</label>
        <div class=" col-md-6">
          <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for..." autocomplete="off" value="<?php echo e(isset($_POST['search']) ? $_POST['search'] : ''); ?>" required="required">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
          </div>
        </div>
      </div>
  </form>
  </div>
</div>
</div>


<div class="col-md-12">
  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                              <form action="" method="get">
                      <div class="panel">
                        <div id="collapseOne" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
<table class="table">
  <tbody>
    <tr>
      <th><label for="disetujui">Approved by Kabag</label></th>
      <td><input type="checkbox" class="js-switch grouped" <?php if(isset($_GET['disetujui'])==1){ echo "checked=\"checked\""; }?> value="1" name="disetujui" id="disetujui"></td>

      <th><label for="diketahui">Approved by KTT</label></th>
      <td><input type="checkbox" <?php if(isset($_GET['diketahui'])==1){ echo "checked=\"checked\""; }?> class="js-switch grouped" name="diketahui" value="1" id="diketahui"></td>

      <th><label for="approve">Waiting</label></th>
      <td><input type="checkbox" <?php if(isset($_GET['approve'])==1){ echo "checked=\"checked\""; }?> class="js-switch grouped" name="approve" value="1" id="approve"></td>


      <th><label for="cancel">Cancel</label></th>
      <td><input type="checkbox" <?php if(isset($_GET['cancel'])==1){ echo "checked=\"checked\""; }?> class="js-switch ungroup" name="cancel" value="1" id="cancel"></td>
    </tr>

<?php if($_SESSION['section']=="KABAG"||$_SESSION['section']=="KTT"||$_SESSION['section']=="PURCHASING"): ?>
    <tr>
      <?php if($_SESSION['section']=="KTT" || $_SESSION['section']=="PURCHASING"): ?>
      <th><label>Department</label></th>
      <td>
          <?php
$dep = Illuminate\Support\Facades\DB::table('department')->groupBy("dept")->get();
          ?>
        <select class="form-control" name="dep" id="dep">
          <option value="" selected="selected">--PILIH--</option>
          <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kd => $vd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($vd->dept!="ALL"): ?>
          <?php if(isset($_GET['dep'])): ?>
          <?php if($_GET['dep']==$vd->dept): ?>
            <option selected="selected" value="<?php echo e($vd->dept); ?>"><?php echo e($vd->dept); ?></option>
          <?php else: ?>
            <option value="<?php echo e($vd->dept); ?>"><?php echo e($vd->dept); ?></option>
          <?php endif; ?>
          <?php else: ?>
            <option value="<?php echo e($vd->dept); ?>"><?php echo e($vd->dept); ?></option>

          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
      </td>
      <?php endif; ?>
      <th><label>Section</label></th>
      <td>
          <?php

if($_SESSION['department']!="ALL"){
$section = Illuminate\Support\Facades\DB::table('department')->where("dept",$_SESSION['department'])->get();
}else{
$section = Illuminate\Support\Facades\DB::table('department')->get();  
}
          ?>
        <select class="form-control" name="seksi" id="seksi" disabled="disabled">
          <option value="" selected="selected">--PILIH--</option>
          <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($v->sect!="KABAG" && $v->sect!="KTT" && $v->sect!="PURCHASING"): ?>
            <?php if(isset($_GET['seksi'])): ?>
            <?php if($v->sect==$_GET['seksi']): ?>
            <option selected="selected" value="<?php echo e($v->sect); ?>"><?php echo e($v->sect); ?></option>
            <?php else: ?>
            <option value="<?php echo e($v->sect); ?>"><?php echo e($v->sect); ?></option>
            <?php endif; ?>
            <?php else: ?>
            <option value="<?php echo e($v->sect); ?>"><?php echo e($v->sect); ?></option>
            <?php endif; ?>

            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
      </td>
      <td colspan="6"></td>
    </tr>
<?php endif; ?>
    <tr>
      <td colspan="7"> </td>
      <td align="right">
        <button type="submit" class="btn btn-primary">submit</button>
      </td>
    </tr>
  </tbody>
</table>
                          </div>
                        </div>
                      </div>
                              </form>
                    </div>
</div>
                    <div class="">
                      <table id="" class="table table-striped  bulk_action table-bordered table-responsive">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">RKB Number </th>
                            <th class="column-title">Department - Section </th>
                            <th class="column-title">RKB Date </th>
                            <th class="column-title">User</th>
                            <th class="column-title">Ka. Bag. </th>
                            <th class="column-title" width="150px">KTT </th>
                            <?php if(isset($_GET['expired'])): ?>
                            <th class="column-title">Expired Remarks </th>
                            <?php endif; ?>
                            <?php if(isset($_GET['close_rkb'])): ?>
                            <th class="column-title">NM PO </th>
                            <th class="column-title" width="150px">Close Remarks </th>
                            <?php endif; ?>
                            <th class="column-title no-link last" width="150px" align="center" ><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="5">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
<?php if(count($rkb)>0): ?>
<?php $__currentLoopData = $rkb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($key%2): ?>
                          <tr class="odd pointer">
                            <td class=" "  style="text-align: left!important;">                          
<span class="text<?php echo e($key); ?>"><?php echo e($value->no_rkb); ?> </span> <br>
<a href="#" class="btn btn-xs btn-primary" dept="hrga" id="PURCHASING" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" section="PURCHASING" tmp-view="ktt">Send To PURCHASING</a>
<button id="clipboard_btn" class="btn btn-xs pull-right" data-tooltip="tooltip" title="Copy" data-clipboard-action="copy" data-clipboard-target=".text<?php echo e($key); ?>"><i class="fa fa-clipboard"></i></button>

<?php if(!($value->cancel_section=="KABAG" || $value->cancel_section=="KTT" || $value->cancel_section==null)): ?>
<label class="label label-danger" style="float: right!important;">Cancel By <?php echo e($value->cancel_user); ?> - <?php echo e($value->cancel_section); ?></label>
<?php endif; ?>

                            </td>
                            <td class=" "><?php echo e($value->dept); ?> <br> <?php echo e($value->section); ?></td>
                            <td class=" ">
                              <?php echo e(date("d F Y",strtotime($value->tgl_order))); ?> 
                            </td>
                            <td class=" ">
                              <?php echo e($value->nama_lengkap); ?> 
                            </td>
                            <td class=" ">
                              <?php if($value->disetujui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s ,d F Y",strtotime($value->tgl_disetujui))); ?></label>
                              <?php 
                              $user_app = Illuminate\Support\Facades\DB::table("user_approve")
                                          ->leftjoin("user_login","user_login.username","user_approve.username")
                                          ->where([
                                          ["user_approve.no_rkb",$value->no_rkb],
                                          ["user_approve.desk","Disetujui"]
                                          ])
                                          ->first();
                               ?>
                              <?php if($user_app): ?>
                              <?php if($user_app->level=="PLT"): ?>
                              <br>
                              <label class="label label-default"><?php echo e($user_app->nama_lengkap); ?></label>
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
                              <br>
                              <a href="#" class="btn btn-xs btn-primary" dept="<?php echo e($value->department); ?>" id="KABAG" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>"  tmp-view="new" section="KABAG">Send To Kabag</a>

                              <a href="#" class="btn btn-xs btn-primary" dept="<?php echo e($value->department); ?>" id="KABAG" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>"  tmp-view="new" section="SECTION_HEAD">Send To Section Head</a>
                            </td>
                            <td class=" ">
                              <?php if($value->diketahui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s ,d F Y",strtotime($value->tgl_diketahui))); ?></label>
                              <?php 
                              $user_app = Illuminate\Support\Facades\DB::table("user_approve")
                                          ->leftjoin("user_login","user_login.username","user_approve.username")
                                          ->where([
                                          ["user_approve.no_rkb",$value->no_rkb],
                                          ["user_approve.desk","Diketahui"]
                                          ])
                                          ->first();
                               ?>
                              <?php if($user_app): ?>
                              <?php if($user_app->level=="PLT"): ?>
                              <br>
                              <label class="label label-default"><?php echo e($user_app->nama_lengkap); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_section==null): ?>
                              <label class="label label-warning">Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KTT"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php else: ?>
                              
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <br>
                              <a href="#" class="btn btn-xs btn-primary" dept="ALL" id="KTT" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" section="KTT"  tmp-view="kabag">Send To KTT</a>
                            </td>
<?php if(isset($_GET['expired'])): ?>
                            <td class=" " style="background-color: rgba(255,0,0,0.09);color: rgba(0,0,0,0.7);">
                              <?php echo e($value->expired_remarks); ?>

                            </td>
<?php endif; ?>
<?php if(isset($_GET['close_rkb'])): ?>
                            <td class=" " style="background-color: rgba(0,255,80,0.4);color: rgba(0,0,0,0.7);">
                              <?php echo e(isset($value->no_po) ? $value->no_po : "-"); ?>

                            </td>
                            <td class=" " style="background-color: rgba(0,255,80,0.4);color: rgba(0,0,0,0.7);">
                              <?php echo e($value->myStatus); ?>

                            </td>
<?php endif; ?>
                            <td class=" last" align="center">

                    <div class="btn-group dropright">
<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
        
<ul role="menu" class="dropdown-menu pull-right ">
  <!--
                              <?php if($value->disetujui!=0 || $value->diketahui!=0): ?>
                              <?php if($value->cancel_user==null): ?>
                              <li><a href="<?php echo e(url('/convert/'.bin2hex($value->no_rkb).'.PO')); ?>" class="po">Convert To PO</a></li>
                              <?php endif; ?>
                              <?php endif; ?>
  -->
<?php if($_SESSION['level']=="administrator"): ?>

                              <li><a href="#" class="qty" data-id="<?php echo e($value->no_rkb); ?>" id="qty" data-toggle="modal" data-target="#myModal">Edit Quantity</a></li>
<?php else: ?>
                              <?php if($value->cancel_section==null): ?>
                              <?php if($value->diketahui==1): ?>
                              <li><a href="#" class="qty" data-id="<?php echo e($value->no_rkb); ?>" id="qty" data-toggle="modal" data-target="#myModal">Edit Quantity</a></li>
                              <?php endif; ?>
                              <?php endif; ?>
<?php endif; ?>
                              <li><a href="#" class="details" data-id="<?php echo e($value->no_rkb); ?>" id="details" data-toggle="modal" data-target="#myModal">Details</a></li>
                              <li><a href="<?php echo e(url('print-preview-'.bin2hex($value->no_rkb))); ?>" class="print_prev" target="_blank">Print Preview </a></li>
<?php if(!isset($_GET['expired'])): ?>
<?php if($value->cancel_section==""): ?>
<?php if($value->disetujui=='1' && $value->diketahui=='0'): ?>
                              
                              <li><a href="#" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="expired_rkb" class="cancel" data-toggle="modal" data-target="#myModal">SET EXPIRED</a></li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
                              <?php if($value->cancel_section==null): ?>
                              <?php if($value->diketahui==1): ?>
                              <!--<li><a href="#" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="cancel_rkb" class="cancel" data-toggle="modal" data-target="#myModal">Cancel</a></li>-->
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php if(isset($_GET['close_rkb'])==""): ?>
                              <li><a href="#" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="close_rkb" class="close_rkb" data-toggle="modal" data-target="#myModal">Close RKB</a></li>
                              <?php endif; ?>
                            </ul>
                          </div>

                            </td>
                          </tr>
 <?php else: ?>
                          <tr class="event pointer">
                            <td class=" " style="text-align: left!important;">                          
<span class="text<?php echo e($key); ?>"><?php echo e($value->no_rkb); ?></span><br>
<a href="#" class="btn btn-xs btn-primary" dept="hrga" id="PURCHASING" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" section="PURCHASING"  tmp-view="ktt">Send To PURCHASING</a>
<button id="clipboard_btn" class="btn btn-xs pull-right" data-tooltip="tooltip" title="Copy" data-clipboard-action="copy" data-clipboard-target=".text<?php echo e($key); ?>"><i class="fa fa-clipboard"></i></button> 
<?php if(!($value->cancel_section=="KABAG" || $value->cancel_section=="KTT" || $value->cancel_section==null)): ?>
<label class="label label-danger" style="float: right!important;">Cancel By <?php echo e($value->cancel_user); ?> - <?php echo e($value->cancel_section); ?></label>
<?php endif; ?>
</td>
                            <td class=" "><?php echo e($value->dept); ?> <br> <?php echo e($value->section); ?></td>
                            <td class=" ">
                              <?php echo e(date("d F Y",strtotime($value->tgl_order))); ?> </td>
                            <td class=" ">
                              <?php echo e($value->nama_lengkap); ?> 
                            </td>
                            <td class=" ">
                              <?php if($value->disetujui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s , d F Y",strtotime($value->tgl_disetujui))); ?></label>
                              <?php 
                              $user_app = Illuminate\Support\Facades\DB::table("user_approve")
                                          ->leftjoin("user_login","user_login.username","user_approve.username")
                                          ->where([
                                          ["user_approve.no_rkb",$value->no_rkb],
                                          ["user_approve.desk","Disetujui"]
                                          ])
                                          ->first();
                               ?>
                              <?php if($user_app): ?>
                              <?php if($user_app->level=="PLT"): ?>
                              <br>
                              <label class="label label-default"><?php echo e($user_app->nama_lengkap); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_section==null): ?>
                              <label class="label label-warning">Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KABAG"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>                              
                              <br>
                              <a href="#" class="btn btn-xs btn-primary" dept="<?php echo e($value->department); ?>" id="KABAG" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" tmp-view="new" section="KABAG">Send To Kabag</a>
                              <a href="#" class="btn btn-xs btn-primary" dept="<?php echo e($value->department); ?>" id="KABAG" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" tmp-view="new" section="SECTION_HEAD">Send To Section Head</a>
                               </td>
                            <td class=" ">
                              <?php if($value->diketahui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s , d F Y",strtotime($value->tgl_diketahui))); ?></label>

                              <?php 
                              $user_app = Illuminate\Support\Facades\DB::table("user_approve")
                                          ->leftjoin("user_login","user_login.username","user_approve.username")
                                          ->where([
                                          ["user_approve.no_rkb",$value->no_rkb],
                                          ["user_approve.desk","Diketahui"]
                                          ])
                                          ->first();
                               ?>
                              <?php if($user_app): ?>
                              <?php if($user_app->level=="PLT"): ?>
                              <br>
                              <label class="label label-default"><?php echo e($user_app->nama_lengkap); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_section==null): ?>
                              
                              <label class="label label-warning">Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KTT"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php else: ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <br>
                              <a href="#" class="btn btn-xs btn-primary" dept="ALL" id="KTT" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" tmp-view="kabag" section="KTT">Send To KTT</a>
                            </td>
<?php if(isset($_GET['expired'])): ?>
                            <td class=" " style="background-color: rgba(255,0,0,0.09);color: rgba(0,0,0,0.7);">
                              <?php echo e($value->expired_remarks); ?>

                            </td>
<?php endif; ?>
<?php if(isset($_GET['close_rkb'])): ?>
                            <td class=" " style="background-color: rgba(0,255,80,0.4);color: rgba(0,0,0,0.7);">
                              <?php echo e(isset($value->no_po) ? $value->no_po : "-"); ?>

                            </td>
                            <td class=" " style="background-color: rgba(0,255,80,0.4);color: rgba(0,0,0,0.7);">
                              <?php echo e($value->myStatus); ?>

                            </td>
<?php endif; ?>
                            <td class=" last" align="center">
                    <div class="btn-group dropright">
<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
<ul role="menu" class="dropdown-menu pull-right ">
  <!--
                              <?php if($value->disetujui!=0 || $value->diketahui!=0): ?>
                              <?php if($value->cancel_user==null): ?>
                              <li><a href="<?php echo e(url('/convert/'.bin2hex($value->no_rkb).'.PO')); ?>" class="po">Convert To PO</a></li>
                              <?php endif; ?>
                              <?php endif; ?>
                            -->
  <?php if($_SESSION['level']=="administrator"): ?>
                              <li><a href="#" class="qty" data-id="<?php echo e($value->no_rkb); ?>" id="qty" data-toggle="modal" data-target="#myModal">Edit Quantity</a></li>
 <?php else: ?>
                              <?php if($value->cancel_section==null): ?>
                              <?php if($value->diketahui==1): ?>
                              <li><a href="#" class="qty" data-id="<?php echo e($value->no_rkb); ?>" id="qty" data-toggle="modal" data-target="#myModal">Edit Quantity</a></li>
                              <?php endif; ?>
                              <?php endif; ?>
 <?php endif; ?>
                              <li><a href="#" class="details" data-id="<?php echo e($value->no_rkb); ?>" id="details" data-toggle="modal" data-target="#myModal">Details</a></li>
                              <li><a href="<?php echo e(url('print-preview-'.bin2hex($value->no_rkb))); ?>" class="print_prev" target="_blank">Print Preview </a></li>
<?php if(!isset($_GET['expired'])): ?>
<?php if($value->cancel_section==""): ?>
<?php if($value->disetujui=='1' && $value->diketahui=='0'): ?>
                              
                              <li><a href="#" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="expired_rkb" class="cancel" data-toggle="modal" data-target="#myModal">SET EXPIRED</a></li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
                              <?php if($value->cancel_section==null): ?>
                              <?php if($value->diketahui==1): ?>
                              <!--<li><a href="#" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="cancel_rkb" class="cancel" data-toggle="modal" data-target="#myModal">Cancel</a></li>-->
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php if(isset($_GET['close_rkb'])==""): ?>
                              <li><a href="#" no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="close_rkb" class="close_rkb" data-toggle="modal" data-target="#myModal">Close RKB</a></li>
                              <?php endif; ?>
                            </ul>
                          </div>
                            </td>
                          </tr>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
            <tr class="odd pointer">
                            <td class="a-center" align="center"  colspan="7">
                              Not have recored yet!
                            </td>
                         </tr>
<?php endif; ?>
                        </tbody>
                      </table>
                    </div>
            <?php echo e($rkb->links()); ?>

                  </div>
                  </div>
                </div>
              </div>
</div>


<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
<div id="konten_modal"></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/switchery/dist/switchery.min.js')); ?>"></script>
   <script src="<?php echo e(asset('/clipboard/dist/clipboard.min.js')); ?>"></script>

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
<?php if(session('failed')): ?>
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Failed',
          text: "<?php echo e(session('failed')); ?>",
          type: 'danger',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<script>
  $("select[id=dep]").change(function(){
    isi = $("select[id=dep]").val();
    if(isi==""){
      $("select[id=seksi]").html("<option value=\"\">--PILIH--</option>");
      $("select[id=seksi]").attr("disabled","disabled");
    }else{
      $.ajax({
        type:"POST",
        url:"api/department",
        data:{_token:"<?php echo e(csrf_token()); ?>",dept:isi},
        success:function(result){
          $("select[id=seksi]").html(result);
        }
      })
      $("select[id=seksi]").removeAttr("disabled");
    }
  });

  var z=0;
  $("a[id=filter]").click(function(){
    eq = $("a[id=filter]").index(this);
    if(z==0){
    $("a[id=filter]").removeClass('btn-info').addClass("btn-default active");
    z=1;
    }else{
    $("a[id=filter]").removeClass('btn-default active').addClass("btn-info");
    z=0;
    }
  });
  var i=0;
  var log_btn = [];
  $(".grouped").change(function(e){
    var eq = $(".grouped").index(this);
    if($('.grouped').eq(eq).is(':checked')){
    var name = $(".grouped").eq(eq).attr("name");  
      log_btn.push(name);
    }else{
      log_btn = log_btn.filter(function(item) { 
    var name1 = $(".grouped").eq(eq).attr("name");  
          return item !== name1
      });
    }
    console.log(log_btn);
  });
  $(".ungroup").change(function(){
    if($('.ungroup').is(':checked')){
           for(i=0; i<=log_btn.length; i++){
            $('input[id='+log_btn[i]+']').click();
           }
    }else{
    }
  });
  var clipboard = new ClipboardJS('button[id=clipboard_btn]');
  $("button[id=clipboard_btn]").on("click",function(){
    eq = $("button[id=clipboard_btn]").index(this);
    //console.log(eq);
    $("button[id=clipboard_btn]").eq(eq).attr("title","Copied");
    $("button[id=clipboard_btn]").eq(eq).mouseleave(function(){
      $("button[id=clipboard_btn]").eq(eq).attr("title","Copy");
    });
  
});

  $("[data-tooltip=tooltip]").tooltip();
  $("#datatables").dataTable({
    "order": [[ 0, "desc" ]]
  });
  $("a[id=details]").on("click",function(){
      eq = $("a[id=details]").index(this);
      data_id = $("a[id=details]").eq(eq).attr("data-id");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/rkb/detail.py')); ?>",
        data:{no_rkb:data_id},
        beforeSend:function(){
          $(".modal-dialog").removeClass('modal-md').addClass('modal-lg');
        },
        success:function(result){
          $("div[id=konten_modal]").html(result);
        }
      });
  });
  $("a[id=qty]").on("click",function(){
      eq = $("a[id=qty]").index(this);
      data_id = $("a[id=qty]").eq(eq).attr("data-id");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/purchasing/edit/qty')); ?>",
        data:{no_rkb:data_id},
        beforeSend:function(){
          $(".modal-dialog").removeClass('modal-md').addClass('modal-lg');
        },
        success:function(result){
          $("div[id=konten_modal]").html(result);
        }
      });
  });
  $("a[id=cancel_rkb]").on("click",function(){
      eq = $("a[id=cancel_rkb]").index(this);
      no_rkb = $("a[id=cancel_rkb]").eq(eq).attr("no-rkb");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/rkb/cancel-rkb.py')); ?>",
        data:{no_rkb:no_rkb},
        beforeSend:function(){
          $(".modal-dialog").removeClass('modal-lg').addClass('modal-md');
        },
        success:function(result){
          $("div[id=konten_modal]").html(result);
        }
      });
  });


  $("a[id=close_rkb]").on("click",function(){
      eq = $("a[id=close_rkb]").index(this);
      no_rkb = $("a[id=close_rkb]").eq(eq).attr("no-rkb");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/api/rkb/close.rkb')); ?>",
        data:{no_rkb:no_rkb},
        beforeSend:function(){
          $(".modal-dialog").removeClass('modal-lg').addClass('modal-md');
        },
        success:function(result){
          $("div[id=konten_modal]").html(result);
        }
      });
  });

  $("a[id=expired_rkb]").on("click",function(){
      eq = $("a[id=expired_rkb]").index(this);
      no_rkb = $("a[id=expired_rkb]").eq(eq).attr("no-rkb");
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('/api/expired')); ?>",
        data:{no_rkb:no_rkb},
        beforeSend:function(){
          $(".modal-dialog").removeClass('modal-lg').addClass('modal-md');
        },
        success:function(result){
          $("div[id=konten_modal]").html(result);
        }
      });
  });

$(document).on("click","a[id=KABAG]",function(){
  eq = $("a[id=KABAG]").index(this);
  dept = $("a[id=KABAG]").eq(eq).attr("dept");
  no_rkb = $("a[id=KABAG]").eq(eq).attr("no-rkb");
  sect = $("a[id=KABAG]").eq(eq).attr("section");  
  tmp_view = $("a[id=KABAG]").eq(eq).attr("tmp-view");
  $.ajax({
    type:"GET",
    url:"<?php echo e(url('/send/email')); ?>",
    data:{department:dept,section:sect,nomor_rkb:no_rkb,tmp_view:tmp_view},
    success:function(result){
      console.log(result);
      alert(result);
    }
  });
  return false;
});
$(document).on("click","a[id=KTT]",function(){
  eq = $("a[id=KTT]").index(this);
  dept = $("a[id=KTT]").eq(eq).attr("dept");
  no_rkb = $("a[id=KTT]").eq(eq).attr("no-rkb");
  sect = $("a[id=KTT]").eq(eq).attr("section");
  tmp_view = $("a[id=KTT]").eq(eq).attr("tmp-view");
  $.ajax({
    type:"GET",
    url:"<?php echo e(url('/send/email')); ?>",
    data:{department:dept,section:sect,nomor_rkb:no_rkb,tmp_view:tmp_view},
    success:function(result){
      console.log(result);
      alert(result);
    }
  });
  return false;
});

$(document).on("click","a[id=PURCHASING]",function(){
  eq = $("a[id=PURCHASING]").index(this);
  dept = $("a[id=PURCHASING]").eq(eq).attr("dept");
  no_rkb = $("a[id=PURCHASING]").eq(eq).attr("no-rkb");
  sect = $("a[id=PURCHASING]").eq(eq).attr("section");
  tmp_view = $("a[id=PURCHASING]").eq(eq).attr("tmp-view");
  $.ajax({
    type:"GET",
    url:"<?php echo e(url('/send/email')); ?>",
    data:{department:dept,section:sect,nomor_rkb:no_rkb,tmp_view:tmp_view},
    success:function(result){
      console.log(result);
      alert(result);
    }
  });
  return false;
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>