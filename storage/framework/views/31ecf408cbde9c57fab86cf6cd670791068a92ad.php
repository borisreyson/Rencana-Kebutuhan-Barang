
<?php $__env->startSection('title'); ?>
ABP-system | Unit Rental
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
.myButtonDiss{
  background-color: transparent;
  border: 0px;
  position: absolute;
  z-index: 999;
  font-size: 25px;
  right: 50px;
 }

.active { z-index: 1!important; }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                  <h2>Unit Rental</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">
  <form class="form-horizontal" method="post" action="">
<div class="col-lg-4 row">
  <?php echo e(csrf_field()); ?>


        <?php if(isset($edit)): ?>
        <input type="hidden" name="_method" value="PUT">
        <?php endif; ?>
  <div class="form-group">
    <label class="control-label col-lg-3">Tanggal</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="tgl" disabled class="form-control" required="required" value="<?php echo e(date('d F Y',strtotime($edit->tgl))); ?>">
      <?php else: ?>
      <input type="text" name="tgl" class="form-control" required="required" value="<?php echo e(date('d F Y',strtotime('-1 day'))); ?>">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Shift</label>
    <div class="col-lg-6">      
      <?php if(isset($edit)): ?>
      <div id="shift" class="btn-group" style="margin-bottom: 5px;" data-toggle="buttons">
        <?php if($edit->shift==1): ?>
              <label class="btn btn-warning active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" name="shift" value="1" checked="checked"> &nbsp; Shift I &nbsp;
              </label>
              <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                <input type="radio" name="shift" value="2"> Shift II
              </label>
              <?php elseif($edit->shift==2): ?>
              <label class="btn btn-warning " data-toggle-class="btn-primary" data-toggle-passive-class="btn-warning">
                <input type="radio" name="shift" value="1"> &nbsp; Shift I &nbsp;
              </label>
              <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                <input type="radio" name="shift" value="2" checked=""> Shift II
              </label>
              <?php endif; ?>
            </div>
      <?php else: ?>
      <div id="shift" class="btn-group" style="margin-bottom: 5px;" data-toggle="buttons">
              <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" name="shift" value="1" checked="checked"> &nbsp; Shift I &nbsp;
              </label>
              <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" name="shift" value="2"> Shift II
              </label>
            </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Unit</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <select name="unit" id="unit" class="form-control" required="required" data-live-search="true">
        <option value="">--PILIH--</option>
        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($v->id_unit==$edit->unit): ?>        
        <option value="<?php echo e($v->id_unit); ?>" selected="selected"><?php echo e($v->nama_unit); ?></option>
        <?php else: ?>
        <option value="<?php echo e($v->id_unit); ?>"><?php echo e($v->nama_unit); ?></option>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php else: ?>
      <select name="unit" id="unit" class="form-control" required="required" data-live-search="true">
        <option value="">--PILIH--</option>
        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($edit)): ?>
        <?php if($edit->id_unit==$v->id_unit): ?>        
        <option value="<?php echo e($v->id_unit); ?>"><?php echo e($v->nama_unit); ?></option>
        <?php else: ?>
        <option value="<?php echo e($v->id_unit); ?>" selected="selected"><?php echo e($v->nama_unit); ?></option>
        <?php endif; ?>
        <?php else: ?>
        <option value="<?php echo e($v->id_unit); ?>"><?php echo e($v->nama_unit); ?>1</option>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Nama</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="nama" class="form-control" required="required" placeholder="Nama" value="<?php echo e($edit->nama); ?>">
      <?php else: ?>
      <input type="text" name="nama" class="form-control" required="required" placeholder="Nama" value="">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">HM Awal</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="hm_awal" class="form-control" required="required" placeholder="HM Awal" value="<?php echo e(number_format($edit->hm_awal,1)); ?>">
      <?php else: ?>
      <input type="text" name="hm_awal" class="form-control" required="required" placeholder="HM Awal">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">HM Akhir</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="hm_akhir" class="form-control" required="required" placeholder="HM Akhir" value="<?php echo e(number_format($edit->hm_akhir,1)); ?>">
      <?php else: ?>
      <input type="text" name="hm_akhir" class="form-control" required="required" placeholder="HM Akhir" value="">
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="col-lg-3 row">
  <div class="form-group">
    <label class="control-label col-lg-3">MTK</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="mtk" class="form-control" required="required" placeholder="Mtd Actual" value="<?php echo e(number_format($edit->mtk,1)); ?>">
      <?php else: ?>
      <input type="text" name="mtk" class="form-control" required="required" placeholder="Mtd Actual" value="0">
      <?php endif; ?>
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label col-lg-3">ABP</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="abp" class="form-control" required="required" placeholder="Mtd Actual" value="<?php echo e(number_format($edit->abp,1)); ?>">
      <?php else: ?>
      <input type="text" name="abp" class="form-control" required="required" placeholder="Mtd Actual" value="0">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">BD</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="bd" class="form-control" required="required" placeholder="Mtd Actual" value="<?php echo e(number_format($edit->bd,1)); ?>">
      <?php else: ?>
      <input type="text" name="bd" class="form-control" required="required" placeholder="Mtd Actual" value="0">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">STB</label>
    <div class="col-lg-5">
      <?php if(isset($edit)): ?>
      <input type="text" name="stb" class="form-control" required="required" placeholder="Mtd Actual" value="<?php echo e(number_format($edit->stb,1)); ?>">
      <?php else: ?>
      <input type="text" name="stb" class="form-control" required="required" placeholder="Mtd Actual" value="0">
      <?php endif; ?>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-lg-8" align="right">
      <button class="btn btn-primary" type="submit">Simpan</button>  
      <a href="<?php echo e(url('/mon/unit/rental/form/hm')); ?>" class="btn btn-danger">Batal</a>  
    </div>
  </div>
