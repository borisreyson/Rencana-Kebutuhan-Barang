
<?php $__env->startSection('title'); ?>
ABP-system | Report Keluar - Masuk Sarana
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
<style>
.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;height: 100px;

            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            }  

.ck-editor__editable {
    min-height: 90px;
}
.event a {
    background-color: #42B373 !important;
    background-image :none !important;
    color: #ffffff !important;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
//dd(date("Y-m-d H:i:s",strtotime("-1 Days")));
$arrRULE = [];
  if(isset($getUser)){
    $arrRULE = explode(',',$getUser->rule);    
  }else{
    ?>
<script>
  window.location="<?php echo e(url('/logout')); ?>";
</script>
    <?php } ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Keluar - Masuk Sarana</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">

<div class="row">
<div class="col-lg-12 ">
<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
<?php $__currentLoopData = $K_M; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
  $pemohon = Illuminate\Support\Facades\DB::table("db_karyawan.data_karyawan")->where("nik",$v->nik)->first();

?>
<div class="panel" style="border:1px solid #333;vertical-align: middle!important;">
  <div style="cursor: pointer;cursor: hand; " class="panel-heading collapsed " role="tab" id="heading<?php echo e($k); ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo e($k); ?>" aria-expanded="false" aria-controls="collapseOne">
  <div class="row" id="my_id">
    
    <h4 class="panel-title">
<div class="col-lg-8 col-md-12 col-sm-12">
  <div class="row">
    <div class="col-lg-6 col-xs-12">
      <i class="fa fa-bars" id="menus_animate"></i> No : <font color="blue" style="font-weight: bolder;"> <?php echo e($v->nomor); ?></font> 
      | 
      Pemohon
      <font color="blue" style="font-weight: bolder;"> <?php echo e(ucwords($pemohon->nama)); ?></font>
      <br><br>
    </div>
    <div class="col-lg-6 col-xs-12">
      <span>Tanggal : <?php echo e(date("d F Y",strtotime($v->tgl_out))); ?></span>
      <span>Jam Keluar : <?php echo e(date("H:i:s",strtotime($v->jam_out))); ?></span>
      <br><br>
      </div>
      </div>
</div>
    <div class="pull-right col-lg-4 col-md-12 col-sm-12 text-right">
      <?php if($v->no_lv=="motor" || $v->no_lv=="mobil"): ?><?php echo e(ucwords($v->no_lv)); ?> |<?php endif; ?>
          Status
           : 
           <?php if($v->flag==0): ?>
           <?php if(in_array('approve sarpras',$arrRULE)): ?>
           <?php if(isset($_GET['dt_expr'])): ?>
            <button class="btn btn-xs btn-danger" id="expr" type="button"><i class="fa fa-times"></i> Expired</button>
           <?php else: ?>
           <?php if($v->flag_appr==2): ?>
           <?php if(isset($_GET['dt_expr'])): ?>
            <button class="btn btn-xs btn-danger" id="expr" type="button"><i class="fa fa-times"></i> Expired</button>
           <?php else: ?>           
           <label class="btn btn-xs btn-warning" id="menunggu"><i class="fa fa-spinner fa-spin"></i> Waiting</label> 
           <?php endif; ?>
           <?php elseif($v->flag_appr==0): ?>
           <label class="btn btn-xs btn-danger" id="dicancel"><i class="fa fa-times"></i> Cancel | <?php echo e(date("H:i:s d F Y",strtotime($v->tanggal_appr))); ?></label>
           <?php elseif($v->flag_appr==1): ?>
           <label class="btn btn-xs btn-success" id="disetujui"><i class="fa fa-check"></i>Disetujui | <?php echo e(date("H:i:s d F Y",strtotime($v->tanggal_appr))); ?></label> 
           <a href="" class="btn btn-xs btn-primary" data_id="<?php echo e($v->noid_out); ?>" id="lihat"><i class="fa fa-desktop"></i> Lihat</a>
           <?php endif; ?>    
           <?php endif; ?>
           <?php endif; ?>
           <?php if($v->flag_appr==2): ?>
           <?php if(isset($_GET['dt_expr'])): ?>
            <button class="btn btn-xs btn-danger" id="expr" type="button"><i class="fa fa-times"></i> Expired</button>
           <?php else: ?>
           <label class="btn btn-xs btn-warning" id="menunggu"><i class="fa fa-spinner fa-spin"></i> Waiting</label> 
           <?php endif; ?>
           <?php elseif($v->flag_appr==0): ?>
           <label class="btn btn-xs btn-danger" id="dicancel"><i class="fa fa-times"></i> Cancel | <?php echo e(date("H:i:s d F Y",strtotime($v->tanggal_appr))); ?></label>
           <?php elseif($v->flag_appr==1): ?>
           <label class="btn btn-xs btn-success" id="disetujui"><i class="fa fa-check"></i>Disetujui | <?php echo e(date("H:i:s d F Y",strtotime($v->tanggal_appr))); ?></label> 
           <a href="" class="btn btn-xs btn-primary" data_id="<?php echo e($v->noid_out); ?>" id="lihat"><i class="fa fa-desktop"></i> Lihat</a>
           <?php endif; ?>
           <?php else: ?>
            <button class="btn btn-xs btn-danger" id="expr" type="button"><i class="fa fa-times"></i> Cancel</button>
           <?php endif; ?>
        </div>
    </h4>
    </div>
  </div>
  <div id="collapse<?php echo e($k); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo e($k); ?>">
    <div class="panel-body">
      <div class="row">
        <div class="col-lg-12">
            <?php if($v->flag>0): ?>
          <div class="col-lg-12" style="color: red;">
          <b class="col-lg-2">Remark Cancel </b> <b class="col-lg-9"><b>:</b> <?php echo e($v->flag_note); ?></b>
          </div>
            <?php endif; ?>
          <div class="col-lg-12">
              <?php if($v->no_lv=="motor" || $v->no_lv=="mobil"): ?>
          <b class="col-lg-2">Jenis Kendaraan </b> <span class="col-lg-9"><b>:</b> <?php echo e(ucwords($v->no_lv)); ?> (<?php echo e(ucwords($v->no_pol)); ?>)</span>
          <?php else: ?>
          <b class="col-lg-2">No LV </b> <span class="col-lg-9"><b>:</b> <?php echo e(ucwords($v->no_lv)); ?></span>
          <?php endif; ?>
          </div>
          <div class="col-lg-12">
            <?php if($v->no_lv=="motor" || $v->no_lv=="mobil"): ?>
            <b class="col-lg-2">Merk Kendaraan </b>  <span class="col-lg-9"><b>:</b> <?php echo e(ucwords($v->driver)); ?></span>
            <?php else: ?>
            <?php
            $driver = Illuminate\Support\Facades\DB::table("db_karyawan.data_karyawan")->where("nik",$v->driver)->first();
            ?>
          <b class="col-lg-2">Driver </b>  <span class="col-lg-9"><b>:</b> <?php echo e(ucwords($driver->nama)); ?></span>
          
          <?php endif; ?>
          </div>
          <div class="col-lg-12">
          <b class="col-lg-2">Keperluan </b>  <span class="col-lg-9"><b>:</b> <?php echo e($v->keperluan); ?></span>
          </div>
          <div class="col-lg-12">
            <br><br>
          </div>          
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Tanggal Keluar</th>
            <th>Jam Keluar</th>
            <th>Tanggal Masuk</th>
            <th>Jam Masuk</th>
            <?php if(isset($v->keterangan_in)): ?>
            <th>Keterangan Masuk</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo e(date("d F Y",strtotime($v->tgl_out))); ?></td>
            <td><?php echo e(date("H:i:s",strtotime($v->jam_out))); ?></td>
            <td><?php if(isset($v->tgl_in)): ?><?php echo e(date("d F Y",strtotime($v->tgl_in))); ?><?php else: ?> - <?php endif; ?></td>
            <td><?php if(isset($v->jam_in)): ?><?php echo e(date("H:i:s",strtotime($v->jam_in))); ?><?php else: ?> - <?php endif; ?></td>
            <?php if(isset($v->keterangan_in)): ?>
            <td><?php echo e(($v->keterangan_in)); ?></td>
            <?php endif; ?>
          </tr>
          <?php if(!isset($v->tgl_in)): ?>
          <tr>
            <td colspan="3">&nbsp;</td>
            <td colspan="2">
           <?php if(in_array('user sarpras',$arrRULE)): ?>
              <button class="btn btn-xs btn-primary" id="T_M_IN" noid="<?php echo e($v->noid_out); ?>" type="button" name="T_M_IN" data-toggle="modal" data-target="#myModal">Input Tanggal & Jam Masuk</button>
              <?php endif; ?>
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
      </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <h3>Penumpang</h3>
        </div>
        <div class="col-lg-12">
          <table class="table-bordered table">
            <thead>
              <tr>
                <th>Nik</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Dept / Sect</th>
              </tr>
            </thead>
            <tbody>
        <?php
        $semua_penumpang = explode(",",$v->penumpang_out);
        ?>
        <?php $__currentLoopData = $semua_penumpang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kP => $vP): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
          $p = Illuminate\Support\Facades\DB::table("db_karyawan.data_karyawan")
                ->join("department","department.id_dept","db_karyawan.data_karyawan.departemen")
                ->leftjoin("section","section.id_sect","db_karyawan.data_karyawan.devisi")
                ->where("db_karyawan.data_karyawan.nik",$vP)->first();
         ?>
              <tr>
                <td><?php echo e($p->nik); ?></td>
                <td><?php echo e(ucwords($p->nama)); ?></td>
                <td><?php echo e(ucwords($p->jabatan)); ?></td>
                <td><?php echo e(ucwords($p->dept)); ?> / <?php echo e(ucwords($p->sect)); ?></td>
              </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 pull-right">
        <?php 
        /*
          $appr = Illuminate\Support\Facades\DB::table("vihicle.v_approve")
                ->join("user_login","user_login.username","vihicle.v_approve.user_appr")
                ->where("noid_out",$v->noid_out)->first();
                */
         ?>
          <!--<label class="control-label" style="color:blue;font-size: 16px;">Disetujui Oleh : </label>-->
        </div>
      </div>
    </div>
  </div>
