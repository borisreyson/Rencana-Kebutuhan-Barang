<?php if(isset($edit->id_unit)): ?>
<li><a href="<?php echo e(url('/mon/unit/rental/form/unit-'.bin2hex($edit->id_unit))); ?>">Form Unit Rental</a></li>
<?php else: ?>
<li><a href="<?php echo e(url('/mon/unit/rental/form/unit')); ?>">Form Unit Rental</a></li>
<?php endif; ?>
<?php if(isset($edit->id_hm)): ?>
<li><a href="<?php echo e(url('/mon/unit/rental/form/hm-'.bin2hex($edit->id_hm))); ?>">Form HM Unit</a></li>
<?php else: ?>
<li><a href="<?php echo e(url('/mon/unit/rental/form/hm')); ?>">Form HM Unit</a></li>
<?php endif; ?>