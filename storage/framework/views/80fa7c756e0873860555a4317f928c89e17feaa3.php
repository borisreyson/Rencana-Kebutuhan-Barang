<?php if(isset($invData)): ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e($detailItem->item_desc); ?></h4>
      </div>
      <div class="modal-body">
<div class="row">
  <div class="col-lg-12 form-horizontal">
    <div class="form-group">
      <label class="control-label col-lg-3">Item Code : </label>
      <div class=" col-lg-9">
      <label class="form-control-static"> <?php echo e($detailItem->item); ?></label></div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-3">Part Name : </label>
      <div class=" col-lg-9">
      <label class="form-control-static"> <?php echo e($detailItem->item_desc); ?></label></div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-3">Part Number : </label>
      <div class=" col-lg-9">
      <label class="form-control-static"> <?php echo e($detailItem->part_number); ?></label></div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-3">Label : </label>
      <div class=" col-lg-9">
      <label class="form-control-static">( <?php echo e(strtoupper($detailItem->code_category)); ?> ) <?php echo e(ucwords($detailItem->desc_category)); ?></label></div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-3">Category : </label>
      <div class=" col-lg-9">
      <label class="form-control-static"> <?php echo e($detailItem->DeskCat); ?></label></div>
    </div>
  </div>
</div>      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>
      </div>
    </div>
<?php endif; ?>