</div>                      
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!-- end of accordion -->
</div>
</div>
<div class="col-lg-12 text-center">
  <!---PAGINATION-->
  <?php echo e($K_M->links()); ?>

  <!---PAGINATION-->
</div>
</div>

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
  <div class="modal-dialog modal-lg" id="modal_dialog">
<div id="konten_modal"></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Datatables -->
    <!-- FastClick -->


<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(asset('/vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>
<script>
  $("button[id=T_M_IN]").click(function(){
    eq = $("button[id=T_M_IN]").index(this);
    noid = $("button[id=T_M_IN]").eq(eq).attr("noid");

    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/sarpras/sarana/keluar-masuk/t_m_in')); ?>",
      data:{noid_out:noid},
      beforeSend:function(){
        $("div[id=modal_dialog]").removeClass("modal-lg").addClass("modal-md");
      },
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });
  $("a[id=lihat]").click(function(){
    eq = $("a[id=lihat]").index(this);
    noid_out = $("a[id=lihat]").eq(eq).attr("data_id");
    window.open("<?php echo e(url('/sarpras/sarana/keluar-masuk-print-out-')); ?>"+noid_out,"_blank");
    return false;
  });
  var eventDates = {};
  <?php
    $dateEvent = Illuminate\Support\Facades\DB::table("vihicle.v_out_h")->groupBy("tgl_out")->get();
  foreach($dateEvent as $kEvent => $vEvent){
  ?>
    eventDates[ new Date( "<?php echo e(date('m/d/Y',strtotime($vEvent->tgl_out))); ?>" )] = new Date( "<?php echo e(date('m/d/Y',strtotime($vEvent->tgl_out))); ?>" );
  <?php
    }
  ?>
  $(".datepicker").datepicker({ 
                                dateFormat: 'dd MM yy', 
                                beforeShowDay: function(date) {
                                var highlight = eventDates[date];
                                if (highlight) {
                                     return [true, "event", "highlight"];
                                } else {
                                     return [true, '', ''];
                                }
                              }  
                            });
  $("button[id=Approve]").click(function(){
    eq = $("button[id=Approve]").index(this);
    data_id = $("button[id=Approve]").eq(eq).attr("data_id");
    //alert(data_id);
    $.ajax({
      type:"POST",
      url:"<?php echo e(url('/sarpras/sarana/approve')); ?>",
      data:{_token:"<?php echo e(csrf_token()); ?>",data_id:data_id},
      success:function(res){
        new PNotify({
          title: 'Info',
          text: res,
          type: 'info',
          hide: true,
          styling: 'bootstrap3'
      });
        setTimeout(function(){
          window.location.reload();
        },500);
      }
    });
    return false;
  });
  $("button[id=cancel]").click(function(){
    eq = $("button[id=cancel]").index(this);
    data_id = $("button[id=cancel]").eq(eq).attr("data_id");
    $.ajax({
      type:"POST",
      url:"<?php echo e(url('/sarpras/sarana/cancel')); ?>",
      data:{_token:"<?php echo e(csrf_token()); ?>",data_id:data_id},
      beforeSend:function(){
        $("div[id=modal_dialog]").removeClass("modal-lg").addClass("modal-md");
      },
      success:function(res){        
        $("div[id=konten_modal]").html(res);
      }
    });
      
  });
  $("button[id=newOutForm]").click(function(){
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/sarana/form-keluar')); ?>",
      beforeSend:function(){
        $("div[id=modal_dialog]").removeClass("modal-md").addClass("modal-lg");
      },
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });
  $("button[id=editOutForm]").click(function(){
    data_id = $("button[id=editOutForm]").attr('data-id');
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/sarana/edit')); ?>",
      data:{_token:"<?php echo e(csrf_token()); ?>",data_id:data_id},
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });


</script>
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
          type: 'error',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>