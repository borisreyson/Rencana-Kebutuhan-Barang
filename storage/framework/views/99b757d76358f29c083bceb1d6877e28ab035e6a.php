
<?php $__env->startSection('title'); ?>
ABP-system | Absen Abp
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
    
    
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
.label-success{
  color: white!important;
}
.label-success:hover{
  color: black!important;
}
.table-freeze-multi tr td {
  vertical-align: middle!important;
  height:67px;
}

.table-freeze-multi tr .headcol {
  position: absolute;
  width: 20em;
  left: 0;
  top: auto;
  border-collapse: separate!important;
  border:solid 1px #DDEFEF !important;
  background-color: white;
}

.table-freeze-multi tr .headcol1 {
  position: absolute;
  width: 5em;
  left: 20em;
  top: auto;
  border-collapse: separate!important;
  border:solid 1px #DDEFEF !important;
  background-color: white;
}
.table-utama{
  margin-left: 24.1em;

  overflow-x: scroll;
  overflow-y: visible;
  padding: 0;
}
.long{
  width: 10em!important;
}
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
                  <h2>Absen</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">

<div class="col-lg-12 row">

  <div class="col-lg-12">

    <form action="" method="get" class="form-horizontal col-lg-10 row">
    <div class="form-group">
    <label class="control-label col-lg-3">Department</label>
    <div class="col-lg-6">
      <select name="dept" id="dept"  class="form-control" required="required" data-live-search="true">
        <option value="">--Pilih--</option>
        <?php $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
          <?php if($vv->id_dept != "ALL"): ?>   
          <?php if(isset($_GET['dept'])): ?>    
          <?php if($_GET['dept']==$vv->id_dept): ?>
          <option value="<?php echo e($vv->id_dept); ?>" selected="selected"><?php echo e($vv->dept); ?></option>  
          <?php else: ?>                           
          <option value="<?php echo e($vv->id_dept); ?>"><?php echo e($vv->dept); ?></option> 
          <?php endif; ?>
          <?php else: ?>
          <option value="<?php echo e($vv->id_dept); ?>"><?php echo e($vv->dept); ?></option> 
          <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>     
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-lg-3">Dari</label>
    <div class="col-lg-3">
      <?php if(isset($_GET['dari'])): ?>
      <input type="text" name="dari" id="dari" class="form-control dateRange" required="required" value="<?php echo e(date('d F Y',strtotime($_GET['dari']))); ?>"  />
      <?php else: ?>
      <input type="text" name="dari" id="dari" class="form-control dateRange" required="required" value="<?php echo e(date('01 F Y')); ?>"  />
      <?php endif; ?>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-lg-3">Sampai</label>
    <div class="col-lg-3">
      <?php if(isset($_GET['sampai'])): ?>
      <input type="text" name="sampai" id="sampai" class="form-control dateRange" required="required" value="<?php echo e(date('d F Y',strtotime($_GET['sampai']))); ?>" />
      <?php else: ?>
      <input type="text" name="sampai" id="sampai" class="form-control dateRange" required="required" value="<?php echo e(date('t F Y')); ?>" />
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Jumlah Per Halaman</label>
    <div class="col-lg-2">
      <input type="number" name="jml_perhalaman" id="jml_perhalaman" min="3" value="3" class="form-control" required="required">  
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-6">
      <button class="btn btn-primary" id="kirim" type="submit">Kirim</button>   
      <a class="btn btn-danger" id="reset" href="<?php echo e(url($_SERVER['REDIRECT_URL'])); ?>">Reset</a>   
    </div>
  </div>
    </form>
  </div>
  <?php if(isset($_GET['dari'])): ?>

  <div class="col-lg-6">
    <div class="col-lg-12">
      <a href="<?php echo e(url('/absen/rekap/karyawan/export')); ?>?<?php echo e($_SERVER['QUERY_STRING']); ?>

