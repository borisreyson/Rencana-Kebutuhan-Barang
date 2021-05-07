
<?php $__env->startSection('title'); ?>
ABP-system | Roster
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/timepicker/jquery.timepicker.css')); ?>">
    <!-- Bootstrap Colorpicker -->
    <link href="<?php echo e(asset('/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" src="<?php echo e(url('bootstrap-table-master/src/extensions/fixed-columns/bootstrap-table-fixed-columns.css')); ?>">
<style>
.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;height: 100px;
  overflow-y: auto;
  overflow-x: hidden;
}  

.ck-editor__editable {
    min-height: 90px;
}
.myButtonDiss{
  background-color: transparent;
  border: 0px;
  position: absolute;
  z-index: 999;
  font-size: 25px;
  right: 50px;
 }

.active { z-index: 1!important; }
.border{
  border:1px solid #333;
  margin: 2px!important;
}
table tr .headcol {
  position: absolute;
  width: 35em;
  left: 0;
  top: auto;
  text-align: left!important;
  border-collapse: separate!important;
  border:solid 1px #DDEFEF !important;
  background-color: white;
}
.table-utama{
  margin-left: 34.1em;
  overflow-x: scroll;
  overflow-y: visible;
  padding: 0;
}
.long{
  width: 10em!important;
}
.input-group .bootstrap-select.form-control {
        z-index: inherit;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
function hari_ini($date){
  $hari = date ("D",$date);
 
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':     
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
 
  return $hari_ini;
 
}
?>  
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
                  <h2>Roster</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
  <div class="row col-lg-12">
   
<div class="col-lg-12 row">
  <div class="col-lg-12">

    <form action="" method="get" class="form-horizontal col-lg-10 row">
      <div class="form-group">
    <label class="control-label col-lg-3">Sub Bagian</label>
    <div class="col-lg-6 clearfix">
      <select name="id_sub" id="id_sub"  class="form-control" required="required" data-live-search="true">
        <option value="">--Pilih--</option>
        <?php $__currentLoopData = $sub_bagian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>        
          <optgroup label="<?php echo e($vv->dept); ?>">
        <?php
          $sub = Illuminate\Support\Facades\DB::table("db_karyawan.sub_bagian")
                  ->where("id_dept",$vv->id_dept)->get();
        ?>      
          <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kSub => $vSub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($_GET['id_sub'])): ?>
            <?php if($_GET['id_sub']==$vSub->id_sub): ?>
            <option value="<?php echo e($vSub->id_sub); ?>" selected="selected"><?php echo e($vSub->bagian); ?></option>  
            <?php else: ?>               
            <option value="<?php echo e($vSub->id_sub); ?>"><?php echo e($vSub->bagian); ?></option> 
            <?php endif; ?>
            <?php else: ?>            
            <option value="<?php echo e($vSub->id_sub); ?>"><?php echo e($vSub->bagian); ?></option> 
            <?php endif; ?>    
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
        </optgroup>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>     
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Tahun</label>
    <div class="col-lg-2">

      <?php if(isset($_GET['tahun'])): ?>
      <?php if($_GET['tahun']): ?>
      <input type="number" name="tahun" class="form-control" min="2016" required="required" value="<?php echo e($_GET['tahun']); ?>">
      <?php else: ?>
      <input type="number" name="tahun" class="form-control" min="2016" required="required" value="<?php echo e(date('Y')); ?>"> 
      <?php endif; ?> 
      <?php else: ?>
      <input type="number" name="tahun" class="form-control" min="2016" required="required" value="<?php echo e(date('Y')); ?>"> 
      <?php endif; ?>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-lg-3">Bulan</label>
    <div class="col-lg-2">
      <select name="bulan" id="bulan"  class="form-control" required="required" data-live-search="true">
        <option value="">--Pilih--</option>
        <?php        
        $start = strtotime(date("Y-01-01"));
        $end = strtotime(date("Y-12-t"));
        while($start <= $end)
              {
            ?>       
          <?php if(isset($_GET['bulan'])): ?>
          <?php if($_GET['bulan']==date('m',$start)): ?>
          <option value="<?php echo e(date('m',$start)); ?>" selected="sxelected"><?php echo e(date('F',$start)); ?></option>  
          <?php else: ?>               
          <option value="<?php echo e(date('m',$start)); ?>"><?php echo e(date('F',$start)); ?></option> 
          <?php endif; ?>
          <?php else: ?>            
          <option value="<?php echo e(date('m',$start)); ?>"><?php echo e(date('F',$start)); ?></option> 
          <?php endif; ?>
           <?php
                $start = strtotime("+1 month",$start);
                } ?>
      </select>     
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-6">
      <button class="btn btn-primary" id="kirim" type="submit">Lihat Roster</button> 
      <?php if(isset($_GET['id_sub'])): ?>
      <a href="<?php echo e(url('/absen/roster/karyawan?id_sub='.$_GET['id_sub'].'&tahun='.$_GET['tahun'].'&bulan='.$_GET['bulan'].'&import=true')); ?>" class="btn btn-primary" id="kirim" type="submit">Buat Roster</a>
      <?php else: ?>
      <a href="<?php echo e(url('/absen/roster/karyawan')); ?>" class="btn btn-primary" id="kirim" type="submit">Buat Roster</a>       
      <?php endif; ?>
      <a class="btn btn-danger" id="reset" href="<?php echo e(url($_SERVER['REDIRECT_URL'])); ?>">Reset</a>   
    </div>
  </div>
    </form>
  </div>
  <div class="col-lg-12">
    
  </div>
  <form action="" method="post" name="formRoster">
    <?php echo e(csrf_field()); ?>

  <?php if(isset($_GET['id_sub'])): ?>
    <input type="hidden" name="id_sub" value="<?php echo e($_GET['id_sub']); ?>">
    <input type="hidden" name="tahun" value="<?php echo e($_GET['tahun']); ?>">
    <input type="hidden" name="bulan" value="<?php echo e($_GET['bulan']); ?>">
    <?php
    $karyawan = Illuminate\Support\Facades\DB::table("db_karyawan.roster_kerja")
          ->join("db_karyawan.data_karyawan" ,"db_karyawan.data_karyawan.nik","db_karyawan.roster_kerja.nik")
          ->where([
                  ["db_karyawan.roster_kerja.sub_bagian",$_GET['id_sub']],
                  ["db_karyawan.roster_kerja.bulan",$_GET['bulan']],
                  ["db_karyawan.roster_kerja.tahun",$_GET['tahun']]
                  ])->groupBy("db_karyawan.roster_kerja.nik")
                  ->orderBy("db_karyawan.roster_kerja.id_roster")
                  ->get();
                  
    ?>
  <div class="col-lg-12">
    <hr>
    <div class="table-responsive table-utama">
   <table class="table table-bordered" >
      <thead>
        <tr>
          <th class="text-center headcol">Karyawan</th>
          <?php    
        $m = $_GET['bulan'];    
        $y = $_GET['tahun'];    
        $start = strtotime(date($y."-".$m."-01"));
        $end = strtotime(date($y."-".$m."-t"));
        while($start <= $end)
              {
            ?>
          <th class="text-center long" ><?php echo e(date("d/m/Y",$start)); ?></th>          
      <?php
        $start = strtotime("+1 day",$start);
        } ?>
        </tr>
        <tr>
          <th class="headcol">&nbsp;</th>

          <?php    
        $m = $_GET['bulan'];    
        $y = $_GET['tahun'];    
        $start = strtotime(date($y."-".$m."-01"));
        $end = strtotime(date($y."-".$m."-t"));
        while($start <= $end)
              {
            ?>
          <th class="text-center long" ><?php echo e(hari_ini($start)); ?></th>          
      <?php
        $start = strtotime("+1 day",$start);
        } ?>
        </tr>
      </thead>
      <tbody>
        <?php if(!isset($_GET['ubah'])): ?>
        <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td class="text-center headcol id_index">
            ( <?php echo e($vk->nik); ?> ) <?php echo e($vk->nama); ?>

            <a href="<?php echo e(url('/absen/roster/karyawan/delete?nik='.$vk->nik.'&id_sub='.$_GET['id_sub'].'&tahun='.$_GET['tahun'].'&bulan='.$_GET['bulan'])); ?>" class="pull-right btn btn-xs btn-danger" type="button"><i class="fa fa-times"></i></a>

          </td>
          <?php    
        $m = $_GET['bulan'];    
        $y = $_GET['tahun'];    
        $start = strtotime(date($y."-".$m."-01"));
        $end = strtotime(date($y."-".$m."-t"));
        while($start <= $end)
              {
$jam = Illuminate\Support\Facades\DB::table("db_karyawan.roster_kerja")
        ->join("db_karyawan.kode_jam_masuk","db_karyawan.kode_jam_masuk.id_kode","db_karyawan.roster_kerja.jam_kerja")
        ->where([
                  ["nik",$vk->nik],
                  ["tanggal",date("Y-m-d",$start)]
                ])
        ->first();
            ?>
            <?php if(isset($jam)): ?>
            <?php if($jam->kode_jam=="OFF"): ?>
          <td class="text-center long" style="background-color:<?php echo $jam->background;?>;color: <?php echo $jam->tulisan;?>; font-weight: bold;" ><?php echo e($jam->deskripsi); ?> </td>       
          <?php else: ?>
          <td class="text-center long" style="background-color:<?php echo $jam->background;?>; color: <?php echo $jam->tulisan;?>; font-weight: bold;"><?php echo e($jam->deskripsi); ?> </td>       
          <?php endif; ?>   
          <?php endif; ?>   
      <?php
        $start = strtotime("+1 day",$start);
        } ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td class="text-center headcol id_index">
            <input name="nik[]" type="hidden" id="nik"  class="form-control" required="required" value="<?php echo e($vk->nik); ?>">
            <div class="form-control-static"><?php echo e($vk->nama); ?></div>
          </td>
          <?php    
        $m = $_GET['bulan'];    
        $y = $_GET['tahun'];    
        $start = strtotime(date($y."-".$m."-01"));
        $end = strtotime(date($y."-".$m."-t"));
        $z=0;
        while($start <= $end)
              {

$jam = Illuminate\Support\Facades\DB::table("db_karyawan.roster_kerja")
        ->join("db_karyawan.kode_jam_masuk","db_karyawan.kode_jam_masuk.id_kode","db_karyawan.roster_kerja.jam_kerja")
        ->where([
                  ["nik",$vk->nik],
                  ["tanggal",date("Y-m-d",$start)]
                ])
        ->first();
            ?>
            <td>
            <input type="hidden" name="tgl[<?php echo e($kk); ?>][<?php echo e($z); ?>]" id="tgl" value="<?php echo e($start); ?>">
            <select name="jam_kerja[<?php echo e($kk); ?>][<?php echo e($z); ?>]" id="jam_kerja"  class="form-control long" required="required" data-live-search="true">
            <option value="">--Pilih--</option>
            <?php $__currentLoopData = $jamKerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kJ => $vJ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($jam)): ?>
            <?php if($vJ->id_kode == $jam->jam_kerja): ?>
            <option value="<?php echo e($vJ->id_kode); ?>" selected="selected"><?php echo e($vJ->deskripsi); ?> = <?php echo e($vJ->masuk); ?> - <?php echo e($vJ->pulang); ?></option>
            <?php else: ?>
            <option value="<?php echo e($vJ->id_kode); ?>"><?php echo e($vJ->deskripsi); ?> = <?php echo e($vJ->masuk); ?> - <?php echo e($vJ->pulang); ?></option>
            <?php endif; ?>
            <?php else: ?>
            <option value="<?php echo e($vJ->id_kode); ?>"><?php echo e($vJ->deskripsi); ?> = <?php echo e($vJ->masuk); ?> - <?php echo e($vJ->pulang); ?></option>            
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            </td>
      <?php
      $z++;
        $start = strtotime("+1 day",$start);
        } ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </tbody>
    </table>
    </div>
  <hr>

