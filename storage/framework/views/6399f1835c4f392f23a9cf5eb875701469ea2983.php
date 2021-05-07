<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/app.css')); ?>">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <title>Form Edit Sarana Keluar</title>
</head>
<body>
<div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Edit Sarana Keluar</h4>
      </div>
<form class="form-horizontal form-label-left" action="" method="post">
<div class="modal-body">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="noid_out" value="<?php echo e($noid_out); ?>" >
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_lv">No Lambung <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12">
        <select id="no_lv" class="form-control col-md-12 col-xs-12" data-validate-length-range="2" name="no_lv" placeholder="No Polisi" required="required" type="text" data-live-search="true">
          <option value="">--PILIH--</option>
          <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($v->no_lv==$get->no_lv): ?>
          <option value="<?php echo e($v->no_lv); ?>" selected="selected"><?php echo e($v->no_lv); ?> (<?php echo e($v->merek_type); ?> <?php echo e($v->jenis); ?>)</option>
          <?php else: ?>
          <option value="<?php echo e($v->no_lv); ?>"><?php echo e($v->no_lv); ?> (<?php echo e($v->merek_type); ?> <?php echo e($v->jenis); ?>)</option>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_pol">No Polisi <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="form-control-static" id="no_pol_html"><?php echo e($get->no_pol); ?></div>
        <input id="no_pol" class="form-control col-md-12 col-xs-12" data-validate-length-range="2" name="no_pol" required="required" type="hidden" value="<?php echo e($get->no_pol); ?>">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_keluar">Tanggal Keluar <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12">
        <input id="tgl_keluar" class="form-control col-md-12 col-xs-12 datepicker" data-live-search="true" data-validate-length-range="2" name="tgl_keluar" required="required" placeholder="Tanggal Keluar" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->nama_p); ?>" <?php else: ?> value="<?php echo e(date('d F Y',strtotime($get->tgl_out))); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam_keluar">Jam Keluar <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12" style="width: 80px;">
        <input id="jam_keluar" class="form-control col-md-12 col-xs-12" data-live-search="true" data-validate-length-range="2" name="jam_keluar" required="required" placeholder="Jam Keluar" data-inputmask="'mask' : '**:**'" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->nama_p); ?>" <?php else: ?> value="<?php echo e(date('H:i',strtotime($get->jam_out))); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_masuk">Waktu Masuk <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12" style="width: 80px;">
        <div class="form-control-static">
          <?php if($get->jam_in==NULL): ?>
          <input id="waktu_masuk" class="row" name="waktu_masuk" type="checkbox">
          <?php else: ?>
          <input id="waktu_masuk" class="row" name="waktu_masuk" checked="checked" type="checkbox">
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="masuk"></div>
    
    
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea id="keterangan" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="keterangan" placeholder="Keterangan" required="required" ><?php echo e($get->keperluan); ?></textarea>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="driver">Driver <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="driver" class="form-control col-md-12 col-xs-12" data-live-search="true" data-validate-length-range="2" name="driver" required="required" placeholder="Driver" type="text">
        <option value="">--PILIH--</option>
        <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kD => $vD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($vD->nik==$get->supirnya): ?>
        <option value="<?php echo e($vD->nik); ?>" selected="selected">(<?php echo e($vD->nik); ?>) <?php echo e(ucwords($vD->nama)); ?></option>
        <?php else: ?>
        <option value="<?php echo e($vD->nik); ?>">(<?php echo e($vD->nik); ?>) <?php echo e(ucwords($vD->nama)); ?></option>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pemohon">Pemohon <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="pemohon" class="form-control col-md-12 col-xs-12" data-live-search="true" data-validate-length-range="2" name="pemohon" required="required" placeholder="Pemohon" type="hidden" <?php if(isset($pemohon)): ?> value="<?php echo e($pemohon->nik); ?>" <?php endif; ?>>
        <div class="form-control-static"><?php if(isset($pemohon)): ?> <?php echo e(ucwords($pemohon->nama)); ?> <?php endif; ?></div>
      </div>
    </div>
    <div class="item row">
      <label class="col-md-12 col-sm-3 col-xs-12 text-center" for="nama">Penumpang<span class="required">*</span></label>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <table class="table table-striped" id="table_penumpang">
          <thead>
            <tr class="bg-primary">
              <th width="45%">Penumpang</th>
              <th width="45%">Dept / Sect</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $p = explode(",",$get->penumpang_out);
             ?>
            <?php $__currentLoopData = $p; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pK => $pV): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              $data = DB::table("db_karyawan.data_karyawan")
                      ->join("department","department.id_dept","db_karyawan.data_karyawan.departemen")
                      ->leftjoin("section","section.id_sect","db_karyawan.data_karyawan.devisi")
                      ->where("nik",$pV)->first();
             ?>
            <tr>
                  <td>
                  <div class="item">
                  <select name="penumpang[]" id="penumpang"  data-live-search="true" class="form-control" required="required">
                  <option value="">--PILIH--</option>
                  <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kK => $vK): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($pV==$vK->nik): ?>
                  <option value="<?php echo e($vK->nik); ?>" selected="selected">(<?php echo e($vK->nik); ?>) <?php echo e(ucwords($vK->nama)); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($vK->nik); ?>">(<?php echo e($vK->nik); ?>) <?php echo e(ucwords($vK->nama)); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  </div>
                  </td>
                  <td>
                  <div class="form-control-static" id="depSect"><?php if(isset($data)): ?> <?php echo e(ucwords($data->dept)); ?> / <?php echo e(ucwords($data->sect)); ?> <?php endif; ?></div>
                  </td>
                  <td>       
                  <button class="btn btn-xs btn-danger" name="deleteRow" type="button"><i class="fa fa-times"></i></button>
                  </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr class="last_item">
              <td colspan="3">
               <div class="container-fluid">
                <div class="row">