" class="btn btn-primary">Export</a>
    </div>
    <hr>
    <p><b>Jumlah : <?php echo e(count($dbKaryawan)); ?></b> </p>
    <hr>
  </div>
  <div class="col-md-6 col-sm-12 col-xs-12">
  <div class="">
  <form action="" method="GET" class="form-horizontal">
      <div class="form-group">
        <div class=" col-md-6 col-md-offset-6 col-sm-12 col-xs-12">
          <div class="input-group">
  <?php if(isset($_GET['dari'])): ?>
  <input type="hidden" class="form-control" name="dept" value="<?php echo e($_GET['dept']); ?>">
  <input type="hidden" class="form-control" name="dari" value="<?php echo e($_GET['dari']); ?>">
  <input type="hidden" class="form-control" name="sampai" value="<?php echo e($_GET['sampai']); ?>">
  <?php endif; ?>
  <input type="search" class="form-control" name="search" placeholder="Search for..." value="<?php echo e(isset($_GET['search']) ? $_GET['search'] : ''); ?>"  required="required">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
    </form>
    </div>
  </div>
  <div class="col-lg-12">
    <center>
      <h4 style="font-weight: bolder;">ABSENSI</h4>
      <h4 style="font-weight: bolder;">Periode <?php if(isset($_GET['dari'])): ?><?php echo e($_GET['dari']); ?><?php endif; ?> - <?php if(isset($_GET['sampai'])): ?><?php echo e($_GET['sampai']); ?><?php endif; ?> </h4>
    </center>
  </div>
  <div class="col-lg-12">
    <div class="table-responsive table-utama">
    <table class="table table-bordered table-freeze-multi" data-cols-number="2">
        <thead>
          <tr>
            <th class="text-center headcol">Name</th>
            <th class="text-center headcol1">Finger</th>
            <?php
            $ss=0;
            $start = strtotime(date("Y-m-d"));
            $end = strtotime(date("Y-m-d"));
            if(isset($_GET['dari'])){
              $start = strtotime(date("Y-m-d",strtotime($_GET['dari'])));
            }
            if(isset($_GET['sampai'])){
              $end = strtotime(date("Y-m-d",strtotime($_GET['sampai'])));
            }
            while($start <= $end)
              {
                $ss++;
            ?>
            <th class="text-center long" colspan="3"><?php echo e(date("m/d/Y",$start)); ?></th>
 <?php
      $start = strtotime("+1 day",$start);
  } ?>
          </tr>
        </thead>
        <tbody>
