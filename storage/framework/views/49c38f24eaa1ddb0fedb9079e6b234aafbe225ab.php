<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Driver</h4>
      </div>
<form class="form-horizontal form-label-left" action="" method="post" novalidate>
<div class="modal-body">
<?php echo e(csrf_field()); ?>

<?php if(isset($edit)): ?>
<input type="hidden" name="_method" value="PUT" >
<input type="hidden" name="data_id" value="<?php echo e($data_id); ?>" >
<?php endif; ?>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noSim">No Sim <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="noSim" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="noSim" placeholder="No SIM" required="required" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->no_sim); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nik">NIK <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="nik" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" data-live-search="true" name="nik" placeholder="NIK" required="required">
          <option value="">-- PILIH --</option>
          <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($edit)): ?>
          <?php if($edit->nik==$v->nik): ?>
          <option value="<?php echo e($v->nik); ?>" data-nama="<?php echo e($v->nama); ?>" selected="selected">(<?php echo e($v->nik); ?>) <?php echo e(ucwords($v->nama)); ?></option>          
          <?php else: ?>
          <option value="<?php echo e($v->nik); ?>" data-nama="<?php echo e($v->nama); ?>">(<?php echo e($v->nik); ?>) <?php echo e(ucwords($v->nama)); ?></option>
          <?php endif; ?>
          <?php else: ?>
          <option value="<?php echo e($v->nik); ?>" data-nama="<?php echo e($v->nama); ?>">(<?php echo e($v->nik); ?>) <?php echo e(ucwords($v->nama)); ?></option>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenisSim">Jenis Sim <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="jenisSim" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="jenisSim" placeholder="Jenis Sim" required="required" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->jenis_sim); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="berlaku_sim">Masa Berlaku <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="berlaku_sim" class="form-control col-md-7 col-xs-12 datepicker" data-validate-length-range="2" name="berlaku_sim" placeholder="Masa Berlaku" required="required" <?php if(isset($edit)): ?> value="<?php echo e($edit->berlaku_sim); ?>" <?php else: ?> value="<?php echo e(date('d F Y')); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota_dikeluarkan">Kota Dikeluarkan <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="kota_dikeluarkan" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="kota_dikeluarkan" placeholder="Kota Dikeluarkan" required="required" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->kota_dikeluarkan); ?>" <?php endif; ?>>
      </div>
    </div>
</div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
  </div>

<!---validator-->
    <script src="<?php echo e(asset('/vendors/validator/validator.js')); ?>"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo e(asset('/vendors/jquery.tagsinput/src/jquery.tagsinput.js')); ?>"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo e(asset('/js-auto/dist/jquery.autocomplete.min.js')); ?>"></script>

    <script>
      $("select").selectpicker();
      $(document).on("focus",".datepicker",function(e){
        $(".datepicker").datepicker({ dateFormat: 'dd MM yy' });  
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
          this.submit();

        return false;
    });
    
    };

    init_validator();
     
    </script>