<div class="form-group pull-right">
<div class=" col-md-8 col-sm-12 col-xs-12 pull-right">
<div class="input-group">
<input type="number" class="form-control" name="nRow" autocomplete="off" min="1" value="1" required="required">
<span class="input-group-addon"> Rows </span>
<span class="input-group-btn">
<button class="btn btn-primary" type="button" name="addRow">Add <i class="fa fa-plus"></i></button>
</span>
              </div>
              </div>
              </div> 
              </div>
              </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
      <div class="modal-footer">
        <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.close()">Close</button>
      </div>
      </form>
  </div>
<script src="<?php echo e(asset('/js/app.js')); ?>"></script>

    <!--bootstrap-notify-->
    <script src="<?php echo e(asset('/notify/bootstrap-notify.min.js')); ?>"></script>
    <!-- PNotify -->
    <script src="<?php echo e(asset('/vendors/pnotify/dist/pnotify.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/pnotify/dist/pnotify.buttons.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/pnotify/dist/pnotify.nonblock.js')); ?>"></script>
    <!-- Jequery UI -->
    <script src="<?php echo e(asset('jquery-ui/jquery-ui.min.js')); ?>"></script>
<!---validator-->
    <script src="<?php echo e(asset('/vendors/validator/validator.js')); ?>"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo e(asset('/vendors/jquery.tagsinput/src/jquery.tagsinput.js')); ?>"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo e(asset('/js-auto/dist/jquery.autocomplete.min.js')); ?>"></script>
    <!-- jquery.inputmask -->
    <script src="<?php echo e(asset('/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')); ?>"></script>

    <script>
      $(".datepicker").datepicker({ dateFormat: 'dd MM yy' });
      function init_InputMask() {
      
      if( typeof ($.fn.inputmask) === 'undefined'){ return; }
      console.log('init_InputMask');
      
        $(":input").inputmask();
        
    };
      var masuk = '<div class="item form-group">'+
                  '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_masuk">Tanggal Masuk <span class="required">*</span>'+
                  '</label>'+
                  '<div class="col-md-2 col-sm-6 col-xs-12">'+
                    '<input id="tgl_masuk" class="form-control col-md-12 col-xs-12 datepicker" data-live-search="true" data-validate-length-range="2" name="tgl_masuk" required="required" placeholder="Tanggal Masuk" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->jam_masuk); ?>" <?php else: ?> value="<?php echo e(date('d F Y')); ?>" <?php endif; ?>>'+
                  '</div>'+
                '</div>'+
                '<div class="item form-group">'+
                '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam_masuk">Jam Masuk <span class="required">*</span>'+
                '</label>'+
                '<div class="col-md-2 col-sm-6 col-xs-12" style="width: 80px;">'+
                  '<input id="jam_masuk" class="form-control col-md-12 col-xs-12" data-live-search="true" data-validate-length-range="2" name="jam_masuk" required="required" placeholder="Jam Masuk" data-inputmask="\'mask\' : \'**:**\'" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->jam_masuk); ?>" <?php else: ?> value="<?php echo e(date('H:i')); ?>" <?php endif; ?>>'+
                '</div>'+
              '</div>';
      $("#table_penumpang").on("click","button[name=deleteRow]",function(){
        eq = $("button[name=deleteRow]").index(this);
        $("button[name=deleteRow]").eq(eq).parent().parent().remove();
      });
      $(document).ready(function() {
        if ($("input[id=waktu_masuk]").is(':checked')) {
            $("div[class=masuk]").html(masuk);
            $("input[id=tgl_masuk]").val("<?php echo e(date('d F Y',strtotime($get->tgl_in))); ?>");
            $("input[id=jam_masuk]").val("<?php echo e(date('H:i',strtotime($get->jam_in))); ?>");
            $(".datepicker").datepicker({ dateFormat: 'dd MM yy' });
            init_InputMask();
        } else {
            $("div[class=masuk]").html("");
        }
    });''
      $("input[id=waktu_masuk]").click(function(){
        if($('input[id=waktu_masuk]').prop('checked')) {
            $("div[class=masuk]").html(masuk);
            $(".datepicker").datepicker({ dateFormat: 'dd MM yy' });
            init_InputMask();
        } else {
            $("div[class=masuk]").html("");
        }
      });

      $("select").selectpicker();
      
      var temp =  '<tr>'+
                  '<td>'+
                  '<div class="item">'+
                  '<select name="penumpang[]" id="penumpang"  data-live-search="true" class="form-control" required="required">'+
                  '<option value="">--PILIH--</option>'+
                  '<?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kK => $vK): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'+
                  '<?php if(isset($edit)): ?>'+
                  '<?php if($edit->nik==$vK->nik): ?>'+
                  '<option value="<?php echo e($vK->nik); ?>">(<?php echo e($vK->nik); ?>) <?php echo e(ucwords($vK->nama)); ?></option>'+
                  '<?php else: ?>'+
                  '<option value="<?php echo e($vK->nik); ?>">(<?php echo e($vK->nik); ?>) <?php echo e(ucwords($vK->nama)); ?></option>'+
                  '<?php endif; ?>'+
                  '<?php else: ?>'+
                  '<option value="<?php echo e($vK->nik); ?>">(<?php echo e($vK->nik); ?>) <?php echo e(ucwords($vK->nama)); ?></option>'+
                  '<?php endif; ?>'+
                  '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>'+
                  '</select>'+
                  '</div>'+ 
                  '</td>'+
                  '<td>'+
                  '<div class="form-control-static" id="depSect"></div>'+
                  '</td>'+
                  '<td>'+                
                  '<button class="btn btn-xs btn-danger" name="deleteRow" type="button"><i class="fa fa-times"></i></button>'+
                  '</td>'+
                  '</tr>';
      $("button[name=addRow]").click(function(){
          nRow = parseInt($("input[name=nRow]").val());
          //alert(nRow);
          for(i=0; i<nRow; i++){
          $("tr[class=last_item]").before(temp);
          }
          $("select").selectpicker('refresh');
      });

      
    /* INPUT MASK */
      $("select[id=no_lv]").change(function(){
        no_lv = $("select[id=no_lv]").val();
        if(no_lv!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo e(url('/sarpras/unit/check-no-lv')); ?>",
          data:{_token:"<?php echo e(csrf_token()); ?>",no_lv:no_lv},
          success:function(res){
            dRes = JSON.parse(res);
            //alert(dRes.no_pol);
            $("input[id=no_pol]").val(dRes.no_pol);
            $("div[id=no_pol_html]").html(dRes.no_pol);
            $("select[id=driver] option").removeAttr("selected");
            $("select[id=driver] option[value="+dRes.nik+"]").attr('selected', 'selected'); 
            $("select").selectpicker('refresh');
          }
        });
        }else{
            $("input[id=no_pol]").val("");
            $("div[id=no_pol_html]").html("");
            $("select[id=driver] option").removeAttr("selected");
            $("select[id=driver] option[value='']").attr('selected', 'selected');
            $("select").selectpicker('refresh'); 
        }
      });
      $("#table_penumpang").on("change","select[id=penumpang]",function(){
        //alert();
        eq = $("select[id=penumpang]").index(this);
        nik = $("select[id=penumpang]").eq(eq).val();
        $.ajax({
          type:"POST",
          url:"<?php echo e(url('/sarpras/karyawan/check-nik')); ?>",
          data:{_token:"<?php echo e(csrf_token()); ?>",nik:nik},
          success:function(res){
            dRes = JSON.parse(res);
            //alert(dRes.no_pol);
            $("div[id=depSect]").eq(eq).html(dRes.dept+" / "+dRes.sect);

          }
        });
      });
    
    init_InputMask();
    setTimeout(function(){
      $("input[id=no_pol]").focus();
    },300);

    $("input").keyup(function(){
      this.value = this.value.toLocaleUpperCase();
    });
    $("textarea").keyup(function(){
      this.value = this.value.toLocaleUpperCase();
    });
    /* VALIDATOR */

    function init_validator() {
     
    if( typeof (validator) === 'undefined'){ return; }    
    // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          $('form').submit();

        return false;
    });
    
    };

    //init_validator();
     
    $('form').submit(function(){
      $("button[id=submit]").attr("disabled","disabled");
        //return true;
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
    window.opener.location.reload();
    setTimeout(function(){
      window.close();
    },2000);
    
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
</body>
</html>