<?php if(isset($_GET['dept'])): ?>
  <tr>
    <td class="text-center headcol" style="font-weight: bold;">
    <?php
      $dpt = Illuminate\Support\Facades\DB::table("department")->where("id_dept",$_GET['dept'])->first();
    ?>
    <?php echo e(strtoupper($dpt->dept)); ?>

  </td>
    <td class="text-center headcol1"></td>
  <td colspan="<?php echo e((int) ($ss*3)); ?>">&nbsp</td>
  </tr>
  <?php endif; ?>
    <?php if(count($dbKaryawan)>0): ?>
      <?php $__currentLoopData = $dbKaryawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr class="text-center">
        <td class="headcol"><?php echo e($v->nama); ?></td>
        <td class="headcol1">Masuk</td>
       <?php
       $start = strtotime(date("Y-m-d"));
            $end = strtotime(date("Y-m-d"));
            if(isset($_GET['dari'])){
              $start = strtotime(date("Y-m-d",strtotime($_GET['dari'])));
            }
            if(isset($_GET['sampai'])){
              $end = strtotime(date("Y-m-d",strtotime($_GET['sampai'])));
            }
        while($start <= $end)
              {
                $roster = Illuminate\Support\Facades\DB::table("db_karyawan.roster_kerja")
                            ->join("db_karyawan.kode_jam_masuk","db_karyawan.kode_jam_masuk.id_kode","db_karyawan.roster_kerja.jam_kerja")
                            ->join("db_karyawan.jam_kerja","db_karyawan.jam_kerja.no","db_karyawan.kode_jam_masuk.id_jam_kerja")
                            ->where([
                              ["db_karyawan.roster_kerja.nik",$v->nik],
                              ["db_karyawan.roster_kerja.tanggal",date("Y-m-d",$start)]
                            ])->first();
                $masuk = Illuminate\Support\Facades\DB::table("absensi.ceklog")
                ->where([
                  ["tanggal",date("Y-m-d",$start)],
                  ["nik",$v->nik],
                  ["status","Masuk"]])->first();
                  if($masuk!=null){
            ?>
            <td class="long" <?php if($masuk->flag=='1'): ?> style="color:white; background-color:red;" <?php else: ?> style=" color:black;" <?php endif; ?> >
              <?php
                  
                    if(isset($roster->masuk)){
                      if(strtotime("+10 Minutes",strtotime($roster->masuk))>strtotime($masuk->jam)){
                        echo "<b>".$masuk->jam."</b>";
                      }else{
                        if($roster->kode_jam=="OFF"){
                          echo "<b>".$masuk->jam."</b><br>";
                          echo "<b color='blue'>OFF</b>";
                        }else{
                          if($masuk->flag=='1'){
                            echo "<b style='color:white';>".$masuk->jam." (TELAT)</b>";
                          }else{
                            echo "<b style='color:red';>".$masuk->jam." (TELAT) | ".$masuk->lupa_absen."</b>";
                          }
                          
                        }
                      }
                      
                    }else{
                      echo "<b>".$masuk->jam."</b>";
                    }
                    
                  
              ?>
            </td>
            <?php
                  }else{
                      ?>
            <td class="long">
              <?php  
            if(isset($roster->kode_jam)){
              if($roster->kode_jam=="OFF"){
                echo "<b style='color:red'>".$roster->kode_jam."</b>";
              }else{
                echo "<b>-</b>";
              }
            }else{
              echo "<b>-</b>";
            }
            
            ?>
          </td>
                      <?php
                       }
            ?>
              <td class="long">
                <?php if($masuk!=null): ?>
                   <a href="<?php echo e(url('/face_id').'/'.$v->nik.'/'.$masuk->gambar); ?>" target="_blank"> 
                <img width="50" height="50" src="<?php echo e(url('/face_id').'/'.$v->nik.'/'.$masuk->gambar); ?>">     
                </a>             
                 <?php else: ?>
                <b>
                -
              </b>
                <?php endif; ?>                
              </td>

              <td class="long">
               <?php if($masuk!=null): ?>
               <?php if($masuk->flag=='0'): ?>
              <button name="hapus" nik="<?php echo e($v->nik); ?>" tgl="<?php echo e($start); ?>" status="Masuk" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
              <?php else: ?>
                Tidak Sesuai Dengan Karyawan
              <?php endif; ?>
              <?php endif; ?>
            </td>
           <?php
                $start = strtotime("+1 day",$start);
            } ?>
      </tr>
      <tr class="text-center">
        <td class="headcol"><?php echo e($v->nik); ?></td>
        <td class="headcol1">Pulang</td>
        <?php
        $start = strtotime(date("Y-m-d"));
            $end = strtotime(date("Y-m-d"));
            if(isset($_GET['dari'])){
              $start = strtotime(date("Y-m-d",strtotime($_GET['dari'])));
            }
            if(isset($_GET['sampai'])){
              $end = strtotime(date("Y-m-d",strtotime($_GET['sampai'])));
            }
        while($start <= $end)
              {
              $roster = Illuminate\Support\Facades\DB::table("db_karyawan.roster_kerja")
                  ->join("db_karyawan.kode_jam_masuk","db_karyawan.kode_jam_masuk.id_kode","db_karyawan.roster_kerja.jam_kerja")
                  ->join("db_karyawan.jam_kerja","db_karyawan.jam_kerja.no","db_karyawan.kode_jam_masuk.id_jam_kerja")
                  ->where([
                    ["db_karyawan.roster_kerja.nik",$v->nik],
                    ["db_karyawan.roster_kerja.tanggal",date("Y-m-d",$start)]
                  ])->first();
              $pulang = Illuminate\Support\Facades\DB::table("absensi.ceklog")
               ->where([
                  ["tanggal",date("Y-m-d",$start)],
                  ["nik",$v->nik],
                  ["status","Pulang"]])->first();
                  if($pulang!=null){
            ?>
            <td class="long" <?php if($pulang->flag=='1'): ?> style=" color:white; background-color:red;" <?php else: ?> style=" color:black;" <?php endif; ?> >
              <?php
                    
                    if(isset($roster->pulang)){
                      if(strtotime($roster->pulang)<strtotime($pulang->jam)){
                        echo "<b>".$pulang->jam."</b>";
                      }else{
                        if($roster->kode_jam=="OFF"){
                          if($pulang->flag=='1'){
                            echo "<b style='color:white'>".$roster->kode_jam."</b>";
                          }else{
                            echo "<b color='blue'>".$roster->kode_jam."</b>";
                          }
                          
                        }else{
                          if($pulang->flag=='1'){
                            echo "<b style='color:white'>".$pulang->jam." (Belum Jam Pulang)</b>";
                          }else{
                            echo "<b >".$pulang->jam." (Belum Jam Pulang) | ".$pulang->lupa_absen."</b>";
                          }
                          
                        }
                        
                      }                      
                    }else{
                      echo "<b>".$pulang->jam."</b>";
                    }
              ?>
              </td>
              <?php
                  }else{
                      ?>
            <td class="long"><?php  
            if(isset($roster->kode_jam)){
              if($roster->kode_jam=="OFF"){
                echo "<b style='color:red'>".$roster->kode_jam."</b>";
              }else{
                echo "<b>-</b>";
              }
            }else{
              echo "<b>-</b>";
            }
            
            ?></td>
                      <?php
                       }
            ?>
              <td class="long">
               <?php if($pulang!=null): ?>
                   <a href="<?php echo e(url('/face_id').'/'.$v->nik.'/'.$pulang->gambar); ?>" target="_blank">  <img width="50" height="50" src="<?php echo e(url('/face_id').'/'.$v->nik.'/'.$pulang->gambar); ?>"></a>
              <?php else: ?>
                <b>-</b>
              <?php endif; ?>              
              </td>
              <td class="long">
               <?php if($pulang!=null): ?>
               <?php if($pulang->flag=='0'): ?>
              <button name="hapus" nik="<?php echo e($v->nik); ?>" tgl="<?php echo e($start); ?>" status="Pulang" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
              <?php else: ?>
               Tidak Sesuai Dengan Karyawan
              <?php endif; ?>
              <?php endif; ?>
              </td>
           <?php
                $start = strtotime("+1 day",$start);
            } ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
  <tr class="text-center">
    <td class="headcol" >&nbsp;</td>
    <td class="headcol1" >&nbsp;</td>
    <td class="long" colspan="<?php echo e($ss); ?>">No Data!</td>
  </tr>
      <?php endif; ?>