<div class="col-lg-12 text-center">
  <!---PAGINATION-->
 
  <!---PAGINATION-->
  <?php if(isset($_GET['ubah'])): ?>
      <button class="btn btn-primary pull-right" type="submit">Update</button>
      <a href="<?php echo e(url('absen/roster/karyawan')); ?>?id_sub=<?php echo e($_GET['id_sub']); ?>&tahun=<?php echo e($_GET['tahun']); ?>&bulan=<?php echo e($_GET['bulan']); ?>&jumKar=1" class="btn btn-default pull-right" type="submit">Add</a>

    <?php else: ?>
    <?php if(isset($_GET['id_sub'])): ?>
      <a href="<?php echo e(url('absen/roster/karyawan/lihat')); ?>?id_sub=<?php echo e($_GET['id_sub']); ?>&tahun=<?php echo e($_GET['tahun']); ?>&bulan=<?php echo e($_GET['bulan']); ?>&ubah=true" class="btn btn-warning pull-right">Ubah</a>
      <?php endif; ?>

    <?php endif; ?>
</div>
  <div class="col-lg-12">
    
  </div>
  </div>
  <div class="col-lg-4">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Kode Jam </th>
          <th>Jam Kerja</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $kodeJam = Illuminate\Support\Facades\DB::table("db_karyawan.roster_kerja")
                   ->join("db_karyawan.kode_jam_masuk","db_karyawan.kode_jam_masuk.id_kode","db_karyawan.roster_kerja.jam_kerja")
                   ->join("db_karyawan.jam_kerja","db_karyawan.jam_kerja.no","db_karyawan.kode_jam_masuk.id_jam_kerja")
                   ->where([
                    ["bulan",$_GET['bulan']],
                    ["tahun",$_GET['tahun']],
                    ["sub_bagian",$_GET['id_sub']]
                   ])
                   ->groupBy("db_karyawan.roster_kerja.jam_kerja")
                   ->get();
      ?>
      <?php $__currentLoopData = $kodeJam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td style="background-color: <?php echo $v->background;?>!important; color: <?php echo $v->tulisan;?>!important; font-weight: bold;"><?php echo e($v->kode_jam); ?> <?php if($v->kode_jam!="OFF"): ?> ( <?php echo e($v->deskripsi); ?> ) <?php endif; ?></td>

          <td style="background-color: <?php echo $v->background;?>!important; color: <?php echo $v->tulisan;?>!important; font-weight: bold;">
            <?php if($v->kode_jam=="OFF"): ?>
            -
            <?php else: ?>
            <?php echo e($v->masuk); ?> - <?php echo e($v->pulang); ?>

            <?php endif; ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
  </form>
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
  <div id="modals" class="modal-dialog modal-lg">
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
    <script src="<?php echo e(asset('/timepicker/jquery.timepicker.min.js')); ?>"></script>
<!-- Bootstrap Colorpicker -->
    <script src="<?php echo e(asset('/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
    <script src="<?php echo e(url('bootstrap-table-master/src/extensions/fixed-columns/bootstrap-table-fixed-columns.js')); ?>"></script>
    
    <script>
      $("select[id=nik]").selectpicker("refresh");
      $("#datepicker").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years"
      });
      $("select[name=nik]").selectpicker();
      $("button[name=new_sub]").click(function(){
        $.ajax({
          "type":"GET",
          "url":"<?php echo e(url('/absen/new/sub')); ?>",
          beforeSend:function(){
            $("div[id=modals]").removeClass("modal-lg").addClass("modal-md ");
          },
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