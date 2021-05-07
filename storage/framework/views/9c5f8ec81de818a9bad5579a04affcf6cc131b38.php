<?php
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Stock-Item-".hex2bin($item)."-Out.xls");
//dd($det);
//die();
?>
<table border="1" cellpadding="5" style="border-color: #000!important;" cellspacing="0">
  <thead>
    <tr class="bg-primary">
      <th style="background-color: blue; color: white;">Item</th>
      <th style="background-color: blue; color: white;">Stock Out</th>
      <th style="background-color: blue; color: white;">User Reciever</th>
      <th style="background-color: blue; color: white;">Department</th>
      <th style="background-color: blue; color: white;">Section</th>
      <th style="background-color: blue; color: white;">Location</th>
      <th style="background-color: blue; color: white;">Remarks</th>
      <th style="background-color: blue; color: white;">User Entry</th>
      <th style="background-color: blue; color: white;">Date In</th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($det)>0): ?>
    <?php $__currentLoopData = $det; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td>(<?php echo e(ucwords($v->item)); ?>) <?php echo e(ucwords($v->item_desc)); ?></td>
      <td><?php echo e(ucwords($v->stock_out)); ?> <?php echo e($v->satuan); ?></td>
      <td><?php echo e(ucwords($v->user_reciever)); ?></td>
      <td><?php echo e(ucwords($v->department)); ?></td>
      <td><?php echo e(ucwords($v->sect)); ?></td>
      <td><?php echo e(ucwords($v->location)); ?></td>
      <td><?php echo e(ucwords($v->remark)); ?></td>
      <td><?php echo e(ucwords($v->user_entry)); ?></td>
      <td><?php echo e(strval(date(" H:i:s d F Y",strtotime($v->date_entry)))); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr class="info">
      <td colspan="9">
       <b>Total Record : <?php echo e(count($det)); ?></b>
      </td>
    </tr>
    <?php else: ?>
    <tr>
      <td colspan="9" class="text-center">Not Have Record</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<script>
  //window.close();
</script>