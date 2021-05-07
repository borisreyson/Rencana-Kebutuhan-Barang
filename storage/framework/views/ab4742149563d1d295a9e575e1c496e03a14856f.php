<?php if(isset($suplierNew)): ?>
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Method</h4>
      </div>
<form class="form-horizontal form-label-left" action="" method="post" novalidate>
<div class="modal-body">
<?php echo e(csrf_field()); ?>

<?php if(isset($editSuplier)): ?>
<input type="hidden" name="_method" value="PUT" >
<input type="hidden" name="data_id" value="<?php echo e($data_id); ?>" >
<?php endif; ?>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="suplier">Nama Suplier <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="suplier" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="suplier" placeholder="Nama Suplier" required="required" type="text" <?php if(isset($editSuplier)): ?> value="<?php echo e($editSuplier->nama_supplier); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_instansi">Nama Instansi <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="nama_instansi" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="nama_instansi" placeholder="Nama Instansi" required="required" type="text" <?php if(isset($editSuplier)): ?> value="<?php echo e($editSuplier->nama_instansi); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea name="alamat" id="alamat" required="required" placeholder="Alamat" class="form-control col-md-7 col-xs-12"><?php if(isset($editSuplier)): ?><?php echo e($editSuplier->alamat); ?><?php endif; ?></textarea>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nmr_contact">Nomor Kontak <span class="required">*</span>
      </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" placeholder="Nomor Kontak" <?php if(isset($editSuplier)): ?> value="<?php echo e($editSuplier->nmr_contact); ?>" <?php endif; ?>>
      </div>
    </div>

    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_instansi">Kategori <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="category" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="category" placeholder="Category" required="required" >
          <?php $__currentLoopData = $catVendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kVend => $vVend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <?php if(isset($editSuplier)): ?>
          <?php if($vVend->kodeCat==$editSuplier->category_vendor): ?>
          <option value="<?php echo e($vVend->kodeCat); ?>" selected="selected"><?php echo e($vVend->CategoryVendor); ?></option>
          <?php else: ?>

          <option value="<?php echo e($vVend->kodeCat); ?>"><?php echo e($vVend->CategoryVendor); ?></option>
          <?php endif; ?>
          <?php else: ?>
          <option value="<?php echo e($vVend->kodeCat); ?>"><?php echo e($vVend->CategoryVendor); ?></option>
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
    <!--<script src="<?php echo e(asset('/vendors/jquery.tagsinput/src/jquery.tagsinput.js')); ?>"></script>-->
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
/*

        //tags input
      function init_TagsInput() {
          
        if(typeof $.fn.tagsInput !== 'undefined'){  
         
        $('#desc').tagsInput({
          width: 'auto'
        });
        
        }
        
        };
    init_TagsInput();
    */

    init_validator();
    </script>
<?php endif; ?>