</tbody>
      </table>
      </div>
  <hr>
  </div>
  <?php endif; ?>
</div>
<div class="col-lg-12 text-center">
  <!---PAGINATION-->
<?php if(isset($_GET['dept'])): ?>

  <?php if(isset($_GET['dari'])): ?>
  <?php echo e($dbKaryawan->appends(['dept' => $_GET['dept'],'dari' => $_GET['dari'],'sampai' => $_GET['sampai'] ])->links()); ?>

  <?php else: ?>
    <?php echo e($dbKaryawan->links()); ?>

  <?php endif; ?>
<?php endif; ?>
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
      $("button[name=hapus]").click(function(){
        eq = $("button[name=hapus]").index(this);
        nik = $("button[name=hapus]").eq(eq).attr("nik");
        tgl = $("button[name=hapus]").eq(eq).attr("tgl");
        status = $("button[name=hapus]").eq(eq).attr("status");
        $.ajax({
          type:"POST",
          url:"<?php echo e(url('/absen/rekap/karyawan/validasi')); ?>",
          data:{_token:"<?php echo e(csrf_token()); ?>",nik:nik,tgl:tgl,status:status},
          success:function(res){
            if(res=="berhasil"){
              window.location.reload();
            }else{
              alert("Gagal Update!");  
            }
          }

        });
      });
      $("select").selectpicker();

    $("input[name=dari]").datepicker({ dateFormat: 'dd MM yy' });
    $("input[name=sampai]").datepicker({ dateFormat: 'dd MM yy' });
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