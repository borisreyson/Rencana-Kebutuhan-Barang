<?php if(isset($editReq)): ?>
<?php if($editReq=="OK"): ?>
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Request Master Item</h4>
      </div>
<form class="form-horizontal form-label-left" action="" method="post" novalidate>
<div class="modal-body">
<?php echo e(csrf_field()); ?>

    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Part Name <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="hidden" name="id" value="<?php echo e(bin2hex($edit->id)); ?>">
        <input id="part_name" class="form-control col-md-7 col-xs-12" name="part_name" placeholder="Code Category" required="required" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->part_name); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Part Number <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="part_number" class="form-control col-md-7 col-xs-12" name="part_number" placeholder="Code Category" required="required" type="text" <?php if(isset($edit)): ?> value="<?php echo e($edit->part_number); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Satuan <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="satuan" class="form-control col-md-7 col-xs-12" data-live-search="true" name="satuan" placeholder="Code Category" required="required" >
          <option value="">--PILIH--</option>
          <?php $__currentLoopData = $satuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($edit->satuan==$v->satuannya): ?>
          <option value="<?php echo e($v->satuannya); ?>" selected="selected"><?php echo e(strtoupper($v->satuannya)); ?></option>
          <?php else: ?>
          <option value="<?php echo e($v->satuannya); ?>"><?php echo e(strtoupper($v->satuannya)); ?></option>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Minimum <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12">
        <input id="minimum" class="form-control col-md-7 col-xs-12" min="1" name="minimum" placeholder="Code Category" required="required" type="number" <?php if(isset($edit)): ?> value="<?php echo e($edit->minimum); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Category <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="kategori" class="form-control col-md-7 col-xs-12 " data-live-search="true" name="kategori" placeholder="Code Category" required="required">
          <option value="">--PILIH--</option>
          <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($edit->item_cat==$v->CodeCat): ?>
          <option value="<?php echo e($v->CodeCat); ?>" selected="selected"><?php echo e(strtoupper($v->DeskCat)); ?></option>
          <?php else: ?>
          <option value="<?php echo e($v->CodeCat); ?>"><?php echo e(strtoupper($v->DeskCat)); ?></option>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
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
    <script>
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

<?php endif; ?>
<?php endif; ?>