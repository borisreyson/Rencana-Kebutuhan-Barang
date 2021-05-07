<?php if(isset($masterNew)): ?>
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Master Inventory</h4>
      </div>
<form class="form-horizontal form-label-left" action="" method="post" novalidate>
<div class="modal-body">
<?php echo e(csrf_field()); ?>

<?php if(isset($editMaster)): ?>
<input type="hidden" name="_method" value="PUT" >
<input type="hidden" name="data_id" value="<?php echo e($data_id); ?>" >
<?php endif; ?>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item">Kode Barang <span class="required">*</span>
      </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="item" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" name="item" placeholder="Kode Item" required="required" type="text" <?php if(isset($editMaster)): ?> value="<?php echo e($editMaster->item); ?>" <?php endif; ?>>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Part Name <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="desc" id="desc" rows="4" required="required" placeholder="Part Name" class="form-control col-md-7 col-xs-12" value="<?php if(isset($editMaster)): ?><?php echo e($editMaster->item_desc); ?><?php endif; ?>">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Part Number <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="part_number" id="part_number" rows="4" placeholder="Part Number" class="form-control col-md-7 col-xs-12" value="<?php if(isset($editMaster)): ?><?php echo e($editMaster->part_number); ?><?php endif; ?>">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">Satuan <span class="required">*</span>
      </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <select id="satuan" class="form-control col-md-7 col-xs-12" data-live-search="true" name="satuan" placeholder="Units" required="required" >
          <option value="">-- PILIH --</option>
          <?php $__currentLoopData = $satuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($editMaster)): ?>
          <?php if($v->satuannya==$editMaster->satuan): ?>
          <option value="<?php echo e($v->satuannya); ?>" selected="selected"><?php echo e($v->satuannya); ?></option>
          <?php else: ?>          
          <option value="<?php echo e($v->satuannya); ?>"><?php echo e($v->satuannya); ?></option>
          <?php endif; ?>
          <?php else: ?>
          <option value="<?php echo e($v->satuannya); ?>"><?php echo e($v->satuannya); ?></option>          
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">Label <span class="required">*</span>
      </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <select id="category" class="form-control col-md-7 col-xs-12" data-live-search="true" name="category" placeholder="Label" required="required" >
          <option value="">-- PILIH --</option>
          <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($editMaster)): ?>
          <?php if($v->code_category==$editMaster->category): ?>
          <option value="<?php echo e($v->code_category); ?>" selected="selected"><?php echo e(strtoupper($v->code_category)); ?> ( <?php echo e(ucwords($v->desc_category)); ?> )</option>
          <?php else: ?>          
          <option value="<?php echo e($v->code_category); ?>"><?php echo e(strtoupper($v->code_category)); ?> ( <?php echo e(ucwords($v->desc_category)); ?> )</option>
          <?php endif; ?>
          <?php else: ?>
          <option value="<?php echo e($v->code_category); ?>"><?php echo e(strtoupper($v->code_category)); ?> ( <?php echo e(ucwords($v->desc_category)); ?> )</option>          
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">Kategori <span class="required">*</span>
      </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <select id="catItem" class="form-control col-md-7 col-xs-12" data-live-search="true" name="catItem" placeholder="Category Item" required="required" >
          <option value="">-- PILIH --</option>
          <?php $__currentLoopData = $catItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($editMaster)): ?>
          <?php if($v1->CodeCat==$editMaster->item_cat): ?>
          <option value="<?php echo e($v1->CodeCat); ?>" selected="selected"><?php echo e(ucwords($v1->DeskCat)); ?></option>
          <?php else: ?>          
          <option value="<?php echo e($v1->CodeCat); ?>"><?php echo e(ucwords($v1->DeskCat)); ?></option>
          <?php endif; ?>
          <?php else: ?>
          <option value="<?php echo e($v1->CodeCat); ?>"><?php echo e(ucwords($v1->DeskCat)); ?></option>          
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="item form-group">

      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">Stok Minimal <span class="required">*</span>
      </label>
      <div class="col-md-2 col-sm-6 col-xs-12">
         <span class="staticParent">
        
        <input id="minstok" style="width: 90px!important;" type="number" min="1" class="form-control col-md-2 col-xs-2 child" name="minstok" placeholder="Minimum Stok" required="required"  <?php if(isset($editMaster)): ?> value="<?php echo e($editMaster->minimum); ?>" <?php endif; ?>>
        
      </span>
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
    <?php if(!isset($editMaster)): ?>
<script>
  $(".modal-content").ready(function(){
      $.ajax({
        type:"GET",
        url:"<?php echo e(url('/inventory/cek/master')); ?>",
        success:function(res) {
          $("input[name=item]").val(res);
        }
      });

    });
</script>
    <?php endif; ?>
    <script>
    /* VALIDATOR */

    
    $("select").selectpicker();

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
                $('#item').keydown(function(event) {
              if (event.keyCode == '32') {
                 event.preventDefault();
               }
            });

$(".modal-content").on("focus",".child",function() {
  $('.staticParent').on('keydown', '.child', function(e){-1!==$.inArray(e.keyCode,[190,46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
});
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