<?php if(in_array('ob',$arrRULE)): ?>
                            <li class="sub_menu"><a href="<?php echo e(url('/monitoring/form/ob')); ?>">OB</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('hauling',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/hauling')); ?>">HAULING</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('crushing',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/crushing')); ?>">CRUSHING</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('barging',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/barging')); ?>">BARGING</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('boat',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/boat')); ?>">TUG BOAT</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('stock',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/stock')); ?>">STOCK</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('delay ob',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/delay/ob')); ?>">DELAY OB</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('delay hauling',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/delay/hauling')); ?>">DELAY HAULING</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('delay crushing',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/delay/crushing')); ?>">DELAY CRUSHING</a>
                            </li>
                            <?php endif; ?>
<?php if(in_array('delay barging',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/form/delay/barging')); ?>">DELAY BARGING</a>
                            </li>
                            <?php endif; ?>

<?php if(in_array('monitoring_sr_expose',$arrRULE)): ?>
                            <li><a href="<?php echo e(url('/monitoring/sr/expose')); ?>">SR (Stripping Ratio) Expose</a>
                            </li>
                            <?php endif; ?>