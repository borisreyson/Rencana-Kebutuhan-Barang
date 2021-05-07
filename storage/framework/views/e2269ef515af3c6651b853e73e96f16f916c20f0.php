<style>

</style>
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">QR Code</h4>
      </div>
<div class="modal-body">
  <div class="container">
      <div class="row ">
    <div class="col-lg-12 text-center">
      <table class="table">
        <tr align="center">
          <td>
        <div class="" id="qrcode_item"></div>
      </td>
        </tr>
        </table>
      </div>
    </div>
  </div>
</div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
<script>
jQuery(function(){
  jQuery('#qrcode_item').qrcode({
    render  : "table",
    text    : "<?php echo e($qrcode); ?>"
    });
})
</script>