</div>

</form>
<div class="col-lg-12 row">

  <div class="col-lg-12">
    <hr>
  </div>
  <div class="col-lg-12">
    <p><b>Jumlah : <?php echo e(count($rental)); ?></b> </p>
  </div>
  <table class="table table-bordered text-center">
    <thead>
      <tr class="bg-success">
        <th class="text-center">Tgl</th>
        <th class="text-center">Shift</th>
        <th class="text-center">Unit</th>
        <th class="text-center">Nama</th>
        <th class="text-center">HM Awal</th>
        <th class="text-center">HM Akhir</th>
        <th class="text-center">Total HM</th>
        <th class="text-center">ABP</th>
        <th class="text-center">MTK</th>
        <th class="text-center">Standby</th>
        <th class="text-center">Breakdown</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($rental)>0): ?>
      <?php $__currentLoopData = $rental; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr <?php if($v->flag!=1): ?> style="background-color:red;color:white;" <?php endif; ?>>
        <td><?php echo e(date("d F Y",strtotime($v->tgl))); ?></td>
        <?php 
          $unit = Illuminate\Support\Facades\DB::table('monitoring_unit.unit')->where("id_unit",$v->unit)->first();
         ?>

        <td>
           <?php if($v->shift==1): ?>
              Shift I
            <?php elseif($v->shift==2): ?>
              Shift II
            <?php endif; ?>
        </td>
        <td><?php echo e($unit->nama_unit); ?></td>
        <td><?php echo e($v->nama); ?></td>
        <td><?php echo e(number_format($v->hm_awal,1)); ?></td>
        <td><?php echo e(number_format($v->hm_akhir,1)); ?></td>
        <td><?php echo e(number_format($v->hm_akhir-$v->hm_awal,1)); ?></td>
        <td><?php echo e(number_format($v->abp,1)); ?></td>
        <td><?php echo e(number_format($v->mtk,1)); ?></td>
        <td><?php echo e(number_format($v->stb,1)); ?></td>
        <td><?php echo e(number_format($v->bd,1)); ?></td>
        <td>
          <a class="btn btn-warning btn-xs" href="<?php echo e(url('/mon/unit/rental/form/hm-'.bin2hex($v->id_hm))); ?>" id="edit"><i class="fa fa-pencil"></i></a>
          <?php if($v->flag==1): ?>
          <a class="btn btn-danger btn-xs" href="<?php echo e(url('/mon/unit/rental/hm-del'.bin2hex($v->id_hm))); ?>" id="edit"><i class="fa fa-trash"></i></a>
          <?php else: ?>
          <a class="btn btn-success btn-xs" href="<?php echo e(url('/mon/unit/rental/hm-undo'.bin2hex($v->id_hm))); ?>" id="edit"><i class="fa fa-undo"></i></a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <tr>
        <td colspan="10">Data Kosong</td>
      </tr>

      <?php endif; ?>
    </tbody>
  </table>
  <div class="col-lg-12">
    <p><b>Jumlah : <?php echo e(count($rental)); ?></b> </p>
  </div>
</div>
<div class="col-lg-12 text-center">
  <!---PAGINATION-->
    <?php echo e($rental->links()); ?>

    <span id="text"></span>
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
  <div class="modal-dialog modal-lg">
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
  $("input[name=mtk]").keyup(function(){
    hm_awal = $("input[name=hm_awal]").val();
    hm_akhir= $("input[name=hm_akhir]").val();
    bd      = $("input[name=bd]").val();
    totalHM = (hm_akhir.replace(",","")-hm_awal.replace(",",""));

    mtk = $("input[name=mtk]").val();
    txtABP = totalHM.toFixed(1)-mtk.replace(",","");
    stb = 12 - totalHM.toFixed(1)- bd.replace(",","");
    $("input[name=abp]").val(txtABP.toFixed(1));
    $("input[name=stb]").val(stb.toFixed(1));
  });

  $("input[name=bd]").keyup(function(){
    hm_awal = $("input[name=hm_awal]").val();
    hm_akhir= $("input[name=hm_akhir]").val();
    bd      = $("input[name=bd]").val();
    totalHM = (hm_akhir.replace(",","")-hm_awal.replace(",",""));

    mtk = $("input[name=mtk]").val();
    txtABP = totalHM.toFixed(1)-mtk.replace(",","");
    stb = 12 - totalHM.toFixed(1)- bd.replace(",","");
    $("input[name=abp]").val(txtABP.toFixed(1));
    $("input[name=stb]").val(stb.toFixed(1));
  });
  
  $("input[name=tgl]").datepicker({ dateFormat: 'dd MM yy' });
  $("select").selectpicker();
  $(".myButtonDiss").click(function(){
      document.location= "<?php echo e(url('/sarpras/data/driver')); ?>";
    });
  $("button[id=newDriver]").click(function(){
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/driver/form')); ?>",
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });
  $("button[id=editDriver]").click(function(){
    eq = $("button[id=editDriver]").index(this);
    data_id = $("button[id=editDriver]").eq(eq).attr('data-id');
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/driver/edit')); ?>",
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